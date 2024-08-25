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
            <?php $this->load->view('includes/sidebar.php',['page'=>'property-type']); ?>
        </div>
        <div class="col-md-10 col-sm-11 display-table-cell v-align">
          <?php $this->load->view('includes/topbar.php'); ?>
         <div class="container-fluid padding-top main-container">
  <!-- ///=====================All Contents Start Here============= //-->
            <div class="jumbotron col-lg-12">
              <div class="col-lg-4">
              <?php if(isset($updData)) { ?>
                <center><h4>Update Property Type</h4></center>
                <?=form_open('real1/buildingMgmt/upd/'.$updData['id']); ?>
                  <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" id='name' value="<?=$updData['name'];?>" class="form-control" required>
                    <b style="color: red;" id="errName"></b>
                  </div>
                  <div class="form-group">
                    <label>Entry Date</label>
                    <span id="datepairExample">
                      <input type="text" value="<?= set_value('registration_date',$updData['date']); ?>" name="date" class="form-control date" id="registration_date" placeholder="dd-mm-yyyy" required>
                    </span>
                  </div>
                  <div class="form-group">
                    <label>Address</label>
                    <textarea id="address" class="form-control" name="address"><?=$updData['address'];?></textarea>
                    <b style="color: red;" id="errAdd"></b>
                  </div>
                  <div class="form-group">
                    <button type="submit" id="btnSubmit" class="btn btn-warning">Update</button> <a href="<?=base_url('real1/buildingMgmt/opn'); ?>" class="btn btn-info">Add New</a>
                  </div>
                </form>
              <?php } else { ?>
                <center><h4>Add Propert Type</h4></center>
                <?=form_open('real1/buildingMgmt/add'); ?>
                  <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" id='name' class="form-control" required>
                    <b style="color: red;" id="errName"></b>
                  </div>
                  <div class="form-group">
                    <label>Entry Date</label>
                    <span id="datepairExample">
                      <input type="text" value="<?= set_value('registration_date',date('d-m-Y')); ?>" name="date" class="form-control date" id="registration_date" placeholder="dd-mm-yyyy" required>
                    </span>
                  </div>
                  <div class="form-group">
                    <label>Address</label>
                    <textarea id="address" class="form-control" name="address"></textarea>
                    <b style="color: red;" id="errAdd"></b>
                  </div>
                  <div class="form-group">
                    <button type="submit" id="btnSubmit" class="btn btn-primary">Add</button>
                  </div>
                </form>
              <?php } ?>
              </div>
              <div class="col-lg-8">
                <center><h4>Property Type List</h4></center>
                <table class="table table-striped table-hover table-bordered">
                  <thead>
                    <tr>
                      <th>Sl.</th>
                      <th>Name</th>
                      <th>Address</th>
                      <th>Create Date</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php if(isset($data)) { $i=1;
                   foreach($data as $list) { ?>
                    <tr>
                      <td><?=$i;?></td>
                      <td><?=$list['name'];?></td>
                      <td><?=$list['address'];?></td>
                      <td><?=$list['date'];?></td>
                      <td>
                      <?php if($this->logged['access_level']=='universal'){ ?>
                        <div class="btn-group">
                          <a onclick="return conDel('real1/buildingMgmt/edt/<?=$list['id'];?>');" title="Edit" href="#" class="btn btn-sm btn-info"><span class="glyphicon glyphicon-pencil"></span></a>
                          <a onclick="return conDel('real1/buildingMgmt/del/<?=$list['id'];?>');" title="Delete" href="#" class="btn btn-sm btn-danger"><span class="glyphicon glyphicon-trash"></span></a>
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
                    <input type="password" id="password" class="form-control" style="margin-bottom: 5px;" placeholder="Enter Your Password" required>
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
          </div>
        <!-- Modal End -->
        </div>
      </div>
    </div>
</body>
<?php $this->load->view('includes/footer.php'); ?>
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