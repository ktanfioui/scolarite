<?php
	require_once 'src/Mandrill.php'; 

	class EnvoiEmail {	
		public static function Send_Mail($to,$subject,$body,$from) {
			try {
			    $mandrill = new Mandrill('yGemhSxQJBPZTz0AXDOqKQ');
			    $message = array(
			        'html' => $body,
			        'subject' => 'ENSAK Formations -- '.$subject,
			        'from_email' => $from,
			        //'from_name' => 'Example Name',
			        'to' => array(
			            array(
			                'email' => $to,
			                'name' => 'Recipient Name',
			                'type' => 'to'
			            )
			        ),
			        'headers' => array('Reply-To' => $from),

			        "important" => true,
			        "inline_css"=> true,
			    );
			    $async = false;
			    $result = $mandrill->messages->send($message, $async);
			    print_r($result);
			    return true;
			} catch(Mandrill_Error $e) {
			    // Mandrill errors are thrown as exceptions
			    echo 'A mandrill error occurred: ' . get_class($e) . ' - ' . $e->getMessage();
			    var_dump($e->getMessage());
			    // A mandrill error occurred: Mandrill_Unknown_Subaccount - No subaccount exists with the id 'customer-123'
			    throw $e;
			    return false;
			}
		}
	}
?>