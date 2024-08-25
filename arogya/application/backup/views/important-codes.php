<!-- Date Format -->
<?php
public function pinGenerate($param1='',$param2='')
  {
    $letter=str_shuffle('QWERTYUIOPASDFGHJKLZXCVBNM');
    $str=substr($letter,0,3);
    $digit=time();
    $digit=$digit+rand(1000,9999);
    return $str.$digit;
  }


$date1=date_create($data['deposit_date']);
$data['deposit_date']=date_format($date1,'Y-m-d');
//========Time Zone ============//
date_default_timezone_set('Asia/Kolkata');
date('d-M-Y'); //For date
date('h : i : s A') //For Time
//==========Date Difference ================//
      $date2=date_create(date('Y-m-d'));
      $diff=date_diff($date1,$date2);
      $month=$diff->format("%a days");
      $totalmonth=round($month/30); 

//==========time interval=============//
$thirdYear=date_create($data['registration_date']);
date_add($thirdYear,date_interval_create_from_date_string("3 Year"));
$data['third_year']= date_format($thirdYear,"Y-m-d");


?>


<!-- Date Picker -->
<div class="col-lg-4">
    <span id="datepairExample">
        <input type="text" value="<?= set_value('dob'); ?>" name="dob" class="form-control date" id="datepicker" placeholder="dd-mm-yyyy" required>
    </span>
</div>
<!-- //==============Disable All Links except some ====================// -->
<script type="text/javascript">

    function disable(){
        var good_links = new Array();
        good_links[0] = "<?=base_url('user/logout');?>";
        good_links[1] = "http://www.yahoo.com/";
        good_links[2] = "http://www.bing.com/";
        links=document.getElementsByTagName('A');
        for(var i=0; i<links.length; i++) {
            if (!inArray(links[i].href, good_links)) {
                links[i].href="javascript:return false";
            }
        }
    }

    function inArray(needle, haystack) {
        var length = haystack.length;
        for(var i = 0; i < length; i++) {
            if(haystack[i] == needle) return true;
        }
        return false;
    }

    window.onload=disable;

</script>
<script type = "text/javascript" >
// Disable Browser Back Button
history.pushState(null, null, '');
window.addEventListener('popstate', function(event) {
history.pushState(null, null, '');
});
</script>
<!-- Image Upload -->
    <legend>Upload Photo</legend>
        <div class="form-group">
            <label class="col-lg-2 control-label">Choose Photo:</label>
            <div class="col-lg-4">
              <input type="file" accept="image" name="image" id="image_path" class="form-control image_path">
                <span id="imageError" style="color: red;"></span>
               <?php if(isset($file_error)) { echo $file_error; } ?>
            </div>
            <label class="col-lg-2 control-label"></label>
            <div class="col-lg-4">
              <img src="" style="display: none;" id="blah" height="100" width="100">
            </div>
        </div>   
<script type="text/javascript">
// Show Image on Select //
function readURL(input) {
    if (input.files && input.files[0])
    {
        var reader = new FileReader();
        reader.onload = function (e) {
        $('#blah').css('display','block');
        $('#blah').attr('src', e.target.result);
    }

        reader.readAsDataURL(input.files[0]);
    }
}

$(".image_path").change(function(){
    readURL(this);
});


// Date Picker //
 $('#datepairExample .date').datepicker({
                    'format': 'dd-mm-yyyy',
                    'autoclose': true
                });
 

//image size validation //
function validateImageSize()
{
 	var img_size=$("#image_path")[0].files[0].size;
 	if(img_size>250000)
 	{
 		$("#imageError").html('Image size must be less than 200KB');
 		return false;
 	}else
    {
        return true;
    }
}

//pan or aadhar validation
function validatePan()
{
 	var pan=$("#pan_aadhar").val();
 	var chk=pan.substr(0,3);
 	var chkpan = /^([A-Z]){5}([0-9]){4}([a-zA-Z]){1}?$/;
 	if(chk.match(/[A-Z]/))
 	{
 		if(chkpan.test(pan)==false)
	 	{ $("#verify").html("PAN Number format is wrong").css('color','red'); return false; }
	 else{ $("#verify").html("PAN Number Accepted").css('color','green'); return true; }
 	}
 	if(chk.match(/[0-9]/))
 	{
 		if(pan.match(/[0-9]/) && pan.length==12)
 			{$("#verify").html("AADHAR Number Accepted").css('color','green'); return true;}else
 		{ $("#verify").html("AADHAR Number format is wrong").css('color','red');  return false;}
 	}
 	if(chk.match(/[a-z]/))
 		{ $("#verify").html("AADHAR/PAN Number format is wrong").css('color','red'); return false; }
}

// Call Datatable 
 $(document).ready(function() {
    $('#example1').DataTable();
} );

// Validate image Type
 $("body").on("click", "#btnUpload", function () {
        var allowedFiles = [".jpg", ".png", ".gif",".jpeg"];
        var fileUpload = $("#fileUpload");
        var lblError = $("#lblError");
        var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(" + allowedFiles.join('|') + ")$");
        if (!regex.test(fileUpload.val().toLowerCase())) {
            lblError.html("Please upload files having extensions: <b>" + allowedFiles.join(', ') + "</b> only.");
            return false;
        }
        lblError.html('');
        return true;
    });

// For print Particular div
$("#printId").click(function(){
        var printContents = $("#myTable").html();
         var frame1 = $('<iframe />');
        frame1[0].name = "frame1";
        frame1.css({ "position": "absolute", "top": "-1000000px" });
        $("body").append(frame1);
      var frameDoc = frame1[0].contentWindow ? frame1[0].contentWindow : frame1[0].contentDocument.document ? frame1[0].contentDocument.document : frame1[0].contentDocument;
        frameDoc.document.open();
      frameDoc.document.write('<html><head><link rel="stylesheet" type="text/css" href="" /></head><body onload="window.print()">' + printContents + '</body></html>');
      frameDoc.document.close();
    }); 


</script>
 <!--code for digit to string -->
        <?php
        $number = $total;
         $no = round($number);
         $point = round($number - $no, 2) * 100;
         $hundred = null;
         $digits_1 = strlen($no);
         $i = 0;
         $str = array();
         $words = array('0' => '', '1' => 'One', '2' => 'Two',
          '3' => 'Three', '4' => 'Four', '5' => 'Five', '6' => 'Six',
          '7' => 'Seven', '8' => 'Eight', '9' => 'Nine',
          '10' => 'Ten', '11' => 'Eleven', '12' => 'Twelve',
          '13' => 'Thirteen', '14' => 'Fourteen',
          '15' => 'Fifteen', '16' => 'Sixteen', '17' => 'Seventeen',
          '18' => 'Eighteen', '19' =>'Nineteen', '20' => 'Twenty',
          '30' => 'Thirty', '40' => 'Forty', '50' => 'Fifty',
          '60' => 'Sixty', '70' => 'Seventy',
          '80' => 'Eighty', '90' => 'Ninety');
         $digits = array('', 'Hundred', 'Thousand', 'Lakh', 'Crore');
         while ($i < $digits_1) {
           $divider = ($i == 2) ? 10 : 100;
           $number = floor($no % $divider);
           $no = floor($no / $divider);
           $i += ($divider == 10) ? 1 : 2;
           if ($number) {
              $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
              $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
              $str [] = ($number < 21) ? $words[$number] .
                  " " . $digits[$counter] . $plural . " " . $hundred
                  :
                  $words[floor($number / 10) * 10]
                  . " " . $words[$number % 10] . " "
                  . $digits[$counter] . $plural . " " . $hundred;
           } else $str[] = null;
        }
        $str = array_reverse($str);
        $result = implode('', $str);
        echo $result . "Rupees";
       ?> 

<!-- Pie Chart -->
 <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
 <?php public function pieChart($param1='')
    {
        $res=$this->db_model->getWhere('customer_registration',['account_number'=>$param1]);
        $res1=$this->db_model->globalSelect('installments',['account_number'=>$param1]);
        foreach ($res1 as $key => $value) {
            $num[]=$value;
        }
        $row=count($num);
        $paid=$row*$res['installment_amt'];
        $due=$res['product_cost']-$paid;
        $rows[]=array("c"=>array("0"=>array("v"=>"Paid","f"=>NULL),"1"=>array("v"=>(int)$paid,"f" =>NULL)));
        $rows[]=array("c"=>array("0"=>array("v"=>"Due","f"=>NULL),"1"=>array("v"=>(int)$due,"f" =>NULL)));
        echo $format = '{
        "cols":
        [
        {"id":"","label":"Subject","pattern":"","type":"string"},
        {"id":"","label":"Number","pattern":"","type":"number"}
        ],
        "rows":'.json_encode($rows).'}';
    }
    ?>
    <script type="text/javascript">
                      // Load the Visualization API and the piechart package.
                    google.charts.load('current', {'packages':['corechart']});
                    // Set a callback to run when the Google Visualization API is loaded.
                    google.charts.setOnLoadCallback(pie_chart);
                   
                    function pie_chart() {
                      var jsonData = $.ajax({
                          url: '<?=base_url("branch/pieChart/".$customerData['account_number']);?>',
                          dataType: "json",
                          async: false
                          }).responseText;
                          
                      // Create our data table out of JSON data loaded from server.
                     //alert(jsonData);return false;
                    var data = new google.visualization.DataTable(jsonData);

                      // Instantiate and draw our chart, passing in some options.
                      var chart = new google.visualization.PieChart(document.getElementById('piechart_div'));
                      chart.draw(data, {width: 400, height: 240});
                    }
                </script>
                <center><div id="piechart_div"></div></center>


<!-- Multiple Payments -->
<div class="col-md-4">
                    <label>Select Payment Mode</label>
                    <select name="pay_mode" class="form-control" id="pay_mode" required>
                      <option value="">Please Select</option>
                      <option value="Cash">Cash</option>
                      <option value="Cheque">Cheque</option>
                    </select>
                    <p style="color: red;" id="errMode"></p>
                  </div>
                </div><span id="csh">
                <span id="cash" style="display: none;">
                  <div class="form-group">
                    <div class="col-md-4">
                      <label>Amount</label>
                      <input type="number" class="form-control" placeholder="Enter Amount" name="pay_amount" id="pay_amount" value="">
                      <p style="color: red;" id="errAmt"></p>
                    </div>
                  </div>
                </span></span><span id="chk">
                <span id="cheque" style="display: none;">
                <div class="form-group">
                    <div class="col-md-4">
                      <label>Cheque Number</label>
                      <input type="number" id="cheque_num" name="cheque_num[]" placeholder="Enter Cheque Number" value="" class="form-control">
                      <p style="color: red;" id="errChknm"></p>
                    </div>
                    
                    <div class="col-md-4">
                      <label>Cheque Detail</label>
                      <input type="text" id="cheque_num" name="cheque_detail[]" placeholder="Enter Bank Detail" value="" class="form-control">
                      <p style="color: red;" id=""></p>
                    </div>
                    <div class="col-md-3">
                      <label>Amount</label>
                      <input type="number" class="form-control" placeholder="Enter Amount" name="pay_amount[]" id="pay_amount" value="">
                      <p style="color: red;" id="errAmt"></p>
                    </div>
                    <div class="col-md-1">
                      <label>Add</label>
                      <button class="btn btn-success" type="button"  onclick="education_fields();"> <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> </button>
                    </div>
                  
                </div>
                <div id="education_fields">
                  
                </div>
                </span></span>
  <script type="text/javascript">
     $('#pay_mode').change(function(){
    var data=$('select[name="pay_mode"] option:selected').val();
    if(data=='Cheque')
    {
      $("#chk").contents().each(function(index, node){
        if (node.nodeType == 8) {
            // node is a comment
            $(node).replaceWith(node.nodeValue);
          }
      });

      $('#cheque').css('display','block');
      my_element_jq1 = $('#cash');
      comment1 = document.createComment(my_element_jq1.get(0).outerHTML);
      my_element_jq1.replaceWith(comment1);
    
    }
    if(data=='Cash')
    {
      $("#csh").contents().each(function(index, node1) {
          if (node1.nodeType == 8) {
              // node is a comment
              $(node1).replaceWith(node1.nodeValue);
          }
      });

      $('#cash').css('display','block');
      my_element_jq = $('#cheque');
      comment = document.createComment(my_element_jq.get(0).outerHTML);
      my_element_jq.replaceWith(comment);
     
    }
  });

  $('#btnSubmit').click( function(){
    var mode=$('select[name="pay_mode"] option:selected').val();
    if($.trim(mode)=='')
    {
      $('#errMode').html('This Field must be required');
      return false;
    }
    if(mode=='Cheque')
    {
      var chknm=$('#cheque_num').val();
      if($.trim(chknm)=='')
      {
        $('#errChknm').html('This Field must be required');
        return false;
      }
    }
    var amt=$('#pay_amount').val();
    if($.trim(amt)=='')
    {
      $('#errAmt').html('This Field must be required');
      return false;
    }
  });
  
var room = 1;
function education_fields() {
 
    room++;
    var objTo = document.getElementById('education_fields');
    var divtest = document.createElement("div");
  divtest.setAttribute("class", "form-group removeclass"+room);
  var rdiv = 'removeclass'+room;
    divtest.innerHTML = '<div class="col-md-4"><label>Cheque Number</label><input type="number" id="cheque_num" name="cheque_num[]" placeholder="Enter Cheque Number" value="" class="form-control" required><p style="color: red;" id="errChknm"></p></div><div class="col-md-4"><label>Cheque Detail</label><input type="text" id="cheque_num" name="cheque_detail[]" placeholder="Enter Bank Detail" value="" class="form-control"><p style="color: red;" id=""></p></div><div class="col-md-3"><label>Amount</label><input type="number" class="form-control" placeholder="Enter Amount" name="pay_amount[]" id="pay_amount" value="" required><p style="color: red;" id="errAmt"></p></div><div class="col-md-1"><label>Remove</label><button class="btn btn-danger" type="button" onclick="remove_education_fields('+ room +');"> <span class="glyphicon glyphicon-minus" aria-hidden="true"></span> </button></div>';
    
    objTo.appendChild(divtest)
}
   function remove_education_fields(rid) {
     $('.removeclass'+rid).remove();
   }
  </script>