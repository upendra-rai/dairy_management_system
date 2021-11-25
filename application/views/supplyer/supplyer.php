<!doctype html>
<html class="no-js" lang="en">

<head>
   <?php $this->load->view('common/header_link'); ?>
   <!-- modals CSS
		============================================ -->
    <link rel="stylesheet" href="<?php echo base_url('catalogs'); ?>/css/modals.css">
     <link rel="stylesheet" href="<?php echo base_url('catalogs'); ?>/css/calendar/fullcalendar.min.css">
    <link rel="stylesheet" href="<?php echo base_url('catalogs'); ?>/css/calendar/fullcalendar.print.min.css">

    <link rel="stylesheet" href="<?php echo base_url('catalogs'); ?>/css/notifications/Lobibox.min.css">
    <link rel="stylesheet" href="<?php echo base_url('catalogs'); ?>/css/notifications/notifications.css">

    <style type="text/css">
       /* .team_tbody tr:nth-child(1){
            display: none;
        }
        */
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
            margin-bottom: 10px;
        }
        .message.card{
             color: #ffffff;
             background-color: #ff9600;
             border:1px solid #ff9600;
        }
    </style>


</head>

<body>
    <?php $this->load->view('common/sidemenu'); ?>
    <div class="all-content-wrapper">

        <?php $this->load->view('common/titlebar'); ?>
	    <div class="container-fluid" style="margin-top:15px;">
            <div class="product-status-wrap mycard">
			    <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <input type="hidden" id="msg_input" value="<?php if(isset($message)){ echo $message; }else{ echo ""; } ?>">
                                                   <div class="message error" style="display:<?php if(isset($message) && $message === "failed"){ echo "block"; } ?>">
                                                          Process Is Failed!
                                                          <button type="button" title="close" style="background-color:transparent; border:none; float:right;">X</button>
                                                          <br>
                                                          <br>
                                                      </div>
                                                     <div class="message success s_add" style="display:<?php if(isset($message) && $message === "success"){ echo "block"; } ?>">
                                                          Supplyer is successfully added.
                                                         <button type="button" title="close" style="background-color:transparent; border:none; float:right;">X</button>
                                                         <br>
                                                          <br>
                                                      </div>
                                                     <div class="message success s_update" style="display:<?php if(isset($message) && $message === "updatesuccess"){ echo "block"; } ?>">
                                                         Supplyer is successfully updated.
                                                          <button type="button" title="close" style="background-color:transparent; border:none; float:right;">X</button>
                                                        <br>
                                                      </div>

                        <div id="myheadtitle" style=" height:50px;margin:0px; border-bottom:none;">
                                Supplyer Management
								<ul class="" style="float:right; ">
								    <li>
                                        <a href="<?php echo base_url(); ?>/supplyer/add_supplyer"><button data-toggle="modal" data-target="#PrimaryModalhdbgcl" title="Add Team Member" class="pd-setting-ed" style="background-color:#f3f3f3; border:1px solid #e5e5e5; color:#46c7fe; box-shadow:none;"><i class="ion-android-person-add" aria-hidden="true" style="color:#46c7fe; font-size:14px;"></i> &nbsp Add Supplyer</button></a>

                                    </li>

                                </ul>
                        </div>
						<div class="asset-inner">

                                <table id="table" data-toggle="table" data-pagination="true"
                                       >
                                     <thead>
									<tr>
                                        <th>Sr.No.</th>
                                        <th>Date</th>
                                        <th>Supplyer Name</th>
                                        <th>Mobile No.</th>
                                        <th>Email Id</th>
                                        <th>Address</th>
                                        <th>GST No.</th>
                                        <th>Edit</th>

                                    </tr>
									 </thead>
									 <tbody class="team_tbody">
                                         <?php $i=1; foreach($team as $row){?>
                                             <tr>
                                                 <td><?php echo $i++; ?></td>

                                                 <td><?php echo date('d-m-Y',strtotime($row->time_stamp)); ?></td>
                                                 <td><?php echo $row->supplyer_name; ?></td>
                                                 <td><?php echo $row->supplyer_mobile_no; ?></td>
                                                 <td><?php echo $row->supplyer_email_id; ?></td>
                                                 <td><?php echo $row->supplyer_address; ?></td>
                                                 <td><?php echo $row->GST_no; ?></td>
										                             <td>
                                                 <a href="<?php echo base_url(); ?>/supplyer/edit_supplyer/<?php echo $row->supplyer_id; ?>"> <button data-toggle="tooltip" title="Edit" class="pd-setting-ed myedit" style="background-color:#2196f3;"><i class="fa fa-pencil" aria-hidden="true" ></i></button></a>
                                                 </td>

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

                                    <div class="modal-body" style="padding: 30px 30px;">
                                        <span class="educate-icon educate-danger modal-check-pro information-icon-pro"></span>
                                        <h2>Error!</h2>
                                        <p class="fail_model_p">Sorry Opration Is failed ! Try Again</p>
                                    </div>
                                    <div class="modal-footer danger-md">

                                        <button class="btn btn-primary" type="button" id="error_ok" style="width:80px; background-color:#2c6be0;">OK</button>

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
    <script src="<?php echo base_url('catalogs'); ?>/js/datapicker/bootstrap-datepicker.js"></script>
    <script src="<?php echo base_url('catalogs'); ?>/js/datapicker/datepicker-active.js"></script>

    <!-- notification JS
		============================================ -->
    <script src="<?php echo base_url('catalogs'); ?>/js/notifications/Lobibox.js"></script>
    <script src="<?php echo base_url('catalogs'); ?>/js/notifications/notification-active.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){

        $(document).on('click','button[id=team_delete]',function(){
			var del_id = $(this).data("del_id");
            $('button[id=del_model_bt]').data("delete_id",del_id);
            $('#del_alert').modal("toggle");

        });

         $(document).on('click','button[id=del_model_bt]',function(){
              $('#del_alert').modal("toggle");
            var del_id = $(this).data("delete_id");

			$.ajax({
				 type: 'POST',
				 url: '<?php echo base_url(); ?>team/delete_member',

				 data:{del_id:del_id},

				 success:function(del){

					 if(del === "success"){
						$('p[class=success_model_p]').text("Team member successfully deleted.");
						$('#success_alert').modal("toggle");
						//window.location.href = window.location.href;

					}else{


						alert("something Wrong");
					}

				 }
			});

		});
        /*function show_alert() {
           var check  = $('input[id=msg_input]').val();
            if(check === "success"){

                 Lobibox.notify('success', {
                    msg: 'Team Member Is Successfully Added.'
                });

            }else if(check === "failed"){
                 Lobibox.notify('error', {
                    msg: 'Process Is Failed'
                });
            }else if(check === "updatesuccess"){
                   Lobibox.notify('success', {
                    msg: 'Team Member Is Successfully Added.'
                });
            }


        }  show_alert();     */
         function show_alert() {
             var url = window.location.href;
		    var check = url.substring(url.lastIndexOf("?")+1);

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
            $('.success').hide();

        }
        setTimeout(myhide_msg, 2000);

          $(document).on('click','#success_ok',function(){

			window.location.href = window.location.href;

		});
		$(document).on('click','#fail_ok',function(){

			 window.location.href = window.location.href;

		});



        });
    </script>
</body>
</html>
