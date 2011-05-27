<?php

/**
 *  Twitterhash module for LaunchBoard 
 */

namespace Twitterhash;


class Controller_Twitterhash extends \Controller_LaunchBoard {

    /**
     * The default view action for our module.
     * 
     * @access  public
     * @return  void
     */
    public function action_index() {
                
        // try to retrieve the cache and save to $content var
        
        if(!$content = \Cache::get('test')){
            $content = 'String to be cached'.date('H:i:s');
            \Cache::set('test', $content, 10);
        }
 
        
        var_dump($content);
        
        //$data['time'] = date('H:i');
        
       // $this->response->body = \View::factory('twitterhash', $data);
    }

}