<!doctype html>
<html class="no-js" lang="en">

<head>
   <?php $this->load->view('common/header_link'); ?>
   
   <!-- touchspin CSS
		============================================ -->
	<link rel="stylesheet" href="<?php echo base_url('catalogs'); ?>/css/touchspin/jquery.bootstrap-touchspin.min.css">	
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
    </style>
</head>

<body>
    <?php $this->load->view('common/sidemenu'); ?>
    <div class="all-content-wrapper">
        
        <?php $this->load->view('common/titlebar'); ?>
		<div class="container-fluid" style="margin-top:15px; ">
           <div class="col-md-2" style="padding:2px;">
               <div class="product-status-wrap mycard" style=" border-top:1px solid #0b89de; box-shadow: 0px 3px 8px -1px rgba(0,0,0,0.4); ">
                <img src="<?php echo base_url('catalogs') ?>/img/agent/<?php echo $select_agent[0]->image; ?>" class="thumbnail" alt="" style="width:100px; height:100px; border-radius: 50%; margin:0px;" />
               </div>
           </div>
           <div class="col-md-8" style="padding:2px; ">
               <div class="product-status-wrap mycard" style="overflow:auto;  border-top:1px solid #0b89de; box-shadow: 0px 3px 8px -1px rgba(0,0,0,0.4); ">
                  <div class="row detail_tab">
                      <div class="col-md-6" style="height:100px;">
                         <p style="margin:0;"><label>Name:</label>  <?php echo $select_agent[0]->name; ?></p>
                         <p style="margin:0;"><label>Email:</label>  <?php echo $select_agent[0]->email; ?></p>
                         <p style="margin:0;"><label>Role:</label>  <?php echo $select_agent[0]->role; ?></p>
                         <input type="hidden"  id="teammember_id" value="<?php echo $select_agent[0]->user_id; ?>" />
                         <input type="hidden" id="search_customer_id" value="<?php echo $select_agent[0]->ragistration_date; ?>">
                      </div>                                        
                      <div class="col-md-6" style="height:100px;">
                         <p style="margin:0;"><label>Mobile No:</label>  <?php echo $select_agent[0]->contact; ?></p>
                         <p style="margin:0;"><label>Ragistration Date:</label>  <?php echo date('d-M-y',strtotime($select_agent[0]->ragistration_date)); ?></p> 
                      </div>
                      
                  </div>
               </div>
           </div>
           <div class="col-md-2" style="padding:2px;">
               <div class="product-status-wrap mycard" style=" border-top:1px solid #0b89de; box-shadow: 0px 3px 8px -1px rgba(0,0,0,0.4); height:142px;">
                <a href="<?php echo base_url(); ?>/report/agent_daily_recharge_report/<?php echo $select_agent[0]->user_id ; ?>"><button data-toggle="tooltip" title="Recharge Detail"  class="btn btn-primary action_panel_bt active" style="width:100%;">Recharge</button></a> 
                <a href="<?php echo base_url(); ?>/report/agent_daily_transaction_report/<?php echo $select_agent[0]->user_id ; ?>"><button data-toggle="tooltip" title="Transaction Detail"  class="btn btn-primary action_panel_bt" style=" width:100%;">Transaction</button></a>
               </div>
           </div>
        </div>
        <div class="container-fluid" style="margin-top:15px;">
            <div class="product-status-wrap mycard" style="padding-top:10px; border-top:2px solid #0099cc;">
			    <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div id="myheadtitle" style="margin:0px; height:60px; border-bottom:none; padding-top:15px; font-size: 15.5px;">
                                Agent Recharge Report <span><i class="ion-android-arrow-dropright" style="color: #0099cc;"></i></span> <?php if(isset($recharge[0]->recharge_date)){ echo date('d-M-Y',strtotime($recharge[0]->recharge_date));}; ?>
								
                        </div>  
						<div class="asset-inner">
							     
                                <table id="table" data-toggle="table" data-pagination="true" data-show-columns="true" data-show-pagination-switch="true" data-show-refresh="true" data-key-events="true" data-show-toggle="true"  data-cookie="true"
                                        data-cookie-id-table="saveId" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">
                                     <thead>
                                     
									<tr>
                                        <th>Sr. No.</th>
                                        <th>Customer Name</th>
                                        <th>Delivery Type</th>
                                        <th>Colony Name</th>
                                        <th>Card No.</th>
								        <th>Recharge Amount</th>
                     
                                    </tr>
                                    
									 </thead>
									 <tbody>
                                     <?php 
                                        
                                         $total = 0;
                                         $i = 1;
                                         foreach($recharge as $row){ ?>
                                       
                                         <tr> 
                                             <td><?php echo $i++; ?></td>
                                             <td><?php echo $row->first_name.' '.$row->last_name; ?></td>
                                             <td><?php echo $row->d_type; ?></td>
                                              <td><?php echo $row->colony_name; ?></td>
                                             <td><?php echo $row->atm_card_no; ?></td>
                                             <td><span class="rs_span">&#8377 </span> <?php echo number_format($row->recharge_amount); ?></td>
                          
                                        </tr>
                                         <?php $total += $row->recharge_amount;  ?>
                                     <?php } ?>    
                                    
									</tbody>
                                     <tfoot>
                                        <tr>
                                             <td style="border:1px solid #dddddd;">Total</td>
                                             <td></td>
                                             <td></td>
                                             <td></td>
                                            <td></td>
                                             <td style="border:1px solid #dddddd;"><span class="rs_span">&#8377 </span> <?php echo number_format($total); ?></td>
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
       
         $(document).on('click','.click_tr',function(){
            var id =  $(this).data("team_id");
            var date = $(this).data("date");
        
             window.location.href = '<?php echo base_url() ?>report/team_detail_report/'+id+'/'+date;
         });
       
       });
    </script>
</body>
</html>