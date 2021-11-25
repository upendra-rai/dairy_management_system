<!doctype html>
<html class="fixed">
<head>
		<?php $this->load->view('common/header_link'); ?>
		<style type="text/css">
            table thead{
                background-color: #46c7fe;
            }
            table{
                border:1px solid #ebebeb;
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
                                Point Management
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
								   <table class="table mb-none" >
									 <thead>
									   	<tr>
											   <th>Task</th>
                                            <th>Points</th>
										     <th></th>
											   <th></th>
										    
										</tr>
									</thead>
									<tbody>
										 <tr>
                                             <td style="width:180px;">Points</td>  
                                             <td><input type="number" class="form-control" name="point_value" value="<?php if(isset($mysetting)){ echo $mysetting[0]->point_value; } ?>" name="" required></td>  
                                             <td><input type="text" class="form-control" value="" name="" style="opacity:0;" readonly></td>  
                                             <td><input type="text" class="form-control" value="" name="" style="opacity:0;" readonly></td>  
                                        </tr>
                                        
                                      
									</tbody>
								</table>
                            
                                <table class="table mb-none">
									 <thead>
									   	<tr>
											   <th>Task</th>
                                            <th>Insert Point</th>
										     <th>Point Value</th>
											   <th>Sales Figure</th>
										    
										</tr>
									</thead>
									<tbody>
										
                                        <tr>
                                             <td style="width:180px;">Loyalty Points</td>  
                                             <td><input type="number" class="form-control" value="<?php if(isset($mysetting)){ echo $mysetting[0]->loyalty_sales_point; } ?>" name="loyal_point" required></td>  
                                             <td><input type="number" class="form-control" value="<?php if(isset($mysetting)){ echo $mysetting[0]->point_value * $mysetting[0]->loyalty_sales_point; } ?>" name="calculate_value" ></td>  
                                             <td><input type="number" class="form-control" value="<?php if(isset($mysetting)){ echo $mysetting[0]->loyalty_sales_figure; } ?>" name="loyal_sales_figure" required></td>  
                                        </tr>
                                       
									</tbody>
								</table>
                            
                                <table class="table mb-none">
									 <thead>
									   	<tr>
											   <th>Task</th>
                                            <th>Reffer Point</th>
										     <th></th>
											   <th></th>
										    
										</tr>
									</thead>
									<tbody>
										
                                        <tr>
                                             <td style="width:180px;">Reffer Points</td>  
                                             <td><input type="number" class="form-control" value="<?php if(isset($mysetting)){ echo $mysetting[0]->reffer_and_earn; } ?>" name="reffer_point" required></td>  
                                             <td><input type="text" class="form-control" value="" name="calculate_value" style="opacity:0;" readonly></td>  
                                             <td><input type="text" class="form-control" value="" name="" style="opacity:0;" readonly></td>  
                                        </tr>
                                       
									</tbody>
                                    <tfoot>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td style="text-align:right;"><input type="submit" class="btn btn-transparent btn-blue" name="submit" value="submit" style="background-color:#46c7fe; color:#ffffff;"/>  </td>
                                        </tr>
                                    </tfoot>
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
    
    $(document).on('keyup','input[name=loyal_point]',function(){
        
        
         var point_value = $('input[name=point_value]').val();
         var insert_point = $(this).val();
         
         var cal = Math.abs(point_value) * Math.abs(insert_point);
          
         $('input[name=calculate_value]').val(cal);
         
    });
             
});
</script>
</body>
</html>
