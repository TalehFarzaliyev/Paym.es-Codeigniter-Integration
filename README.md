# Paym.es-Codeigniter-Integration
Paym.es ödəniş sisteminin Codeigniter Framework ilə istifadəsi

Autoload üçün

	public function __construct()
	{
	    parent::__construct();
	    $this->load->library('paymes');
	}

Controllerdə bu şəkildə çağırıb sorğunuzu göndərə bilərsiniz

	  $this->paymes->set($productPrice, $productName, $firstName, $lastName, $email);
	  $response = $this->paymes->getURL();
	  redirect($response->url, 'refresh');

Callback üçün isə

	  $status = $this->input->post('STATUS');
		if(!empty($status) and $status != null and $status == 'PAYMENT_SUCCESS')
	  {
			echo 'Success operation';
		}
	  else
	  {
	    echo 'Payment error';
	  }
