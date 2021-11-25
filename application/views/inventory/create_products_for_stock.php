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

     <link rel="stylesheet" href="<?php echo base_url('catalogs'); ?>/css/modals.css">

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

    .message{
            width:100%;
            height:40px;

            padding-top:8px;
            text-align:center; color:red;

            display: none;

        }
        .message.error{
              color: #ffffff;
             background-color: #e91e63;
             border:1px solid #e91e63;
        }
        .message.success{
             color: #ffffff;
             background-color: #4caf50;
             border:1px solid #4caf50;
        }
        .message.card{
             color: #ffffff;
             background-color: #ff9600;
             border:1px solid #ff9600;
        }
    .product-status-wrap h4 {
    font-size: 18px;
    margin-bottom: 10px;
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
             <div style="margin-bottom:0px;">
                  <div class="message error" id="error_msg" style="display:<?php if(isset($message) && $message === "failed"){ echo "block"; } ?>">
                      Process is failed!
                      <button type="button" title="close" style="background-color:transparent; border:none; float:right;">X</button>
                      <br>
                  </div>
                 <div class="message success" style="display:<?php if(isset($message) && $message === "success"){ echo "block"; } ?>">
                     Product is successfully added.
                     <button type="button" title="close" style="background-color:transparent; border:none; float:right;">X</button>
                     <br>
                  </div>
                   <div class="message error" id="not_enough_stock" style="display:<?php if(isset($message) && $message === "insufficent"){ echo "block"; } ?>">
                       You do not have enough stock.
                      <button type="button" title="close" style="background-color:transparent; border:none; float:right;">X</button>
                      <br>
                   </div>
               </div>
            <div class="product-status-wrap mycard" style="padding:15px; padding-top:5px;">
                <div class="row" style="background-color:#ffffff; padding: 0px 10px; margin-top: 5px;">
                       <div style="width:100%; height:30px; padding: 5px 15px; background-color:#46c7fe; ">
                           <h4 style=" line-height:20px; margin:0px; padding:0px; color:#ffffff;">Manage Dairy Stock</h4>
                       </div>
				        <div class="search_engine" style=" height:auto; min-height:70px; padding-top:15px; border:1px solid #dddddd; background-color:#f9f9f9; ">
                            <div class="breadcome-heading" style=" padding-bottom:15px;">
                                <form action=""  method="post">

                                 <div class="form-group data-custon-pick data-custom-mg" id="data_5">
                                           <div class="col-lg-2 col-md-2col-sm-2 col-xs-12" >
                                            <div class="input-daterange input-group" id="datepicker" style=" width:100%;">

                                                <div class="form-group" id="data_5" style=" height:28px;">
                                                   <input type="text" class="form-control" name="search_date" value="<?php if(isset($return_date)){ echo $return_date; }else{ echo date('d-m-Y'); } ?>" placeholder="Start Date" style="background-color:#ffffff;"/>
                                                </div>
                                            </div>
                                           </div>

                                          <div class="col-md-2 col-sm-12 col-xs-12" >
                                                <div class="form-group" id="data_5" style=" height:28px;">
                                                     <input type="button" id="stcok_search" class="btn" data-action="<?php if(isset($action)){ echo $action; } ?>" value="Search" style="background-color: #46c7fe; color:#ffffff; width: 100px;"/>
                                                  </div>
                                              <input type="hidden" value="insert" name="action" />

                                              <input type="hidden" value="<?php if(isset($return_date)){ echo $return_date; } ?>" name="return_date" />
                                           </div>


                                    </div>
                                </form>
                             </div>
				          </div>
				 </div>
               <?php if(isset($select_product)){ ?>
                <div class="row">
                    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">

                        <!-- <div id="myheadtitle" style="margin:0px; height:55px; border-bottom:none; padding-top:15px; font-size: 15.5px; ">
                             Inventory Details<span> <i class="ion-android-arrow-dropright" style="color: #0099cc;"></i></span>
                        </div>-->
                        <div style="padding-top:10px; font-size: 17px;">
                            <p>Stock Details - <?php if(isset($return_date)){ echo $return_date; } ?></p>
                          <!--ul id="breadcrumbs-one">
                           <li><a href="">Stock Details </a></li>
                           <li><a href=""><?php if(isset($return_date)){ echo $return_date; } ?></a></li>

                           </ul> -->
                        </div>
						<div class="asset-inner" >
                                <table id="table" data-toggle="table"    data-key-events="true"   data-cookie="true"
                                          class="table-striped">
                                    <thead>
									<tr>
                                        <th>Sr No.</th>
								        <th>Product</th>
                                        <th>Unit</th>
                                        <th>Unit Price</th>
                                        <th>Produced Stock</th>
                                        <th>Available Stock</th>
                                        <th>Add Quantity</th>

                                        <!--<th>Assign</th>-->
                                    </tr>
								    </thead>
							    	  <tbody id="tran_table">
                                         <?php if(isset($select_product)){ $i = 1; foreach($select_product as $row){ ?>
                                             <tr class="product_row" data-product_id="<?php echo $row->product_id; ?>" >
                                                 <td><?php echo $i++; ?></td>
                                                 <td><?php echo $row->product_name; ?></td>
                                                 <td><?php echo $row->unit; ?></td>
                                                 <td><?php echo $row->product_price; ?></td>
                                                 <td><?php if(isset($row->produced_qty)){ if($row->unit == 'Pkt'){ echo number_format($row->produced_qty); }else{ echo +$row->produced_qty; } }else{ echo '0'; } ?></td>
                                                 <td>
                                                     <input type="text"  value="<?php if(isset($row->remaining_qty)){ if($row->unit == 'Pkt'){ echo number_format($row->remaining_qty); }else{ echo +$row->remaining_qty; } }else{ echo 0; } ?>" name="available_stock" readonly style="width:80px;  text-align:center; height:25px; border:1px solid <?php if(isset($row->remaining_qty)){ if($row->remaining_qty > 0){ echo '#41ec00'; }else{ echo '#ff5e5e'; }} ?> ">
                                                </td>
                                                 <td><input type="text" value="" name="new_quantity" data-unit="<?php echo $row->unit; ?>" style="width: 80px; text-align:center; border: 1px solid #46c7fe;" ></td>

                                            </tr>
                                         <?php }} ?>
							    	  </tbody>
                                    <tfoot>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td><button type="button" class="btn btn-primary" id="submit_stock" style="background-color:#46c7fe; color:#ffffff; border: 1px solid #46c7fe; ">Submit  &nbsp <img src="<?php echo base_url(); ?>catalogs/img/loader.gif" alt="" style="width:17px; display:none;" class="load_img"></button></td>
                                        </tr>
                                    </tfoot>
								</table>
                            </div>
                    </div>

                </div>

                <?php } ?>
            </div>
	    </div>

                 <div id="success_alert" class="modal modal-edu-general default-popup-PrimaryModal fade" role="dialog" data-backdrop="static" data-keyboard="false" style="width:460px; margin:auto;">
                            <div class="modal-dialog" style="width:90%;">
                                <div class="modal-content">
                                    <!--<div class="modal-close-area modal-close-df">
                                        <a class="close" data-dismiss="modal" href="#"><i class="fa fa-close"></i></a>
                                    </div>-->
                                    <div class="modal-body" style="padding: 30px 30px;">
                                        <i class="educate-icon educate-checked modal-check-pro"></i>
                                        <h2>Done!</h2>
                                        <p class="success_model_p"></p>
                                    </div>
                                    <div class="modal-footer">

                                       <button class="btn btn-primary" type="button" id="success_ok" style="width:80px; background-color:#2c6be0;">OK</button>

                                    </div>
                                </div>
                            </div>
                       </div>
			           <div id="failed_alert" class="modal modal-edu-general FullColor-popup-DangerModal fade" role="dialog" data-backdrop="static" data-keyboard="false" style="width:460px; margin:auto;">
                            <div class="modal-dialog" style="width:90%;">
                                <div class="modal-content">

                                    <div class="modal-body" style="padding: 30px 30px;">
                                        <span class="educate-icon educate-danger modal-check-pro information-icon-pro"></span>
                                        <h2>Error!</h2>
                                        <p class="fail_model_p">Sorry opration is failed! Try Again!</p>
                                    </div>
                                    <div class="modal-footer danger-md">

                                        <button class="btn btn-primary" type="button" id="error_ok" style="width:80px; background-color:#2c6be0;">OK</button>

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

    <script src="<?php echo base_url('catalogs'); ?>/js/datapicker/bootstrap-datepicker.js"></script>

     <script type="text/javascript">
function validateNumber(evt) {

    var g = $(this).val();
    alert(g);

    var e = evt || window.event;
    var key = e.keyCode || e.which;

    if (!e.shiftKey && !e.altKey && !e.ctrlKey &&
    // numbers
    key >= 48 && key <= 57 ||
    // Numeric keypad
    key >= 96 && key <= 105 ||
    // Backspace and Tab and Enter
    key == 8 || key == 9 || key == 13 ||
    // Home and End
    key == 35 || key == 36 ||
    // left and right arrows
    key == 37 || key == 39 ||
    // Del and Ins
    key == 46 || key == 45 || key == 173 || key == 190) {
        // input is VALID
    }
    else {
        // input is INVALID
        e.returnValue = false;
        if (e.preventDefault) e.preventDefault();
    }
}


 function AllowOnlyNumbers(e) {

    e = (e) ? e : window.event;
    var key = null;
    var charsKeys = [
        97, // a  Ctrl + a Select All
        65, // A Ctrl + A Select All
        99, // c Ctrl + c Copy
        67, // C Ctrl + C Copy
        118, // v Ctrl + v paste
        86, // V Ctrl + V paste
        115, // s Ctrl + s save
        83, // S Ctrl + S save
        112, // p Ctrl + p print
        80 // P Ctrl + P print
    ];

    var specialKeys = [
    8, // backspace
    9, // tab
    27, // escape
    13, // enter
    35, // Home & shiftKey +  #
    36, // End & shiftKey + $
    37, // left arrow &  shiftKey + %
    39, //right arrow & '
    46, // delete & .
    45 //Ins &  -
    ];

    key = e.keyCode ? e.keyCode : e.which ? e.which : e.charCode;

    //console.log("e.charCode: " + e.charCode + ", " + "e.which: " + e.which + ", " + "e.keyCode: " + e.keyCode);
    //console.log(String.fromCharCode(key));

    // check if pressed key is not number
    if (key && key < 48 || key > 57) {

        //Allow: Ctrl + char for action save, print, copy, ...etc
        if ((e.ctrlKey && charsKeys.indexOf(key) != -1) ||
            //Fix Issue: f1 : f12 Or Ctrl + f1 : f12, in Firefox browser
            (navigator.userAgent.indexOf("Firefox") != -1 && ((e.ctrlKey && e.keyCode && e.keyCode > 0 && key >= 112 && key <= 123) || (e.keyCode && e.keyCode > 0 && key && key >= 112 && key <= 123)))) {
            return true
        }
            // Allow: Special Keys
        else if (specialKeys.indexOf(key) != -1) {
            //Fix Issue: right arrow & Delete & ins in FireFox
            if ((key == 39 || key == 45)) {
                return (navigator.userAgent.indexOf("Firefox") != -1 && e.keyCode != undefined && e.keyCode > 0);
            }
                //DisAllow : "#" & "$" & "%"
            else if (e.shiftKey && (key == 35 || key == 36 || key == 37)) {
                return false;
            }else if(key == 106){
				return true
			}
            else {
                return true;
            }
        }
        else {
            return false;
        }
    }
    else {
        return true;
       }
    }




</script>
    <script type="text/javascript">
       $(document).ready(function(){
        var date = new Date();
        //var today = date.getDate()+'-'+date.getMonth()+'-'+date.getFullYear();
        $('#data_5 .input-daterange').datepicker({
            startDate: date,
    		startView: 3,
    		keyboardNavigation: false,
    		forceParse: false,
    		autoclose: true,
    		todayBtn: "linked",
            todayHighlight: false,
    		format: "dd-mm-yyyy"
    	});

          $(document).on('keyup','input[name=quantity]',function(){

              var price = $(this).val();
              var quantity = $('input[name=unit_price]').val();

              var total_price =  Math.abs(price*quantity);

               $('input[name=total_price]').val(total_price);
         });
        $(document).on('click','#stcok_search',function(){

          var search_date = $('input[name=search_date]').val();

         window.location.href = '<?php echo base_url(); ?>/inventory/dairy_stock/'+search_date;

        });

       $(document).on('click','#submit_stock',function(){


           var stock_date = $('input[name=return_date]').val();
           var action = $('input[id=stcok_search]').data('action');

           var product_id_array = [];
           var product_qty_array = [];

          $('.product_row').each(function(){

              var product_id = $(this).data('product_id');
              product_id_array.push(product_id);

              var product_qty = $(this).find('input[name=new_quantity]').val()

              if(product_qty !== ''){
              product_qty_array.push(product_qty);
              }else{
                  product_qty_array.push(0);

              }
          });


           if(product_id_array != '' && (/[^0]/).exec(product_qty_array.join(""))  && action !== '' && stock_date !== ''){
               $('#submit_stock').prop('disabled', true);
               $('input[name=new_quantity]').val('');
               $.ajax({

                        type: 'POST',
						url: '<?php echo base_url(); ?>inventory/add_dairy_stock',
						data: {product_id_array:product_id_array,product_qty_array:product_qty_array,stock_date:stock_date,action:action},
						beforeSend: function(){

							$('#submit_stock').text('Processing..');

						},

						success: function(data){

                            if(data == "success"){
                                $('p[class=success_model_p]').text("Stock is successfully added.");
				            		$('#success_alert').modal("toggle");
				            	}else{
				            		$('#failed_alert').modal("toggle");
				            	}


                       }

                  });

           }

       });

        $(document).on('click','#success_ok',function(){
                window.location.href = window.location.href;
		});

         $(document).on('click','#error_ok',function(){
                window.location.href = window.location.href;
		});

        $(document).on('keydown','input[name=new_quantity]',function(event){

            var unit = $(this).data('unit');
            if(unit === 'Pkt'){
                   var e = event || window.event;
                   var key = e.keyCode || e.which;

                   if (!e.shiftKey && !e.altKey && !e.ctrlKey &&
                   // numbers
                   key >= 48 && key <= 57 ||
                   // Numeric keypad
                   key >= 96 && key <= 105 ||
                   // Backspace and Tab and Enter
                   key == 8 || key == 9 || key == 13 ||
                   // Home and End
                   key == 35 || key == 36 ||
                   // left and right arrows
                   key == 37 || key == 39 ||
                   // Del and Ins
                   key == 46 || key == 45 || key == 173) {
                   }
                   else {
                         // input is INVALID
                        e.returnValue = false;
                        if (e.preventDefault) e.preventDefault();
                    }
            }else{
                   var e = event || window.event;
                   var key = e.keyCode || e.which;

                   if (!e.shiftKey && !e.altKey && !e.ctrlKey &&
                   // numbers
                   key >= 48 && key <= 57 ||
                   // Numeric keypad
                   key >= 96 && key <= 105 ||
                   // Backspace and Tab and Enter
                   key == 8 || key == 9 || key == 13 ||
                   // Home and End
                   key == 35 || key == 36 ||
                   // left and right arrows
                   key == 37 || key == 39 ||
                   // Del and Ins
                   key == 46 || key == 45 || key == 173 || key == 190 || key == 110) {
                   }
                   else {

                       // input is INVALID
                       e.returnValue = false;
                       if (e.preventDefault) e.preventDefault();
                   }
            }
         });


       $(document).on('keyup','input[name=new_quantity]',function(event){
                var available_stock = $(this).parent().parent().find('input[name=available_stock]').val();
                var added_quantity = $(this).val();
                var cal = (Number(available_stock) + Number(added_quantity));
                if(cal < 0){
                    $(this).val(-available_stock);
                }
       });

       });
    </script>
</body>
</html>
