<?php
  require_once 'session.php';
  require_once '../constants.php';
  if (!isset($_SESSION['amount'], $_SESSION['email'])) {
    @session_destroy();
    header("Location: ../");
    exit;
  }



  $pay = curl_init();
  $email = $_SESSION['email'];
  $amount = $_SESSION['amount'] . "00";
  // die($amount);
  //the amount in kobo. This value is actually NGN 5000
  curl_setopt_array($pay, array(
    CURLOPT_URL => "https://api.paystack.co/transaction/initialize",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_SSL_VERIFYPEER => 0,
    CURLOPT_CUSTOMREQUEST => "POST",

    CURLOPT_POSTFIELDS => json_encode([
      'amount' => $amount,
      'email' => $email,
    ]),
    CURLOPT_HTTPHEADER => [
      "authorization: Bearer $paystack", //replace this with your own test key
      "content-type: application/json",
      "cache-control: no-cache"
    ],
  ));

  $response = curl_exec($pay);
  $err = curl_error($pay);
  if ($err) {
    header("Location: individual.php?page=pay&error=payment&access=0");
    exit();
  }
  $tranx = json_decode($response);
  if (true) {
    // there was an error from the API
    header("Location: individual.php?page=pay&error=payment&access=1");
    exit();
  }

  // redirect to page so User can pay
  // uncomment this line to allow the user redirect to the payment page
  header('Location: ' . $tranx->data->authorization_url);