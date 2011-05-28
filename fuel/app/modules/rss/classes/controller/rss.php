<?php

/**
 *  RSS module for LaunchBoard 
 */

namespace Rss;


class Controller_Rss extends \Controller_LaunchBoard {

    /**
     * Twitetr Hashtag to search for
     * 
     * @access  private
     * @var     string 
     */
    private $url = 'http://rss.feedsportal.com/c/865/f/11107/index.rss';
    private $rssTitel = 'HBVL.be';
    
    /**
     * The default view action for our module.
     * 
     * @access  public
     * @return  void
     */
    public function action_index() {
              
        if(!$rss = \Cache::get('rss')){
            $rss = $this->_fetchRss($this->url);
            \Cache::set('rss', $rss, 1800);
        }
        $total = count($rss)-1;
        $data['rss'] = $rss[rand(0, $total)];
        $data['rssTitel'] = $this->rssTitel;
        $this->response->body = \View::factory('rss', $data);
    }
    
    
    /**
     * Fetch Twitter results for Hashtag.
     * 
     * @access  private
     * @param   param $hashtag
     * @return  void
     */
    private function _fetchRss($url = ''){
        
        try{
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_USERAGENT, "LaunchBoard Mozilla Parl");
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_TIMEOUT, 10);
            $xmlstr = curl_exec($ch);
            curl_close($ch);
            
            $xml = new \SimpleXMLElement($xmlstr);
            
            $rss = array();
            
            echo "<pre>";
            //var_dump($xml);
            
            foreach($xml->channel->item as $item)
            {                
                $rss[] = array(
                    'title'         => (string)$item->title,
                    'link'          => (string)$item->link,
                    'description'   => strip_tags((string)$item->description),
                    'date'          => date('d-m-Y H:i', strtotime((string)$item->pubDate))
                );            
            }
            
            return $rss;
        }  catch (Exeption $e){
            return null;
        }        
    }

}