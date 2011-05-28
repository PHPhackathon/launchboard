<?php

/**
 *  Birthdays module for LaunchBoard 
 */

namespace Birthdays;


class Controller_Birthdays extends \Controller_LaunchBoard {

    /**
     * Birthdays
     * 
     * @access  private
     * @var     string 
     */
    private $birthdays = array(
        '10-01' => 'Bjorn',
        '21-01' => 'Dirk',
        '05-02' => 'Wim',
        '13-02' => 'Dennis',
        '14-03' => 'Jente',
        '01-04' => 'Niki',
        '13-04' => 'Jochen',
        '09-05' => 'Bart G.',
        '24-05' => 'Dieter',
        '06-06' => 'Stijn',
        '29-06' => 'Kim',
        '03-07' => 'Bart VDB',
        '08-07' => 'Chris',
        '04-08' => 'Bart A.',
        '11-08' => 'Christine',
        '01-10' => 'Jan',
        '14-10' => 'Gert',
        '21-10' => 'Leen',
        '12-12' => 'Tom'
    );
    
    /**
     * The default view action for our module.
     * 
     * @access  public
     * @return  void
     */
    public function action_index() {
        
        $birthday = false;
        foreach($this->birthdays as $key => $value)
        {
            if($birthday === false && (time() < strtotime(date('Y') . '-' . substr($key, -2, 2) . "-" . substr($key, 0, 2))))
                $birthday = array('date' => $key, 'who' => $value);
        }
        
        $data['birthday'] = $birthday;        
        
        $this->response->body = \View::factory('birthdays', $data);
    }
    

}