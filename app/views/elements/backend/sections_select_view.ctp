<?php 
$cat_id = isset($cat_id)?$cat_id:0;
$data = $this->requestAction('sections/getSections/'.$cat_id);
echo $this->Form->input(
	'Section.id', 
	array(
		'type'=>'select', 
		'options' => $data['sections'],
		'selected'=>$data['selected'],
		'label' => 'Section',
		'empty'=>'-------------'
	)
);
?>