<!DOCTYPE html>
<html lang="en">
<head>
  	<title><?=$page['page']='Salary Slip';?> | <?=$this->siteInfo['name'];?></title>
  	<?php $this->load->view('employee/include/header'); ?>
</head>
<body>
  <!--===========top nav start=======-->
    	<?php $this->load->view('employee/include/topbar'); ?>
  <!--===========top nav end===========-->
  	<div class="wrapper" id="wrapper">
    	<div class="left-container" id="left-container">
      	<!--========== Sidebar Start =============-->
      		<?php $this->load->view('employee/include/sidebar',$page); ?>
      	<!--========== Sidebar End ===============-->
    	</div>
	    <div class="right-container" id="right-container">
	      	<div class="container-fluid">
		        <?php $this->load->view('employee/include/page-top',$page); ?>
		        <!--//===============Main Container Start=============//-->
            <!-- <?php echo "<pre>"; print_r($employeeDtl); print_r($salaryDtl); ?> -->
		            <div class=" col-lg-12" id="myDiv">
                 <table class="table table-hover table-bordered table-striped" border="1" cellpadding="5" style="width:100%;">
                   <tbody>
                     <tr rowspan="2">
                       <th><center><img src="<?=base_url('uploads/'.$this->siteInfo['image']);?>" height="120" width="120"></center></th>
                       <td class="txtcenter" colspan="5">
                         <h3><?=$this->siteInfo['name'];?></h3>
                         <b><?=$this->siteInfo['address'];?></b><br>
                         <span>Email : <?=$this->siteInfo['email'];?>, Website : <?=$this->siteInfo['website'];?></span>
                         <p>Payment Summary</p>
                       </td>
                     </tr>
                     <tr>
                       <th>Employee Id</th><td colspan="3"><?= $employeeDtl['employee_id']; ?></td>
                       <th>Name</th><td colspan="3" style="color: blue;"><?= $employeeDtl['name']; ?>&nbsp;<?= $employeeDtl['m_name']; ?>&nbsp;<?= $employeeDtl['l_name']; ?></td>
                     </tr>
                     <tr>
                       <th>E-mail</th><td colspan="3"><?= $employeeDtl['email'] ?></td><th>Mobile</th><td><?= $employeeDtl['mobile'] ?></td>
                     </tr>                     
                    
                     <tr>
                       <td colspan="6" style="color: red;">Salary Details</td>
                     </tr>
                     <?php 
                     $dateForin=new DateTime($salaryDtl['date_for']);
                     // $newdateFrom=$dateForin->format('Y-m-d');
                     $showDate=$dateForin->format('M-Y');
                      ?>
                     <tr>
                       <th>Salery For</th><td colspan="2"><?= $showDate; ?></td>
                       <th>Salery Generate Date</th><td colspan="2" style="text-align: left;"><?= $salaryDtl['generat_date']; ?></td>
                     </tr>
                     <tr>
                       <th>Present Days</th><td colspan="2"><?= $salaryDtl['present'] ?></td>
                       <th>Absent Days</th><td colspan="2" style=""><?= $salaryDtl['absent'] ?></td>
                     </tr>
                     <tr>
                       <th>Monthaly Salery</th><td colspan="2"><?= $salaryDtl['monthly_salary'] ?> &#8377;</td>
                       <th>Salery</th><td colspan="2" style=""><?= $salaryDtl['salary'] ?> &#8377;</td>
                     </tr>

                   </tbody>
                 </table>
                 
               </div>
               <button class="btn btn-primary" id="printId">Print <i class="fa fa-print"></i></button>
	        <!--//===============Main Container End=============//-->
	      	</div>
	    </div>
  	</div>
  <!--==========Footer Start=============-->
  <?php $this->load->view('employee/include/footer'); ?>
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