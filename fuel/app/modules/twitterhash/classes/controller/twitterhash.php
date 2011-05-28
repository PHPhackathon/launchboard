<?php

/**
 *  Twitterhash module for LaunchBoard 
 */

namespace Twitterhash;


class Controller_Twitterhash extends \Controller_LaunchBoard {

    /**
     * Twitetr Hashtag to search for
     * 
     * @access  private
     * @var     string 
     */
    private $hashtag = 'phphackathon';
    
    /**
     * The default view action for our module.
     * 
     * @access  public
     * @return  void
     */
    public function action_index() {
              
        if(!$twitterhash = \Cache::get('twitterhash')){
            $twitterhash = $this->_fetch_twitterhash($this->hashtag);
            \Cache::set('twitterhash', $twitterhash, 5 * 60 * 60);
        }
        
        $data['twitterhash'] = $twitterhash;
        $data['hashtag'] = $this->hashtag;
        $this->response->body = \View::factory('twitterhash', $data);
    }
    
    
    /**
     * Fetch Twitter results for Hashtag.
     * 
     * @access  private
     * @param   param $hashtag
     * @return  void
     */
    private function _fetch_twitterhash($hashtag = ''){
        
        try{
            $url ='http://search.twitter.com/search.json?tag='.$hashtag.'&rpp=5';
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