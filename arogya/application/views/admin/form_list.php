
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
  </script><!DOCTYPE html>
<html lang="en">
<head>
    <title><?=$page['page']='Form Management';?> | <?=$this->siteInfo['name'];?></title>
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
                      <th>SR.</th>
                      <th>NewBooking</th>
                      <th>Name</th>
                      <th>Father/Husband</th>
                      <th>Address </th>
                      <th>Mobile</th>
                      <th>Email</th>
                      <th>ProjectName</th>
                      <th>AssociateName</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                   <?php $site = $this->db->select()->get('form')->result_array();?>
                         <?php foreach ($site as $key => $list) {
                                       ?>
                    <tr>
                      <td><?=$list['sr'];?></td>
                      <td><?=$list['newBooking'];?></td>
                      <td><?=$list['customerName'];?></td>
                      <td><?=$list['fname'];?></td>
                      <td><?=$list['address'];?></td>
                      <td><?=$list['mobileNumber'];?></td>
                      <td><?=$list['email'];?></td>
                      <td><?=$list['projectName'];?></td>
                      <td><?=$list['associateName'];?></td>
                      <td><div class="btn-group">
                     
                      
                          <a  title="Delete" href="<?=base_url('control/deleteData/form/'.$list['id'].'/form_list');?>" class="btn btn-sm btn-danger"><span class="glyphicon glyphicon-trash"></span></a>
                      <a href="<?=base_url('control/Return_print/'.$list['id']);?>" class="btn btn-primary"> Detail</a>
                        </div>
                      </td>
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
