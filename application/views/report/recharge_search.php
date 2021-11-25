<!doctype html>
<html class="no-js" lang="en">

<head>
   <?php $this->load->view('common/header_link'); ?>
   <link rel="stylesheet" href="<?php echo base_url('catalogs'); ?>/css/c3/c3.min.css">
   <!-- touchspin CSS
		============================================ -->
	<link rel="stylesheet" href="<?php echo base_url('catalogs'); ?>/css/touchspin/jquery.bootstrap-touchspin.min.css">	
</head>

<body>
    <?php $this->load->view('common/sidemenu'); ?>
    <div class="all-content-wrapper">
        
        <?php $this->load->view('common/titlebar'); ?>
		<div class="product-status mg-b-15" style="margin-top: 35px; ">
            <div class="container-fluid">
				<div class="row">
				    <div class="search_engine ">
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="breadcome-heading mycard">
                                <form role="search" class="sr-input-func">
                                    <input type="text" placeholder="Search By Card No." class="form-control search_input">
                                    <a href="#"><i class="fa fa-search"></i></a>
                                </form>
                            </div>
                        </div>
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="breadcome-heading mycard">
                                <form role="search" class="sr-input-func">
                                    <input type="text" placeholder="Search By Mobile No" class="form-control search_input">
                                    <a href="#"><i class="fa fa-search"></i></a>
                                </form>
                            </div>
                        </div>
                    </div>		
				</div>
            </div>	
        </div>
		
		<div class="container-fluid" style="margin-top:35px;">
            <div class="product-status-wrap mycard">
			    <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div id="myheadtitle" style=" ">
                               Customer List
								<ul class="my_quick_bt" style="">
                                    <li>
                                        <a id="loc_home" href="javascript:void(0);">
                                            <i class="ion-ios-home-outline"></i>
                                        </a>
                                    </li>     
                                    <li>
                                        <a id="loc_back" href="javascript:void(0);">
                                            <i class="ion-ios-undo-outline"></i>
                                        </a>
                                    </li>
                                </ul>
                        </div>  
						<div class="asset-inner">
							       <div id="toolbar">
                                        <select class="form-control dt-tb">
											<option value="">Export Basic</option>
											<option value="all">Export All</option>
											<option value="selected">Export Selected</option>
										</select>
                                    </div>
                                <table id="table" data-toggle="table" data-pagination="true" data-search="true" data-show-columns="true" data-show-pagination-switch="true" data-show-refresh="true" data-key-events="true" data-show-toggle="true"  data-cookie="true"
                                        data-cookie-id-table="saveId" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">
                                     <thead>
									<tr>
                                        <th>No</th>
                                       
                                        <th>Customer Name</th>
										 <th>Ragister Date</th>
                                        <th>Email Address</th>
                                        <th>Card No.</th>
										<th>Status</th>
                                        <th>Recharge</th>
                                        
                                    </tr>
									 </thead>
									 <tbody>
                                    <tr>
                                        <td>1</td>
                                     
                                        <td>Aayush Shrivastava</td>
                                        <td>20-06-2019</td>
                                        <td>demo@gmail.com</td>
                                        <td>S102365</td>
										<td><div class="st_active">active</div></td>
                                        <td>
										   <a href="<?php echo base_url(); ?>/recharge/recharge_account"> <button data-toggle="tooltip" title="Edit" class="pd-setting-ed myedit">RECHARGE</button></a>
                                           
                                        </td>
										
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        
										<td>Aayush Shrivastava</td>
                                        <td>20-06-2019</td>
                                        <td>demo@gmail.com</td>
                                        <td>S102365</td>
										<td><div class="st_deactive">Deactive</div></td>
                                       <td>
										   <a href="<?php echo base_url(); ?>/recharge/recharge_limit"> <button data-toggle="tooltip" title="Edit" class="pd-setting-ed myedit">RECHARGE</button></a>
                                           
                                        </td>
										
                                    </tr>
									<tr>
                                        <td>1</td>
                                        
										<td>Aayush Shrivastava</td>
                                        <td>20-06-2019</td>
                                        <td>demo@gmail.com</td>
                                        <td>S102365</td>
										<td><div class="st_active">active</div></td>
                                        <td>
										   <a href="<?php echo base_url(); ?>/recharge/recharge_limit"> <button data-toggle="tooltip" title="Edit" class="pd-setting-ed myedit">RECHARGE</button></a>
                                           
                                        </td>
										
                                    </tr>
									<tr>
                                        <td>1</td>
                                        
										<td>Aayush Shrivastava</td>
                                        <td>20-06-2019</td>
                                        <td>demo@gmail.com</td>
                                        <td>S102365</td>
										<td><div class="st_active">active</div></td>
                                        <td>
										   <a href="<?php echo base_url(); ?>/recharge/recharge_limit"> <button data-toggle="tooltip" title="Edit" class="pd-setting-ed myedit">RECHARGE</button></a>
                                           
                                        </td>
										
                                    </tr>
									<tr>
                                        <td>1</td>
                                        
										<td>Aayush Shrivastava</td>
                                        <td>20-06-2019</td>
                                        <td>demo@gmail.com</td>
                                        <td>S102365</td>
										<td><div class="st_deactive">Deactive</div></td>
                                        <td>
										   <a href="<?php echo base_url(); ?>/recharge/recharge_limit"> <button data-toggle="tooltip" title="Edit" class="pd-setting-ed myedit">RECHARGE</button></a>
                                           
                                        </td>
										
                                    </tr>
									</tbody>
								</table>
                            </div>
                            <div class="custom-pagination">
								<ul class="pagination">
									<li class="page-item"><a class="page-link" href="#">Previous</a></li>
									<li class="page-item"><a class="page-link" href="#">1</a></li>
									<li class="page-item"><a class="page-link" href="#">2</a></li>
									<li class="page-item"><a class="page-link" href="#">3</a></li>
									<li class="page-item"><a class="page-link" href="#">Next</a></li>
								</ul>
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
		
    
</body>
</html>