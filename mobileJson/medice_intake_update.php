<?php
	include("../classes/database.php");
?>
<?php
	if(isset($_REQUEST['intake']))
	{
		# write code to decode json
		//$intake=json_decode($_REQUEST['intakemedicine'],true);
		$intake = $_REQUEST['intake'];
		$nikshay_no=$_REQUEST['Nikshay_no'];
		#$query="UPDATE medicine_intake set medicine='1' where nikshay_no='$nikshay_no'";
		$query="INSERT INTO  medicine_intake (Nikshay_no,intake) VALUES('$nikshay_no','$intake')";

		$db= new Database();
		$db->connect();
		if(!empty($db->insertData($query)))
				echo "1";
		else
				echo "0";
				
			// Checking Status and send message to dot provider.
			// Sending Message to Dot provider Logic
		        $user       =   'success';  //bhash username
	    		$password   =   '123456';   //bhash password
	    		$sender_id  =   'BSHSMS';   //approved senderid
	    		//$reciever   =   '9629732192';
	    		$name       = "Lavanya";
	    		$sender     = '9629732192';
	    		$email      = "Test Email";
	    		$text       = "Test Message From mPower Application";
	    		$priority   =   'ndnd';     // ndnd or dnd
    			$sms_type   =   'normal';   //normal or flash message

			$data = array('user'=>$user, 'pass'=>$password, 'sender'=>$sender_id, 'phone'=>$sender, 'text'=>$text, 'priority'=>$priority, 'stype'=>$sms_type);
	       
	        // Send the POST request with cURL
	        $ch = curl_init('http://bhashsms.com/api/sendmsg.php?');
	        curl_setopt($ch, CURLOPT_POST, true);
	        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	        $response = curl_exec($ch);	
		$db->disconnect();
	}
?>
