<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:image="http://www.sitemaps.org/schemas/sitemap-image/1.1" xmlns:video="http://www.sitemaps.org/schemas/sitemap-video/1.1">
	<url>
        <loc><?php echo Router::url('/', true); ?></loc>
        <changefreq>Daily</changefreq>
        <priority>1.0</priority>
    </url>
	<?php if(!empty($cats)){
		foreach ($cats as $key => $cat) {
			$action = 'view';
			if($cat['Cat']['id'] == 2){
				$action = 'show';
			}?>
			<url> 
				<loc><?php echo Router::url(array('controller' => 'page', 'action' => $action.'/'.$cat['Cat']['id']), true);?></loc>
				<changefreq>Daily</changefreq>
				<priority>1.0</priority>
			</url>
			<?php if(!empty($cat['Node'])){?>
				<?php foreach ($cat['Node'] as $key => $node) {?>
					<url> 
						<loc><?php echo Router::url(array('controller' => 'page', 'action' => 'view/'.$cat['Cat']['id'].'?nodeid='.$node['id']), true);?></loc>
						<changefreq>Daily</changefreq>
						<priority>1.0</priority>
					</url>
				<?php }?>
			<?php }elseif(!empty($cat['ChildCat'])){?>
				<?php foreach ($cat['ChildCat'] as $key => $childCat) {?>
					<url> 
						<loc><?php echo Router::url(array('controller' => 'page', 'action' => 'show/'.$cat['Cat']['id'].'?childid='.$childCat['id']), true);?></loc>
						<changefreq>Daily</changefreq>
						<priority>1.0</priority>
					</url>
				<?php }?>
			<?php }?>?>
		<?php }?>
	<?php }?>
	<?php if(!empty($all_cats)){?>
		<?php foreach ($all_cats as $key => $all_cat) {?>
			<?php if(!empty($all_nodes[$all_cat['Cat']['id']])){?>
				<?php foreach ($all_nodes[$all_cat['Cat']['id']] as $key => $all_node) {?>
					<url> 
						<loc><?php echo Router::url(array('controller' => 'page', 'action' => 'show/2?nodeid='.$all_node['Node']['id']), true);?></loc>
						<changefreq>Daily</changefreq>
						<priority>1.0</priority>
					</url>
				<?php }?>
			<?php }?>
		<?php }?>
	<?php }?>	
	<?php if(!empty($testimonials)){?>
		<?php foreach ($testimonials as $key => $testimonial) {?>
			<url> 
				<loc><?php echo Router::url(array('controller' => 'page', 'action' => 'view/3?nodeid=6#testimonial'.$testimonial['Testimonial']['id']), true);?></loc>
				<changefreq>Daily</changefreq>
				<priority>1.0</priority>
			</url>
		<?php }?>
	<?php }?>
	<url>
        <loc><?php echo Router::url(array('controller' => 'article', 'action' => 'all'), true);?></loc>
        <changefreq>Daily</changefreq>
        <priority>1.0</priority>
    </url>
    <?php if(!empty($articles)){?>
		<?php foreach ($articles as $key => $article) {?>
			<url> 
				<loc><?php echo Router::url(array('controller' => 'article', 'action' => 'item/'.$article['Article']['id']), true);?></loc>
				<changefreq>Daily</changefreq>
				<priority>1.0</priority>
			</url>
		<?php }?>
	<?php }?>
	<?php if(!empty($all_tags)){?>
		<?php foreach ($all_tags as $key => $all_tag) {?>
			<url> 
				<loc><?php echo Router::url(array('controller' => 'article', 'action' => 'all/'.trim($all_tag)), true);?></loc>
				<changefreq>Daily</changefreq>
				<priority>1.0</priority>
			</url>
		<?php }?>
	<?php }?>			
	<url>
        <loc><?php echo Router::url(array('controller' => 'faq'), true);?></loc>
        <changefreq>Daily</changefreq>
        <priority>1.0</priority>
    </url>
    <url>
        <loc><?php echo Router::url(array('controller' => 'contact-us'), true);?></loc>
        <changefreq>Daily</changefreq>
        <priority>1.0</priority>
    </url>
	<?php /*if( isset($statics) && !empty($statics) ){
	    foreach ($statics as $static){?>
	    <url> 
	        <loc><?php echo Router::url($static['url'], true); ?></loc> 
	        <changefreq><?php echo $static['options']['changefreq'] ?></changefreq>
	        <priority><?php echo $static['options']['pr'] ?></priority>
	    </url>
	<?php }
	}*/?>
	<?php /*
	 $sections = $this->requestAction(array('controller'=>'main', 'action'=>'getHederMenu'));
	 foreach($sections as $section){
						//in case of section without cats
						if(empty($section['Cat'])){
							?>
	                        <url> 
	        <loc><?php echo Router::url(array(
	                                          'controller' => 'news', 
	                                          'action' => 'display/articles/secId:'.$section['Section']['id']
	                                          ), true); ?></loc>        
	        <changefreq>weekly</changefreq>
	        <priority>1.0</priority>
	    </url>
							
					<?	}
						//in case of section with cats	
						else{
							foreach($section['Cat'] as $cat){
							?>
	                            <url> 
	        <loc><?php echo Router::url(array(
	                                          'controller' => 'news', 
	                                          'action' => 'display/articles/secId:'.$section['Section']['id'].'/catId:'.$cat['id']
	                                          ), true); ?></loc>         
	        <changefreq>weekly</changefreq>
	        <priority>1.0</priority>
	    </url>
	                        <?
							}}}
	 
	if( isset($dynamics) && !empty($dynamics) ){
	    foreach ($dynamics as $dynamic){?> 
	   
	    <?php foreach ($dynamic['data'] as $section){
		if($section[$dynamic['model']][$dynamic['options']['fields']['cat_id']]!=0)
											$cat_id = '/catId:'.$section[$dynamic['model']][$dynamic['options']['fields']['cat_id']];
											else
											$cat_id='';
		?> 
	    <url> 
	        <loc><?php echo Router::url(array(
	                                          'controller' => $dynamic['options']['url']['controller'], 
	                                          'action' => $dynamic['options']['url']['action'].$section[$dynamic['model']][$dynamic['options']['fields']['id']].'/'.$this->element('front'.DS.'clean_url',  array('text'=> $section[$dynamic['model']][$dynamic['options']['fields']['title']])).'/secId:'. $section[$dynamic['model']][$dynamic['options']['fields']['section_id']].$cat_id
	                                          ), true); ?></loc>        
	        <changefreq><?php echo $dynamic['options']['changefreq'] ?></changefreq>
	        <priority><?php echo $dynamic['options']['pr'] ?></priority> 
	    </url> 
	    <?php }
		}
	} */?> 
</urlset>