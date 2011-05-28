<?php

/**
 *  Weather module for LaunchBoard 
 */

namespace Weather;


class Controller_Weather extends \Controller_LaunchBoard {

    /**
     * Location
     * 
     * @access  private
     * @var     string 
     */
    private $location = 'Belgium';
    
    /**
     * The default view action for our module.
     * 
     * @access  public
     * @return  void
     */
    public function action_index() {
              
        if(true || !$weather = \Cache::get('$weather')){
            $weather = $this->_fetchWeather($this->location);
            \Cache::set('twitterhash', $twitterhash, 1800);
        }
        
        var_dump($weather);
        
        $data['weather'] = $weather;
        $this->response->body = \View::factory('weather', $data);
    }
    
    
    /**
     * Fetch Weather results
     * 
     * @access  private
     * @param   param $hashtag
     * @return  void
     */
    private function _fetchWeather($location = ''){
        
        try{
            $url ='http://www.google.com/ig/api?weather='.$location.'&hl=en';
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_USERAGENT, "LaunchBoard Mozilla Parl");
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_TIMEOUT, 10);
            $output = curl_exec($ch);
            curl_close($ch);
            return $output;
        }  catch (Exeption $e){
            return null;
        }        
    }

}