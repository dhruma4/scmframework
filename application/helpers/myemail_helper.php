 <?php
{
  
	function send_custom_mail($to,$subject,$message)
	{
		$that =& get_instance();
		$config['protocol'] = 'smtp';
		$config['smtp_host'] = 'ssl://smtp.gmail.com';
		$config['smtp_user'] = 'dhruma1234@gmail.com';
		$config['smtp_pass'] = 'dhrumashah1234';
		$config['smtp_port'] = 465;
		//$config['ssl']=TRUE;
		//$config['charset'] = 'utf-8';
		//$config['wordwrap'] = TRUE;
		$config['mailtype']='html';
		//$config['validate']=TRUE;
		//$config['priority']=3;
		

		$that->load->library('email',$config);
		$that->email->set_newline("\r\n");

		//$that->email->from('dhruma1234@gmail.com', 'Administrator');
		$that->email->to($to); 
		//$that->email->cc('another@another-example.com'); 
		//$that->email->bcc('them@their-example.com'); 

		$that->email->subject($subject);
		$that->email->message($message);

		if(!$that->email->send()){
			echo $that->email->print_debugger();	
		}

		
		

	}		
}
?>