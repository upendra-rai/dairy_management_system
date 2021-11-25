<?php
header('Cache-Control: max-age=900');
?>
<!doctype html>
<html class="no-js" lang="en">

<head>
   <?php $this->load->view('common/header_link'); ?>
   <!-- touchspin CSS
		============================================ -->
	<link rel="stylesheet" href="<?php echo base_url('catalogs'); ?>/css/touchspin/jquery.bootstrap-touchspin.min.css">	
    
      <link rel="stylesheet" href="<?php echo base_url('catalogs'); ?>/css/calendar/fullcalendar.min.css">
    <link rel="stylesheet" href="<?php echo base_url('catalogs'); ?>/css/calendar/fullcalendar.print.min.css">
 
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
                                     <div class="col-md-4 col-sm-12 col-xs-12" style="padding:0;">
                                     <div class="input-daterange input-group" id="datepicker" style=" width:100%;">
                                          <div class="col-md-6 col-sm-12 col-xs-12" >

                                                <div class="form-group" id="data_5" style=" height:28px;">
                                                   <input type="text" class="form-control" name="start" value="<?php if(isset($return_start)){ echo $return_start; }else{ echo 'Start Date'; } ?>" placeholder="Start Date" style="background-color:#ffffff;" autocomplete="off"/>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-sm-12 col-xs-12" >

                                                <div class="form-group" id="data_5" style=" height:28px;">
                                                  <input type="text" class="form-control" name="end" value="<?php if(isset($return_end)){ echo $return_end; }else{ echo 'End Date'; } ?>" placeholder="End Date" style="background-color:#ffffff; " autocomplete="off"/>
                                                </div>

                                           </div>
                                         </div>
                                         </div>

                                        <div class="col-lg-2 col-md-2 col-sm-3 col-xs-12" >
                                          <div class="form-group">
                                            <select class="form-control" name="product" style="width:100%;">
                                                  <option value="">All Products</option>
                                                  <?php foreach($select_product as $row){ ?>
                                                    <option value="<?php echo $row->product_id; ?>"  <?php if(isset($return_product)){ if($return_product == $row->product_id){ echo 'selected'; } } ?>><?php echo $row->product_name; ?></option>
                                                  <?php } ?>
                                            </select>
                                          </div>

                                         </div>
                                        
                                          <!-- <div class="col-lg-2 col-md-2col-sm-2 col-xs-12" >
                                            <div class="form-group" id="data_5" style=" height:28px;">
                                                <select name="shift"  class="form-control" style="width:100%;">
                                                    <option value="">Shift</option>
                                                     
                                                     <?php foreach($select_shift as $row){ ?>
                                                     <option value="<?php echo $row->shift_id; ?>"><?php echo $row->shift_name; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                           </div>-->
                                          
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
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <input id="select_agent" type="hidden"  value="<?php if(isset($return_agent)){ echo $return_agent; } ?>">
                        
                        <input id="select_shift" type="hidden"  value="<?php if(isset($return_shift)){ echo $return_shift; } ?>">
                        
                        <input id="select_product" type="hidden"  value="<?php if(isset($return_product)){ echo $return_product; } ?>">
                        
                         <div id="myheadtitle" style="margin:0px; height:200px; border-bottom:none; padding-top:15px; font-size: 15.5px; ">
                             Stock Report <span><i class="ion-android-arrow-dropright" style="color: #0099cc;"></i></span> 
                             
                             <table class="table" data-toggle="table" >
                                 <thead>
                                 <tr>
                                     <th>Product Name</th>
                                     <?php if(isset($sum_stock_report)){ foreach($sum_stock_report as $row){  ?>
                                     <th><?php echo $row->product_name; ?></th>
                                     <?php }} ?>
                                 </tr>
                                 </thead> 
                                 
                                 <tbody>
                                     <tr>
                                         <td>Total Produce</td>
                                         
                                         <?php if(isset($sum_stock_report)){ foreach($sum_stock_report as $row){  ?>
                                          <td><?php echo  $row->unit.' '.+ $row->SUM_produce; ?></td>
                                         <?php }} ?>
                                     </tr>
                                     
                                     <tr>
                                         <td>Total Sold</td>
                                          <?php if(isset($sum_stock_report)){ foreach($sum_stock_report as $row){  ?>
                                          <td><?php echo  $row->unit.' '.+ $row->SUM_sold; ?></td>
                                         <?php }} ?>
                                     </tr>
                                     
                                     <tr>
                                         <td>Total Lost</td>
                                          <?php if(isset($sum_stock_report)){ foreach($sum_stock_report as $row){  ?>
                                           <td><?php echo  $row->unit.' '.+ $row->SUM_lost; ?></td>
                                         <?php }} ?>
                                     </tr>
                                     
                                    <!--  <tr>
                                         <td>Total Profit</td>
                                           <?php if(isset($sum_stock_report)){ foreach($sum_stock_report as $row){  ?>
                                          <td><?php echo  $row->unit.' '.$row->SUM_produce; ?></td>
                                         <?php }} ?>
                                     </tr> -->
                                 </tbody> 
                                 
                             </table>
                             
                             
                             
                           
                        </div>
						<div class="asset-inner">
                              <table id="table" data-toggle="table"    data-key-events="true"   data-cookie="true"
                                          class="table-striped">
                                    <thead>
									<tr>
                                        <th>Sr No.</th>
                                         <th>Date</th>
								        <th>Product</th>
                                        <th>Unit</th>
                                        <th>Unit Price</th>
                                        <th>Produced Qty</th>
                                        <th>Sold Qty</th>
                                        <th>Available Qty</th>
                                        <th>Lost Qty</th>
                                        <th>Carry Forward</th>
                                        <!--<th>Assign</th>-->
                                    </tr>
								    </thead>
							    	  <tbody id="tran_table">
                                         <?php $sum_produce = 0; $sum_sold = 0; $sum_avl = 0; $sum_lost = 0; $sum_carry = 0; if(isset($stock_report)){ $i = 1; foreach($stock_report as $row){  ?>
                                             <tr class="product_row" data-product_id="<?php echo $row->product_id; ?>" >
                                                 <td><?php echo $i++; ?></td>
                                                 <td><?php echo date('d-M-Y',strtotime($row->stock_date)); ?></td>
                                                 <td><?php echo $row->product_name; ?></td>
                                                 <td><?php echo $row->unit; ?></td>
                                                 <td><i class="fa fa-rupee"></i> <?php echo $row->product_price; ?></td>
                                                 <td>
                                                     <?php if($row->produced_qty > 0){ echo  $row->unit.' '.+ $row->produced_qty; $sum_produce += $row->produced_qty; } ?> 
                                                     
                                                     
                                                </td>
                                                 <td>
                                                     <?php if($row->sold_qty > 0){ echo  $row->unit.' '.+ $row->sold_qty; $sum_sold += $row->sold_qty; } ?> 
                                                    
                                                     
                                                </td>
                                                 <td>
                                                    <?php if($row->remaining_qty > 0){ echo  $row->unit.' '.+ $row->remaining_qty; $sum_avl += $row->remaining_qty; } ?> 
                                                     
                                                     
                                                </td>
                                               <td>
                                                    <?php if($row->lost_qty > 0){ echo  $row->unit.' '.+ $row->lost_qty; $sum_lost += $row->lost_qty; } ?> 
                                                     
                                                     
                                                </td>
                                                  <td>
                                                    <?php if($row->carry_forward > 0){ echo  $row->unit.' '.+ $row->carry_forward; $sum_carry += $row->carry_forward;  } ?> 
                                                     
                                                     
                                                </td>
                                                 
                                            </tr>
                                         <?php }} ?>    
							    	  </tbody>
                                    <tfoot>
                                        <tr>
                                            <td style="border:1px solid #dddddd;">Total</td>
                                            <td style="border:1px solid #dddddd;"></td>
                                            <td style="border:1px solid #dddddd;"></td>
                                            <td style="border:1px solid #dddddd;"></td>
                                            <td style="border:1px solid #dddddd;"></td>
                                            <td style="border:1px solid #dddddd;"><?php echo $sum_produce;  ?></td>
                                            <td style="border:1px solid #dddddd;"><?php echo $sum_sold;  ?></td>
                                            <td style="border:1px solid #dddddd;"><?php echo $sum_avl;  ?></td>
                                            <td style="border:1px solid #dddddd;"><?php echo $sum_lost;  ?></td>
                                            <td style="border:1px solid #dddddd;"><?php echo $sum_carry;  ?></td>
                                        </tr>
                                    </tfoot>
								</table>
                            
                              <!--  <table id="table" data-toggle="table" data-pagination="true" data-show-columns="true" data-show-pagination-switch="true" data-show-refresh="true" data-key-events="true" data-show-toggle="true"  data-cookie="true"
                                        data-cookie-id-table="saveId" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar" class="table-striped">
                                    <thead>
									<tr>
                                        <th>Inventory Date</th>
								        <th>Total Inventory</th>
                                        <th>No. of Inventory</th>
                                    </tr>
								    </thead>
								  <tbody id="tran_table">
                                     <?php foreach($inventory_report as $row){ ?>
                                         <tr class="click_tr" data-date="<?php echo date('Y-m-d',strtotime($row->time_stamp)); ?>" >
                                             <td><?php echo date('d-M-Y',strtotime($row->time_stamp)); ?></td>
                                             <td><span class="rs_span"><i class="fa fa-rupee"></i> </span> <?php echo number_format($row->total_value,1); ?></td>
                                             <td><?php echo $row->count_inventory; ?></td>
                                        </tr>
                                     <?php } ?>    
								  </tbody> 
								</table> -->
                            </div>
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
  
    <script type="text/javascript">
       $(document).ready(function(){
       
           $('#month_search').datepicker({
 		        minViewMode: 1,
        		todayBtn: "linked",
        		keyboardNavigation: false,
        		forceParse: false,
        		calendarWeeks: true,
        		autoclose: true,
        		format: "yyyy/mm",
                defaultDate: ""
        	});
           
         $(document).on('click','.click_tr',function(){
             
            var href = $(this).data("date");
          
            var product = $('select[name=product_search]').val();  
           
            
    
             if(product === ''){
                 
                 product = 'null';
             }
            
             
               window.location.href = '<?php echo base_url() ?>inventory/inventory_date_report/'+href+'/'+product;
          
             
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
       });
    </script>
</body>
</html>