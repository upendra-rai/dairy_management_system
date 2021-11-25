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
    .click_tr:hover{
        cursor: pointer;
    }
</style>

</head>

<body>
    <?php $this->load->view('common/sidemenu'); ?>
    <div class="all-content-wrapper">
        
        <?php $this->load->view('common/titlebar'); ?>
		
		
		<div class="container-fluid" style="margin-top:15px;">
            <div class="product-status-wrap mycard" style="padding-top:10px; border-top:2px solid #0099cc;">
			    <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div id="myheadtitle" style="margin:0px; height:60px; border-bottom:none; padding-top:15px; font-size: 15.5px;">
                              Agent Report
							
                        </div>  
						<div class="asset-inner">
							   
                                <table id="table" data-toggle="table" data-pagination="true" data-search="true" data-show-columns="true" data-show-pagination-switch="true" data-show-refresh="true" data-key-events="true" data-show-toggle="true"  data-cookie="true"
                                        data-cookie-id-table="saveId" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">
                                     <thead>
                                     
									<tr>
                                       
                                        <th>Name</th>
								        <th>Email Id</th>
                                        <th>Role</th>
                                        <th>Mobile No.</th>
                                        <th>Ragistration date</th>
                                     
                                    </tr>
                                    
									 </thead>
									 <tbody>
                                     <?php foreach($daily_report as $row){ ?>
                                       
                                         <tr class="click_tr" data-team_id="<?php echo $row->user_id ; ?>">
                                            
                                             <td><?php echo $row->name ; ?></td>
                                             <td><?php echo $row->email; ?></td>
                                             <td><?php echo $row->role; ?></td>
                                             <td><?php echo $row->contact; ?></td>
                                             <td><?php echo date('d-M-Y',strtotime($row->ragistration_date)); ?></td>
                                             
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
		
    <script type="text/javascript">
       $(document).ready(function(){
       
         $(document).on('click','.click_tr',function(){
             
            var href = $(this).data("team_id");
        
             window.location.href = '<?php echo base_url() ?>report/agent_daily_recharge_report/'+href;
         });
       
       });
    </script>
</body>
</html>