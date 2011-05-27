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

        $pAnalytics = new Library_GAnalytics();

        if(isset($_GET[ 'code' ])) {
            $pAnalytics->getRefreshToken($_GET[ 'code' ]);
            $pAnalytics->getAccounts();
        } else if(isset($_SESSION[ 'refresh_token' ])) {
            if(isset($_GET['refresh'])) {
                $pAnalytics->getAccounts();
            } else {
                $nStart = strtotime("midnight") + 86399;
		        $nEnd = $nStart - 86400 * 14;
		        
                $aResult = $pAnalytics->getAnalytics('martijnc.be', $nStart, $nEnd);
                
                var_dump($aResult);
            }
        } else {
            $pAnalytics->start();
        }
        
        $data['urls'] = $_SESSION['urls'];
        
        $this->response->body = \View::factory('analytics', $data);
    }

}