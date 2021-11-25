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
        
        .asset-inner{
        width:65%;
        }

         @media (max-width:720px) and (min-width:280px){
             .asset-inner{
             width:100%;
            }
         }
        
        .green_status{
           font-weight: 600;
            padding: 0;
            margin: 0px;
            color: #37e718;
        }
        
        .red_status{
             font-weight: 600;
            padding: 0;
            margin: 0px;
            color: #e91e63;
        }
        
        .blue_status{
             font-weight: 600;
            padding: 0;
            margin: 0px;
            color: #46c7fe;
        }
        
        .yellow_status{
            font-weight: 600;
            padding: 0;
            margin: 0px;
            color: #f7dc20;
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
                                    <form action=""  method="post" id="myformsearch">
                                       
                                        <input type="hidden" id="return_status" value="<?php if(isset($return_status)){ echo $return_status; } ?>">
                                    
                                           <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12" >   
                                                <div class="form-group" id="data_5" style=" height:28px;">
                                                   <input type="text" name="card_search" id="name_search" value="<?php if(isset($return_card_search)){ echo $return_card_search; } ?>" class="form-control" placeholder="Search By Atm Card No." style="background-color:#ffffff; width:100%;" onkeydown="validateNumber(event);">
                                                </div>
                                           </div>
                                           <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12" >
                                             <div class="form-group" id="data_5" style=" height:28px;">
                                                  <select name="status_search" class="form-control" style="width:100%;">
                                                      <option value="">Card Status</option>
                                                      <option value="active">Active</option>
                                                      <option value="available">Available</option>
                                                      <option value="blocked">Blocked</option>
                                                      <option value="lost">Lost</option>
                                                      <option value="broken">Broken</option>
                                                 </select>
                                             </div>
                                            </div>
                                           
                                                  
                                           <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                                  <div class="form-group" id="data_5" style=" height:28px;">
                                                      <input type="submit" name="submit" value="Search" class="btn" style="background-color: #46c7fe; color:#ffffff; width: calc(100% - 48px);">
                                                      
                                                      <span><button type="button" id="tbl_refresh" class="btn" style="width:40px; border:1px solid #e8e8e8"><i class="ion-android-sync" style="color:#46c7fe; "></i></button></span>
                                                  </div>
                                           </div>
                                    </form>
                                </div>
                             </div>
				          </div>		
				 </div>
         
                <div class="row" id="print_area">
                    <div class="col-md-12">
						    <div id="myheadtitle" style=" height:52px; border-bottom:none; padding-top:15px; font-size: 15.1px; margin:0px;">
                             <b>   Atm Card List </b>
                              <button type="button" class="btn" id="print" style="position:absolute; right:220px; margin-top:-5px;">Print</button>      
                            </div>
                            <div class="asset-inner" >
							      
                                <table id="table" data-toggle="table" data-pagination="true" data-show-columns="true" data-show-pagination-switch="true"  data-key-events="true" data-show-toggle="true"  data-cookie="true"
                                        data-cookie-id-table="saveId" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">
                                     <thead>
									<tr>
                                        <th>Sr. No.</th>
                                        <th>Atm Card No.</th>
                                         <th>Card Status</th>
										 <th>Customer Name</th>
                                        <th>Assigned Date</th>
                                        
										
                                    </tr>
									 </thead>
									 <tbody id="myTable">
                                    <?php $i = 1; if(isset($atm_card_report)){ foreach($atm_card_report as $row){ ?>     
                                        
                                      <tr data-customer_id="<?php echo $row->customer_id; ?>">
                                          
                                       <td><?php echo $i++; ?></td>      
                                       <td><?php echo $row->atm_card_no; ?></td> 
                                       <td><?php 
                                             if($row->card_status == 'active' )
                                             { echo '<p class="green_status">Active</p>';
                                             }else if($row->card_status == 'lost')
                                             { echo '<p class="red_status">Lost</p>'; 
                                             }else if($row->card_status == 'broken')
                                             { echo '<p class="red_status">Broken</p>'; 
                                             }else if($row->card_status == 'blocked')
                                             { echo '<p class="yellow_status">Blocked</p>'; 
                                             }else if($row->card_status == '')
                                             { echo '<p class="blue_status">Available</p>';} ?></td>
                                       <td><?php echo $row->first_name.' '.$row->last_name; ?></td>
                                       <td><?php if($row->card_assign_time != '0000-00-00 00:00:00'){ echo date('d-M-y',strtotime($row->card_assign_time)); } ?></td>
                                       
                                         
                                         
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
        
   function onlyAlphabets(e, t) {
            try {
                if (window.event) {
                    var charCode = window.event.keyCode;
                }
                else if (e) {
                    var charCode = e.which;
                }
                else { return true; }
                if ((charCode > 64 && charCode < 91) || (charCode > 96 && charCode < 123) || charCode === 32)
                    return true;
                else
                    return false;
            }
            catch (err) {
                alert(err.Description);
            }
        }      
       
</script>
   <script type="text/javascript">
    $(document).ready(function(){
        $(document).on('click','#customer_table tr',function(){
           
             var linked_id = $(this).data("customer_id");
             window.location.href = '<?php echo base_url() ?>report/customer_full_recharge_report/'+linked_id;
		 }); 
        
        function select_take(){ 
             var select_colony = $('input[id=return_colony]').val();
             var select_delivery = $('input[id=return_delivery]').val();
             var select_status = $('input[id=return_status]').val();                 
             
            $('select[name=colony_search]').val(select_colony);
            $('select[name=delivery_search]').val(select_delivery);
            $('select[name=status_search]').val(select_status);
      
        } 
        select_take();
        
        $(document).on('click', '#tbl_refresh',function(){
            
           window.location.href =   window.location.href;
            
        });
        
        $(document).on('click', 'input[name=card_search]',function(){
            
           $('select[name=status_search]').val('');
            
        });
        
        $(document).on('click', 'select[name=status_search]',function(){
            
           $('input[name=card_search]').val('');
            
        });
        
          
    });
    
   
    </script>
</body>
</html>