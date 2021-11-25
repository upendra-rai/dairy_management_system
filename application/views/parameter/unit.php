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
		
			<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12" style="padding:0px;">
            <div class="container-fluid" style="margin-top:15px;">
               <div class="product-status-wrap mycard">
			    <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div id="myheadtitle" style=" ">
                                Add Unit
                               <ul class="my_quick_bt" style="">
                                    
                                    <li>
                                        <a href="<?php echo base_url(); ?>team">
                                            <i class="ion-ios-undo-outline"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="panel-body " style="padding-top:0px;">
								    <form action="" method="POST">
								   <table class="table mb-none" id="table" data-toggle="table" data-pagination="true" style="border-bottom: 1px solid #424351;">
									 <thead>
									   	<tr>
											   <th>Sr no</th>
										       <th>Unit</th>
											   <th>Edit</th>
											   <th>Action</th>
										</tr>
									</thead>
									<tbody>
                                        
                                        <?php if(isset($edit_id)){ ?>
    
                                            <tr>
                                                 <td>Edit</td>
                                                 <td><input type="text" name="unit" value="<?php if(isset($selected_item)){ echo $selected_item[0]->unit_name; } ?>" class="form-control" value="" required/></td>
                                                 <td></td>
                                                 <td><input type="submit" name="submit" class="btn btn-primary" value="submit"></td>
                                            </tr>
                                        <?php  }else{ ?>
                                            <tr>
                                                 <td>Add</td>
                                                 <td><input type="text" name="unit" class="form-control" value="" required/></td>
                                                 <td></td>
                                                 <td><input type="submit" name="submit" class="btn btn-primary" value="submit" ></td>
                                            </tr>
                                        <?php } ?>
                                        
                                        
										  <?php $i = 1; foreach($unit_list as $row){ ?>
                                        <tr>                         
                              
                                                         
														  <td><?php echo $i++; ?></td>
														  <td style="width:110px; padding:4px; text-align:center;"><?php echo $row->unit_name; ?></td>
                          	 
                                                           <td style=" text-align:center;"><a href="<?php echo base_url(); ?>parameter/edit_unit/<?php echo $row->unit_id; ?>"><button class="btn btn-primary" type="button"  data-edit_id="<?php echo $row->unit_id; ?>" style="color:#248afd; background-color:#f2f2f2; border:1px solid #e2e2e2;"><i class="fa fa-pencil"></i></button></a></td>
										      	          <td style="text-align:center;"><button type="button" class="btn btn-primary" id="confirm_del_action" data-confirm_del_id="<?php echo $row->unit_id; ?>" style="color:#ff4747; background-color:#f2f2f2; border:1px solid #e2e2e2;"><i class="fa  fa-times-circle"></i></button></td>
                          </tr>
										<?php } ?>
									</tbody>
                                    
								</table>
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
    
     $(document).on('click','button[id=confirm_del_action]',function(){
						 var confirm_del_id = $(this).data("confirm_del_id");
						 $('#del_bt').data('del_id',confirm_del_id);
						 $('#del_alert_action').modal("toggle");
		});

		$(document).on('click','button[id=del_bt]',function(){
			   var del_id = $(this).data("del_id");
							$.ajax({
		              url : '<?php echo base_url(); ?>/parameter/del_unit',
								  method: 'POST',
									data:{del_id: del_id},
									success:function(data){
										//alert(data);
										if(data === 'success'){
											window.location.href ='<?php echo base_url(); ?>parameter/add_unit';
										}
									}
							});
	    });
     
});
</script>
</body>
</html>
