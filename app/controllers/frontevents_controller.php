<?php
/**
 * @author Author "Mohamed Elsayed"  
 * @author Author Email "me@mohamedelsayed.net"
 * @copyright Copyright (c) 2016 Programming by "mohamedelsayed.net"
 */
class FronteventsController  extends AppController {
	var $name = 'Frontevents';
	var $uses = 'Nevent';
	var $components = array('Email');
	function events(){
		$this->set('title_for_layout' , 'All Events');	
		$this->set('selected', 'frontevents');
		$year = isset($_GET['year'])?$_GET['year']:date("Y");
		$month = isset($_GET['month'])?$_GET['month']:date("m");
		$events = $this->Nevent->find('all', array(
            'conditions' => array(
                'AND' => array(
                    'OR' => array(
                        array('AND' => array(
                                'YEAR(Nevent.start_date) = '.$year,
                                'MONTH(Nevent.start_date) = '.$month
                            )
                        ),                          
                    )
                ),                             
            ),
            'order' => array('Nevent.start_date'=>'ASC','Nevent.id'=>'DESC'),
        ));	
        $this->set('events' , $events);
	}
	function get_instructor($id = 0){
        $data = '';
        if($id != 0){
        	$this->loadModel('Instructor');
            $instructor = $this->Instructor->find(
                'first', array(
                    'conditions' => array('Instructor.approved' => 1, 'Instructor.id' => $id),
                )           
            );
            if(!empty($instructor)){
            	$default_user_image = BASE_URL.$this->default_user_image;			
				$image = $default_user_image;
				$style = '';
            	if(trim($instructor['Instructor']['image']) != ''){
            		$div_ratio = 200/200;
            		$img = $instructor['Instructor']['image'];
	            	$image = BASE_URL.'/img/upload/'.$img;     					     
	                $image_path = WWW_ROOT.'img'.DS.'upload'.DS.$img;    
					$max_height = 'max-height:100%;';
	                $max_width  = 'max-width:100%;';
	                $style = $max_width;
					if (file_exists($image_path)) { 
		                $image_size = getimagesize($image_path);          		                
		                if(!empty($image_size)){
		                    $width = $image_size[0];
		                    $height = $image_size[1];   
		                    $image_ratio = $width/$height;
		                    if($image_ratio > $div_ratio){                  
		                        $style = $max_height;
		                    }
		                }
					}else{
						$image = $default_user_image;
					}
				}
				$mail = $instructor['Instructor']['mail'];
				$facebook = $instructor['Instructor']['facebook'];
				$linkedin = $instructor['Instructor']['linkedin'];
                $data .= '<h4 style="">'.$instructor['Instructor']['name'].
                	     '<div id="closeinstructorpopoup" class="closeinstructorpopoup closepopoup">X</div></h4>';
				$data .= '<div class="instructorpopoupbody">';
				if($image != ''){
                    $data .= '<div class="instructorpopouphead instructorpopoupheadimg">
                    	<img style="'.$style.'" src="'.$image.'"/>
                    </div>';
                }				
				$data .= '<div class="instructorpopouphead instructorpopoupposition">';
				//$data .= '<div class="instructorpopouppositionin">Position:</div>';
				$data .= '<div class="instructorpopoupcontent instructorpopouppositioninright">'.$instructor['Instructor']['position'].'</div>
				</div>';
				if(trim($mail) != ''){
					$data .= '<div class="instructorpopouphead instructorpopoupmail">						
						<div class="instructorpopoupcontent instructorpopoucenter"><a href="mailto:'.$mail.'"><i class="icon-mail"></i>'.$mail.'</a></div>
					</div>';
				}
				if(trim($facebook) != ''){
					$data .= '<div class="instructorpopouphead instructorpopoupfacebook">						
						<div class="instructorpopoupcontent instructorpopoucenter"><a target="_blank" href="'.$facebook.'"><i class="icon-facebook"></i>'.$this->remove_facebook_linkedin_string($facebook).'</a></div>
					</div>';
				}
				if(trim($linkedin) != ''){
					$data .= '<div class="instructorpopouphead instructorpopouplinkedin">						
						<div class="instructorpopoupcontent instructorpopoucenter"><a target="_blank" href="'.$linkedin.'"><i class="icon-linkedin"></i>'.$this->remove_facebook_linkedin_string($linkedin).'</a></div>
					</div>';
				}
				$data .= '<div class="instructorpopouphead instructorpopoupbiography"><div class="instructorpopoupcontent instructorpopoupbiographybody">'.$instructor['Instructor']['biography'].'</div></div>';                
                $data .= '</div>';
            }
        }
        echo $data;     
        $this->autoRender = false;          
    }	
	function get_event($id = 0){
        $data = '';
        if($id != 0){
        	$this->loadModel('Nevent');
            $event = $this->Nevent->find(
                'first', array(
                    'conditions' => array('Nevent.approved' => 1, 'Nevent.id' => $id),
                )           
            );
            if(!empty($event)){
            	$arab_african_image = BASE_URL.'/img/front/arab_african_intl_bank.jpg';
            	$model = 'Nevent';
				$model2 = 'Instructor'; 
				$title = $event[$model]['title'];
				$description = $event[$model]['description'];
				$location = $event[$model]['location'];
				$ticket_price = $event[$model]['ticket_price'];
				$instructor_id = $event[$model]['instructor_id'];
				$instructor_name = $event[$model2]['name'];
				$date = date('F d, Y', strtotime($event[$model]['start_date']));
				$time_from = date('g:i a', strtotime($event[$model]['time_from']));
				$time_to = date('g:i a', strtotime($event[$model]['time_to']));
				$duration = $event[$model]['duration'];		
				$number_of_participants = $event[$model]['number_of_participants'];
				$all_date = $date;
				if($duration > 1){
					$all_date .= ' '.$duration.' Days';
				}
				$all_date .= ' <br />'.$time_from.' to '.$time_to;           
                $data .= '<h4 style="">CHECKOUT'.
                	     '<div id="closeinstructorpopoup" class="closeinstructorpopoup closepopoup">X</div></h4>';
				$data .= '<div class="instructorpopoupbody">';
				$data .= '<div class="instructorpopouptitle">'.$title.'</div>';
				$data .= '<div class="event_popup_location"><i class="icon-location"></i>'.$location.'</div>';
				$data .= '<div class="event_popup_ticket_price"><i class="icon-ticket_price"></i>'.$ticket_price.' '.$this->currency.'</div>';
				$data .= '<div class="full_line"></div>';
				$data .= '<div class="event_popup_instructor_name"><i class="icon-instructor_name"></i>'.$instructor_name.'</div>';
				$data .= '<div class="event_popup_all_date"><i class="icon-all_date_popup"></i>'.$all_date.'</div>';
				$data .= '<div class="event_popup_ticket_price_all"><div class="event_popup_ticket_price_all_in">Total Price: </div>'.$ticket_price.' '.$this->currency.'</div>';              
				$data .= '<div class="event_popup_arab_african"><img src="'.$arab_african_image.'" /></div>';  
				$data .= '<div class="checkout_button_out"><div class="checkout_button checkout_event" onclick="checkout_event('.$event[$model]['id'].');">checkout</div></div>';
                $data .= '</div>';
            }
        }
		$return['html'] = $data;
		$sql="SELECT SUM(tickets_number) as sum_tickets_number FROM `nevents_orders`
		WHERE event_id = ".$id."";                          
        $temp = $this->Nevent->query($sql);
		$sum_tickets_number = 0;
		if(isset($temp[0][0]['sum_tickets_number'])){
			$sum_tickets_number = $temp[0][0]['sum_tickets_number'];
		}
		$return['number_of_participants'] = $number_of_participants - $sum_tickets_number;
		$return['ticket_price'] = $ticket_price;
		echo json_encode($return);
        $this->autoRender = false;          
    }
	function vpc_php_serverhost_do(){
		$SECURE_SECRET = $this->payment_hash_secret;
		$event_id = 0;
		if(isset($_POST['event_id'])){
			$event_id = $_POST['event_id'];			
		}
		if($event_id > 0 && is_numeric($event_id)){
			$event_amount = 0;
			$event = $this->Nevent->find(
                'first', array(
                    'conditions' => array('Nevent.approved' => 1, 'Nevent.id' => $event_id),
                )           
            );
            $model = 'Nevent';
			if(isset($event[$model]['ticket_price'])){
				$event_amount = $event[$model]['ticket_price'];
				$title = $event[$model]['title'];
			}
			if($event_amount > 0 && is_numeric($event_amount)){
				unset($_POST['terms_and_conditions']);
				//$_POST["Title"] = $title;
				$_POST["virtualPaymentClientURL"] = 'https://migs.mastercard.com.au/vpcpay';
				$_POST["vpc_Version"] = '1';
				$_POST["vpc_Command"] = 'pay';
				$_POST["vpc_OrderInfo"] = $event_id.'-event'.time();					
				$vpcURL = $_POST["virtualPaymentClientURL"] . "?";
				unset($_POST["virtualPaymentClientURL"]); 
				unset($_POST["SubButL"]);
				$md5HashData = $SECURE_SECRET;
				$_POST["vpc_Locale"] = 'en';
				$_POST["vpc_Merchant"] = $this->payment_merchant_id;
				$_POST["vpc_AccessCode"] = $this->payment_access_code;
				$_POST["vpc_MerchTxnRef"] = $event_id.time();
				$_POST["vpc_Amount"] = $event_amount * $_POST['tickets_number'] * 100;
				$_POST["vpc_ReturnURL"] = BASE_URL.'/return-transaction?event_id='.$event_id;	 
				ksort ($_POST);		
				// set a parameter to show the first pair in the URL
				$appendAmp = 0;		
				foreach($_POST as $key => $value) {		
				    // create the md5 input and URL leaving out any fields that have no value
				    if (strlen($value) > 0) {		        
				        // this ensures the first paramter of the URL is preceded by the '?' char
				        if ($appendAmp == 0) {
				            $vpcURL .= urlencode($key) . '=' . urlencode($value);
				            $appendAmp = 1;
				        } else {
				            $vpcURL .= '&' . urlencode($key) . "=" . urlencode($value);
				        }
				        $md5HashData .= $value;
				    }
				}		
				// Create the secure hash and append it to the Virtual Payment Client Data if
				// the merchant secret has been provided.
				if (strlen($SECURE_SECRET) > 0) {
				    $vpcURL .= "&vpc_SecureHash=" . strtoupper(md5($md5HashData));
				}		
				// FINISH TRANSACTION - Redirect the customers using the Digital Order
				// ===================================================================
				header("Location: ".$vpcURL);		
			}else{
				$this->layout = 'error';
				//header("Location: ".BASE_URL);				
			}
		}else{
			$this->layout = 'error';
			//header("Location: ".BASE_URL);				
		}
	}
	function return_transaction(){
		$custom_error_flag = 1;
		$custom_message = 'Error';
		$amount = 0;			
		$title = '';
		$location = '';
		$ticket_price = '';
		$instructor_id = 0;
		$instructor_name = '';
		$all_date = '';
		$this->set('selected', 'frontevents');
		$SECURE_SECRET = $this->payment_hash_secret;
		$vpc_Txn_Secure_Hash = $_GET["vpc_SecureHash"];
		unset($_GET["vpc_SecureHash"]); 				
		// set a flag to indicate if hash has been validated
		$errorExists = false;		
		if (strlen($SECURE_SECRET) > 0 && $_GET["vpc_TxnResponseCode"] != "7" && $_GET["vpc_TxnResponseCode"] != "No Value Returned") {		
		    $md5HashData = $SECURE_SECRET;		
		    // sort all the incoming vpc response fields and leave out any with no value
		    foreach($_GET as $key => $value) {
		        if ($key != "vpc_SecureHash" or strlen($value) > 0) {
		            $md5HashData .= $value;
		        }
		    }		    
		    // Validate the Secure Hash (remember MD5 hashes are not case sensitive)
			// This is just one way of displaying the result of checking the hash.
			// In production, you would work out your own way of presenting the result.
			// The hash check is all about detecting if the data has changed in transit.
		    if (strtoupper($vpc_Txn_Secure_Hash) == strtoupper(md5($md5HashData))) {
		        // Secure Hash validation succeeded, add a data field to be displayed
		        // later.
		        $hashValidated = "<FONT color='#00AA00'><strong>CORRECT</strong></FONT>";
		    } else {
		        // Secure Hash validation failed, add a data field to be displayed
		        // later.
		        $hashValidated = "<FONT color='#FF0066'><strong>INVALID HASH</strong></FONT>";
		        $errorExists = true;
		    }
		} else {
		    // Secure Hash was not validated, add a data field to be displayed later.
		    $hashValidated = "<FONT color='orange'><strong>Not Calculated - No 'SECURE_SECRET' present.</strong></FONT>";
		}		
		// Define Variables
		// ----------------
		// Extract the available receipt fields from the VPC Response
		// If not present then let the value be equal to 'No Value Returned'		
		// Standard Receipt Data
		$amount          = $this->null2unknown($_GET["vpc_Amount"]);
		$locale          = $this->null2unknown($_GET["vpc_Locale"]);
		$batchNo         = $this->null2unknown($_GET["vpc_BatchNo"]);
		$command         = $this->null2unknown($_GET["vpc_Command"]);
		$message         = $this->null2unknown($_GET["vpc_Message"]);
		$version         = $this->null2unknown($_GET["vpc_Version"]);
		$cardType        = $this->null2unknown($_GET["vpc_Card"]);
		//$orderInfo       = $this->null2unknown($_GET["vpc_OrderInfo"]);
		$receiptNo       = $this->null2unknown($_GET["vpc_ReceiptNo"]);
		$merchantID      = $this->null2unknown($_GET["vpc_Merchant"]);
		$authorizeID     = $this->null2unknown($_GET["vpc_AuthorizeId"]);
		$merchTxnRef     = $this->null2unknown($_GET["vpc_MerchTxnRef"]);
		$transactionNo   = $this->null2unknown($_GET["vpc_TransactionNo"]);
		$acqResponseCode = $this->null2unknown($_GET["vpc_AcqResponseCode"]);
		$txnResponseCode = $this->null2unknown($_GET["vpc_TxnResponseCode"]);
		// 3-D Secure Data
		$verType         = array_key_exists("vpc_VerType", $_GET)          ? $_GET["vpc_VerType"]          : "No Value Returned";
		$verStatus       = array_key_exists("vpc_VerStatus", $_GET)        ? $_GET["vpc_VerStatus"]        : "No Value Returned";
		$token           = array_key_exists("vpc_VerToken", $_GET)         ? $_GET["vpc_VerToken"]         : "No Value Returned";
		$verSecurLevel   = array_key_exists("vpc_VerSecurityLevel", $_GET) ? $_GET["vpc_VerSecurityLevel"] : "No Value Returned";
		$enrolled        = array_key_exists("vpc_3DSenrolled", $_GET)      ? $_GET["vpc_3DSenrolled"]      : "No Value Returned";
		$xid             = array_key_exists("vpc_3DSXID", $_GET)           ? $_GET["vpc_3DSXID"]           : "No Value Returned";
		$acqECI          = array_key_exists("vpc_3DSECI", $_GET)           ? $_GET["vpc_3DSECI"]           : "No Value Returned";
		$authStatus      = array_key_exists("vpc_3DSstatus", $_GET)        ? $_GET["vpc_3DSstatus"]        : "No Value Returned";		
		// *******************
		// END OF MAIN PROGRAM
		// *******************		
		// FINISH TRANSACTION - Process the VPC Response Data
		// =====================================================
		// For the purposes of demonstration, we simply display the Result fields on a
		// web page.		
		// Show 'Error' in title if an error condition
		$errorTxt = "";		
		// Show this page as an error page if vpc_TxnResponseCode equals '7'
		if ($txnResponseCode == "7" || $txnResponseCode == "No Value Returned" || $errorExists) {
		    $errorTxt = "Error ";
		}		    
		// This is the display title for 'Receipt' page 
		//$title = $_GET["Title"];
		$event_id = 0;
		if(isset($_GET['event_id'])){
			$event_id = $_GET['event_id'];			
		}		
		if($event_id > 0 && is_numeric($event_id)){
			$event = $this->Nevent->find(
                'first', array(
                    'conditions' => array('Nevent.approved' => 1, 'Nevent.id' => $event_id),
                )           
            );
            $model = 'Nevent';	
			$model2 = 'Instructor'; 	
			if(!empty($event)){	
				$title = $event[$model]['title'];
				$location = $event[$model]['location'];
				$ticket_price = $event[$model]['ticket_price'];
				$instructor_id = $event[$model]['instructor_id'];
				$instructor_name = $event[$model2]['name'];
				$date = date('F d, Y', strtotime($event[$model]['start_date']));
				$time_from = date('g:i a', strtotime($event[$model]['time_from']));
				$time_to = date('g:i a', strtotime($event[$model]['time_to']));
				$duration = $event[$model]['duration'];		
				$all_date = $date;
				if($duration > 1){
					$all_date .= ' '.$duration.' Days';
				}
				$all_date .= ' <br />'.$time_from.' to '.$time_to;          
			} 
			if($txnResponseCode == 0){
				$custom_error_flag = 0;
				$custom_message = 'successful transaction';
			}else{
				$custom_error_flag = 1;
				$custom_message = $this->getResponseDescription($txnResponseCode);
			}
			$name = '';
			if(isset($_GET['name'])){
				$name = $_GET['name'];
			}
			$email = '';
			if(isset($_GET['email'])){
				$email = $_GET['email'];
			}
			$mobile_number = '';
			if(isset($_GET['mobile_number'])){
				$mobile_number = $_GET['mobile_number'];
			}
			$tickets_number = 1;
			if(isset($_GET['tickets_number'])){
				$tickets_number = $_GET['tickets_number'];
			}		
			$amount = $amount / 100;
			$model = 'NeventOrder';
			$this->loadModel($model);
			$order = $this->$model->find(
                'first', array(
                    'conditions' => array($model.'.transaction_number' => $transactionNo),
                )           
            );
			if(empty($order)){
				$data = array(
				    $model => array(
				        'name' => $name,
				        'email' => $email,
				        'mobile_number' => $mobile_number,
				        'receipt_number' => $receiptNo,
				        'transaction_number' => $transactionNo,
				        'event_id' => $event_id,
				        'amount' => $amount,	
				        'tickets_number' => $tickets_number,		        
				    )
				);
				$this->$model->create();
				$this->$model->save($data);		
				$this->loadModel('Setting');            
            	$settings = $this->Setting->read(null, 1);              
            	$subject = $title.' Checkout';
	            $this->Email->to = $email;
				$this->Email->subject = $subject;           
            	$this->Email->replyTo = $settings['Setting']['email'];
	            $this->Email->from = $settings['Setting']['title'].'<'.$settings['Setting']['email'].'>';                
	            $this->Email->sendAs = 'html';
				$mail_body = 'This is confirmation e-mail that you have checkout in  '.$title.' Event,<br />
							  Your transaction number: '.$transactionNo.',<br />
							  Total paid amount: '.$amount.' '.$this->currency.'.<br />'.
							  'Number of Tickets: '.$tickets_number.'.';
				$this->Email->template = 'event_customer';
				$this->set('mail_body', $mail_body);
				if ($this->Email->send()){
	                //echo __('Email has been sent.', true);
    	        }
				$subject = $title.' Checkout';
	            $this->Email->to = $settings['Setting']['email'];
				$this->Email->subject = $subject;           
            	$this->Email->replyTo = $settings['Setting']['email'];
	            $this->Email->from = $settings['Setting']['title'].'<'.$settings['Setting']['email'].'>';                
	            $this->Email->sendAs = 'html';
				$data2 = array(
					array('Name', $name),
			        array('Email', $email),
			        array('Mobile Number', $mobile_number),
			        array('Receipt Number', $receiptNo),
			        array('Transaction Number', $transactionNo),
			        //array('Event id', $event_id),
			        array('Amount', $amount.' '.$this->currency),
			        array('Number of Tickets', $tickets_number),			        
				);
				$html = $this->draw_array_as_table($data2);
				$mail_body = 'This is checkout in  '.$title.' Event,<br />
							  User information:'.$html;
				$this->Email->template = 'event_site_admin';
				$this->set('mail_body', $mail_body);
				if ($this->Email->send()){
	                //echo __('Email has been sent.', true);
    	        }
			}
		}
		$this->set('custom_message' , $custom_message);
		$this->set('custom_error_flag' , $custom_error_flag);
		$this->set('amount' , $amount);
		$this->set('title' , $title);
		$this->set('location' , $location);
		$this->set('ticket_price' , $ticket_price);
		$this->set('instructor_id' , $instructor_id);
		$this->set('instructor_name' , $instructor_name);
		$this->set('all_date' , $all_date);		
		$this->set('title_for_layout' , strtoupper($custom_message));		
	}
	function null2unknown($data) {
	    if ($data == "") {
	        return "No Value Returned";
	    } else {
	        return $data;
	    }
	} 
	function getResponseDescription($responseCode) {
	    switch ($responseCode) {
	        case "0" : $result = "Transaction Successful"; break;
	        case "?" : $result = "Transaction status is unknown"; break;
	        case "1" : $result = "Unknown Error"; break;
	        case "2" : $result = "Bank Declined Transaction"; break;
	        case "3" : $result = "No Reply from Bank"; break;
	        case "4" : $result = "Expired Card"; break;
	        case "5" : $result = "Insufficient funds"; break;
	        case "6" : $result = "Error Communicating with Bank"; break;
	        case "7" : $result = "Payment Server System Error"; break;
	        case "8" : $result = "Transaction Type Not Supported"; break;
	        case "9" : $result = "Bank declined transaction (Do not contact Bank)"; break;
	        case "A" : $result = "Transaction Aborted"; break;
	        case "C" : $result = "Transaction Cancelled"; break;
	        case "D" : $result = "Deferred transaction has been received and is awaiting processing"; break;
	        case "F" : $result = "3D Secure Authentication failed"; break;
	        case "I" : $result = "Card Security Code verification failed"; break;
	        case "L" : $result = "Shopping Transaction Locked (Please try the transaction again later)"; break;
	        case "N" : $result = "Cardholder is not enrolled in Authentication scheme"; break;
	        case "P" : $result = "Transaction has been received by the Payment Adaptor and is being processed"; break;
	        case "R" : $result = "Transaction was not processed - Reached limit of retry attempts allowed"; break;
	        case "S" : $result = "Duplicate SessionID (OrderInfo)"; break;
	        case "T" : $result = "Address Verification Failed"; break;
	        case "U" : $result = "Card Security Code Failed"; break;
	        case "V" : $result = "Address Verification and Card Security Code Failed"; break;
	        default  : $result = "Unable to be determined"; 
	    }
	    return $result;
	}
	function getStatusDescription($statusResponse) {
	    if ($statusResponse == "" || $statusResponse == "No Value Returned") {
	        $result = "3DS not supported or there was no 3DS data provided";
	    } else {
	        switch ($statusResponse) {
	            Case "Y"  : $result = "The cardholder was successfully authenticated."; break;
	            Case "E"  : $result = "The cardholder is not enrolled."; break;
	            Case "N"  : $result = "The cardholder was not verified."; break;
	            Case "U"  : $result = "The cardholder's Issuer was unable to authenticate due to some system error at the Issuer."; break;
	            Case "F"  : $result = "There was an error in the format of the request from the merchant."; break;
	            Case "A"  : $result = "Authentication of your Merchant ID and Password to the ACS Directory Failed."; break;
	            Case "D"  : $result = "Error communicating with the Directory Server."; break;
	            Case "C"  : $result = "The card type is not supported for authentication."; break;
	            Case "S"  : $result = "The signature on the response received from the Issuer could not be validated."; break;
	            Case "P"  : $result = "Error parsing input from Issuer."; break;
	            Case "I"  : $result = "Internal Payment Server system error."; break;
	            default   : $result = "Unable to be determined"; break;
	        }
	    }
	    return $result;
	}	
	function draw_array_as_table($items = array()) {
	    $return = '';
	    if (!empty($items)) {
	        $return .= '<table border="1">';
	        $i = 0;
	        foreach ($items as $row) {
	            $class = 'odd';
	            if (($i % 2) == 0) {
	                $class = 'even';
	            }
	            $i++;
	            $return .= '<tr class ="' . $class . '">';
	            foreach ($row as $cell) {
	                $return .= '<td>' . $cell . '</td>';
	            }
	            $return .= '</tr>';
	        }
	        $return .= '</table>';
	    }
	    return $return;
	}
}