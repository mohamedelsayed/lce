<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=ISO-8859-1">
		<title>
			<?php echo $this->Session->read('Setting.title'). ' - Maintenance Mode';?>
		</title>
		<?php echo $this->Html->meta('icon', $this->Session->read('Setting.url').'/app/webroot/img/front/favicon.png');?>
		<?php echo $this->Html->css(array('front/style', 'front/new_style'));?>
	</head>
	<body>
		<div class="container">
			<div class="maintenancelogo">
				<a href="<?php echo $this->Session->read('Setting.url');?>">
					<img alt="<?php echo $this->Session->read('Setting.title');?>" src="<?php echo $this->Session->read('Setting.url').'/img/front/';?>logo.png" />
				</a>
			</div>
			<div class="maintenancetext">
				<?php echo $maintenance_mode_text;?>
			</div>
		</div>
	</body>
</html>