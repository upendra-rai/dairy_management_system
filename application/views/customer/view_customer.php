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
    
  
    
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/pepper-grinder/jquery-ui.css">
     <link rel="stylesheet" href="<?php echo base_url(); ?>/multidate_picker/jquery-ui.multidatespicker.css">

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
    
    .form-group .form-control{
        
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
                            <div id="myheadtitle" style="margin-bottom:0px; ">
                                <input type="hidden" id="msg_input" value="<?php if(isset($message)){ echo $message; }else{ echo ""; } ?>">
                                Customer Profile <span><i class="ion-android-arrow-dropright" style="color: #0099cc;"></i></span> Update
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
                                         <p><label>Shift:&nbsp;</label> <?php echo $row->shift_name; ?></p>
                                         
                                        <p><label>Delivery Schedule:&nbsp;</label> <?php echo $row->d_schedule; ?></p>
                                         
                                        
                                         
                                         <p style="display:none;"><label>Delivery Type:&nbsp;</label> <?php echo $row->d_type; ?></p>
                                         <p><label>Assigned Agent:&nbsp;</label> <?php echo $row->name; ?></p>
                                         <p><label>Password:&nbsp;</label><span><button type="button" class="btn" id="show_cus_pass" style="background-color:transparent; border:none;"><i class="ion-eye"></i></button></span> <input type="password" id="cus_pass" value="<?php echo $row->customer_password; ?>" autocomplete="new-password" style="border:none; background-color:transparent;"> </p>
                                     </div>

                                 </div>

                                <div class="col-md-6">
                                         <div class="detail_box second" style="border-right: 1px solid transparent;">
                                             <input type="hidden" id="current_balance_amount" value="<?php echo $row->balance_amount; ?>" />
                                         <p class="box_title ">Account Details</p>
                                              <p style="font-weight:600; color:#0798dc;"><label>Card No:&nbsp;</label> <?php echo $row->atm_card_no; ?></p>
                                              <p style="font-weight:600; color:#0798dc;"><label>Balance: &nbsp; <i class="fa fa-rupee" style="color:#0798dc;"></i></label> <?php echo number_format($row->balance_amount,1); ?></p>
                                              <p><label>Ragistration Date:&nbsp;</label> <?php echo date('d-M-y', strtotime($row->ragistration_date)); ?></p>
                                               <p><label>Account Type:&nbsp;</label> <?php echo $row->ac_type; ?> </p>
                                             <p><label>Account Restriction:&nbsp;</label> <?php echo $row->balance_restricted; ?> </p>
                                              <p><label>Status:&nbsp;</label> <?php echo $row->card_status; ?> </p>
                                              <br>
                                         <p class="box_title ">Action Panel</p>
                                               <div class="sparkline15-graph" style="padding-left:15px;">
                                                  <div class="row">
                                                        <div class="switch_style"style="">
                                                            <span class="span1"><font color="#33CC33"> Unblock </font></span>
                                                            <label class="switch">
                                                                <input type="checkbox" id="update_status" data-status_id="<?php echo $row->customer_id; ?>" <?php if($row->card_status == "blocked"){ echo "checked";}  ?>/>
                                                                <span class="slider round"></span>
                                                            </label>
                                                            <span class="span2"><font color="#FF0066"> Block </font></span>
                                                       </div>
                                                        <p><label>Recharge Account:</label></p>
                                                        <div class="input-group custom-go-button">
				                                            <span class="input-group-addon" ><i class="fa fa-rupee" style="color:#0798dc;"></i></span>
                                                            <input type="text" class="form-control" id="recharge_input" value="" placeholder="0000"   style="height:43px;" onkeydown="validateNumber(event);">
                                                            <span class="input-group-btn"><button type="button" id="recharge_bt" data-minimum_recharge="<?php if(isset($minimum_recharge[0])){ echo $minimum_recharge[0]->amount; }else{ echo '500'; } ?>" data-recharge_id="<?php echo $row->customer_id; ?>" data-status="<?php echo $row->card_status; ?>" data-mobile="<?php echo $row->contact_1; ?>" class="btn btn-primary" style="height:43px;">RECHARGE</button></span>


                                                        </div>
													  <br>
                                                        <div id="recharge_msg" style="color:red; display:block; margin-top:-10px; margin-bottom:20px;"></div>
                                                         <a href="<?php echo base_url(); ?>customer/view_customer/<?php echo $row->customer_id; ?>/recharge"> <button data-toggle="tooltip" title="Recharge Detail" data-rech_linkid="<?php echo $row->customer_id; ?>"  class="btn btn-primary action_panel_bt" style="background-color:#44bffd;"><i class="ion-cash" ></i> Recharge  Detail</button></a>
                                                        <a href="<?php echo base_url(); ?>customer/view_customer/<?php echo $row->customer_id; ?>/transaction"><button data-toggle="tooltip" title="Transaction Detail"  class="btn btn-primary action_panel_bt" style="background-color:#673ab7; "><i class="ion-ios-loop" ></i> Transaction  Detail</button></a>
                                                       <a href="<?php echo base_url(); ?>customer/view_customer/<?php echo $row->customer_id; ?>/vacation"><button data-toggle="tooltip" title="Transaction Detail"  class="btn btn-primary action_panel_bt" style="background-color:#673ab7; "><i class="ion-ios-loop" ></i> Vacation</button></a>
                                                      
                                                      
                                                       <a href="<?php echo base_url() ?>customer/edit_customer/<?php echo $row->customer_id; ?>"><button data-toggle="tooltip" title="Edit Profile" class="btn btn-primary action_panel_bt" style="background-color:#3f51b5; "><i class="fa fa-pencil-square" style="font-size:22px;"></i> Edit Profile</button></a>
                                                      <a href="<?php echo base_url() ?>customer/assign_card/<?php echo $row->customer_id; ?>"><button data-toggle="tooltip" title="Change ATM Card" class="btn btn-primary action_panel_bt" style="background-color:#3f51b5; "><i class="fa fa-credit-card" style="line-height:25px;"></i>Change ATM Card</button></a>
                                                        <button data-toggle="tooltip" id="terminate" title="Terminate Account" data-del_id="<?php echo $row->customer_id; ?>" data-del_name="<?php echo $row->first_name.' '.$row->last_name; ?>" data-del_return_amount="<?php echo $row->balance_amount; ?>" class="btn btn-primary action_panel_bt" style="background-color:#e91e63; "><i class="ion-ios-minus"></i> Terminate Account</button>
                                                     
                                                       <a href="<?php echo base_url() ?>customer/manage_requirement/<?php echo $row->customer_id; ?>"><button data-toggle="tooltip" title="Change ATM Card" class="btn btn-primary action_panel_bt" style="background-color:#3f51b5; "><i class="fa fa-credit-card" style="line-height:25px;"></i>Delivery Schedule</button></a>
                                                      
                                                      
                                                       <a href="<?php echo base_url() ?>manage_account/transaction/<?php echo $row->customer_id; ?>"><button data-toggle="tooltip" title="Change ATM Card" class="btn btn-primary action_panel_bt" style="background-color:#3f51b5; "><i class="fa fa-credit-card" style="line-height:25px;"></i>Manage Log</button></a>


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
                                                                        <th>Selling Price</th>
                                                                        <!-- <th>Estimated Product Qty</th> -->

                                                                         <!--<th>Assign</th>-->
                                                                     </tr>
					                                 			    </thead>
					                                 		    	  <tbody id="tran_table">
                                                                          <?php if(isset($select_product)){ $i = 1; foreach($select_product as $row){ ?>
                                                                              <tr class="product_row" data-product_id="<?php echo $row->product_id; ?>" >
                                                                                  <td><?php echo $i++; ?></td>
                                                                                  <td><?php echo $row->product_name; ?></td>
                                                                                  <td><?php echo $row->unit; ?></td>
                                                                                  <td><i class="fa fa-rupee"></i> <?php echo $row->product_price; ?></td>
                                                                                  <td><i class="fa fa-rupee"></i> <?php echo $row->product_price + $row->selling_margin; ?></td>
                                                                                  
                                                                                 <!-- <td><?php if($row->unit == 'Pkt'){ echo number_format($row->product_qty); }else{ echo + $row->product_qty; } ?> <?php echo $row->unit; ?></td> -->

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
                                        <th>Action</th>
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
                                                 <td><?php if($row->recharge_date == $row->last_recharge_date){ ?>  <button type="button" title="myrecharge_delete" class="pd-setting-ed myedit" data-recharge_id="<?php echo $row->recharge_id; ?>" data-re_customer_id="<?php echo $row->customer_id; ?>" data-recharge_amount="<?php echo $row->recharge_amount; ?>" style="background-color:#e91e63;"><i class="fa fa-trash-o" aria-hidden="true" ></i></button>  <?php } ?> </td>
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
        
        
        
         <div id="3" class="container-fluid my_tran_report" style="margin-top:15px; display: <?php if($switch == "vacation"){ echo "block"; }else{ echo "none"; } ?>" id="tran_table">
            <div class="product-status-wrap mycard" style="padding-top:10px; border-top:2px solid #0099cc;">
			    <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div id="myheadtitle" style="margin:0px; height:60px; border-bottom:none; padding-top:15px; font-size: 15.1px;">
                                <b> Vacation Detail </b>
                            </div>
                    </div>
                               
                       <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="row">
                                <form action="<?php echo base_url(); ?>customer/add_vacation" method="post">    
                                <div class="col-md-3">    
                                <div class="form-group">
                                    <input type="date" class="form-control" value="" name="start">
                                    
                                </div>
                                 </div>
                                <div class="col-md-3">      
                                <div class="form-group">
                                    <input type="date" class="form-control" value="" name="end">
                                    
                                    <input type="hidden" class="form-control" value="<?php if(isset($detail[0]->customer_id)){ echo $detail[0]->customer_id; } ?>" name="v_customer_id">
                                    
                                </div>
                                </div>
                                    
                                <div class="col-md-3">      
                                <div class="form-group">
                                    <input type="text" class="form-control" value="" name="multidate" placeholder="Multidates" id="multidate" autocomplete="off">
                                    
                                   
                                </div>
                                </div>    
                                    
                                 <div class="col-md-2">      
                                <div class="form-group">
                                    <input  type="submit" class="btn btn-primary" value="submit" name="submit">
                                    
                                </div>
                                </div>  
                                </form>
                              </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="asset-inner">

                                <table id="table" data-toggle="table" >
                                    <thead >
									<tr>
                                        <th>Sr. No.</th>

                                       
                                        <th>Start Date</th>
                                        <!--<th>Shift</th>-->
										<th>End Date</th>
                                        <th>Action</th>
                                        <!--<th>Action</th>-->
                                    </tr>
									</thead>
									 <tbody id="tran_tbody">
                                            <?php $i = 1; foreach($detail_vacation as $row){ ?>
                                            <tr>
                                                <td><?php echo $i++; ?></td>
                                                <td><?php echo date('d-M-Y', strtotime($row->start_date)); ?></td>
                                                <td><?php echo date('d-M-Y', strtotime($row->end_date)); ?></td>
                                                <td><button data-toggle="tooltip" name="del_vacation" data-del_vacation_id="<?php echo $row->vacation_id; ?>" title="Edit" class="pd-setting-ed myedit" style="background-color:#e91e63;"><i class="fa fa-trash-o" aria-hidden="true" ></i></button></td>
                                        <?php } ?>
									</tbody>
								</table>
                            </div>
                    

                    </div>
                </div>
            </div>
	    </div>

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
        
        
        
                        <div id="del_alert_vacation" class="modal modal-edu-general FullColor-popup-DangerModal fade" role="dialog" data-backdrop="static" data-keyboard="false" style="width:460px; margin:auto;">
                            <div class="modal-dialog" style="width:90%;">
                                <div class="modal-content">
                                    <div class="modal-close-area modal-close-df">
                                        <a class="close" data-dismiss="modal" href="#"><i class="fa fa-close"></i></a>
                                    </div>
                                    <div class="modal-body" style="padding: 30px 30px;">
                                        <span class="educate-icon educate-danger modal-check-pro information-icon-pro"></span>
                                        <h2>Are You Sure!</h2>
                                        <input type="hidden" value="" id="del_vacation_confirm_input">
                                        
                                        <p class="fail_model_p">Do you want to delete this vacation?</p>
                                    </div>
                                    <div class="modal-footer danger-md">
                                        
                                        
                                        <button class="btn btn-primary" type="button" data-dismiss="modal" style="width:80px; background-color:#2c6be0;">No</button>
                                        <button  id="del_vacation_yes" class="btn btn-primary" type="button"  style="width:80px; background-color:#39ae60;">Yes</button>

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
        
    
        
         <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>    
         <script src="<?php echo base_url(); ?>/multidate_picker/jquery-ui.multidatespicker.js"></script>    
        
        
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



        $(document).on('click','button[id=terminate]',function(){
			var link_id = $(this).data("del_id");
            var customer_name = $(this).data("del_name");
            var return_amount = $(this).data("del_return_amount");

            $('button[id=del_model_bt]').data("delete_id",link_id);
            $('button[id=del_model_bt]').data("del_name",customer_name);
            $('button[id=del_model_bt]').data("del_return_amount",return_amount);
            $('p[class=fail_model_p]').text('You want to delete this account.');
            $('#del_alert').modal("toggle");

        });

         $(document).on('click','button[id=del_model_bt]',function(){
              $('#del_alert').modal("toggle");
            var link_id = $(this).data("delete_id");
            var customer_name = $(this).data("del_name");
            var return_amount = $(this).data("del_return_amount");

			$.ajax({
				 type: 'POST',
				 url: '<?php echo base_url(); ?>customer/delete_customer',

				 data:{link_id:link_id},

				 success:function(del){
					 //alert(del);
					 if(del === "success"){

                        $('#terminate_p').text("The account of Mr "+customer_name+" has been terminated successfully. The balance amount Rs. "+return_amount+"/- has been returned successfully.");
						$('#action_div').hide();
                         $('.my_rech_report').hide();
                         $('.my_tran_report').hide();
                         $('#terminate_msg').show();
						//window.location.href = window.location.href;

					}else{


						alert("something Wrong");
					}

				 }



			});

		});

        $(document).on('click','#recharge_bt',function(){

            $('#my_loader').show();
			var link_id = $(this).data("recharge_id");
            var card_status = $(this).data("status");

            var minimum_limit = $(this).data("minimum_recharge");
			var recharge_value = $('input[id=recharge_input]').val();

            var mobile_no = $(this).data("mobile");

            if(card_status === "blocked"){
                $('#my_loader').hide();
                $('#recharge_msg').text('Recharge is not allowed on blocked customer.');

            }else{

            if(recharge_value < minimum_limit){
                $('#my_loader').hide();
                $('#recharge_msg').text('Minimum '+ minimum_limit +' Rs recharge allowed');
            }else{


            $.ajax({
				 type: 'POST',
				 url: '<?php echo base_url(); ?>customer/recharge_account',
				 data:{link_id:link_id,recharge_value:recharge_value,mobile_no:mobile_no},
				 success:function(data){
                     $('#my_loader').hide();
                    // alert(data);
				   if(data == "success"){
                        $('p[class=success_model_p]').text("Recharge of "+recharge_value+ "Rs. is successfully done.");
						$('#success_alert').modal("toggle");
					}else{
						$('#failed_alert').modal("toggle");
					}
				 },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                     $('#my_loader').hide();
                     if (XMLHttpRequest.readyState == 4) {
                         $('#failed_alert').modal("toggle");
                         // HTTP error (can be checked by XMLHttpRequest.status and XMLHttpRequest.statusText)
                     }
                     else if (XMLHttpRequest.readyState == 0) {
                         $('#failed_alert').modal("toggle");
                         // Network error (i.e. connection refused, access denied due to CORS, etc.)
                     }
                     else {
                         $('#failed_alert').modal("toggle");
                         // something weird is happening
                     }
                   }
			});

          }
            }
		});

        $(document).on('click','input[id=update_status]',function(){
             $('#block_alert').modal("toggle");
        });

        $(document).on('click','button[id=block_cancel]',function(){
             var url = window.location.href;
            var check_url = url.substring(url.lastIndexOf("/")+1);
            if(check_url === "transaction" || check_url === "recharge" || check_url === "001" || check_url === "002"){
                var trim_url = url.substring(0,url.lastIndexOf("/"));
                window.location.href =  trim_url;

            }else{

                window.location.href = window.location.href;
            }

        });

        $(document).on('click','button[id=error_ok]',function(){
             window.location.href =  window.location.href;
        });

        $(document).on('click','button[id=block_model_bt]',function(){
            $('#block_alert').modal("toggle");
            var link_id = $('input[id=update_status]').data("status_id");

			if($('input[id=update_status]').is(':checked')){
                $.ajax({
				 type: 'POST',
				 url: '<?php echo base_url(); ?>customer/block_accout',
				 data:{link_id:link_id},
				 success:function(data){

				   if(data == "success"){
                        $('p[class=success_model_p]').text("Atm card is successfully blocked ");
						$('#success_alert').modal("toggle");
					}else{

						$('#failed_alert').modal("toggle");
					}
				 }
			    });

            }else{
                $.ajax({
				 type: 'POST',
				 url: '<?php echo base_url(); ?>customer/unblock_accout',
				 data:{link_id:link_id},
				 success:function(data){
				   if(data == "success"){
                        $('p[class=success_model_p]').text("Atm card is successfully unblocked ");
						$('#success_alert').modal("toggle");
					}else{
						$('#failed_alert').modal("toggle");
					}
				 }
			    });
            }

		});




		$(document).on('click','#success_ok',function(){
			var url = window.location.href;
            var check_url = url.substring(url.lastIndexOf("/")+1);
            if(check_url === "transaction" || check_url === "recharge" || check_url === "001" || check_url === "002"){
                var trim_url = url.substring(0,url.lastIndexOf("/"));
                window.location.href =  trim_url;

            }else{

                window.location.href = window.location.href;
            }

		});
		$(document).on('click','#fail_ok',function(){

			 window.location.href = window.location.href;

		});


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

        $(document).on('click','button[title=myrecharge_delete]',function(){
              var current_balance = $('input[id=current_balance_amount]').val();
              var recharge_amount = $(this).data("recharge_amount");
              var recharge_id = $(this).data("recharge_id");
              var customer_id = $(this).data("re_customer_id");
              
                  var href =  '<?php echo base_url(); ?>customer/delete_recharge/'+recharge_id+'/'+customer_id;
                  $('p[class=fail_model_p]').text('You want to delete this recharge.');
                  $('#del_alert_action').modal("toggle");
                  $('button[id=del_recharge_bt]').data("del_href",href);
              

        });
         $(document).on('click','button[id=del_recharge_bt]',function(){
               var href = $(this).data("del_href");
               window.location.href = href;
        });

        function scroll(){
              var url = window.location.href;
		      var trim_url = url.substring(url.lastIndexOf("/")+1 );
              if(trim_url === 'transaction' || trim_url === 'recharge' || trim_url === 'vacation'){
                    $('html,body').animate({ scrollTop: 700 }, 'slow');
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
         
         
         $('#multidate').multiDatesPicker();
         
         
         $('button[name=del_vacation]').click(function(){
             
           var del_id = $(this).data("del_vacation_id");
             
             $('input[id=del_vacation_confirm_input]').val(del_id);
             $('#del_alert_vacation').modal("toggle");
            
         });
         
         $('button[id=del_vacation_yes]').click(function(){
             
             var del_id =  $('input[id=del_vacation_confirm_input]').val();
             $.ajax({
     				 type: 'POST',
     				 url: '<?php echo base_url(); ?>customer/delete_vacation',
                     data:{del_id:del_id},
     				 success:function(html){
     					
                         
                         if(html === 'success'){
                             
                             window.location.href = window.location.href;
                         }else{
                             
                              window.location.href = window.location.href;
                         }
     				 }
     			 });
             
             
         });

	 });
 // the balance amount Rs. 200/- has been returned successfully

 // Please refund this amount to customer and continue for the account termination.
   </script>
</body>
</html>
