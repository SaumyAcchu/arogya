<?php

require_once(APPPATH."libraries/lib/config_paytm.php");
require_once(APPPATH."libraries/lib/encdec_paytm.php");


class Tast extends CI_Controller {
    
    public function index($value='')
    {
        echo "string";
    }
    public function PaytmGateway()
    {
        $orderId = 106; /// must be unique
      $this->StartPayment($orderId);
    }
  
    public function StartPayment($orderId)
    {
        $paramList["MID"] = PAYTM_MERCHANT_MID;
        $paramList["ORDER_ID"] = $orderId;        
        $paramList["CUST_ID"] = 344;   /// according to your logic
        $paramList["INDUSTRY_TYPE_ID"] = 'RETIAL';
        $paramList["CHANNEL_ID"] = 'WEB';
        $paramList["TXN_AMOUNT"] = 50;
        $paramList["WEBSITE"] = PAYTM_MERCHANT_WEBSITE;
      
        $paramList["CALLBACK_URL"] = "http://127.0.0.1/gateway/Welcome/PaytmResponse";
        $paramList["MSISDN"] = '77777777'; //Mobile number of customer
        $paramList["EMAIL"] ='foo@gmail.com';
        $paramList["VERIFIED_BY"] = "EMAIL"; //
        $paramList["IS_USER_VERIFIED"] = "YES"; //
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