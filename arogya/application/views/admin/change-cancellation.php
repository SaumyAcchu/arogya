<!DOCTYPE html>
<html lang="en">
<head>
    <title><?=$page['page']='Chang Cancellation Date';?> | <?=$this->siteInfo['name'];?></title>
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
        <div class="col-sm-12">
          <table class="table table-hover table-bordered table-striped table-condensed">
                <tbody>
                  <tr rowspan="2">
                    <th><center><img src="<?=base_url('uploads/'.$this->siteInfo['image']);?>" height="80" width="80"></center></th>
                    <td class="txtcenter" colspan="5">
                      <b><?=$this->siteInfo['name'];?></b><br>
                      <?=$this->siteInfo['address'];?><br>
                      <p>Installment Status</p>
                    </td>
                  </tr>
                  <?php $flat=$this->db_model->getWhere('flat',['id'=>$get_data['flat_id']]); ?>
                  <tr>
                    <th>Property Type</th><td colspan="3" style="color: blue;">Plot</td>
                    <th>Registration No</th><td class="txtred"><?=$get_data['registration'];?></td>
                  </tr>
                  <tr>
                    <th>Name</th><td colspan="3"><?=$get_data['name'];?></td><th>Mobile</th><td><?=$get_data['mobile'];?></td>
                  </tr>
                  <tr>
                    <th>Address</th><td colspan="5"><?=$get_data['address'];?></td>
                  </tr>
                  <tr>
                    <td colspan="6" style="color: red;">Plot Details</td>
                  </tr>
                  <tr>
                    <th>Plot No.</th><td colspan="2"><?=$flat['flat_num']; ?></td>
                    <th>Area</th><td colspan="2" style="text-align: right;"><?=$flat['area']; ?>Sq.ft</td>
                  </tr>
                  <tr>
                    <th>Location</th><td colspan="2"><?=$flat['location']; ?></td>
                    <th>Rate</th><td style="text-align: right;" colspan="2"><?=$flat['rate']; ?>/Sq.ft</td>
                  </tr>
                 
                 
                 
                </tbody>
              </table>
            <div class="col-lg-offset-3 col-lg-6">
                <?=form_open('real1/newcancelled_date'); ?>               
                 <!--  <input type="hidden" name="cancelled_total_amount" value="<?= $paid ?>">
                  <input type="hidden" name="id" value="<?= $userData['id'] ?>"> -->
                  <input type="hidden" name="id" value="<?= $get_data['id'] ?>">
                  <table class="table table-hover table-bordered table-striped" border="1" cellpadding="5" style="width:100%;">
                    <tbody>
                      <tr><th>Cancellation Date : </th><td><?=$this->db_model->dmy($get_data['next_due_date']) ?></td></tr>
                      <tr><th>Next Cancellation Date</th>
                        <td>
                         <span id="datepairExample">
                           <input type="text" value="" name="next_due_date" class="form-control date" id="datepicker" placeholder="dd-mm-yyyy" required>
                         </span>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                  <button type="submit" class="btn btn-danger btn-block btn-sm">Cancale Flat</button>
                </form>
            </div>
            </div>
          <!--//===============Main Container End=============//-->
          </div>
      </div>
    </div>
  <!--==========Footer Start=============-->
  <?php $this->load->view('include/footer'); ?>


  <script type="text/javascript">
    $('#datepairExample .date').datepicker({
                      'format': 'dd-mm-yyyy',
                      'autoclose': true
                  });
  </script>
  <!--==========Footer End=============-->   
</body>
</html>
