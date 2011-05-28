<?php

/**
 *  Gowalla module for LaunchBoard 
 */

namespace Gowalla;


class Controller_Gowalla extends \Controller_LaunchBoard {

    /**
     * Gowalla Venue Id
     * 
     * @access  private
     * @var     string 
     */
    private $vanueId = '75975';
        
    /**
     * The default view action for our module.
     * 
     * @access  public
     * @return  void
     */
    public function action_index() {

        if(!$data = \Cache::get('gowalla')){
            $checkins = file_get_contents('http://gowalla.com/spots/'.$this->vanueId.'/checkins.atom');
            $checkins = simplexml_load_string($checkins);
            foreach($checkins->entry as $checkin){
                $data['checkins'][] = array(
                     'time' => strtotime($checkin->published)
                    ,'user' => (string)$checkin->title
                );
            }      
            $data['title'] = (string)$checkins->title;
            \Cache::set('gowalla', $data, 120);
        }
        
        
        $this->response->body = \View::factory('gowalla', $data);
    }
    
    
    

}