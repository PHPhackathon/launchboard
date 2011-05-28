<?php

/**
 *  Rainer module for LaunchBoard 
 */

namespace Rainer;

class Controller_Rainer extends \Controller_LaunchBoard {

    /**
     * The default view action for our module.
     * 
     * @access  public
     * @return  void
     */
    public function action_index() {
        
        $this->response->body = \View::factory('rainer', array());
    }
}