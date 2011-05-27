<?php

/**
 * Main launchboard controller
 *
 * This is the main LaunchBoard Controller
 * 
 * @package  app
 * @extends  Controller
 */
class Controller_LaunchBoard extends Controller {

    
    /**
     * The index action.
     * 
     * @access  public
     * @return  void
     */
    public function action_index()
    {
        $this->response->body = View::factory('launchboard/index');
    }
    
    
    /**
     * The 404 action for the application.
     * 
     * @access  public
     * @return  void
     */
    public function action_404()
    {
        $messages = array('Aw, crap!', 'Bloody Hell!', 'Uh Oh!', 'Nope, not here.', 'Huh?');
        $data['title'] = $messages[array_rand($messages)];

        // Set a HTTP 404 output header
        $this->response->status = 404;
        $this->response->body = View::factory('launchboard/404', $data);
    }

}