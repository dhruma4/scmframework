 <?php
{
  
	function send_email($to,$subject,$message)
	{
		$this->load->library('email');

		$this->email->from('dhruma1234@gmail.com', 'Administrator');
		$this->email->to($to); 
		//$this->email->cc('another@another-example.com'); 
		//$this->email->bcc('them@their-example.com'); 

		$this->email->subject($subject);
		$this->email->message($message);	

		$this->email->send();

		if(!$this->email->send){
		echo $this->email->print_debugger();	
		}

		$config['protocol'] = 'smtp';
		$config['smtp_host'] = 'smtp.gmail.com';
		$config['smtp_user'] = 'dhruma1234@gmail.com';
		$config['smtp_pass'] = 'dhrumashah1234';
		$config['smtp_port'] = '465';
		$config['charset'] = 'utf-8';
		$config['wordwrap'] = TRUE;
		$config['mailtype']='html';
		$config['validate']=TRUE;
		$config['priority']=3;
		$config['newline']="\r\n";

		$this->email->initialize($config);
		

			
}
?>