<!DOCTYPE html>
<html lang="en">
<head>
    <title><?=$page['page']='Associate Management';?> | <?=$this->siteInfo['name'];?></title>
    <?php $this->load->view('include/header'); ?>
</head>
<body>
  <!--===========top nav start=======-->
      <?php $this->load->view('include/topbar'); ?>
  <!--===========top nav end===========-->
    <div class="wrapper" id="wrapper">
      <div class="left-container" id="left-container">
        <!--========== Sidebar Start =============-->
          <?php $this->load->view('include/sidebar',$page); ?>
        <!--========== Sidebar End ===============-->
      </div>
      <div class="right-container" id="right-container">
          <div class="container-fluid">
            <?php $this->load->view('include/page-top',$page); ?>
            <!--//===============Main Container Start=============//-->
            <div class="container-fluid padding-top main-container">
          
  <!-- ///=====================All Contents Start Here============= //-->
              <div class="col-lg-12">
                <table id="example" class="table table-striped table-hover table-bordered display" style="width:100%">
                  <thead>
                    <tr>
                      <th>Sl.</th>
                      <th>User id</th>
                      <th>Name</th>
                      <th>Password</th>
                      <th>Father/Husband</th>
                      <th>Introducer ID</th>
                      <th>Mobile</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php if($data) { $i=1;
                   foreach($data as $list) {
                    if($list['access_level']=='limited'){ ?>
                    <tr>
                      <td><?=$i;?></td>
                      <td><?=$list['user_id'];?></td>
                      <td><?=$list['name'];?>&nbsp;<?=$list['m_name'];?>&nbsp;<?=$list['l_name'];?></td>
                      <td><?=$list['password'];?></td>
                      <td><?=$list['fname'];?></td>
                      <td><?=$list['sponcer_id'];?></td>
                      <td><?=$list['mobile'];?></td>
                      <td><div class="btn-group">
                        <?php $minId=$this->db->select_min('id')->where(['flat_user_id'=>$list['id']])->get('payment')->row_array(); ?>
                        <?php if($this->logged['access_level']=='universal'){ ?>
                          <a title="Edit" onclick="return conDel('real1/associatManagement/edt/<?=$list['id'];?>');" href="#" class="btn btn-sm btn-info"><span class="glyphicon glyphicon-pencil"></span></a>
                          <a onclick="return conDel('control/deleteData/users/<?=$list['id'];?>/associate-management');" title="Delete" href="#" class="btn btn-sm btn-danger"><span class="glyphicon glyphicon-trash"></span></a>
                        <?php } ?>
                        </div>
                      </td>
                    </tr>
                  <?php $i++; }} } else { ?>
                    <tr>
                      <td colspan="10">No Data Found.</td>
                    </tr>
                  <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <!--//===============Main Container End=============//-->
          </div>
      </div>
    </div>
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
                <input type="password" id="password" class="form-control" style="margin-bottom: 5px;" placeholder="Enter Your Password" autofocus="autofocus" required>
                <input type="hidden" name="action" value="" id="action">
                <span class="input-group-btn">
                  <button class="btn btn-primary" id="conPass" type="button">Go!</button>
                </span>
              </div><!-- /input-group -->
            </div>
            <div class="modal-footer">
              <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
            </div>
          </div>
        </div>
    <!-- Modal End -->
    </div>
  <!--==========Footer Start=============-->
  <?php $this->load->view('include/footer'); ?>
  <!--==========Footer End=============-->   
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
          url:"<?=base_url('real1/passwordConfirmation');?>",
          data:{password:pass,action:act},
          type:'post',
          success:function(data)
          {
            if(data==1)
            {
              location.href=base+act;
            }else
            {
              var sms='Password not Match.';
              $('#msg').html(sms);
            }
          }
        });
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
