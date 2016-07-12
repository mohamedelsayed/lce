<div class="settings form">
<?php echo $this->Form->create('Setting');?>
	<fieldset>
 		<legend><?php __('Edit Settings'); ?></legend>
	<?php
		echo $this->Form->input('id');
		//echo $this->Form->input('url');
		echo $this->Form->input('email');
		echo $this->Form->input('coaches_email', array('rows' => 2));
		echo $this->Form->input('payment_email', array('rows' => 2));
		//echo $this->Form->input('contact_us_email');		
		echo $this->Form->input('title');
		echo $this->Form->input('footer');
		echo $this->Form->input('hide_geography');
		echo $this->Form->input('meta_keywords');
		echo $this->Form->input('meta_description');
		echo $this->Form->input('file_types');
		echo $this->Form->input('image_types');		
		echo $this->Form->input('max_upload_size', array('label'=>'Max Upload Size (Megas)'));
		echo $this->Form->input('max_image_width');
		//echo $this->Form->input('large_image_width');
		//echo $this->Form->input('large_image_height');
		//echo $this->Form->input('medium_image_width');
		//echo $this->Form->input('medium_image_height');
		echo $this->Form->input('thumb_width');
		echo $this->Form->input('thumb_height');
		//echo $this->Form->input('video_width');
		//echo $this->Form->input('video_height');
		//echo $this->Form->input('audio_width');
		//echo $this->Form->input('audio_height');
		//echo $this->Form->input('limit');
		echo $this->Form->input('paging_limit', array('label' => 'Article Paging Limit'));
		echo $this->Form->input('comment_paging_limit');
		echo $this->Form->input('minimum_year');
		echo $this->Form->input('maximum_year');
		echo $this->Form->input('google_analytics_propertyid', array('label'=>'Google Analytics Property ID','type' =>'text'));
		echo $this->Form->input('facbook_link');
		echo $this->Form->input('linkedin_link');
		echo $this->Form->input('youtube_link');
		echo $this->Form->input('twitter_link');
		echo $this->Form->input('newsletter_limit', array('label' => 'Newsletter Emails Limit Per Hour'));
		echo $this->Form->input('return_path_email');
		echo $this->Form->input('home_string');
		echo $this->Form->input('blog_string');
		echo $this->Form->input('faq_string', array('label' => 'FAQS String'));
		echo $this->Form->input('faq_fotter_string', array('label' => 'FAQS Fotter String'));
		echo $this->Form->input('article_cut_string', array('label' => 'Article Cut String Home'));
		echo $this->Form->input('article_cut_string_inner', array('label' => 'Article Cut String Inner'));
		echo $this->Form->input('testimonial_cut_string', array('label' => 'Testimonial Cut String Home'));
		echo $this->Form->input('maintenance_mode');
		echo $this->Form->input('Setting.maintenance_mode_text', array('class'=>'ckeditor'));
		echo $this->Form->input('number_of_instalments', array('type' => 'hidden'));
		echo $this->Form->input('value_for_each_installment', array('type' => 'hidden'));?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>