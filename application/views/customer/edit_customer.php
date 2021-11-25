<!doctype html>
<html class="no-js" lang="en">

<head>
   <?php $this->load->view('common/header_link'); ?>
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
        <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12" style="padding:0px;">
		<div class="container-fluid" style="margin-top:15px;">
            <div class="product-status-wrap mycard">
			    <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div id="myheadtitle" style=" ">
                                Edit Customer Details
								<ul class="my_quick_bt" style="">
                                    
                                    <li>
                                        <a href="<?php echo base_url(); ?>customer/view_customer/<?php echo $edit_detail[0]->customer_id; ?>">
                                            <i class="ion-ios-undo-outline"></i>
                                        </a>
                                    </li>
                                </ul>
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
                                            <div class="message card" style="display:<?php if(isset($message) && $message === "invalid"){ echo "block"; } ?>">
                                                 This card number is not valid.
                                                <button type="button" title="close" style="background-color:transparent; border:none; float:right;">X</button>
                                             </div>
                                            <div class="message success" style="display:<?php if(isset($message) && $message === "success"){ echo "block"; } ?>">
                                                 Customer is successfully updated. 
                                                 <button type="button" title="close" style="background-color:transparent; border:none; float:right;">X</button>
                                             </div>
                                            <div class="review-content-section">
                                                <div id="dropzone1" class="pro-ad">
                                                    <form action="" method="post" class="dropzone dropzone-custom needsclick add-professors" id="demo1-upload">
                                                        <div class="row">
                                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                                <div class="input-group">
																    <span class="input-group-addon"><i class="fa fa-user-o"></i></span>
                                                                    <input name="firstname" id="first_name" type="text" class="form-control" value="<?php echo $edit_detail[0]->first_name; ?>" placeholder="First Name" onkeypress="return onlyAlphabets(event,this);" required>
                                                                </div>
                                                                <div class="input-group">
																    <span class="input-group-addon"><i class="fa fa-user-o"></i></span>
                                                                    <input name="lastname" id="last_name" type="text" class="form-control" value="<?php echo $edit_detail[0]->last_name; ?>" placeholder="Last Name" onkeypress="return onlyAlphabets(event,this);" >
                                                                </div>
                                                                <div class="input-group">
																    <span class="input-group-addon"><i class="ion-social-whatsapp-outline" style="font-size:18px;"></i></span>
                                                                    <input name="mobileno" type="text" class="form-control" value="<?php echo $edit_detail[0]->contact_1; ?>" placeholder="Phone 1" minlength="10"  onkeydown="validateNumber(event);" required>
                                                                </div>
                                                                <div class="input-group">
																    <span class="input-group-addon"><i class="ion-social-whatsapp-outline" style="font-size:18px;"></i></span>
                                                                    <input name="mobileno2" type="text" class="form-control" value="<?php echo $edit_detail[0]->contact_2; ?>"  minlength="10"  onkeydown="validateNumber(event);" placeholder="Phone 2">
                                                                </div>
                                                                <div class="input-group">
																    <span class="input-group-addon"><i class="fa fa-envelope-o"></i></span>
                                                                    <input name="email"  type="email" class="form-control" value="<?php echo $edit_detail[0]->email_address; ?>" placeholder="Email Id">
                                                                </div>
																<div class="input-group">
																    <span class="input-group-addon"><i class="fa fa-vcard-o"></i></span>
                                                                    <input name="address1" type="text" class="form-control" value="<?php echo $edit_detail[0]->address_1; ?>" placeholder="Address1">
                                                                </div>
																
                                                               
                                                            </div>
                                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                                <div class="input-group">
																    <span class="input-group-addon"><i class="fa fa-vcard-o"></i></span>
                                                                    <input name="address2" type="text" class="form-control" value="<?php echo $edit_detail[0]->address_2; ?>" placeholder="Address2">
                                                                </div>
                                                                
																<div class="input-group">
                                                                     <input type="hidden" id="colony_selected" value="<?php if(isset($edit_detail[0])){ echo $edit_detail[0]->colony_id; }else{ echo ''; } ?>">
																    <span class="input-group-addon"><i class="ion-ios-location-outline" style="font-size:18px;"></i></span>
                                                                     <select name="colony" class="form-control" style="width:100%;" required>
                                                                        <option value="">Colony Name</option>
                                                                        <?php foreach($select_colony as $row){ ?>
                                                                          
                                                                         <option value="<?php echo $row->colony_id; ?>"><?php echo $row->colony_name ?></option>
                                                                         
                                                                         <?php } ?>
                                                                    </select>
                                                                   
                                                                </div>
																<div class="input-group">
																    <span class="input-group-addon"><i class="ion-ios-home-outline" style="font-size:20px;"></i></span>
                                                                    <input name="city" type="text" class="form-control" value="<?php echo $edit_detail[0]->city; ?>" placeholder="City" required>
                                                                </div>
                                                               
                                                                <div class="input-group" style="display:none;">
																    <span class="input-group-addon" style="border: 1px solid #e5e6e7;"><i class="ion-social-windows-outline" style="font-size:18px;"></i></span>
                                                                    &nbsp &nbsp
                                                                    <label for="home_delivery" style="float:left ; padding: 0px 10px; margin-top:5px; color:#a5a8ab;">Home</label>
                                                                    <input name="delivery_type" type="radio" id="home_delivery" value="1" <?php if($edit_detail[0]->d_type_id === "1"){ echo "checked"; } ?>  style=" float:left ;margin-top:10px;"> &nbsp 
                                                                    <label for="counter_delivery" style=" float:left ; padding: 0px 10px; margin-top:5px; color:#a5a8ab;">Counter</label>
                                                                    <input name="delivery_type" type="radio" id="counter_delivery" value="2" <?php if($edit_detail[0]->d_type_id === "2"){ echo "checked"; } ?>  style=" float:left ;margin-top:10px;">
                                                                        
                                                                </div>
																<div class="input-group">
																    <span class="input-group-addon"><i class="ion-ios-location-outline" style="font-size:18px;"></i></span>
                                                                    <select name="shift" class="form-control" style="width:100%;">

                                                                        <option value="1" <?php if($edit_detail[0]->shift_id == 1){ echo 'selected'; } ?> >Morning</option>
                                                                        <option value="2" <?php if($edit_detail[0]->shift_id == 2){ echo 'selected'; } ?> >Evening</option>
                                                                        <option value="3" <?php if($edit_detail[0]->shift_id == 3){ echo 'selected'; } ?> >Both</option>
                                                                    </select>

                                                                </div>
                                                                 <div class="input-group">
                                                                   
																    <span class="input-group-addon"><i class="ion-ios-location-outline" style="font-size:18px;"></i></span>
                                                                    
                                                                   <select name="ac_type" required class="form-control" style="width:50%; margin-right:1px;">
                                                                        <option value="">Account Type</option>
                                                                        <option value="prepaid" <?php if(isset($edit_detail[0]->ac_type)){ if($edit_detail[0]->ac_type == 'prepaid'){ echo 'selected'; } } ?> >Prepaid</option>
                                                                        <option value="postpaid" <?php if(isset($edit_detail[0]->ac_type)){ if($edit_detail[0]->ac_type == 'postpaid'){ echo 'selected'; } } ?>  >Post Paid</option>
                                                                       
                                                                    </select>
                                                                    <input type="number" name="balance_restricted" value="<?php if(isset($edit_detail[0]->balance_restricted)){ echo $edit_detail[0]->balance_restricted; } ?>" placeholder="Min Balance " style="width:49%;" class="form-control"  required/>
                                                                    
                                                                </div>
                                                                <div class="input-group">
																    <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
                                                                    <input name="card_no" data-customer_id="<?php echo $edit_detail[0]->customer_id; ?>" type="text" class="form-control" value="<?php echo $edit_detail[0]->atm_card_no; ?>" placeholder="Card Number" readonly="readonly">
                                                                </div>
                                                                
                                                                <div class="input-group" style="display:none;">
																    <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
                                                                    <input name="customer_id"  type="hidden" class="form-control" value="<?php echo $edit_detail[0]->customer_id; ?>" readonly="readonly"/>
                                                                </div>
                                                                
                                                                <div class="input-group">
                                                                    <input type="hidden" id="agent_selected" value="<?php if(isset($r_agent)){ echo $r_agent; }else{ echo ''; } ?>">
																    <span class="input-group-addon"><i class="ion-ios-location-outline" style="font-size:18px;"></i></span>
                                                                    <select name="agent" class="form-control" style="width:100%;" required>
                                                                        <option value="">Select Agent</option>
                                                                        <?php foreach($select_agent as $row ){ ?>
                                                                        <option value="<?php echo $row->user_id; ?>" style="display: <?php if($row->user_id == 1 || $row->user_id == 21){ echo 'none'; } ?> " <?php if( $edit_detail[0]->assigned_user_id == $row->user_id){ echo 'selected'; } ?> ><?php echo $row->name; ?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                    <input type="hidden" name="estimate_product" value="" >
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="asset-inner" >
                                                                 <table id="table" data-toggle="table"    data-key-events="true"   data-cookie="true"
                                                                           class="table-striped">
                                                                     <thead>
					                                 				<tr>
                                                                         <th>Sr No.</th>
					                                 			        <th>Product</th>
                                                                         <th>Unit</th>
                                                                         <th>Unit Price</th>
                                                                        <th>Selling Price</th>
                                                                        <!-- <th>Estimated Product Qty</th> -->
                                                                       
                                                                         <!--<th>Assign</th>-->
                                                                     </tr>
					                                 			    </thead>
					                                 		    	  <tbody id="tran_table">
                                                                          <?php if(isset($select_product)){ $i = 1; foreach($select_product as $row){ ?>
                                                                              <tr class="product_row" data-product_id="<?php echo $row->product_id; ?>" >
                                                                                  <td><?php echo $i++; ?></td>
                                                                                  <td><?php echo $row->product_name; ?></td>
                                                                                  <td><?php echo $row->unit; ?></td>
                                                                                  <td><i class="fa fa-rupee"></i> <?php echo $row->product_price; ?></td>
                                                                                  
                                                                                  <td class="product_price"><span style="height: 30px; line-height: 20px; padding: 0px 8px; color: #46c7fe;"><i class="fa fa-rupee"></i></span><input type="number" value="<?php if(isset($row->selling_margin)){ echo $row->product_price + $row->selling_margin; } ?>" name="selling_price" data-product_price="<?php echo $row->product_price; ?>" style="width: 80px; text-align:center; border: 1px solid #ff8080; " ></td>
                                                                                  
                                                                                  
                                                                                  
                                                                                 <!-- <td><input type="text" value="<?php if($row->unit == 'Pkt'){ echo number_format($row->product_qty); }else{ echo +$row->product_qty; } ?>" name="new_quantity" data-unit="<?php echo $row->unit; ?>" data-product_id="<?php echo $row->product_id; ?>" style="width: 80px; text-align:center; border: 1px solid #46c7fe; " ></td> -->

                                                                                  
                                                                                
                                                                             </tr>
                                                                          <?php }} ?>    
					                                 		    	  </tbody>
                                                                    
					                                 			</table>
                                                             </div>
                                                            </div>
                                                        </div>
                                                        <div class="row" style="padding-top: 10px;">
                                                            <div class="col-lg-12">
                                                                <div class="payment-adress">
																  
                                                                    <button type="submit" class="btn btn-primary waves-effect waves-light" style="background-color:#2c6be0;">Submit</button>
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
                            <!--<div id="myTabContent" class="tab-content custom-product-edit">
                                <div class="product-tab-list tab-pane fade active in" id="description">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="review-content-section">
                                                <div id="dropzone1" class="pro-ad">
                                                    <form action="/upload" class="dropzone dropzone-custom needsclick add-professors" id="demo1-upload">
                                                        <div class="row">
                                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                                <div class="form-group">
                                                                    <input name="firstname" type="text" class="form-control" value="<?php echo $edit_detail[0]->customer_firstname; ?>" placeholder="First Name">
                                                                </div>
                                                                <div class="form-group">
                                                                    <input name="firstname" type="text" class="form-control" value="<?php echo $edit_detail[0]->customer_lastname; ?>" placeholder="Last Name">
                                                                </div>
                                                                <div class="form-group">
                                                                    <input name="mobileno" type="number" class="form-control" value="<?php echo $edit_detail[0]->mobile_no; ?>" placeholder="Mobile no.">
                                                                </div>
                                                                <div class="form-group">
                                                                    <input name="finish" id="finish" type="text" class="form-control" value="<?php echo $edit_detail[0]->email_id; ?>" placeholder="Email Id">
                                                                </div>
																<div class="form-group">
                                                                    <input name="mobileno" type="text" class="form-control" value="<?php echo $edit_detail[0]->address1; ?>" placeholder="Address1">
                                                                </div>
																<div class="form-group">
                                                                    <input name="mobileno" type="text" class="form-control" value="<?php echo $edit_detail[0]->address2; ?>" placeholder="Address2">
                                                                </div>
                                                                
                                                               
                                                            </div>
                                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                                <div class="form-group">
                                                                    <input name="postcode" id="postcode" type="text" class="form-control" value="<?php echo $edit_detail[0]->postcode; ?>" placeholder="Postcode">
                                                                </div>
																<div class="form-group">
                                                                    <input name="address" type="text" class="form-control" value="<?php echo $edit_detail[0]->colonyname; ?>" placeholder="colony Name">
                                                                </div>
																<div class="form-group">
                                                                    <input name="address" type="text" class="form-control" value="<?php echo $edit_detail[0]->city; ?>" placeholder="City">
                                                                </div>
																<div class="form-group">
                                                                    <input name="department" type="text" class="form-control" value="<?php echo $edit_detail[0]->account; ?>" placeholder="Advance Payment">
                                                                </div>
                                                                <div class="form-group">
                                                                    <input name="department" type="text" class="form-control" value="<?php echo $edit_detail[0]->linked_no; ?>" placeholder="Card Number">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <div class="payment-adress">
                                                                    <button type="submit" class="btn btn-primary waves-effect waves-light" style="background-color:#2c6be0;">Submit</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="product-tab-list tab-pane fade" id="reviews">
                                    
                                </div>
                                <div class="product-tab-list tab-pane fade" id="INFORMATION">
                                    
                                </div>
                            </div> -->  
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
                                        <p>Customer is successfully updated.</p>
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
                                        <p id="error_p">Sorry Card Number doesn't exist.</p>
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
                if ((charCode > 64 && charCode < 91) || (charCode > 96 && charCode < 123 ) || charCode === 32)
                    return true;
                else
                    return false;
            }
            catch (err) {
                alert(err.Description);
            }
        }       
</script>
    
   <script type="text/javascript">
     $(document).ready(function(){
		
		$(document).on('click','#add_customer_bt',function(){
			$('#my_loader').show();
			var firstname = $('input[name=firstname]').val();
			var lastname = $('input[name=lastname]').val();
			var mobileno = $('input[name=mobileno]').val();
            var mobileno2 = $('input[name=mobileno2]').val();
			var email = $('input[name=email]').val();
			var address1 = $('input[name=address1]').val();
			var address2 = $('input[name=address2]').val();
			
			var colony = $('input[name=colony]').val();
			var city = $('input[name=city]').val();
            var delivery_type = $('input[name=delivery_type]:checked').val();
			var advance_payment = $('input[name=advance_payment]').val();
			var card_no = $('input[name=card_no]').val();
			
            alert(card_no);
            if(firstname == "" || lastname == "" || mobileno == "" || email == "" || address1 == "" || colony == "" || card_no == ""){
                
                alert("fill required field");
            }else{
			$.ajax({
				type: "POST",
				url: '<?php echo base_url(); ?>customer/form_submit_edit',
				
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
					$('#my_loader').hide();
					if(data == "success"){
						
						$('#success_alert').modal("toggle");
						
					}else if(data == "failed"){
                        $('#error_p').text('Sorry Card Number Is Not Valid');
						$('#failed_alert').modal("toggle");
						
					}else{
						
						$('#error_p').text('Something Wrong');
						alert("something Wrong");
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
			
			window.location.href = '<?php echo base_url(); ?>/dashboard';
			
			
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
         
       
         
         
         
        function create_estimated_p_array(){
            
             var estimated_array = [];
             
             $('.product_row').each(function(){

                 
                 var p_id = $(this).data('product_id');
                 var selling_price = $(this).find('input[name=selling_price]').val();
                 var price  = $(this).find('input[name=selling_price]').data("product_price");
                 var margin = parseFloat(selling_price) - parseFloat(price);

                 estimated_array.push({product_id:p_id, selling_margin:margin });
                 
             });
             $('input[name=estimate_product]').val(JSON.stringify(estimated_array));
             
         }
        create_estimated_p_array();

         $(document).on('keyup','input[name=new_quantity]',function(){
                 create_estimated_p_array();

         });
         
         
         $(document).on('change','input[name=selling_price]',function(){
             
               
              create_estimated_p_array();
          }); 
        
        $(document).on('keyup','input[name=selling_price]',function(){
              
             
            create_estimated_p_array();
          });
	});
   </script>
</body>
</html>