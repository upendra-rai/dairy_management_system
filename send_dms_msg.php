<?php 

//  error_reporting(0);
//ini_set('display_errors', 0);

  $name = $_GET["name"];
  $card_no = $_GET["card_no"];
  $recharge_amount = $_GET["recharge_amount"];
  $transaction_amount = $_GET["transaction_amount"];
  $avl_balance = $_GET["avl_balance"];
  $source = $_GET["source"];
  $otp_number = $_GET["otp_number"];
  $mobile = $_GET["mobile_no"]; 
  $template = $_GET["template"]; 
  $product_name = $_GET["product_name"]; 
  $client_url = $_GET["client_url"]; 
  
  $company = "Ackko Tech";
  $ending_line = "Team Vivek";

  $msg = '';
  
  
        $cSession = curl_init(); 
        curl_setopt($cSession,CURLOPT_URL,$client_url."/app_interface/check_sms_balance/"); 
        curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($cSession,CURLOPT_HEADER, false); 
        $check_sms=curl_exec($cSession);
		//echo json_encode($result);
        curl_close($cSession);
       // print_r($result);
		
       if($check_sms > 0){
		   
		   echo 'yes';
	   
	   

  if($template == 'ragistration'){
	  
	 $msg = "Dear ".$name.", Welcome to ".$company.". Your membership card No. is ".$card_no.". Please download our app to use the services. Best wishes.".$ending_line." AVS Prime Technologies LLP";
	 
  }
  
  if($template == 'recharge'){
	 
	 $msg = "Dear ".$name.",Your card number xxxxxxx has been successfully recharged with Rs. ".$recharge_amount." Available Balance is Rs. ".$avl_balance.". Thank You,".$ending_line." AVS Prime Technologies LLP";
  }
  
  if($template == 'transaction'){
	  
	 $date = date("d-M-Y"); 
	 $msg = "Dear ".$name.", Rs. ".$transaction_amount." debited on ".$date." for ".$product_name." Avl. Bal. is Rs. ".$avl_balance." Thank You, ".$ending_line;
  }
  
  
  
  if($template == 'terminate'){
	  
	  if($avl_balance > 0){
		   $msg = "Dear ".$name.",It is sad that you are leaving us.Please submit your card and collect the balance amount of Rs ".$avl_balance.".Best wishes,".$ending_line." AVS Prime Technologies LLP";
	  }else{
		   $msg = "Dear ".$name.",It is sad that you are leaving us.Please submit your card and pay the balance amount of Rs ".$avl_balance.".Best wishes,".$ending_line." AVS Prime Technologies LLP";
	  }
	  
	 
  }
  
   if($template == 'change_card'){
	 
	   $msg = "Dear ".$name.",We are sad that your card is Lost/Broken.Please pay Rs. 50 as caution money for new card no. ".$card_number.".Regards,".$ending_line." AVS Prime Technologies LLP";
  }
  
   if($template == 'otp'){
	  
	   $msg = "OTP for make Transaction on ".$company." is ".$otp_number." & valid till 3minut, Don't share it.Regards,x AVS Prime Technologies LLP";
	  
    }
        $user = "avsprimetechnologiesllp";
        $password = "AVSPrime@123";
        $msisdn = '91'.$mobile;
        $sid = "AVSDMS";
        $name = "vivek";
        $OTP = "6765R";
        $msg = urlencode($msg);
        $fl = "0";
        $gwid = "2";
        $type = "txt";
        $cSession = curl_init(); 
        curl_setopt($cSession,CURLOPT_URL,"http://cloud.smsindiahub.in/vendorsms/pushsms.aspx?user=".$user."&password=".$password."&msisdn=".$msisdn."&sid=".$sid."&msg=".$msg."&fl=0&gwid=2"); 
        curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($cSession,CURLOPT_HEADER, false); 
        $result=curl_exec($cSession);
		//echo json_encode($result);
        curl_close($cSession);
        print_r($result);
		
	
        if($result){
			
			$result = json_decode($result);
           
			if($result->ErrorMessage == 'done'){
				$cSession = curl_init(); 
				curl_setopt($cSession,CURLOPT_URL,$client_url."/app_interface/insert_sended_msg/"); 
				curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);
				curl_setopt($cSession,CURLOPT_HEADER, false); 
				$check_sms=curl_exec($cSession);
				//echo json_encode($result);
				curl_close($cSession);
			   // print_r($result);
			}else{
				echo 'my_fail';
			}
		}
   
   }else{
		   
		   echo 'no';
	   }
	   
 ?>
