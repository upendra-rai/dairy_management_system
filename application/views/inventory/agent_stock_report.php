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
    
  
    
    .fixed-table-container {
        
        
    }
    
 
    
#breadcrumbs-one{
    margin: 0;
    padding: 0;
    list-style: none;
    background: transparent;
    border-width: 1px;
    border-style: solid;
    border-color: transparent;
    border-radius: 0px;
   
    overflow: hidden;
    width: 100%;
  }

  #breadcrumbs-one li{
    float: left;
  }

  #breadcrumbs-one a{
    padding: .1em 1em .3em 2em;
    float: left;
    text-decoration: none;
    font-size: 15px;  
    color: #ffffff;
    position: relative;
    text-shadow: 0 1px 0 rgba(255,255,255,.5);
    background-color: #46c7fe;
   /* background-image: linear-gradient(to right, #f5f5f5, #ddd);*/
  }

  #breadcrumbs-one li:first-child a{
    padding-left: 1em;
    border-radius: 0px 0 0 0px;
  }

  
  #breadcrumbs-one a::after,
  #breadcrumbs-one a::before{
    content: "";
    position: absolute;
    top: 50%;
    margin-top: -1.5em;
    border-top: 1.5em solid transparent;
    border-bottom: 1.5em solid transparent;
    border-left: 1em solid;
    right: -1em;
  }

  #breadcrumbs-one a::after{
    z-index: 2;
    border-left-color: #46c7fe;
  }

  #breadcrumbs-one a::before{
    border-left-color: #ccc;
    right: -1.1em;
    z-index: 1;
  }

  

  #breadcrumbs-one .current,
  #breadcrumbs-one .current:hover{
    font-weight: bold;
    background: none;
  }

  #breadcrumbs-one .current::after,
  #breadcrumbs-one .current::before{
    content: normal;
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
                                     <div class="col-md-2 col-sm-12 col-xs-12" >
                                     <div class="input-daterange input-group" id="datepicker" style=" width:100%;">
                                         
                                                <div class="form-group" id="data_5" style=" height:28px;">
                                                   <input type="text" class="form-control" name="start" value="<?php if(isset($return_start)){ echo $return_start; }else{ echo date('d-m-Y'); } ?>" placeholder="Start Date" style="background-color:#ffffff;"/>
                                                </div>
                                           
                                         </div> 
                                         </div> 
                                        
                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12" >
                                          <div class="form-group" id="data_5" style=" height:28px;">
                                                <select name="agent_search"  class="form-control" style="width:100%;">
                                                    <option value="">All</option>
                                                     <?php foreach($select_agent as $row){ ?>
                                                     <option value="<?php echo $row->user_id; ?>"><?php echo $row->name; ?></option>
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
                                          <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12" >
                                           <button type="button" class="btn" id="print" style="border:1px solid #3e3e3e;">Print</button>
                                           </div>
                                            
                                    </div>
                                </form>
                             </div>
				          </div>		
				 </div>
				 <div id="print_area">
				  <?php if(isset($dairy_avl_stock)){ if(!empty($dairy_avl_stock)){ ?>
				<div class="row">
				     <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-top:15px;">
					    <div class="" >
						
						    <table class="table table-border" style="width:auto; margin-bottom:0px;">
						    
							<tbody> 
							    <tr>
								    <td style="padding:6px 8px; background-color:#46c7fe; color:#ffffff; font-weight:600;">Product</td>
								   <?php if(isset($dairy_avl_stock)){ foreach($dairy_avl_stock as $row){ ?>
							        <td style="padding-left:15px; padding-right: 15px; border: 1px solid #dddddd; text-align:center;"><?php echo $row->product_name; ?></td>
								   <?php }} ?>	
								</tr>
							    <tr>
								 <td style="padding: 6px 8px; background-color:#46c7fe; color:#ffffff; font-weight:600;">Produced</td>
								<?php if(isset($dairy_avl_stock)){ foreach($dairy_avl_stock as $row){ ?>
								  <td style="padding: 6px 6px; border: 1px solid #dddddd;"><input type="text"  value="<?php if(isset($row->produced_qty)){ if($row->unit == 'Pkt'){ echo number_format($row->produced_qty); }else{ echo +$row->produced_qty; } }else{ echo 0; } ?>" name="" readonly style="width:80px;  text-align:center; height:25px; border:1px solid <?php if(isset($row->produced_qty)){ if($row->produced_qty > 0){ echo '#41ec00'; }else{ echo '#ff5e5e'; }} ?> "></td>
								<?php }} ?>
								</tr>
								 <tr>
								 <td style="padding: 6px 8px; background-color:#46c7fe; color:#ffffff; font-weight:600;">Available</td>
								<?php if(isset($dairy_avl_stock)){ foreach($dairy_avl_stock as $row){ ?>
								  <td style="padding: 6px 6px; border: 1px solid #dddddd;"><input type="text"  value="<?php if(isset($row->remaining_qty)){ if($row->unit == 'Pkt'){ echo number_format($row->remaining_qty); }else{ echo +$row->remaining_qty; } }else{ echo 0; } ?>" name="" readonly style="width:80px;  text-align:center; height:25px; border:1px solid <?php if(isset($row->remaining_qty)){ if($row->remaining_qty > 0){ echo '#41ec00'; }else{ echo '#ff5e5e'; }} ?> "></td>
								<?php }} ?>
								</tr>
								<tr>
								 <td style="padding: 6px 6px; background-color:#46c7fe; color:#ffffff; font-weight:600;">Lost</td>
								<?php if(isset($dairy_avl_stock)){ foreach($dairy_avl_stock as $row){ ?>
								  <td style="padding: 6px 6px; border: 1px solid #dddddd;"><input type="text"  value="<?php if(isset($row->lost_qty)){ if($row->unit == 'Pkt'){ echo number_format($row->lost_qty); }else{ echo +$row->lost_qty; } }else{ echo 0; } ?>" name="" readonly style="width:80px;  text-align:center; height:25px; border:1px solid <?php if(isset($row->lost_qty)){ if($row->lost_qty > 0){ echo '#ff5e5e'; }else{ echo '#41ec00'; }} ?> "></td>
								<?php }} ?>
								</tr>
							</tbody>
							    
						    </table>
						 
						</div>
					 </div>
			    </div>
				 <?php }} ?>
				 
                 <?php if(isset($agent_stock_report)){ foreach(json_decode($agent_stock_report) as $rows){ ?>
                <?php if(!empty(json_decode($rows->stock))){ ?>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" >
                        <div style=" margin-top:15px;">
                        <!-- <div id="myheadtitle" style="margin:0px; height:55px; border-bottom:none; padding-top:15px; font-size: 15.5px; ">
                             Inventory Details<span> <i class="ion-android-arrow-dropright" style="color: #0099cc;"></i></span> 
                        </div>-->
                        <div style="padding-top:10px; font-size: 17px; color:#262d31;">
                            <p>Agent Stock Report / <?php if(isset($return_date)){ echo $return_date; }else{ echo date('d-M-Y'); } ?> / <a href=""  style="color:#262d31;"><?php echo $rows->name; ?></a></p>
                            <!--  
                           <ul id="breadcrumbs-one">
                           <li><a href="">Stock Details </a></li>
                           <li><a href=""><?php if(isset($return_date)){ echo $return_date; } ?></a></li>
                           <li><a href=""><?php echo $rows->name; ?></a></li>
                           </ul> --> 
                        </div>
                        
						<div class="asset-inner" >
                           
                                <table id="table"  data-toggle="table"   data-key-events="true"   data-cookie="true"
                                          class="table-striped">
                                    <thead>
									<tr>
                                        <th>Sr No.</th>
								        <th>Product</th>
                                        <th>Unit</th>
                                        <th>Unit Price</th>
                                        <th>Assigned Qty</th>
                                        <th>Transferred Qty</th>
                                        <th>Transferred To</th>
                                        <th>Received Qty</th>
                                        <th>Received By</th>
                                        <th>Sold Qty</th>
                                        <th>Remaining Qty</th>
                                        <th>Lost Qty</th> 
                                        <!--<th>Assign</th>-->
                                    </tr>
								    </thead>
							    	  <tbody id="tran_table">
                                         <?php  $i = 1; foreach(json_decode($rows->stock) as $row){ ?>
                                             <tr class="product_row" data-product_id="<?php echo $row->product_id; ?>" >
                                                 <td><?php echo $i++; ?></td>
                                                 <td><?php echo $row->product_name; ?></td>
                                                 <td><?php echo $row->unit; ?></td>
                                                 <td><span class="rs_span"><i class="fa fa-rupee"></i> </span> <?php echo $row->product_price; ?> </td>
                                                <td>
                                                    <?php  echo +$row->assigned_qty;  ?>
                                                    
                                                     
                                                </td>
                                                <td>
                                                    <?php if($row->transferred_stock > 0){  echo +$row->transferred_stock; }else{ echo '-'; } ?>
                                                </td> 
                                                <td>
                                                    <?php if($row->transferred_to_name != ''){ if ( strpos($row->transferred_to_name, ' ') == true ){ echo substr($row->transferred_to_name, 0, strpos( $row->transferred_to_name, ' ')); }else{ echo $row->transferred_to_name; }}else{ echo '-'; }  ?>
                                                </td> 
                                                <td>
                                                    <?php if($row->received_stock > 0){  echo +$row->received_stock; }else{ echo '-'; } ?>
                                                </td> 
                                                <td>
                                                   <?php  
                                                    if( $row->received_by_name != '' ){ if ( strpos($row->received_by_name, ' ') == true ){ echo substr($row->received_by_name, 0, strpos( $row->received_by_name, ' ')); }else{ echo $row->received_by_name; }}else{ echo '-'; }
                                                    ?>
                                                </td> 
                                                 
                                                <td>
                                                    <?php echo +$row->sold_qty;  ?>   
                                                </td>
                                                 <td>
                                                     <?php  echo +$row->remaining_qty; ?>
                                                </td>
                                                 <td>
                                                     <?php if($row->lost_qty > 0){ echo +$row->lost_qty; }else{ echo '-'; }  ?>
                                                </td>
                                                
                                            </tr>
                                         <?php }?>    
							    	  </tbody>
                                    <tfoot>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                           
                                        </tr>
                                    </tfoot>
								</table>
                            
                            </div>
                    </div>
                  </div>
                </div>
                
                <?php }}} ?>
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