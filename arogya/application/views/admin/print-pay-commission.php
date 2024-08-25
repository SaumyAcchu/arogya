<!DOCTYPE html>
<html>
<head>
  <title><?=$this->siteInfo['name'];?></title>
  <?php $this->load->view('includes/header.php'); ?>
</head>
<body class="home">
    <div class="container-fluid no-padding display-table">
      <div class="row display-table-row">
        <div class="col-md-2 col-sm-1 no-padding hidden-xs display-table-cell v-align box" id="navigation">
            <?php $this->load->view('includes/sidebar.php',['page'=>'commission-status']); ?>
        </div>
        <div class="col-md-10 col-sm-11 display-table-cell v-align">
          <?php $this->load->view('includes/topbar.php'); ?>
          <!-- All Content Start here -->
          <div class="container-fluid no-padding main-container">
            <div class="title txtcenter">
            <h4>Print Commission Summary</h4>
          </div>
          <!-- ///Flash Message Start/// -->
          <?php if($alert=$this->session->flashdata('msg')): $class=$this->session->flashdata('msg_class'); ?>
            <div class="row"><div class="col-sm-6 col-sm-offset-3"><div class="alert alert-dismissible <?= $class; ?> txtblack"><button type="button" class="close" data-dismiss="alert">&times;</button><p><?php echo $alert; ?></p></div></div></div>
            <?php endif; ?>
          <!-- ///Flash Message End/// -->
  <!-- ///=====================All Contents Start Here============= //-->
            <div class="col-sm-12">
            <?php if(isset($get_data))
            {
            $user=$this->db_model->getWhere('users',['user_id'=>$get_data['user_id']]); ?>
              <div class="btn-group pull-right">
                <button class="btn btn-primary fa fa-print" id="printId" style="margin-bottom: 5px;"> Print</button>
              </div>
              <div id="myDiv">
            <table class="table table-bordered table-hover table-striped" border="1" cellpadding="5" width="100%">
              <tbody>
                <tr rowspan="2">
                    <th colspan="2"><center><img src="<?=base_url('uploads/'.$this->siteInfo['image']);?>" height="120" width="120"></center></th>
                    <td class="txtcenter" colspan="5">
                      <h3><?=$this->siteInfo['name'];?></h3>
                      <b><?=$this->siteInfo['address'];?></b><br>
                      <span>Email : <?=$this->siteInfo['email'];?>, Website : <?=$this->siteInfo['website'];?></span>
                      <p>Commission Summary</p>
                    </td>
                  </tr>
                  <tr>
                    <td><b>Name</b></td><td colspan="2"><?=$user['name'];?></td>
                    <td><b>User ID</b></td><td><?=$user['user_id'];?></td>
                    <td><b>Level</b></td><td><?=$user['level'];?></td>
                  </tr>
                  <tr>
                    <td><b>Inroducer Id</b></td><td colspan="2"><?=$user['sponcer_id'];?></td>
                    <td><b>Mobile</b></td><td><?=$user['mobile'];?></td>
                    <td><b>Receipt No</b></td><td><?=$get_data['trnx'];?></td>
                  </tr>
                  <tr>
                    <td colspan="7" class="txtcenter"><b>Invoice From : </b><?=$this->db_model->dateFormat($get_data['date_from']);?> <b> To : </b> <?=$this->db_model->dateFormat($get_data['date_to']);?></td>
                  </tr>
                <tr style="background-color: lavender;">
                  <th>Sl No.</th>
                  <th>TRNX</th>
                  <th>User Reg No.</th>
                  <th>Level</th>
                  <th>Inst Amt.</th>
                  <th>Date</th>
                  <th>Commission</th>
                </tr>
              <?php
              $commId=explode(',',$get_data['commission_id']);
               $i=1; $total=0; if(count($commId)>0){ foreach($commId as $val){
               $list=$this->db_model->getWhere('commission',['id'=>$val]); ?>
                <tr>
                  <td><?=$i;?></td>
                  <td><?=$list['trnx'];?></td>
                  <td><?=$list['registration'];?></td>
                  <td><?=$list['level'];?></td>
                  <td><?=$list['inst_amt'];?></td>
                  <td><?=$this->db_model->dateFormat($list['date']);?></td>
                  <td class="txtright"><?=$list['net']; $total=$total+$list['net'];?></td>
                </tr>
                <?php $i++; } ?>
                <tr style="background-color: lavender;">
                  <th colspan="6">Total</th><td class="txtright"><b><?=$total;?></b></td>
                </tr>
                <tr>
                  <th>In words</th>
                  <td colspan="6">
                    <!-- Amount in Words -->
                        <?php
                         $number =$total;
                         $no = round($number);
                         $point = round($number - $no, 2) * 100;
                         $hundred = null;
                         $digits_1 = strlen($no);
                         $i = 0;
                         $str = array();
                         $words = array('0' => '', '1' => 'One', '2' => 'Two',
                          '3' => 'Three', '4' => 'Four', '5' => 'Five', '6' => 'Six',
                          '7' => 'Seven', '8' => 'Eight', '9' => 'Nine',
                          '10' => 'Ten', '11' => 'Eleven', '12' => 'Twelve',
                          '13' => 'Thirteen', '14' => 'Fourteen',
                          '15' => 'Fifteen', '16' => 'Sixteen', '17' => 'Seventeen',
                          '18' => 'Eighteen', '19' =>'Nineteen', '20' => 'Twenty',
                          '30' => 'Thirty', '40' => 'Forty', '50' => 'Fifty',
                          '60' => 'Sixty', '70' => 'Seventy',
                          '80' => 'Eighty', '90' => 'Ninety');
                         $digits = array('', 'Hundred', 'Thousand', 'Lakh', 'Crore');
                         while ($i < $digits_1) {
                           $divider = ($i == 2) ? 10 : 100;
                           $number = floor($no % $divider);
                           $no = floor($no / $divider);
                           $i += ($divider == 10) ? 1 : 2;
                           if ($number) {
                              $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
                              $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
                              $str [] = ($number < 21) ? $words[$number] .
                                  " " . $digits[$counter] . $plural . " " . $hundred
                                  :
                                  $words[floor($number / 10) * 10]
                                  . " " . $words[$number % 10] . " "
                                  . $digits[$counter] . $plural . " " . $hundred;
                           } else $str[] = null;
                        }
                        $str = array_reverse($str);
                        $result = implode('', $str);
                        echo $result . "Rupees";
                       ?> 
                            Only
                <!-- Amount in words end -->
                  </td>
                </tr>
                <?php } else { ?>
                <tr>
                  <th colspan="7">Sorry, No Records Found. Try Another Date or Another User ID!</th>
                </tr>
                <?php } ?>
              </tbody>
            </table>
          </form>
          </div>
           <?php }  ?>
           </div>
           <div class="loader">
             <center>
                 <img class="loading-image" src="<?=base_url('assets/images/loading.gif');?>" alt="loading.." height="120" width="120">
             </center>
            </div>
          <!-- All Content End here -->
          </div>
        </div>
      </div>
    </div>
</body>
<?php $this->load->view('includes/footer.php'); ?>


 <!-- Bootstrap Modal for Notice -->
          <div class="modal fade" id="noticeModal" role="dialog">
            <div class="modal-dialog modal-md">
              <div class="modal-content">
                <div class="modal-body" style="padding: 0px;">
                    <div class="panel panel-primary" style="margin-bottom: 0px;">
                    <div class="panel-heading">
                     <p class="panel-title">Notice
                     <button type="button" class="close pull-right" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span></button></p>
                    </div>
                    <div class="panel-body" id="resContent">
                        
                    </div>
                </div>
                </div>
              </div>
            </div>
          </div>
        <!-- Modal End -->


<script>            
 function confirmDelete()
 {
  var con=confirm('Do you want to really delete it.');
  if(con)
    {return true;}else {return false;}
 }
 $('#datepairExample .date').datepicker({
                    'format': 'dd-mm-yyyy',
                    'autoclose': true
                });

  $("#printId").click(function(){
        var printContents = $("#myDiv").html();
         var frame1 = $('<iframe />');
        frame1[0].name = "frame1";
        frame1.css({ "position": "absolute", "top": "-1000000px" });
        $("body").append(frame1);
      var frameDoc = frame1[0].contentWindow ? frame1[0].contentWindow : frame1[0].contentDocument.document ? frame1[0].contentDocument.document : frame1[0].contentDocument;
        frameDoc.document.open();
      frameDoc.document.write('<html><head><link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/mystyle.css');?>" /></head><body onload="window.print()">' + printContents + '</body></html>');
      frameDoc.document.close();
    });

    $("#checkAll").click(function(){
    $('input:checkbox').not(this).prop('checked', this.checked);
});                

//============form===============//
        $('#payBtn').on('click', function (e) {
          $('.loader').show();
          e.preventDefault();
          $.ajax({
            type: 'post',
            url: "<?=base_url('real1/payCommission');?>",
            data: $('#myForm').serialize(),
            success: function (data) {
              $('.loader').fadeOut(3000);
              $('#resContent').html(data);
              $('#noticeModal').modal('show');
            }
          });
        });


  </script>
  <style type="text/css">
    .loading-image {
  position: absolute;
  top: 22%;
  left: -25%;
  z-index: 10;
}
.loader
{
    display: none;
    width:200px;
    height: 200px;
    position: fixed;
    top: 50%;
    left: 60%;
    text-align:center;
    margin-left: -50px;
    margin-top: -100px;
    z-index:2;
   
}
  </style>