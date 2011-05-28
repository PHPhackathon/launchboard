<?php

/**
 *  Activecollab module for LaunchBoard 
 */

namespace Activecollab;

class Controller_Activecollab extends \Controller_LaunchBoard {

    /**
     * The default view action for our module.
     * 
     * @access  public
     * @return  void
     */
	public function action_index() {
	
		//load library
		$Activecollab = new Library_ActiveCollab();
		
		$url = 'http://ac.inventis.be/public/api.php';
		$key = '99-YI10HZbnJttkoQqpvyFtyXMtHtZeAdanL1miOowm';
		
		//set api url and key
		$Activecollab->setAPIKey($url, $key);
		
		//fetch projects
		$projects = $Activecollab->fetchProjects();
		
		//set colors
		$colors = array('#4572A7', '#89A54E', '#80699B', '#3D96AE', '#DB843D', '#92A8CD', '#A47D7C', '#B5CA92');
		shuffle($colors);

		//set categories and data for chart
		$i=0;
		if($projects && count($projects) > 0){
			foreach($projects as &$proj)
			{				
				$proj->color = $colors[$i];
				$i++;
				if($i > (count($colors)-1))$i=0;
			}
		}
		
		$data['projects'] = $projects;
		
		//display view
		$this->response->body = \View::factory('Activecollab', $data);
	}
}