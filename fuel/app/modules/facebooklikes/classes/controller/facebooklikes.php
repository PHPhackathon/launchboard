<?php

/**
 *  Analytics module for LaunchBoard 
 */

namespace Facebooklikes;

class Controller_Facebooklikes extends \Controller_LaunchBoard {

    /**
     * Name of the page you want to display the likes for.
     *
     * @var Name of the page
     */
    protected $_sPage = 'inventis';

    /**
     * The default view action for our module.
     * 
     * @access  public
     * @return  void
     */
    public function action_index() {
        
        /* Try reading from cache */
        if(($nLikes = \Cache::get('fblikes_' . $this->_sPage))) {
            $data['sName'] = \Cache::get('fblikes_name_' . $this->_sPage);
            $data['nLikes'] = $nLikes;
        } else {
            /* Or get data from Facebook Graph API */
            $sContent = file_get_contents('https://graph.facebook.com/' . $this->_sPage);
        
            /* If the request was succefull, parse data */
            if($sContent !== false) {
                $oFb = json_decode($sContent);
            
                $data['sName'] = $oFb->name;
                $data['nLikes'] = $oFb->likes;
            
                \Cache::set('fblikes_name_' . $this->_sPage, $oFb->name, 1800);
                \Cache::set('fblikes_' . $this->_sPage, $oFb->likes, 1800);
            
            } else {
                $data['sName'] = 'noone';
                $data['nLikes'] = 0;
            }
        }
        
        /* Send data to view */
        $this->response->body = \View::factory('facebooklikes', $data);
    }

}