<!DOCTYPE html>
<html lang="en">
<head>
  	<title><?=$page['page']='User Query';?> | <?=$this->siteInfo['name'];?></title>
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
					
<!-- ///=====================All Contents Start Here==========================================/// -->
				<div class="col-lg-8">
					<div class="panel panel-info">
						<div class="panel-heading">
							<span class="panel-title">Queries from user</span>
						</div>
						<div class="panel-body">
							<div class="table-responsive">
								<table id="table1" class="table table-bordered table-striped table-hover table-condensed">
									<thead>
										<tr>
											<th>Sl</th>
											<th>User ID</th>
											<th>Name</th>
											<th>Date</th>
											<th>Mobile</th>
											<th>Message</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
									<?php if($data){ $i=1;
									foreach ($data as $key => $value) { ?>
										<tr>
											<td><?=$i;?></td>
											<td><?=$value['user_id'];?></td>
											<td><?=$value['name'];?></td>
											<td><?=$value['date'];?></td>
											<td><?=$value['mobile'];?></td>
											<td><?=$value['message'];?></td>
											<td>
												<?php $res=$this->db_model->rowCount('query',['query_id'=>$value['id']]);
												if($res>0)
												{
													$row=$this->db_model->getWhere('query',['query_id'=>$value['id']]); ?>
													<button onclick="return repliedModal('<?=$row['date'];?>','<?=$row['message'];?>')" class="btn btn-circle btn-success btn-sm"><i class="fa fa-check"></i></button>
												<?php }else{ ?>
													<button onclick="return quickReply('<?=$value['id'];?>','<?=$value['user_id'];?>')" class="btn btn-info btn-sm btn-circle"><i class="fa fa-location-arrow"></i></button>
												<?php } ?>
												<a href="<?=base_url('control/queryDelete/query/'.$value['id']);?>" onclick="return conDel()" class="btn btn-danger btn-circle"><i class="fa fa-trash"></i></a>
											</td>
										</tr>	
									<?php $i++; }	}else{ ?>
										<tr>
											<td colspan="7">No Records Found</td>
										</tr>
									<?php } ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-4">
					<div class="panel panel-info">
						<div class="panel-heading">
							<span class="panel-title">Reply User</span>
						</div>
						<div class="panel-body">
							<?=form_open('control/quickReply');?>
							<div class="form-group">
								<label>User ID</label>
								<input type="text" id="receiver_id" name="receiver_id" class="form-control" required>
								<input type="hidden" name="query_id" value="" id="query_id">
								<?php date_default_timezone_set('Asia/Kolkata'); ?>
								<input type="hidden" name="date" value="<?=date('Y-m-d');?>">
								<input type="hidden" name="time" value="<?=date('h:i:s A');?>">
								<input type="hidden" name="status" value="1">
								<input type="hidden" name="sender" value="Admin">
							</div>
							<div class="form-group">
								<label>Message</label>
								<textarea placeholder="Type your reply here..." name="message" class="form-control" required></textarea>
							</div>
							<div class="form-group">
								<button type="submit" class="btn btn-primary"> Send </button>
							</div>
							</form>
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
   <!-- Bootstrap Modal for Replied Query -->
            <div class="modal fade" id="noticeModal" role="dialog">
              <div class="modal-dialog modal-md">
                <div class="modal-content">
                  <div class="modal-body" style="padding: 0px;">
                    	<div class="panel panel-primary" style="margin-bottom: 0px;">
  		                <div class="panel-heading">
  			               <p class="panel-title">Query Reply
  			               <button type="button" class="close pull-right" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span></button></p>
  		                </div>
  		                <div class="panel-body">
                    			<div class="list-group">
  							  <a href="#" class="list-group-item"><b>Reply Date : </b><h5 class="txtred" id="noticeDate"></h5></a>
  							  <a href="#" class="list-group-item"><b>Reply Message : </b><p id="notice"></p></a>
  	            		    </div>
  		                </div>
  		            </div>
                  </div>
                </div>
              </div>
            </div>
          <!-- Modal End -->
  <style type="text/css">
  	.txtSize{
  		font-size: 16px;
  	}
  	th{
  		text-align: center;
  	}
  	td{
  		text-align: center;
  	}

  .btn-circle {
    width: 30px;
    height: 30px;
    text-align: center;
    padding: 6px 0;
    font-size: 12px;
    line-height: 1.428571429;
    border-radius: 15px;
  }
  .btn-circle.btn-lg {
    width: 50px;
    height: 50px;
    padding: 10px 16px;
    font-size: 18px;
    line-height: 1.33;
    border-radius: 25px;
  }
  .btn-circle.btn-xl {
    width: 70px;
    height: 70px;
    padding: 10px 16px;
    font-size: 24px;
    line-height: 1.33;
    border-radius: 35px;
  }

  </style>
  <script type="text/javascript">
  	function quickReply(repid,userid)
  	{
  		$('#receiver_id').val(userid);
  		$('#query_id').val(repid);
  	}
  		$(document).ready(function() {
  $('#table1').DataTable();
  });

  function repliedModal(date,message)
  	{
  		$('#noticeModal').modal('show');
  		$('#noticeDate').html(date);
  		$('#notice').html(message);
  	}
  	function conDel()
  	{
  		var cnf=confirm('Are you sure to delete this message');
  		if(cnf)
  		{
  			return true;
  		}else
  		{
  			return false;
  		}
  	}
  </script>
</body>
</html>
