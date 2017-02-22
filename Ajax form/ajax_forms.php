<?php
if ( $_POST ) {
	class TEmail {
		public $from_email;
		public $from_name;
		public $to_email;
		public $to_name;
		public $subject;
		public $data_charset = 'UTF-8';
		public $send_charset = 'windows-1251';
		public $body = '';
		public $type = 'text/plain';

		function send() {
			$dc          = $this->data_charset;
			$sc          = $this->send_charset;
			$enc_to      = mime_header_encode( $this->to_name, $dc, $sc ) . ' <' . $this->to_email . '>';
			$enc_subject = mime_header_encode( $this->subject, $dc, $sc );
			$enc_from    = mime_header_encode( $this->from_name, $dc, $sc ) . ' <' . $this->from_email . '>';
			$enc_body    = $dc == $sc ? $this->body : iconv( $dc, $sc . '//IGNORE', $this->body );
			$headers     = '';
			$headers .= "Mime-Version: 1.0\r\n";
			$headers .= "Content-type: " . $this->type . "; charset=" . $sc . "\r\n";
			$headers .= "From: " . $enc_from . "\r\n";

			return mail( $enc_to, $enc_subject, $enc_body, $headers );
		}


	}

	$json = array();
	function mime_header_encode( $str, $data_charset, $send_charset ) {
		if ( $data_charset != $send_charset ) {
			$str = iconv( $data_charset, $send_charset . '//IGNORE', $str );
		}

		return ( '=?' . $send_charset . '?B?' . base64_encode( $str ) . '?=' );
	}

	if ( $_POST['form_id'] == 'callback-popup' ) {
		$var1 = htmlspecialchars( $_POST["var1"] );
		$var2 = htmlspecialchars( $_POST["var2"] );

		if ( ! $var1 or ! $var2 ) {
			$json['error'] = 1;
			echo json_encode( $json );
			die();
		}

		$emailgo             = new TEmail;
		$emailgo->from_email = 'info@' . $_SERVER['SERVER_NAME'];
		$emailgo->from_name  = $_SERVER['SERVER_NAME'];
		$emailgo->to_email   = 'klepaysayt@gmail.com';
		$emailgo->to_name    = 'Оператору';
		$emailgo->subject    = 'Новая заявка';
		$emailgo->body       = "";
		$emailgo->send();

		$json['error'] = 0;

		echo json_encode( $json );
	} elseif ( $_POST['form_id'] == 'online-order' ) {
		$var1 = htmlspecialchars( $_POST["var1"] );
		$var2 = htmlspecialchars( $_POST["var2"] );


		if ( ! $var1 or ! $var2 ) {
			$json['error'] = 1;
			echo json_encode( $json );
			die();
		}

		$emailgo             = new TEmail;
		$emailgo->from_email = 'info@' . $_SERVER['SERVER_NAME'];
		$emailgo->from_name  = $_SERVER['SERVER_NAME'];
		$emailgo->to_email   = 'klepaysayt@gmail.com';
		$emailgo->to_name    = 'Оператору';
		$emailgo->subject    = 'Новая заявка';
		$emailgo->body       = "";
		$emailgo->send();

		$json['error'] = 0;

		echo json_encode( $json );
	} else {
		echo 'no form id!';
	}
} else {
	echo 'GET LOST!';
}