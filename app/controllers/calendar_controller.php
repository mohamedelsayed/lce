<?php /**
 * @author Author "Mohamed Elsayed"  
 * @author Author Email "me@mohamedelsayed.net"
 * @link http://www.mohamedelsayed.net/
 * @copyright Copyright (c) 2015 Programming by "mohamedelsayed.net"
 */
require_once '../authfront_controller.php';
class CalendarController extends AuthfrontController {
	var $name = 'Calendar';
	var $uses = 'Event';	
	function index($type=null){
		//$this->Session->write('secId', 'cal');
	}	
	/*function events($year=null, $month=null, $day=null){
		$this->Session->write('secId', 0);
		$this->set('events', $this->getEvents($year, $month, $day));
		$this->set('title_for_layout', 'Events');
	}	
	function event($id=null){
		$this->Session->write('secId', 0);
		if(!$id)
			$this->redirect(array('controller'=>'news', 'action' => 'display', 'home'));
		$event = $this->Event->read(null, $id);
		// Set data to view
		$this->set(
			array(
				'event' 		   => $event,
				'metaKeywords'     => $event['Event']['meta_keywords'],
				'metaDescription'  => $event['Event']['meta_description'],
				'title_for_layout' => $event['Event']['title']
			)
		);
	}*/	
	//Return Events
	function getEvents($year=null, $month=null, $day=null) {
		if($year==null || $month==null)
			return null;
		$condition = '';
		$this->Event->recursive = 1;
		if($day != null){
			$condition = 'DAY(Event.date) = '.$day;
			$this->Event->recursive = 1;
		}
		return $this->Event->find('all', array(
			'conditions' => array(
				'YEAR(Event.date) = '.$year,
				'MONTH(Event.date) = '.$month,
				$condition
			)
		));
	}
}