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
	function index($type = null){
		$this->loadModel('Setting');
		$settings2 = $this->Setting->read(null, 2);		
		$this->set('settings2', $settings2['Setting']);
		$this->set('selected', 'calendar');
        $year = isset($this->params['named']['year'])?$this->params['named']['year']:date("Y");
        $month = isset($this->params['named']['month'])?$this->params['named']['month']:date("m");
        $current_month = $month;
        $current_year = $year;
        $condition = '';
        $events = $this->Event->find('all', array(
            'conditions' => array(
                'AND' => array(
                    'OR' => array(
                        array('AND' => array(
                                'YEAR(Event.from_date) = '.$year,
                                'MONTH(Event.from_date) = '.$month
                            )
                        ),     
                        array('AND' => array(
                                'YEAR(Event.to_date) = '.$year,
                                'MONTH(Event.to_date) = '.$month
                            )
                        )                        
                    )
                ),
                $condition              
            ),
            'order' => array('Event.from_date'=>'ASC','Event.id'=>'DESC'),
        ));
        $events_by_days = array();
        if(!empty($events)){
            foreach ($events as $key => $event) {
                $date = $event['Event']['from_date'];
                $to_date = $event['Event']['to_date'];
                if(strtotime($to_date) >= strtotime($date)){
                    $day = date('j', strtotime($date));
                    $month = date('n', strtotime($date));
                    $year = date('Y', strtotime($date));
                    $to_day = date('j', strtotime($to_date));
                    $to_month = date('n', strtotime($to_date));                    
                    $to_year = date('Y', strtotime($to_date));     
                    if($month == $current_month){
                        if($to_month == $current_month){
                            for ($i = $day; $i <= $to_day; $i++) {
                                $events_by_days[$i][] = $event;                       
                            }                    
                        }else{
                            for ($i = $day; $i <= 31; $i++) {                                
                                $events_by_days[$i][] = $event;                       
                            } 
                        }                                                    
                    }elseif($to_month == $current_month){                        
                        for ($i = $to_day; $i >= 1; $i--) {
                            $events_by_days[$i][] = $event;
                        }                    
                    }                    
                }
            }
        }
        $this->set('events_by_days' , $events_by_days);
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
	/*function getEvents($year=null, $month=null, $day=null) {
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
	}*/
}