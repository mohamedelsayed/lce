<?php
/**
 * Sitemap Deluxe v1.0 Beta
 *
 * by Cristian Deluxe http://www.cristiandeluxe.com // http://blog.cristiandeluxe.com
 * 
 * Licenced by a Creative Commons GNU LGPL license
 * http://creativecommons.org/license/cc-lgpl
 *
 * @copyright     Copyright 2008-2009, Cristian Deluxe (http://www.cristiandeluxe.com)
 * @link          http://bakery.cakephp.org/articles/view/sitemap-deluxe
 */
class SitemapsController extends AppController {
	public $name = 'Sitemaps';
	public $helpers = array ('Time', 'Xml', 'Javascript' );
	public $components = array ('RequestHandler' );
	public $uses = array ( );
	//public $array_dynamic = array ( );
	//public $array_static = array ( );
	//public $sitemap_url = '/newsitemap.xml';
	//public $yahoo_key = 'insert your yahoo api key here';
	
	/* 
     * Our sitemap 
     */
	function index() {
		// Configure::write('debug', 0);        
		$this->loadModel('Cat');
		$cats = $this->Cat->find(
			'all', array(
				//'fields'     => array('Article.id', 'Article.tags'),
				'conditions' => array('Cat.approved' => 1, 'Cat.parent_id' => null),
				'order' => array('Cat.weight' => 'ASC','Cat.id'=>'DESC'),
				'limit' => 3
			)	  	 	
		);	
		$this->set('cats',$cats);		
		$cat_id = 2;
		$all_cats = $this->Cat->find(
			'all', array(
				'conditions' => array('Cat.approved' => 1, 'Cat.parent_id' => $cat_id),
				'order' => array('Cat.weight' => 'ASC','Cat.id'=>'DESC')
			)	  	 	
		);		
		$this->set('all_cats' , $all_cats);
		$this->loadModel('Node');
		$all_nodes = array();
		foreach ($all_cats as $key => $all_cat) {
			$all_nodes[$all_cat['Cat']['id']] = $this->Node->find(
				'all', array(
					'conditions' => array('Node.approved' => 1,'Node.cat_id' => $all_cat['Cat']['id']),
					'order' => array('Node.weight' => 'ASC','Node.id'=>'DESC')
				)	  	 	
			);
						
		}		
		$this->set('all_nodes' , $all_nodes);
		$this->loadModel('Testimonial');
		$testimonials = $this->Testimonial->find(
			'all', array(
				'conditions' => array('Testimonial.approved' => 1, 'Testimonial.featured' => 1),
				//'order' => array('Testimonial.id'=>'DESC'),
				'order' => array('Testimonial.id'=>'DESC'),
				//'limit' => 5
			)	  	 	
		);
		$this->set('testimonials' , $testimonials);
		$this->loadModel('Article');
		$articles = $this->Article->find(
			'all', array(
				'conditions' => array('Article.approved' => 1, 'Article.featured' => 1),
				'order' => array('Article.id'=>'DESC'),
				//'limit' => 4
			)	  	 	
		);
		$this->set('articles' , $articles);
		if ($this->RequestHandler->accepts ( 'html' )) {
			$this->RequestHandler->respondAs ( 'html' );
		} elseif ($this->RequestHandler->accepts ( 'xml' )) {
			$this->RequestHandler->respondAs ( 'xml' );
		}
	}
	
	/* 
     * Action for send sitemaps to search engines
     */
	function send_sitemap() {
		// This action must be only for admins
	}
	
	/* 
     * This make a simple robot.txt file use it if you don't have your own
     */
	function robot() {
		Configure::write ( 'debug', 2 );
		//  echo  Router::url(array('controller' => 'news'), true); 
		$expire = 25920000;
		header ( 'Date: ' . date ( "D, j M Y G:i:s ", time () ) . ' GMT' );
		header ( 'Expires: ' . gmdate ( "D, d M Y H:i:s", time () + $expire ) . ' GMT' );
		header ( 'Content-Type: text/plain' );
		header ( 'Cache-Control: max-age=' . $expire . ', s-maxage=' . $expire . ', must-revalidate, proxy-revalidate' );
		header ( 'Pragma: nocache' );
		echo 'User-Agent: *' . "\n" . 'Allow: /' . "\n" . 'Sitemap: ' . FULL_BASE_URL . $this->sitemap_url;
		exit ();
	}
	
	/* 
     * Add a "static" section
     */
	function __add_static_section($title = null, $url = null, $options = null) {
		if (is_null ( $title ) || empty ( $title ) || is_null ( $url ) || empty ( $url )) {
			return false;
		}
		$defaultoptions = array ('pr' => '0.5', // Valid values range from 0.0 to 1.0
'changefreq' => 'monthly' )// Possible values: always, hourly, daily, weekly, monthly, yearly, never
;
		$options = array_merge ( $defaultoptions, $options );
		$this->array_static [] = array ('title' => $title, 'url' => $url, 'options' => $options );
	}
	
	/* 
     * Add a section based on data from our database
     */
	function __add_dynamic_section($model = null, $data = null, $options = null) {
		if (is_null ( $model ) || empty ( $model ) || is_null ( $data ) || empty ( $data )) {
			return false;
		}
		$defaultoptions = array ('fields' => array ('id' => 'id', 'date' => 'modified', 'title' => 'title' ), 'controllertitle' => 'not set', 'pr' => '0.5', // Valid values range from 0.0 to 1.0
'changefreq' => 'monthly', // Possible values: always, hourly, daily, weekly, monthly, yearly, never
'url' => array ('controller' => false, 'action' => false, 'index' => 'index' ) );
		$options = array_merge ( $defaultoptions, $options );
		$options ['fields'] = array_merge ( $defaultoptions ['fields'], $options ['fields'] );
		$options ['url'] = array_merge ( $defaultoptions ['url'], $options ['url'] );
		if ($options ['fields'] ['date'] == false) {
			$options ['fields'] ['date'] = time ();
		}
		$this->array_dynamic [] = array ('model' => $model, 'options' => $options, 'data' => $data );
	}
	
	/* 
     * This make a GET petition to search engine url
     */
	function __ping_site($url = null, $params = null) {
		if (is_null ( $url ) || empty ( $url ) || is_null ( $params ) || empty ( $params )) {
			return false;
		}
		App::import ( 'Core', 'HttpSocket' );
		$HttpSocket = new HttpSocket ( );
		$html = $HttpSocket->get ( $url, $params );
		return $HttpSocket->response;
	}
	
	/* 
     * Show response for ajax based on a boolean result
     */
	function __ajaxresponse($result = false) {
		if (! $result) {
			return 'fail';
		}
		return 'success';
	}
	
	/* 
     * Function for ping Google
     */
	function ping_google() {
		Configure::write ( 'debug', 0 );
		$url = 'http://www.google.com/webmasters/tools/ping';
		$params = 'sitemap=' . urlencode ( FULL_BASE_URL . $this->sitemap_url );
		echo $this->__ajaxresponse ( $this->__check_ok_google ( $this->__ping_site ( $url, $params ) ) );
		exit ();
	}
	
	/* 
     * Function for check Google's response
     */
	function __check_ok_google($response = null) {
		if (is_null ( $response ) || ! is_array ( $response ) || empty ( $response )) {
			return false;
		}
		if (isset ( $response ['status'] ['code'] ) && $response ['status'] ['code'] == '200' && isset ( $response ['status'] ['reason-phrase'] ) && $response ['status'] ['reason-phrase'] == 'OK' && isset ( $response ['body'] ) && ! empty ( $response ['body'] ) && strpos ( strtolower ( $response ['body'] ), "successfully added" ) != false) {
			return true;
		}
		return false;
	}
	
	/* 
     * Function for ping Ask.com
     */
	function ping_ask() { // fail if we are in local environment
		Configure::write ( 'debug', 0 );
		$url = 'http://submissions.ask.com/ping';
		$params = 'sitemap=' . urlencode ( FULL_BASE_URL . $this->sitemap_url );
		echo $this->__ajaxresponse ( $this->__check_ok_ask ( $this->__ping_site ( $url, $params ) ) );
		exit ();
	}
	
	/* 
     * Function for check Ask's response
     */
	function __check_ok_ask($response = null) {
		if (is_null ( $response ) || ! is_array ( $response ) || empty ( $response )) {
			return false;
		}
		if (isset ( $response ['status'] ['code'] ) && $response ['status'] ['code'] == '200' && isset ( $response ['status'] ['reason-phrase'] ) && $response ['status'] ['reason-phrase'] == 'OK' && isset ( $response ['body'] ) && ! empty ( $response ['body'] ) && strpos ( strtolower ( $response ['body'] ), "has been successfully received and added" ) != false) {
			return true;
		}
		return false;
	}
	
	/* 
     * Function for ping Yahoo
     */
	function ping_yahoo() {
		Configure::write ( 'debug', 0 );
		$url = 'http://search.yahooapis.com/SiteExplorerService/V1/updateNotification';
		$params = 'appid=' . $this->yahoo_key . '&url=' . urlencode ( FULL_BASE_URL . $this->sitemap_url );
		echo $this->__ajaxresponse ( $this->__check_ok_yahoo ( $this->__ping_site ( $url, $params ) ) );
		exit ();
	}
	
	/* 
     * Function for check Yahoo's response
     */
	function __check_ok_yahoo($response = null) {
		if (is_null ( $response ) || ! is_array ( $response ) || empty ( $response )) {
			return false;
		}
		if (isset ( $response ['status'] ['code'] ) && $response ['status'] ['code'] == '200' && isset ( $response ['status'] ['reason-phrase'] ) && $response ['status'] ['reason-phrase'] == 'OK' && isset ( $response ['body'] ) && ! empty ( $response ['body'] ) && strpos ( strtolower ( $response ['body'] ), "successfully submitted" ) != false) {
			return true;
		}
		return false;
	}
	
	/* 
     * Function for ping Bing
     */
	function ping_bing() {
		Configure::write ( 'debug', 0 );
		$url = 'http://www.bing.com/webmaster/ping.aspx';
		$params = '&siteMap=' . urlencode ( FULL_BASE_URL . $this->sitemap_url );
		echo $this->__ajaxresponse ( $this->__check_ok_bing ( $this->__ping_site ( $url, $params ) ) );
		exit ();
	}
	
	/* 
     * Function for check Bing's response
     */
	function __check_ok_bing($response = null) {
		if (is_null ( $response ) || ! is_array ( $response ) || empty ( $response )) {
			return false;
		}
		if (isset ( $response ['status'] ['code'] ) && $response ['status'] ['code'] == '200' && isset ( $response ['status'] ['reason-phrase'] ) && $response ['status'] ['reason-phrase'] == 'OK' && isset ( $response ['body'] ) && ! empty ( $response ['body'] ) && strpos ( strtolower ( $response ['body'] ), "thanks for submitting your sitemap" ) != false) {
			return true;
		}
		return false;
	}
	
	/* this function was created to make XML Sitemap ever using Cron jobs
	 * I put variable key with random value so no one can call it except Cron jobs that contain that key
	 * @author Author "Mohamed Elsayed"
	 * @author Author Email "me@mohamedelsayed.net"
     * @copyright Copyright (c) 2014 Programming by "mohamedelsayed.net"
     */
	function writeToSitemap($key=null) {
		if($key=='hrpz3wuvkvhtmkchcsadw6pae'){	      
		$this->__get_data ();
		$dynamics = $this->array_dynamic;
		$statics =  $this->array_static;				
			$xmlData = '<?xml version="1.0" encoding="UTF-8"?>
						<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
				        xmlns:image="http://www.google.com/schemas/sitemap-image/1.1"
				        xmlns:video="http://www.google.com/schemas/sitemap-video/1.1">
				        <url>
							<loc>'.Router::url('/', true).'</loc>
							<changefreq>Daily</changefreq>
							<priority>1.0</priority>
						</url>
						';
			//$statics = $this->requestAction(array('controller'=>'sitemaps', 'action'=>'getSitemapItems'));
			if( isset($statics) && !empty($statics) ){
			    foreach ($statics as $static){
			    	$xmlData.= '<url>
									<loc>'.Router::url($static['url'], true).'</loc>
									<changefreq>'.$static['options']['changefreq'].'</changefreq>
									<priority>'.$static['options']['pr'].'</priority>
								</url>
								';
			 	}
			}				
			$xmlData.= '
			</urlset>';		  	
			$xmlFile = fopen(WWW_ROOT.'/newsitemap.xml', 'w');
			fwrite($xmlFile, $xmlData);
			fclose($xmlFile);
			echo 'Sitemap was created successfully';
			//return;					
		}
		else {
			echo 'Wrong key!';
		}
		$this->autoRender = false;
	}
}
?>