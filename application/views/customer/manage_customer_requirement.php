<!doctype html>
<html class="no-js" lang="en">

<head>
   <?php $this->load->view('common/header_link'); ?>

   <link rel="stylesheet" href="<?php echo base_url('catalogs'); ?>/css/modals.css">
    <link rel="stylesheet" href="<?php echo base_url('catalogs'); ?>/css/preloader/preloader-style.css">
   <link rel="stylesheet" href="<?php echo base_url('catalogs'); ?>/css/calendar/fullcalendar.min.css">
    <link rel="stylesheet" href="<?php echo base_url('catalogs'); ?>/css/calendar/fullcalendar.print.min.css">

    <style type="text/css">
        .message{
            width:100%;
            height:40px;

            padding-top:8px;
            text-align:center; color:red;
            box-shadow: 0px 3px 7px -1px rgba(0,0,0,0.6);
            display: none;

        }
        .message.error{
              color: #ffffff;
             background-color: #e91e63;
             border:1px solid #e91e63;
        }
        .message.success{
             color: #ffffff;
             background-color: #4caf50;
             border:1px solid green;
        }
        .message.card{
             color: #ffffff;
             background-color: #ff9600;
             border:1px solid #ff9600;
        }

    </style>
</head>

<body>
    <div class="preloader-single shadow-inner mg-b-30" id="my_loader" style="position:fixed; background: rgba(0,0,0,0.8); width:100%; height:100vh; z-index: 9999; display:none;">
        <div class="ts_preloading_box" style="">
            <div id="ts-preloader-absolute09" style="position:fixed; margin:auto;   border-radius:70px;">
                <div class="tsperloader9" id="tsperloader9_one"></div>
                <div class="tsperloader9" id="tsperloader9_two"></div>
                <div class="tsperloader9" id="tsperloader9_three"></div>
                <div class="tsperloader9" id="tsperloader9_four"></div>
            </div>
        </div>
    </div>
    <?php $this->load->view('common/sidemenu'); ?>
    <div class="all-content-wrapper">

        <?php $this->load->view('common/titlebar'); ?>

			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding:0px;">
            <div class="container-fluid" style="margin-top:15px; ">
               <div class="product-status-wrap mycard">
			    <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div id="myheadtitle" style=" ">
                              <b>  Delivery Schedule </b> / <?php if(isset($selected_customer[0]->first_name)){ echo $selected_customer[0]->first_name.' '.$selected_customer[0]->last_name; } ?>
                                
                               <a href="<?php echo base_url(); ?>/customer/view_customer/<?php if(isset($selected_customer[0]->customer_id)){ echo $selected_customer[0]->customer_id;  } ?>"> <button type="button" class="btn " style="float:right; margin-top:-10px; background-color:#46c7fe; color:#ffffff;">Go To Account</button>
                                </a>
                            </div>
                            <div id="myTabContent" class="tab-content custom-product-edit">
                                <div class="product-tab-list tab-pane fade active in" id="description">
                                    <div class="row">

                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                             <div class="message error" style="display:<?php if(isset($message) && $message === "failed"){ echo "block"; } ?>">
                                                 Process is failed!
                                                 <button type="button" title="close" style="background-color:transparent; border:none; float:right;">X</button>
                                             </div>
                                             <div class="message card" style="display:<?php if(isset($message) && $message === "taken"){ echo "block"; } ?>">
                                                 This card number is already assigned.
                                                 <button type="button" title="close" style="background-color:transparent; border:none; float:right;">X</button>
                                             </div>
                                            <div class="message card" style="display:<?php if(isset($message) && $message === "lost"){ echo "block"; } ?>">
                                                 This card number is lost or broken!
                                                 <button type="button" title="close" style="background-color:transparent; border:none; float:right;">X</button>
                                             </div>
                                            <div class="message card" style="display:<?php if(isset($message) && $message === "invalid"){ echo "block"; } ?>">
                                                 This card number is not valid.
                                                <button type="button" title="close" style="background-color:transparent; border:none; float:right;">X</button>
                                             </div>
                                            <div class="message success" style="display:<?php if(isset($message) && $message === "success"){ echo "block"; } ?>">
                                                 Customer is successfully added.
                                                 <button type="button" title="close" style="background-color:transparent; border:none; float:right;">X</button>
                                             </div>
                                            <div class="review-content-section">
                                                <div id="dropzone1" class="pro-ad">
                                                    
                                                        <div class="row">
                                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                                <div class="input-group">
																    
                                                                    <input type="radio"  name="delivery_schedule" value="everyday" id="radio_1" <?php if(isset($_GET['delivery_schedule'])){ if($_GET['delivery_schedule'] == 'everyday'){ echo 'checked'; } }else{ echo 'checked'; } ?> /> &nbsp
                                                                    <label for="radio_1">Every Day</label>
                                                                    &nbsp &nbsp
                                                                     <input type="radio" name="delivery_schedule" value="Week" id="radio_2"  <?php if(isset($_GET['delivery_schedule'])){ if($_GET['delivery_schedule'] == 'Week'){ echo 'checked'; } } ?> /> &nbsp
                                                                    <label for="radio_2">Week Days</label>
                                                                   &nbsp &nbsp
                                                                    <input type="radio" name="delivery_schedule" value="Month" id="radio_3" <?php if(isset($_GET['delivery_schedule'])){ if($_GET['delivery_schedule'] == 'Month'){ echo 'checked'; } } ?> /> &nbsp
                                                                    <label for="radio_3">Month Days</label>
                                                                    
                                                                    
                                                                </div>
                                                                

                                                            </div>
                                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                                

                                                               
                                                               

																
                                                                   
                                                                    
                                                                 
                                                                 
                                                                 
                                                                
                                                            </div>
                                                        </div>
                                                        <form action="" method="post" class="dropzone dropzone-custom needsclick add-professors" id="demo1-upload">
                                                             <input type="hidden" name="req_array_daily" value="" >
                                                            
                                                             <input type="hidden" name="schedule" value="everyday">
                                                            
                                                        <div class="row" id="daily_row" >
                                                            <div class="col-lg-12">
                                                                <div class="asset-inner" >
                                                                 <table data-toggle="table"    data-key-events="true"   data-cookie="true"
                                                                           class="table-striped">
                                                                     <thead>
					                                 				<tr>
                                                                         <th>Sr No.</th>
					                                 			        <th>Product</th>
                                                                        
                                                                        <th><div display: <?php if($selected_customer[0]->shift_id == 2){ echo 'none'; } ?>> Morning </div></th>
                                                                        <th><div style="display: <?php if($selected_customer[0]->shift_id == 1){ echo 'none'; } ?>">Evening </div></th>
                                                                       
                                                                         <!--<th>Assign</th>-->
                                                                     </tr>
					                                 			    </thead>
					                                 		    	  <tbody id="tran_table">

                                                                          <?php if(isset($select_req)){  $s = 0; $i = 1; foreach($select_req as $index => $row){ $i++; if(isset($selected_requested_product[0]->estimated_product)){  $requested_product =  json_decode($selected_requested_product[0]->estimated_product);  }   ?>
                                                                            
                                                                           
                                                                              <tr class="product_row_daily" data-product_id="<?php echo $row->product_id; ?>" >
                                                                                  <td>  <?php echo $i; ?> </td>
                                                                                  <td><?php echo $row->product_name; ?></td>
                                                                                  
                                                                                  <td style="" ><input type="number" value="<?php if(isset($requested_product[$index]->product_id)){ if($requested_product[$index]->product_id == $row->product_id){  echo $requested_product[$index]->morning_qty;  } }else if($row->morning_shift_qty){ echo + $row->morning_shift_qty; }else{  } ?>" name="morning_day" style="width:50px; text-align:center; display: <?php if($selected_customer[0]->shift_id == 2){ echo 'none'; } ?>" step="<?php if($row->unit == 'Pkt'){ echo 1; }else{ echo 0.25; } ?>" min="0" > </td>
                                                                                  
                                                                                  
                                                                                  <td style="" ><input type="number" value="<?php if(isset($requested_product[$index]->product_id)){ if($requested_product[$index]->product_id == $row->product_id){  echo $requested_product[$index]->evening_qty;  } }else if($row->evening_shift_qty){ echo + $row->evening_shift_qty; } ?>" name="evening_day" style="width:50px; text-align:center; display: <?php if($selected_customer[0]->shift_id == 1){ echo 'none'; } ?>" step="<?php if($row->unit == 'Pkt'){ echo 1; }else{ echo 0.25; } ?>" min="0" ></td>
                                                                                 

                                                                             </tr>
                                                                          <?php $s++; }} ?>
					                                 		    	  </tbody>

					                                 			</table>
                                                             </div>
                                                            </div>
                                                            
                                                            <div class="col-lg-12" style="padding-top:15px;">
                                                                <div class="payment-adress">

                                                                    <input type="submit" value="submit" name="submit" class="btn btn-primary waves-effect waves-light" style="background-color:#2c6be0;">

                                                                </div>
                                                            </div>
                                                       
                                                        </div>
                                                          
                                                    </form>
                                                        
                                                        <form action="" method="post" class="dropzone dropzone-custom needsclick add-professors" id="demo1-upload"> 
                                                              <input type="hidden" name="req_array_week" class="form-control" value="" />
                                                             <input type="hidden" name="schedule" value="Week">
                                                         <div class="row" id="week_row" style="display:none">
                                                            <div class="col-lg-12">
                                                                <div class="asset-inner" >
                                                                 <table id="table" data-toggle="table"    data-key-events="true"   data-cookie="true"
                                                                           class="table-striped">
                                                                     <thead>
					                                 				<tr>
                                                                         <th>Sr No.</th>
					                                 			        <th>Product</th>
                                                                        
                                                                         <th>Sun</th>
                                                                        <th>Mon</th>
                                                                        <th>Tue</th>
                                                                        <th>Wed</th>
                                                                        <th>Thu</th>
                                                                        <th>Fri</th>
                                                                        <th>Sat</th>
                                                                        
                                                                         <!--<th>Assign</th>-->
                                                                     </tr>
					                                 			    </thead>
					                                 		    	  <tbody id="tran_table">

                                                                          <?php if(isset($select_req)){  $s = 0; $i = 1; foreach($select_req as $row){ $i++;      ?>
                                                                            
                                                                           
                                                                              <tr class="product_row_week" data-estimated_id="<?php echo $row->es_id; ?>" >
                                                                                  <td>  <?php echo $i; ?></td>
                                                                                  <td><?php echo $row->product_name; ?></td>
                                                                                  
                                                                                  <?php $w_arr = array('sun','mon','tue','wed','thu','fri','sat'); $k = 1; for($v = 0; $v < 7; $v++){ $k++; $m_key = 'day_'.$k; $week_key = $w_arr[$v]; $en = json_decode($row->$week_key); ?>
                                                                                  
                                                                                  
                                                                                       
                                                                                  <td class="day_week" data-day="<?php echo $v+1; ?>">
                                                                                      <div style="display: <?php if($selected_customer[0]->shift_id == 2){ echo 'none'; } ?>">
                                                                                      <span style="position:relative; padding:0px 2px; border:1px solid #6f6f6f; width:20px;">M</span> 
                                                                                      <input type="number" value="<?php if(isset($en[0]->morning) && $en[0]->morning > 0){ echo $en[0]->morning; } ?>" name="morning_week" style="width:50px; text-align:center;" step="<?php if($row->unit == 'Pkt'){ echo 1; }else{ echo 0.25; } ?>" min="0" > 
                                                                                      </div>
                                                                                      
                                                                                      <div style="display: <?php if($selected_customer[0]->shift_id == 1){ echo 'none'; } ?>">
                                                                                      <span style="position:relative; padding:0px 4.5px; border:1px solid #6f6f6f; width:20px;">E</span>
                                                                                      <input type="number" value="<?php if(isset($en[0]->evening) && $en[0]->evening > 0){ echo $en[0]->evening; } ?>" name="evening_week" style="width:50px;  text-align:center;" step="<?php if($row->unit == 'Pkt'){ echo 1; }else{ echo 0.25; } ?>" min="0" >
                                                                                      </div>
                                                                                  </td>
                                                                                  <?php } ?>
                                                                                 
                                                                                 

                                                                             </tr>
                                                                          <?php $s++; }} ?>
					                                 		    	  </tbody>

					                                 			</table>
                                                             </div>
                                                            </div>
                                                              <div class="col-lg-12" style="padding-top:15px;">
                                                                <div class="payment-adress">

                                                                    <input type="submit" value="submit" name="submit" class="btn btn-primary waves-effect waves-light" style="background-color:#2c6be0;">

                                                                </div>
                                                            </div>
                                                             
                                                        </div>
                                                        
                                                    </form>
                                                        
                                                     <form action="" method="post" class="dropzone dropzone-custom needsclick add-professors" id="demo1-upload"> 
                                                            <input type="hidden" name="req_array_month" class="form-control" value="" />
                                                         <input type="hidden" name="schedule" value="Month">

                                                        <div class="row" id="month_row" style="display:none;">
                                                            <div class="col-lg-12">
                                                                <div class="asset-inner" >
                                                                 <table id="table" data-toggle="table"    data-key-events="true"   data-cookie="true"
                                                                           class="table-striped">
                                                                     <thead>
					                                 				<tr>
                                                                         <th>Sr No.</th>
					                                 			        <th>Product</th>
                                                                        
                                                                         <th>1</th>
                                                                        <th>2</th>
                                                                        <th>3</th>
                                                                        <th>4</th>
                                                                        <th>5</th>
                                                                        <th>6</th>
                                                                        <th>7</th>
                                                                        <th>8</th>
                                                                        <th>9</th>
                                                                        <th>10</th>
                                                                        <th>11</th>
                                                                        <th>12</th>
                                                                        <th>13</th>
                                                                        <th>14</th>
                                                                        <th>15</th>
                                                                        <th>16</th>
                                                                        <th>17</th>
                                                                        <th>18</th>
                                                                        <th>19</th>
                                                                        <th>20</th>
                                                                        <th>21</th>
                                                                        <th>22</th>
                                                                        <th>23</th>
                                                                        <th>24</th>
                                                                        <th>25</th>
                                                                        <th>26</th>
                                                                        <th>27</th>
                                                                        <th>28</th>
                                                                        <th>29</th>
                                                                        <th>30</th>
                                                                        <th>31</th>
                                                                        
                                                                         <!--<th>Assign</th>-->
                                                                     </tr>
					                                 			    </thead>
					                                 		    	  <tbody id="tran_table">

                                                                          <?php if(isset($select_req)){   $s = 0; $i = 1; foreach($select_req as $row){  $i++;   ?>
                                                                              <tr class="product_row_month" data-estimated_id="<?php echo $row->es_id; ?>" >
                                                                                  <td>  <?php echo $i; ?></td>
                                                                                  <td><?php echo $row->product_name; ?></td>
                                                                                  
                                                                                  <?php for($v = 0; $v < 31; $v++){ $m = $v + 1; $en_key = 'day_'.$m;  $en = json_decode($row->$en_key); ?>
                                                                                       
                                                                                  <td class="day_month" data-day="<?php echo $v+1; ?>">
                                                                                      <div style="display: <?php if($selected_customer[0]->shift_id == 2){ echo 'none'; } ?>">
                                                                                      <span style="position:relative; padding:0px 2px; border:1px solid #6f6f6f; width:20px;">M</span> 
                                                                                      <input type="number" value="<?php if(isset($en[0]->morning) && $en[0]->morning > 0){ echo $en[0]->morning; } ?>" name="morning_month" style="width:50px; text-align:center;" step="<?php if($row->unit == 'Pkt'){ echo 1; }else{ echo 0.25; } ?>" min="0" > 
                                                                                      </div>
                                                                                      
                                                                                      <div style="display: <?php if($selected_customer[0]->shift_id == 1){ echo 'none'; } ?>">
                                                                                      <span style="position:relative; padding:0px 4.5px; border:1px solid #6f6f6f; width:20px;">E</span>
                                                                                      <input type="number" value="<?php if(isset($en[0]->evening) && $en[0]->evening > 0){ echo $en[0]->evening; } ?>" name="evening_month" style="width:50px;  text-align:center;" step="<?php if($row->unit == 'Pkt'){ echo 1; }else{ echo 0.25; } ?>" min="0" >
                                                                                      </div>
                                                                                  </td>
                                                                                  <?php } ?>
                                                                                 
                                                                                 

                                                                             </tr>
                                                                          <?php $s++; }} ?>
					                                 		    	  </tbody>

					                                 			</table>
                                                             </div>
                                                            </div>
                                                            
                                                             <div class="col-lg-12" style="padding-top:15px;">
                                                                <div class="payment-adress">

                                                                    <input type="submit" value="submit" name="submit" class="btn btn-primary waves-effect waves-light" style="background-color:#2c6be0;">

                                                                </div>
                                                            </div>
                                                             
                                                        </div>
                                                
                                                    </form>

                                                 
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
					</div>
                </div>
               </div>
            </div>
                </div>
			           <div id="success_alert" class="modal modal-edu-general default-popup-PrimaryModal fade" role="dialog" style="width:460px; margin:auto;">
                            <div class="modal-dialog" style="width:90%;">
                                <div class="modal-content">
                                    <!--<div class="modal-close-area modal-close-df">
                                        <a class="close" data-dismiss="modal" href="#"><i class="fa fa-close"></i></a>
                                    </div>-->
                                    <div class="modal-body" style="padding: 30px 30px;">
                                        <i class="educate-icon educate-checked modal-check-pro"></i>
                                        <h2>Awesome!</h2>
                                        <p>Customer Is Successfully Added</p>
                                    </div>
                                    <div class="modal-footer">

                                       <button class="btn btn-primary" type="button" id="success_ok" style="width:80px; background-color:#2c6be0;">OK</button>

                                    </div>
                                </div>
                            </div>
                       </div>
			           <div id="failed_alert" class="modal modal-edu-general FullColor-popup-DangerModal fade" role="dialog" style="width:460px; margin:auto;">
                            <div class="modal-dialog" style="width:90%;">
                                <div class="modal-content">
                                    <div class="modal-close-area modal-close-df">
                                        <a class="close" data-dismiss="modal" href="#"><i class="fa fa-close"></i></a>
                                    </div>
                                    <div class="modal-body" style="padding: 30px 30px;">
                                        <span class="educate-icon educate-danger modal-check-pro information-icon-pro"></span>
                                        <h2>Error!</h2>
                                        <p id="error_p">Sorry Card Number Is Not Valid</p>
                                    </div>
                                    <div class="modal-footer danger-md">

                                        <button class="btn btn-primary" type="button" data-dismiss="modal" style="width:80px; background-color:#2c6be0;">OK</button>

									</div>
                                </div>
                            </div>
                        </div>

	</div>

   <?php $this->load->view('common/footer_script'); ?>
     <script src="<?php echo base_url('catalogs'); ?>/js/datapicker/bootstrap-datepicker.js"></script>
    <script src="<?php echo base_url('catalogs'); ?>/js/datapicker/datepicker-active.js"></script>
    <script type="text/javascript">
function validateNumber(evt) {
    var e = evt || window.event;
    var key = e.keyCode || e.which;

    if (!e.shiftKey && !e.altKey && !e.ctrlKey &&
    // numbers
    key >= 48 && key <= 57 ||
    // Numeric keypad
    key >= 96 && key <= 105 ||
    // Backspace and Tab and Enter
    key == 8 || key == 9 || key == 13 ||
    // Home and End
    key == 35 || key == 36 ||
    // left and right arrows
    key == 37 || key == 39 ||
    // Del and Ins
    key == 46 || key == 45) {
        // input is VALID
    }
    else {
        // input is INVALID
        e.returnValue = false;
        if (e.preventDefault) e.preventDefault();
    }
}

   function onlyAlphabets(e, t) {
            try {
                if (window.event) {
                    var charCode = window.event.keyCode;
                }
                else if (e) {
                    var charCode = e.which;
                }
                else { return true; }
                if ((charCode > 64 && charCode < 91) || (charCode > 96 && charCode < 123) || charCode === 32)
                    return true;
                else
                    return false;
            }
            catch (err) {
                alert(err.Description);
            }
        }

     function forceInputUppercase(e)
  {
    var start = e.target.selectionStart;
    var end = e.target.selectionEnd;
    e.target.value = e.target.value.toUpperCase();
    e.target.setSelectionRange(start, end);
  }
          document.getElementById("field1").addEventListener("keyup", forceInputUppercase, false);
</script>

    <script type="text/javascript">


	$(document).ready(function(){
		function textInput(event) {
   var value = String.fromCharCode(event.which);
   var pattern = new RegExp(/[a-zåäö ]/i);
   return pattern.test(value);
}

		$(document).on('click','#add_customer_bt2',function(){
			$('#my_loader').show();
			var firstname = $('input[name=firstname]').val();
			var lastname = $('input[name=lastname]').val();
			var mobileno = $('input[name=mobileno]').val();
            var mobileno2 = $('input[name=mobileno2]').val();
			var email = $('input[name=email]').val();
			var address1 = $('input[name=address1]').val();
			var address2 = $('input[name=address2]').val();
			var postcode = $('input[name=postcode]').val();
			var colony = $('input[name=colony]').val();
			var city = $('input[name=city]').val();
            var delivery_type = $('input[name=delivery_type]:checked').val();
			var advance_payment = $('input[name=advance_payment]').val();
			var card_no = $('input[name=card_no]').val();

            if(firstname == "" || lastname == "" || mobileno == "" || email == "" || address1 == "" || colony == "" || card_no == ""){
                if(firstname == ""){

                }

            }else{
			$.ajax({
				type: "POST",
				url: '<?php echo base_url(); ?>customer/form_submit',

				data:{

					firstname:firstname,
					lastname:lastname,
					mobileno:mobileno,
                    mobileno2:mobileno2,
					email:email,
					address1:address1,
					address2:address2,
					postcode:postcode,
					colony:colony,
					city:city,
                    delivery_type:delivery_type,
					advance_payment:advance_payment,
					card_no:card_no
					},
				success: function(data){

					if(data == "success"){
						$('#my_loader').hide();
						$('#success_alert').modal("toggle");

					}else if(data == "failed"){
                        $('#my_loader').hide();
                        $('#error_p').text('Sorry Card Number Is Not Valid');
						$('#failed_alert').modal("toggle");

					}else{

						$('#my_loader').hide();
                        $('#error_p').text('Something Wrong');
						$('#failed_alert').modal("toggle");
					}

				},
               error: function(XMLHttpRequest, textStatus, errorThrown) {
                     $('#my_loader').hide();
                     if (XMLHttpRequest.readyState == 4) {
                         $('#failed_alert').modal("toggle");
                         $('#error_p').text('Request is failed due to some reason try again!');
                         // HTTP error (can be checked by XMLHttpRequest.status and XMLHttpRequest.statusText)
                     }
                     else if (XMLHttpRequest.readyState == 0) {
                         $('#failed_alert').modal("toggle");
                         $('#error_p').text('Check Your Internet Connection');
                         // Network error (i.e. connection refused, access denied due to CORS, etc.)
                     }
                     else {
                         $('#error_p').text('Something Wrong');
                         $('#failed_alert').modal("toggle");
                         // something weird is happening
                     }
                 }


			});
            }
			/* alert(firstname+lastname+mobileno+email+address1+address2+postcode+colony+city+advance_payment+card_no);
			*/
		});

		$(document).on('click','#success_ok',function(){

			window.location.href = window.location.href;


		});
		$(document).on('click','#fail_ok',function(){

			 window.location.href = window.location.href;

		});

        $(document).on('click','input[class=form-control]',function(){
			$('.success').hide();

		});

        $(document).on('click','button[title=close]',function(){
			$(this).parent().css('display','none');

		});

        function colony_take(){
             var colony_selected = $('input[id=colony_selected]').val();
             if(colony_selected === ""){



             }else{

                 $('select[name=colony]').val(colony_selected);

             }


        }
        colony_take();

        $('#first_name').keyup(function(){
            var str = $(this).val();
            if(str.length === 1){
                var res = str.charAt(0)
                this.value = res.toUpperCase();
            }else{

            }

        });

         $('#last_name').keyup(function(){
            var str = $(this).val();
            if(str.length === 1){
                var res = str.charAt(0)
                this.value = res.toUpperCase();
            }else{

            }

        });


       /* $(document).on('keyup','input[name=advance_payment]',function(){

            var limit = $(this).data("limitrecharge");
            var val = $(this).val();
            if(val == ''){
                $('#add_customer_bt').attr('type','submit');
                $('#limit_span').text('');
            }else{
            if(val >= limit){
                $('#add_customer_bt').attr('type','submit');
                $('#limit_span').text('');
            }else{

                $('#add_customer_bt').attr('type','button');
                $('#limit_span').text(' Minimum '+limit+' Rs recharge allowed');
            }
            }
        });*/
        
        // week ***********
         
         function create_estimated_p_array(){
            
             var estimated_array = [];
             
             $('.product_row_week').each(function(){

                 
                 
                 var p_id = $(this).data('estimated_id');
              
                 var re_array = [];
                 
                 $(this).find('.day_week').each(function(){
                     
                     var day = $(this).data("day");
                     var morning_qty = $(this).find('input[name=morning_week]').val();
                     var evening_qty = $(this).find('input[name=evening_week]').val();
                     
                     if(!morning_qty){
                         morning_qty = 0;
                     }
                     if(!evening_qty){
                         evening_qty = 0;
                     }
                     
                     var bvar = {'morning': morning_qty, 'evening':evening_qty, 'day': day};
                     
                     
                     re_array.push(bvar);
                 });
                 
                 
                 estimated_array.push({estimated_id:p_id, qty: JSON.stringify(re_array) });
                 
             });
             $('input[name=req_array_week]').val(JSON.stringify(estimated_array));
             
         }

      //  create_estimated_p_array();

       
         $(document).on('keyup change','input[name=morning_week]',function(){
                 create_estimated_p_array();

         });
        
         $(document).on('keyup change','input[name=evening_week]',function(){
                 create_estimated_p_array();

         });
        // Month *******
        
         function create_estimated_p_array_month(){
            
             var estimated_array = [];
             
             $('.product_row_month').each(function(){

                 
                 
                 var p_id = $(this).data('estimated_id');
              
                 var re_array = [];
                 
                 $(this).find('.day_month').each(function(){
                     
                     var day = $(this).data("day");
                     var morning_qty = $(this).find('input[name=morning_month]').val();
                     var evening_qty = $(this).find('input[name=evening_month]').val();
                     
                     if(!morning_qty){
                         morning_qty = 0;
                     }
                     if(!evening_qty){
                         evening_qty = 0;
                     }
                     
                     var bvar = {'morning': morning_qty, 'evening':evening_qty, 'day': day};
                     
                     
                     re_array.push(bvar);
                 });
                 
                 
                 estimated_array.push({estimated_id:p_id, qty: JSON.stringify(re_array) });
                 
             });
             $('input[name=req_array_month]').val(JSON.stringify(estimated_array));
             
         }

        
       
        
      //  create_estimated_p_array();

         $(document).on('keyup change','input[name=morning_month]',function(){
                 create_estimated_p_array_month();

         });
        
         $(document).on('keyup change','input[name=evening_month]',function(){
                 create_estimated_p_array_month();

         });
        
        
      
         
        // ****** every day
               
        
        
        function create_estimated_p_array_daily(){
            
             var estimated_array = [];
             
             $('.product_row_daily').each(function(){

                 
                 
                 var p_id = $(this).data('product_id');
                
                 var morning_qty = $(this).find('input[name=morning_day]').val();
                 var evening_qty = $(this).find('input[name=evening_day]').val();
                 
                 
                 
                 estimated_array.push({product_id:p_id, morning: morning_qty, evening:evening_qty });
                 
             });
             $('input[name=req_array_daily]').val(JSON.stringify(estimated_array));
             
         }
         create_estimated_p_array_daily();
        
          $(document).on('keyup change','input[name=morning_day]',function(){
                 create_estimated_p_array_daily();

         });
        
         $(document).on('keyup change','input[name=evening_day]',function(){
                 create_estimated_p_array_daily();

         });
        
        
        
        
        
        
        
        
        


        $(document).on('keydown','input[name=new_quantity]',function(event){

            var unit = $(this).data('unit');
            if(unit === 'Pkt'){
                   var e = event || window.event;
                   var key = e.keyCode || e.which;

                   if (!e.shiftKey && !e.altKey && !e.ctrlKey &&
                   // numbers
                   key >= 48 && key <= 57 ||
                   // Numeric keypad
                   key >= 96 && key <= 105 ||
                   // Backspace and Tab and Enter
                   key == 8 || key == 9 || key == 13 ||
                   // Home and End
                   key == 35 || key == 36 ||
                   // left and right arrows
                   key == 37 || key == 39 ||
                   // Del and Ins
                   key == 46 || key == 45 || key == 173) {
                   }
                   else {
                         // input is INVALID
                        e.returnValue = false;
                        if (e.preventDefault) e.preventDefault();
                    }
            }else{
                   var e = event || window.event;
                   var key = e.keyCode || e.which;

                   if (!e.shiftKey && !e.altKey && !e.ctrlKey &&
                   // numbers
                   key >= 48 && key <= 57 ||
                   // Numeric keypad
                   key >= 96 && key <= 105 ||
                   // Backspace and Tab and Enter
                   key == 8 || key == 9 || key == 13 ||
                   // Home and End
                   key == 35 || key == 36 ||
                   // left and right arrows
                   key == 37 || key == 39 ||
                   // Del and Ins
                   key == 46 || key == 45 || key == 173 || key == 190) {
                   }
                   else {

                       // input is INVALID
                       e.returnValue = false;
                       if (e.preventDefault) e.preventDefault();
                   }
            }
         });


      
        
          $(document).on('change','input[name=selling_price]',function(){
             
               
              create_estimated_p_array();
          }); 
        
        $(document).on('keyup','input[name=selling_price]',function(){
              
             
            create_estimated_p_array();
          });
        
           $(document).on('click','input[name=delivery_schedule]',function(){
 
              var val = $(this).val();
             
               if(val === 'Week'){
                    $('#daily_row').hide();
                   $('#month_row').hide();
                   $('#week_row').show();
                   
               }else if(val === 'Month'){
                   $('#daily_row').hide();     
                    $('#week_row').hide();
                    $('#month_row').show();   
                        
                }else{
                    $('#week_row').hide();
                      $('#month_row').hide();
                    $('#daily_row').show();
                }
           
          });
        
        
          function check_selected_schedule(){
              
              var val = $('input[name=delivery_schedule]:checked').val();
              
              if(val === 'Week'){
                    $('#daily_row').hide();
                   $('#month_row').hide();
                   $('#week_row').show();
                   
               }else if(val === 'Month'){
                   $('#daily_row').hide();     
                    $('#week_row').hide();
                    $('#month_row').show();   
                        
                }else if(val === 'everyday'){
                    $('#week_row').hide();
                      $('#month_row').hide();
                    $('#daily_row').show();
                }else{
                    $('#week_row').hide();
                      $('#month_row').hide();
                    $('#daily_row').show();
                }
              
              
          }check_selected_schedule();
        
	});
	</script>
</body>
</html>
