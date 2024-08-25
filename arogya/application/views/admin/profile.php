<!DOCTYPE html>
<html>
<head>
  <title>Ujjwal Mission Megamart Pvt Ltd | Dashboard</title>
  <?php include('includes/header.php'); ?>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script type="text/javascript">
  $(document).ready(function(){
   $('[data-toggle="offcanvas"]').click(function(){
       $("#navigation").toggleClass("hidden-xs");
   });
});

$(document).ready(function() {
    var panels = $('.user-infos');
    var panelsButton = $('.dropdown-user');
    panels.hide();

    //Click dropdown
    panelsButton.click(function() {
        //get data-for attribute
        var dataFor = $(this).attr('data-for');
        var idFor = $(dataFor);

        //current button
        var currentButton = $(this);
        idFor.slideToggle(400, function() {
            //Completed slidetoggle
            if(idFor.is(':visible'))
            {
                currentButton.html('<i class="glyphicon glyphicon-chevron-up text-muted"></i>');
            }
            else
            {
                currentButton.html('<i class="glyphicon glyphicon-chevron-down text-muted"></i>');
            }
        })
    });


    $('[data-toggle="tooltip"]').tooltip();

    
});


</script>
<style type="text/css">
  .user-row {
    margin-bottom: 14px;
}

.user-row:last-child {
    margin-bottom: 0;
}

.dropdown-user {
    margin: 13px 0;
    padding: 5px;
    height: 100%;
}

.dropdown-user:hover {
    cursor: pointer;
}

.table-user-information > tbody > tr {
    border-top: 1px solid rgb(221, 221, 221);
}

.table-user-information > tbody > tr:first-child {
    border-top: 0;
}


.table-user-information > tbody > tr > td {
    border-top: 0;
}
.toppad
{margin-top:20px;
}

</style>
</head>
<body class="home">
    <div class="container-fluid display-table">
      <div class="row display-table-row">
        <div class="col-md-2 col-sm-1 hidden-xs display-table-cell v-align box" id="navigation">
            <?php $page='profile'; ?>
            <?php include('includes/sidebar.php'); ?> 
        </div>
        <div class="col-md-10 col-sm-11 display-table-cell v-align">
          <?php include('includes/topbar.php'); ?>
          <!-- All Content Start here -->
          <div class="user-dashboard">
            <center><h4 style="color: red;">User Profile</h4></center>
            <!--///////////////////////Flash Message///////////////////////// -->
            <?php if($alert=$this->session->flashdata('msg')): 
            $class=$this->session->flashdata('msg_class');
            ?>
            <div class="row">
            <div class="col-sm-6 col-sm-offset-3">
              <div class="alert alert-dismissible <?= $class; ?>">
              <button type="button" class="close" data-dismiss="alert">&times;</button>
              <strong><?php echo $alert; ?>.</strong>
            </div>
            </div>
            </div>
            <?php endif; ?>
            <!--///////////////////////Flash Message End///////////////////////// -->
              <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" >
                  <div class="panel panel-info">
                    <div class="panel-heading">
                      <h3 class="panel-title"><?=$logged['name']; ?></h3>
                    </div>
                    <div class="panel-body">
                      <div class="row">
                        <div class="col-md-3 col-lg-3 " align="center"> <img alt="User Pic" src="https://placeholdit.imgix.net/~text?txtsize=12&txt=<?=$logged['name']; ?>%21&w=300&h=300&txtsize=50" class="img-circle img-responsive"> </div>
                        <div class=" col-md-9 col-lg-9 "> 
                          <table class="table table-user-information">
                            <tbody>
                              <tr>
                                <td>User ID:</td>
                                <td><?=$logged['user_id']; ?></td>
                              </tr>
                              <tr>
                                <td>Registration Date:</td>
                                <td><?=$logged['registration_date']; ?></td>
                              </tr>
                              <tr>
                                <td>Date of Birth</td>
                                <td><?=$logged['dob']; ?></td>
                              </tr>
                           
                                 <tr>
                                     <tr>
                                <td>Gender</td>
                                <td><?=$logged['sex']; ?></td>
                              </tr>
                                <tr>
                                <td>Home Address</td>
                                <td><?=$logged['address']; ?></td>
                              </tr>
                              <tr>
                                <td>Email</td>
                                <td><?=$logged['email']; ?></a></td>
                              </tr>
                                <td>Phone Number</td>
                                <td><?=$logged['mobile']; ?></td>
                              </tr>
                              <tr>
                                <td><a href="<?=base_url('user/updateProfile/open/'.$logged['user_id']);?>" class="btn btn-primary">Edit Profile</a></td>
                                <td><a href="<?=base_url('user/treeView/open/'.$logged['user_id']);?>" class="btn btn-primary">Tree View</a></td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                         <!-- <div class="panel-footer">
                                <a data-original-title="Broadcast Message" data-toggle="tooltip" type="button" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-envelope"></i></a>
                                <span class="pull-right">
                                    <a href="edit.html" data-original-title="Edit this user" data-toggle="tooltip" type="button" class="btn btn-sm btn-warning"><i class="glyphicon glyphicon-edit"></i></a>
                                    <a data-original-title="Remove this user" data-toggle="tooltip" type="button" class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-remove"></i></a>
                                </span>
                            </div> -->
                    
                  </div>
                </div>
              </div>
            </div>
          <!-- All Content End here -->
        </div>
      </div>
    </div>
</body>
<?php include('includes/footer.php'); ?>
<style type="text/css">
  table tr th{
    text-align: center;
  }
  table tr td{
    text-align: center;
  }
</style>
<script type="text/javascript">
  function confirmDelete()
  {
    var con=confirm('Are you sure to delete this user.');
   // var con=confirm('Do you want to really delete it.');
    if(con)
    {return true;}else {return false;}
  }
</script>