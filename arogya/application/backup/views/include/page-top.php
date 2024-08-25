            <div class="row">
                <div class="col-md-4">
                  <ul class="breadcrumb">
                <li><i class="fa fa-home"></i><a href="<?=base_url('real1');?>"> Home</a></li>
                <li class="active"><?=$page;?></li>
              </ul>
                </div>
                <div class="col-md-8">
                  <ul class="list-inline pull-right mini-stat hidden-sm hidden-xs">
                    <li>
                      <h3><span class="stat-value color-blue"><i class="fa fa-calendar"></i> <?=date('d-M-Y');?></span></h3>
                      
                    </li>
                    <!-- <li>
                      <h5>SUBSCRIBERS <span class="stat-value color-green"><i class="fa fa-plus-circle"></i> 150,743</span></h5>
                      
                    </li> -->
                    <li>
                      <h3><span class="stat-value color-orang"><i class="fa fa-history"></i> <aa id="clock"></aa></span></h3>
                    </li>
                  </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                  <div class="main-header">
                <h4><?=$page;?></h4>
                <em>the first priority information</em>
                </div>
                </div>
            </div>
            <!-- ///Flash Message Start/// -->
          <?php if($alert=$this->session->flashdata('msg')): $class=$this->session->flashdata('msg_class'); ?>
            <div class="row"><div class="col-sm-6 col-sm-offset-3"><div class="alert alert-dismissible <?= $class; ?> txtblack"><button type="button" class="close" data-dismiss="alert">&times;</button><p><?php echo $alert; ?></p></div></div></div>
            <?php endif; ?>
          <!-- ///Flash Message End/// -->
<script type="text/javascript">
  $(document).ready(function(){
   setInterval('updateClock()', 1000);
});

function updateClock (){
  var currentTime = new Date ( );
    var currentHours = currentTime.getHours ( );
    var currentMinutes = currentTime.getMinutes ( );
    var currentSeconds = currentTime.getSeconds ( );

    // Pad the minutes and seconds with leading zeros, if required
    currentMinutes = ( currentMinutes < 10 ? "0" : "" ) + currentMinutes;
    currentSeconds = ( currentSeconds < 10 ? "0" : "" ) + currentSeconds;

    // Choose either "AM" or "PM" as appropriate
    var timeOfDay = ( currentHours < 12 ) ? "AM" : "PM";

    // Convert the hours component to 12-hour format if needed
    currentHours = ( currentHours > 12 ) ? currentHours - 12 : currentHours;

    // Convert an hours component of "0" to "12"
    currentHours = ( currentHours == 0 ) ? 12 : currentHours;

    // Compose the string for display
    var currentTimeString = currentHours + ":" + currentMinutes + ":" + currentSeconds + " " + timeOfDay;
    
    
    $("#clock").html(currentTimeString);      
 }
</script>