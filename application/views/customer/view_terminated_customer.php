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
                            <div id="myheadtitle" style="margin-bottom:0px; ">
                                <input type="hidden" id="msg_input" value="<?php if(isset($message)){ echo $message; }else{ echo ""; } ?>">
                                Terminated Customer Profile 
                                <ul class="my_quick_bt" style="">
                                    <li>
                                        <a id="loc_home" href="javascript:void(0);">
                                            <i class="ion-ios-home-outline"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a id="loc_back" href="javascript:void(0);">
                                            <i class="ion-ios-undo-outline"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="row" id="my_table_body">
                                <?php foreach($detail as $row){ ?>
							     <div class="col-md-6">
                                     <div class="detail_box first">
                                         <p class="box_title ">Customer Details</p>
                                         <img src="<?php echo base_url('catalogs') ?>/img/customer_img/<?php echo $row->customer_image; ?>" class="thumbnail" alt="" style="width:120px; height:120px; border-radius: 50%;" />
                                         <p style="font-weight:600; color:#0798dc;"><label>Name:&nbsp;</label> <?php echo $row->first_name.' '.$row->last_name; ?></p>
                                         <p><label>Email Address:&nbsp;</label> <?php echo $row->email_address; ?></p>
                                         <p><label>Phone 1:&nbsp;</label> <?php echo $row->contact_1; ?></p>
                                         <p><label>Phone 2:&nbsp;</label> <?php echo $row->contact_2; ?></p>
                                         <p><label>Address1:&nbsp;</label><?php echo $row->address_1; ?></p>
                                         <p><label>Address2:&nbsp;</label> <?php echo $row->address_2; ?></p>

                                         <p style="font-weight:600; color:#0798dc;"><label>Colony Name:&nbsp;</label> <?php echo $row->colony_name; ?></p>
                                         <p><label>City:&nbsp;</label> <?php echo $row->city; ?></p>
                                         <p style="display:none;"><label>Delivery Type:&nbsp;</label> <?php echo $row->d_type; ?></p>
                                         <p><label>Assigned Agent:&nbsp;</label> <?php echo $row->name; ?></p>
                                         <p><label>Password:&nbsp;</label><span><button type="button" class="btn" id="show_cus_pass" style="background-color:transparent; border:none;"><i class="ion-eye"></i></button></span> <input type="password" id="cus_pass" value="<?php echo $row->customer_password; ?>" autocomplete="new-password" style="border:none; background-color:transparent;"> </p>
                                     </div>

                                 </div>

                                <div class="col-md-6">
                                         <div class="detail_box second" style="border-right: 1px solid transparent;">
                                             <input type="hidden" id="current_balance_amount" value="" />
                                         <p class="box_title ">Account Details</p>
                                             
                                              <p style="font-weight:600; color:#0798dc;"><label>Balance: &nbsp; <i class="fa fa-rupee" style="color:#0798dc;"></i></label> <?php echo 0; ?></p>
                                              <p><label>Ragistration Date:&nbsp;</label> <?php echo date('d-M-y', strtotime($row->ragistration_date)); ?></p>
                                              <p style="color:red; font-weight:700;"><label>Status:&nbsp;</label> <?php echo 'Terminated'; ?> </p>
                                              <br>
                                         <p class="box_title ">Action Panel</p>
                                               <div class="sparkline15-graph" style="padding-left:15px;">
                                                  <div class="row">
                                                       
													  <br>
                                                       
                                                         <a href="<?php echo base_url(); ?>customer/view_terminated_customer/<?php echo $row->customer_id; ?>/recharge"> <button data-toggle="tooltip" title="Recharge Detail" data-rech_linkid="<?php echo $row->customer_id; ?>"  class="btn btn-primary action_panel_bt" style="background-color:#44bffd;"><i class="ion-cash" ></i> Recharge  Detail</button></a>
                                                        <a href="<?php echo base_url(); ?>customer/view_terminated_customer/<?php echo $row->customer_id; ?>/transaction"><button data-toggle="tooltip" title="Transaction Detail"  class="btn btn-primary action_panel_bt" style="background-color:#673ab7; "><i class="ion-ios-loop" ></i> Transaction  Detail</button></a>
                                                       
                                                   </div>
                                               </div>
				                         </div>
				               </div>

                        <?php } ?>
                            </div>
                            <div class="row" >
                                                            <div class="col-md-6" >
                                                                 <div class="detail_box first">
                                                                <div class="asset-inner" >
                                                                 <table id="table" data-toggle="table"    data-key-events="true"   data-cookie="true"
                                                                           class="table-striped">
                                                                     <thead>
					                                 				<tr>
                                                                         <th>Sr No.</th>
					                                 			        <th>Product</th>
                                                                         <th>Unit</th>
                                                                         <th>Unit Price</th>
                                                                         <th>Estimated Product Qty</th>

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
                                                                                  <td><?php if($row->unit == 'Pkt'){ echo number_format($row->product_qty); }else{ echo $row->product_qty; } ?> <?php echo $row->unit; ?></td>

                                                                             </tr>
                                                                          <?php }} ?>
					                                 		    	  </tbody>

					                                 			</table>
                                                             </div>
                                                                       </div>
                                                            </div>
                                                        </div>
                    </div>
                </div>
            </div>
	    </div>

        <div id="terminate_msg" class="container-fluid" style="margin-top:15px; display:none;">
            <div class="product-status-wrap mycard" style="padding-top:10px; border-top:2px solid #0099cc;">
			    <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">


                            <div class="asset-inner" style="text-align: center;">
                                <img src="<?php echo base_url(); ?>catalogs/img/succ4.png" alt="">
                                <p id="terminate_p" style="font-size:18px; padding:15px;">
                                </p>
                            </div>

                    </div>
                </div>
            </div>
	    </div>

        <div id="2" class="container-fluid my_rech_report" style="margin-top:15px; display: <?php if($switch == "recharge"){ echo "block"; }else{ echo "none"; } ?>" id="rech_table">
            <div class="product-status-wrap mycard" style="padding-top:10px; border-top:2px solid #0099cc;">
			    <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div id="myheadtitle" style="margin:0px; height:60px; border-bottom:none; padding-top:15px; font-size: 15.1px;">
                              <b>  Recharge Detail </b>

                            </div>

                            <div class="asset-inner">

                                <table id="table" data-toggle="table" data-pagination="true"  data-show-columns="true" data-show-pagination-switch="true" data-show-refresh="true" data-key-events="true" data-show-toggle="true"  data-cookie="true"
                                        data-cookie-id-table="saveId" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">
                                    <thead>
									<tr>
                                        <th>Sr. No.</th>

                                        <th>Recharge Date</th>
										<th>Recharge Amount</th>
                                        <th>Payment Id</th>
									    <th>Recharged By</th>
                                        
                                    </tr>
									</thead>
									 <tbody id="rech_tbody">
                                        <?php $i = 1; foreach($detail_recharge as $row){ ?>
                                            <tr>
                                                <td><?php echo $i++; ?></td>
                                                <td><?php echo date('d-M-Y', strtotime($row->recharge_date)); ?></td>
                                                 <td><span class="rs_span"><i class="fa fa-rupee"></i> </span><?php echo number_format($row->recharge_amount); ?></td>
                                                <td><?php echo $row->payment_id; ?></td>
                                                 <td><?php echo $row->name; ?></td>
                                               
                                            </tr>
                                        <?php } ?>
									</tbody>
								</table>
                            </div>

                    </div>
                </div>
            </div>
	    </div>

        <div id="1" class="container-fluid my_tran_report" style="margin-top:15px; display: <?php if($switch == "transaction"){ echo "block"; }else{ echo "none"; } ?>" id="tran_table">
            <div class="product-status-wrap mycard" style="padding-top:10px; border-top:2px solid #0099cc;">
			    <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div id="myheadtitle" style="margin:0px; height:60px; border-bottom:none; padding-top:15px; font-size: 15.1px;">
                               <b> Transaction Detail </b>

                            </div>

                            <div class="asset-inner">

                                <table id="table" data-toggle="table" data-pagination="true"  data-show-columns="true" data-show-pagination-switch="true" data-show-refresh="true" data-key-events="true" data-show-toggle="true"  data-cookie="true"
                                        data-cookie-id-table="saveId" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">
                                    <thead >
									<tr>
                                        <th>Sr. No.</th>

                                        <th>Sales Date</th>
                                        <th>Sales Times</th>
                                        <!--<th>Shift</th>-->
										<th>Amount Paid</th>
                                        <th>Ledger Bal.</th>
										 <th>Product</th>
                                        <th>Transacted By</th>
                                        <!--<th>Action</th>-->
                                    </tr>
									</thead>
									 <tbody id="tran_tbody">
                                            <?php $i = 1; foreach($detail_transaction as $row){ ?>
                                            <tr>
                                                <td><?php echo $i++; ?></td>
                                                <td><?php echo date('d-M-Y', strtotime($row->transaction_date)); ?></td>
                                                <td><?php echo date('h:i:sa', strtotime($row->transaction_date)); ?></td>
                                                 <!--<td><?php echo $row->shift_name; ?></td>-->
                                                 <td><span class="rs_span"><i class="fa fa-rupee"></i> </span> <?php echo number_format($row->transaction_amount,1); ?></td>
                                                 <td><?php echo number_format($row->ledger,1); ?></td>
                                                <td><?php echo $row->product_name; ?></td>
                                                 <td><?php echo $row->name; ?></td>
                                                 <!--<td><a href="<?php echo base_url(); ?>/customer/delete_transaction/<?php echo $row->transaction_id; ?>/<?php echo $row->customer_id; ?>"> <button data-toggle="tooltip" title="Edit" class="pd-setting-ed myedit" style="background-color:#e91e63;"><i class="fa fa-trash-o" aria-hidden="true" ></i></button></a></td>-->
                                            </tr>
                                        <?php } ?>
									</tbody>
								</table>
                            </div>

                    </div>
                </div>
            </div>
	    </div>
        <br>
        <br>

                   <div id="success_alert" class="modal modal-edu-general default-popup-PrimaryModal fade" role="dialog" data-backdrop="static" data-keyboard="false" style="width:460px; margin:auto;">
                            <div class="modal-dialog" style="width:90%;">
                                <div class="modal-content">
                                    <!--<div class="modal-close-area modal-close-df">
                                        <a class="close" data-dismiss="modal" href="#"><i class="fa fa-close"></i></a>
                                    </div>-->
                                    <div class="modal-body" style="padding: 30px 30px;">
                                        <i class="educate-icon educate-checked modal-check-pro"></i>
                                        <h2>Done!</h2>
                                        <p class="success_model_p"></p>
                                    </div>
                                    <div class="modal-footer">

                                       <button class="btn btn-primary" type="button" id="success_ok" style="width:80px; background-color:#2c6be0;">OK</button>

                                    </div>
                                </div>
                            </div>
                       </div>
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
                         <div id="delete_recharge_failed" class="modal modal-edu-general FullColor-popup-DangerModal fade" role="dialog" data-backdrop="static" data-keyboard="false" style="width:460px; margin:auto;">
                            <div class="modal-dialog" style="width:90%;">
                                <div class="modal-content">

                                    <div class="modal-body" style="padding: 30px 30px;">
                                        <span class="educate-icon educate-danger modal-check-pro information-icon-pro"></span>
                                        <h2>Error!</h2>
                                        <p>The recharge can not be deleted because your account balance is not sufficient.</p>
                                    </div>
                                    <div class="modal-footer danger-md">

                                        <button class="btn btn-primary" type="button" data-dismiss="modal"  style="width:80px; background-color:#2c6be0;">OK</button>

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
                                    <div class="modal-head" style="background-color: #44bffd; padding: 5px 30px; height:35px; color:#ffffff; font-weight:700;">

                                        <p> Do you want to delete this account?</p>
                                    </div>
                                    <div class="modal-body" style="padding: 30px 30px;">

                                        <input type="text" class="form-control" name="" value="Rs. <?php if(isset($detail[0]->balance_amount)){ echo +$detail[0]->balance_amount; } ?>/-" readonly>
                                        <p> Please refund this amount to customer and continue for the account termination.</p>
                                    </div>
                                    <div class="modal-footer danger-md" style="padding-top:0px;">
                                        <button class="btn btn-primary" type="button" data-dismiss="modal" style="width:80px; background-color:#46c7fe; border: 1px solid #46c7fe; ">Cancel</button>
                                        <button data-delete_id="" id="del_model_bt" class="btn btn-primary" type="button"  style="width:90px; background-color:#f45846; border: 1px solid #f45846;">Terminate</button>
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


         $(document).on('click','button[id=tran_bt]',function(){
             var link_id = $(this).data("tran_linkid");
				$.ajax({
     				 type: 'POST',
     				 url: '<?php echo base_url(); ?>customer/customer_tran_report/'+link_id,

     				 success:function(noti){
     					$('#tran_tbody').html(noti);
                        $('#tran_table').show();
                        $('#rech_table').hide();
                        $("html, body").animate({ scrollTop: $(document).height()-$(window).height() });
     				 }
     			 });
         });

         $(document).on('click','button[id=rech_bt]',function(){
             var link_id = $(this).data("rech_linkid");


				$.ajax({
     				 type: 'POST',
     				 url: '<?php echo base_url(); ?>customer/customer_rech_report/'+link_id,

     				 success:function(noti){
     					$('#rech_tbody').html(noti);
                        $('#rech_table').show();
                        $('#tran_table').hide();
                         $("html, body").animate({ scrollTop: $(document).height()-$(window).height() });
     				 }
     			 });
         });

        function scroll(){
              var url = window.location.href;
		      var trim_url = url.substring(url.lastIndexOf("/")+1 );
              if(trim_url === 'transaction' || trim_url === 'recharge'){
                    $('html,body').animate({ scrollTop: 300 }, 'slow');
              }

         }

         scroll();


          function show_alert() {
             var url = window.location.href;
		    var check = url.substring(url.lastIndexOf("/")+1);

            if(check === "001"){
                 $('.s_add').show();
                /* Lobibox.notify('success', {
                    msg: 'Customer Profile Is Successfully Added.'
                });*/

            }else if(check === "002"){
                $('.s_update').show();
            }

        }

        show_alert();

       function myhide_msg(){
            $('.s_add').hide();
           $('.s_update').hide();
        }
        setTimeout(myhide_msg, 2000);


         $(document).on('click','#show_cus_pass',function(){
            var check = $('#cus_pass').attr('type');

             if(check === 'password'){

                 $('#cus_pass').attr('type','text');

             }else if(check === 'text'){

                 $('#cus_pass').attr('type','password');
             }

         });

	 });
 // the balance amount Rs. 200/- has been returned successfully

 // Please refund this amount to customer and continue for the account termination.
   </script>
</body>
</html>
