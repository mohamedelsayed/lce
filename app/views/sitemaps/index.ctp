<?php
$this->pageTitle = 'Sitemap';
?>
<h1>Sitemap</h1>

<table cellpadding="0" cellspacing="0">
<?php if(isset($statics) && !empty($statics) ){?>
    <tr>
		<td class="title"></td>
	</tr>
    <?php foreach ($statics as $static){ ?>
    <tr>
		<td>
        <?php echo $html->link($static['title'], $static['url']); ?>
        </td>
	</tr>
    <?php }?>
    <tr>
		<td class="clear">&nbsp;</td>
	</tr>
<?php } ?> 

<?php /*
if( isset($dynamics) && !empty($dynamics) ){
    foreach ($dynamics as $dynamic){ ?>
    
    <?php
	//print_r($dynamic['data']); 
	foreach ($dynamic['data'] as $section){?>
    <?php  
	//echo $section['Article']['cat_id'];
									  if($section[$dynamic['model']][$dynamic['options']['fields']['cat_id']]!=0)
										$cat_id = '/catId:'.$section[$dynamic['model']][$dynamic['options']['fields']['cat_id']];
										else
										$cat_id='';
									  ?>
    <tr>
		<td>
        > <?php
		
		 echo $html->link(
                              $section[$dynamic['model']][$dynamic['options']['fields']['title']],
                               array(
                                          'controller' => $dynamic['options']['url']['controller'], 
                                          'action' => $dynamic['options']['url']['action'].$section[$dynamic['model']][$dynamic['options']['fields']['id']].'/'.$this->element('front'.DS.'clean_url',  array('text'=> $section[$dynamic['model']][$dynamic['options']['fields']['title']])).'/secId:'. $section[$dynamic['model']][$dynamic['options']['fields']['section_id']].$cat_id
                                          ) ); ?>
        </td>
	</tr>
    <?php }?>
    <tr>
		<td class="clear">&nbsp;</td>
	</tr>
<?php
	}
}
*/?>
  
</table>
