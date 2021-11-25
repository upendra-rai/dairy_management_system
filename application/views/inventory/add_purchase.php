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
            border-radius: 0px;

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
                           <h4 style=" line-height:20px; margin:0px; padding:0px; color:#ffffff;">Add Purchase</h4>
                       </div>
				        <div class="search_engine" style=" height:auto; min-height:auto; padding-top:15px; border:1px solid #dddddd; background-color:#f9f9f9; ">

                                <form action=""  method="post">
                                         <div class="container" style="width:100%;">
                                           <div class="row">

                                           <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12" >
                                             <div class="form-group data-custon-pick data-custom-mg" id="data_5">
                                            <div class="input-daterange input-group" id="datepicker" style=" width:100%; margin-bottom:0px;">
                                                <label for="" style="font-weight:100;">Purchase Date</label>
                                                <div class="form-group" id="data_5" style=" height:28px;">
                                                   <input type="text" class="form-control" name="search_date" value="<?php if(isset($return_date)){ echo $return_date; }else{ echo date('d-m-Y'); } ?>" placeholder="Start Date" style="background-color:#ffffff;" required/>
                                                </div>
                                            </div>
                                          </div>
                                          </div>
                                          <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12" >
                                              <label for="" style="font-weight:100;">Supplyer Name</label>
                                              <div class="form-group" id="data_5" >

                                                  <select class="form-control" name="dealer" style="width:100%;" required>
                                                        <option value="">Select Supplyer</option>
                                                        <?php if(isset($select_all_supplyer)){ foreach($select_all_supplyer as $row){ ?>
                                                        <option value="<?php echo $row->supplyer_id; ?>"><?php echo $row->supplyer_name; ?></option>
                                                      <?php }} ?>

                                                  </select>
                                                </div>
                                          </div>
                                          <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12" >
                                             <label for="" style="font-weight:100;">Product</label>
                                              <div class="form-group" id="data_5" >

                                                  <select class="form-control" name="purchase_product_id" style="width:100%;" id="select_product" required>
                                                        <option value="" data-product_unit="">Select Product</option>
                                                        <?php foreach($product_list as $row){ ?>
                                                               <option value="<?php echo $row->product_id; ?>" data-product_unit="<?php echo $row->unit; ?>"> <?php echo $row->product_name; ?> </option>
                                                        <?php } ?>
                                                  </select>
                                                </div>
                                          </div>
                                          <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12" >
                                                <label for="" style="font-weight:100;">Purchase Unit Price</label>
                                              <div class="form-group" id="data_5" >
                                                  <span style="position: absolute; height: 30px; line-height: 34px; padding: 0px 8px; color: #46c7fe;"><i class="fa fa-rupee"></i></span>
                                                  <input type="number" step="0.01" class="form-control" name="purchase_unit_price" value="" placeholder=""  style="width:100%; padding-left:26px;"  required >
                                                </div>
                                          </div>

                                          <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12" >
                                               <label for="" style="font-weight:100;">Purchase Quantity</label>
                                              <div class="form-group" id="data_5" >
                                                    <span style="position: absolute; height: 30px; line-height: 34px; padding: 0px 8px; color: #46c7fe;" id="unit_span">Unit</span>
                                                  <input type="number" step="0.01" class="form-control" name="purchase_qty" value="" placeholder="" style="width:100%; padding-left:30px;" required>
                                                </div>
                                          </div>

                                          <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12" >
                                              <label for="" style="font-weight:100;">Total Purchase Price</label>
                                              <div class="form-group" id="data_5" >
                                                  <span style="position: absolute; height: 30px; line-height: 34px; padding: 0px 8px; color: #46c7fe;"><i class="fa fa-rupee"></i></span>
                                                  <input type="text" class="form-control" name="purchase_product_price" value="" placeholder="" style="width:100%; padding-left:26px;" required readonly>

                                                </div>
                                          </div>

                                          <div class="col-md-2 col-sm-12 col-xs-12" >
                                                <div class="form-group" id="data_5" style=" height:28px;">
                                                     <input type="submit"  class="btn" name="submit" value="submit" style="background-color: #46c7fe; color:#ffffff; width: 100px;"/>
                                                  </div>

                                         </div>

                                        </div>
                                   </div>
                                </form>

				          </div>
				 </div>
               <?php if(isset($select_purchase)){ ?>
                <div class="row">
                    <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">

                        <!-- <div id="myheadtitle" style="margin:0px; height:55px; border-bottom:none; padding-top:15px; font-size: 15.5px; ">
                             Inventory Details<span> <i class="ion-android-arrow-dropright" style="color: #0099cc;"></i></span>
                        </div>-->
                        <div style="padding-top:10px; font-size: 17px;">
                            <p>Purchase Details - <?php if(isset($return_date)){ echo $return_date; } ?></p>
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
								                        <th>Purchase Date</th>
                                        <th>Product Name</th>
                                        <th>Purchase Unit Price</th>
                                        <th>Purchase Quantity</th>
                                        <th>Total Purchase Price</th>
                                        <th>Supplyer Name</th>

                                    </tr>
								                  </thead>
							    	              <tbody id="tran_table">
                                         <?php if(isset($select_purchase)){ $i = 1;  $sum_purchase_price = 0; $sum_purchase_qty = 0; foreach($select_purchase as $row){ ?>
                                             <tr class="product_row">
                                                 <td><?php echo $i++; ?></td>
                                                 <td><?php echo date('d-M-Y',strtotime($row->purchase_date)); ?></td>
                                                 <td><?php echo $row->product_name; ?></td>
                                                 <td><i class="fa fa-rupee" style="color:#46c7fe;"></i>  <?php echo +$row->purchase_unit_price; ?></td>
                                                 <td> <span  style="color:#46c7fe; font-weight:600;"><?php echo $row->unit; ?></span>  <?php echo +$row->purchase_quantity;  $sum_purchase_qty += $row->purchase_quantity; ?></td>
                                                 <td><i class="fa fa-rupee" style="color:#46c7fe;"></i>  <?php echo +$row->purchase_price; $sum_purchase_price += $row->purchase_price; ?></td>
                                                 <td><?php echo $row->supplyer_name; ?></td>

                                            </tr>
                                         <?php }} ?>
							    	                </tbody>
                                    <tfoot>
                                        <tr>
                                            <td style="border:1px solid #dddddd;">Total</td>
                                            <td style="border:1px solid #dddddd;"></td>
                                            <td style="border:1px solid #dddddd;"></td>
                                            <td style="border:1px solid #dddddd;"></td>
                                            <td style="border:1px solid #dddddd;"> <?php echo +$sum_purchase_qty; ?></td>
                                            <td style="border:1px solid #dddddd;"><i class="fa fa-rupee" style="color:#46c7fe;"></i> <?php echo +$sum_purchase_price; ?></td>
                                            <td style="border:1px solid #dddddd;"></td>
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


        $(document).on('change','input[name=search_date]',function(){

          var search_date = $('input[name=search_date]').val();

         window.location.href = '<?php echo base_url(); ?>/inventory/add_purchase/'+search_date;

       });


        $(document).on('click','#success_ok',function(){
                window.location.href = window.location.href;
		});

         $(document).on('click','#error_ok',function(){
                window.location.href = window.location.href;
		    });

        $(document).on('keyup','input[name=purchase_qty]',function(){
               var purchase_unit_price = $('input[name=purchase_unit_price]').val();
               var purchase_qty = $('input[name=purchase_qty]').val();

               if(purchase_unit_price && purchase_qty){
                  var total_purchase = Math.abs(purchase_unit_price * purchase_qty);
                  $('input[name=purchase_product_price]').val(total_purchase);
               }

        });

        $(document).on('keyup','input[name=purchase_unit_price]',function(){
               var purchase_unit_price = $('input[name=purchase_unit_price]').val();
               var purchase_qty = $('input[name=purchase_qty]').val();

               if(purchase_unit_price && purchase_qty){
                  var total_purchase = Math.abs(purchase_unit_price * purchase_qty);
                  $('input[name=purchase_product_price]').val(total_purchase);
               }
      });


        $(document).on('change','select[id=select_product]',function(){
            var unit = $(this).find(':selected').data('product_unit');
            $('#unit_span').text(unit);

       });
     });
    </script>
</body>
</html>
