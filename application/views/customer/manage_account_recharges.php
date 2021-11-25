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

    <link rel="stylesheet" href="<?php echo base_url('catalogs'); ?>/css/notifications/Lobibox.min.css">
    <link rel="stylesheet" href="<?php echo base_url('catalogs'); ?>/css/notifications/notifications.css">
    
       <link rel="stylesheet" href="<?php echo base_url('catalogs'); ?>/css/chosen/bootstrap-chosen.css">

<style type="text/css">
    .detail_box p label{

        font-weight: 400;
        color: #000000;
        /*color: #525252;*/
        font-size: 15px;
    }
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
    
    .form-control{
        height: 30px;
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


            <div class="container-fluid" style="margin-top:15px; " id="action_div">
            <div class="product-status-wrap mycard" style="padding-top:5px; border-top:2px solid #0099cc;">
			    <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding:7px; margin-bottom: 0px;">
                    <div class="message error" style="display:<?php if(isset($message) && $message === "failed"){ echo "block"; } ?>">
                                                          Process is failed!
                                                          <button type="button" title="close" style="background-color:transparent; border:none; float:right;">X</button>
                                                          <br>
                                                          <br>
                                                      </div>
                                                     <div class="message success s_add" style="display:<?php if(isset($message) && $message === "success"){ echo "block"; } ?>">
                                                          Customer profile is successfully added.
                                                         <button type="button" title="close" style="background-color:transparent; border:none; float:right;">X</button>
                                                         <br>
                                                          <br>
                                                      </div>
                                                     <div class="message success s_update" style="display:<?php if(isset($message) && $message === "updatesuccess"){ echo "block"; } ?>">
                                                         Customer profile is successfully updated.
                                                          <button type="button" title="close" style="background-color:transparent; border:none; float:right;">X</button>
                                                        <br>
                                                      </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                             <div id="myheadtitle" style="margin-bottom:0px; height:45px;">
                                <input type="hidden" id="msg_input" value="<?php if(isset($message)){ echo $message; }else{ echo ""; } ?>">
                                Manage Log
                                
                                 <ul class="my_quick_bt" style="width: calc(100% - 150px); right:0;">
                                     
                                     <li style="width:25%;">
                                        
                                          <div class="chosen-select-single mg-b-20">
                                                <select data-placeholder="Choose a Country..." class="chosen-select" name="customer_id" tabindex="-1">
                                                <option value="">Search Customer</option>
                                                <?php if(isset($all_customer_list)){ foreach($all_customer_list as $row){ ?>
                                                    <option value="<?php echo $row->customer_id; ?>" <?php if(isset($detail[0]->customer_id)){ if($detail[0]->customer_id == $row->customer_id ){ echo 'selected'; } }  ?>  >
                                                       <?php echo $row->atm_card_no; ?> <?php echo $row->first_name.' '.$row->last_name ?>

                                                      </option>

                                                 <?php }} ?>
													                       </select>
                                            </div>

                                     </li>
                                     
                                     <li>
                                          <a href="<?php echo base_url() ?>customer/view_customer/<?php if(isset($detail[0]->customer_id)){ echo $detail[0]->customer_id; }  ?>"> <button class="btn">View Account</button></a>
                                            
                                    </li>
                                    <li>
                                          <a href="<?php echo base_url() ?>/manage_account/transaction/<?php if(isset($detail[0]->customer_id)){ echo $detail[0]->customer_id; }  ?>"> <button class="btn ">Transaction</button></a>
                                            
                                    </li>
                                    <li>
                                         <a href="<?php echo base_url() ?>/manage_account/recharge/<?php if(isset($detail[0]->customer_id)){ echo $detail[0]->customer_id; }  ?>"><button class="btn btn-primary">Recharge</button></a>
                                    </li>
                                   <!--  <li>
                                         <a href="<?php echo base_url() ?>/manage_account/account_balance/<?php if(isset($detail[0]->customer_id)){ echo $detail[0]->customer_id; }  ?>"><button class="btn">Current Balance</button></a>
                                    </li> -->
                                     
                                     <li>
                                         <a href="<?php echo base_url() ?>/manage_account/log_history/<?php if(isset($detail[0]->customer_id)){ echo $detail[0]->customer_id; }  ?>"><button class="btn">Log History</button></a>
                                    </li>
                                     
                                </ul>
                            </div>
                            <div class="row" >
                                <?php foreach($detail as $row){ ?>
							     <div class="col-md-3">
                                     <div class="detail_box first">
                                        
                                         <p style="font-weight:600; color:#0798dc;"><label>Name:&nbsp;</label> <?php echo $row->first_name.' '.$row->last_name; ?></p>
                                         
                                         <p><label>Phone 1:&nbsp;</label> <?php echo $row->contact_1; ?></p>
                                         <p style="font-weight:600; color:#0798dc;"><label>Card No:&nbsp;</label> <?php echo $row->atm_card_no; ?></p>
                                              <p style="font-weight:600; color:#0798dc;"><label>Balance: &nbsp; <i class="fa fa-rupee" style="color:#0798dc;"></i></label> <?php echo number_format($row->balance_amount,1); ?></p>
                                         <p><label>Colony:&nbsp;</label><?php echo $row->colony_name; ?></p>
                                         <p><label>Address1:&nbsp;</label><?php echo $row->address_1; ?></p>
                                         
                                         
                                         <p><label>Assigned Agent:&nbsp;</label> <?php echo $row->name; ?></p>
                                         
                                         
                                        
                                     </div>

                                 </div>

                                <div class="col-md-9" style="padding:0px;">
                                         <div class="detail_box second" style="border-right: 1px solid transparent;  padding-top:0px;">
                                              
                                               <div class="detail_box first">
                                                           <form action="" method="post">
                                                             <div class="row">
                                                                <div class="col-xs-4">
                                                                <div class="form-group">
                                                                    
                                                                  <input type="datetime-local" name="my_date" class="form-control" value="" required>
                                                                </div> 
                                                                 </div>
                                                                 <div class="col-xs-4">
                                                                <div class="form-group">
                                                                  <input type="number" step="0.01" min="1" class="form-control" name="amount" value="" placeholder="Recharge Amount" required>
                                                                </div> 
                                                                 </div>
                                                                 <div class="col-xs-4">
                                                                 <div class="form-group">
                                                                  <input type="text" class="form-control" name="t_id" value="" placeholder="Transaction ID">
                                                                </div> 
                                                                 </div>
                                                                 
                                                                 <div class="col-xs-4">
                                                                <div class="form-group">
                                                                  <select class="form-control" name="by" required>
                                                                      <option value="">Recharge By</option>
                                                                      <?php if(isset($all_agent)) foreach($all_agent as $row){ ?>
                                                                        <option value="<?php echo $row->user_id; ?>"><?php echo $row->name; ?></option>
                                                                      <?php } ?>
                                                                  </select>
                                                                </div> 
                                                                 </div>
                                                                 
                                                                  <div class="col-xs-3">
                                                                <div class="form-group">
                                                                  <input type="submit" name="submit" value="Add recharges" class="btn btn-primary">
                                                                </div> 
                                                                 </div>
                                                              </div> 
                                                   </form>
                                                                 
                                                                <div class="asset-inner" >
                                                                 <table  data-toggle="table"   >
                                                                     <thead>
					                                 				<tr>
                                                                        <th>Sr No.</th>
                                                                         <th>Delete</th>
					                                 			        <th>Recharge Date</th>
                                                                         <th>Card No</th>
                                                                        <th>Payment ID</th>
                                                                        <th>Amount</th>
                                                                        
                                                                        <th>Recharge By</th>
                                                                         <!--<th>Assign</th>-->
                                                                     </tr>
					                                 			    </thead>
					                                 		    	  <tbody id="tran_table">
                                                                       <?php $i = 1; if(isset($detail_recharge)){ foreach($detail_recharge as $row){ ?>
                                                                              <tr>
                                                                                  <td><?php echo $i++; ?></td>
                                                                                  
                                                                                  <td> <button name="del_recharge" data-del_id="<?php echo $row->recharge_id; ?>"  class="pd-setting-ed myedit" style="background-color:#e91e63;"><i class="fa fa-trash-o" aria-hidden="true" ></i></button></td>
                                                                                  
                                                                                  
                                                                                  <td><?php echo date('d-M-Y h:i:sa',strtotime($row->recharge_date)); ?></td>
                                                                                  <td><?php echo $row->atm_card_no; ?></td>
                                                                                  <td> <?php echo $row->payment_id; ?></td>
                                                                                   <td><i class="fa fa-rupee"></i> <?php echo $row->recharge_amount; ?></td>
                                                                                  
                                                                                    <td><?php echo $row->name; ?></td>
                                                                                
                                                                                  
                                                                               
                                                                             </tr>
                                                                          <?php }} ?>
					                                 		    	  </tbody>

					                                 			</table>
                                                             </div>
                                                                       </div>
				               </div>

                        <?php } ?>
                            </div>
                            
                    </div>
                       
                </div>
            </div>
	    </div>

        
        <br>
        <br>

                  
			           <div id="failed_alert" class="modal modal-edu-general FullColor-popup-DangerModal fade" role="dialog" data-backdrop="static" data-keyboard="false" style="width:460px; margin:auto;">
                            <div class="modal-dialog" style="width:90%;">
                                <div class="modal-content">

                                    <div class="modal-body" style="padding: 30px 30px;">
                                        <span class="educate-icon educate-danger modal-check-pro information-icon-pro"></span>
                                        <h2>Error!</h2>
                                        <p class="fail_model_p">Sorry opration is failed! Try Again!</p>
                                    </div>
                                    <div class="modal-footer danger-md">

                                        <button class="btn btn-primary" type="button" id="error_ok" style="width:80px; background-color:#2c6be0;">OK</button>

									</div>
                                </div>
                            </div>
                        </div>
                       
                        <div id="del_alert" class="modal modal-edu-general FullColor-popup-DangerModal fade" role="dialog" data-backdrop="static" data-keyboard="false" style="width:460px; margin:auto;">
                            <div class="modal-dialog" style="width:90%;">
                                <div class="modal-content">
                                     <div class="modal-close-area modal-close-df">
                                        <a class="close" data-dismiss="modal" href="#"><i class="fa fa-close"></i></a>
                                    </div>
                                    <div class="modal-body" style="padding: 30px 30px;">
                                        <span class="educate-icon educate-danger modal-check-pro information-icon-pro"></span>
                                        <h2>Are You Sure!</h2>
                                        <p class="fail_model_p">Do you want to delete this transaction?</p>
                                    </div>
                                    <div class="modal-footer danger-md" style="padding-top:0px;">
                                        <button class="btn btn-primary" type="button" data-dismiss="modal" style="width:80px; background-color:#46c7fe; border: 1px solid #46c7fe; ">Cancel</button>
                                        <button data-delete_id="" id="del_model_bt" class="btn btn-primary" type="button"  style="width:90px; background-color:#f45846; border: 1px solid #f45846;">Delete</button>
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
                                    <div class="modal-body" style="padding: 30px 30px;">
                                        <span class="educate-icon educate-danger modal-check-pro information-icon-pro"></span>
                                        <h2>Are You Sure!</h2>
                                        <p class="fail_model_p">Do you want to delete this account?</p>
                                    </div>
                                    <div class="modal-footer danger-md">
                                        <button class="btn btn-primary" type="button" data-dismiss="modal" style="width:80px; background-color:#2c6be0;">No</button>
                                        <button data-del_href="" id="del_recharge_bt" class="btn btn-primary" type="button"  style="width:80px; background-color:#39ae60;">Yes</button>

									</div>
                                </div>
                            </div>
                        </div>

                      <div id="block_alert" class="modal modal-edu-general FullColor-popup-DangerModal fade" role="dialog" data-backdrop="static" data-keyboard="false" style="width:460px; margin:auto;">
                            <div class="modal-dialog" style="width:90%;">
                                <div class="modal-content">

                                    <div class="modal-body" style="padding: 30px 30px;">
                                        <span class="educate-icon educate-danger modal-check-pro information-icon-pro"></span>
                                        <h2>Are You Sure!</h2>

                                    </div>
                                    <div class="modal-footer danger-md">
                                        <button class="btn btn-primary" type="button" id="block_cancel" style="width:80px; background-color:#2c6be0;">No</button>
                                        <button data-delete_id="" id="block_model_bt" class="btn btn-primary" type="button"  style="width:80px; background-color:#39ae60;">Yes</button>

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

    <!-- notification JS
		============================================ -->
    <script src="<?php echo base_url('catalogs'); ?>/js/notifications/Lobibox.js"></script>
    <script src="<?php echo base_url('catalogs'); ?>/js/notifications/notification-active.js"></script>
        
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


          $(document).on('click','button[name=del_recharge]',function(){
            
			var link_id = $(this).data("del_id");
         
           
            $('button[id=del_model_bt]').data("delete_id",link_id);
            
            $('p[class=fail_model_p]').text('You want to delete this account.');
            $('#del_alert').modal("toggle");

        });

         $(document).on('click','button[id=del_model_bt]',function(){
              $('#del_alert').modal("toggle");
            var del_id = $(this).data("delete_id");
           
           

			$.ajax({
				 type: 'POST',
				 url: '<?php echo base_url(); ?>manage_account/delete_recharge',

				 data:{del_id:del_id},

				 success:function(del){
					
					 if(del === "success"){

                    
						window.location.href = window.location.href;

					}else{


						alert("something Wrong");
					}

				 }



			});

		});
         
         $(document).on('change','select[class=chosen-select]',function(){
             
             var customer_id = $(this).val();
             
             window.location.href = '<?php echo base_url(); ?>/manage_account/recharge/'+customer_id;
         });
         
         });
         
    
 // the balance amount Rs. 200/- has been returned successfully

 // Please refund this amount to customer and continue for the account termination.
   </script>
</body>
</html>
