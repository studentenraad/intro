<?php
if (isset($_POST) && isset($_GET['type']) && $_GET['type'] == 'contact')
{
    $parameters = array('FROM' => 'admin@groeptstudent.com','TO' => 'larry.bolt@gmail.com', 'Subject' => 'Intro Mail','TextBody' => "{$_POST['name']} - {$_POST['email']}\r\n{$_POST['message']}\r\n-------------\r\n");
    $parameters = json_encode($parameters);
    $con = curl_init();
    curl_setopt( $con, CURLOPT_RETURNTRANSFER, true );
    curl_setopt( $con, CURLOPT_POST, true );
    curl_setopt( $con, CURLOPT_UPLOAD, false );
    curl_setopt( $con, CURLINFO_HEADER_OUT, true );
    curl_setopt( $con, CURLOPT_SSL_VERIFYPEER, false );
    curl_setopt( $con, CURLOPT_CONNECTTIMEOUT,30);
    curl_setopt( $con, CURLOPT_TIMEOUT,30);
    curl_setopt( $con, CURLOPT_POST, true );
    curl_setopt( $con, CURLOPT_POSTFIELDS, $parameters );

    $httpHeaders		= array();
    $httpHeaders[]		= "User-Agent: " . 'intro mailer';
    $httpHeaders[]		= 'Accept: application/json';
    $httpHeaders[]		= 'Content-Type: application/json';
    $httpHeaders[]		= 'X-Postmark-Server-Token: 4de318cb-410f-4427-ba71-8e2cb9e62c0f';

    curl_setopt( $con, CURLOPT_POSTFIELDS, $parameters );
    curl_setopt( $con, CURLOPT_URL, 'https://api.postmarkapp.com/email' );
    curl_setopt( $con, CURLOPT_HTTPHEADER, $httpHeaders );

    $exec = curl_exec( $con );

    @file_put_contents('.messages.txt', @file_get_contents('.messages.txt')."{$_POST['name']} - {$_POST['email']}\r\n{$_POST['message']}\r\n-------------\r\n");
    header('Location: /?submitted#help');
}
