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
	//use upload component.
	var $components = array('Upload');
	function index() {
		$this->NeventOrder->recursive = 0;
		$this->paginate = array(
			//'conditions' => array('Node.title LIKE' => "%".$this->data['Node']['title']."%"),
			'order' => array('NeventOrder.id'=>'DESC'),
		);
		$this->set('nevent_orders', $this->paginate());
	}
	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid NeventOrder', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('nevent_order', $this->NeventOrder->read(null, $id));
	}
	function export_array_to_excel(){
		$filename = "Report-".date("Y-m-d");
		$R=new PHPReport();
		$R->load(array(
		            'id'=>'product',
					'header'=>array(
							'product'=>'Product name','price'=>'Price','tax'=>'Tax'
						),
					'config'=>array(
							'header'=>array(
								'product'=>array('width'=>120,'align'=>'center'),
								'price'=>array('width'=>80,'align'=>'center'),
								'tax'=>array('width'=>80,'align'=>'center')
							),
							'data'=>array(
								'product'=>array('align'=>'left'),
								'price'=>array('align'=>'right'),
								'tax'=>array('align'=>'right')
							)
						),
		            'data'=>array(
							array('product'=>'Some product','price'=>23.99,'tax'=>12),
							array('product'=>'Other product','price'=>5.25,'tax'=>2.25),
							array('product'=>'Third product','price'=>0.20,'tax'=>3.5)
		                ),
		            )
		        );
		
		echo $R->render('excel', $filename);
		exit();
	}
}