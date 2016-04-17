<div class="newsletters form">
<?php echo $this->Form->create(null, array('type'=>'file', 'url' => array('controller' => 'subscribers', 'action' => 'subscribers_delete')));?>
	<fieldset>
		<legend><?php __('Delete Subscribers'); ?></legend>
		<p>Welcome to Subscriber Delete! You can Delete subscribers from a list of email addresses or from a CSV file containing subscriber email. CSV files should have one subscriber(email) per line.<br/>
			Popular programs such as Microsoft Excel and Open Office support saving files in CSV (Comma-Seperated-Value) format.<br/>
			Duplicate subscribers or invalid email addresses will be ignored.<br />
			You can download sample file to make like it <a style="color: #0000FF" target="_blank" href="<?php echo $this->Session->read('Setting.url').'/subscribers.csv';?>">From Here</a> (Right click on the link and choose "Save As..." to download this file.).
		</p>
		<?php
		$options=array('0'=>'List of Email Addresses','1'=>'.CSV file');
		$attributes=array('value'=>0, 'legend'=>'Type');
		echo $form->radio('type',$options,$attributes);
		echo $this->Form->input('file', array('type'=>'file','label'=>'.CSV file'));
		echo $this->Form->input('mail_list',array('label'=>'List of Email Addresses use , as separator','type'=>'textarea'));
		?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('List Subscribers', true), array('action' => 'index'));?></li>
	</ul>
</div>
<style type="text/css">
	.file{
		display: none;
	}
	p a:hover{
		text-decoration: underline;
	}
	p{
		font-size: 14px;
	}
</style>
<script type="text/javascript">
$(document).ready(function(){
    $("#SubscriberType0").click(function(){
    	$(".textarea").show();
    	$(".file").hide();
    });
    $("#SubscriberType1").click(function(){
    	$(".textarea").hide();
    	$(".file").show();
    });
});	
</script>