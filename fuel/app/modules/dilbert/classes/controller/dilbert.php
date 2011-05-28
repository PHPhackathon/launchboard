<?php

/**
 *  Dilbert module for LaunchBoard 
 */

namespace Dilbert;

class Controller_Dilbert extends \Controller_LaunchBoard {

    /**
     * The default view action for our module.
     * 
     * @access  public
     * @return  void
     */
    public function action_index() { 
        
        if(true || !$image = \Cache::get('image')){
            $image = $this->_fetchDilbert();
            \Cache::set('image', $image, 60);
        }
        
        $data['image'] = $image;
        
        $this->response->body = \View::factory('dilbert', $data);
    }
    
    /**
     * Fetch Dilbert.
     * 
     * @access  private
     * @param   param $hashtag
     * @return  void
     */
    private function _fetchDilbert(){
        
        try{
            $url ='http://www.dilbert.com/fast';
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_USERAGENT, "LaunchBoard Mozilla Parl");
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_TIMEOUT, 10);
            $output = curl_exec($ch);
            curl_close($ch);
            
            preg_match_all('/src="([^"]+)"/i', $output, $results); 
            
            foreach($results[1] as $img)
            {
                if(strpos($img, '/str_strip/'))
                    return 'http://www.dilbert.com/' . $img;
            }
            
            return null;
        }  catch (Exeption $e){
            return null;
        }        
    }

}