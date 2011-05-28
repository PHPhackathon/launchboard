<?php

/**
 *  Analytics module for LaunchBoard 
 */

namespace Analytics;

class Controller_Analytics extends \Controller_LaunchBoard {

    /**
     * The default view action for our module.
     * 
     * @access  public
     * @return  void
     */
    public function action_index() {

       session_start();

       $pAnalytics = new Library_Ganalytics();

       if(isset($_GET[ 'code' ])) {
        
           $pAnalytics->getRefreshToken($_GET[ 'code' ]);
           $pAnalytics->getAccounts();
           //header('Location: /analytics');
           die();
           
       } else if (isset($_GET['reset'])) {
           session_destroy();
           //header('Location: /analytics');
           die();
       } else if(isset($_GET[ 'site' ])) {
       
           if(isset($_SESSION['refresh_token'])) {
           
                $nStart = strtotime("midnight") + 86399;
		        $nEnd = $nStart - 86400 * 14;
		       
                $aResult = $pAnalytics->getAnalytics($_GET['site'], $nStart, $nEnd);
                
                if($aResult === false) {
                    unset($_SESSION);
                }
               
                die(json_encode(array('cats' => array_keys($aResult), 'data' => array_values($aResult))));
            }
           
        } else if(isset($_GET['start'])){
            $pAnalytics->start();
        } else if(!isset($_SESSION['refresh_token'])){
            $this->response->body = \View::factory('noaccounts');
        } else {
            if(isset($_SESSION['urls']) && count($_SESSION['urls']) > 0) {
                $data['aUrls'] = $_SESSION['urls'];
                $this->response->body = \View::factory('analytics', $data);
            } else {
               $this->response->body = \View::factory('emptyaccount');
            }
        }
    }

}