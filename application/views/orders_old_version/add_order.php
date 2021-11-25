<!doctype html>
<html class="no-js" lang="en">

<head>
   <?php $this->load->view('common/header_link'); ?>
   
   <link rel="stylesheet" href="<?php echo base_url('catalogs'); ?>/css/modals.css">
    <link rel="stylesheet" href="<?php echo base_url('catalogs'); ?>/css/preloader/preloader-style.css">
   <link rel="stylesheet" href="<?php echo base_url('catalogs'); ?>/css/calendar/fullcalendar.min.css">
    <link rel="stylesheet" href="<?php echo base_url('catalogs'); ?>/css/calendar/fullcalendar.print.min.css">
    <link rel="stylesheet" href="<?php echo base_url('catalogs'); ?>/css/select2/select2.min.css">
     <link rel="stylesheet" href="<?php echo base_url('catalogs'); ?>/css/chosen/bootstrap-chosen.css">
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
                  <form action="" method="post" class="dropzone dropzone-custom needsclick add-professors" id="myForm">   
			    <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div id="myheadtitle" style=" ">
                                Add Order
                               <ul class="my_quick_bt" style="">
                                    
                                    <li>
                                        <a href="<?php echo base_url(); ?>team">
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
                                                          Process Is Failed!
                                                          <button type="button" title="close" style="background-color:transparent; border:none; float:right;">X</button>
                                                          <br>
                                                      </div>
                                                     <div class="message success" style="display:<?php if(isset($message) && $message === "success"){ echo "block"; } ?>">
                                                          Team member is successfully added. 
                                                         <button type="button" title="close" style="background-color:transparent; border:none; float:right;">X</button>
                                                         <br>
                                                      </div>
                                            <div class="review-content-section">
                                                <div id="dropzone1" class="pro-ad">
                                                     
                                                  
                                                        <div class="row">
                                                           <div class="col-lg-4 col-md-4 col-sm-3 col-xs-12" >
                                                           <div class="chosen-select-single">
                                                                 <select data-placeholder="Choose a Country..." class="chosen-select" name="customer_id" tabindex="-1" required>
                                                                 <option value="">Search Customer</option>
                                                                 <?php if(isset($all_customer_list)){ foreach($all_customer_list as $row){ ?>
                                                                     <option value="<?php echo $row->customer_id; ?>">
                                                                     <?php echo $row->atm_card_no; ?> <?php echo $row->first_name.' '.$row->last_name ?>

                                                                     </option>

                                                                  <?php }} ?>
													              </select>
                                                            </div>
                                                               <span id="customer_span" style="color:red;"><?php if(isset($return_customer_span_msg)){ echo $return_customer_span_msg; } ?></span>
                                                           </div>
                                                            
                                                            <div class="col-md-3 col-sm-12 col-xs-12" style="padding:0;">
                                                              <div class="form-group data-custon-pick data-custom-mg" id="data_5" style="margin:0px;">                            
                                                                <div class="input-daterange input-group" id="datepicker" style=" width:100%;">
                                                                
                                                                 <div class="form-group" id="data_5" style=" height:28px; margin:0px;">
                                                                    <input type="text" class="form-control" name="delivery_date" value="" placeholder="Delivery Date" style="background-color:#ffffff; height:34px; border:1px solid #cccccc;" required autocomplete="off"/>
                                                                 </div>
                                                                
                                                                  </div>
                                                                  </div>
                                                                 </div>
                                                            
                                                               <!-- ///////Collect  Product array Here //// -->
                                                                 <input type="hidden" name="product_array" value="" id="product_array"/>
                                                            
                                                                <input type="hidden" name="total_price" value="" id="total_price" required/>
                                                                 <!-- ///////Collect  Product array Here //// -->
                                                        </div>
                                                   
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                               
                            </div>
					</div>
                </div>
                   
                 <?php if(isset($select_product)){ ?>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        
                        <!-- <div id="myheadtitle" style="margin:0px; height:55px; border-bottom:none; padding-top:15px; font-size: 15.5px; ">
                             Inventory Details<span> <i class="ion-android-arrow-dropright" style="color: #0099cc;"></i></span> 
                        </div>-->
                        <div style="padding-top:10px; font-size: 17px;">
                            <p>Stock Details - <?php if(isset($return_date)){ echo $return_date; } ?></p>
                          <!--ul id="breadcrumbs-one">
                           <li><a href="">Stock Details </a></li>
                           <li><a href=""><?php if(isset($return_date)){ echo $return_date; } ?></a></li>
                             
                           </ul> -->  
                        </div>
						<div class="asset-inner" >
                                <table id="table" data-toggle="table"    data-key-events="true"   data-cookie="true"
                                          class="table-striped">
                                    <thead>
									<tr>
                                        <th>Sr No.</th>
								        <th>Product</th>
                                        <th>Unit</th>
                                        <th>Unit Price</th>
                                       
                                        <th>Produced Stock</th>
                                        
                                        <th>Add Quantity</th>
                                      
                                        <!--<th>Assign</th>-->
                                    </tr>
								    </thead>
							    	  <tbody id="tran_table">
                                         <?php if(isset($select_product)){ $i = 1; foreach($select_product as $row){ ?>
                                             <tr class="product_row" data-product_id="<?php echo $row->product_id; ?>" >
                                                 <td><?php echo $i++; ?></td>
                                                 <td><?php echo $row->product_name; ?></td>
                                                 <td><?php echo $row->unit; ?></td>
                                                 <td><?php echo $row->product_price; ?></td>
                                                
                                                 <td><?php if(isset($row->produced_qty)){ if($row->unit == 'Pkt'){ echo number_format($row->produced_qty); }else{ echo +$row->produced_qty; } }else{ echo '0'; } ?></td>
                                                 <td>
                                                     <input type="number"   value="" name="add_qty" step="<?php if($row->unit == 'Pkt'){ echo 1; }else{ echo 0.25; } ?>" data-product_id="<?php echo  $row->product_id;  ?>" data-product_name="<?php echo  $row->product_name;  ?>" data-unit="<?php echo  $row->unit;  ?>" data-unit_price="<?php echo  $row->product_price;  ?>"  style="width:80px;  text-align:center; height:25px; border:<?php if(isset($empty_qty)){ if($empty_qty == 'yes'){ echo '1px solid red'; } } ?>">
                                                </td>
                                                 
                                            </tr>
                                         <?php }} ?>    
							    	  </tbody>
                                    <tfoot>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                           
                                            <td><input type="submit"  name="submit" class="btn btn-primary"  value="Submit" style="background-color:#46c7fe; color:#ffffff; border: 1px solid #46c7fe; "/></td>
                                        </tr>
                                    </tfoot>
								</table>
                            </div>
                    </div>
                 
                </div>   
								
                   <?php } ?>
                      </form>
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
                                        <p>Team Member Is Successfully Added</p>
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
                                        <p>Sorry Process Is failed</p>
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
    <!-- chosen JS
 		============================================ -->
     <script src="<?php echo base_url('catalogs'); ?>/js/chosen/chosen.jquery.js"></script>
     <script src="<?php echo base_url('catalogs'); ?>/js/chosen/chosen-active.js"></script>
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
</script>
    
    <script type="text/javascript">
	$(document).ready(function(){
		
       /* $("#myForm").submit(function(e) {
            e.preventDefault();
          
        });*/
		$(document).on('click','#add_team_bt1',function(){
			$('#my_loader').show();
			var name = $('input[id=team_name]').val();
			var email = $('input[id=team_email]').val();
			var mobile = $('input[id=team_number]').val();
            
			
            if(name == "" || email == "" || mobile == ""){
                
                alert("fille required field");
            }else{
			$.ajax({
				type: "POST",
				url: '<?php echo base_url(); ?>team/add_submit',
				
				data:{
					name:name,
                    email:email,
                    mobile:mobile
					
					},
				success: function(data){
					$('#my_loader').hide();
					if(data == "success"){
						
						$('#success_alert').modal("toggle");
						
					}else if(data == "failed"){
						$('#failed_alert').modal("toggle");
						
					}else{
						
						
						alert("something Wrong");
					}
					
				}
				
				
			});
            }
			/* alert(firstname+lastname+mobileno+email+address1+address2+postcode+colony+city+advance_payment+card_no);
			*/
		});
		
		$(document).on('click','#success_ok',function(){
			
			window.location.href = '<?php echo base_url(); ?>team';
			
			
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
        
        $(document).on('keyup mouseup','input[name=add_qty]',function(){
            product_array = [];
            
            var total_price = null; 
        
            $('input[name=add_qty]').each(function(){
                var qty = $(this).val(); 
                var product_id = $(this).data('product_id'); 
                var product_name = $(this).data('product_name'); 
                var unit = $(this).data('unit'); 
                var unit_price = $(this).data('unit_price'); 
                
                if(qty > 0){
                     product_array.push({'product_id': product_id,'product_name':product_name,'unit':unit,'unit_price':unit_price,'qty':qty});
                    
                     total_price += Math.abs(qty) * Math.abs(unit_price);
                }
            });
            
            $('input[id=product_array]').val(JSON.stringify(product_array));
            
            $('input[id=total_price]').val(total_price);
            //console.log(product_array);
        });
		
        
        $('input[name=submit]').click(function(){
            var customer_id = $('select[name=customer_id]').val();
           
            if(customer_id == ''){
                $('#customer_span').text('Please select customer name.');
            }else{
                 $('#customer_span').text('');
            }
            
        });
	});
	</script>
</body>
</html>