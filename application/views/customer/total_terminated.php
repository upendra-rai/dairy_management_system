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
        .view_bt{
          height:28px; padding:0px 10px; background-color:#f0f0f0; border:1px solid #e2e2e2; border-radius:5px;
        }
        .view_bt:hover{
         background-color:#46c7fe; border:1px solid #46c7fe; color:#ffffff;
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
                <div class="product-status-wrap mycard" style=" border-top: 2px solid #0099cc; padding-top:10px;">
                  <div class="row" style="background-color:#f7f7f7; ">
                 <div class="search_engine" style="height:auto; min-height:60px; padding-top:15px;">
                             <div class="breadcome-heading" style="">
                                 <div class="input-group"  style=" width:100%;">
                                         <input type="hidden" id="return_colony" value="<?php if(isset($return_colony)){ echo $return_colony; } ?>">
                                         <input type="hidden" id="return_delivery" value="<?php if(isset($return_delivery)){ echo $return_delivery; } ?>">
                                         <input type="hidden" id="return_status" value="<?php if(isset($return_status)){ echo $return_status; } ?>">

                                         <form action=""  method="post" id="myformsearch">
                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12" >
                                                 <div class="form-group" id="data_5" style=" height:28px;">
                                                    <input type="text" name="name_search" id="name_search" value="<?php if(isset($return_name)){ echo $return_name; } ?>" class="form-control" placeholder="Search By Customer Name" style="background-color:#ffffff; width:100%;">
                                                 </div>
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12" >
                                              <div class="form-group" id="data_5" style=" height:28px;">
                                                   <select name="colony_search" class="form-control" style="width:100%;">
                                                       <option value="">Colony Name</option>
                                                       <?php foreach($select_colony as $row){ ?>
                                                       <option value="<?php echo $row->colony_id; ?>"><?php echo $row->colony_name ?></option>
                                                       <?php } ?>
                                                  </select>
                                              </div>
                                             </div>

                                            <div class="col-lg-2 col-md-2 col-sm-3 col-xs-12">
                                                   <div class="form-group" id="data_5" style=" height:28px;">
                                                      <input type="submit" name="submit" class="btn" value="Search" style="background-color: #46c7fe; color:#ffffff; width: calc(100% - 48px);"/>

                                                       <span><button type="button" id="tbl_refresh" class="btn" style="width:40px; border:1px solid #e8e8e8"><i class="ion-android-sync" style="color:#46c7fe; "></i></button></span>
                                                   </div>
                                            </div>
                                     </form>
                                 </div>
                              </div>
                   </div>
          </div>
						<div class="row">
						<div class="col-md-12">
						    <div id="myheadtitle" style="border-bottom:none; ">
                              <b>  Terminated Customer List </b>

                            </div>
                            <div class="asset-inner">

                                <table id="table" data-toggle="table" data-pagination="true"   data-show-pagination-switch="true" data-show-refresh="true" data-key-events="true" data-show-toggle="true"  data-cookie="true"
                                        data-cookie-id-table="saveId" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">
                                     <thead>
									<tr>
                                        <th>No</th>
                                        <th>Customer Name</th>
										 <th>Colony Name</th>
                                        <th>Delivery Type</th>
										<th>Amount Returned</th>
                                        <th>Available Balance</th>
                                        <th>Termination Date</th>
                                        <th>Status</th>
                                        <th>View</th>
                                    </tr>
									 </thead>
									 <tbody>

                                         <?php $i = 1; foreach($terminate as $row){ ?>
                                         <tr>
                                              <td><?php echo $i++; ?></td>
                                              <td><?php echo $row->first_name.' '.$row->last_name; ?></td>
                                              <td><?php echo $row->colony_name; ?></td>
                                              <td><?php echo $row->d_type; ?></td>
                                              <td><span class="rs_span" style="color:#ea1560;"><i class="fa fa-rupee"></i> </span> <?php echo  number_format($row->amount_returned,1); ?></td>
                                              <td><span class="rs_span" style="color:#ea1560;"><i class="fa fa-rupee"></i> </span> <?php echo  0; ?></td>
                                              <td><?php echo date('d-M-y', strtotime($row->terminate_date)); ?></td>
                                              <td><?php echo $row->customer_status; ?></td>
                                              <td> <a href="<?php echo base_url(); ?>customer/view_terminated_customer/<?php echo $row->customer_id;  ?>" style="color:#000; "><button type="button" class="btn view_bt" name="button" style=""><i class="fa fa-eye"></i></button></a> </td>
                                         </tr>
                                         <?php } ?>
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
                                        <p class="fail_model_p">Sorry opration is failed! Try Again!</p>
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
                                        <p class="fail_model_p">Do you want to delete this account?</p>
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


          $(document).on('click','.click_tr',function(){

            var href = $(this).data("card_no");
             window.location.href = '<?php echo base_url() ?>report/customer_full_report/'+href;
         });

	 });

   </script>
</body>
</html>
