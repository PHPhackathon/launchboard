<?php

/**
 *  Twitterprofile module for LaunchBoard 
 */

namespace Twitterprofile;


class Controller_Twitterprofile extends \Controller_LaunchBoard {

    /**
     * Twitter profile to search for
     * 
     * @access  private
     * @var     string 
     */
    private $profile = 'dieterverjans';
    
    /**
     * The default view action for our module.
     * 
     * @access  public
     * @return  void
     */
    public function action_index() {
              
        if(!$twitterprofile = \Cache::get('twitterprofile')){
            $twitterprofile = $this->_fetch_twitterprofile($this->profile);
            \Cache::set('twitterprofile', $twitterprofile, 60);
        }
        
        $data['twitterprofile'] = $twitterprofile;
        $data['profile'] = $this->profile;
        $this->response->body = \View::factory('twitterprofile', $data);
    }
    
    
    /**
     * Fetch Twitter results for Hashtag.
     * 
     * @access  private
     * @param   param $profiletag
     * @return  void
     */
    private function _fetch_twitterprofile($profile = ''){
        
        try{
            $url ='http://search.twitter.com/search.json?from='.$profile.'&rpp=5';
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