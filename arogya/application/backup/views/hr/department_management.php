<!DOCTYPE html>
<html lang="en">
<head>
    <title><?=$page['page']='Add Departments';?> | <?=$this->siteInfo['name'];?></title>
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
                    <div class="container-fluid padding-top main-container">
                        <!-- ///Flash Message End/// -->
                        <!-- ///=====================All Contents Start Here============= //-->
                        <div class="col-lg-12">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <p class="panel-title">Departments Management</p>
                                </div>
                                <div class="panel-body">
                                    <div class="col-lg-4">
                                        <?php if(isset($get_data)) { ?>
                                        <center>
                                            <h4>Update Departments Type</h4>
                                        </center>
                                        <?=form_open('auth/updateAndReturn/departments/'.base64_encode('hr/explore/department_management')); ?>
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input type="hidden" name="id"  value="<?=$get_data['id'];?>">
                                            <input type="text" name="department_name" id='name' value="<?=$get_data['department_name'];?>" class="form-control" required>
                                            <b style="color: red;" id="errName"></b>
                                        </div>
                                        
                                        
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-warning">Update</button> <a href="<?=base_url('hr/explore/department_management'); ?>" class="btn btn-info">Add New</a>
                                        </div>
                                        </form>
                                        <?php } else { ?>
                                        <center>
                                            <h4>Add New Sites</h4>
                                        </center>
                                        <?=form_open('auth/insertAndReturn/departments/'.base64_encode('hr/exploreData/departments/department_management')); ?>
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input type="text" name="department_name" id='name' class="form-control" required>
                                            <b style="color: red;" id="errName"></b>
                                        </div>
                                        
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary">Add</button>
                                        </div>
                                        </form>
                                        <?php } ?>
                                    </div>
                                    <div class="col-lg-8">
                                        <center>
                                            <h4>Sites Type List</h4>
                                        </center>
                                        <table class="table table-striped table-hover table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Sl.</th>
                                                    <th>Name</th>
                                                    <th>Total Employee</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $data = $this->dbm->getData('departments'); //print_r($data); die();
                                                if(isset($data)) { $i=1;
                                                    foreach($data as $list) { ?>
                                                <tr>
                                                    <?php  $projects = $this->db_model->rowCount('employee',['department_id'=>$list['id']]); /*print_r($projects);*/ ?>

                                                    <td><?=$i;?></td>
                                                    <td><?=$list['department_name'];?></td>
                                                    <td><?=$projects;?></td>
                                                    <td>
                                                        <?php if($this->loggedEmp['access_level']=='hr'){ ?>
                                                        <div class="btn-group">
                                                            <a title="Edit" href="<?=base_url('hr/getData/departments/'.$list['id'].'/department_management');?>" class="btn btn-sm btn-info"><span class="glyphicon glyphicon-pencil"></span></a>
                                                            
                                                            
                                                            <?php if ($projects == 0): ?>
                                                            <a onclick="return conDel('hr/departMgmt/del/<?=$list['id'];?>');" title="Delete" href="#" class="btn btn-sm btn-danger"><span class="glyphicon glyphicon-trash"></span></a>

                                                            <?php endif ?>


                                                        </div>
                                                        <?php } ?>
                                                    </td>
                                                </tr>
                                                <?php $i++; } } else { ?>
                                                <tr>
                                                    <td colspan="5">No category created yet</td>
                                                </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- All Content End here -->
                        <!-- Bootstrap Modal fo confirmation -->
                        <div class="modal fade" id="myModal" role="dialog">
                            <div class="modal-dialog modal-sm">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal"><span class="glyphicon glyphicon-remove" style="color: red;"></span></button>
                                        <h4 class="modal-title">Please Cofirm Your Password</h4>
                                    </div>
                                    <div class="modal-body">
                                        <p style="color: red;" id="msg"></p>
                                        <div class="input-group">
                                            <input type="password" id="password" autofocus="autofocus" class="form-control" style="margin-bottom: 5px;" placeholder="Enter Your Password" required>
                                            <input type="hidden" name="action" value="" id="action">
                                            <span class="input-group-btn">
                                            <button class="btn btn-primary" id="conPass" type="button">Go!</button>
                                            </span>
                                        </div>
                                        <!-- /input-group -->
                                    </div>
                                    <div class="modal-footer">
                                        <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>  



                </div>
            <!--//===============Main Container End=============//-->
            </div>
        </div>
    </div>
  <!--==========Footer Start=============-->
  <?php $this->load->view('hr/include/footer'); ?>
  <!--==========Footer End=============-->   
</body>
<script type="text/javascript">
    $('#datepairExample .date').datepicker({
                      'format': 'dd-mm-yyyy',
                      'autoclose': true
                  });
    
    $('#btnSubmit').click( function(){
      var name=$('#name').val();
      if($.trim(name)=='')
      {
        $('#errName').html('This Field must be required');
        return false;
      }
      var add=$('#address').val();
      if($.trim(add)=='')
      {
        $('#errAdd').html('This Field must be required');
        return false;
      }
    });
    function conDel(a)
    {
      $('#action').val(a);
      $('#myModal').modal('show');
      $('#msg').html(' ');
      var pass=$('#password').val("");
      return false;
    }
    $('#conPass').click(function()
      {
        var pass=$('#password').val();
        var act=$('#action').val();
        var base="<?=base_url();?>";
        $.ajax({
          url:"<?=base_url('hr/passwordConfirmation');?>",
          data:{password:pass,action:act},
          type:'post',
          success:function(data)
          {
            if(data==1)
            {
              location.href=base+act;
            }else
            {
              var sms=data;
              $('#msg').html(sms);
            }
          }
        });
      });
</script>
<style type="text/css">
    legend{
    display: block;
    width: 100%;
    padding-left: 15px;
    padding-top: 5px;
    margin-bottom: 20px;
    font-size: 21px;
    line-height: inherit;
    color: #333;
    border: 0;
    border-top: 1px solid;
    border-radius: 10px;
    }
    #contain{
    border: 1px solid;
    box-shadow: inset 0px 0px 15px 5px #4F7C92;
    background: aliceblue;
    border-radius: 20px;
    margin-top: 10px;
    margin-bottom: 10px;
    }
</style>
</html>
