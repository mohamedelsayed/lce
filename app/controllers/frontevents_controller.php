<?php
/**
 * @author Author "Mohamed Elsayed"  
 * @author Author Email "me@mohamedelsayed.net"
 * @copyright Copyright (c) 2016 Programming by "mohamedelsayed.net"
 */
class FronteventsController  extends AppController {
	var $name = 'Frontevents';
	var $uses = 'Nevent';
	function events(){
		$this->set('title_for_layout' , 'All Events');	
		$this->set('selected','frontevents');
		$year = isset($_GET['year'])?$_GET['year']:date("Y");
		$month = isset($_GET['month'])?$_GET['month']:date("m");
		$events = $this->Nevent->find('all', array(
            'conditions' => array(
                'AND' => array(
                    'OR' => array(
                        array('AND' => array(
                                'YEAR(Nevent.start_date) = '.$year,
                                'MONTH(Nevent.start_date) = '.$month
                            )
                        ),                          
                    )
                ),                             
            ),
            'order' => array('Nevent.start_date'=>'ASC','Nevent.id'=>'DESC'),
        ));	
        $this->set('events' , $events);
	}
}