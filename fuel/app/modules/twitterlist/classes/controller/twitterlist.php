<?php

/**
 *  Twitterlist module for LaunchBoard 
 */

namespace Twitterlist;


class Controller_Twitterlist extends \Controller_LaunchBoard {

    /**
     * Twitter list to search for
     * 
     * @access  private
     * @var     string 
     */
    private $list = 'http://twitter.com/#!/dieterverjans/inventis';
    
    /**
     * The default view action for our module.
     * 
     * @access  public
     * @return  void
     */
    public function action_index() {
              
        if(!$twitterlist = \Cache::get('twitterlist')){
            $twitterlist = $this->_fetch_twitterlist($this->list);
            \Cache::set('twitterlist', $twitterlist, 60);
        }
        
        $data['twitterlist'] = $twitterlist;
        $data['list'] = $this->list;
        $this->response->body = \View::factory('twitterlist', $data);
    }
    
    
    /**
     * Fetch Twitter results for Hashtag.
     * 
     * @access  private
     * @param   param $listtag
     * @return  void
     */
    private function _fetch_twitterlist($url = ''){
        
        try{
           // $url ='http://search.twitter.com/search.json?ref='.$list.'&rpp=5';
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