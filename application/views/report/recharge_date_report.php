<!doctype html>
<html class="no-js" lang="en">

<head>
   <?php $this->load->view('common/header_link'); ?>
   <link rel="stylesheet" href="<?php echo base_url('catalogs'); ?>/css/c3/c3.min.css">
   <!-- touchspin CSS
		============================================ -->
	<link rel="stylesheet" href="<?php echo base_url('catalogs'); ?>/css/touchspin/jquery.bootstrap-touchspin.min.css">	
   <style type="text/css">
        .form-control{
            height:32px;
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
                                <div class="input-group"  style=" width:100%;">
                                 <form action=""  method="post">
                                          <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3" >
                                            <div class="form-group" id="data_5" style=" height:28px;">
                                                 <select name="colony_search" class="form-control" style="width:100%;">
                                                    <option value="">Colony Name</option>
                                                     <?php foreach($select_colony as $row){ ?>
                                                     <option value="<?php echo $row->colony_id; ?>"><?php echo $row->colony_name ?></option>
                                                     <?php } ?>
                                                </select>
                                            </div>
                                           </div>
                                           <div class="col-lg-2 col-md-2col-sm-2 col-xs-3" >
                                            <div class="form-group" id="data_5" style=" height:28px;">
                                                <select name="delivery_search" class="form-control" style="width:100%;">
                                                     <option value="">Delivery Type</option>
                                                     <option value="1">Home</option>
                                                     <option value="2">Counter</option>
                                                </select>
                                            </div>
                                           </div> 
                                           <div class="col-lg-2 col-md-2col-sm-2 col-xs-3" >
                                            <div class="form-group" id="data_5" style=" height:28px;">
                                                <select name="agent_search" class="form-control" style="width:100%;">
                                                    <option value="">All</option>
                                                     <?php foreach($select_agent as $row){ ?>
                                                     <option value="<?php echo $row->user_id; ?>"><?php echo $row->name; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                           </div>       
                                           <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12" >
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
                <div class="row" id="print_area">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <input id="select_colony" type="hidden" value="<?php if(isset($return_colony)){ echo $return_colony; } ?>">
                        <input id="select_agent" type="hidden"  value="<?php if(isset($return_agent)){ echo $return_agent; } ?>">
                       <input id="select_delivery" type="hidden"   value="<?php if(isset($return_delivery)){ echo $return_delivery; } ?>">
                      
                        <div id="myheadtitle" style="margin:0px; height:55px; border-bottom:none; padding-top:15px; font-size: 15.5px;">
                               Recharge report <span><i class="ion-android-arrow-dropright" style="color: #0099cc;"></i></span> <?php if(isset($recharge_detail[0]->recharge_date)){echo date('d-M-Y',strtotime($recharge_detail[0]->recharge_date));}; ?>
                            
                            <button type="button" class="btn" id="print" style="position:absolute; right:210px; margin-top:-5px;">Print</button>
                        </div>  
						<div class="asset-inner">
                                <table id="table" data-toggle="table" data-pagination="true" data-show-columns="true" data-show-pagination-switch="true"  data-key-events="true" data-show-toggle="true"  data-cookie="true"
                                        data-cookie-id-table="saveId" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">
                                     <thead>
									<tr>
                                        <th>Sr. No.</th>
                                        <th>Customer Name</th>
                                        <th>Delivery Type</th>
                                        <th>Colony Name</th>
                                        <th>Card No.</th>
                                        <th>Recharge Amount</th>
                                        <th>Payment Id</th>
                                        <th>Recharge By</th>
                                    </tr>
                                    
									 </thead>
									 <tbody>
                                     <?php
                                      
                                         $total = 0;
                                         $i = 1;
                                         foreach($recharge_detail as $row){ ?>
                                       
                                         <tr>
                                             <td><?php echo $i++; ?></td>
                                             <td><?php echo $row->first_name.' '.$row->last_name; ?></td>
                                             <td><?php echo $row->d_type; ?></td>
                                             <td><?php echo $row->colony_name; ?></td>
                                             <td><?php echo $row->atm_card_no; ?></td>
                                             <td><span class="rs_span"><i class="fa fa-rupee"></i> </span> <?php echo number_format($row->recharge_amount); ?></td>
                                             <td><?php echo $row->payment_id; ?></td>
                                             <td><?php echo $row->name; ?></td>
                                        
                                        </tr>
                                         
                                         <?php $total +=  $row->recharge_amount; ?>
                                     <?php } ?>    
                                    
									</tbody>
                                    <tfoot>
                                        <tr>
                                             <td style="border:1px solid #dddddd; color:#46c7fe; font-weight:600;">Total</td>
                                            
                                            <td></td>
                                             <td></td>
                                            <td></td>
                                             <td></td>
                                             <td style="border:1px solid #dddddd;"><span class="rs_span"><i class="fa fa-rupee"></i> </span><b> <?php echo number_format($total); ?> </b></td>
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
    
	
	<!-- touchspin JS
		============================================ -->
    <script src="<?php echo base_url('catalogs'); ?>/js/touchspin/jquery.bootstrap-touchspin.min.js"></script>
    <script src="<?php echo base_url('catalogs'); ?>/js/touchspin/touchspin-active.js"></script>	
		
    <script type="text/javascript">
    $(document).ready(function(){
       
      function select_take(){ 
             var select_colony = $('input[id=select_colony]').val();
             var select_agent = $('input[id=select_agent]').val();
             var select_delivery = $('input[id=select_delivery]').val();                 
             
            $('select[name=delivery_search]').val(select_delivery);
            $('select[name=colony_search]').val(select_colony);
            $('select[name=agent_search]').val(select_agent);
    
        } 
        select_take();
        
         $(document).on('click', '#tbl_refresh',function(){
            
           window.location.href =   window.location.href;
            
        });   
        
    });
    </script>
</body>
</html>