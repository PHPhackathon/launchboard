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
            \Cache::set('weather', $weather, 1800);
        }
        
        echo "<pre>";
        var_dump($weather);
        
        $data['weather'] = $weather;
        $data['location'] = $this->location;
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
            $xmlstr = curl_exec($ch);
            curl_close($ch);
            
            $xml = new \SimpleXMLElement($xmlstr);
            
            return array(
                'date'      => (string)$xml->weather->forecast_information->forecast_date['data'],
                'condition' => (string)$xml->weather->current_conditions->condition['data'],
                'temp'      => (string)$xml->weather->current_conditions->temp_c['data'],
                'humidity'  => (string)$xml->weather->current_conditions->humidity['data'],
                'icon'      => (string)$xml->weather->current_conditions->icon['data'],
                'wind'      => (string)$xml->weather->current_conditions->wind_condition['data']
            );
        } catch (Exeption $e){
            return null;
        }        
    }

}