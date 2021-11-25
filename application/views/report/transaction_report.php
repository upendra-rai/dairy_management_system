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
        width:49%;
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
                                     <div class="col-md-3 col-sm-12 col-xs-12" style="padding:0;">
                                     <div class="input-daterange input-group" id="datepicker" style=" width:100%; margin-bottom:0px;">
                                          <div class="col-md-6 col-sm-12 col-xs-12" >
                                            
                                                <div class="form-group" id="data_5" style=" height:28px;">
                                                   <input type="text" class="form-control" name="start" value="<?php if(isset($return_start)){ echo $return_start; }else{ echo 'Start Date'; } ?>" placeholder="Start Date" style="background-color:#ffffff;"/>
                                                </div>
                                            </div>
                                           
                                            <div class="col-md-6 col-sm-12 col-xs-12" >
                                            
                                                <div class="form-group" id="data_5" style=" height:28px;">
                                                  <input type="text" class="form-control" name="end" value="<?php if(isset($return_end)){ echo $return_end; }else{ echo 'End Date'; } ?>" placeholder="End Date" style="background-color:#ffffff; "/>
                                                </div>
                                            
                                           </div>
                                         </div> 
                                         </div> 
                                    
                                          <div class="col-lg-2 col-md-3 col-sm-2 col-xs-12" >
                                            <div class="form-group" id="data_5" style=" height:28px;">
                                                <select name="agent_search"  class="form-control" style="width:100%;">
                                                    <option value="">All</option>
                                                     <?php foreach($select_agent as $row){ ?>
                                                     <option value="<?php echo $row->user_id; ?>"><?php echo $row->name; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                           </div>
                                           <div class="col-lg-2 col-md-3 col-sm-2 col-xs-12" >
                                            <div class="form-group" id="data_5" style=" height:28px;">
                                                <select name="shift"  class="form-control" style="width:100%;">
                                                    <option value="">Shift</option>
                                                     
                                                     <?php foreach($select_shift as $row){ ?>
                                                     <option value="<?php echo $row->shift_id; ?>"><?php echo $row->shift_name; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                           </div>
                                     
                                          <div class="col-lg-2 col-md-3 col-sm-2 col-xs-12" >
                                            <div class="form-group" id="data_5" style=" height:28px;">
                                                <select name="product_search"  class="form-control" style="width:100%;">
                                                    <option value="">Product</option>
                                                     <?php foreach($select_product as $row){ ?>
                                                     <option value="<?php echo $row->product_id; ?>"><?php echo $row->product_name; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                           </div>
                                            <div class="col-lg-2 col-md-3 col-sm-2 col-xs-12" >
                                            <div class="form-group" id="data_5" style=" height:28px;">
                                                <select name="customer_type" class="form-control" style="width:100%;">
                                                    <option value="">All Customers</option>
                                                    <option value="guest" <?php if(isset($return_customer_type)){ if($return_customer_type == 'guest'){ echo 'selected'; }}  ?> >Guest</option>
                                                    <option value="membership" <?php if(isset($return_customer_type)){ if($return_customer_type == 'membership'){ echo 'selected'; }} ?>  >Member</option>
                                                    
                                                     <option value="cash" <?php if(isset($return_customer_type)){ if($return_customer_type == 'cash'){ echo 'selected'; }} ?>  >Cash</option>
                                                </select>
                                            </div>
                                           </div>
                                     
                                          <div class="col-lg-1 col-md-2 col-sm-12 col-xs-12" >
                                                <div class="form-group" id="data_5" style=" height:28px;">
                                                     <input type="submit" name="submit" class="btn" value="Search" style="background-color: #46c7fe; color:#ffffff; width: 100%;"/>
                                                      
                                                      <!--<span><button type="button" id="tbl_refresh" class="btn" style="width:40px; border:1px solid #e8e8e8"><i class="ion-android-sync" style="color:#46c7fe; "></i></button></span>-->
                                                  </div>
                                           </div>
                                        
                                            
                                    </div>
                                </form>
                             </div>
				          </div>		
				 </div>
                <div class="row" id="print_area">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <input id="select_agent" type="hidden"  value="<?php if(isset($return_agent)){ echo $return_agent; } ?>">
                        
                        <input id="select_shift" type="hidden"  value="<?php if(isset($return_shift)){ echo $return_shift; } ?>">
                        
                        <input id="select_product" type="hidden"  value="<?php if(isset($return_product)){ echo $return_product; } ?>">
                        
                         <div id="myheadtitle" style="margin:0px; height:55px; border-bottom:none; padding-top:15px; font-size: 15.5px; ">
                             Day Wise Sales Report <span><i class="ion-android-arrow-dropright" style="color: #0099cc;"></i></span> &nbsp <?php if(isset($return_start,$return_end)){ echo date('d-M-Y', strtotime($return_start)).' To '.date('d-M-Y', strtotime($return_end)); }else{ echo date('F-Y'); }; ?>
                             
                             <button type="button" class="btn" id="print" style="position:absolute; right:260px; margin-top:-5px;">Print</button> 
                        </div>
						<div class="asset-inner">
                                <table id="table" data-toggle="table" data-pagination="true" data-show-columns="true" data-show-pagination-switch="true" data-show-refresh="true" data-key-events="true" data-show-toggle="true"  data-cookie="true"
                                        data-cookie-id-table="saveId" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar" class="table-striped">
                                    <thead>
									<tr>
                                        <th>Sales Date</th>
								        <th>Total Sales</th>
                                        <th>No. of Sales</th>
                                    </tr>
								    </thead>
								  <tbody id="tran_table">
                                     <?php foreach($daily_transaction as $row){ ?>
                                         <tr class="click_tr" data-date="<?php echo date('Y-m-d',strtotime($row->transaction_date)); ?>" >
                                             <td><?php echo date('d-M-Y',strtotime($row->transaction_date)); ?></td>
                                             <td><span class="rs_span"><i class="fa fa-rupee"></i> </span> <?php echo number_format($row->total_value,1); ?></td>
                                             <td><?php echo $row->count_tran; ?></td>
                                        </tr>
                                     <?php } ?>    
								  </tbody>
								</table>
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
       });
    </script>
</body>
</html>