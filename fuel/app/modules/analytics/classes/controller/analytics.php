<?php

/**
 *  Analytics module for LaunchBoard 
 */

namespace Analytics;

class Controller_Analytics extends \Controller_LaunchBoard {

    /**
     * The default view action for our module.
     * 
     * @author Martijn Croonen
     * @return  void
     */
    public function action_index() {

       /* Start session */
       session_start();
       var_dump($_SESSION);
       /* Load analytics library */
       $pAnalytics = new Library_Ganalytics();

       /* After a user confirms the oAuth dialog he gets redirected
        * here with code as GET parameter */
       if(isset($_GET[ 'code' ])) {
        
           $pAnalytics->getRefreshToken($_GET[ 'code' ]);
           $pAnalytics->getAccounts();
           header('Location: /analytics');
           die();
       
       /* When a user clicks the reset link, remove the analytics info */
       } else if (isset($_GET['reset'])) {
       
           session_destroy();
           header('Location: /analytics');
           die();
           
       /* Return the analytics */
       } else if(isset($_GET[ 'site' ])) {
           
           /* Without a refresh token we won't be able to get results */
           if(isset($_SESSION['refresh_token'])) {
               
               /* Set start and end time (14 days) */
               $nStart = strtotime("midnight") + 86399;
		       $nEnd = $nStart - 86400 * 14;
		       
		       /* Get the results */
               $aResult = $pAnalytics->getAnalytics($_GET['site'], $nStart, $nEnd);
               
               /* If we get false, we have a invalid refresh token */
               if($aResult === false) {
                   unset($_SESSION);
               }
               
               /* Send results as JSON to front-end */
               die(json_encode(array('cats' => array_keys($aResult), 'data' => array_values($aResult))));
               
                unset($_SESSION);
           }
        
        /* Start the authentication */
        } else if(isset($_GET['start'])){
        
            $pAnalytics->start();
            
        /* Show the graph if there are urls available */
        } else if(!isset($_SESSION['refresh_token'])){
            $this->response->body = \View::factory('noaccounts');
        } else {
            /* Don' show graph when the account has no analytics data */
            if(isset($_SESSION['urls']) && count($_SESSION['urls']) >= 1) {
                $data['aUrls'] = $_SESSION['urls'];
                $this->response->body = \View::factory('analytics', $data);
            } else {
               $this->response->body = \View::factory('emptyaccount');
            }
        }
    }

}