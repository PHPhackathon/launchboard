<?php

/**
 *  Foursquare module for LaunchBoard 
 */

namespace Foursquare;


class Controller_Foursquare extends \Controller_LaunchBoard {

    /**
     * Foursquare Venue Id
     * 
     * @access  private
     * @var     string 
     */
    private $vanueId = '1656081';
        
    /**
     * The default view action for our module.
     * 
     * @access  public
     * @return  void
     */
    public function action_index() {
        
        if(!$data = \Cache::get('foursquare')){
            $foursquare = file_get_contents('https://foursquare.com/venue/'.$this->vanueId);
        
            
            $title_start = strpos($foursquare, '<h1 class="fn org">');
            $title_stop = strpos($foursquare, '</h1>');
            $data['title'] = strip_tags(substr($foursquare, $title_start, $title_stop-$title_start));


            $start = strpos($foursquare, '<div class="mayor');
            $foursquare = substr_replace($foursquare, '', 0, $start);
            $start = strpos($foursquare, '<div class="top contentContainer">');
            $foursquare = substr($foursquare, 0, $start);
            $foursquare = trim(str_replace('<div class="mayor grayBox flatTop">', '', $foursquare));

            $avatar_start = strpos($foursquare, 'https://playfoursquare.s3.amazonaws.com/userpix_thumbs');
            $avatar_stop = strpos($foursquare, '.jpg');
            $data['avatar'] = substr($foursquare, $avatar_start, $avatar_stop-$avatar_start).'.jpg';

            $name_start = strpos($foursquare, '<div class="name">');
            $name_stop = strpos($foursquare, '</div>');
            $data['name'] = strip_tags(substr($foursquare, $name_start, $name_stop-$name_start));

            $checkins_start = strpos($foursquare, '<em>');
            $checkins_stop = strpos($foursquare, '</em>');
            $data['checkins'] = strip_tags(substr($foursquare, $checkins_start, $checkins_stop-$checkins_start));

            \Cache::set('foursquare', $data, 600);
        }
        
        $this->response->body = \View::factory('foursquare', $data);
    }
    
    
    

}