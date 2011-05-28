<?php

/**
 *  Twittermentions module for LaunchBoard 
 */

namespace Twittermentions;


class Controller_Twittermentions extends \Controller_LaunchBoard {

    /**
     * Twitter mentions to search for
     * 
     * @access  private
     * @var     string 
     */
    private $mentions = 'dieterverjans';
    
    /**
     * The default view action for our module.
     * 
     * @access  public
     * @return  void
     */
    public function action_index() {
              
        if(!$twittermentions = \Cache::get('twittermentions')){
            $twittermentions = $this->_fetch_twittermentions($this->mentions);
            \Cache::set('twittermentions', $twittermentions, 5 * 60 * 60);
        }
        
        $data['twittermentions'] = $twittermentions;
        $data['mentions'] = $this->mentions;
        $this->response->body = \View::factory('twittermentions', $data);
    }
    
    
    /**
     * Fetch Twitter results for Hashtag.
     * 
     * @access  private
     * @param   param $mentionstag
     * @return  void
     */
    private function _fetch_twittermentions($mentions = ''){
        
        try{
            $url ='http://search.twitter.com/search.json?ref='.$mentions.'&rpp=5';
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_USERAGENT, "LaunchBoard Mozilla Parl");
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_TIMEOUT, 10);
            $output = json_decode(curl_exec($ch));
            curl_close($ch);
            return $output->results;
        }  catch (Exeption $e){
            return null;
        }        
    }

}