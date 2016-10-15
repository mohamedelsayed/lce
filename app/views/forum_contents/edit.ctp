<?php $id = $this->data['Content']['id'];?>
<div class="contents form">
<?php echo $this->Form->create('Content', array('type'=>'file', 'url' => $base_url.'/forum_contents/edit/'.$this->data['Content']['id']));?>
	<fieldset>
 		<legend><?php echo  __('Edit Content of '). $this->data['Content']['title']; ?></legend>
	<div id="form">
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('title');		
		echo $this->Form->input('Content.body', array('class'=>'ckeditor'));?>
	</div>
	<div id="tapss">
        <ul class="tabs">
            <li><a class="current" href="#">Images</a></li>
        </ul>
        <div class="panes">
        	<div style="display: block;">
	            <?php
	            //echo $this->Form->input('Gal.0.caption', array('value'=>'')); 
				echo $this->Form->input('Gal.0.image', array('type'=>'file','label'=>'Image'));
				if(!empty($this->data['Gal'])){
					echo '<h3>'.__('Related Images', true).'</h3>';				
					echo $this->element('forum/images_gallery_view', array('gallery' => $this->data['Gal']));
				}?> 
				<?php if(!empty($this->data['Gal']) && (count($this->data['Gal']) > 1)){?>
					<div class="actions">
						<ul>
							<li style="width:140px;">
								<?php echo $this->Html->link(__('Positioning of Images', true), array('controller'=> 'gals','action' => 'index',$this->data['Content']['id'],'Content'));?>   
							</li>
						</ul>
					</div>
				<?php }?>
			</div>           
        </div>            
    </div>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php //__('Actions'); ?></h3>
	<ul>
		<li><?php //echo $this->Html->link(__('List Contents', true), array('action' => 'index'));?></li>
	</ul>
</div>
<style type="text/css">
	#gallery1{height: 300px !important;}
</style>