<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Paymes {
	// config variables
		private $secretkey;
		private $test_url;
		private $pro_url;
	// end config
        public 	$productPrice;
        public 	$productName;
        public 	$firstName;
        public 	$lastName;
        public 	$email;
        public  $ci;

	public function __construct () {
		$CI = &get_instance();
		$CI->load->config('paymes');
		$this->secretkey 	= $CI->config->item('paymes_secret_key');
		$this->test_url 	= $CI->config->item('paymes_test_url');
		$this->pro_url 		= $CI->config->item('paymes_pro_url');
		$this->ci 			= $CI;
	}

	public function set($productPrice, $productName, $firstName, $lastName, $email){
		$this->productPrice = $productPrice;
		$this->productName 	= $productName;
		$this->firstName 	= $firstName;
		$this->lastName 	= $lastName;
		$this->email 		= $email;
	}

	public function getURL()
    {  
        $data = [
        	'secret'		=> $this->secretkey,
        	'productPrice'	=> $this->productPrice,
        	'productName'	=> $this->productName,
        	'firstName'		=> $this->firstName,
        	'lastName'		=> $this->lastName,
        	'email'			=> $this->email
        ];
        $options = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query($data),
            )
        );

        $context    = stream_context_create($options);
        $result     = file_get_contents($this->pro_url, false, $context);
        return json_decode($result);

    }
}