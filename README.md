# Paym.es-Codeigniter-Integration
Paym.es ödəniş sisteminin Codeigniter Framework ilə istifadəsi
Millikart ödəniş sisteminin Codeigniter Framework ilə istifadəsi.

Autoload üçün

public function __construct()
{
    parent::__construct();
    $this->load->library('paymes');
}
Controllerdə bu şəkildə çağırıb sorğunuzu göndərə bilərsiniz

  $this->millikart->set($amount, $uniq_id, $description);
  $response = $this->paymes->getURL();
  redirect($response, 'refresh');

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
