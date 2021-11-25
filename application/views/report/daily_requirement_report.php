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
                              

                                          <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12" >
                                            <div class="form-group" id="data_5" style=" height:28px;">
                                                <select name="agent_search"  class="form-control" style="width:100%;">
                                                    <option value="">All Agent</option>
                                                     <?php foreach($select_agent as $row){ ?>
                                                     <option style="display: <?php if($row->user_id == 1 || $row->user_id == 21){ echo 'none'; } ?>" value="<?php echo $row->user_id; ?>" <?php if(isset($r_agent)){ if($r_agent == $row->user_id){ echo 'selected'; } } ?> ><?php echo $row->name; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                           </div>
                                     <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12" >
                                            <div class="form-group" id="data_5" style=" height:28px;">
                                                <select name="shift"  class="form-control" style="width:100%;">
                                                    <option value="" >Day</option>
                                                    <option value="morning" <?php if(isset($r_shift)){ if($r_shift == 'morning'){ echo 'selected'; } } ?>  >Morning</option>
                                                     <option value="evening" <?php if(isset($r_shift)){ if($r_shift == 'evening'){ echo 'selected'; } } ?> >Evening</option>
                                                </select>
                                            </div>
                                           </div>
                                     
                                     
                                     <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12" >
                                          <div class="input-daterange input-group" id="datepicker" style=" width:100%;">
                                     
                                                <div class="form-group" id="data_5" style=" height:28px;">
                                                   <input type="text" class="form-control" name="date" value="<?php if(isset($r_date)){ echo $r_date; } ?>" placeholder="Date" style="background-color:#ffffff; text-align:left;" autocomplete="off" />
                                                </div>
                                            
                                         </div> 
                                         </div> 
                                     
                                     
                                          <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12" >
                                            <div class="form-group" id="data_5" style=" height:28px;">
                                                <select name="requirent_type"  class="form-control" style="width:100%;">
                                                    <option value="" >All</option>
                                                    <option value="daily_requirement"  <?php if(isset($r_type)){ if($r_type == 'daily_requirement'){ echo 'selected'; } } ?> >Daily Requirement</option>
                                                     <option value="e_requirement" <?php if(isset($r_type)){ if($r_type == 'e_requirement'){ echo 'selected'; } } ?> >E Requirement</option>
                                                </select>
                                            </div>
                                           </div>

                                          <div class="col-lg-2 col-md-3 col-sm-12 col-xs-12" >
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
                <?php if(isset($requirement)){ ?>
                <div class="row" id="print_area">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <input id="select_agent" type="hidden"  value="<?php if(isset($return_agent)){ echo $return_agent; } ?>">

                         <div style="display: <?php if(isset($r_type)){ if($r_type == 'e_requirement' ){ echo 'none'; } } ?>">
                         <div id="myheadtitle" style="margin:0px; height:40px; border-bottom:none; padding-top:15px; font-size: 15.5px; ">
                             Daily Requirement Report / <span class="agent_p"><?php if(isset($return_agent)){ echo $return_agent; } ?> </span>
                             
                             <button type="button" class="btn" id="print" style="position:absolute; right:260px; margin-top:-5px;">Print</button>  
                        </div>
						<div class="asset-inner">
                                <table id="table" data-toggle="table" data-pagination="true" data-show-columns="true" data-show-pagination-switch="true" data-show-refresh="true" data-key-events="true" data-show-toggle="true"  data-cookie="true"
                                        data-cookie-id-table="saveId" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar" class="table-striped">
                                    <thead>
									<tr>
                                        <th>Sr no.</th>
								        <th>Product</th>
                                        <th>Unit</th>
                                        <th>Unit Price</th>
                                        <th>Require Stock</th>

                                    </tr>
								    </thead>
								  <tbody id="tran_table">
                                     <?php $i = 1; foreach(json_decode($requirement) as $row){ ?>
                                        <tr class="product_row" >
                                                 <td><?php echo $i++; ?></td>
                                                 <td><?php echo $row->product_name; ?></td>
                                                 <td><?php echo $row->unit; ?></td>
                                                 <td><span class="rs_span"><i class="fa fa-rupee"></i> </span> <?php echo $row->unit_price; ?></td>
                                                 <td style="text-align:center;"><?php if(isset($row->product_quantity)){ if($row->unit == 'Pkt'){ echo + number_format($row->product_quantity); }else{ echo + $row->product_quantity; } }else{ echo '0'; } ?> <?php echo $row->unit; ?></td>

                                            </tr>
                                     <?php } ?>
								  </tbody>
								</table>
                            </div>
                        </div>
                        <div style="display: <?php if(isset($r_type)){ if($r_type == 'daily_requirement' ){ echo 'none'; } } ?>">
                           <div id="myheadtitle" style="margin:0px; height:40px; border-bottom:none; padding-top:15px; font-size: 15.5px; ">
                             Daily E Product Requirement Report / <span class="agent_p"><?php if(isset($return_agent)){ echo $return_agent; } ?> </span>
                             
                             <button type="button" class="btn" id="print" style="position:absolute; right:260px; margin-top:-5px;">Print</button>  
                        </div>
						<div class="asset-inner">
                                <table id="table" data-toggle="table" data-pagination="true" data-show-columns="true" data-show-pagination-switch="true" data-show-refresh="true" data-key-events="true" data-show-toggle="true"  data-cookie="true"
                                        data-cookie-id-table="saveId" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar" class="table-striped">
                                    <thead>
									<tr>
                                        <th>Sr no.</th>
								        <th>Product</th>
                                        <th>Unit</th>
                                        <th>Unit Price</th>
                                        <th>Require Stock</th>

                                    </tr>
								    </thead>
								  <tbody id="tran_table">
                                     <?php $i = 1; if(isset($e_requirement)){
    
                                         foreach($e_product as $p_row){ $require_stock_price = 0; $require_stock_qty = 0; 
                                           foreach(json_decode($e_requirement) as $row){ 
                                             if($row->item_id == $p_row->product_id){  $require_stock_qty += $row->item_qty;  
                                          }} ?>
                                        <tr class="product_row" >
                                                 <td><?php echo $i++; ?></td>
                                                 <td><?php echo $row->item_name; ?></td>
                                                 <td></td>
                                                 <td><span class="rs_span"><i class="fa fa-rupee"></i> </span> <?php echo $require_stock_qty*$p_row->product_unit_price; ?></td>
                                                 <td style="text-align:center;"><?php echo $require_stock_qty.' '.$p_row->product_unit; ?></td>

                                            </tr>
                                     <?php }} ?>
								  </tbody>
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
       // select_take();

        $(document).on('click', '#tbl_refresh',function(){

           window.location.href =   window.location.href;

        });

        var agent_name = $('select[name=agent_search] option:selected').html();
          $('span[class=agent_p]').text(agent_name);
       });
    </script>
</body>
</html>
