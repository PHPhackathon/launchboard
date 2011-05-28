<?php

/**
 *  Twitterhash module for LaunchBoard 
 */

namespace Flickr;


class Controller_Flickr extends \Controller_LaunchBoard {

    /**
     * Flickr API Key
     * 
     * @access  private
     * @var     string 
     */
    private $apikey = '1a940d7cbf6845212a96bea69ecae8d9';
    
    /**
     * Flickr API Secret
     * 
     * @access  private
     * @var     string 
     */
    private $secret = '9c0de6d3cf8bba0d';
    
    /**
     * Search Tag Flickr
     * 
     * @access  private
     * @var     string 
     */
    private $search = 'inventis';
    
    /**
     * The default view action for our module.
     * 
     * @access  public
     * @return  void
     */
    public function action_index() {
              

        if(!$photos = \Cache::get('flickr')){
            $search = $this->_fetch_photos($this->search);         
            $photos = $search['photos']['photo'];
            foreach($photos as &$photo){
                $photo['url'] = 'http://farm'.$photo["farm"].'.static.flickr.com/'.$photo["server"].'/'.$photo["id"].'_'.$photo["secret"].'_m.jpg';
            }       
            \Cache::set('flickr', $photos, 60);
        }
        
        $data['photos'] = $photos;
        $this->response->body = \View::factory('flickr', $data);
    }
    
    
    /**
     * Fetch Twitter results for Hashtag.
     * 
     * @access  private
     * @param   param $hashtag
     * @return  void
     */
    private function _fetch_photos($search = ''){
        
        try{
            $url ='http://flickr.com/services/rest/?method=flickr.photos.search&api_key=' . $this->apikey . '&text='.$search.'&per_page=50&format=php_serial';
            $output = file_get_contents($url);
            return unserialize($output);
        }  catch (Exeption $e){
            return null;
        }        
    }

}