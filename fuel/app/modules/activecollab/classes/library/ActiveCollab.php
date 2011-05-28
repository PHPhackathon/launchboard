<?php

namespace Activecollab;

class Library_Activecollab
{
	public static $apiUrl;
	public static $apiKey;
	
	/**
	 *  Set API Key
	 *	@param	string	$apiUrl		The URL of your activaCollab API.
	 *	@param	string	$apiKey		activeCollab API key.
	 */ 
	public static function setAPIKey($apiUrl, $apiKey)
	{
		self::$apiUrl = $apiUrl;
		self::$apiKey = $apiKey;
	}
	
	/**
	 * fetch Projects
	 */
	public static function fetchProjects()
	{
		//check if cached
		if(!$projects = \Cache::get('activecollab')){
			$projects =  self::request('projects');		
			
			if($projects && count($projects) > 0){
				foreach($projects as $project)
				{					
					$total_tasks = 0;
					$completed_tasks = 0;
					
					//fetch info					
					$info = self::request('projects/' . $project->id);
					$project->icon = $info->icon_url;
					
					//fetch tickets					
					$tickets = self::request('projects/' . $project->id  . '/tickets');
					$ticketsArchive = self::request('projects/' . $project->id  . '/tickets/archive');
					
					if($tickets && count($tickets) > 0){
						foreach($tickets as $item)
						{
							$total_tasks++;
							if(!is_null($item->completed_on)) $completed_tasks++;
						}
					}
					
					if($ticketsArchive && count($ticketsArchive) > 0){
						foreach($ticketsArchive as $item)
						{
							$total_tasks++;
							if(!is_null($item->completed_on)) $completed_tasks++;
						}
					}
					
					//fetch checklists					
					$checklists = self::request('projects/' . $project->id  . '/checklists');
					$checklistsArchive = self::request('projects/' . $project->id  . '/checklists/archive');
										
					if($checklists && count($checklists) > 0){
						foreach($checklists as $item)
						{							
							//tasks
							$chklist = self::request('projects/' . $project->id  . '/checklists/' . $item->id);
							
							if($chklist && $chklist->tasks && count($chklist->tasks) > 0){
								
								foreach($chklist->tasks as $task)
								{									
									$total_tasks++;
									if(!is_null($task->completed_on)) $completed_tasks++;
								}
							}
							
							$total_tasks++;
							if(!is_null($item->completed_on)) $completed_tasks++;
						}
					}
					
					if($checklistsArchive && count($checklistsArchive) > 0){
						foreach($checklistsArchive as $item)
						{
							//tasks
							$chklist = self::request('projects/' . $project->id  . '/checklists/' . $item->id);
							
							if($chklist && $chklist->tasks && count($chklist->tasks) > 0){
								
								foreach($chklist->tasks as $task)
								{									
									$total_tasks++;
									if(!is_null($task->completed_on)) $completed_tasks++;
								}
							}
							
							$total_tasks++;
							if(!is_null($item->completed_on)) $completed_tasks++;
						}
					}
					
					//fetch milestones					
					$milestones = self::request('projects/' . $project->id  . '/milestones');
					
					if($milestones && count($milestones) > 0){
						foreach($milestones as $item)
						{
							$total_tasks++;
							if(!is_null($item->completed_on)) $completed_tasks++;
						}
					}
					
					//assign data
					$project->total_tasks = $total_tasks;
					$project->completed_tasks = $completed_tasks;
					$project->progress = ($total_tasks > 0 ? round(($completed_tasks / $total_tasks)*100) : 0);
				}
				
				\Cache::set('activecollab', $projects, 1800);
			}
		}
		
		return $projects;
	}
	
	/**
	 *do API request
	 */
	private function request($path_info)
	{
		$fetchUrl = self::$apiUrl . '?path_info='. $path_info . '&token=' . self::$apiKey . '&format=json';
		
		$curl = curl_init($fetchUrl); 
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); 
		$data = curl_exec($curl); 
		if(!curl_errno($curl)){ 
			$info = curl_getinfo($curl); 
		} else { 
			die('Curl error: ' . curl_error($curl)); 
		} 
		
		curl_close($curl); 
		
		return json_decode($data);
	}
}