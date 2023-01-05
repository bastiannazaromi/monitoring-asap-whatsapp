<?php

defined('BASEPATH') or exit('No direct script access allowed');

require_once 'twilio-php-app/vendor/autoload.php';

use Twilio\Rest\Client;
use Twilio\TwiML\MessagingResponse;

class Api extends CI_Controller
{
	public function index()
	{
		$sid    = "ACf1a094e56b6e90a4ef4a48d87030efad";
		$token  = "6f90b7820d10b5f387ab57df3f081ad4";
		$twilio = new Client($sid, $token);

		$to = "whatsapp:+6289660299603";
		$from = "whatsapp:+14155238886";
		$body = "Ketika asap tinggi, camera capture gambar, kirim WA.. JOS";

		$message = $twilio->messages
			->create(
				$to, // to 
				array(
					"from" => $from,
					"body" => $body
				)
			);

		print($message->sid);
	}

	public function aa()
	{
		$response = new MessagingResponse();
		$message = $response->message('');
		$message->body('Hello World!');
		$response->redirect('https://demo.twilio.com/welcome/sms/');

		echo $response;
	}
}

/* End of file Api.php */
