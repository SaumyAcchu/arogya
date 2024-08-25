<!DOCTYPE html>
<html lang="en">
<head>
    <title><?=$page['page']='Product Parchasing';?> | <?=$this->siteInfo['name'];?></title>
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
                <div class="row padding-top">
                    <div class="container-fluid padding-top main-container">
                        <!-- ///Flash Message End/// -->
                        <!-- ///=====================All Contents Start Here============= //-->
                        <div class="col-lg-12">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <p class="panel-title">Product Parchasing</p>
                                </div>
                                <div class="panel-body">
                                    <div class="col-lg-12">
                                    	<?= form_open_multipart('auth/parchaseProduct') ?>
                                    	<div class="col-lg-12">
                                    
                                    	</div>
                                      <div class="form-group">
                                        <div class="col-md-4">
                                          <label>Supplier Name</label>
                                          
             <?php $pakage = $this->db->get_where('supplier')->result_array() ?>
              <select name="supplier_id" class="form-control">
                <option value="">Select Supplier Name*</option>
                <?php foreach ($pakage as $key => $value)
                { ?>
                <option value="<?php echo $value['supplier_id'];?>"><?php echo $value['name'];?></option>
              <?php } ?>
              </select>
                                          <!--<input type="text" value="<?= set_value('supplier_id'); ?>" name="supplier_id" class="form-control txtupper noSpace" id="supplier_id" placeholder="Enter Supplier ID" required>-->
                                              <span id="err_supplier"></span>
                                        </div>
                                        <!--<div class="col-md-4">-->
                                        <!--  <label>Supplier Name</label>-->
                                        <!--   <input type="text" value="" id="supplier_name" class="form-control" readonly="">-->
                                              
                                        <!--</div>-->

                                        <div class="col-md-4">
                                          <label>Invoice Date</label>
                                          <span id="datepairExample">
                                            <input type="text" value="<?= date('d-m-Y'); ?>" name="date" class="form-control date" id="invoicedate" placeholder="dd-mm-yyyy" required>
                                            </span>
                                              
                                        </div>

                            
                                        <div class="col-md-4">
                                          <label>Invoice No</label>
                                           <input type="text" value="" id="invoiceno" name="invoiceno" class="form-control" >
                                              
                                        </div>


                                      </div>
                                      <div class="row"></div>
                                      <div class="col-md-12">
                                           <INPUT type="button" value="Add Row" onclick="addRow('dataTable')" />

                                         <INPUT type="button" value="Delete Row" onclick="deleteRow('dataTable')" />
                                       
                                       </div>

                                      <div class="col-md-12">
                                          
                                        <TABLE id="dataTable">
                                            <TR>
                                         <TD><INPUT type="checkbox" name="chk"/></TD>
                                          <TD>
                   <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                                  <label>Select Product*</label>
                                         <?php $pakage = $this->db->get_where('product')->result_array() ?>
                <select name="product_id[]" class="form-control" id="product_id">
                <option value="product_id[]">Select Product*</option>
                <?php foreach ($pakage as $key => $value) { ?>
                <option value="<?php echo $value['id'];?>"><?php echo $value['name'];?></option>
              <?php } ?>
              </select></div>
                                                 </TD>
                                              <TD>
                                                 <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                               <label>Product HSN Code</label>
                            <INPUT type="text" class="form-control" id="product_hsn" name="product_hsn[]" placeholder="Enter Product HSN Code" /></div></TD>

                                               <TD>
                                                 <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                               <label>Product Batch No</label>
                                                <INPUT type="text" class="form-control"  id="batch_no" name="batch_no[]" /></div></TD>
                                           

                                                <TD>
                                                 <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                               <label>Product Qty</label>
                                                <INPUT type="number" class="form-control"  name="product_qty[]" id="product_qty" /></div></TD>

                                                <TD>
                                                 <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                               <label>Product Parchese Rate</label>
                                                <INPUT type="number" class="form-control"  id="product_price" name="product_price[]" /></div></TD>

                                                <TD>
                                                 <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                               <label>Product IGST (%)</label>
                                                <INPUT type="number" class="form-control"  name="product_igst[]" id="product_igst"  /></div></TD>

                                                <TD>
                                                 <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                               <label>EProduct SGST(%)</label>
                                                <INPUT type="number" class="form-control"  name="product_sgst[]" id="product_sgst" /></div></TD>

                                                <TD>
                                                 <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                               <label>Product CGST(%)</label>
                                                <INPUT type="number" class="form-control"  name="product_cgst[]" id="product_cgst" /></div></TD>
                                                  </TR>
                                                 </TABLE>
                                </div>
                                      
                                   
                                       <div class="row"></div>
                                       <div id="education_fields">
                                         
                                       </div>
<div class="row"></div>
                                       <div class="form-group">
                                       <div class="col-lg-4">                                           
                                           <br>
                                           <button type="submit" class="btn btn-primary">Add Product</button>
                                       </div>
                                       </div>
                                        
                                    </form>
                                    </div>
                                   
                                </div>
                            </div>
                        </div>
                        
                        <!-- All Content End here -->
                        <!-- Bootstrap Modal fo confirmation -->
                        
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
<script type="text/javascript">

	$('#datepairExample .date').datepicker({
                    'format': 'dd-mm-yyyy',
                    'autoclose': true
                });

	$('#supplier_id').change(function(){
		var supplierID=$('#supplier_id').val();
		$.ajax({
			url:"<?=base_url('login/getSupplier');?>",
			type:'post',
			data:{id:supplierID},
			success:function(data)
			{
				if(data==0)
				{
					$('#err_supplier').html('Supplier ID is Not Exist/Active');
				}else
				{
					
					$('#err_supplier').html('');
					$('#supplier_name').val(data);
				}
				//alert(data);
			}
		});
	});	

	$('#product_id').change(function() {
		var productId = $('#product_id').val();
		// alert(productId);
		$.ajax({
			url: '<?=base_url('login/getProduct'); ?>',
			type: 'post',			
			data: {id:productId},
			success:function(data)
			{
             if (data==0) {
             	$('#err_product').html('Product id is not Exist')
             }else{
             	$('err_product').html('');
             	$('#product_name').val(data);
             }
             // alert('data');
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


<script type="text/javascript">
  var room = 1;
  function education_fields() {
   
      room++;
      var objTo = document.getElementById('education_fields');
      var divtest = document.createElement("div");
    divtest.setAttribute("class", "form-group removeclass"+room);
    var rdiv = 'removeclass'+room;

      divtest.innerHTML = '<div class="row"></div><div class="col-md-4"><label>Peoduct Id</label> <select name="product_id[]" class="form-control" id="product_id"><option>sddfds</option><option value="<?php echo $value['id'];?>"><?php echo $value['name'];?></option></select><p style="color: red;" id="errChknm"></p></div><div class="col-md-4"><label>Product HSN</label><input type="text" id="product_hsn" name="product_hsn[]" placeholder="Enter Product HSN" value="" class="form-control"><p style="color: red;" id=""></p></div><div class="col-md-4"><label>Product Batch No</label><input type="text" id="batch_no" name="batch_no[]" placeholder="Enter Product Batch No" value="" class="form-control"><p style="color: red;" id=""></p></div><div class="col-md-4"><label>Product Qty</label><input type="text" id="product_qty" name="product_qty[]" placeholder="Enter Product QTY" value="" class="form-control"><p style="color: red;" id=""></p></div><div class="col-md-4"><label>Product Parchese Rate</label><input type="text" id="product_price" name="product_price[]" placeholder="Enter Product Price" value="" class="form-control"><p style="color: red;" id=""></p></div><div class="col-md-4"><label>Product IGST</label><input type="text" id="product_igst" name="product_igst[]" placeholder="Enter Product Product IGST" value="" class="form-control"><p style="color: red;" id=""></p></div><div class="col-md-4"><label>Product SGST</label><input type="number" class="form-control" placeholder="Enter SGST" name="product_sgst[]" id="product_sgst" value="" required></div><div class="col-md-4"><label>Product CGST</label><input type="number" class="form-control" placeholder="Enter CGST" name="product_cgst[]" id="product_cgst" value="" required></div><div class="col-md-1"><label>Remove</label><button class="btn btn-danger" type="button" onclick="remove_education_fields('+ room +');"> <span class="glyphicon glyphicon-minus" aria-hidden="true"></span> </button></div>';
      
      objTo.appendChild(divtest)
  }
     function remove_education_fields(rid) {
       $('.removeclass'+rid).remove();
     }
</script>
<SCRIPT language="javascript">
    function addRow(tableID) {

      var table = document.getElementById(tableID);

      var rowCount = table.rows.length;
      var row = table.insertRow(rowCount);

      var colCount = table.rows[0].cells.length;

      for(var i=0; i<colCount; i++) {

        var newcell = row.insertCell(i);

        newcell.innerHTML = table.rows[0].cells[i].innerHTML;
        //alert(newcell.childNodes);
        switch(newcell.childNodes[0].type) {
          case "text":
              newcell.childNodes[0].value = "";
              break;
          case "checkbox":
              newcell.childNodes[0].checked = false;
              break;
          case "select-one":
              newcell.childNodes[0].selectedIndex = 0;
              break;
        }
      }
    }

    function deleteRow(tableID) {
      try {
      var table = document.getElementById(tableID);
      var rowCount = table.rows.length;

      for(var i=0; i<rowCount; i++) {
        var row = table.rows[i];
        var chkbox = row.cells[0].childNodes[0];
        if(null != chkbox && true == chkbox.checked) {
          if(rowCount <= 1) {
            alert("Cannot delete all the rows.");
            break;
          }
          table.deleteRow(i);
          rowCount--;
          i--;
        }


      }
      }catch(e) {
        alert(e);
      }
    }

  </SCRIPT>