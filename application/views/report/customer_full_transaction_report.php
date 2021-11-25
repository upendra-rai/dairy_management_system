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

    <style type="text/css">
        .form-control{
            height:32px;
        }
        .action_panel_bt.active{
         background: #2196f3;
         border: 1px solid #2196f3;
     }
     .action_panel_bt.active:hover{
         background: #2196f3;
         border: 1px solid #2196f3;
     }
     .action_panel_bt{
         
        font-family: 'Arial';
        font-weight:700;
        height:32px;
        border: 1px solid #007ee5;
        background-color: #ffffff;
        text-align: center;
        padding-top: 6px;
        text-transform: uppercase;
        color:#007ee5;
        font-size: 12px;
        overflow: hidden;
     }
     .action_panel_bt:hover{
          border: 1px solid #2196f3;
         background: #2196f3;
     }
      .detail_tab p label{
           font-weight: 400;
           color: #000000;
           /*color: #525252;*/
           font-size: 14px;
           
       }
      .detail_tab p{
          color: #4f4f4f;
          font-size:15px;
      	   margin-top:0px;
          margin-bottom: 8px;
      }  
        
    .asset-inner{
        width:70%;
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
        <div class="container-fluid" style="margin-top:15px; ">
           <div class="col-md-2" style="padding:2px;">
               <div class="product-status-wrap mycard" style="padding:10px; border-top:1px solid #0b89de; box-shadow: 0px 3px 8px -1px rgba(0,0,0,0.4); ">
                <img src="<?php echo base_url('catalogs') ?>/img/customer_img/<?php echo $customer_detail[0]->customer_image; ?>" class="thumbnail" alt="" style="width:100px; height:100px; border-radius: 50%; margin:0px;" />
               </div>
           </div>
           <div class="col-md-8" style="padding:2px; ">
               <div class="product-status-wrap mycard" style="overflow:auto; overflow-X:hidden; padding:10px;  border-top:1px solid #0b89de; box-shadow: 0px 3px 8px -1px rgba(0,0,0,0.4); ">
                  <div class="row detail_tab">
                      <div class="col-md-4" style="height:99px;">
                         <p style="margin:0;"><label>Name:</label> <?php echo $customer_detail[0]->first_name.' '.$customer_detail[0]->last_name; ?></p>
                         <p style="margin:0;"><label>Phone 1:</label> <?php echo $customer_detail[0]->contact_1; ?></p>
                         <p style="margin:0;"><label>Phone 2:</label> <?php echo $customer_detail[0]->contact_2; ?></p>
                         <input type="hidden" id="search_customer_id" value="<?php echo $customer_detail[0]->customer_id; ?>">
                      </div>                                        
                      <div class="col-md-4" style="height:99px;">
                         <p style="margin:0;"><label>Address 1:</label> <?php echo $customer_detail[0]->address_1; ?></p>
                         <p style="margin:0;"><label>Colony Name:</label> <?php echo $customer_detail[0]->colony_name; ?></p>
                         <p style="margin:0;"><label>Balance:</label> <span class="rs_span" style="color:#46c7fe;"><i class="fa fa-rupee"></i> </span> <?php echo number_format($customer_detail[0]->balance_amount,1); ?></p>
                      </div>
                      <div class="col-md-4" style="height:99px;">
                          <p style="margin:0;"><label>Ragistration Date:</label> <?php echo date('d-M-y',strtotime($customer_detail[0]->ragistration_date)); ?></p>
                          <p style="margin:0; text-transform: capitalize;"><label>Status:</label> <?php echo $customer_detail[0]->card_status; ?></p>
                      </div>
                  </div>
               </div>
           </div>
           <div class="col-md-2" style="padding:2px;">
               <div class="product-status-wrap mycard" style=" padding:10px; border-top:1px solid #0b89de; box-shadow: 0px 3px 8px -1px rgba(0,0,0,0.4); height:120px;">
                <a href="<?php echo base_url(); ?>/report/customer_full_recharge_report/<?php echo $customer_detail[0]->customer_id ; ?>"><button data-toggle="tooltip" title="Recharge Detail"  class="btn btn-primary action_panel_bt" style="width:100%;">Recharge</button></a> 
                <a href="<?php echo base_url(); ?>/report/customer_full_transaction_report/<?php echo $customer_detail[0]->customer_id ; ?>"><button data-toggle="tooltip" title="Transaction Detail"  class="btn btn-primary action_panel_bt active" style=" width:100%;">Transaction</button></a>
               </div>
           </div>
        </div>
	    <div class="container-fluid" style="margin-top:15px;">
            <div class="product-status-wrap mycard" style="padding-top:0px; border-top:2px solid #0099cc;">
                 <div class="row" style="background-color:#f7f7f7; ">
				        <div class="search_engine" style="height:auto; min-height:60px; padding-top:15px;">
                            <div class="breadcome-heading" style="">
                                <form action=""  method="post">
                                 <div class="form-group data-custon-pick data-custom-mg" id="data_5">
                                     <div class="col-md-4 col-sm-12 col-xs-12" style="padding:0;">
                                     <div class="input-daterange input-group" id="datepicker" style=" width:100%;">
                                          <div class="col-md-6 col-sm-12 col-xs-12" >
                                            
                                                <div class="form-group" id="data_5" style=" height:28px;">
                                                   <input type="text" class="form-control" name="start" value="Start Date" placeholder="Start Date" style="background-color:#ffffff;"/>
                                                </div>
                                            
                                           </div>
                                            <div class="col-md-6 col-sm-12 col-xs-12" >
                                            
                                                <div class="form-group" id="data_5" style=" height:28px;">
                                                  <input type="text" class="form-control" name="end" value="End Date" placeholder="End Date" style="background-color:#ffffff;"/>
                                                </div>
                                           
                                           </div>
                                         </div>
                                     </div>
                                          <div class="col-md-2 col-sm-12 col-xs-12" >
                                                <div class="form-group" id="data_5" style=" height:28px;">
                                                     <input type="submit" name="submit" class="btn" value="Search" style="background-color: #46c7fe; color:#ffffff; width: 100%;"/>
                                                      
                                                  </div>
                                           </div>
                                        
                                            
                                    </div>
                                </form>
                             </div>
				          </div>		
				 </div>
         
                <div class="row">
                   <div class="col-md-12">
						    <div id="myheadtitle" style="margin:0px; height:60px; border-bottom:none; padding-top:15px; font-size: 15.1px;">
                                Customer Transaction Report 
                                  
                            </div>
                            <div class="asset-inner">
							       
                                <table id="table" class="tran_table" data-toggle="table" data-pagination="true" data-show-columns="true" data-show-pagination-switch="true" data-show-refresh="true" data-key-events="true" data-show-toggle="true"  data-cookie="true"
                                        data-cookie-id-table="saveId" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">
                                     <thead>
									<tr>
                                        <th>Sr. No.</th>
                                         <th>Sales Date</th>
										 <th>Sales Time</th>
										 <th>Shift</th>
                                         <th>Product</th>
										 <th>Amount</th>
										 <th>ledger Bal</th>
                                         <th>Transaction By</th>
                                         
										
                                    </tr>
									 </thead>
									 <tbody >
                                         
									    <?php
                                         $total = 0;
										  $i = 1;
                                          foreach($customer_transaction as $row){ ?>
                                         <tr>
                                             <td><?php echo $i++; ?></td>
                                             <td><?php echo date('d-M-y',strtotime($row->transaction_date)); ?></td>
											 <td><?php echo date('h:i:sa',strtotime($row->transaction_date)); ?></td>
											 <td><?php if(isset($row->shift_name) ){ echo $row->shift_name;  } ?></td>
                                             <td><?php echo $row->product_name; ?></td>
                                             <td><span class="rs_span"><i class="fa fa-rupee"></i> </span> <?php echo number_format($row->transaction_amount,1); ?></td>
											 <td><span class="rs_span"><i class="fa fa-rupee"></i> </span> <?php if($row->ledger){ echo number_format($row->ledger,1); }; ?></td>
                                             <td><?php echo $row->name; ?></td>
                                             
                                         </tr>     
                                         <?php $total += $row->transaction_amount; ?>
									    <?php } ?>
									</tbody>
                                    <tfoot>
                                        <tr>
                                             <td style="border:1px solid #dddddd; color:#46c7fe; font-weight: 800;">Total</td>
                                             <td></td>
                                             <td></td>
											 <td></td>
                                             <td style="border:1px solid #dddddd;"><span class="rs_span"><i class="fa fa-rupee"></i> </span> <?php echo number_format($total,1); ?></td>
											 <td></td>
                                             <td></td>
                                             
                                         </tr>
                                    </tfoot>    
								</table>
                            </div>
                            
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
         
         $(document).on('click','#search_date_bt',function(){ 
            
            var start_date =  $('input[name=start]').val();
            var end_date =  $('input[name=end]').val();
            
            var link_id = $('input[id=search_customer_id]').val();
            
            $.ajax({
     				 type: 'POST',
     				 url: '<?php echo base_url(); ?>report/customerreport_tran_searchbar',
     				 data:{start_date:start_date,end_date:end_date,link_id:link_id},
     				 success:function(noti){
     					 $('.tran_table').html(noti);
     				 }
            });
            
        }); 
           
        $(document).on('click','#search_date_bt2',function(){ 
            
            var start_date =  $('input[name=start2]').val();
            var end_date =  $('input[name=end2]').val();
            
            var link_id = $('input[id=search_customer_id]').val();
            
            $.ajax({
     				 type: 'POST',
     				 url: '<?php echo base_url(); ?>report/customerreport_recharge_searchbar',
     				 data:{start_date:start_date,end_date:end_date,link_id:link_id},
     				 success:function(noti){
     					 $('.re_table').html(noti);
     				 }
            });
            
        });
         
         $(document).on('click', '#tbl_refresh',function(){
            
           window.location.href =   window.location.href;
            
        });
	 });  
   
   </script>
</body>
</html>