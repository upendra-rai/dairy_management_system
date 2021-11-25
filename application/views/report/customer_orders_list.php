<?php
header('Cache-Control: max-age=900');
?>
<!doctype html>
<html class="no-js" lang="en" >

<head>
   
   <?php $this->load->view('common/header_link'); ?>
   <!-- touchspin CSS
		============================================ -->
	<link rel="stylesheet" href="<?php echo base_url('catalogs'); ?>/css/touchspin/jquery.bootstrap-touchspin.min.css">

      <link rel="stylesheet" href="<?php echo base_url('catalogs'); ?>/css/calendar/fullcalendar.min.css">
    <link rel="stylesheet" href="<?php echo base_url('catalogs'); ?>/css/calendar/fullcalendar.print.min.css">
    <link rel="stylesheet" href="<?php echo base_url('catalogs'); ?>/css/select2/select2.min.css">
    <link rel="stylesheet" href="<?php echo base_url('catalogs'); ?>/css/chosen/bootstrap-chosen.css">
<style type="text/css">

        .form-control{
            height:32px;

        }


    .click_tr:hover{
        cursor: pointer;
    }

    .asset-inner{
        width:100%;
    }

    @media (max-width:720px) and (min-width:280px){
        .asset-inner{
        width:100%;
       }
    }
</style>
</head>

<body>
    <?php $this->load->view('common/sidemenu'); ?>
    <div class="all-content-wrapper">

        <?php $this->load->view('common/titlebar'); ?>


		<div class="container-fluid" style="margin-top:15px;">
            <div class="product-status-wrap mycard" style="padding-top:0px; border-top:2px solid #0099cc;">
                <div class="row" style="background-color:#f7f7f7; ">
				        <div class="search_engine" style="height:auto; min-height:60px; padding-top:15px;">
                            <div class="breadcome-heading" style="">
                                <form action=""  method="post">
                                 <div class="form-group data-custon-pick data-custom-mg" id="data_5">


                                          <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12" >
                                            <div class="form-group" id="data_5" style=" height:28px;">
                                                <select name="agent_search"  class="form-control" style="width:100%;">
                                                    <option value="">All Agent</option>
                                                     <?php foreach($select_agent as $row){ ?>
                                                     <option style="display: <?php if($row->user_id == 1 || $row->user_id == 21){ echo 'none'; } ?>" value="<?php echo $row->user_id; ?>"><?php echo $row->name; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                           </div>

                                           <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12" >
                                             <div class="chosen-select-single mg-b-20">
                                                   <select data-placeholder="Choose a Country..." class="chosen-select" name="customer_id" tabindex="-1">
                                                   <option value="">Search Customer</option>
                                                   <?php if(isset($all_customer_list)){ foreach($all_customer_list as $row){ ?>
                                                       <option value="<?php echo $row->customer_id; ?>">
                                                          <?php echo $row->atm_card_no; ?> <?php echo $row->first_name.' '.$row->last_name ?>

                                                         </option>

                                                    <?php }} ?>
   													                       </select>
                                               </div>

                                          </div>
                                     
                                     
                                         
                                           <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12" >
                                             <div class="chosen-select-single mg-b-20">
                                                   <select data-placeholder="Choose a Country..." class="chosen-select" name="product_select" tabindex="-1">
                                                   <option value="">Search Product</option>
                                                   <?php if(isset($select_product)){ foreach($select_product as $row){ ?>
                                                       <option value="<?php echo $row->product_id; ?>">
                                                          <?php echo $row->product_name; ?>

                                                         </option>

                                                    <?php }} ?>
   													                       </select>
                                               </div>

                                          </div>


                                          <div class="col-md-2 col-sm-12 col-xs-12" >
                                                <div class="form-group" id="data_5" style=" height:28px;">
                                                     <input type="submit" name="submit" class="btn" value="Search" style="background-color: #46c7fe; color:#ffffff; width: calc(100% - 48px);"/>

                                                      <span><button type="button" id="tbl_refresh" class="btn" style="width:40px; border:1px solid #e8e8e8"><i class="ion-android-sync" style="color:#46c7fe; "></i></button></span>
                                                  </div>
                                           </div>



                                    </div>
                                </form>
                             </div>
				          </div>
				 </div>


                <?php if(isset($customer_requirement_list,$select_product)){ ?>
                <div class="row" id="print_area">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <input id="select_agent" type="hidden"  value="<?php if(isset($return_agent)){ echo $return_agent; } ?>">


                         <div id="myheadtitle" style="margin:0px; height:55px; border-bottom:none; padding-top:15px; font-size: 15.5px; ">
                             Daily Requirement Report / <span class="agent_p"><?php if(isset($return_agent)){ echo $return_agent; } ?> </span>
							 
							 <button type="button" class="btn" id="print" style="position:absolute; right:260px; margin-top:-5px;">Print</button>
                             
                             <a href="#!red">Red</a>
                        </div>
                           <div class="asset-inner">
                                <table id="table" data-toggle="table" data-pagination="true" data-show-columns="true" data-show-pagination-switch="true" data-show-refresh="true" data-key-events="true" data-show-toggle="true"  data-cookie="true"
                                        data-cookie-id-table="saveId" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar" class="table-striped">
                                    <thead>
                                     <tr>
                                        <th>Sr no.</th>
                                        <th>Customer Name</th>
                                        <th>Product Name</th>
                                          <th>Schedule</th>
                                           <th>1</th>
                                           <th>2</th>
                                           <th>3</th>
                                           <th>4</th>
                                           <th>5</th>
                                           <th>6</th>
                                           <th>7</th>
                                           <th>8</th>
                                           <th>9</th>
                                           <th>10</th>
                                           <th>11</th>
                                           <th>12</th>
                                           <th>13</th>
                                           <th>14</th>
                                           <th>15</th>
                                           <th>16</th>
                                           <th>17</th>
                                           <th>18</th>
                                           <th>19</th>
                                           <th>20</th>
                                           <th>21</th>
                                           <th>22</th>
                                           <th>23</th>
                                           <th>24</th>
                                           <th>25</th>
                                           <th>26</th>
                                           <th>27</th>
                                           <th>28</th>
                                           <th>29</th>
                                           <th>30</th>
                                           <th>31</th>
                                    </tr>
                                   </thead>
                                     <tbody id="tran_table">
                                     <?php $i = 1; foreach($customer_requirement_list as $row){ ?>
                                        <tr class="product_row" data-product_id="<?php echo $row->product_id; ?>"  data-customer_id="<?php echo $row->customer_id; ?>"  data-estimated_id="<?php echo $row->estimated_id; ?>">
                                                   <td><?php echo $i++; ?></td>
                                                    <td><?php echo $row->first_name.' '.$row->last_name; ?></td>
                                                     <td><?php echo $row->product_name; ?></td>
                                                   
                                                  <td><?php echo $row->d_schedule; ?></td>
                                                    <?php for($v = 0; $v < 31; $v++){ ?>
                                                    <?php if($row->d_schedule == 'daily'){ ?>
                                                        
                                                         <td>
                                                             <div style="display: <?php if($row->shift_id == 2){ echo 'none'; } ?>">
                                                            <span style="position:relative; padding:0px 2px; border:1px solid #6f6f6f; width:20px;">M</span> 
                                                                                      <input type="number" value="<?php if($row->morning_shift_qty > 0){ echo + $row->morning_shift_qty; }else{  } ?>" name="morning_day" style="width:50px; text-align:center; " min="0" >  
                                                             </div>
                                                                                     <div style="display: <?php if($row->shift_id == 1){ echo 'none'; } ?>">
                                                                                      <span style="position:relative; padding:0px 4.5px; border:1px solid #6f6f6f; width:20px;">E</span>
                                                                                      <input type="number" value="<?php if($row->evening_shift_qty > 0){ echo + $row->evening_shift_qty; } ?>" name="evening_day" style="width:50px; text-align:center;" min="0" >
                                                             </div>
                                                          </td>
                                                    <?php  }else if($row->d_schedule == 'week'){ $w_arr = array('sun','mon','tue','wed','thu','fri','sat'); $m = date('m'); $y = date('Y'); $d = $v+1;  $w_date = $y.'-'.$m.'-'.$d; $w_day = date('w',strtotime($w_date)); $week = $w_arr[$w_day];  $en = json_decode($row->$week);  ?>
                                                         <td>
                                                             <div style="display: <?php if($row->shift_id == 2){ echo 'none'; } ?>">
                                                             <span style="position:relative; padding:0px 2px; border:1px solid #6f6f6f; width:20px;">M</span> 
                                                                                      <input type="number" value="<?php if(isset($en[0]->morning) && $en[0]->morning > 0){ echo $en[0]->morning; } ?>" name="morning_week" style="width:50px; text-align:center;" step="<?php if($row->unit == 'Pkt'){ echo 1; }else{ echo 0.25; } ?>" min="0" data-day_no="<?php echo $week;  ?>" > 
                                                                                      
                                                             </div>
                                                              <div style="display: <?php if($row->shift_id == 1){ echo 'none'; } ?>">
                                                                                      <span style="position:relative; padding:0px 4.5px; border:1px solid #6f6f6f; width:20px;">E</span>
                                                                                      <input type="number" value="<?php if(isset($en[0]->evening) && $en[0]->evening > 0){ echo $en[0]->evening; } ?>" name="evening_week" style="width:50px;  text-align:center;" step="<?php if($row->unit == 'Pkt'){ echo 1; }else{ echo 0.25; } ?>" min="0" data-day_no="<?php echo $week;  ?>">
                                                             </div>

                                                          </td>
                                            
                                                    <?php  }else if($row->d_schedule == 'month'){ $m = $v + 1; $en_key = 'day_'.$m;  $en = json_decode($row->$en_key); ?> 
                                                    <td>
                                                         <div style="display: <?php if($row->shift_id == 2){ echo 'none'; } ?>">
                                                        <span style="position:relative; padding:0px 2px; border:1px solid #6f6f6f; width:20px;">M</span> 
                                                                                      <input type="number" value="<?php if(isset($en[0]->morning) && $en[0]->morning > 0){ echo $en[0]->morning; } ?>" name="morning_month" style="width:50px; text-align:center;" step="<?php if($row->unit == 'Pkt'){ echo 1; }else{ echo 0.25; } ?>" min="0" > 
                                                        </div>
                                                        <div style="display: <?php if($row->shift_id == 1){ echo 'none'; } ?>">
                                  
                                                                                      <span style="position:relative; padding:0px 4.5px; border:1px solid #6f6f6f; width:20px;">E</span>
                                                                                      <input type="number" value="<?php if(isset($en[0]->evening) && $en[0]->evening > 0){ echo $en[0]->evening; } ?>" name="evening_month" style="width:50px;  text-align:center;" step="<?php if($row->unit == 'Pkt'){ echo 1; }else{ echo 0.25; } ?>" min="0" >
                                                        </div>
                                                                           </td>      
                                                    <?php }} ?>

                                            </tr>
                                     <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                    </div>
                </div>
                <?php } ?>
            </div>
	    </div>
        
        
         <div id="my_modal" class="modal modal-edu-general FullColor-popup-DangerModal fade" role="dialog" data-backdrop="static" data-keyboard="false" style="width:90vw; margin:auto;">
                            <div class="modal-dialog" style="width:90%;">
                                <div class="modal-content">
                                    <div class="modal-close-area modal-close-df">
                                        <a class="close" data-dismiss="modal" href="#"><i class="fa fa-close"></i></a>
                                    </div>
                                    <div class="modal-head" style="background-color: #44bffd; padding: 5px 30px; height:35px; color:#ffffff; font-weight:700;">

                                        <p> Do you want to delete this account?</p>
                                    </div>
                                    <div class="modal-body" style="padding: 30px 30px;">
                                              
                                    </div>
                                    <div class="modal-footer danger-md" style="padding-top:0px;">
                                        <button class="btn btn-primary" type="button" data-dismiss="modal" style="width:80px; background-color:#46c7fe; border: 1px solid #46c7fe; ">Cancel</button>
                                        <button data-delete_id="" id="del_model_bt" class="btn btn-primary" type="button"  style="width:90px; background-color:#f45846; border: 1px solid #f45846;">Terminate</button>
								                   	</div>
                                </div>
                            </div>
                        </div>


	</div>

   <?php $this->load->view('common/footer_script'); ?>


	<!-- touchspin JS
		============================================ -->
    <script src="<?php echo base_url('catalogs'); ?>/js/touchspin/jquery.bootstrap-touchspin.min.js"></script>
    <script src="<?php echo base_url('catalogs'); ?>/js/touchspin/touchspin-active.js"></script>

    <script src="<?php echo base_url('catalogs'); ?>/js/datapicker/bootstrap-datepicker.js"></script>
    <script src="<?php echo base_url('catalogs'); ?>/js/datapicker/datepicker-active.js"></script>

    <!-- chosen JS
 		============================================ -->
     <script src="<?php echo base_url('catalogs'); ?>/js/chosen/chosen.jquery.js"></script>
     <script src="<?php echo base_url('catalogs'); ?>/js/chosen/chosen-active.js"></script>

    <script type="text/javascript">
       $(document).ready(function(){

         $(document).on('click','.click_tr',function(){
            var href = $(this).data("date");
            var agent = $('select[name=agent_search]').val();
            var product = $('select[name=product_search]').val();
            var shift = $('select[name=shift]').val();
             if(agent === ''){
                 agent = 'null';
             }
             if(product === ''){
                 product = 'null';
             }
             if(shift === ''){
                 shift = 'null';
             }
               window.location.href = '<?php echo base_url() ?>report/transaction_date_report/'+href+'/'+agent+'/'+shift+'/'+product;

         });

        $(document).on('click','#search_date_bt',function(){
            var start_date =  $('input[name=start]').val();
            var end_date =  $('input[name=end]').val();
            $.ajax({
     				 type: 'POST',
     				 url: '<?php echo base_url(); ?>report/tranreport_section_searchbar',
     				 data:{start_date:start_date,end_date:end_date},
     				 success:function(noti){
     					 $('#tran_table').html(noti);
     				 }
            });
        });

        function select_take(){
            var select_agent = $('input[id=select_agent]').val();
            var select_shift = $('input[id=select_shift]').val();
            var select_product = $('input[id=select_product]').val();
            $('select[name=agent_search]').val(select_agent);
            $('select[name=product_search]').val(select_product);
            $('select[name=shift]').val(select_shift);
        }
        select_take();

        $(document).on('click', '#tbl_refresh',function(){
           window.location.href =   window.location.href;
        });

        var agent_name = $('select[name=agent_search] option:selected').html();
        $('span[class=agent_p]').text(agent_name);
          $(document).on('keyup','input[name=edit_estimated_products]',function(){
               $(this).css('border','1px solid yellow');
               var product_id = $(this).data("product_id");
               var customer_id = $(this).data("customer_id");
               var product_qty = $(this).val();
              if(product_id && customer_id && product_qty){
                $.ajax({
                  type: 'POST',
                  url: '<?php echo base_url(); ?>report/edit_estimated_products',
                  data:{product_id:product_id,customer_id:customer_id,product_qty:product_qty},
                  success:function(noti){
                    //alert(noti);
                  }
                });
                $(this).css('border','1px solid green');
              }
          });

          $(document).on('click','input[name=edit_estimated_products]',function(){
                 $('input[name=edit_estimated_products]').css('border','1px solid #000');
                 //$(this).removeAttr('disabled');
                 $(this).css('border','1px solid green');
          });
            
      $(document).on('click','button[name=edit_req]',function(){
      $('#my_modal').modal('toggle');
      $.ajax({ 
            type: "POST",   
            url: 'http://localhost/dms_update3/admin/customer/manage_requirement/27',
       }).done(function(response){ 
       $('.modal-body').html(response);
              var val = 'Month';
                if(val === 'Week'){
                   $('#daily_row').hide();
                   $('#month_row').hide();
                   $('#week_row').show();
                }else if(val === 'Month'){
                   $('#daily_row').hide();     
                   $('#week_row').hide();
                   $('#month_row').show();   
                }else if(val === 'everyday'){
                    $('#week_row').hide();
                    $('#month_row').hide();
                    $('#daily_row').show();
                }else{
                    $('#week_row').hide();
                    $('#month_row').hide();
                    $('#daily_row').show();
                }
         });
      });
           
      $(document).on('click','input[name=delivery_schedule]',function(){
               var val = $(this).val();
               if(val === 'Week'){
                   $('#daily_row').hide();
                   $('#month_row').hide();
                   $('#week_row').show();
               }else if(val === 'Month'){
                    $('#daily_row').hide();     
                    $('#week_row').hide();
                    $('#month_row').show();   
                }else{
                    $('#week_row').hide();
                    $('#month_row').hide();
                    $('#daily_row').show();
                }
          });
          // week ***********
         
         function create_estimated_p_array(){
             var estimated_array = [];
             $('.product_row_week').each(function(){
                 var p_id = $(this).data('estimated_id');
                 var re_array = [];
                 $(this).find('.day_week').each(function(){
                     var day = $(this).data("day");
                     var morning_qty = $(this).find('input[name=morning_week]').val();
                     var evening_qty = $(this).find('input[name=evening_week]').val();
                     if(!morning_qty){
                         morning_qty = 0;
                     }
                     if(!evening_qty){
                         evening_qty = 0;
                     }
                     var bvar = {'morning': morning_qty, 'evening':evening_qty, 'day': day};
                     re_array.push(bvar);
                 });
                 estimated_array.push({estimated_id:p_id, qty: JSON.stringify(re_array) });
                 
             });
             $('input[name=req_array_week]').val(JSON.stringify(estimated_array));
             
         }

      //  create_estimated_p_array();

       
         $(document).on('keyup change','input[name=morning_week]',function(){
                 create_estimated_p_array();
         });
        
         $(document).on('keyup change','input[name=evening_week]',function(){
                 create_estimated_p_array();
         });
        // Month *******
        
         function create_estimated_p_array_month(){
             var estimated_array = [];
             $('.product_row_month').each(function(){
                 var p_id = $(this).data('estimated_id');
                 var re_array = [];
                 $(this).find('.day_month').each(function(){
                     var day = $(this).data("day");
                     var morning_qty = $(this).find('input[name=morning_month]').val();
                     var evening_qty = $(this).find('input[name=evening_month]').val();
                     if(!morning_qty){
                         morning_qty = 0;
                     }
                     if(!evening_qty){
                         evening_qty = 0;
                     }
                     var bvar = {'morning': morning_qty, 'evening':evening_qty, 'day': day};
                     re_array.push(bvar);
                 });
                 estimated_array.push({estimated_id:p_id, qty: JSON.stringify(re_array) });
             });
             $('input[name=req_array_month]').val(JSON.stringify(estimated_array));
         }
 
      //  create_estimated_p_array();

         $(document).on('keyup change','input[name=morning_month]',function(){
                 create_estimated_p_array_month();
         });
        
         $(document).on('keyup change','input[name=evening_month]',function(){
                 create_estimated_p_array_month();
         }); 
           
        // ****** every day
        function create_estimated_p_array_daily(){
             var estimated_array = [];
             $('.product_row_daily').each(function(){
                 var p_id = $(this).data('product_id');
                 var morning_qty = $(this).find('input[name=morning_day]').val();
                 var evening_qty = $(this).find('input[name=evening_day]').val();
                 estimated_array.push({product_id:p_id, morning: morning_qty, evening:evening_qty });
             });
             $('input[name=req_array_daily]').val(JSON.stringify(estimated_array));
         }
         create_estimated_p_array_daily();
        
        $(document).on('keyup change','input[name=morning_day]',function(){
                 create_estimated_p_array_daily();
         });
        
         $(document).on('keyup change','input[name=evening_day]',function(){
                 create_estimated_p_array_daily();
         });
        
        $(document).on('keydown','input[name=new_quantity]',function(event){
            var unit = $(this).data('unit');
            if(unit === 'Pkt'){
                   var e = event || window.event;
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
                   key == 46 || key == 45 || key == 173) {
                   }
                   else {
                         // input is INVALID
                        e.returnValue = false;
                        if (e.preventDefault) e.preventDefault();
                    }
            }else{
                   var e = event || window.event;
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
                   key == 46 || key == 45 || key == 173 || key == 190) {
                   }
                   else {

                       // input is INVALID
                       e.returnValue = false;
                       if (e.preventDefault) e.preventDefault();
                   }
            }
         });

        $(document).on('change','input[name=selling_price]',function(){
              create_estimated_p_array();
        }); 
        
        $(document).on('keyup','input[name=selling_price]',function(){
            create_estimated_p_array();
        });
        
        $(document).on('click','input[name=delivery_schedule]',function(){
               var val = $(this).val();
               if(val === 'Week'){
                   $('#daily_row').hide();
                   $('#month_row').hide();
                   $('#week_row').show();
               }else if(val === 'Month'){
                    $('#daily_row').hide();     
                    $('#week_row').hide();
                    $('#month_row').show();   
                }else{
                    $('#week_row').hide();
                    $('#month_row').hide();
                    $('#daily_row').show();
                }
          });
        
        
          function check_selected_schedule(){
              var val = $('input[name=delivery_schedule]:checked').val();
              if(val === 'Week'){
                    $('#daily_row').hide();
                   $('#month_row').hide();
                   $('#week_row').show();
                   
               }else if(val === 'Month'){
                   $('#daily_row').hide();     
                    $('#week_row').hide();
                    $('#month_row').show();   
                        
                }else if(val === 'everyday'){
                    $('#week_row').hide();
                      $('#month_row').hide();
                    $('#daily_row').show();
                }else{
                    $('#week_row').hide();
                      $('#month_row').hide();
                    $('#daily_row').show();
                }
          }check_selected_schedule();
           
           
           
           
           // *************************************************//
           // *************************************************//
           
           
           
           function server_request(){
               
               
               
           }
           
           $(document).on('keyup','input[name=morning_day]',function(){
               
                var this_tr = $(this).parent().parent().parent();
                var val = $(this).val();
                var product_id = $(this).parent().parent().parent().data('product_id');
                var customer_id = $(this).parent().parent().parent().data('customer_id');
                var shift = 1;
               
                  $.ajax({ 
                        type: "POST",   
                        url: '<?php echo base_url(); ?>/report/edit_customer_daily_requirement',
                        data: {val:val,product_id:product_id,customer_id:customer_id,shift:shift},
                   }).done(function(response){ 
                          
                           if(response === 'success'){
                               this_tr.find('input[name=morning_day]').val(val);
                               
                           }
                     });
             
           });
             
           $(document).on('keyup','input[name=evening_day]',function(){
                var this_tr = $(this).parent().parent().parent();
                var val = $(this).val();
                var product_id = $(this).parent().parent().parent().data('product_id');
                var customer_id = $(this).parent().parent().parent().data('customer_id');
               var shift = 2;
                  $.ajax({ 
                        type: "POST",   
                        url: '<?php echo base_url(); ?>/report/edit_customer_daily_requirement',
                        data: {val:val,product_id:product_id,customer_id:customer_id,shift:shift},
                   }).done(function(response){ 
                           
                           if(response === 'success'){
                               
                               this_tr.find('input[name=morning_day]').val(val);
                           }
                     });
             
           });
           
           
            $(document).on('keyup','input[name=morning_week]',function(){
                var this_tr = $(this).parent().parent().parent();
                var morning_val = $(this).val();
                var evening_val = $(this).parent().parent().find('input[name=evening_week]').val();
                var estimated_id = $(this).parent().parent().parent().data('estimated_id');
                
                var day_no = $(this).data('day_no');
                
               var shift = 2;
                  $.ajax({ 
                        type: "POST",   
                        url: '<?php echo base_url(); ?>/report/edit_customer_week_requirement',
                        data: {morning_val:morning_val,evening_val:evening_val,shift:shift,day_no:day_no,estimated_id:estimated_id},
                   }).done(function(response){ 
                       
                           if(response === 'success'){
                               
                               
                           }
                     });
              
           });
           
           
           $(document).on('keyup','input[name=evening_week]',function(){
                var this_tr = $(this).parent().parent().parent();
                var evening_val = $(this).val();
                var morning_val = $(this).parent().parent().find('input[name=morning_week]').val();
                var estimated_id = $(this).parent().parent().parent().data('estimated_id');
                var day_no = $(this).data('day_no');
                var shift = 2;
               
                  $.ajax({ 
                        type: "POST",   
                        url: '<?php echo base_url(); ?>/report/edit_customer_week_requirement',
                        data: {morning_val:morning_val,evening_val:evening_val,shift:shift,day_no:day_no,estimated_id:estimated_id},
                   }).done(function(response){ 
                          
                           if(response === 'success'){
                               
                               
                           }
                     });
              
           });
        
           
       });
        
        
     
    </script>
</body>
</html>
