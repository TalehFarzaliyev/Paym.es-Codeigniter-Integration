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
        	'secretkey'		=> $this->secretkey,
        	'productPrice'	=> $this->productPrice,
        	'productName'	=> $this->productName,
        	'firstName'		=> $this->firstName,
        	'lastName'		=> $this->lastName,
        	'email'			=> $this->email
        ];

        $cURLConnection = curl_init($this->pro_url);
        curl_setopt($cURLConnection, CURLOPT_POSTFIELDS, $data);
        curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);

        $apiResponse = curl_exec($cURLConnection);
        curl_close($cURLConnection);

        $response = json_decode($apiResponse);
        
        return $response->url;
    }
}