<?php

require_once(APPPATH."libraries/lib/config_paytm.php");
require_once(APPPATH."libraries/lib/encdec_paytm.php");


class Welcome extends MY_Controller {
  
    public function PaytmGateway()
    {   
        $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);        
        $this->session->set_userdata('txnid',$txnid);

        $orderId = $txnid; /// must be unique
      $this->StartPayment($orderId);
    }
  
    public function StartPayment($orderId)
    {
        $paramList["MID"] = PAYTM_MERCHANT_MID;
        $paramList["ORDER_ID"] = $orderId;        
        $paramList["CUST_ID"] = 34555555;   /// according to your logic
        $paramList["INDUSTRY_TYPE_ID"] = 'Retail109';
        $paramList["CHANNEL_ID"] = 'WEB';
        $paramList["TXN_AMOUNT"] = $this->cart->total();
        $paramList["WEBSITE"] = PAYTM_MERCHANT_WEBSITE;
      
        $paramList["CALLBACK_URL"] = base_url().'user/afterpaytm';
        //$paramList["CALLBACK_URL"] = base_url().'welcome/PaytmResponse';
        //$paramList["MSISDN"] = $this->logged['mobile']; //Mobile number of customer
        //$paramList["EMAIL"] = $this->logged['email'];
        //$paramList["VERIFIED_BY"] = "EMAIL"; //
        //$paramList["IS_USER_VERIFIED"] = "YES"; //
      //  print_r($paramList);
        $checkSum = getChecksumFromArray($paramList,PAYTM_MERCHANT_KEY);

        ?>

        <!--submit form to payment gateway OR in api environment you can pass this form data-->
      
        <form id="myForm" action="<?php echo PAYTM_TXN_URL ?>" method="post">
        <?php
         foreach ($paramList as $a => $b) {
        echo '<input type="hidden" name="'.htmlentities($a).'" value="'.htmlentities($b).'">';
       }
       ?>
            <input type="hidden" name="CHECKSUMHASH" value="<?php echo $checkSum ?>">
        </form>
        <script type="text/javascript">
            document.getElementById('myForm').submit();
         </script>
    
<?php
    }
  
    /////////// response from paytm gateway////////////
    public function PaytmResponse()
    {
        $paytmChecksum = "";
        $paramList = array();
        $isValidChecksum = "FALSE";

        $paramList = $_POST;
        echo "<pre>";
        print_r($paramList);
      
//        $paytmChecksum = isset($_POST["CHECKSUMHASH"]) ? $_POST["CHECKSUMHASH"] : ""; //Sent by Paytm pg
//
//        $isValidChecksum = verifychecksum_e($paramList, PAYTM_MERCHANT_KEY, $paytmChecksum); //will return TRUE or FALSE string.
//
//        if($isValidChecksum == "TRUE")
//        {
//            if ($_POST["STATUS"] == "TXN_SUCCESS")
//            { /// put your to save into the database // tansaction successfull
//                var_dump($paramList);
//            }
//            else {/// failed
//                var_dump($paramList);
//            }
//        }else
//        {//////////////suspicious
//           // put your code here
//          
//        }
    }
}
?>