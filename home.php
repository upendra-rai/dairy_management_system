<!doctype html>
<html class="no-js" lang="en">

<head>
   <?php $this->load->view('common/header_link'); ?>

     <!-- Preloader CSS
		============================================ -->
    <link rel="stylesheet" href="<?php echo base_url('catalogs'); ?>/css/preloader/preloader-style.css">

    <script src="<?php echo base_url('catalogs'); ?>/js/datapicker/bootstrap-datepicker.js"></script>
    <script src="<?php echo base_url('catalogs'); ?>/js/datapicker/datepicker-active.js"></script>
   <style type="text/css">
      .box_head_bard{

           width:100%;
           height:30px;
           padding: 6px 15px;

           color:#5f5f5f;
           border: 1px solid #b5b5b5;
       }
       .box_head_bard h5{
           font-size: 14px;
           display: inline-block;
           font-weight: 500;
       }
       .box_head_bard span{
           display: inline-block;
           float: right;
           font-size: 20px;
           margin-top: -4px;
       }
       .box_head_bard span i{
           color:#5f5f5f;

       }

     .stackcard_ul{
           padding: 0;
           margin: 0;

       }
       .stackcard_ul li{
           padding: 0px 5px;
           width: 19.7%;
           display: inline-block;
       }

	  .vacation_a{
		margin: 0;
        color:red;
	  }

	  .analysis-progrebar .analysis-progrebar-content .vacation_a h5{
		  color:#ffffff;
		  transform: scale(1);
	  }

	  .analysis-progrebar .analysis-progrebar-content .vacation_a h5:hover{

		  font-weight:900;
		  transform: scale(1.1);
	  }
       
       .quick_report{
           margin-top: 25px;
           background-color: #ffffff;
           box-shadow: 0px 4px 6px 0px rgba(0,0,0,0.5);
       }
       
       .table thead tr th{
           padding-right: 50px;
       }
       .table tbody tr td{
           padding-right: 50px;
           font-weight: 500;
           font-size: 14px;
          border:1px solid #eaeaea;
           
       }
       .table thead tr th:nth-child(1){
           background-color: #3f51b5;
           color:#ffffff;
       }
       
       .table thead tr th:nth-child(2){
           background-color: #673ab7;
           color:#ffffff;
       }
       
       .table thead tr th:nth-child(3){
           background-color:#9c27b0;
           color:#ffffff;
       }
       
       .table thead tr th:nth-child(4){
           background-color: #e91e63;
           color:#ffffff;
       }
       
       .table thead tr th:nth-child(5){
           background-color: #ec427d;
           color:#ffffff;
       }
       .table thead tr th:nth-child(6){
           background-color: #f8363c;
           color:#ffffff;
       }
       
       .quick_report .v_cont{
          
         color: #425369;
           padding: 7px 10px;
           border: 1px solid #e8e8e8;
           border-top: transparent;
           background-color: #ffffff;
           height:auto;
           position: relative;
           border-right: none;
           height: 55px;
          
       }
       
       .quick_report .col-md-2{
         
           
       }
       
       .quick_report .v_cont .icon{
           float: right;
           font-size:26px;
          position:absolute;
           right:10px;
           top:5px;
           color:#ced0df;
       }
   </style>
</head>

<body>

    <div class="preloader-single shadow-inner mg-b-30" id="my_loader" style="position:fixed; background: rgba(0,0,0,0.8); width:100%; height:100vh; z-index: 9999; display:none;">
        <div class="ts_preloading_box" style="">
            <div id="ts-preloader-absolute09" style="position:fixed; margin:auto;   border-radius:70px;">
                <div class="tsperloader9" id="tsperloader9_one"></div>
                <div class="tsperloader9" id="tsperloader9_two"></div>
                <div class="tsperloader9" id="tsperloader9_three"></div>
                <div class="tsperloader9" id="tsperloader9_four"></div>
            </div>
        </div>
    </div>

    <?php $this->load->view('common/sidemenu'); ?>
    <div class="all-content-wrapper">

        <?php $this->load->view('common/titlebar'); ?>
        <div class="container-fluid" style="margin-top:0px;">

    				<div class="row">
                        
                        <div class="col-md-12">
                                
                                <div class="quick_report">
                                    
                                    <duv class="col-md-2" style="padding:0px;">
                                         <div class="v_cont" style="background-color:#3f51b5; color:#ffffff; height:32px;  padding: 6px 10px;">Sales </div>
                                        
                                        <a href="<?php echo base_url(); ?>/report/transaction_report/">
                                        <div class="v_cont">Today <br> <i class="fa fa-rupee"></i> <?php echo number_format($today_sell[0]->total,1); ?> <i  class="ion-ios-analytics-outline icon" style=""></i></div>
                                        </a>
                                        
                                        <a href="<?php echo base_url(); ?>/report/transaction_report/">
                                         <div class="v_cont">Yesterday  <br> <i class="fa fa-rupee"></i> <?php echo number_format($yesterday_sell[0]->total,1); ?> <i class="ion-ios-clock-outline icon" style=""></i></div>
                                        </a>
                                        <a href="<?php echo base_url(); ?>/report/transaction_report/">
                                         <div class="v_cont">This Month <br> <i class="fa fa-rupee"></i> <?php echo number_format($month_sell[0]->total,1); ?> <i class="ion-ios-box-outline icon" style=""></i></div>
                                        </a>
                                        <a href="<?php echo base_url(); ?>/report/transaction_report/">
                                         <div class="v_cont">Last Month <br> <i class="fa fa-rupee"></i> <?php echo number_format($lastmonth_sell[0]->total,1); ?> <i class="ion-ios-cart-outline icon" style=""></i></div>
                                        </a>
                                        <a href="<?php echo base_url(); ?>/report/transaction_report/">
                                         <div class="v_cont">This Year <br> <i class="fa fa-rupee"></i> <?php echo number_format($thisyear_sell[0]->total,1); ?> <i class="ion-ios-checkmark-outline icon" style=""></i></div>
                                        </a>
                                    </duv>
                                    
                                  
                                    
                                    <duv class="col-md-2" style="padding:0px;">
                                         <div class="v_cont" style="background-color:#9c27b0; color:#ffffff; height:32px; padding: 6px 10px;">Recharges </div>
                                         <a href="<?php echo base_url(); ?>/report/recharge_report/">
                                         <div class="v_cont">Today <br> <i class="fa fa-rupee"></i> <?php echo number_format($today_recharge[0]->total); ?> <i class="ion-ios-analytics-outline icon" style=""></i></div>
                                        </a>
                                         <a href="<?php echo base_url(); ?>/report/recharge_report/">
                                         <div class="v_cont">Yesterday  <br> <i class="fa fa-rupee"></i> <?php echo number_format($yesterday_recharge[0]->total); ?> <i class="ion-ios-clock-outline icon" style=""></i></div>
                                        </a>
                                        
                                         <a href="<?php echo base_url(); ?>/report/recharge_report/">
                                         <div class="v_cont">This Month <br> <i class="fa fa-rupee"></i> <?php echo number_format($month_recharge[0]->total); ?> <i class="ion-ios-box-outline icon" style=""></i></div>
                                        </a>
                                        
                                         <a href="<?php echo base_url(); ?>/report/recharge_report/">
                                         <div class="v_cont">Last Month <br> <i class="fa fa-rupee"></i> <?php echo number_format($lastmonth_recharge[0]->total); ?> <i class="ion-ios-cart-outline icon" style=""></i></div>
                                        </a>
                                         <a href="<?php echo base_url(); ?>/report/recharge_report/">
                                         <div class="v_cont">This Year <br> <i class="fa fa-rupee"></i> <?php echo number_format($thisyear_recharge[0]->total); ?>  <i class="ion-ios-checkmark-outline icon" style=""></i></div>
                                        </a>
                                    </duv>
                                    
                                      <duv class="col-md-2" style="padding:0px;">
                                         <div class="v_cont" style="background-color:#673ab7; color:#ffffff; height:32px; padding: 6px 10px;">Order Delivery  </div>
                                          
                                          <a href="<?php echo base_url(); ?>/report/order_report/">
                                         <div class="v_cont"><?php echo date('d-M-Y'); ?> <br><?php if(isset($today_delivery)){ echo $today_delivery[0]->total; }; ?> <i class="ion-ios-analytics-outline icon" style=""></i></div>
                                              
                                          </a>
                                          
                                            <a href="<?php echo base_url(); ?>/report/order_report/">
                                         <div class="v_cont"><?php echo date('d-M-Y', strtotime('+1 day')); ?> <br> <?php if(isset($second_day_delivery)){ echo $second_day_delivery[0]->total; }; ?> <i class="ion-ios-clock-outline icon" style=""></i></div>
                                          </a>
                                            <a href="<?php echo base_url(); ?>/report/order_report/">
                                         <div class="v_cont"><?php echo date('d-M-Y', strtotime('+2 day')); ?>  <br><?php if(isset($third_day_delivery)){ echo $third_day_delivery[0]->total; }; ?> <i class="ion-ios-box-outline icon" style=""></i></div>
                                          </a>
                                            <a href="<?php echo base_url(); ?>/report/order_report/">
                                         <div class="v_cont"><?php echo date('d-M-Y', strtotime('+3 day')); ?> <br> <?php if(isset($forth_day_delivery)){ echo $forth_day_delivery[0]->total; }; ?> <i class="ion-ios-cart-outline icon" style=""></i></div>
                                          </a>
                                            <a href="<?php echo base_url(); ?>/report/order_report/">
                                         <div class="v_cont"><?php echo date('d-M-Y', strtotime('+4 day')); ?><br> <?php if(isset($fifth_day_delivery)){ echo $fifth_day_delivery[0]->total; }; ?>  <i class="ion-ios-checkmark-outline icon" style=""></i></div>
                                          </a>
                                    </duv>
                                    
                                    
                                     
            
                  
                      
                  
                                    
                                    <duv class="col-md-2" style="padding:0px;">
                                         <div class="v_cont" style="background-color:#9c27b0; color:#ffffff; height:32px; padding: 6px 10px;">Vacation </div>
                                       
                                         <a href="<?php echo base_url(); ?>dashboard/view_vacation/<?php echo date('Y-m-d'); ?>/morning" class="vacation_a">
                                         <div class="v_cont"><?php echo date('d-M-Y'); ?> <br> <?php echo $today_morning_vac[0]->total_vac; ?> <i class="ion-ios-analytics-outline icon" style=""></i></div>
                                        </a>
                                        
             <a href="<?php echo base_url(); ?>dashboard/view_vacation/<?php echo date('Y-m-d', strtotime('+1 day')); ?>/morning" class="vacation_a">
                 
                 <div class="v_cont"><?php echo date('d-M-Y', strtotime('+1 day')); ?>  <br><?php echo $tommrow_morning_vac[0]->total_vac; ?> <i class="ion-ios-clock-outline icon" style=""></i></div></a>
                                        
                                        
                 <a href="<?php echo base_url(); ?>dashboard/view_vacation/<?php echo date('Y-m-d', strtotime('+2 day')); ?>/morning" class="vacation_a"> 
                     
                                         <div class="v_cont"><?php echo date('d-M-Y', strtotime('+2 day')); ?> <br><?php echo $after_tommrow_morning_vac[0]->total_vac; ?> <i class="ion-ios-box-outline icon" style=""></i></div>
                                        </a>
                                        
                                        <a href="<?php echo base_url(); ?>dashboard/view_vacation/<?php echo date('Y-m-d', strtotime('+3 day')); ?>/morning" class="vacation_a">  
                                            <div class="v_cont"><?php echo date('d-M-Y', strtotime('+3 day')); ?> <br><?php echo $after_tommrow_tommrow_morning_vac[0]->total_vac; ?> <i class="ion-ios-cart-outline icon" style=""></i></div></a>
                                        
                                               <a href="<?php echo base_url(); ?>dashboard/view_vacation/<?php echo date('Y-m-d', strtotime('+4 day')); ?>/morning" class="vacation_a">
                                         <div class="v_cont"><?php echo date('d-M-Y', strtotime('+4 day')); ?> <br> <?php echo $after_tommrow_tommrow_morning_vac[0]->total_vac; ?>  <i class="ion-ios-checkmark-outline icon" style=""></i></div>
                                        </a>
                                    </duv>
                                    
                                    <duv class="col-md-2" style="padding:0px;">
                                         <div class="v_cont" style="background-color:#e91e63; color:#ffffff; height:32px; padding: 6px 10px;">Customers </div>
                                         <a href="<?php echo base_url(); ?>/report/customer_report"> 
                                         <div class="v_cont">Total<br> <?php echo number_format($total_customer); ?> <i class="ion-ios-analytics-outline icon" style=""></i></div>
                                         </a>
                                        
                                          <a href="<?php echo base_url(); ?>/report/customer_report"> 
                                         <div class="v_cont">Active <br> <?php echo number_format($active_customer); ?> <i class="ion-ios-clock-outline icon" style=""></i></div>
                                        </a>
                                        
                                        <a href="<?php echo base_url(); ?>/report/customer_report"> 
                                         <div class="v_cont">Blocked <br> <?php echo number_format($blocked_customer); ?> <i class="ion-ios-box-outline icon" style=""></i></div>
                                        </a>
                                        
                                         <a href="<?php echo base_url(); ?>/report/customer_report"> 
                                         <div class="v_cont">Terminated <br> <?php echo number_format($total_terminate); ?> <i class="ion-ios-cart-outline icon" style=""></i></div>
                                         <div class="v_cont"></div>
                                        </a>
                                         
                                    </duv>
                                    
                                    <duv class="col-md-2" style="padding:0px;">
                                         <div class="v_cont" style="background-color:#ec427d; color:#ffffff; height:32px; padding: 6px 10px;">User Ragistration </div>
                                         <a href="<?php echo base_url(); ?>user_ragistration/customer_ragistration_detail/all">
                                         <div class="v_cont">Total<br> <?php echo number_format($total_ragistration[0]->total); ?> <i class="ion-ios-analytics-outline icon" style=""></i></div>
                                         </a>
                                        
                                         <a href="<?php echo base_url(); ?>user_ragistration/customer_ragistration_detail/pending">
                                         <div class="v_cont">Ecommerce <br> <?php echo number_format($new_ragistration[0]->total); ?> <i class="ion-ios-clock-outline icon" style=""></i></div>
                                         </a>
                                        
                                         <a href="<?php echo base_url(); ?>user_ragistration/customer_ragistration_detail/completed">
                                         <div class="v_cont">Membership<br> <?php echo number_format($completed_ragistration[0]->total); ?> <i class="ion-ios-box-outline icon" style=""></i></div>
                                         </a>     
                                             
                                         <div class="v_cont"></div>
                                         <div class="v_cont"></div>
                                    </duv>
                                    
                                  
                                    
                  
                    </div>
                            </div>
                        
                        
    				<div class="col-md-12" style="display:none;">
    						    <div id="myheadtitle" style="border-bottom:none; margin-bottom:0px; ">
                                  User Ragistration
                    </div>
    				      <div class="row">
                        <div class="col-md-2" style="padding:0;">
                        <a href="<?php echo base_url(); ?>user_ragistration/customer_ragistration_detail/all">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="analysis-progrebar reso-mg-b-30" style="background-color:#0b73c8; box-shadow: 0px 3px 8px -1px rgba(0,0,0,0.5); ">
                                <div class="analysis-progrebar-content" >
                                    <h5 style="color:#ffffff;">Total</h5>
                                    <h2 style="color:#ffffff;"> <span><?php echo number_format($total_ragistration[0]->total); ?></span></h2>
    							                	<div class="my_i" style="position:absolute; color:#ffffff; font-size:35px; top:10px; right:40px;"><i class="ion-happy-outline"></i></div>
                                </div>
                            </div>
                        </div>
                        </a>
    				           </div>
                        <div class="col-md-10" style="padding:0;">
                        <a href="<?php echo base_url(); ?>user_ragistration/customer_ragistration_detail/pending">
    					           <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="analysis-progrebar reso-mg-b-30" style="background-color:#2196f3; box-shadow: 0px 3px 8px -1px rgba(0,0,0,0.5); ">
                                <div class="analysis-progrebar-content" >
                                    <h5 style="color:#ffffff;">Ecommerce</h5>
                                    <h2 style="color:#ffffff;"><span><?php echo number_format($new_ragistration[0]->total); ?></span></h2>
    								                   <div class="my_i" style="position:absolute; color:#ffffff; font-size:35px; top:10px; right:40px;"><i class="ion-happy-outline"></i></div>
                                </div>
                            </div>
                        </div>
                         </a>
    					    <a href="<?php echo base_url(); ?>user_ragistration/customer_ragistration_detail/completed">
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">

                            <div class="analysis-progrebar reso-mg-b-30" style="background-color:#03a9f4; box-shadow: 0px 3px 8px -1px rgba(0,0,0,0.5); ">
                                <div class="analysis-progrebar-content" >
                                    <h5 style="color:#ffffff;">Membership</h5>
                                    <h2 style="color:#ffffff;"><span><?php echo number_format($completed_ragistration[0]->total); ?></span></h2>
    								                    <div class="my_i" style="position:absolute; color:#ffffff; font-size:35px; top:10px; right:40px;"><i class="ion-happy-outline"></i></div>
                                </div>
                            </div>
                        </div>
                            </a>
                      <!--      <a href="<?php echo base_url(); ?>user_ragistration/customer_ragistration_detail/canceled">
    					   <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="analysis-progrebar reso-mg-b-30" style="background-color:#00bcd4; box-shadow: 0px 3px 8px -1px rgba(0,0,0,0.5); ">
                                <div class="analysis-progrebar-content" >
                                    <h5 style="color:#ffffff;">Canceled</h5>
                                    <h2 style="color:#ffffff;"><span><?php echo number_format($canceled_ragistration[0]->total); ?></span></h2>
    								                <div class="my_i" style="position:absolute; color:#ffffff; font-size:35px; top:10px; right:40px;"><i class="ion-happy-outline"></i></div>

                                </div>
                            </div>
                        </div>
                            </a> -->

                    </div>

                    </div>
    				</div>
    				</div>

    		</div>

		<div class="container-fluid" style="margin-top:0px; display:none;">

				<div class="row">
				<div class="col-md-12">
						    <div id="myheadtitle" style="border-bottom:none; margin-bottom:0px; ">
                                Recharge Transaction

                            </div>
				<div class="row">
                    <div class="col-md-2" style="padding:0;">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="analysis-progrebar reso-mg-b-30" style="background-color:#0b73c8; box-shadow: 0px 3px 8px -1px rgba(0,0,0,0.5); ">
                            <div class="analysis-progrebar-content" >
                                <h5 style="color:#ffffff;">Today</h5>
                                <h2 style="color:#ffffff;"><span class="rs_span"><i class="fa fa-rupee"></i> </span> <span class="counter"><?php echo number_format($today_recharge[0]->total); ?></span></h2>
								<div class="my_i" style="position:absolute; color:#ffffff; font-size:35px; top:10px; right:40px;"><i class="ion-android-calendar"></i></div>

                            </div>
                        </div>
                    </div>
				   </div>
                    <div class="col-md-10" style="padding:0;">
					<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="analysis-progrebar reso-mg-b-30" style="background-color:#2196f3; box-shadow: 0px 3px 8px -1px rgba(0,0,0,0.5); ">
                            <div class="analysis-progrebar-content" >
                                <h5 style="color:#ffffff;">Yesterday</h5>
                                <h2 style="color:#ffffff;"><span class="rs_span"><i class="fa fa-rupee"></i> </span><span class="counter"><?php echo number_format($yesterday_recharge[0]->total); ?></span></h2>
								<div class="my_i" style="position:absolute; color:#ffffff; font-size:35px; top:10px; right:40px;"><i class="ion-android-map"></i></div>

                            </div>
                        </div>
                    </div>
					<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="analysis-progrebar reso-mg-b-30" style="background-color:#03a9f4; box-shadow: 0px 3px 8px -1px rgba(0,0,0,0.5); ">
                            <div class="analysis-progrebar-content" >
                                <h5 style="color:#ffffff;">This Month</h5>

                                <h2 style="color:#ffffff;"><span class="rs_span"><i class="fa fa-rupee"></i> </span><span class="counter"><?php echo number_format($month_recharge[0]->total); ?></span></h2>
								<div class="my_i" style="position:absolute; color:#ffffff; font-size:35px; top:10px; right:40px;"><i class="ion-android-textsms"></i></div>

                            </div>
                        </div>
                    </div>
					<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="analysis-progrebar reso-mg-b-30" style="background-color:#00bcd4; box-shadow: 0px 3px 8px -1px rgba(0,0,0,0.5); ">
                            <div class="analysis-progrebar-content" >
                                <h5 style="color:#ffffff;">Last Month</h5>
                                <h2 style="color:#ffffff;"><span class="rs_span"><i class="fa fa-rupee"></i> </span><span class="counter"><?php echo number_format($lastmonth_recharge[0]->total); ?></span></h2>
								<div class="my_i" style="position:absolute; color:#ffffff; font-size:35px; top:10px; right:40px;"><i class="ion-bookmark"></i></div>

                            </div>
                        </div>
                    </div>


                     <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="analysis-progrebar reso-mg-b-30" style="background-color:#04e0ff; box-shadow: 0px 3px 8px -1px rgba(0,0,0,0.5); ">
                            <div class="analysis-progrebar-content" >
                                <h5 style="color:#ffffff;">This year</h5>
                                <h2 style="color:#ffffff;"><span class="rs_span"><i class="fa fa-rupee"></i> </span><span class="counter"><?php echo number_format($thisyear_recharge[0]->total); ?></span></h2>
								<div class="my_i" style="position:absolute; color:#ffffff; font-size:35px; top:10px; right:40px;"><i class="ion-bowtie"></i></div>

                            </div>
                        </div>
                    </div>
                </div>

                </div>
				</div>
				</div>

		</div>


		<div class="container-fluid" style="margin-top:10px; display:none;">

				<div class="row">
				<div class="col-md-12">
						    <div id="myheadtitle" style="border-bottom:none; margin-bottom:0px; ">
                                Sales Transaction
                            </div>
							<div class="row">
                    <div class="col-md-2" style="padding:0;">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="analysis-progrebar reso-mg-b-30" style="background-color:#3f51b5; box-shadow: 0px 3px 8px -1px rgba(0,0,0,0.5); ">
                            <div class="analysis-progrebar-content" >
                                <h5 style="color:#ffffff;">Today</h5>
                                <h2 style="color:#ffffff;"><span class="rs_span"><i class="fa fa-rupee"></i> </span><span class="counter"><?php echo number_format($today_sell[0]->total,1); ?></span></h2>
								<div class="my_i" style="position:absolute; color:#ffffff; font-size:35px; top:10px; right:40px;"><i class="ion-calendar"></i></div>
                            </div>
                        </div>
                    </div>
                    </div>


				   <div class="col-md-10" style="padding:0;">
					<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="analysis-progrebar reso-mg-b-30" style="background-color:#673ab7; box-shadow: 0px 3px 8px -1px rgba(0,0,0,0.5); ">
                            <div class="analysis-progrebar-content" >
                                <h5 style="color:#ffffff;">Yesterday</h5>
                                <h2 style="color:#ffffff;"><span class="rs_span"><i class="fa fa-rupee"></i> </span><span class="counter"><?php echo number_format($yesterday_sell[0]->total,1); ?></span></h2>
								<div class="my_i" style="position:absolute; color:#ffffff; font-size:35px; top:10px; right:40px;"><i class="ion-chatbubbles"></i></div>
                            </div>
                        </div>
                    </div>
					<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="analysis-progrebar reso-mg-b-30" style="background-color:#9c27b0; box-shadow: 0px 3px 8px -1px rgba(0,0,0,0.5); ">
                            <div class="analysis-progrebar-content" >
                                <h5 style="color:#ffffff;">This Month</h5>
                                <h2 style="color:#ffffff;"><span class="rs_span"><i class="fa fa-rupee"></i> </span><span class="counter"><?php echo number_format($month_sell[0]->total,1); ?></span></h2>
								<div class="my_i" style="position:absolute; color:#ffffff; font-size:35px; top:10px; right:40px;"><i class="ion-clipboard"></i></div>

                            </div>
                        </div>
                    </div>
					<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="analysis-progrebar reso-mg-b-30" style="background-color:#e91e63; box-shadow: 0px 3px 8px -1px rgba(0,0,0,0.5); ">
                            <div class="analysis-progrebar-content" >
                                <h5 style="color:#ffffff;">Last Month</h5>
                                <h2 style="color:#ffffff;"><span class="rs_span"><i class="fa fa-rupee"></i> </span><span class="counter"><?php echo number_format($lastmonth_sell[0]->total,1); ?></span></h2>
								<div class="my_i" style="position:absolute; color:#ffffff; font-size:35px; top:10px; right:40px;"><i class="ion-clock"></i></div>


                            </div>
                        </div>
                    </div>


                     <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                        <div class="analysis-progrebar reso-mg-b-30" style="background-color:#ec427d; box-shadow: 0px 3px 8px -1px rgba(0,0,0,0.5); ">
                            <div class="analysis-progrebar-content" >
                                <h5 style="color:#ffffff;">This Year</h5>
                                <h2 style="color:#ffffff;"><span class="rs_span"><i class="fa fa-rupee"></i> </span><span class="counter"><?php echo number_format($thisyear_sell[0]->total,1); ?></span></h2>
								<div class="my_i" style="position:absolute; color:#ffffff; font-size:35px; top:10px; right:40px;"><i class="ion-contrast"></i></div>


                            </div>
                        </div>
                    </div>
                </div>

                </div>
				</div>
				</div>

		</div> 
        
        <div class="container-fluid" style="margin-top:10px; display:none;">
            <div class="row">
				<div class="col-md-12">
						    <div id="myheadtitle" style="border-bottom:none; margin-bottom:0px; ">
                              Order Delivery
                            </div>
							<div class="row">
                              
                                <div class="col-md-2" style="padding:0;">

                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                                        <div class="analysis-progrebar reso-mg-b-30" style="background-color:#3f51b5; box-shadow: 0px 3px 8px -1px rgba(0,0,0,0.5); ">
                                            <div class="analysis-progrebar-content" >
                                                <a href="<?php echo base_url(); ?>orders/filter_by_delivery_date/<?php echo date('Y-m-d'); ?>" class="vacation_a"><h5 style="width:100%;"><?php echo date('d-M-Y'); ?> <span style="float:right;"><?php if(isset($today_delivery)){ echo $today_delivery[0]->total; }; ?></span> </h5></a>
                                              
                                            </div>
                                        </div>
                                    </div>
								</div>
								<div class="col-md-10" style="padding:0;">
                                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">

                                        <div class="analysis-progrebar reso-mg-b-30" style="background-color:#673ab7; box-shadow: 0px 3px 8px -1px rgba(0,0,0,0.5); ">
                                              <div class="analysis-progrebar-content" >
                                            <a href="<?php echo base_url(); ?>orders/filter_by_delivery_date/<?php echo date('Y-m-d', strtotime('+1 day')); ?>" class="vacation_a"><h5 style="color:#ffffff;  width:100%;"><?php echo date('d-M-Y', strtotime('+1 day')); ?> <span style="float:right;"><?php if(isset($second_day_delivery)){ echo $second_day_delivery[0]->total; }; ?></span></h5></a>
                                           
                                             </div>

                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">

                                        <div class="analysis-progrebar reso-mg-b-30" style="background-color:#9c27b0; box-shadow: 0px 3px 8px -1px rgba(0,0,0,0.5); ">
                                            <div class="analysis-progrebar-content" >
                                                <a href="<?php echo base_url(); ?>orders/filter_by_delivery_date/<?php echo date('Y-m-d', strtotime('+2 day')); ?>" class="vacation_a"> <h5 style="color:#ffffff;  width:100%;"><?php echo date('d-M-Y', strtotime('+2 day')); ?> <span style="float:right;"><?php if(isset($third_day_delivery)){ echo $third_day_delivery[0]->total; }; ?></span></h5></a>
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">

                                        <div class="analysis-progrebar reso-mg-b-30" style="background-color:#e91e63; box-shadow: 0px 3px 8px -1px rgba(0,0,0,0.5); ">
                                            <div class="analysis-progrebar-content" >
                                                  <a href="<?php echo base_url(); ?>orders/filter_by_delivery_date/<?php echo date('Y-m-d', strtotime('+3 day')); ?>" class="vacation_a"><h5 style="color:#ffffff;  width:100%;"><?php echo date('d-M-Y', strtotime('+3 day')); ?> <span style="float:right;"><?php if(isset($forth_day_delivery)){ echo $forth_day_delivery[0]->total; }; ?></span></h5></a>
                                                 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">

                                        <div class="analysis-progrebar reso-mg-b-30" style="background-color:#e91e63; box-shadow: 0px 3px 8px -1px rgba(0,0,0,0.5); ">
                                            <div class="analysis-progrebar-content" >
                                                <a href="<?php echo base_url(); ?>orders/filter_by_delivery_date/<?php echo date('Y-m-d', strtotime('+4 day')); ?>" class="vacation_a"> <h5 style="color:#ffffff;  width:100%;"><?php echo date('d-M-Y', strtotime('+4 day')); ?> <span style="float:right;"><?php if(isset($fifth_day_delivery)){ echo $fifth_day_delivery[0]->total; }; ?></span></h5></a>
                                                 
                                            </div>
                                        </div>
                                    </div>

                              </div>
                              </div>
                </div>
            </div>
        </div>
        
        
       
                     
        
		 <div class="container-fluid" style="margin-top:10px; display:none;">
            <div class="row">
				<div class="col-md-12">
						    <div id="myheadtitle" style="border-bottom:none; margin-bottom:0px; ">
                              Vacation
                            </div>
							<div class="row">
                                <div class="col-md-2" style="padding:0;">

                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                                        <div class="analysis-progrebar reso-mg-b-30" style="background-color:#3f51b5; box-shadow: 0px 3px 8px -1px rgba(0,0,0,0.5); ">
                                            <div class="analysis-progrebar-content" >
                                                <a href="<?php echo base_url(); ?>dashboard/view_vacation/<?php echo date('Y-m-d'); ?>/morning" class="vacation_a"><h5 style="width:100%;"><?php echo date('d-M-Y'); ?> <span style="float:right;"><?php echo $today_morning_vac[0]->total_vac; ?></span> </h5></a>
                                               <!--
                                                <a href="<?php echo base_url(); ?>dashboard/view_vacation/<?php echo date('Y-m-d'); ?>/evening" class="vacation_a"> <h5 style="color:#ffffff;  width:100%;">Evening &nbsp <span style="float:right;"><?php echo $today_evening_vac[0]->total_vac; ?></span></h5></a>
                                               -->
                                            </div>
                                        </div>
                                    </div>
								</div>
								<div class="col-md-10" style="padding:0;">
                                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">

                                        <div class="analysis-progrebar reso-mg-b-30" style="background-color:#673ab7; box-shadow: 0px 3px 8px -1px rgba(0,0,0,0.5); ">
                                              <div class="analysis-progrebar-content" >
                                            <a href="<?php echo base_url(); ?>dashboard/view_vacation/<?php echo date('Y-m-d', strtotime('+1 day')); ?>/morning" class="vacation_a"><h5 style="color:#ffffff;  width:100%;"><?php echo date('d-M-Y', strtotime('+1 day')); ?> <span style="float:right;"><?php echo $tommrow_morning_vac[0]->total_vac; ?></span></h5></a>
                                             <!--
                                            <a href="<?php echo base_url(); ?>dashboard/view_vacation/<?php echo date('Y-m-d', strtotime('+1 day')); ?>/evening" class="vacation_a"><h5 style="color:#ffffff;  width:100%;">Evening <span style="float:right;"><?php echo $tommrow_evening_vac[0]->total_vac; ?></span></h5></a>
                                            -->
                                             </div>

                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">

                                        <div class="analysis-progrebar reso-mg-b-30" style="background-color:#9c27b0; box-shadow: 0px 3px 8px -1px rgba(0,0,0,0.5); ">
                                            <div class="analysis-progrebar-content" >
                                                <a href="<?php echo base_url(); ?>dashboard/view_vacation/<?php echo date('Y-m-d', strtotime('+2 day')); ?>/morning" class="vacation_a"> <h5 style="color:#ffffff;  width:100%;"><?php echo date('d-M-Y', strtotime('+2 day')); ?> <span style="float:right;"><?php echo $after_tommrow_morning_vac[0]->total_vac; ?></span></h5></a>
                                                 <!--
                                                <a href="<?php echo base_url(); ?>dashboard/view_vacation/<?php echo date('Y-m-d', strtotime('+2 day')); ?>/evening" class="vacation_a"><h5 style="color:#ffffff;  width:100%;">Evening <span style="float:right;"><?php echo $after_tommrow_evening_vac[0]->total_vac; ?></span></h5></a> -->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">

                                        <div class="analysis-progrebar reso-mg-b-30" style="background-color:#e91e63; box-shadow: 0px 3px 8px -1px rgba(0,0,0,0.5); ">
                                            <div class="analysis-progrebar-content" >
                                                  <a href="<?php echo base_url(); ?>dashboard/view_vacation/<?php echo date('Y-m-d', strtotime('+3 day')); ?>/morning" class="vacation_a"><h5 style="color:#ffffff;  width:100%;"><?php echo date('d-M-Y', strtotime('+3 day')); ?> <span style="float:right;"><?php echo $after_tommrow_tommrow_morning_vac[0]->total_vac; ?></span></h5></a>
                                                 <!--
                                                <a href="<?php echo base_url(); ?>dashboard/view_vacation/<?php echo date('Y-m-d', strtotime('+3 day')); ?>/evening" class="vacation_a"><h5 style="color:#ffffff;  width:100%;">Evening <span style="float:right;"><?php echo $after_tommrow_tommrow_evening_vac[0]->total_vac; ?></span></h5></a> -->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">

                                        <div class="analysis-progrebar reso-mg-b-30" style="background-color:#e91e63; box-shadow: 0px 3px 8px -1px rgba(0,0,0,0.5); ">
                                            <div class="analysis-progrebar-content" >
                                                <a href="<?php echo base_url(); ?>dashboard/view_vacation/<?php echo date('Y-m-d', strtotime('+4 day')); ?>/morning" class="vacation_a"> <h5 style="color:#ffffff;  width:100%;"><?php echo date('d-M-Y', strtotime('+4 day')); ?> <span style="float:right;"><?php echo $after_tommrow_tommrow_morning_vac[0]->total_vac; ?></span></h5></a>
                                                 <!--
                                                <a href="<?php echo base_url(); ?>dashboard/view_vacation/<?php echo date('Y-m-d', strtotime('+4 day')); ?>/evening" class="vacation_a"> <h5 style="color:#ffffff;  width:100%;">Evening <span style="float:right;"><?php echo $after_tommrow_tommrow_evening_vac[0]->total_vac; ?></span></h5></a> -->
                                            </div>
                                        </div>
                                    </div>
                              </div>
                              </div>
                </div>
            </div>
        </div>


		<div class="container-fluid" style="margin-top:10px; display:none;">

				<div class="row">
				<div class="col-md-12">
						    <div id="myheadtitle" style="border-bottom:none; margin-bottom:0px; ">
                                Customer Status
                            </div>
							<div class="row">
                    <div class="col-md-2" style="padding:0;">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                         <a href="<?php echo base_url() ?>report/customer_report" >
                        <div class="analysis-progrebar reso-mg-b-30" style="background-color:#3f51b5; box-shadow: 0px 3px 8px -1px rgba(0,0,0,0.5); ">
                            <div class="analysis-progrebar-content" >
                                <h5 style="color:#ffffff;">Total</h5>
                                <h2 style="color:#ffffff;"><span class=""><?php echo number_format($total_customer); ?></span></h2>
								<div class="my_i" style="position:absolute; color:#ffffff; font-size:35px; top:10px; right:40px;"><i class="ion-android-contacts"></i></div>
                            </div>
                        </div>
                        </a>
                    </div>
                    </div>


				   <div class="col-md-10" style="padding:0;">
					<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                         <a href="<?php echo base_url() ?>report/active_customer_quickreport" >
                        <div class="analysis-progrebar reso-mg-b-30" style="background-color:#673ab7; box-shadow: 0px 3px 8px -1px rgba(0,0,0,0.5); ">
                            <div class="analysis-progrebar-content" >
                                <h5 style="color:#ffffff;">Active</h5>
                                <h2 style="color:#ffffff;"><span class=""><?php echo number_format($active_customer); ?></span></h2>
								<div class="my_i" style="position:absolute; color:#ffffff; font-size:35px; top:10px; right:40px;"><i class="ion-android-happy"></i></div>
                            </div>
                        </div>
                        </a>
                    </div>
					<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <a href="<?php echo base_url() ?>dashboard/blocked_customer" >
                        <div class="analysis-progrebar reso-mg-b-30" style="background-color:#9c27b0; box-shadow: 0px 3px 8px -1px rgba(0,0,0,0.5); ">
                            <div class="analysis-progrebar-content" >
                                <h5 style="color:#ffffff;">Blocked</h5>
                                <h2 style="color:#ffffff;"><span class=""><?php echo number_format($blocked_customer); ?></span></h2>
								<div class="my_i" style="position:absolute; color:#ffffff; font-size:35px; top:10px; right:40px;"><i class="ion-alert-circled"></i></div>

                            </div>
                        </div>
                        </a>
                    </div>
					<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <a href="<?php echo base_url() ?>dashboard/terminate_customer_select" >
                        <div class="analysis-progrebar reso-mg-b-30" style="background-color:#e91e63; box-shadow: 0px 3px 8px -1px rgba(0,0,0,0.5); ">
                            <div class="analysis-progrebar-content" >
                                <h5 style="color:#ffffff;">Terminated</h5>
                                <h2 style="color:#ffffff;"><span class=""><?php echo number_format($total_terminate); ?></span></h2>
								<div class="my_i" style="position:absolute; color:#ffffff; font-size:35px; top:10px; right:40px;"><i class="ion-android-hand"></i></div>


                            </div>
                        </div>
                        </a>
                    </div>
                </div>

                </div>
				</div>
				</div>

		</div>


		<!--<div class="analysis-progrebar-area mg-b-15" style="margin-top:25px;">
            <div class="container-fluid">



				<div class="row" style="margin-top:30px;">
                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                        <div class="analysis-progrebar reso-mg-b-30" style="background-color:#f44336; box-shadow: 0px 3px 8px -1px rgba(0,0,0,0.5); ">
                            <div class="analysis-progrebar-content" >
                                <h5 style="color:#ffffff;">Usage</h5>
                                <h2 style="color:#ffffff;"><span class="counter">90</span>%</h2>
								<div class="my_i" style="position:absolute; color:#ffffff; font-size:35px; top:10px; right:40px;"><i class="ion-ios-home"></i></div>
                                <div class="progress progress-mini ug-1">
                                    <div style="width: 68%;" class="progress-bar"></div>
                                </div>
                                <div class="m-t-sm small" >
                                    <p style="color:#ffffff;">Server down since 1:32 pm.</p>
                                </div>
                            </div>
                        </div>
                    </div>
					<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                        <div class="analysis-progrebar reso-mg-b-30" style="background-color:#3f51b5; box-shadow: 0px 3px 8px -1px rgba(0,0,0,0.5); ">
                            <div class="analysis-progrebar-content" >
                                <h5 style="color:#ffffff;">Usage</h5>
                                <h2 style="color:#ffffff;"><span class="counter">90</span>%</h2>
								<div class="my_i" style="position:absolute; color:#ffffff; font-size:35px; top:10px; right:40px;"><i class="ion-ios-home"></i></div>
                                <div class="progress progress-mini ug-1">
                                    <div style="width: 68%;" class="progress-bar"></div>
                                </div>
                                <div class="m-t-sm small" >
                                    <p style="color:#ffffff;">Server down since 1:32 pm.</p>
                                </div>
                            </div>
                        </div>
                    </div>
					<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                        <div class="analysis-progrebar reso-mg-b-30" style="background-color:#9c27b0; box-shadow: 0px 3px 8px -1px rgba(0,0,0,0.5); ">
                            <div class="analysis-progrebar-content" >
                                <h5 style="color:#ffffff;">Usage</h5>
                                <h2 style="color:#ffffff;"><span class="counter">90</span>%</h2>
								<div class="my_i" style="position:absolute; color:#ffffff; font-size:35px; top:10px; right:40px;"><i class="ion-ios-home"></i></div>
                                <div class="progress progress-mini ug-1">
                                    <div style="width: 68%;" class="progress-bar"></div>
                                </div>
                                <div class="m-t-sm small" >
                                    <p style="color:#ffffff;">Server down since 1:32 pm.</p>
                                </div>
                            </div>
                        </div>
                    </div>
					<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                        <div class="analysis-progrebar reso-mg-b-30" style="background-color:#2196f3; box-shadow: 0px 3px 8px -1px rgba(0,0,0,0.5); ">
                            <div class="analysis-progrebar-content" >
                                <h5 style="color:#ffffff;">Usage</h5>
                                <h2 style="color:#ffffff;"><span class="counter">90</span>%</h2>
								<div class="my_i" style="position:absolute; color:#ffffff; font-size:35px; top:10px; right:40px;"><i class="ion-ios-home"></i></div>
                                <div class="progress progress-mini ug-1">
                                    <div style="width: 68%;" class="progress-bar"></div>
                                </div>
                                <div class="m-t-sm small" >
                                    <p style="color:#ffffff;">Server down since 1:32 pm.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>-->


		<div class="pie-bar-line-area" style="margin-top:0px;">
            <div class="container-fluid">

                <div class="row" >

                    <ul style="display:none;">

                        <li class="bar_tran_li"><input id="<?php if(isset($bar[0]->transaction_date)){ echo 'transaction_input'.date('m',strtotime($bar[0]->transaction_date)); } ?>" value="<?php if(isset($bar[0]->bar_tran)){ echo $bar[0]->bar_tran; } ?>"></li>
                        <li class="bar_tran_li"><input id="<?php if(isset($bar[1]->transaction_date)){ echo 'transaction_input'.date('m',strtotime($bar[1]->transaction_date)); } ?>" value="<?php if(isset($bar[1]->bar_tran)){ echo $bar[1]->bar_tran; } ?>"></li>
                        <li class="bar_tran_li"><input id="<?php if(isset($bar[2]->transaction_date)){ echo 'transaction_input'.date('m',strtotime($bar[2]->transaction_date)); } ?>" value="<?php if(isset($bar[2]->bar_tran)){ echo $bar[2]->bar_tran; } ?>"></li>
                        <li class="bar_tran_li"><input id="<?php if(isset($bar[3]->transaction_date)){ echo 'transaction_input'.date('m',strtotime($bar[3]->transaction_date)); } ?>" value="<?php if(isset($bar[3]->bar_tran)){ echo $bar[3]->bar_tran; } ?>"></li>
                        <li class="bar_tran_li"><input id="<?php if(isset($bar[4]->transaction_date)){ echo 'transaction_input'.date('m',strtotime($bar[4]->transaction_date)); } ?>" value="<?php if(isset($bar[4]->bar_tran)){ echo $bar[4]->bar_tran; } ?>"></li>
                        <li class="bar_tran_li"><input id="<?php if(isset($bar[5]->transaction_date)){ echo 'transaction_input'.date('m',strtotime($bar[5]->transaction_date)); } ?>" value="<?php if(isset($bar[5]->bar_tran)){ echo $bar[5]->bar_tran; } ?>"></li>
                        <li class="bar_tran_li"><input id="<?php if(isset($bar[6]->transaction_date)){ echo 'transaction_input'.date('m',strtotime($bar[6]->transaction_date)); } ?>" value="<?php if(isset($bar[6]->bar_tran)){ echo $bar[6]->bar_tran; } ?>"></li>
                        <li class="bar_tran_li"><input id="<?php if(isset($bar[7]->transaction_date)){ echo 'transaction_input'.date('m',strtotime($bar[7]->transaction_date)); } ?>" value="<?php if(isset($bar[7]->bar_tran)){ echo $bar[7]->bar_tran; } ?>"></li>
                        <li class="bar_tran_li"><input id="<?php if(isset($bar[8]->transaction_date)){ echo 'transaction_input'.date('m',strtotime($bar[8]->transaction_date)); } ?>" value="<?php if(isset($bar[8]->bar_tran)){ echo $bar[8]->bar_tran; } ?>"></li>
                        <li class="bar_tran_li"><input id="<?php if(isset($bar[9]->transaction_date)){ echo 'transaction_input'.date('m',strtotime($bar[9]->transaction_date)); } ?>" value="<?php if(isset($bar[9]->bar_tran)){ echo $bar[9]->bar_tran; } ?>"></li>
                        <li class="bar_tran_li"><input id="<?php if(isset($bar[10]->transaction_date)){ echo 'transaction_input'.date('m',strtotime($bar[10]->transaction_date)); } ?>" value="<?php if(isset($bar[10]->bar_tran)){ echo $bar[10]->bar_tran; } ?>"></li>
                        <li class="bar_tran_li"><input id="<?php if(isset($bar[11]->transaction_date)){ echo 'transaction_input'.date('m',strtotime($bar[11]->transaction_date)); } ?>" value="<?php if(isset($bar[11]->bar_tran)){ echo $bar[11]->bar_tran; } ?>"></li>

                    </ul>

                    <ul style="display:none;">

                        <li class="bar_recharge_li"><input id="<?php if(isset($bar2[0]->recharge_date)){ echo 'recharge_input'.date('m',strtotime($bar2[0]->recharge_date)); } ?>" value="<?php if(isset($bar2[0]->bar_re)){ echo $bar2[0]->bar_re; } ?>"></li>
                        <li class="bar_recharge_li"><input id="<?php if(isset($bar2[1]->recharge_date)){ echo 'recharge_input'.date('m',strtotime($bar2[1]->recharge_date)); } ?>" value="<?php if(isset($bar2[1]->bar_re)){ echo $bar2[1]->bar_re; } ?>"></li>
                        <li class="bar_recharge_li"><input id="<?php if(isset($bar2[2]->recharge_date)){ echo 'recharge_input'.date('m',strtotime($bar2[2]->recharge_date)); } ?>" value="<?php if(isset($bar2[2]->bar_re)){ echo $bar2[2]->bar_re; } ?>"></li>
                        <li class="bar_recharge_li"><input id="<?php if(isset($bar2[3]->recharge_date)){ echo 'recharge_input'.date('m',strtotime($bar2[3]->recharge_date)); } ?>" value="<?php if(isset($bar2[3]->bar_re)){ echo $bar2[3]->bar_re; } ?>"></li>
                        <li class="bar_recharge_li"><input id="<?php if(isset($bar2[4]->recharge_date)){ echo 'recharge_input'.date('m',strtotime($bar2[4]->recharge_date)); } ?>" value="<?php if(isset($bar2[4]->bar_re)){ echo $bar2[4]->bar_re; } ?>"></li>
                        <li class="bar_recharge_li"><input id="<?php if(isset($bar2[5]->recharge_date)){ echo 'recharge_input'.date('m',strtotime($bar2[5]->recharge_date)); } ?>" value="<?php if(isset($bar2[5]->bar_re)){ echo $bar2[5]->bar_re; } ?>"></li>

                        <li class="bar_recharge_li"><input id="<?php if(isset($bar2[6]->recharge_date)){ echo 'recharge_input'.date('m',strtotime($bar2[6]->recharge_date)); } ?>" value="<?php if(isset($bar2[6]->bar_re)){ echo $bar2[6]->bar_re; } ?>"></li>
                        <li class="bar_recharge_li"><input id="<?php if(isset($bar2[7]->recharge_date)){ echo 'recharge_input'.date('m',strtotime($bar2[7]->recharge_date)); } ?>" value="<?php if(isset($bar2[7]->bar_re)){ echo $bar2[7]->bar_re; } ?>"></li>
                        <li class="bar_recharge_li"><input id="<?php if(isset($bar2[8]->recharge_date)){ echo 'recharge_input'.date('m',strtotime($bar2[8]->recharge_date)); } ?>" value="<?php if(isset($bar2[8]->bar_re)){ echo $bar2[8]->bar_re; } ?>"></li>
                        <li class="bar_recharge_li"><input id="<?php if(isset($bar2[9]->recharge_date)){ echo 'recharge_input'.date('m',strtotime($bar2[9]->recharge_date)); } ?>" value="<?php if(isset($bar2[9]->bar_re)){ echo $bar2[9]->bar_re; } ?>"></li>
                        <li class="bar_recharge_li"><input id="<?php if(isset($bar2[10]->recharge_date)){ echo 'recharge_input'.date('m',strtotime($bar2[10]->recharge_date)); } ?>" value="<?php if(isset($bar2[10]->bar_re)){ echo $bar2[10]->bar_re; } ?>"></li>
                        <li class="bar_recharge_li"><input id="<?php if(isset($bar2[11]->recharge_date)){ echo 'recharge_input'.date('m',strtotime($bar2[10]->recharge_date)); } ?>" value="<?php if(isset($bar2[11]->bar_re)){ echo $bar2[11]->bar_re; } ?>"></li>

                    </ul>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="charts-single-pro mg-t-30 table-mg-btm-0-pro dk-mg-b-0-desk">
                            <div class="main-sparkline9-hd">
                                <h1>Month Wise Sales Chart</h1>
                                </div>
                            <div id="bar4-chart">
                                <canvas id="barchart4"></canvas>
                            </div>
                        </div>
                    </div>
                     <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="charts-single-pro mg-t-30 table-mg-btm-0-pro dk-mg-b-0-desk">
                            <div class="main-sparkline9-hd">
                                <h1>Month Wise Recharge Chart</h1>
                                </div>
                            <div id="bar44-chart">
                                <canvas id="barchart44"></canvas>
                            </div>
                        </div>
                    </div>
                    <!--<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="sparkline10-list">
                            <div class="sparkline10-hd">
                                <div class="main-sparkline10-hd">
                                    <h1>Bar Big size <span class="c3-ds-n">Example</span></h1>
                                </div>
                            </div>
                            <div class="sparkline10-graph">
                                <div id="pie"></div>
                            </div>
                        </div>
                    </div>-->
                </div>
            </div>
        </div>

	</div>

   <?php $this->load->view('common/footer_script'); ?>


     <script src="<?php echo base_url('catalogs'); ?>/js/datapicker/bootstrap-datepicker.js"></script>
    <script src="<?php echo base_url('catalogs'); ?>/js/datapicker/datepicker-active.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>

    <script type="text/javascript">


      $(document).ready(function(){

          function data_clean_up(){
           $('#my_loader').show();
                    $.ajax({
     		         		 type: 'POST',
     		         		 url: '<?php echo base_url(); ?>dashboard/data_cleaner',
              				 success:function(back){
              					 $('#my_loader').hide();
                                 //alert(back);
              				 }
              			 });

          }
          //data_clean_up();

          function block_transaction(){
           $('#my_loader').show();
                    $.ajax({
     		         		 type: 'POST',
     		         		 url: '<?php echo base_url(); ?>dashboard/block_transaction',
              				 success:function(tran){
              					 $('#my_loader').hide();
                                // alert(tran);
              				 }
              			 });

          }
       //   block_transaction();


         function bar(){
 "use strict";
	 /*----------------------------------------*/
	/*  1.  Bar Chart
	/*----------------------------------------*/



	/*----------------------------------------*/
	/*  4.  Bar Chart Multi axis
	/*----------------------------------------*/
	var ctx = document.getElementById("barchart4");

    var tr_jan = $('input[id=transaction_input01]').val();
    if(tr_jan === undefined){
        tr_jan = 0;
    }
    var tr_feb = $('input[id=transaction_input02]').val();
    if(tr_feb === undefined){
        tr_feb = 0;
    }
    var tr_mar = $('input[id=transaction_input03]').val();
    if(tr_mar === undefined){
        tr_mar = 0;
    }
    var tr_apr = $('input[id=transaction_input04]').val();
    if(tr_apr === undefined){
        tr_apr = 0;
    }
    var tr_may = $('input[id=transaction_input05]').val();
    if(tr_may === undefined){
        tr_may = 0;
    }
    var tr_jun = $('input[id=transaction_input06]').val();
    if(tr_jun === undefined){
        tr_jun = 0;
    }
    var tr_jul = $('input[id=transaction_input07]').val();
    if(tr_jul === undefined){
        tr_jul = 0;
    }
    var tr_aug = $('input[id=transaction_input08]').val();
    if(tr_aug === undefined){
        tr_aug = 0;
    }
    var tr_sep = $('input[id=transaction_input09]').val();
    if(tr_sep === undefined){
        tr_sep = 0;
    }
    var tr_oct = $('input[id=transaction_input10]').val();
    if(tr_oct === undefined){
        tr_oct = 0;
    }
    var tr_nov = $('input[id=transaction_input11]').val();
    if(tr_nov === undefined){
        tr_nov = 0;
    }
    var tr_dec = $('input[id=transaction_input12]').val();
    if(tr_dec === undefined){
        tr_dec = 0;
    }
	var barchart4 = new Chart(ctx, {
		type: 'bar',
		data: {
			labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul","Aug","Sep","Oct","Nov","Dec"],
			datasets: [{
                label: 'Sales',
				data: [tr_jan, tr_feb, tr_mar, tr_apr, tr_may, tr_jun, tr_jul,tr_aug,tr_sep,tr_oct,tr_nov,tr_dec],
				borderWidth: 1,
				yAxisID: "y-axis-1",
                backgroundColor: [

					'#9c27b0',
                    '#9c27b0',
                    '#9c27b0',
                    '#9c27b0',
                    '#9c27b0',
                    '#9c27b0',
                    '#9c27b0',
                    '#9c27b0',
                    '#9c27b0',
                    '#9c27b0',
                    '#9c27b0',
                    '#9c27b0',


				],
				borderColor: [
					'#9c27b0',
                    '#9c27b0',
                    '#9c27b0',
                    '#9c27b0',
                    '#9c27b0',
                    '#9c27b0',
                    '#9c27b0',
                    '#9c27b0',
                    '#9c27b0',
                    '#9c27b0',
                    '#9c27b0',
                    '#9c27b0',
				],
            }]
		},
		options: {

			responsive: true,

			title:{
				display:false,
				text:"Bar Chart Multi Axis"
			},
			tooltips: {
				mode: 'index',
				intersect: true
			},
			scales: {
				yAxes: [{
					type: "linear",
					display: true,
					position: "left",
					id: "y-axis-1",
				}, {
					type: "linear",
					display: false,
					position: "right",
					id: "y-axis-2",
					gridLines: {
						drawOnChartArea: false
					}
				}],
			}
		}
	});


	var ctx = document.getElementById("barchart44");

    var re_jan = $('input[id=recharge_input01]').val();
    if(re_jan === undefined){
        re_jan = 0;
    }
    var re_feb = $('input[id=recharge_input02]').val();
    if(re_feb === undefined){
        re_feb = 0;
    }
    var re_mar = $('input[id=recharge_input03]').val();
    if(re_mar === undefined){
        re_mar = 0;
    }
    var re_apr = $('input[id=recharge_input04]').val();
    if(re_apr === undefined){
        re_apr = 0;
    }
    var re_may = $('input[id=recharge_input05]').val();
    if(re_may === undefined){
        re_may = 0;
    }
    var re_jun = $('input[id=recharge_input06]').val();
    if(re_jun === undefined){
        re_jun = 0;
    }
    var re_jul = $('input[id=recharge_input07]').val();
    if(re_jul === undefined){
        re_jul = 0;
    }
    var re_aug = $('input[id=recharge_input08]').val();
    if(re_aug === undefined){
        re_aug = 0;
    }
    var re_sep = $('input[id=recharge_input09]').val();
    if(re_sep === undefined){
        re_sep = 0;
    }
    var re_oct = $('input[id=recharge_input10]').val();
    if(re_oct === undefined){
        re_oct = 0;
    }
    var re_nov = $('input[id=recharge_input11]').val();
    if(re_nov === undefined){
        re_nov = 0;
    }
    var re_dec = $('input[id=recharge_input12]').val();
    if(re_dec === undefined){
        re_dec = 0;
    }
	var barchart44 = new Chart(ctx, {
		type: 'bar',
		data: {
			labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul","Aug","Sep","Oct","Nov","Dec"],
			datasets: [{
                label: 'Recharges',
				data: [re_jan, re_feb, re_mar, re_apr, re_may, re_jun, re_jul,re_aug,re_sep,re_oct,re_nov,re_dec],
				borderWidth: 1,
				yAxisID: "y-axis-1",
                backgroundColor: [
					'#03a9f4',
                    '#03a9f4',
                    '#03a9f4',
                    '#03a9f4',
                    '#03a9f4',
                    '#03a9f4',
                    '#03a9f4',
                    '#03a9f4',
                    '#03a9f4',
                    '#03a9f4',
                    '#03a9f4',
                    '#03a9f4',


				],
				borderColor: [
					'#03a9f4',
                    '#03a9f4',
                    '#03a9f4',
                    '#03a9f4',
                    '#03a9f4',
                    '#03a9f4',
                    '#03a9f4',
                    '#03a9f4',
                    '#03a9f4',
                    '#03a9f4',
                    '#03a9f4',
                    '#03a9f4',
				],
            }]
		},
		options: {

			responsive: true,
			title:{
				display:false,
				text:"Bar Chart Multi Axis"
			},
			tooltips: {
				mode: 'index',
				intersect: true
			},
			scales: {
				yAxes: [{
					type: "linear",
					display: true,
					position: "left",
					id: "y-axis-1",
				}, {
					type: "linear",
					display: false,
					position: "right",
					id: "y-axis-2",
					gridLines: {
						drawOnChartArea: false
					}
				}],
			}
		}
	});



};
bar();
      });

    </script>

    </body>
</html>
