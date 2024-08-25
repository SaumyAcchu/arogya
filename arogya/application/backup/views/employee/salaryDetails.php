<!DOCTYPE html>
<html lang="en">
<head>
  	<title><?=$page['page']='Salary Details';?> | <?=$this->siteInfo['name'];?></title>
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
		             <div class="row padding-top">
                
                 <div class="col-lg-6 col-lg-offset-3">
                <?= form_open('employee/salary',['class'=>'form-horizontal']); ?>
                  <div class="table-responsive">
                  <table class="table table-striped table-hover table-bordered">
                     <tbody>
                      <tr>
                       
                       <td>
                         <div class="input-group" id="datepairExample">
                            <span class="input-group-addon" id="basic-addon1">Select Month</span>
                            <input type="text" value="<?=set_value('dateFrom',date('01-m-Y'));?>" name="dateFrom" class="form-control date" id="datepicker" placeholder="dd-mm-yyyy" required>
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

              <b style="color:red;"> Search Result For </b>: <b style="color:green;"><?=$this->loggedEmp['name'];?></b> &nbsp;&nbsp;&nbsp;
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
                  
                </tr>
              </thead>
              <tbody>
              <?php $i=1; $total=0; if(count($salaryReport)>0){ foreach($salaryReport as $list){ ?>
                <tr>
                  <td><?=$i;?></td>
                  <td>
                    <!-- <?php $project=$this->db->get_where('project',['id'=>$list['building_id']])->row_array(); ?> -->
                    <?=$list['employee_id'];?>
                  </td>
                  <td style="text-transform: uppercase;"><b>
                    <?php $flat=$this->db->get_where('attendence_type',['id'=>$list['attendence_type_id']])->row_array(); ?>
                    <?=$flat['type'];?></b>
                  </td>
                  <td><?=$list['is_active'];?></td>
                  <td><?=$list['date'];?></td>
                     <!-- <td><?= intval($list['salary']) ?></td>   
                      <?php $total = $total+intval($list['salary']); ?> -->
                </tr>
                <?php $i++; } ?>
               
                <?php } else { ?>
                <tr>
                  <th colspan="9">Sorry, No Records Found. Try Another Date or Another Project!</th>
                </tr>
                <?php } ?>
              </tbody>
            </table>
           <?php }  ?>
           </div>

           <div class="col-sm-12" >
               <?php if(isset($salarylist))
               {
                 // print_r($salaryReport); die();
               if(isset($searchFor))
               { ?>

                 <b style="color:red;"> Search Result For </b>: <b style="color:green;"><?=$this->loggedEmp['name'];?></b> &nbsp;&nbsp;&nbsp;
               <?php }?>
                
               <b style="color:red;"> For </b>: <b style="color:green;"><?=$searchFor['dateFrom'];?></b> &nbsp;&nbsp;&nbsp;
              
               <table id="example" class="table table-striped table-hover table-bordered display" border="1" cellpadding="5" style="width:100%;">
                 <thead>
                   <tr>
                     <th>Sl No.</th>
                     <th>Employee Id</th>
                     <th>Date For</th>
                     <th>Monthaly Salery</th>
                     <th>Paid Salery</th>
                     <th>PaySlip</th>
                     
                   </tr>
                 </thead>
                 <tbody>
                 <?php $i=1; $total=0; if(count($salarylist)>0){ foreach($salarylist as $list){ ?>
                   <tr>
                     <td><?=$i;?></td>
                     <td>
                       <?=$list['emp_id'];?>
                     </td>
                     <td>
                       <?=$list['date_for'];?>
                     </td>
                     <td>
                       <?=$list['salary'];?>
                     </td>
                     
                     <td><?=$list['monthly_salary'];?></td>
                     <td> <a title="Edit" href="<?=base_url('employee/salerySlip/'.$list['id']);?>" class="btn btn-sm btn-info"><span class="glyphicon glyphicon-pencil"></span></a></td>
                       
                   </tr>
                   <?php $i++; } ?>
                  
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
                      'format': '01-mm-yyyy',
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