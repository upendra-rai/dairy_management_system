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
     <link rel="stylesheet" href="<?php echo base_url('catalogs'); ?>/css/select2/select2.min.css">
     <link rel="stylesheet" href="<?php echo base_url('catalogs'); ?>/css/chosen/bootstrap-chosen.css">
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

                                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12" >
                                          <div class="chosen-select-single mg-b-20">
                                                <select data-placeholder="Choose a Country..." class="chosen-select" name="customer_id" tabindex="-1">
                                                <option value="">Search Customer</option>
                                                <?php if(isset($all_customer_list)){ foreach($all_customer_list as $row){ ?>
                                                    <option value="<?php echo $row->customer_id; ?>">
                                                       <?php echo $row->atm_card_no; ?> <?php echo $row->first_name.' '.$row->last_name ?>

                                                      </option>

                                                 <?php }} ?>
													                       </select>
                                            </div>

                                          <!--<div class="form-group" id="data_5" style=" height:28px;">
                                                <input type="text" class="form-control" name="card_no" value="<?php if(isset($return_card)){ echo $return_card; } ?>" placeholder="Card No" style="background-color:#ffffff; width:100%;" required/>
                                            </div> -->
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
               <?php if(isset($purchase_report)){ ?>


                <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" >
                            <div style=" margin-top:15px;">
                            <div style="padding-top:10px; font-size: 17px; color:#262d31;">
                                <p>Customer Monthly Purchase Report</p>
                            </div>
                            <div>
                               <?php if(isset($customer_details[0])){ ?>
                                    <p> Customer Name : <?php  echo $customer_details[0]->first_name.' '.$customer_details[0]->last_name; ?> </p>
                                    <p> Card No. :  <?php  echo $customer_details[0]->atm_card_no; ?> </p>
                                    <p> Mobile No. :  <?php  echo $customer_details[0]->contact_1; ?> </p>
                                    <p> Available Ballance. :  <?php  echo $customer_details[0]->balance_amount; ?> </p>
                               <?php   } ?>
                            </div>
    						        <div class="asset-inner" >
                               <table id="table" data-toggle="table" data-show-columns="true" data-show-pagination-switch="true"  data-key-events="true" data-show-toggle="true"  data-cookie="true"
                                            data-cookie-id-table="saveId" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">
                                   <thead>
    								                   	<tr>
                                            <th>Sr No.</th>
    								                        <th>Dates</th>
                                            <th>Products</th>
                                            <th>Produced Qty</th>
                                            <th>Sold Qty</th>
                                            <th>Remaining Qty</th>

                                            <th>Purchase</th>
                                            <th>Profit</th>


                                        </tr>
    								              </thead>
    							    	          <tbody id="tran_table">
                                  <?php $i = 1; $recharge_total = 0; $mydate = ''; $mydate2 = ''; foreach(json_decode($purchase_report) as $row){ ?>
                                    <tr style="border:1px solid blue;">

                                       <?php if($mydate2 != $row->date){$mydate2 = $row->date;    ?>
                                       <td rowspan="<?php echo $row->total_product_no; ?>"><?php echo $i++; ?></td>
                                       <td rowspan="<?php echo $row->total_product_no; ?>"><?php echo $row->date; ?></td>
                                       <?php  }  ?>
                                       <td><?php echo $row->product_name; ?></td>
                                       <td><?php if($row->produced_qty != '-'){ echo +$row->produced_qty; }else{ echo '-'; } ?></td>
                                       <td><?php if($row->sold_qty != '-'){ echo +$row->sold_qty;}else{ echo '-'; } ?></td>
                                       <td><?php if($row->remaining_qty != '-'){ echo +$row->remaining_qty;}else{ echo '-'; } ?></td>
                                       <?php if($mydate != $row->date){$mydate = $row->date;    ?>
                                         <td rowspan="<?php echo $row->total_product_no; ?>"><?php if($row->raw_material_qty != '-'){ ?> <?php echo $row->raw_material_name; ?> <?php echo +$row->raw_material_qty; echo $row->purchase_unit; ?>  <br> Purchase Price: RS. <?php echo +$row->raw_material_price; ?> <br> Sold Price: Rs. <?php echo +$row->sum_sold_price; ?>   <?php }else{ echo '-'; } ?> </td>
                                         <td rowspan="<?php echo $row->total_product_no; ?>"><?php echo $row->sum_sold_price; ?> </td>
                                        <?php  }  ?>
                                     </tr>
                                  <?php } ?>
    							    	          </tbody>
                                        <tfoot>

                                            <tr>
                                                <td style="border:1px solid #dddddd;">Total</td>
                                                <td style="border:1px solid #dddddd;"></td>
                                                <td style="border:1px solid #dddddd;"></td>
                                                <td style="border:1px solid #dddddd;"></td>
                                                <td style="border:1px solid #dddddd;">Total</td>
                                                <td style="border:1px solid #dddddd;"></td>
                                                <td style="border:1px solid #dddddd;"></td>
                                                <td style="border:1px solid #dddddd;"></td>

                                            </tr>

                                        </tfoot>
    								             </table>



                                </div>
                        </div>
                      </div>
                    </div>

                <?php } ?>

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
    <!-- chosen JS
 		============================================ -->
     <script src="<?php echo base_url('catalogs'); ?>/js/chosen/chosen.jquery.js"></script>
     <script src="<?php echo base_url('catalogs'); ?>/js/chosen/chosen-active.js"></script>
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
