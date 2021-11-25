<!doctype html>
<html class="fixed">
<head>
		<?php $this->load->view('common/header_link'); ?>
    <style style="text/css">
        label{
            font-weight: 400;
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
                                Add Promo Code
                               <ul class="my_quick_bt" style="">
                                    
                                    <li>
                                        <a href="<?php echo base_url(); ?>team">
                                            <i class="ion-ios-undo-outline"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="panel-body " style="padding-top:0px;">
								   	<form class="form-horizontal form-bordered" action="" method="post">
                    <div class="col-md-6" style="padding:0px;">
											 <div class="col-md-12">
											   <div class="form-group">
												  <div class="col-md-12">
                                                      <label> Promo Code</label>
													   <input type="text" class="form-control" name="promocode" placeholder="Promo Code" value="<?php if(isset($selected_row[0])){ echo $selected_row[0]->promo_code; } ?>" required>
												  </div>
											   </div>
										   </div>
											 <div class="col-md-12">
		 										<div class="form-group">
		 											<div class="col-md-12">
                                                        <label> Detail</label>
		 												<input type="text" class="form-control" name="detail" placeholder="Detail" value="<?php if(isset($selected_row[0])){ echo $selected_row[0]->promo_detail; } ?>" required>
		 											</div>
		 										</div>
		 								 </div>
											 <div class="col-md-12">
												 <div class="form-group">
													 <div class="col-md-12">
                                                         <label> Discount Type</label>
                                                         <select name="discount_type" class="form-control" >
                                                             <option value="percent" <?php if(isset($selected_row[0])){ if(json_decode($selected_row[0]->promo_discount)->type == 'percent'){ echo 'selected'; }} ?> >%</option>
                                                             <option value="rupee" <?php if(isset($selected_row[0])){ if(json_decode($selected_row[0]->promo_discount)->type == 'rupee' ){ echo 'selected'; }} ?>>RS</option>   
                                                         </select>
														 
													 </div>
												 </div>
											</div>
                        
                                            <div class="col-md-12">
												 <div class="form-group">
													 <div class="col-md-12">
                                                         <label> Discount Value</label>
                                                         
														 <input type="text" class="form-control" name="disocunt" placeholder="Discount" value="<?php if(isset($selected_row[0])){ echo json_decode($selected_row[0]->promo_discount)->value; } ?>" >
													 </div>
												 </div>
											</div>
                                             
											
										</div>
                    <div class="col-md-6" style="padding:0px;">
											
                                  <div class="col-md-12">
												 <div class="form-group">
													 <div class="col-md-12">
                                                        <label> Validate From</label>
														 <input type="date" class="form-control" name="validate_from" placeholder="Validate From" value="<?php if(isset($selected_row[0])){ echo $selected_row[0]->validate_from; } ?>" >
													 </div>
												 </div>
											</div> 
                        
                                            <div class="col-md-12">
												 <div class="form-group">
													 <div class="col-md-12">
                                                         <label>Validate To</label>
														 <input type="date" class="form-control" name="validate_to" placeholder="Validate To" value="<?php if(isset($selected_row[0])){ echo $selected_row[0]->validate_to; } ?>" >
													 </div>
												 </div>
											</div>
                                             <div class="col-md-12">
												 <div class="form-group">
													 <div class="col-md-12">
                                                         <label> Terms / Condition</label>
														 <input type="text" class="form-control" name="terms" placeholder="Terms and Condition" value="<?php if(isset($selected_row[0])){ echo $selected_row[0]->term_condition; } ?>" >
													 </div>
												 </div>
											</div>
                                            
                                             <div class="col-md-12">
												 <div class="form-group">
                                                     <label style="margin-left:15px;"> Apply On</label>
													 <div class="col-md-12">
                                                         
														 <select class="form-control" name="product_category" style="width:150px; display:inline-block; float:left;" id="product_category">
                                                             <option value="all">All</option>
                                                             <option value="category">Category</option>
                                                             <option value="subcategory">Subcategory</option>
                                                             <option value="product">Product</option>
                                                           
                                                         </select> 
                                                         <div style="width: calc(100% - 155px);  display:inline-block;">
								                					<select data-plugin-selectTwo class="form-control populate" id="product_list" name="product_list">
								                						
								                							
								                					</select>
								                        </div>
													 </div>
												 </div>
                                                 
                                                 
											</div>
                  </div>



									<div class="col-md-6">
											<div class="form-group">
												<div class="col-md-12">
													<a href="<?php echo base_url(); ?>category/add_category">	<button type="button" class="btn-transparent btn-red"  style=" width:80px; height:35px;">Cancel</button></a>
													<input type="submit" class="btn btn-primary" name="submit" value="submit" style="">
												</div>
											</div>
						      </div>
									<div class="col-md-6">
											<div class="form-group">
												<div class="col-md-12">

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
<script type="text/javascript">
		 $(document).ready(function(){
     // set scroll position
		 $(document).on('change','select[id=product_category]', function(){
            
               var val = $(this).val();
             	$.ajax({
		              url : '<?php echo base_url(); ?>/promo_code/select_product_by_option',
								  method: 'POST',
									data:{val: val},
									success:function(data){
										
                                        $('#product_list').html(data);
					
									}
				});
             
         });
// delete functionality
    $(document).on('click','button[id=confirm_del_action]',function(){
						 var confirm_del_id = $(this).data("confirm_del_id");
						 $('#del_bt').data('del_id',confirm_del_id);
						 $('#del_alert_action').modal("toggle");
		});

		$(document).on('click','button[id=del_bt]',function(){
			   var del_id = $(this).data("del_id");
							$.ajax({
		              url : '<?php echo base_url(); ?>/category/del_product_category',
								  method: 'POST',
									data:{del_id: del_id},
									success:function(data){
										//alert(data);
										if(data === 'success'){
											window.location.href = window.location.href;
										}
									}
							});
	    });
});
</script>
</body>
</html>
