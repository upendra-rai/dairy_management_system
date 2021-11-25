<!doctype html>
<html class="fixed">
<head>
		<?php $this->load->view('common/header_link'); ?>
		
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
            <div class="container-fluid" style="margin-top:15px;">
               <div class="product-status-wrap mycard">
			    <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div id="myheadtitle" style=" ">
                                Add Promo Code
                               <ul class="my_quick_bt" style="">
                                    
                                    <li>
                                        <a href="<?Php echo base_url(); ?>promo_code/add"><button type="btn" class="btn-transparent btn-green" style="position:absolute; right:12px; top:8px; width:80px; height:25px; border:1px solid #e2e2e2;">+ Add </button></a>
                                    </li>
                                </ul>
                            </div>
                            <div class="panel-body " style="padding-top:0px;">
								   <table class="table mb-none" id="table" data-toggle="table" data-pagination="true" style="border-bottom: 1px solid #424351;">
									 <thead>
									   	<tr>
											   <th>Sr no</th>
                                            <th>Date</th>
										     <th>Promo Code</th>
											   <th>Discount</th>
										     <th>Detail</th>
											  
								               <th>Terms / Condition</th>
											  <th>Start On</th>
								              <th>Expired On</th>
                                             <th>Validate</th>
                                            <th>Status</th>
                                            <th>Edit</th>
											   <th>Delete</th>
										</tr>
									</thead>
									<tbody>
										  <?php $i = 1; foreach($list as $row){ ?>
                                                  <tr>
														  <td><?php echo $i++; ?></td>
														  <td><?php echo $row->created_on; ?></td>
                          	                               <td><?php echo $row->promo_code; ?></td>
														  <td>
                                                          <?php if(json_decode($row->promo_discount)->type == 'percent'){ echo json_decode($row->promo_discount)->value.' %'; }else if(json_decode($row->promo_discount)->type == 'rupee'){ echo json_decode($row->promo_discount)->value.' Rs'; }; ?>
                                                          </td>
														  <td><?php echo $row->promo_detail; ?></td>
															<td><?php echo $row->term_condition; ?></td>
															<td><?php echo $row->validate_from; ?></td>
                                                             <td><?php echo $row->validate_to; ?></td>
                                                             <td><?php echo 40; ?></td>
                                                            <td><?php if($row->promo_status == ''){ echo 'Active'; }else{ echo $row->promo_status; } ?></td>
														  <td style=" text-align:center;"><a href="<?php echo base_url(); ?>promo_code/edit/<?php echo $row->promo_id; ?>"><button class="btn btn-primary" id=""  data-edit_id="" style="color:#248afd; background-color:#f2f2f2; border:1px solid #e2e2e2;"><i class="fa fa-pencil"></i></button></a></td>
															
										      	  <td style="text-align:center;"><button type="button" class="btn btn-primary" id="confirm_del_action" data-confirm_del_id="<?php echo $row->promo_id; ?>" style="color:#ff4747; background-color:#f2f2f2; border:1px solid #e2e2e2;"><i class="fa  fa-times-circle"></i></button></td>
                                                 </tr>
										<?php } ?>
									</tbody>
								</table> 
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
<script src="<?php echo base_url(); ?>/catalogs/assets/vendor/custom-scrollbar/jquery.mCustomScrollbar.concat.min.js"></script>
<script type="text/javascript">
		 $(document).ready(function(){
     // set scroll position
		 function set_scroll_position(){

			 var url = window.location.href;
			 var segments = url.split( '/' );
       var scroll_position = segments[7];
			 if(scroll_position){
					 $('html').scrollTop(scroll_position);
			 }
		 }
		 set_scroll_position();
    // set scroll position

	 
    $(document).on('click','button[id=inlink_img_bt]',function(){
			  alert("s");
          var unlink_img_src = $(this).data("unlink_img_src");

				  $.ajax({
              url : '<?php echo base_url(); ?>/category/unlink_image',
						  method: 'POST',
							data:{unlink_img_src: unlink_img_src},
							success:function(data){
								alert(data);
								if(data === 'success'){
										$('#img_label').html('<i class="fa fa-globe" style="margin-top:60px; margin-right:5px;"></i><span style="font-size:12px;">Browse</span>');
								}
							}
					});
	   });

    $(document).on('click','button[id=temprory_remove_image]',function(){
          $('#img_label').html('<i class="fa fa-globe" style="margin-top:60px; margin-right:5px;"></i><span style="font-size:12px;">Browse</span>');
		});

// rediren for update section
    $(document).on('click','button[id=edit_bt]',function(){
              var edit_id = $(this).data("edit_id");
							var scroll_position = $('html').scrollTop();
              var redirect_link  = '<?php echo base_url(); ?>category/edit_category/'+scroll_position+'/'+edit_id;

							window.location.href = redirect_link;

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
		              url : '<?php echo base_url(); ?>/promo_code/promo_delete',
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
