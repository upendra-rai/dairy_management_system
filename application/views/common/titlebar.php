<div class="container-fluid" id="top_titile">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" >
                    <div class="logo-pro" style="float:left;">
                        <img src="<?php echo base_url('catalogs'); ?>/img/logo.png" alt="" width="50" />
                    </div>
                    <div class="logo-pro" style="float:right;">
                        <button  type="button" id="my_nav" class="btn" style="background:transparent; border:none; "><i class="ion-android-apps" style="font-size:26px;"></i></button>
                    </div>
                </div>
            </div>
</div>
<div class="header-advance-area" style="min-height:55px;">
            <div class="header-top-area" style="height:55px;">
                <div class="container-fluid">
                    <div class="row">

                           <div class="search_engine ">
                                    <div class="col-lg-4 col-md-4 col-sm-3 col-xs-12" >
                                        <div class="breadcome-heading" style=" padding: 0px; padding-top:3px;background:transparent; margin-bottom:15px;" >
                                            <!--<h2 class="head_title"> DMS  </h2>-->
                                             <div id="my_count_down">
                                                  <div class="count_box">
                                                 <div style="font-size:12px;">Time Left</div>
                                                 
                                                 </div>
                                                 
                                                 <div class="count_box">
                                                 <div id="day_count">0</div>
                                                 <span class="count_title">Day</span>
                                                 </div>
                                                 
                                                 <div class="count_box">
                                                 <div id="hour_count">0</div>
                                                 <span class="count_title">hour</span>
                                                 </div>
                                                 
                                                 <div class="count_box">
                                                 <div id="min_count">0</div>
                                                 <span class="count_title">Min</span>
                                                 </div>
                                                 <div class="count_box">
                                                 <div id="sec_count">0</div>
                                                 <span class="count_title">Sec</span>
                                                 </div>
                                                 
                                            </div>
                                            
                                        </div>
                                    </div>
                               <div class="col-lg-1 col-md-1 col-sm-12 col-xs-12">
                                   <a href="<?php echo base_url(); ?>/billing/add_billing"><button type="button" class="btn" >POS</button></a>
                                   </div>
                                  
                                   <div class="col-lg-1 col-md-1 col-sm-12 col-xs-12">
                                        <div class="header-right-info">
                                            <ul class="nav navbar-nav mai-top-nav header-right-menu" style="padding:10px 0px; ">
                                                
                                                <li class="nav-item" style=""><a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle" style=""><i class="ion-ios-cart-outline" aria-hidden="true"></i><span class="new_order_span" style="position:absolute; margin-top:-8px; font-size:14px; font-weight:900; line-height:15px; padding:3px; border-radius:2px; background-color:#f13f0a; color:#ffffff;"></span></a>
                                                    <div role="menu" class="notification-author dropdown-menu animated zoomIn" style="overflow:auto; padding-top:0px;">
                                                        <div class="notification-single-top" style="background-color: #46c7fe; color:#ffffff;">
                                                            <a href="<?php echo base_url(); ?>orders/orders"> <h1 style="padding:10px; color:#ffffff;">See All Orders</h1></a>
                                                        </div>
                                                        <ul class="notification-menu" id="order_notification" >
                                                            
                                                           
                                                        </ul>
                                                        <!--<div class="notification-view">
                                                            <a href="#">View All Notification</a>
                                                        </div>-->
                                                    </div>
                                                </li>
                                                
                                               
                                            </ul>
                                        </div>
                               </div>
                               
                               
                                    <div class="col-lg-1 col-md-1 col-sm-12 col-xs-12">
                                        <div class="header-right-info">
                                            <ul class="nav navbar-nav mai-top-nav header-right-menu" style="padding:10px 0px; ">
                                                
                                                <li class="nav-item"><a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle"><i class="ion-ios-bell-outline" aria-hidden="true"></i><span class="admin_noti_span" style="position:absolute; margin-top:-8px; font-size:14px; font-weight:900; line-height:15px; padding:3px; border-radius:2px; background-color:#f13f0a; color:#ffffff;"></span></a>
                                                    <div role="menu" class="notification-author dropdown-menu animated zoomIn" style="overflow:auto; padding-top:0px;">
                                                        <div class="notification-single-top" style="background-color: #46c7fe; color:#ffffff;">
                                                            <a href="<?php echo base_url(); ?>notification/see_all_notification"> <h1 style="padding:10px; color:#ffffff;">See Full Notifications</h1></a>
                                                        </div>
                                                        <ul class="notification-menu" id="admin_notification" >
                                                            
                                                           
                                                        </ul>
                                                        <!--<div class="notification-view">
                                                            <a href="#">View All Notification</a>
                                                        </div>-->
                                                    </div>
                                                </li>
                                                
                                               
                                            </ul>
                                        </div>
                               </div>
                               
                                <div class="col-lg-1 col-md-1 col-sm-12 col-xs-12">
                                        <div class="header-right-info">
                                            <ul class="nav navbar-nav mai-top-nav header-right-menu" style="padding:10px 0px; float:left;">
                                                
                                                <li class="nav-item"><a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle"><i class="ion-ios-email-outline" aria-hidden="true" style="font-size:25px;"></i><span class="feedback_noti_span" style="position:absolute; margin-top:-8px; font-size:14px; font-weight:900; line-height:15px; padding:3px; border-radius:2px; background-color:#ecad1d; color:#ffffff;"></span></a>
                                                    <div role="menu" class="notification-author dropdown-menu animated zoomIn" style="overflow:auto; padding-top:0px;">
                                                        <div class="notification-single-top" style="background-color: #46c7fe; color:#ffffff;">
                                                            <a href="<?php echo base_url(); ?>report/feedback"> <h1 style="padding:10px; color:#ffffff;">See All Feedback</h1></a>
                                                        </div>
                                                        <ul class="notification-menu" id="feedback_notification" >
                                                            
                                                           
                                                        </ul>
                                                        <!--<div class="notification-view">
                                                            <a href="#">View All Notification</a>
                                                        </div>-->
                                                    </div>
                                                </li>
                                                
                                               
                                            </ul>
                                        </div>
                               </div>
                               
									<div class="col-lg-4 col-md-4 col-sm-3 col-xs-12">
                                        <div class="breadcome-heading mycard" style=" padding: 0px;  padding-top:3px; background:transparent;">
                                            <div class="form-group-inner" style=" height:28px; ">
											<div class="row">
											    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4" style=" padding-right:0px;">
                                                    <div class="chosen-select-single" style="width:100%;">
                                                        <select id="select_search" class="chosen-select" tabindex="-1" style="width:100%; height:35px; border: 1px solid #dddddd; padding-left:10px;">
												        		<option value="name">Name</option>
												        		<option value="linked_no">Card No</option>
												        		<option value="colony_id">Colony</option>
												        		<option value="mobile_no">Mobile No</option>

													    </select>
                                                    </div>
											    </div>
                                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                                    <div class="input-group" style=" width:100%;">
                                                        <input type="text" name="search_section" data-card_no="" id="search_name_input" class="form-control" placeholder="Search By Customer Name" style="background-color:#ffffff;" autocomplete="new-password">
														<button type="button"   id="search_bt" class="search_bar_bt"><i class="fa fa-search"></i></button>
                                                    </div>

                                                </div>

                                            </div>
                                               <div class="row" style="position:relative; ">
                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="position:absolute; ">
                                                    <div id="match_result1" class="match_result" style="margin-top:-8px;">
                                                    </div>
                                                   </div>
                                                </div>
										    </div>

                                        </div>
                                    </div>

                            </div>

                    </div>
                </div>
            </div>
            <!-- Mobile Menu start -->
           <!-- <div class="mobile-menu-area">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="mobile-menu">
                                <nav id="dropdown">
                                    <ul class="mobile-menu-nav">

                        <li class="active">
                            <a href="<?php echo base_url() ?>dashboard">
								   <span class="educate-icon educate-home icon-wrap"></span>
								   <span class="mini-click-non">Dashboard</span>
								</a>

                        </li>

                        <li>
                            <a class="has-arrow" href="all-professors.html" aria-expanded="false"><span class="educate-icon educate-professor icon-wrap"></span> <span class="mini-click-non">Customers</span></a>
                            <ul class="submenu-angle" aria-expanded="false">
                                <li><a title="All Professors" href="<?php echo base_url(); ?>customer/add_customer"><span class="mini-sub-pro">Add Customers</span></a></li>
                                <li><a title="Add Professor" href="<?php echo base_url(); ?>customer/list_customer"><span class="mini-sub-pro">Update Customers</span></a></li>


                            </ul>
                        </li>


						<li>
                            <a href="<?php echo base_url(); ?>team" aria-expanded="false"><span class="educate-icon educate-course icon-wrap"></span> <span class="mini-click-non">Manage Team</span></a>

                        </li>
                        <li>
                            <a class="has-arrow"  href="all-courses.html" aria-expanded="false"><span class="educate-icon educate-library icon-wrap"></span> <span class="mini-click-non">Report</span></a>
                           <ul class="submenu-angle" aria-expanded="false">
                                <li><a title="All Professors" href="<?php echo base_url(); ?>report/customer_report"><span class="mini-sub-pro">Customer Report</span></a></li>
                                <li><a title="Add Professor" href="<?php echo base_url(); ?>report/transaction_report"><span class="mini-sub-pro">Transaction Report</span></a></li>
                                <li><a title="Add Professor" href="<?php echo base_url(); ?>report/recharge_report"><span class="mini-sub-pro">Recharge Report</span></a></li>
                                <li><a title="Add Professor" href="<?php echo base_url(); ?>report/agent_report"><span class="mini-sub-pro">Agent Report</span></a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="<?php echo base_url(); ?>dashboard/profile" aria-expanded="false"><span class="educate-icon educate-department icon-wrap"></span> <span class="mini-click-non">Change Password</span></a>

                        </li>

                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>-->
            <!-- Mobile Menu end -->

          <nav class="mobo_menu" style="overflow: auto;">
                    <ul class="mobo_menu_box" class="nav navbar-nav menu">
					    <li><a href="<?php echo base_url() ?>dashboard">Home</a></li>
						<li>
                            <a href="<?php echo base_url() ?>map_location">
                           Track Location
                           </a>
                        </li>
                        <li><a href="<?php echo base_url(); ?>customer/add_customer">Add Customer</a></li>
                        
                        <li style="border:1px solid #46c7fe;"></li>
                        
                         <li><a href="<?php echo base_url(); ?>category/add_category">Add Category</a></li>
                         <li><a href="<?php echo base_url(); ?>subcategory/add_subcategory">Add Sub Category</a></li>
                         <li><a href="<?php echo base_url(); ?>product_e/add_product">Add Product</a></li>
                         <li><a href="<?php echo base_url(); ?>product_e/list_product">List Product</a></li>
                        
						<li style="border:1px solid #46c7fe;"></li>
						
                         <li><a href="<?php echo base_url(); ?>orders/orders">Orders</a></li>
                         <li><a href="<?php echo base_url(); ?>orders/pending_orders">Pending Orders</a></li>
                         <li><a href="<?php echo base_url(); ?>orders/placed_orders">Placed Orders</a></li>
                         <li><a href="<?php echo base_url(); ?>orders/delivered_orders">Completed Orders</a></li>
                         <li><a href="<?php echo base_url(); ?>orders/canceled_orders">Canceled Orders</a></li>
						<li style="border:1px solid #46c7fe;"></li>
						
						<li><a href="<?php echo base_url(); ?>team">Manage Team</a></li>
						<li><a href="<?php echo base_url(); ?>supplyer">Manage Supplier</a></li>
						
                        <li><a href="<?php echo base_url(); ?>product">Manage Product</a></li>
                        <li><a href="<?php echo base_url(); ?>colony">Manage Colonies</a></li>
                        <li><a href="<?php echo base_url(); ?>recharge_limit/recharge_limit">Set Recharge Limit</a></li>
                        <li><a href="<?php echo base_url(); ?>report/change_atm_card_status">Change Card Status</a></li>
						
						<li><a href="<?php echo base_url(); ?>report/customer_orders_list">Manage Requirements</a></li>
						
						<li style="border:1px solid #46c7fe;"></li>
                        
                         <li><a href="<?php echo base_url(); ?>parameter/add_unit">Add Unit</a></li>
                         <li><a href="<?php echo base_url(); ?>parameter/add_gst">Add GST Category</a></li>
                         <li><a href="<?php echo base_url(); ?>parameter/manage_service_charge">Service Charge</a></li>
                         <li><a href="<?php echo base_url(); ?>promo_code/promocode">Promo Code</a></li>
                        <li><a href="<?php echo base_url(); ?>points/point_settings">Points</a></li>
                        
						<li style="border:1px solid #46c7fe;"></li>
                        
                        
                        
						<li><a href="<?php echo base_url(); ?>/inventory/add_purchase/<?php date_default_timezone_set('Asia/Kolkata'); echo date('Y-m-d'); ?>">Add Purchase</a></li>
                          
                         <li><a href="<?php echo base_url(); ?>/inventory/dairy_stock/<?php date_default_timezone_set('Asia/Kolkata'); echo date('Y-m-d'); ?>">Manage Dairy Stock</a></li>
                         <li><a href="<?php echo base_url(); ?>/inventory/assign_agent_stock/00-00-0000/0">Assign Agent Stock</a></li>
                         <li><a  href="<?php echo base_url(); ?>/inventory/return_stock/<?php date_default_timezone_set('Asia/Kolkata'); echo date('Y-m-d'); ?>">Accept Returned Stock</a></li>
                         <li><a href="<?php echo base_url(); ?>/inventory/transfer_agent_stock">Transfer Stock</a></li>
						 
						 <li style="border:1px solid #46c7fe;"></li>

                        <li><a href="<?php echo base_url(); ?>report/customer_report">Customer Report</a></li>
                        <li><a href="<?php echo base_url(); ?>report/transaction_report">Sales Report</a></li>
                        <li><a href="<?php echo base_url(); ?>report/recharge_report">Recharge Report</a></li>
                        <li><a href="<?php echo base_url(); ?>report/atm_card_report">Atm Card Report</a></li>
						
						
						
						<li><a href="<?php echo base_url(); ?>report/daily_requirement_report">Requirement Report</a></li>
                         <li><a href="<?php echo base_url(); ?>report/admin_purchase_report">Purchase Report</a></li>
                         <li><a href="<?php echo base_url(); ?>report/admin_production_report">Production Report</a></li>
                         <li><a href="<?php echo base_url(); ?>report/customer_ledger">Customer Ledger</a></li>
						  <li><a href="<?php echo base_url(); ?>inventory/agent_stock_report">Agent Stock Report</a></li>
                          <li><a href="<?php echo base_url(); ?>report/order_report">Order Report</a></li>
                          <li><a href="<?php echo base_url(); ?>report/feedback">Feedback Report</a></li>
                        
						 <li style="border:1px solid #46c7fe;"></li>
                        
                         <li><a href="<?php echo base_url(); ?>app_banner/add">Manage Banner</a></li>
                         <li><a href="<?php echo base_url(); ?>offer_banner/add">Offer Banner</a></li>
                         
                         <li style="border:1px solid #46c7fe;"></li>
                        
                         <li><a href="<?php echo base_url(); ?>notification/notification">Send Notification</a></li>
                         <li><a href="<?php echo base_url(); ?>promo_code/send_promo_code_section">Send Promocode</a></li>
                        
						<li style="border:1px solid #46c7fe;"></li>
                        <li><a href="<?php echo base_url(); ?>dashboard/backup">Backup</a></li>
                        <li><a href="<?php echo base_url(); ?>dashboard/profile">Change Password</a></li>
                        <li><a href="<?php echo base_url(); ?>dashboard/logout">Logout</a></li>


                    </ul>
            </nav>
</div>
