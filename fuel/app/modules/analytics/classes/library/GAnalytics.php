<?php

namespace Analytics;

class Library_Ganalytics
{

    /* The application/client ID is a unique number assigned
     * to your application by Google
     *
     * @var string The Google client id
     */
    protected static $_appId = '311616635629.apps.googleusercontent.com';
    
    /* The application's secret is a unique string
     * assigned to your application by facebook
     *
     * @var string The application's secret
     */
    protected static $_appSecret = 'H5e22xr7DS1fAbauEez6BrBM';
    
    /* When the user accepts or denies the connect request,
     * the user will be send to this URL so we can continue
     * with the authorization procedure
     *
     * @var string the URL that will be used by Facebook to redirect the user
     */
    protected static $_callbackUrl = 'http://srvr.tomclaus.be/analytics/';
    
    /* By calling this function the user will be redirected
     * to Facebook to start the authentication process.
     *
     * @return null
     */
    public function start( ) {
        
        // Redirect the user to Facebook to start authentication
        header( 'location:     https://accounts.google.com/o/oauth2/auth?client_id=' . self::$_appId .
        '&redirect_uri=' . urlencode( self::$_callbackUrl ) .
        '&scope=https://www.google.com/analytics/feeds/&response_type=code' );
    
        //Just to be sure
        die();
    }


    /**
     * When the user has authenticated for the first time we
     * need to request a refresh token and a access token.
     * The access token is used to retrieve data but expires every
     * hour. When that happens we need the refresh token to request
     * a new, fresh, access token.
     * The refresh token doesn't expire.
     *
     * @param string the code from google
     * @return boolean false on failure, true on succes
     */
    public function getRefreshToken( $sCode )
    {
        /* Create a HTTP context with POST data */
        $aContext = array(
            'http' => array(
                'method' => 'POST',
                'header' => 'Content-type: application/x-www-form-urlencoded',
                'content' => http_build_query(
                    array(
                       'code'           => $sCode,
                       'client_id'      => self::$_appId,
                       'client_secret'  => self::$_appSecret,
                       'redirect_uri'   => self::$_callbackUrl,
                       'grant_type'     => 'authorization_code'
                    )
                )
            )
        );

        $pContext = stream_context_create( $aContext );

        /* Send request to the API and get the response */    
        $sContent = file_get_contents( 'https://accounts.google.com/o/oauth2/token', false, $pContext );
        
        /* Parse the response */
        $oJson = json_decode($sContent);

        /* Did we get the results we expected? */
        if( isset($oJson->access_token) && isset($oJson->refresh_token) ) {
            /* yep, store the info */
            $_SESSION['access_token'] = $oJson->access_token;
            $_SESSION['refresh_token'] = $oJson->refresh_token;
            return true;
        } else {
            /* hmm, nope */
            return false;
        }
    }

    /* When the access has expired, just ask google for a
     * new one!
     *
     * @return boolean false on failure, true on succes
     */    
    protected function _getNewAccessToken()
    {
        /* We cannot do this without a refresh token. */
        if( !isset($_SESSION[ 'refresh_token' ]) ) {
            return false;
        }
        
        /* Create a HTTP context with POST data */
        $aContext = array(
            'http' => array(
                'method' => 'POST',
                'header' => 'Content-type: application/x-www-form-urlencoded',
                'content' => http_build_query(
                    array(
                       'client_id'      => self::$_appId,
                       'client_secret'  => self::$_appSecret,
                       'refresh_token'   => $_SESSION[ 'refresh_token' ],
                       'grant_type'     => 'refresh_token'
                    )
                )
            )
        );    

        $pContext = stream_context_create( $aContext );

        /* Send request to the API and get the response */    
        $sContent = file_get_contents( 'https://accounts.google.com/o/oauth2/token', false, $pContext );
        
        /* Parse the response */
        $oJson = json_decode($sContent);

        /* Is this the response we wanted? */
        if( isset($oJson->access_token) ) {
            /* Yes it is */
            $_SESSION['access_token'] = $oJson->access_token;
            return true;
        } else {
            /* nope */
            return false;
        }
    }
    
    /* Retrieves a lists of URL's with their tableId to
     * which the current user has access.
     *
     * @return boolean false on failure, true on succes
     */    
    public function getAccounts( $bRetrying = false )
    {
        /* We need a access token for this. */
        if( !isset($_SESSION[ 'access_token' ] ) ) {
            $this->_getNewAccessToken();
        }

        /* Send request to the API and get the response */    
        $sContent = file_get_contents( 'https://www.google.com/analytics/feeds/accounts/default?oauth_token='
                                    . urlencode($_SESSION[ 'access_token' ]) );

        /* Get HTTP status code */
        $nStatusCode = $this->_getStatusCode($http_response_header);

        /* Send request to the API and get the response */    
        if( $nStatusCode == 401 ) {
            
            /* When we get a 401, request a new accestoken (once). */
            if(!$bRetrying && $this->_getNewAccessToken()) {
                /* Retry now we have a new accesstoken */
                return $this->getAccounts(true);
            } else {
                /* When this fails again, stop requesting. oAuth has failed */
                return false;
            }
        } else if( $nStatusCode != 200 ) {
            return false;
        }

        /* Parse the xml document */
        $pXml = new \DOMDocument();
        
        /* but stop if that doesn't work */
        if( !$pXml->loadXML($sContent) ) {
            return false;
        }

        /* Get all entries */
        $aAccounts = $pXml->getElementsByTagName('entry');

        $aAnalytics = array();
        
        $_SESSION['urls'] = array();
        
        /* Extract relevant info for all */
        foreach( $aAccounts as $aAccount ) {
        
            $sTitle = $aAccount->getElementsByTagName('title')->item(0)->nodeValue;
            $TableId = $aAccount->getElementsByTagName('tableId')->item(0)->nodeValue;
            
            if( isset($sTitle) && isset($TableId) ) {
                $_SESSION['urls'][$sTitle] = $TableId;
            }
        }
        
        return true;    
    }
    
    /** 
     * Get the actual data from the Google Data API
     *
     * @return mixed false on failure, array on succes
     */    
    public function getAnalytics($sUrl, $nStartDate, $nEndDate, $bRetrying = false)
    {
        /* We need a access token for this. */
        if(!isset($_SESSION['access_token'])) {
            $this->_getNewAccessToken();
        }

        $sEndDate = date('Y-m-d', $nStartDate + 84600);
        $sStartDate = date('Y-m-d', $nEndDate);

        /* Send request to the API and get the response */    
        $sContent = file_get_contents( 'https://www.google.com/analytics/feeds/data?ids=' . urlencode($_SESSION['urls'][$sUrl]) . '&dimensions=ga%3Adate&metrics=ga%3Avisitors&start-date=' . urlencode($sStartDate) . '&end-date=' . urlencode($sEndDate) . '&max-results=500&oauth_token=' . urlencode($_SESSION[ 'access_token' ]));

        $nStatusCode = $this->_getStatusCode($http_response_header);

        /* Send request to the API and get the response */    
        if( $nStatusCode == 401 ) {
            
            /* When we get a 401, request a new accestoken (once). */
            if(!$bRetrying && $this->_getNewAccessToken()) {
                /* Retry now we have a new accesstoken */
                return $this->getAnalytics( $sUrl, $nStartDate, $nEndDate, true );
            } else {
                /* When this fails again, stop requesting. oAuth has failed */
                return false;
            }
        } else if( $nStatusCode != 200 ) {
            return false;
        }

        /* Stop if the request has failed */
        if( $sContent === false ) {
            return false;
        }

        /* Parse the xml document */
        $pXml = new \DOMDocument();
        
        /* but stop if that doesn't work */
        if( !$pXml->loadXML($sContent) ) {
            return false;
        }
        
        /* Get all entries */
        $aDays = $pXml->getElementsByTagName('entry');

        $aResults = array();

        /* Extract relevant info for all */
        foreach( $aDays as $aDay ) {
            
            /* Timestamp for result */
            $nDay = $aDay->getElementsByTagName( 'dimension' )->item(0)->getAttribute('value');
            /* Actual value */
            $nValue = $aDay->getElementsByTagName( 'metric' )->item(0)->getAttribute('value');
            
            /* Assign to dataset */
            $aResults[ date('j M', strtotime($nDay)) ] = (int)$nValue;
            
        }

        return $aResults;

    }

    /**
     * Extracts HTTP status code from the request headers
     */    
    protected function _getStatusCode( $aHeaders ) {
        return substr( $aHeaders[ 0 ], 9, 3 );
    }
}

