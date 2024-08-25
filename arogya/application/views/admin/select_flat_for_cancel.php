<!DOCTYPE html>
<html lang="en">
<head>
    <title><?=$page['page']='Select Plot Number';?> | <?=$this->siteInfo['name'];?></title>
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
            <div class="row">
              <div class="col-lg-10 col-lg-offset-1">
                <table class="table table-striped table-hover table-bordered">
                   <tbody>
                    <tr>
                      <td>
                        <div class="input-group">
                           <span class="input-group-addon" id="basic-addon1">Select Property Type</span>
                           <?=form_open('real1/cansalPlot/select-data'); ?>
                           <select name="building_id" class="form-control" id="branchID" required>
                            <?php $project = $this->db_model->selectAll('project'); ?>
                            <?php foreach($project as $buildingData): ?>
                            <option value="<?= $buildingData['id']; ?>"><?= $buildingData['name']; ?></option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                      </td>
                      <td>
                        <div class="input-group">
                           <span class="input-group-addon" id="basic-addon1">Enter Registration Number</span>
                            <input type="text" class="form-control" value="" name="registration" placeholder="User Registration Number">
                        </div>
                      </td>
                      <td style="padding-top: 12px;">
                     <button type="submit" class="btn btn-danger btn-block btn-sm">Get Details</button></td>
                     </form>
                    </tr>
                  </tbody>
                </table>
              </div> 
            </div>      
          </div>
          <!--//===============Main Container End=============//-->
          </div>
      </div>
    </div>
  <!--==========Footer Start=============-->
  <?php $this->load->view('include/footer'); ?>
  <!--==========Footer End=============-->   
</body>
</html>
