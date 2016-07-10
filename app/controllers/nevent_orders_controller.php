<?php
/**
 * @author Author "Mohamed Elsayed"  
 * @author Author Email "me@mohamedelsayed.net"
 * @copyright Copyright (c) 2016 Programming by "mohamedelsayed.net"
 */
include 'PHPReport/PHPReport.php';
require_once '../auth_controller.php';
class NeventOrdersController extends AuthController {
	var $name = 'NeventOrders';
	function index($type = 'events', $export = '') {
		if($type == 'events'){
			$type_flag = 0;
		}else{
			$type_flag = 1;			
		}
		$this->set('type_flag', $type_flag);
		$event_id = 0;
		if(isset($this->data['NeventOrder']['event_id'])){
			$event_id = $this->data['NeventOrder']['event_id'];
		}
		$name = '';
		if(isset($this->data['NeventOrder']['name'])){
			$name = trim($this->data['NeventOrder']['name']);
		}
		$email = '';
		if(isset($this->data['NeventOrder']['email'])){
			$email = trim($this->data['NeventOrder']['email']);
		}
		$conditions = array();
		$conditions['NeventOrder.transaction_number > '] = 0;	
		if($event_id > 0 && is_numeric($event_id)){
			$conditions['NeventOrder.event_id'] = $event_id;						
		}else{
			if($type_flag == 1){
				$conditions['NeventOrder.installment_flag'] = 1;						
			}else{
				$conditions['NeventOrder.installment_flag'] = 0;
			}
		}
		if($name != ''){
			$conditions['NeventOrder.name LIKE'] = "%".$name."%";
		}
		if($email != ''){
			$conditions['NeventOrder.email LIKE'] = "%".$email."%";
		}
		$order = array('NeventOrder.id'=>'DESC');
		$this->NeventOrder->recursive = 0;
		$this->paginate = array(
			'conditions' => $conditions,
			'order' => $order,
		);
		$this->set('nevent_orders', $this->paginate());
		$this->set('event_id', $event_id);
		$this->set('type', $type);		
		$events = $this->NeventOrder->Nevent->find('list');		
		array_unshift($events, "");
		$this->set(compact('events'));
		if($export == 'export'){
			$nevent_orders = $this->NeventOrder->find(
				'all', array(
					'conditions' => $conditions,
					'order' => $order,
				)	  	 	
			);	
			$header = array('Id', 'Name', 'Email', 'Mobile Number', 'Receipt Number', 'Transaction Number', 
							'Tickets Number', 'Amount', 
							'Created',
							'Event',
							);
			if($type_flag == 1){
				array_pop($header);
			}
			$config = array();
			$data = array();
			$i = 0;
			foreach ($header as $key => $value) {
				if($i != 0){
					$config[$key]['width' ] = 120;					
				}
				$i++;
				$config[$key]['align' ] = 'center';
			}
			foreach ($nevent_orders as $key => $nevent_order) {
				$id = $nevent_order['NeventOrder']['id'];
				$name = $nevent_order['NeventOrder']['name'];
				$email = $nevent_order['NeventOrder']['email'];
				$event = $nevent_order['Nevent']['title'];
				$mobile_number = $nevent_order['NeventOrder']['mobile_number'];
				$receipt_number = $nevent_order['NeventOrder']['receipt_number'];
				$transaction_number = $nevent_order['NeventOrder']['transaction_number'];
				$tickets_number = $nevent_order['NeventOrder']['tickets_number'];
				$amount = $nevent_order['NeventOrder']['amount'].' '.$this->currency;
				$created = $nevent_order['NeventOrder']['created'];
				$row = array($id, $name, $email, $mobile_number, $receipt_number, $transaction_number, 
							$tickets_number, $amount,
							$created,
							$event, 							
							);
				if($type_flag == 1){
					array_pop($row);
				}
				$data[] = $row;				
			}
			$filename = ucfirst($type).'-'."Report-".date("Y-m-d");
			$this->export_array_to_excel($header, $data, $filename, $config);		
		}
	}
	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid NeventOrder', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('nevent_order', $this->NeventOrder->read(null, $id));
	}
	function export_array_to_excel($header = array(), $data = array(), $filename = '', $config = array()){	
		$R = new PHPReport();
		if($filename == ''){
			$filename = "Report-".date("Y-m-d");
		}
		$R->load(array(
		            'id' => 'event_orders',
					'header' => $header,
		            'data' => $data,
		            'config' => array(
						'header' => $config,
						'data' => $config,
					),
	            )
        );		
		echo $R->render('excel', $filename);
		exit();
	}
}