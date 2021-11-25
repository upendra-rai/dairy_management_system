<!doctype html>
<html class="no-js" lang="en">

<head>
   <?php $this->load->view('common/header_link'); ?>
    <link rel="stylesheet" href="<?php echo base_url('catalogs'); ?>/css/preloader/preloader-style.css">
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
       
       .detail_tab p label{
           font-weight: 400;
           color: #000000;
           /*color: #525252;*/
           font-size: 15px;
           
       }
      .detail_tab p{
          color: #4f4f4f;
          font-size:15px;
      	   margin-top:0px;
          margin-bottom: 8px;
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
         <div class="container-fluid" style="margin-top:15px; ">
           <div class="col-md-2" style="padding:2px;">
               <div class="product-status-wrap mycard" style=" border-top:1px solid #0b89de; box-shadow: 0px 3px 8px -1px rgba(0,0,0,0.4); ">
                 <img src="<?php echo base_url('catalogs') ?>/img/customer_img/<?php echo $edit_detail[0]->customer_image; ?>" class="thumbnail" alt="" style="width:100px; height:100px; border-radius: 50%; margin:0px;" />
               </div>
           </div>
           <div class="col-md-10" style="padding:2px; ">
               <div class="product-status-wrap mycard" style="overflow:auto;  border-top:1px solid #0b89de; box-shadow: 0px 3px 8px -1px rgba(0,0,0,0.4); ">
                  <div class="row detail_tab">
                      <div class="col-md-4" style="height:100px;">
                         <p style="margin:0;"><label>Name:</label>  <?php echo $edit_detail[0]->first_name.' '.$edit_detail[0]->last_name; ?></p>
                         <p style="margin:0;"><label>Email:</label>  <?php echo $edit_detail[0]->email_address; ?></p>
                         <p style="margin:0;"><label>Phone 1:</label>  <?php echo $edit_detail[0]->contact_1; ?></p>
                         <p style="margin:0;"><label>Phone 2:</label>  <?php echo $edit_detail[0]->contact_2; ?></p>
                                                                 
                      </div>                                        
                      <div class="col-md-4" style="height:100px;">
                         <p style="margin:0;"><label>Address 1:</label>  <?php echo $edit_detail[0]->address_1; ?></p>
                         <p style="margin:0;"><label>Address 2:</label>  <?php echo $edit_detail[0]->address_2; ?></p>
                         <p style="margin:0;"><label>Colony Name:</label>  <?php echo $edit_detail[0]->colony_name; ?></p>
                                                            
                      </div>
                      <div class="col-md-4" style="height:100px;">
                          <p style="margin:0;"><label>Balance:</label> <span class="rs_span" style="color:#46c7fe;"><i class="fa fa-rupee"></i> </span>  <?php echo number_format($edit_detail[0]->balance_amount,1); ?></p>
                          <p style="margin:0;"><label>Ragistration:</label>  <?php echo date('d-M-Y', strtotime($edit_detail[0]->ragistration_date)); ?></p>
                          <p style="margin:0;"><label>Balance:</label>  <?php echo $edit_detail[0]->card_status; ?></p>
                                                           
                      </div>
                  </div>
               </div>
           </div>

        </div>
        
        
		<div class="container-fluid" style="margin-top:20px;">
            <div class="product-status-wrap mycard">
			    <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div id="myheadtitle" style=" ">
                                Change Atm Card 
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
                                             <div class="message card" style="display:<?php if(isset($message) && $message === "assigned"){ echo "block"; } ?>">
                                                 This card number is already assigned.
                                                 <button type="button" title="close" style="background-color:transparent; border:none; float:right;">X</button>
                                             </div>
                                            <div class="message card" style="display:<?php if(isset($message) && $message === "invalid"){ echo "block"; } ?>">
                                                 This card number is not valid.
                                                <button type="button" title="close" style="background-color:transparent; border:none; float:right;">X</button>
                                             </div>
                                             <div class="message card" style="display:<?php if(isset($message) && $message === "lost"){ echo "block"; } ?>">
                                                 This card number is lost or broken.
                                                <button type="button" title="close" style="background-color:transparent; border:none; float:right;">X</button>
                                             </div>
                                            <div class="message success" style="display:<?php if(isset($message) && $message === "success"){ echo "block"; } ?>">
                                                 ATM card no is successfully changed.
                                                 <button type="button" title="close" style="background-color:transparent; border:none; float:right;">X</button>
                                             </div>
                                            <div class="review-content-section">
                                                <div id="dropzone1" class="pro-ad">
                                                    
                                                    <form action="" method="post" class="dropzone dropzone-custom needsclick add-professors" id="demo1-upload">
                                                        <div class="row">
                                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                                <div class="input-group">
																    <span class="input-group-addon">Assigned Card</span>
                                                                    <input name="old_card_no" type="text" class="form-control" value="<?php echo $edit_detail[0]->atm_card_no; ?>" placeholder="Card Number" readonly="readonly">
                                                                </div>
                                                                
                                                                
                                                                <div class="input-group">
																    <span class="input-group-addon">New Card</span>
                                                                    <input name="new_card_no" type="text" class="form-control" value="" placeholder="New ATM Card No." required>
                                                                </div>
                                                                <div class="input-group" style="width:100%;">
                                                                    <span class="input-group-addon">Reason &nbsp &nbsp</span>
																    <select name="card_status" class="form-control" style="width:100%;" required>
                                                                        <option value="">Select Reason</option>
                                                                         <option value="lost">Lost</option>
                                                                         <option value="broken">Broken</option>
                                                                    </select>
                                                                </div>
                                                               <div class="input-group" style="display: none;">
																    <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
                                                                    <input name="customer_id" value="<?php echo $edit_detail[0]->customer_id; ?>" type="hidden" class="form-control">
                                                                </div>
                                                            </div>
                                                            
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                
                                                                    <button type="submit" class="btn btn-primary waves-effect waves-light" style="background-color:#2c6be0;">Submit</button>
                                                               
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
		
	});
   </script>
</body>
</html>