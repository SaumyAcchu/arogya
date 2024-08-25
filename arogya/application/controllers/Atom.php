<?php

require_once(APPPATH."libraries/atom/TransactionRequest.php");
require_once(APPPATH."libraries/atom/TransactionResponse.php");


class Atom extends MY_Controller {
  

  public function AtomGateway()
  {   
      $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);        
      $this->session->set_userdata('txnid',$txnid);

      $orderId = $txnid; /// must be unique
    $this->StartPayment($orderId);
  }


  public function StartPayment($value='')
  {
      date_default_timezone_set('Asia/Calcutta');
      $datenow = date("d/m/Y h:m:s");
      $transactionDate = str_replace(" ", "%20", $datenow);

      $transactionId = rand(1,1000000);

      // require_once 'TransactionRequest.php';

      $transactionRequest = new TransactionRequest();

      //Setting all values here
      $transactionRequest->setMode("test");
      $transactionRequest->setLogin(197);
      $transactionRequest->setPassword("Test@123");
      $transactionRequest->setProductId("NSE");
      $transactionRequest->setAmount($this->cart->total());
      $transactionRequest->setTransactionCurrency("INR");
      $transactionRequest->setTransactionAmount($this->cart->total());
      $transactionRequest->setReturnUrl(base_url().'atom/AtomResponse');
      $transactionRequest->setClientCode(123);
      $transactionRequest->setTransactionId($transactionId);
      $transactionRequest->setTransactionDate($transactionDate);
      $transactionRequest->setCustomerName("Test Name");
      $transactionRequest->setCustomerEmailId("test@test.com");
      $transactionRequest->setCustomerMobile("9999999999");
      $transactionRequest->setCustomerBillingAddress("Mumbai");
      $transactionRequest->setCustomerAccount("639827");
      $transactionRequest->setReqHashKey("KEY123657234");


      $url = $transactionRequest->getPGUrl();

      header("Location: $url");
  }




  public function AtomResponse($value='')
  {
      $transactionResponse = new TransactionResponse();
      $transactionResponse->setRespHashKey("KEYRESP123657234");

      if($transactionResponse->validateResponse($_POST)){
          echo "Transaction Processed <br/>";
          echo "<pre>";print_r($_POST);
      } else {
          echo "Invalid Signature";
      }
  }
}
?>