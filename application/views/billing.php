<!doctype html>
<html class="no-js" lang="en">

<head>
   <?php $this->load->view('common/header_link'); ?>
   
   <link rel="stylesheet" href="<?php echo base_url('catalogs'); ?>/css/modals.css">
    <link rel="stylesheet" href="<?php echo base_url('catalogs'); ?>/css/preloader/preloader-style.css">
   <link rel="stylesheet" href="<?php echo base_url('catalogs'); ?>/css/calendar/fullcalendar.min.css">
    <link rel="stylesheet" href="<?php echo base_url('catalogs'); ?>/css/calendar/fullcalendar.print.min.css">
    
     <link rel="stylesheet" href="<?php echo base_url('catalogs'); ?>/css/select2/select2.min.css">
    <!-- chosen CSS
		============================================ -->
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
    
        button[name="remove"] {
              background: #f10a6c;
              color:#ffffff;
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
		
			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" style="padding:0px;">
            <div class="container-fluid" style="margin-top:15px;">
               <div class="product-status-wrap mycard" style="height: calc(100vh - 150px); overflow: auto;">
			    <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div id="myheadtitle" style=" ">
                                Category List
                               <ul class="my_quick_bt" style="">
                                    
                                    <li>
                                        <button type="button" id="dairy_product_bt" class="btn btn-primary">Dairy Product</button>
                                    </li>
                                   <li style="display:none;">
                                        <button type="button" id="e_product_bt" class="btn btn-primary">E Product</button>
                                    </li>
                                </ul>
                            </div>
                            <div class="panel-body" style="padding-top:0px;">
                                
                                <div id="dairy_product">
                                <?php $i = 1; foreach($dairy_product_list as $row){ ?>
                                  <div class="col-md-4"  name="add_product_by_click" style="border: 1px solid #e1e1e1; padding:10px; text-align:center;"  data-product_id="<?php echo $row->product_id; ?>" data-product_name="<?php echo $row->product_name; ?>" data-product_price="<?php echo $row->product_price; ?>" data-product_type="dairy_product" data-remaining_stock="<?php echo +$row->remaining_qty; ?>" data-unit="<?php echo $row->unit; ?>">
                                        <img src="<?php echo base_url(); ?>/catalogs/img/product.png" alt="" style="width:70px; height: 70px;  border-radius:2px; border:1px solid #e1e1e1; " class="img-thumbnail"  >
                                        <p style="line-height:10px; padding-top:10px; color:#6f6f6f;"><?php echo $row->product_name; ?></p>
                                        <p style="line-height:5px; color:#1e1e1e;">Rs. <?php echo $row->product_price; ?> </p>
                                        <p style="line-height:5px; color: <?php if($row->remaining_qty > 0){ echo '#93bf48'; }else{ echo '#ec3a1c'; } ?>">AVL Stock:  <?php echo +$row->remaining_qty.' '.$row->unit; ?></p>
                                  </div>
                                
                                <?php } ?>
                                </div>
                                
                                <div id="e_product" style="display:none;">
                                 <?php $i = 1; foreach($item_category_list as $row){ ?>
   
                                  <div class="col-md-4"  name="add_product_by_click" style="border: 1px solid #e1e1e1; padding:10px; text-align:center;"  data-product_id="<?php echo $row->product_id; ?>" data-product_name="<?php echo $row->product_name; ?>" data-product_price="<?php echo $row->product_unit_price; ?>" data-product_type="e_product">
                                        <img src="<?php echo base_url(); ?>/uploads/product_image/<?php echo $row->product_img; ?>" style="width:70px; height: 70px;  border-radius:2px; border:1px solid #e1e1e1; " class="img-thumbnail" alt="" >
                                        <p style="line-height:10px; padding-top:10px; color:#6f6f6f;">Milk</p>
                                        <p style="line-height:5px; color:#1e1e1e;">50 ltr</p>
                                  </div>
                                
                                <?php } ?>
                                </div>
                                
							</div>
                              
					</div>
                </div>
               </div>
            </div>
            </div> 
        
           <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" style="padding:0px;">
            <div class="container-fluid" style="margin-top:15px;">
               <div class="product-status-wrap mycard" style="height: calc(100vh - 150px); overflow: auto;">
			    <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div id="myheadtitle" style=" margin-bottom:0px;">
                                Add Category
                               <ul class="my_quick_bt" style="">
                                    
                                    <li>
                                        <a href="<?php echo base_url(); ?>team">
                                            <i class="ion-ios-undo-outline"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="panel-body" style="padding-left:0px; padding-right:0px;  padding-top:5px; padding-bottom:0px;">
										<form class="form-horizontal form-bordered" action="" method="post">
                                            
                                            <input type="hidden" value="" name="product_details">
                                            
									  <div class="col-md-3" style="display:none;">
										   <div class="form-group" >
											  <div class="col-md-12">
												<select class="form-control" name="category_type">
													<option value="item">Item</option>
													<option value="table">Table</option>
												</select>
											  </div>
										  </div>
										</div>
										<div class="col-md-12">
											<div class="form-group" style="margin-bottom:0px;">
												<div class="col-md-6">
                                                    <div class="chosen-select-single mg-b-20">
                                                 
                                                      <select data-placeholder="Choose a Country..." class="chosen-select" name="select_product" tabindex="-1">
                                                         <option value="">Select Product</option>
                                                         
                                                        <?php foreach($dairy_product_list as $row){ ?>
                                                         <option value="<?php echo $row->product_id; ?>" data-product_name="<?php echo $row->product_name; ?>" data-product_price="<?php echo $row->product_price; ?>" data-remaining_stock="<?php echo +$row->remaining_qty; ?>" data-unit="<?php echo $row->unit; ?>" ><?php echo $row->product_name; ?></option>
                                                         <?php } ?>
													</select>
                                                    </div>
                                                    
												</div>
                                                
                                                <div class="col-md-6" style="pading-left:0px;">
                                                    <div class="chosen-select-single mg-b-20">
                                                 
                                                     <select data-placeholder="Choose a Country..." class="chosen-select" name="select_customer" tabindex="-1">
                                                         <option value="">Select Customer</option>
                                                         
                                                        <?php foreach($all_customer_list as $row){ ?>
                                                         <option value="<?php echo $row->customer_id; ?>"  ><?php echo $row->first_name.' '.$row->last_name.' '.$row->contact_1; ?></option>
                                                         <?php } ?>
													</select>
                                                    </div>
                                                    
												</div>
											</div>
						                 </div>
                                            
                                            
                                        <div class="col-md-12" style="">
                                            <div style="height:250px; overflow:auto;  border: 1px solid #e1e1e1;">
                                            <table class="table table-bordered" >
                                                <thead>
                                                     <tr style="background-color:#46c7fe;">
                                                         <th>Product</th>
                                                         <th>Price</th>
                                                         <th>Quantity</th>
                                                         <th>Subtotal</th>
                                                          <th>Remove</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="product_table" >
                                                    
                                                </tbody>
                                                <tfoot>
                                                     <tr>
                                                        <td>Total</td>
                                                        <td></td>
                                                        <td></td>
                                                        
                                                        <td class="grand_total">0</td>
                                                          <td></td>
                                                    </tr>
                                                </tfoot>
                                            
                                            
                                            </table>
                                            </div>
						                 </div>    
									
								
									
									<div class="col-md-6" style="margin-top:50px;">
											<div class="form-group">
												<div class="col-md-12">
												<a href="<?php echo base_url(); ?>category/add_category">	<button type="button" class="btn-transparent btn-red"  style=" width:100%; height:35px;">Cancel</button></a>
												</div>
											</div>
						      </div>
                                            <div class="col-md-6" style="margin-top:50px;">
											<div class="form-group">
												<div class="col-md-12">
													<input type="submit" class="btn btn-primary" name="submit" value="submit" style=" width:100%;">
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
            
        
			           <div id="del_alert_action" class="modal modal-edu-general FullColor-popup-DangerModal fade" role="dialog" data-backdrop="static" data-keyboard="false" style="width:460px; margin:auto;">
										 <div class="modal-dialog" style="width:90%;">
												 <div class="modal-content">
														 <div class="modal-close-area modal-close-df">
																 <a class="close" data-dismiss="modal" href="#"><i class="fa fa-close"></i></a>
														 </div>
														 <div class="modal-body" style="padding: 30px 30px; background-color:#363956; text-align:center; color:#ffffff;">
																 <span class="ion-ios-flame-outline" style="font-size:50px; color:#ff4747;"></span>
																 <h2 style="margin-top:6px;">Are You Sure!</h2>
																 <p class="fail_model_p">Do you want to delete this account?</p>
														 </div>
														 <div class="modal-footer danger-md" style=" background-color:#363956; border-top:none;">
																 <button class="btn-transparent btn-red" type="button" data-dismiss="modal" style="width:80px;">No</button>
																 <button data-del_id="" id="del_bt" class="btn-transparent btn-green" type="button"  style="width:80px; ">Yes</button>
					                   </div>
												 </div>
										 </div>
								 </div>
	</div>

   <?php $this->load->view('common/footer_script'); ?>
    <script src="<?php echo base_url(); ?>/catalogs/js/image_compress/image-compressor.js"></script>
   <script src="<?php echo base_url('catalogs'); ?>/js/datapicker/bootstrap-datepicker.js"></script>
    <script src="<?php echo base_url('catalogs'); ?>/js/datapicker/datepicker-active.js"></script> 
    
      <script src="<?php echo base_url('catalogs'); ?>/js/chosen/chosen.jquery.js"></script>
    <script src="<?php echo base_url('catalogs'); ?>/js/chosen/chosen-active.js"></script>
    <!-- select2 JS
		============================================ -->
    <script src="js/select2/select2.full.min.js"></script>
    <script src="js/select2/select2-active.js"></script>
  
<script type="text/javascript">
		 $(document).ready(function(){
             
             
             function product_grand_total(){
                 
                  var subtotal = 0;
                 
                  $('.subtotal_td').each(function(){
                      var this_subtotal = $(this).html();
                      subtotal += Math.abs(this_subtotal);
                      
                  });
                  var grand_total =  $('.grand_total').html(subtotal);
                 
             }
             
             
             function product_details_array(){
                 
                   var product_array = [];
                 
                   $('.product_tr').each(function(){
                       
                         var p_id = $(this).data('product_id');
                         var p_qty = $(this).find('input[name=qty_input]').val();
                         var p_subtotal = $(this).find('.subtotal_td').html();
                         var p_type = $(this).data('product_type');
                        
                        if(p_qty > 0){
                        product_array.push({product_id:p_id , product_qty:p_qty, subtotal: p_subtotal, product_type: p_type});
                        }
                   });
                 $('input[name=product_details]').val(JSON.stringify(product_array));
             }
             
             $(document).on('change','select[name=select_product]',function(){
                 
                  var product_id = $(this).val();
                  var product_name = $( "select[name=select_product] option:selected" ).data("product_name");
                  var product_price = $( "select[name=select_product] option:selected" ).data("product_price");
                   var remaining_stock = $( "select[name=select_product] option:selected" ).data("remaining_stock");
                 var unit = $( "select[name=select_product] option:selected" ).data("unit");
                 
                 if(remaining_stock > 0){
                  $('#product_table').append('<tr class="product_tr" data-product_id="'+product_id+'"  data-unit_price="'+product_price+'" data-product_type="dairy_product"><td>'+product_name+'</td><td><input type="number"  value="'+product_price+'" class="form-control" name="product_price_input" readonly style="width:100px; height:32px;"></td><td><button type="button" class="btn" name="decrease_bt">-</button><input type="text" name="qty_input" value="1" data-qty_unit="'+unit+'"  style="width:50px; text-align:center; border:none;"/><button type="button" class="btn" name="increase_bt">+</button></td><td class="subtotal_td">'+product_price+'</td><td><button type="button" class="btn" name="remove">X</button></td></tr>');
                 }else{
                     $('select[name=select_product]').val('');
                 }
                 product_grand_total();
                 
                 product_details_array();
                  
                 
             });
             
             
              $(document).on('click','button[name=increase_bt]',function(){
                 var qty = $(this).parent().find('input[name=qty_input]').val();
                 var unit = $(this).parent().find('input[name=qty_input]').data('qty_unit');
                 
                 if(unit == 'Pkt'){
                     var cal_qty = Math.abs(qty) + 1;
                 }else{
                     var cal_qty = Math.abs(qty) + 0.1;
                 }
                 
                 var subtotal = $(this).parent().parent().find('input[name=product_price_input]').val();
                 
                 var cal_subtotal = Math.abs(subtotal) * Math.abs(cal_qty);
                 
                 
                 $(this).parent().find('input[name=qty_input]').val(cal_qty.toFixed(2));
                 $(this).parent().parent().find('.subtotal_td').html(cal_subtotal.toFixed(2));
                 product_grand_total();
                 product_details_array();
             });
             
             $(document).on('click','button[name=decrease_bt]',function(){
                 var qty = $(this).parent().find('input[name=qty_input]').val();
                 var unit = $(this).parent().find('input[name=qty_input]').data('qty_unit');
                 
                 if(unit == 'Pkt'){
                     var cal_qty = Math.abs(qty) - 1;
                 }else{
                     var cal_qty = Math.abs(qty) - 0.1;
                 }
                 
                 
                 var subtotal = $(this).parent().parent().find('input[name=product_price_input]').val();
                 var cal_subtotal = Math.abs(subtotal) * Math.abs(cal_qty);
                
                 if(cal_qty > 0){
                 $(this).parent().find('input[name=qty_input]').val(cal_qty.toFixed(2));
                 $(this).parent().parent().find('.subtotal_td').html(cal_subtotal.toFixed(2)); 
                 product_grand_total();   
                 product_details_array();     
                 }
             });
             
              $(document).on('keyup','input[name=qty_input]',function(){
                 var qty = $(this).val();
                
                  var subtotal = $(this).parent().parent().find('input[name=product_price_input]').val();
                 var cal_subtotal = Math.abs(subtotal) * Math.abs(qty);
                
                 if(qty >= 0){
                // $(this).parent().find('input[name=qty_input]').val(cal_qty);
                 $(this).parent().parent().find('.subtotal_td').html(cal_subtotal.toFixed(2)); 
                 product_grand_total();   
                 product_details_array();     
                 }
             });
             
             
             $(document).on('click','button[name=remove]',function(){
                  $(this).parent().parent().remove();
                  product_grand_total();
                  product_details_array();
              });
             
             
             
             // add product when product clicked
             
             $(document).on('click','div[name=add_product_by_click]',function(){
                 
                   var product_id = $(this).data("product_id");
                  var product_name = $(this).data("product_name");
                  var product_price = $(this).data("product_price");
                  var check_product_type = $(this).data("product_type");
                 var remaining_stock = $(this).data("remaining_stock");
                 var unit = $(this).data("unit");
               
                  if(check_product_type == 'e_product'){
                      
                        $('#product_table').append('<tr class="product_tr" data-product_id="'+product_id+'"  data-unit_price="'+product_price+'" data-product_type="e_product"><td>'+product_name+'</td><td><input type="text" value="'+product_price+'" class="form-control" name="product_price_input" readonly style="width:100px; height:32px;"></td><td><button type="button" class="btn" name="decrease_bt">-</button><input type="text" name="qty_input" value="1"  style="width:50px; text-align:center; border:none;"/><button type="button" class="btn" name="increase_bt">+</button></td><td class="subtotal_td">'+product_price+'</td><td><button type="button" class="btn" name="remove">X</button></td></tr>');
                      
                  }else if(check_product_type == 'dairy_product'){
                       if(remaining_stock > 0){    
                      
                           $('#product_table').append('<tr class="product_tr" data-product_id="'+product_id+'"  data-unit_price="'+product_price+'" data-product_type="dairy_product" ><td>'+product_name+'</td><td><input type="text" value="'+product_price+'" class="form-control" name="product_price_input" readonly style="width:100px; height:32px;"></td><td><button type="button" class="btn" name="decrease_bt">-</button><input type="text" name="qty_input" value="1" data-qty_unit="'+unit+'"  style="width:50px; text-align:center; border:none;"/><button type="button" class="btn" name="increase_bt">+</button></td><td class="subtotal_td">'+product_price+'</td><td><button type="button" class="btn" name="remove">X</button></td></tr>');   
                       }
                    }
                 
                  
                 
                 product_grand_total();
                 
                 product_details_array();
                 
             });
             
             
             // show hide dairy product and e product
             
             $(document).on('click','button[id=dairy_product_bt]',function(){
                    $('#e_product').hide();
                 $('#dairy_product').show();
               
                 
             });
             
             $(document).on('click','button[id=e_product_bt]',function(){
                  
                 $('#dairy_product').hide();
                 $('#e_product').show();
                 
             });
             
             
             // make readable when click on price input
             
             $(document).on('click','input[name=product_price_input]',function(event){
                 
                   event.stopPropagation();
                   $(this).attr('readonly',false);
             });
             
             $(document).on('click','body',function(){
                
                 $('input[name=product_price_input]').attr('readonly',true);
             });
             
             $(document).on('keyup','input[name=product_price_input]',function(){
               
                 var price = $(this).val();
                 var qty = $(this).parent().parent().find('input[name=qty_input]').val();
                 
                 var cal_subtotal = Math.abs(price) * Math.abs(qty);
                 
                 $(this).parent().parent().find('.subtotal_td').html(cal_subtotal);
                 product_grand_total();
                 product_details_array(); 
             });
         });
</script>
</body>
</html>