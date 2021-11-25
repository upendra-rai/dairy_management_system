<div class="left-sidebar-pro" >
        <nav id="sidebar" class="" style="padding-top:0px;">

            <div class="left-custom-menu-adp-wrap comment-scrollbar" style="height: 100vh;">
                <nav class="sidebar-nav left-sidebar-menu-pro">
                    <ul class="metismenu" id="menu1">
					 <li class="profile_li" style="height:55px; padding:5px; background-color:#232323;"> 
                           
                         <img src="<?php echo base_url('catalogs'); ?>/img/logo.png" alt="" style="border-radius:0px;  width:44px; height:44px; border-radius:10px; margin-top:3px;"/><span style="position: absolute; top:17px; left:68px;"><?php if($this->session->userdata('title')){  echo $this->session->userdata('title'); } ?> </span>
                         <button type="button" id="profile_bt" style="position:absolute; top:15px;  background:transparent; border:none; right:15px;"><i class="ion-ios-arrow-down"></i></button>
                          <!-- <div class="profile_head" style=" width: 100%; height:60px; top:5; left:0; position: absolute; border-radius:0px; text-align:center;">
							<img src="<?php echo base_url('catalogs'); ?>/img/logo.png" alt="" style="border-radius:0px; width:60px; height:60px;"/>

							</div> -->
                            <p style="margin-top: 65px;"><button type="button" id="profile_bt" style="position:absolute; background:transparent; border:none;"><i class="ion-ios-arrow-down"></i></button><br><span>Admin</span></p>
							<div class="profile_menu">

                                <div class="div_li" id="profile_div_bt">Profile</div>
                                <div class="div_li" id="logout_div_bt">Logout</div>

                            </div>
                        </li> 
                        <li class="<?php if($active_menu == 'home'){ echo 'active'; } ?>">
                            <a href="<?php echo base_url() ?>dashboard">
								             <span class="ion-ios-home m_icon"></span>
								             <span class="mini-click-non">Dashboard</span>
							             	</a>
                        </li>
                        <li class="<?php if($active_menu == 'map_location'){ echo 'active'; } ?>">
                            <a href="<?php echo base_url() ?>map_location">
                            <span class="ion-ios-location m_icon"></span>
                            <span class="mini-click-non">Track Location</span>
                           </a>
                        </li>

                        <li class="<?php if($active_menu == 'customer'){ echo 'active'; } ?>">
                            <a href="<?php echo base_url() ?>customer/add_customer">
								   <span class="ion-ios-contact-outline m_icon"></span>
								   <span class="mini-click-non">Add Customer</span>
								</a>

                        </li>
                        <li class="<?php if($active_menu == 'e_product'){ echo 'active'; } ?>">
                            <a class="has-arrow"  href="all-courses.html" aria-expanded="<?php if($active_menu == 'e_product'){ echo 'true'; }else{ echo 'false';} ?>"><span class="ion-pie-graph m_icon"></span> <span class="mini-click-non">Crud Operation jquery</span></a>
                           <ul class="submenu-angle <?php if($active_menu == 'e_product'){ echo 'show'; }else{ echo '';} ?>" aria-expanded="false" style="padding:0px; margin:0px;">
                               
                                <li class="<?php if(isset($active_submenu) && $active_submenu == 'emp_details'){ echo 'active_submenu'; } ?>"><a title="All Professors" href="<?php echo base_url(); ?>emp/emp_details"><span class="mini-sub-pro">Employee </span></a></li>
 
                            </ul>
                        </li>
                        
                        
                        <li class="<?php if($active_menu == 'expanse'){ echo 'active'; } ?>">
                            <a class="has-arrow"  href="all-courses.html" aria-expanded="<?php if($active_menu == 'expanse'){ echo 'true'; }else{ echo 'false';} ?>"><span class="ion-pie-graph m_icon"></span> <span class="mini-click-non">Expanse</span></a>
                           <ul class="submenu-angle <?php if($active_menu == 'expanse'){ echo 'show'; }else{ echo '';} ?>" aria-expanded="false" style="padding:0px; margin:0px;">
                                <li class="<?php if(isset($active_submenu) && $active_submenu == 'add_expanse_head'){ echo 'active_submenu'; } ?>"><a title="All Professors" href="<?php echo base_url(); ?>expanse_head/add_category"><span class="mini-sub-pro">Expanse Head </span></a></li>
                                <li class="<?php if(isset($active_submenu) && $active_submenu == 'add_expanse_subhead'){ echo 'active_submenu'; } ?>"><a title="Add Professor" href="<?php echo base_url(); ?>expanse_subhead/add_subcategory"><span class="mini-sub-pro">Expanse Sub Head</span></a></li>
                                <li class="<?php if(isset($active_submenu) && $active_submenu == 'add_expanse'){ echo 'active_submenu'; } ?>"><a title="All Professors" href="<?php echo base_url(); ?>expanse/add_expanse">Add Expanse</a></li>
                               
                               <li class="<?php if(isset($active_submenu) && $active_submenu == 'list_expanse'){ echo 'active_submenu'; } ?>"><a title="All Professors" href="<?php echo base_url(); ?>expanse/list_expanse">List Expanse</a></li>
                                

                               <!--<li class="<?php if(isset($active_submenu) && $active_submenu == 'assign_location'){ echo 'active_submenu'; } ?>"><a title="Add Professor" href="<?php echo base_url(); ?>team/assign_location"><span class="mini-sub-pro">Assign Location</span></a></li> -->
                            </ul>
                        </li>
                        
                        
                         <li class="<?php if($active_menu == 'e_product'){ echo 'active'; } ?>">
                            <a class="has-arrow"  href="all-courses.html" aria-expanded="<?php if($active_menu == 'e_product'){ echo 'true'; }else{ echo 'false';} ?>"><span class="ion-pie-graph m_icon"></span> <span class="mini-click-non">E Product</span></a>
                           <ul class="submenu-angle <?php if($active_menu == 'e_product'){ echo 'show'; }else{ echo '';} ?>" aria-expanded="false" style="padding:0px; margin:0px;">
                                <li class="<?php if(isset($active_submenu) && $active_submenu == 'add_category'){ echo 'active_submenu'; } ?>"><a title="All Professors" href="<?php echo base_url(); ?>category/add_category"><span class="mini-sub-pro">Add Category </span></a></li>
                                <li class="<?php if(isset($active_submenu) && $active_submenu == 'add_subcategory'){ echo 'active_submenu'; } ?>"><a title="Add Professor" href="<?php echo base_url(); ?>subcategory/add_subcategory"><span class="mini-sub-pro">Add Sub Category</span></a></li>
                                <li class="<?php if(isset($active_submenu) && $active_submenu == 'add_product'){ echo 'active_submenu'; } ?>"><a title="All Professors" href="<?php echo base_url(); ?>product/add_product">Add Product</a></li>
                                
                                
                                <li class="<?php if(isset($active_submenu) && $active_submenu == 'list_product'){ echo 'active_submenu'; } ?>"><a title="Add Professor" href="<?php echo base_url(); ?>product/list_product"><span class="mini-sub-pro">List Product</span></a></li>
                               

                               <!--<li class="<?php if(isset($active_submenu) && $active_submenu == 'assign_location'){ echo 'active_submenu'; } ?>"><a title="Add Professor" href="<?php echo base_url(); ?>team/assign_location"><span class="mini-sub-pro">Assign Location</span></a></li> -->
                            </ul>
                        </li>
                        
                        

                        <li class="<?php if($active_menu == 'orders'){ echo 'active'; } ?>">
                            <a class="has-arrow"  href="all-courses.html" aria-expanded="<?php if($active_menu == 'special_orders'){ echo 'true'; }else{ echo 'false';} ?>"><span class="ion-ios-cart m_icon"></span> <span class="mini-click-non">Orders</span></a>
                           <ul class="submenu-angle <?php if($active_menu == 'orders'){ echo 'show'; }else{ echo '';} ?>" aria-expanded="false" style="padding:0px; margin:0px;">
                               
                               <!-- <li class="<?php if(isset($active_submenu) && $active_submenu == 'add_order'){ echo 'active_submenu'; } ?>"><a title="All Professors" href="<?php echo base_url(); ?>orders/add_order">Add Order</a></li> -->
                               
                                <li class="<?php if(isset($active_submenu) && $active_submenu == 'orders'){ echo 'active_submenu'; } ?>"><a title="All Professors" href="<?php echo base_url(); ?>orders/orders"><span class="mini-sub-pro">Orders  <span class="menu_counting_span" id="new_orders_count_span" style="display:none; background-color:#00a22d;">  </span></span></a></li>
                               <li class="<?php if(isset($active_submenu) && $active_submenu == 'pending_orders'){ echo 'active_submenu'; } ?>"><a title="All Professors" href="<?php echo base_url(); ?>orders/pending_orders"><span class="mini-sub-pro">Pending Orders  <span class="menu_counting_span" id="new_orders_count_span" style="display:none; background-color:#00a22d;">  </span></span></a></li>
                                <li class="<?php if(isset($active_submenu) && $active_submenu == 'placed_orders'){ echo 'active_submenu'; } ?>"><a title="Add Professor" href="<?php echo base_url(); ?>orders/placed_orders"><span class="mini-sub-pro">Placed Orders</span></a></li>
                                <li class="<?php if(isset($active_submenu) && $active_submenu == 'delivered_orders'){ echo 'active_submenu'; } ?>"><a title="Add Professor" href="<?php echo base_url(); ?>orders/delivered_orders"><span class="mini-sub-pro">Completed Orders</span></a></li>
                                <li class="<?php if(isset($active_submenu) && $active_submenu == 'canceled_orders'){ echo 'active_submenu'; } ?>"><a title="Add Professor" href="<?php echo base_url(); ?>orders/canceled_orders"><span class="mini-sub-pro">Canceled Orders</span></a></li>

                               <!--<li class="<?php if(isset($active_submenu) && $active_submenu == 'assign_location'){ echo 'active_submenu'; } ?>"><a title="Add Professor" href="<?php echo base_url(); ?>team/assign_location"><span class="mini-sub-pro">Assign Location</span></a></li> -->
                            </ul>
                        </li>

                        <li class="<?php if($active_menu == 'management'){ echo 'active'; } ?>">
                            <a class="has-arrow"  href="all-courses.html" aria-expanded="<?php if($active_menu == 'report'){ echo 'true'; }else{ echo 'false';} ?>"><span class="ion-wrench m_icon"></span> <span class="mini-click-non">Mgt options</span></a>
                           <ul class="submenu-angle <?php if($active_menu == 'management'){ echo 'show'; }else{ echo '';} ?>" aria-expanded="false" style="padding:0px; margin:0px;">
                                <li class="<?php if(isset($active_submenu) && $active_submenu == 'team'){ echo 'active_submenu'; } ?>"><a title="All Professors" href="<?php echo base_url(); ?>team"><span class="mini-sub-pro">Manage Team</span></a></li>
                                <li class="<?php if(isset($active_submenu) && $active_submenu == 'supplyer'){ echo 'active_submenu'; } ?>"><a title="All Professors" href="<?php echo base_url(); ?>supplyer"><span class="mini-sub-pro">Manage Supplyer</span></a></li>
                                <li class="<?php if(isset($active_submenu) && $active_submenu == 'product'){ echo 'active_submenu'; } ?>"><a title="Add Professor" href="<?php echo base_url(); ?>product"><span class="mini-sub-pro">Manage Products</span></a></li>
                                <li class="<?php if(isset($active_submenu) && $active_submenu == 'colony'){ echo 'active_submenu'; } ?>"><a title="Add Professor" href="<?php echo base_url(); ?>colony"><span class="mini-sub-pro">Manage Colonies</span></a></li>
                                <li class="<?php if(isset($active_submenu) && $active_submenu == 'recharge_limit'){ echo 'active_submenu'; } ?>"><a title="Add Professor" href="<?php echo base_url(); ?>recharge_limit/recharge_limit"><span class="mini-sub-pro">Set Recharge Limit</span></a></li>
                                <li class="<?php if(isset($active_submenu) && $active_submenu == 'atm_card_status'){ echo 'active_submenu'; } ?>"><a title="Add Professor" href="<?php echo base_url(); ?>report/change_atm_card_status"><span class="mini-sub-pro">Change Card Status</span></a></li>
                                <li class="<?php if(isset($active_submenu) && $active_submenu == 'customer_orders_list'){ echo 'active_submenu'; } ?>"><a title="Add Professor" href="<?php echo base_url(); ?>report/customer_orders_list"><span class="mini-sub-pro">Manage Requirements</span></a></li>

                               <!--<li class="<?php if(isset($active_submenu) && $active_submenu == 'assign_location'){ echo 'active_submenu'; } ?>"><a title="Add Professor" href="<?php echo base_url(); ?>team/assign_location"><span class="mini-sub-pro">Assign Location</span></a></li> -->
                            </ul>
                        </li>
                        
                         <li class="<?php if($active_menu == 'parameter'){ echo 'active'; } ?>">
                            <a class="has-arrow"  href="all-courses.html" aria-expanded="<?php if($active_menu == 'parameter'){ echo 'true'; }else{ echo 'false';} ?>"><span class="ion-toggle-filled m_icon"></span> <span class="mini-click-non">Mgt Parameter</span></a>
                           <ul class="submenu-angle <?php if($active_menu == 'special_orders'){ echo 'show'; }else{ echo '';} ?>" aria-expanded="false" style="padding:0px; margin:0px;">
                                <li class="<?php if(isset($active_submenu) && $active_submenu == 'add_unit'){ echo 'active_submenu'; } ?>"><a title="All Professors" href="<?php echo base_url(); ?>parameter/add_unit"><span class="mini-sub-pro">Add Unit </span></a></li>
                                <li class="<?php if(isset($active_submenu) && $active_submenu == 'add_gst'){ echo 'active_submenu'; } ?>"><a title="Add Professor" href="<?php echo base_url(); ?>parameter/add_gst"><span class="mini-sub-pro">Add GST</span></a></li>
                               
                                <li class="<?php if(isset($active_submenu) && $active_submenu == 'service_charge'){ echo 'active_submenu'; } ?>"><a title="All Professors" href="<?php echo base_url(); ?>parameter/manage_service_charge">Service Charge</a></li>
                                
                                
                                <li class="<?php if(isset($active_submenu) && $active_submenu == 'promo_code'){ echo 'active_submenu'; } ?>"><a title="Add Professor" href="<?php echo base_url(); ?>promo_code/promocode"><span class="mini-sub-pro">Promo Code</span></a></li>
                               
                                <li class="<?php if(isset($active_submenu) && $active_submenu == 'point_setting'){ echo 'active_submenu'; } ?>"><a title="Add Professor" href="<?php echo base_url(); ?>points/point_settings"><span class="mini-sub-pro">Ponits</span></a></li>
                               
                               
                               
                            </ul>
                        </li>
                        
                        
                        <li class="<?php if($active_menu == 'report'){ echo 'active'; } ?>">
                            <a class="has-arrow"  href="all-courses.html" aria-expanded="<?php if($active_menu == 'report'){ echo 'true'; }else{ echo 'false';} ?>"><span class="ion-stats-bars m_icon"></span> <span class="mini-click-non">Reports</span></a>
                           <ul class="submenu-angle <?php if($active_menu == 'report'){ echo 'show'; }else{ echo '';} ?>" aria-expanded="false" style="padding:0px; margin:0px;">
                                <li class="<?php if(isset($active_submenu) && $active_submenu == 'customer'){ echo 'active_submenu'; } ?>"><a title="All Professors" href="<?php echo base_url(); ?>report/customer_report"><span class="mini-sub-pro">Customer Report</span></a></li>
                                <li class="<?php if(isset($active_submenu) && $active_submenu == 'tran_report'){ echo 'active_submenu'; } ?>"><a title="Add Professor" href="<?php echo base_url(); ?>report/transaction_report"><span class="mini-sub-pro">Sales Report</span></a></li>
                                <li class="<?php if(isset($active_submenu) && $active_submenu == 'rech_report'){ echo 'active_submenu'; } ?>"><a title="Add Professor" href="<?php echo base_url(); ?>report/recharge_report"><span class="mini-sub-pro">Recharge Report</span></a></li>
                               
                                <li class="<?php if(isset($active_submenu) && $active_submenu == 'bill_report'){ echo 'active_submenu'; } ?>"><a title="Add Professor" href="<?php echo base_url(); ?>report/bill_report"><span class="mini-sub-pro">Bill Report</span></a></li>
                                <!--<li class="<?php if(isset($active_submenu) && $active_submenu == 'age_report'){ echo 'active_submenu'; } ?>"><a title="Add Professor" href="<?php echo base_url(); ?>report/agent_report"><span class="mini-sub-pro">Agent Report</span></a></li>-->
                                <li class="<?php if(isset($active_submenu) && $active_submenu == 'atm_card_report'){ echo 'active_submenu'; } ?>"><a title="Add Professor" href="<?php echo base_url(); ?>report/atm_card_report"><span class="mini-sub-pro">Atm Card Report</span></a></li>

                               <!--<li class="<?php if(isset($active_submenu) && $active_submenu == 'inventory_report'){ echo 'active_submenu'; } ?>"><a title="Add Professor" href="<?php echo base_url(); ?>inventory/inventory_report"><span class="mini-sub-pro">Inventory Report</span></a></li> -->


                               <li class="<?php if(isset($active_submenu) && $active_submenu == 'daily_requirement_report'){ echo 'active_submenu'; } ?>"><a title="Add Professor" href="<?php echo base_url(); ?>report/daily_requirement_report"><span class="mini-sub-pro">Requirement Report</span></a></li>
                                 <li class="<?php if(isset($active_submenu) && $active_submenu == 'admin_purchase_report'){ echo 'active_submenu'; } ?>"><a title="Add Professor" href="<?php echo base_url(); ?>report/admin_purchase_report"><span class="mini-sub-pro">Purchase Report</span></a></li>
                                <li class="<?php if(isset($active_submenu) && $active_submenu == 'admin_production_report'){ echo 'active_submenu'; } ?>"><a title="Add Professor" href="<?php echo base_url(); ?>report/admin_production_report"><span class="mini-sub-pro">Production Report</span></a></li>
                               <li class="<?php if(isset($active_submenu) && $active_submenu == 'customer_ledger'){ echo 'active_submenu'; } ?>"><a title="Add Professor" href="<?php echo base_url(); ?>report/customer_ledger"><span class="mini-sub-pro">Customer Ledger</span></a></li>




                              <li class="<?php if(isset($active_submenu) && $active_submenu == 'dairy_stock_report'){ echo 'active_submenu'; } ?>"><a title="Add Professor" href="<?php echo base_url(); ?>inventory/stock_report"><span class="mini-sub-pro">Dairy Stock Report</span></a></li> 
                               <li class="<?php if(isset($active_submenu) && $active_submenu == 'agent_stock_report'){ echo 'active_submenu'; } ?>"><a title="Add Professor" href="<?php echo base_url(); ?>inventory/agent_stock_report"><span class="mini-sub-pro">Agent Stock Report</span></a></li>
                               <li class="<?php if(isset($active_submenu) && $active_submenu == 'order_report'){ echo 'active_submenu'; } ?>"><a title="Add Professor" href="<?php echo base_url(); ?>report/order_report"><span class="mini-sub-pro">Order Report</span></a></li>
                               
                                <li class="<?php if(isset($active_submenu) && $active_submenu == 'feedback'){ echo 'active_submenu'; } ?>"><a title="Add Professor" href="<?php echo base_url(); ?>report/feedback"><span class="mini-sub-pro">Feedback Report</span></a></li>
                               
                               <li class="<?php if(isset($active_submenu) && $active_submenu == 'profit_report'){ echo 'active_submenu'; } ?>"><a title="Add Professor" href="<?php echo base_url(); ?>report/profit_report"><span class="mini-sub-pro">Profit Report</span></a></li>

                            </ul>
                        </li>

                         <li class="<?php if($active_menu == 'inventory'){ echo 'active'; } ?>">
                            <a class="has-arrow"  href="all-courses.html" aria-expanded="<?php if($active_menu == 'report'){ echo 'true'; }else{ echo 'false';} ?>"><span class="ion-pie-graph m_icon"></span> <span class="mini-click-non">Inventory</span></a>
                           <ul class="submenu-angle <?php if($active_menu == 'inventory'){ echo 'show'; }else{ echo '';} ?>" aria-expanded="false" style="padding:0px; margin:0px;">
                              <!-- <li class="<?php if(isset($active_submenu) && $active_submenu == 'add_production'){ echo 'active_submenu'; } ?>"><a title="Add Professor" href="<?php echo base_url(); ?>/inventory/add_production/00-00-0000"><span class="mini-sub-pro">Add Production</span></a></li>  -->
                               <li class="<?php if(isset($active_submenu) && $active_submenu == 'add_purchase'){ echo 'active_submenu'; } ?>"><a title="Add Professor" href="<?php echo base_url(); ?>/inventory/add_purchase/<?php date_default_timezone_set('Asia/Kolkata'); echo date('Y-m-d'); ?>"><span class="mini-sub-pro">Add Purchase</span></a></li>
                              <!-- <li class="<?php if(isset($active_submenu) && $active_submenu == 'add_purchase'){ echo 'active_submenu'; } ?>"><a title="Add Professor" href="<?php echo base_url(); ?>/inventory/create_products/<?php echo date('Y-m-d'); ?>"><span class="mini-sub-pro">Create Products</span></a></li> -->

                               <li class="<?php if(isset($active_submenu) && $active_submenu == 'inventory'){ echo 'active_submenu'; } ?>"><a title="Add Professor" href="<?php echo base_url(); ?>/inventory/dairy_stock/<?php date_default_timezone_set('Asia/Kolkata'); echo date('Y-m-d'); ?>"><span class="mini-sub-pro">Manage Dairy Stock</span></a></li>
                               <li class="<?php if(isset($active_submenu) && $active_submenu == 'assign_inventory'){ echo 'active_submenu'; } ?>"><a title="Add Professor" href="<?php echo base_url(); ?>/inventory/assign_agent_stock/00-00-0000/0"><span class="mini-sub-pro">Assign Agent Stock</span></a></li>
                               <li class="<?php if(isset($active_submenu) && $active_submenu == 'return_inventory'){ echo 'active_submenu'; } ?>"><a title="Add Professor" href="<?php echo base_url(); ?>/inventory/return_stock/<?php date_default_timezone_set('Asia/Kolkata'); echo date('Y-m-d'); ?>"><span class="mini-sub-pro">Accept Returned Stock</span></a></li>
                               <li class="<?php if(isset($active_submenu) && $active_submenu == 'transfer_stock'){ echo 'active_submenu'; } ?>"><a title="Add Professor" href="<?php echo base_url(); ?>/inventory/transfer_agent_stock"><span class="mini-sub-pro">Transfer Stock</span></a></li>
                            </ul>
                        </li>
                        
                        <li class="<?php if($active_menu == 'manage_content'){ echo 'active'; } ?>">
                            <a class="has-arrow"  href="all-courses.html" aria-expanded="<?php if($active_menu == 'manage_content'){ echo 'true'; }else{ echo 'false';} ?>"><span class="ion-navicon-round m_icon"></span> <span class="mini-click-non">Manage Content</span></a>
                           <ul class="submenu-angle <?php if($active_menu == 'manage_content'){ echo 'show'; }else{ echo '';} ?>" aria-expanded="false" style="padding:0px; margin:0px;">
                             
                               <li class="<?php if(isset($active_submenu) && $active_submenu == 'banner'){ echo 'active_submenu'; } ?>"><a title="Add Professor" href="<?php echo base_url(); ?>/app_banner/add"><span class="mini-sub-pro">Banner</span></a></li>
                               <li class="<?php if(isset($active_submenu) && $active_submenu == 'offer_banner'){ echo 'active_submenu'; } ?>"><a title="Add Professor" href="<?php echo base_url(); ?>/offer_banner/add"><span class="mini-sub-pro">Offer Banner</span></a></li>
                               
                               <li class="<?php if(isset($active_submenu) && $active_submenu == 'about'){ echo 'active_submenu'; } ?>"><a title="Add Professor" href="<?php echo base_url(); ?>/offer_banner/about"><span class="mini-sub-pro">About Us</span></a></li>
                               
                               <li class="<?php if(isset($active_submenu) && $active_submenu == 'service'){ echo 'active_submenu'; } ?>"><a title="Add Professor" href="<?php echo base_url(); ?>/offer_banner/service"><span class="mini-sub-pro">Services</span></a></li>
                              
                            </ul>
                        </li>
                        <!--<li class="<?php if($active_menu == 'customer'){ echo 'active'; } ?>">
                            <a class="has-arrow" href="all-professors.html" aria-expanded="<?php if($active_menu == 'customer'){ echo 'true'; }else{ echo 'false';} ?>"><span class="educate-icon educate-professor icon-wrap"></span> <span class="mini-click-non">Customers</span></a>
                            <ul class="submenu-angle <?php if($active_menu == 'customer'){ echo 'show'; }else{ echo '';} ?>" aria-expanded="false">
                                <li><a title="All Professors" href="<?php echo base_url(); ?>customer/add_customer"><span class="mini-sub-pro">Add Customers</span></a></li>
                                <li><a title="Add Professor" href="<?php echo base_url(); ?>customer/list_customer"><span class="mini-sub-pro">Update Customers</span></a></li>


                            </ul>
                        </li>-->
                        <!--<li>
                            <a href="<?php echo base_url(); ?>limit/recharge_limit" aria-expanded="false"><span class="educate-icon educate-student icon-wrap"></span> <span class="mini-click-non">Recharge Limit</span></a>

                        </li>-->
                        <!--<li>
                            <a href="<?php echo base_url(); ?>recharge/recharge_search" aria-expanded="false"><span class="educate-icon educate-course icon-wrap"></span> <span class="mini-click-non">Recharge</span></a>

                        </li>-->
                        
                        
                        <li class="<?php if($active_menu == 'notification'){ echo 'active'; } ?>">
                            <a class="has-arrow"  href="all-courses.html" aria-expanded="<?php if($active_menu == 'notification'){ echo 'true'; }else{ echo 'false';} ?>"><span class="ion-ios-email m_icon"></span> <span class="mini-click-non">Send Message</span></a>
                           <ul class="submenu-angle <?php if($active_menu == 'notification'){ echo 'show'; }else{ echo '';} ?>" aria-expanded="false" style="padding:0px; margin:0px;">
                             
                               <li class="<?php if(isset($active_submenu) && $active_submenu == 'send_notification'){ echo 'active_submenu'; } ?>"><a title="Add Professor" href="<?php echo base_url(); ?>/notification/notification"><span class="mini-sub-pro">Send Notification</span></a></li>
                               <li class="<?php if(isset($active_submenu) && $active_submenu == 'send_promo_code'){ echo 'active_submenu'; } ?>"><a title="Add Professor" href="<?php echo base_url(); ?>/promo_code/send_promo_code_section"><span class="mini-sub-pro">Send Promocode</span></a></li>
                              
                            </ul>
                        </li>


                         <li class="<?php if($active_menu == 'setting'){ echo 'active'; } ?>">
                            <a class="has-arrow"  href="all-courses.html" aria-expanded="<?php if($active_menu == 'e_product'){ echo 'true'; }else{ echo 'false';} ?>"><span class="ion-pie-graph m_icon"></span> <span class="mini-click-non">E setting</span></a>
                           <ul class="submenu-angle <?php if($active_menu == 'setting'){ echo 'show'; }else{ echo '';} ?>" aria-expanded="false" style="padding:0px; margin:0px;">
                                <li class="<?php if(isset($active_submenu) && $active_submenu == 'sms_account'){ echo 'active_submenu'; } ?>"><a title="All Professors" href="<?php echo base_url(); ?>setting/smsaccount"><span class="mini-sub-pro">SMS Account </span></a></li>
                                
                            </ul>
                        </li>
                        
                        <li class="<?php if($active_menu == 'collection'){ echo 'active'; } ?>">
                            <a class="has-arrow"  href="all-courses.html" aria-expanded="<?php if($active_menu == 'collection'){ echo 'true'; }else{ echo 'false';} ?>"><span class="ion-pie-graph m_icon"></span> <span class="mini-click-non">Collection</span></a>
                           <ul class="submenu-angle <?php if($active_menu == 'collection'){ echo 'show'; }else{ echo '';} ?>" aria-expanded="false" style="padding:0px; margin:0px;">
                               
                                <li class="<?php if(isset($active_submenu) && $active_submenu == 'fat_rate'){ echo 'active_submenu'; } ?>"><a title="All Professors" href="<?php echo base_url(); ?>collection/fat_rate"><span class="mini-sub-pro">Fate Rate </span></a></li>
                               
                               <li class="<?php if(isset($active_submenu) && $active_submenu == 'snf'){ echo 'active_submenu'; } ?>"><a title="All Professors" href="<?php echo base_url(); ?>collection/snf"><span class="mini-sub-pro">SNF </span></a></li>
                                
                            </ul>
                        </li>
                        
                            <li class="<?php if($active_menu == 'e_product'){ echo 'active'; } ?>">
                            <a class="has-arrow"  href="all-courses.html" aria-expanded="<?php if($active_menu == 'e_product'){ echo 'true'; }else{ echo 'false';} ?>"><span class="ion-pie-graph m_icon"></span> <span class="mini-click-non">Crud Operation jquery</span></a>
                           <ul class="submenu-angle <?php if($active_menu == 'e_product'){ echo 'show'; }else{ echo '';} ?>" aria-expanded="false" style="padding:0px; margin:0px;">
                               
                                <li class="<?php if(isset($active_submenu) && $active_submenu == 'add_category'){ echo 'active_submenu'; } ?>"><a title="All Professors" href="<?php echo base_url(); ?>category/add_category"><span class="mini-sub-pro">Add Category </span></a></li>
 
                            </ul>
                        </li>
                        

                       <!-- <li class="<?php if($active_menu == 'backup'){ echo 'active'; } ?>">
                            <a href="<?php echo base_url(); ?>dashboard/backup" aria-expanded="false"><span class="ion-merge m_icon"></span> <span class="mini-click-non">BackUp</span></a>

                        </li> -->

                        <li style="height:100px; box-shadow:none;">

                        </li>


                    </ul>
                </nav>
            </div>
        </nav>
    </div>
