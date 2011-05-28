<?php

/**
 *  Time module for LaunchBoard 
 */

namespace Daydone;

class Controller_Daydone extends \Controller_LaunchBoard {

    /**
     * The default view action for our module.
     * 
     * @access  public
     * @return  void
     */
    public function action_index() {
        
        if(date('N')==5 && date('H')>=16 && date('i')>=0){ // Friday
            $data['answer'] = true;
        }elseif(date('N')>=6){ // Weekend
            $data['answer'] = true;
        }elseif(date('H')>=16 && date('i')>=30){ // Monday - Tthursday
            $data['answser'] = true;
        }else{
            $data['answer'] = false;
        }
                
        $this->response->body = \View::factory('daydone', $data);
    }

}