<?php

/**
 *  Time module for LaunchBoard 
 */

namespace Time;

class Controller_Time extends \Controller_LaunchBoard {

    /**
     * The default view action for our module.
     * 
     * @access  public
     * @return  void
     */
    public function action_index() {
        
        $data['time'] = date('H:i');
        
        $this->response->body = \View::factory('time', $data);
    }

}