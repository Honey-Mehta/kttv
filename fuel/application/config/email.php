

<?php
    $config['protocol'] = 'smtp';
$config['smtp_host'] = '192.168.0.88'; //change this
$config['smtp_host'] = 'mail.mponline.gov.in';
    $config['smtp_port'] = '25';
    $config['smtp_crypto'] = 'tls';
    $config['smtp_user'] = 'pmis.alert@mponline.gov.in'; //change this
    $config['smtp_pass'] = 'PMISmpo@123'; //change this
    $config['mailtype'] = 'html';
    $config['charset'] = 'iso-8859-1';
    $config['wordwrap'] = TRUE;
    $config['newline'] = "\r\n"; //use double quotes to comply with RFC 822 standard
    //$config['crlf'] = "\n";

    $config['smtp_timeout'] = '10';
	//$options['ssl'] = array('verify_peer' => false, 'verify_peer_name' => false);

