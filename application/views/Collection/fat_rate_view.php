<?php
header('Cache-Control: max-age=900');
?>
<!doctype html>
<html class="no-js" lang="en">

<head>
   <?php $this->load->view('common/header_link'); ?>
   <link rel="stylesheet" href="<?php echo base_url('catalogs'); ?>/css/modals.css">
   <link rel="stylesheet" href="<?php echo base_url('catalogs'); ?>/css/select2/select2.min.css">
   <!-- calendar CSS
		============================================ -->
    <link rel="stylesheet" href="<?php echo base_url('catalogs'); ?>/css/calendar/fullcalendar.min.css">
    <link rel="stylesheet" href="<?php echo base_url('catalogs'); ?>/css/calendar/fullcalendar.print.min.css">
    
    <link rel="stylesheet" href="<?php echo base_url('catalogs'); ?>/css/preloader/preloader-style.css">
    <style type="text/css">
        .form-control{
            height:32px;
        }
        
        #customer_table tr:hover{
        cursor: pointer;
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
           <div class="container-fluid" style="margin-top:15px;">
            <div class="product-status-wrap mycard" style="padding-top:0px; border-top:2px solid #0099cc;">
                 <div class="row" style="background-color:#f7f7f7; ">
				        <div class="search_engine" style="height:auto; min-height:60px; padding-top:15px;">
                            <div class="breadcome-heading" style="">
                                <div class="input-group"  style=" width:100%;">
                                        <input type="hidden" id="return_colony" value="<?php if(isset($return_colony)){ echo $return_colony; } ?>">
                                        <input type="hidden" id="return_status" value="<?php if(isset($return_status)){ echo $return_status; } ?>">
                                    
                                        <form class="form-horizontal form-bordered" action="" method="POST">
                                        <div class="col-md-12">

                                      <div class="col-md-2">
										<div class="form-group">
											<div class="col-md-12">
												<input type="text"  class="form-control" name="minimum_fat_value" value="<?php if(isset($list[0])){echo $list[0]->minimum_fat_value; }?>"  required><span class="placeholder">Min Fat Value</span>
											</div>
										</div>
								      </div>

								      <div class="col-md-2">
										<div class="form-group">
											<div class="col-md-12">
												<input type="text"  class="form-control" name="maximum_fat_value" value="<?php if(isset($list[0])){echo $list[0]->maximum_fat_value; }?>"  required><span class="placeholder">Max Fat Value</span>
											</div>
										</div>
								      </div>

								      <div class="col-md-2">
										<div class="form-group">
											<div class="col-md-12">
												<input type="text"  class="form-control" name="fat_rate" value="<?php if(isset($list[0])){echo $list[0]->fat_rate; }?>"  required><span class="placeholder">Fat Rate</span>
											</div>
										</div>
								      </div>            
                                </div>
                                  
									<div class="col-md-2" style="margin-left:15px;">
											<div class="form-group">
												<div class="col-md-12">
													<input type="submit" class="btn btn-primary" name="submit" value="submit" style=" width:100%;">
												</div>
											</div>
						      </div>
                                            
									<div class="col-md-2">
											<div class="form-group">
												<div class="col-md-12">
												<a href="<?php echo base_url(); ?>product/add_product">	<button type="button" class="btn-transparent btn-red"  style=" width:100%;">Cancel</button></a>
												</div>
											</div>
						      </div>
									</form>
                                </div>
                             </div>
				          </div>		
				 </div>
         
                <div class="row">
                    <div class="col-md-12">
						    <div id="myheadtitle" style=" height:52px; border-bottom:none; padding-top:15px; font-size: 15.1px; margin:0px;">
                                Milk Fat Rate List
                                   
                            </div>
                            <div class="asset-inner">
							      
                                <table id="table" data-toggle="table" data-pagination="true" data-show-columns="true" data-show-pagination-switch="true"  data-key-events="true" data-show-toggle="true"  data-cookie="true"
                                        data-cookie-id-table="saveId" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">
                                     <thead>
									<tr>
                                        <th>Sr. No.</th>
                                         <th>Minimum</th>
                                        <th>Maximum</th>
                                        <th>Fat Rate</th>
                                        <th>Action</th> 
                                    </tr>
									 </thead>
									 <tbody id="customer_table">
                                     <?php $i = 1; if(isset($fat_details)){ foreach($fat_details as $row){ ?>   
                                        
                                      <tr>
                                          
                                       <td> <?php echo $i++; ?></td>          
                                       <td><?php echo $row->minimum_fat_value; ?></td>
                                       <td><?php echo $row->maximum_fat_value; ?></td>      
                                       <td><?php echo $row->fat_rate; ?></td>
                                        <td>
                    <a 
                       href="<?php echo base_url(); ?>/collection/edit_fat_rate/<?php echo $row->fat_id; ?>"> <button type="button"   style=" width:30%;"><i class="fa fa-pencil"></i></button> 
                        </a>
                     <a
                        href="<?php echo base_url(); ?>/collection/delete_fat_rate/<?php echo $row->fat_id; ?>"> <button type="button"   style=" width:30%;"><i class="fa fa-trash"></i></button>
                   </a>
                      </td>
                      
                                         
                                       </tr>
									<?php }} ?>
									</tbody>
								</table>
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
                                        <p class="success_model_p"></p>
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
                                        <p class="fail_model_p">Sorry Opration Is failed ! Try Again</p>
                                    </div>
                                    <div class="modal-footer danger-md">
                                       
                                        <button class="btn btn-primary" type="button" data-dismiss="modal" style="width:80px; background-color:#2c6be0;">OK</button>
                                    
									</div>
                                </div>
                            </div>
                        </div>
                        
                        <div id="del_alert" class="modal modal-edu-general FullColor-popup-DangerModal fade" role="dialog" style="width:460px; margin:auto;">
                            <div class="modal-dialog" style="width:90%;">
                                <div class="modal-content">
                                    <div class="modal-close-area modal-close-df">
                                        <a class="close" data-dismiss="modal" href="#"><i class="fa fa-close"></i></a>
                                    </div>
                                    <div class="modal-body" style="padding: 30px 30px;">
                                        <span class="educate-icon educate-danger modal-check-pro information-icon-pro"></span>
                                        <h2>Are You Sure!</h2>
                                        <p class="fail_model_p">You want to delete this account.</p>
                                    </div>
                                    <div class="modal-footer danger-md">
                                        <button class="btn btn-primary" type="button" data-dismiss="modal" style="width:80px; background-color:#2c6be0;">No</button>
                                        <button data-delete_id="" id="del_model_bt" class="btn btn-primary" type="button"  style="width:80px; background-color:#39ae60;">Yes</button>
                                    
									</div>
                                </div>
                            </div>
                        </div>
        
	</div>

   <?php $this->load->view('common/footer_script'); ?>
    <script src="<?php echo base_url('catalogs'); ?>/js/select2/select2.full.min.js"></script>
    <script src="<?php echo base_url('catalogs'); ?>/js/select2/select2-active.js"></script>
    <!-- datapicker JS
		============================================ -->
    <script src="<?php echo base_url('catalogs'); ?>/js/datapicker/bootstrap-datepicker.js"></script>
    <script src="<?php echo base_url('catalogs'); ?>/js/datapicker/datepicker-active.js"></script>
   <script type="text/javascript">
    $(document).ready(function(){
      
        function select_take(){ 
             var select_colony = $('input[id=return_colony]').val();
             
             var select_status = $('input[id=return_status]').val();                 
             
            $('select[name=colony_search]').val(select_colony);
            
            $('select[name=status_search]').val(select_status);
      
        } 
        select_take();
        
        $(document).on('click', '#tbl_refresh',function(){
            
           window.location.href =   window.location.href;
            
        });
        
      
        
    });
    
   
    </script>
</body>
</html>