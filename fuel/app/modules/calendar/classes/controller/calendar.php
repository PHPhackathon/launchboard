<?php

/**
 *  Twitterhash module for LaunchBoard 
 */

namespace Calendar;


class Controller_Calendar extends \Controller_LaunchBoard {

    /**
     * Google Calendar URL
     * 
     * @access  private
     * @var     string 
     */
    private $url = 'http://www.google.com/calendar/feeds/inventis.be_ightgt6o2iop09okbda40co3os%40group.calendar.google.com/public/basic';
    
    /**
     * The default view action for our module.
     * 
     * @access  public
     * @return  void
     */
    public function action_index() {
        
        //if(!$events = \Cache::get('calendar')){
            $events = file_get_contents($this->url);
            $events = simplexml_load_string($events);
         //   \Cache::set('calendar', $events, 60);
       // }

            
        foreach($events->entry as $event){
            $pos = strpos($event->summary, '&');
            $string = trim(str_replace('Wanneer: ','',substr($event->summary, 0, $pos)));
          
            $data['events'][] = array(
                'title' => (string)$event->title,
                'summary' => str_replace('<br> <br>', '', $string)
            );
        }
        $data['title'] = (string)$events->title;
        
        $this->response->body = \View::factory('calendar', $data);
    }
    

}