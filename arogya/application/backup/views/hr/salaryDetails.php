<!DOCTYPE html>
<html lang="en">
<head>
  	<title><?=$page['page']='Salary Details';?> | <?=$this->siteInfo['name'];?></title>
  	<?php $this->load->view('hr/include/header'); ?>
</head>
<body>
  <!--===========top nav start=======-->
    	<?php $this->load->view('hr/include/topbar'); ?>
  <!--===========top nav end===========-->
  	<div class="wrapper" id="wrapper">
    	<div class="left-container" id="left-container">
      	<!--========== Sidebar Start =============-->
      		<?php $this->load->view('hr/include/sidebar',$page); ?>
      	<!--========== Sidebar End ===============-->
    	</div>
	    <div class="right-container" id="right-container">
	      	<div class="container-fluid">
		        <?php $this->load->view('hr/include/page-top',$page); ?>
		        <!--//===============Main Container Start=============//-->
		             <div class="row padding-top">
                
                 <div class="col-lg-10 col-lg-offset-1">
                <?= form_open('hr/salaryReport',['class'=>'form-horizontal']); ?>
                  <div class="table-responsive">
                  <table class="table table-striped table-hover table-bordered">
                     <tbody>
                      <tr>
                        <td>
                          <div class="input-group">
                            <span class="input-group-addon" id="basic-addon1"> Employee ID</span>
                            <input type="text"  name="employee_id" value="<?=isset($user['employee_id'])?$user['employee_id']:'';?>" placeholder="Employee ID" class="form-control txtupper" required>
                          </div>
                        </td>
                        <td>
                          <div class="input-group" id="datepairExample">
                             <span class="input-group-addon" id="basic-addon1">From</span>
                             <input type="text" value="<?=set_value('dateFrom',date('d-m-Y'));?>" name="dateFrom" class="form-control date" id="datepicker" placeholder="dd-mm-yyyy" required>
                          </div>
                        </td>
                        <td>
                          <div class="input-group" id="datepairExample">
                             <span class="input-group-addon" id="basic-addon1">To</span>
                             <input type="text" value="<?=set_value('dateTo',date('d-m-Y'));?>" name="dateTo" class="form-control date" id="datepicker" placeholder="dd-mm-yyyy" required>
                          </div>
                        </td>
                        <td style="padding-top: 12px;">
                          <button type="submit" class="btn btn-danger btn-block btn-sm"> Details</button>
                        </td>
                      </tr>
                    </tbody>
                  </table>
              </div>
                
                </form>
              </div>





            <button class="btn btn-primary" id="printId">Print <i class="fa fa-print"></i></button>
        <div class="col-sm-12" id="myDiv">
            <?php if(isset($salaryReport))
            {
              // print_r($salaryReport); die();
            if(isset($searchFor))
            { ?>
              <?php $employee=$this->db->get_where('employee',['employee_id'=>$searchFor['employee_id']])->row_array(); ?>
              <b style="color:red;"> Search Result For </b>: <b style="color:green;"><?=$employee['name'];?></b> &nbsp;&nbsp;&nbsp;
            <?php }?>
             
            <b style="color:red;"> From </b>: <b style="color:green;"><?=$searchFor['dateFrom'];?></b> &nbsp;&nbsp;&nbsp;
            <b style="color:red;"> To </b>: <b style="color:green;"><?=$searchFor['dateTo'];?></b> &nbsp;&nbsp;&nbsp;
           
            <table id="example" class="table table-striped table-hover table-bordered display" border="1" cellpadding="5" style="width:100%;">
              <thead>
                <tr>
                  <th>Sl No.</th>
                  <th>Employee Id</th>
                  <th>Attendence Type</th>
                  <th>active</th>
                  <th>Date</th>
                  <th>Salary</th>
                </tr>
              </thead>
              <tbody>
              <?php $i=1; $j=0 ; $k=0; $total=0; if(count($salaryReport)>0){ foreach($salaryReport as $list){ ?>
                    <?php $atd=$this->db->get_where('attendence_type',['id'=>$list['attendence_type_id']])->row_array();
                    if ($list['attendence_type_id']==3) {
                      ?>
                    <tr class="danger">
                        <td><?=$i;?></td>
                        <td><?=$list['employee_id'];?></td>
                        <td style="text-transform: uppercase;color: red;"><b>
                        <?=$atd['type'];?></b>
                        </td>
                        <td><?=$list['is_active'];?></td>
                        <td><?=$list['date'];?></td>
                        <td>-</td>

                    </tr>

                    <?php $j++; }else{


                      ?>
                <tr>
                    <td><?=$i;?></td>
                    <td><?=$list['employee_id'];?></td>
                    <td style="text-transform: uppercase;"><b>
                    <?=$atd['type'];?></b>
                    </td>
                    <td><?=$list['is_active'];?></td>
                    <td><?=$list['date'];?></td>
                    <td><?= intval($list['salary']) ?></td>   
                    <?php $total = $total+intval($list['salary']); ?>
                </tr>
                <?php $k++; } $i++; } ?>
                <tr>
                  <th colspan="5">Total Prasent Dayes <?= $k ?> And total Absent days <?= $j ?></th><th>&#8377; <?php $amtunt=intval($total); echo $amtunt;?>/-</th>
                </tr>
                <tr>
                  <th>In words</th>
                  <td colspan="8">
                    <!-- Amount in Words -->
                        <?php
                         $number =$amtunt;
                         // $number =500000;
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
                        echo "Rupees " . $result ;
                       ?> 
                            Only
                <!-- Amount in words end -->
                  </td>
                </tr>
                <?php } else { ?>
                <tr>
                  <th colspan="9">Sorry, No Records Found. Try Another Date or Another Project!</th>
                </tr>
                <?php } ?>
              </tbody>
            </table>
           <?php }  ?>
           </div>

            </div>

	        <!--//===============Main Container End=============//-->
	      	</div>
	    </div>
  	</div>
  <!--==========Footer Start=============-->
  <?php $this->load->view('hr/include/footer'); ?>
  <!--==========Footer End=============-->   

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
  </script>

  <script type="text/javascript">
    $(document).ready(function() {
      $('#example').DataTable( {
          dom: 'Bfrtip',
          buttons: [
              'csv', 'excel', 'pdf'
          ]
      } );
  } );
  </script> 

</body>
</html>


<script type="text/javascript">
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
  </script>