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
		
			<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12" style="padding:0px;">
            <div class="container-fluid" style="margin-top:15px; ">
               <div class="product-status-wrap mycard">
			    <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div id="myheadtitle" style=" margin-bottom:0px;">
                                Set Minimum Recharge Limit
                                
                            </div>
                            <div id="myTabContent" class="tab-content custom-product-edit">
                                <div class="product-tab-list tab-pane fade active in" id="description">
                                    <div class="row">
                                       
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                             <div class="message error" style="display:<?php if(isset($message) && $message === "failed"){ echo "block"; } ?>">
                                                 Process is failed!
                                                 <button type="button" title="close" style="background-color:transparent; border:none; float:right;">X</button>
                                             </div>
                                            
                                            <div class="message success" style="display:<?php if(isset($message) && $message === "success"){ echo "block"; } ?>">
                                                 Recharge limit is successfully updated. 
                                                 <button type="button" title="close" style="background-color:transparent; border:none; float:right;">X</button>
                                             </div>
                                            <div class="review-content-section">
                                                <div id="dropzone1" class="pro-ad">
                                                    <form action="" method="post" class="dropzone dropzone-custom needsclick add-professors" id="demo1-upload">
                                                        <div class="row">
                                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                <div class="input-group">
																    <span class="input-group-addon rs_span"><i class="fa fa-rupee"></i> </span>
                                                                    <input name="amount" type="text" class="form-control" value="<?php if(isset($amount[0])){ echo $amount[0]->amount; } ?>" placeholder="Amount" onkeypress="validateNumber(event);"  required>
                                                                </div>
                                                                
                                                               
                                                            </div>
                                                           
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <div class="payment-adress" style="float:left;">
																  
                                                                    <button type="submit" id="submit" class="btn btn-primary waves-effect waves-light" style="background-color:#2c6be0;">Update</button>
                                                                     
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
        
        
	});
	</script>
</body>
</html>