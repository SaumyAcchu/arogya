<!DOCTYPE html>
<html lang="en">
<head>
    <title><?=$page['page']='Attendence Details';?> | <?=$this->siteInfo['name'];?></title>
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
                <?= form_open('hr/attendanceList',['class'=>'form-horizontal']); ?>
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





        <div class="col-sm-12">
            <?php if(isset($salaryReport))
            {
              // print_r($salaryReport); die();
            if(isset($searchFor))
            { ?>
              <?php $employee=$this->db->get_where('employee',['employee_id'=>$searchFor['employee_id']])->row_array(); ?>
              <b style="color:red;"> Attendence Result For </b>: <b style="color:green;"><?=$employee['name'];?></b> &nbsp;&nbsp;&nbsp;
            <?php }?>
             
            <b style="color:red;"> From </b>: <b style="color:green;"><?=$searchFor['dateFrom'];?></b> &nbsp;&nbsp;&nbsp;
            <b style="color:red;"> To </b>: <b style="color:green;"><?=$searchFor['dateTo'];?></b> &nbsp;&nbsp;&nbsp;
           
            <table id="example" class="table table-striped table-hover table-bordered display" style="width:100%">
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
