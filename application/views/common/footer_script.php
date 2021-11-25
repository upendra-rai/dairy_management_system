 <!-- jquery
		============================================ -->
    <script src="<?php echo base_url('catalogs'); ?>/js/vendor/jquery-1.12.4.min.js"></script>
    <!-- bootstrap JS
		============================================ -->
    <script src="<?php echo base_url('catalogs'); ?>/js/bootstrap.min.js"></script>
    <!-- wow JS
		============================================ -->
    <script src="<?php echo base_url('catalogs'); ?>/js/wow.min.js"></script>
    <!-- price-slider JS
		============================================ -->
    <script src="<?php echo base_url('catalogs'); ?>/js/jquery-price-slider.js"></script>
    <!-- meanmenu JS
		============================================ -->
    <script src="<?php echo base_url('catalogs'); ?>/js/jquery.meanmenu.js"></script>
    <!-- owl.carousel JS
		============================================ -->
    <script src="<?php echo base_url('catalogs'); ?>/js/owl.carousel.min.js"></script>
    <!-- sticky JS
		============================================ -->
    <script src="<?php echo base_url('catalogs'); ?>/js/jquery.sticky.js"></script>
    <!-- scrollUp JS
		============================================ -->
    <script src="<?php echo base_url('catalogs'); ?>/js/jquery.scrollUp.min.js"></script>
    <!-- counterup JS
		============================================ -->
    <script src="<?php echo base_url('catalogs'); ?>/js/counterup/jquery.counterup.min.js"></script>
    <script src="<?php echo base_url('catalogs'); ?>/js/counterup/waypoints.min.js"></script>
    <script src="<?php echo base_url('catalogs'); ?>/js/counterup/counterup-active.js"></script>
    <!-- mCustomScrollbar JS
		============================================ -->
    <script src="<?php echo base_url('catalogs'); ?>/js/scrollbar/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="<?php echo base_url('catalogs'); ?>/js/scrollbar/mCustomScrollbar-active.js"></script>
    <!-- metisMenu JS
		============================================ -->
    <script src="<?php echo base_url('catalogs'); ?>/js/metisMenu/metisMenu.min.js"></script>
    <script src="<?php echo base_url('catalogs'); ?>/js/metisMenu/metisMenu-active.js"></script>
    <!-- morrisjs JS
		============================================ -->
   
    <!-- morrisjs JS
		============================================ -->
    <script src="<?php echo base_url('catalogs'); ?>/js/sparkline/jquery.sparkline.min.js"></script>
    <script src="<?php echo base_url('catalogs'); ?>/js/sparkline/jquery.charts-sparkline.js"></script>
    <script src="<?php echo base_url('catalogs'); ?>/js/sparkline/sparkline-active.js"></script>
    <!-- calendar JS
		============================================ -->
    <script src="<?php echo base_url('catalogs'); ?>/js/calendar/moment.min.js"></script>
    <script src="<?php echo base_url('catalogs'); ?>/js/calendar/fullcalendar.min.js"></script>
    <script src="<?php echo base_url('catalogs'); ?>/js/calendar/fullcalendar-active.js"></script>
	
	<!-- Charts JS
		============================================ -->
    	
    <!-- plugins JS
		============================================ -->
    <script src="<?php echo base_url('catalogs'); ?>/js/plugins.js"></script>
    <!-- main JS
		============================================ -->
    <script src="<?php echo base_url('catalogs'); ?>/js/main.js"></script>
    <!-- tawk chat JS
		============================================ -->
   
	
	<!-- data table JS
		============================================ -->
    <script src="<?php echo base_url('catalogs'); ?>/js/data-table/bootstrap-table.js"></script>
    <script src="<?php echo base_url('catalogs'); ?>/js/data-table/tableExport.js"></script>
    <script src="<?php echo base_url('catalogs'); ?>/js/data-table/data-table-active.js"></script>
    <script src="<?php echo base_url('catalogs'); ?>/js/data-table/bootstrap-table-editable.js"></script>
    <script src="<?php echo base_url('catalogs'); ?>/js/data-table/bootstrap-editable.js"></script>
    <script src="<?php echo base_url('catalogs'); ?>/js/data-table/bootstrap-table-resizable.js"></script>
    <script src="<?php echo base_url('catalogs'); ?>/js/data-table/colResizable-1.5.source.js"></script>
    <script src="<?php echo base_url('catalogs'); ?>/js/data-table/bootstrap-table-export.js"></script>

    
<script type="text/javascript">


$(document).ready(function(){
         $('#profile_div_bt').click(function(){
           window.location.href = '<?php echo base_url(); ?>/dashboard/profile';
        })   
         $('#logout_div_bt').click(function(){
           window.location.href = '<?php echo base_url(); ?>/dashboard/logout';
        }) 
    
         $(document).on('click','input[name=start]',function(){
             $('.match_result').hide();
         });
         $(document).on('click','input[name=end]',function(){
             $('.match_result').hide();
         });
         $(document).on('click','input[name=search_section]',function(){
             $('.match_result').hide();
         });    
         $('input[name=search_section]').keypress(function (e) {
               var key = e.which;
               if(key == 13)  // the enter key code
               {
               $('button[id=search_bt]').click();
               return false;  
               }
         });
    
         $('input[name=start]').keypress(function (e) {
               var key = e.which;
               if(key == 13)  // the enter key code
               {
               $('input[name=end]').focus();
               return false;  
               }
         });
        
        $('input[name=end]').keypress(function (e) {
               var key = e.which;
               if(key == 13)  // the enter key code
               {
               if($('input[name=start]').val() === '' || $('input[name=start]').val() == 'Start Date' ){
                   $('input[name=start]').focus();
               }else{
                  $('button[id=search_date_bt]').click();
                  return false;  
                   
               }   
              
               }
         });
		 $(document).on('click','button[id=search_bt]',function(){
             $('#my_loader').show();
             var search_by  = $('select[id=select_search]').val();
             var linked_id = $('input[name=search_section]').val();
			 if(search_by === "linked_no"){
                         $.ajax({
     		         		 type: 'POST',
     		         		 url: '<?php echo base_url(); ?>search_data/searchbar_card_no',
         
              				 data:{search_by:search_by,linked_id:linked_id},
         
              				 success:function(noti){
         						 $('#my_loader').hide();
              					 $('#match_result1').html(noti).show();
                                 
              				 },
                             error: function(XMLHttpRequest, textStatus, errorThrown) {
                             $('#my_loader').hide();
                             if (XMLHttpRequest.readyState == 4) {
                                
                                 $('#failed_alert').modal("toggle");
                                
                                 // HTTP error (can be checked by XMLHttpRequest.status and XMLHttpRequest.statusText)
                             }
                             else if (XMLHttpRequest.readyState == 0) {
                                 $('#failed_alert').modal("toggle");
                                 
                                 // Network error (i.e. connection refused, access denied due to CORS, etc.)
                             }
                             else {
                                 
                                 $('#failed_alert').modal("toggle");
                                 // something weird is happening
                             }
                           }
              			 });
                    
                }else{
                    $('#my_loader').hide();
                }
         });
	   
	   
	   $(document).on('click','button[id=search_date_bt]',function(){
         $('#my_loader').show();   
         var from_date  = $('input[name=start]').val();
         var to_date  = $('input[name=end]').val();
		    $.ajax({
     				 type: 'POST',
     				 url: '<?php echo base_url(); ?>search_data/search_by_date',
     				 data:{from_date:from_date,to_date:to_date},
     				 success:function(noti){
     					 $('#match_result_date').html(noti).show();
                          $('#my_loader').hide();
                         
     				 },
                     error: function(XMLHttpRequest, textStatus, errorThrown) {
                     $('#my_loader').hide();
                     if (XMLHttpRequest.readyState == 4) {
                        
                         $('#failed_alert').modal("toggle");
                        
                         // HTTP error (can be checked by XMLHttpRequest.status and XMLHttpRequest.statusText)
                     }
                     else if (XMLHttpRequest.readyState == 0) {
                         $('#failed_alert').modal("toggle");
                         
                         // Network error (i.e. connection refused, access denied due to CORS, etc.)
                     }
                     else {
                         
                         $('#failed_alert').modal("toggle");
                         // something weird is happening
                     }
                   }
                    
     	    });
	   });

         
        $(document).on('change','#select_search',function(){
			 var val = $('#select_search').val();
			 $('input[name=search_section]').val('');
             $('.match_result').hide();
            if(val === "name" || val === "colony_id" || val === "mobile_no"){
                
                $('input[name=search_section]').attr('id','search_name_input');
                if(val === "name"){
                    $('input[name=search_section]').attr('placeholder','Search by Customer Name').focus();
                }else if(val === "colony_id"){
                     $('input[name=search_section]').attr('placeholder','Search by Colony Name').focus();
                }else if(val === "mobile_no"){
                    $('input[name=search_section]').attr('placeholder','Search by Mobile no.').focus();
                }
                
            }else{
                $('input[name=search_section]').attr('id','search_input');
                $('input[name=search_section]').attr('placeholder','Search by Card No.').focus();
            }
		}); 
         
        $(document).on('keyup','#search_name_input',function(){
                var search_by  = $('select[id=select_search]').val();
			    var search_for = $('input[id=search_name_input]').val();
                if(search_by === "name"){
                       
                        var fullname = search_for.split(" ");
			        	var firstname = fullname[0];
			        	if(fullname[1] === undefined || fullname[1] === null){
			        		var lastname  = "";
			        	}else{
			        		var lastname  = fullname[1];
			        	}
                        if(search_for.length >= 3){
			        	 $.ajax({
     		         		 type: 'POST',
     		         		 url: '<?php echo base_url(); ?>search_data/searchbar_list',
         
              				 data:{search_by:search_by,firstname:firstname,lastname:lastname},
         
              				 success:function(noti){
         						 
              					 $('#match_result1').html(noti).show();
                                 
              				 }
              			 });
                    
                       }
                }else if(search_by === "colony_id"){
                    
                    if(search_for.length >= 3){
                      $.ajax({
             				 type: 'POST',
             				 url: '<?php echo base_url(); ?>search_data/searchbar_like_colony',
             				 data:{search_by:search_by,search_for:search_for},
     		        		 success:function(noti){
     		        			 $('#match_result1').html(noti).show();
                                
     		        		 }
     		        	 });
                    }
                }else if(search_by === "mobile_no"){
                    if(search_for.length >= 3){
                      $.ajax({
             				 type: 'POST',
             				 url: '<?php echo base_url(); ?>search_data/searchbar_like_list_number',
             				 data:{search_by:search_by,search_for:search_for},
     		        		 success:function(noti){
     		        			 $('#match_result1').html(noti).show();
                                 
     		        		 }
     		        	 });
                    }
                }
            
        });
         
        $(document).on('keydown','#search_name_input',function(){
                var search_by  = $('select[id=select_search]').val();
			    var search_for = $('input[id=search_name_input]').val();
                if(search_by === "name"){
                        var fullname = search_for.split(" ");
			        	var firstname = fullname[0];
			        	if(fullname[1] === undefined || fullname[1] === null){
			        		var lastname  = "";
			        	}else{
			        		var lastname  = fullname[1];
			        	}
                        if(search_for.length >= 3){
			        	 $.ajax({
     		         		 type: 'POST',
     		         		 url: '<?php echo base_url(); ?>search_data/searchbar_list',
         
              				 data:{search_by:search_by,firstname:firstname,lastname:lastname},
         
              				 success:function(noti){
         						 
              					 $('#match_result1').html(noti).show();
                                 
              				 }
              			 });
                    
                       }else{
                         
                         $('#match_result1').html("").hide();
                                
                      }
                }else if(search_by === "colony_id"){
                    if(search_for.length >= 3){
                      $.ajax({
             				 type: 'POST',
             				 url: '<?php echo base_url(); ?>search_data/searchbar_like_list',
             				 data:{search_by:search_by,search_for:search_for},
     		        		 success:function(noti){
     		        			 $('#match_result1').html(noti).show();
                                
     		        		 }
     		        	 });
                    }else{
                    
                    $('#match_result1').html("").hide();
                   }
                }else if(search_by === "mobile_no"){
                    if(search_for.length >= 3){
                      $.ajax({
             				 type: 'POST',
             				 url: '<?php echo base_url(); ?>search_data/searchbar_like_list_number',
             				 data:{search_by:search_by,search_for:search_for},
     		        		 success:function(noti){
     		        			 $('#match_result1').html(noti).show();
                                 
     		        		 }
     		        	 });
                    }else{
                    
                    $('#match_result1').html("").hide();
                    }
                }
        }); 
         
         
         $(document).on('click','.search_li',function(e){
             e.stopPropagation();
            $('#my_loader').show();
             var linked_id = $(this).data("li_link");
             window.location.href = '<?php echo base_url() ?>customer/view_customer/'+linked_id;
		 });
  
    
         $('body').click(function(){
             $('#match_result1').hide();
             $('#match_result_date').hide();
         })
    
         $('#loc_home').click(function(){
             window.location.href = '<?php echo base_url() ?>dashboard';
         });
         $('#loc_back').click(function(){
            window.history.back();
         });   
           
        $('#my_nav').click(function(){
		var sidemenu_width = $('.mobo_menu').width();
		if(sidemenu_width == "0"){
			$('.mobo_menu').show().animate({
                width: 250,
            });
		}else if(sidemenu_width == "220"){
			 $('.mobo_menu').hide(0).animate({
                width: 0,
            });
		}
	   });
    
    
       // check orders 
        function check_orders(){
            
            $.ajax({
                 type: 'POST',
                 url: '<?php echo base_url(); ?>orders/check_orders_count',
                 
     		     success:function(noti){
     		     	
                     if(Number(noti)){
                         if(noti === 0){
                            
                         }else{
                             $('#new_orders_count_span').text(noti).css('display','block');
                         }
                     }
                            
     		      }
           });
        }
        check_orders();
    
       // print file
          $(document).on('click', '#print',function(){

            var divContents = $("#print_area").html();
            var printWindow = window.open('', '', 'height=500,width=800');
            printWindow.document.write('<html><head><title>DIV Contents</title><style type="text/css">.fixed-table-toolbar{display:none;} .fixed-table-loading{display:none;} .fixed-table-pagination{display:none;} p{line-height: 0px;} table tbody tr td{ border:1px solid #4d4d4d; padding:1px 5px; } #print{display:none;}</style>');
            printWindow.document.write('</head><body >');
            printWindow.document.write(divContents);
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print();
           });
    
    
     // check Admin Notification 
        function check_admin_notidication(){
            
            $.ajax({
                 type: 'POST',
                 url: '<?php echo base_url(); ?>dashboard/select_admin_notification',
                 
     		     success:function(noti){
     		     	
                     var count = JSON.parse(noti).list.length;
                     
                     if(count > 0){
                           $('.admin_noti_span').html(count);
                     }else{
                             $('.admin_noti_span').hide();
                     }
                   
                     
                     var my_arr = JSON.parse(noti).list;
                     
                     if(my_arr){
                         
                         for(var i = 0; i < my_arr.length; i++){
                             
                             var createdDate = new Date(my_arr[i].notification_date);
                             var date = createdDate.toLocaleDateString();
                             var day = createdDate.getDate();
                             var month = createdDate.getMonth() + 1; //months are zero based
                             var year = createdDate.getFullYear();
                             
                             var time = createdDate.toLocaleTimeString().replace(/(.*)\D\d+/, '$1');
                             
                             var mydate = day + '-' + month + '-' + year + ' ' + time;
                              
                              var type = my_arr[i].notification_type;
                              var customer_fname = my_arr[i].c_first_name;
                              var customer_lname = my_arr[i].c_last_name;
                              var guest_fname = my_arr[i].first_name;
                             var guest_lname = my_arr[i].last_name;
                             
                              if(type === 'membership_request'){
                                  
                                  var guest_id = my_arr[i].guest_id;
                                  var request_id =  my_arr[i].membership_request_id;
                                 
                                  
                                  var href = '<?php echo base_url(); ?>/user_ragistration/add_ragister_customer/'+guest_id+'/'+request_id;
                                  
                                  $('#admin_notification').prepend('<li style="width:100%; padding:15px; border-bottom:1px solid #ebebeb;"><div class="notification-content"><span class="notification-date" style="font-style:normal;"><a href="'+href+'" style="margin:0px;"><button type="button" class="btn" style="padding:1px 5px; background-color:#46c7fe; color:#ffffff; width:60px;">Manage</button></a></span><h2 style="margin-bottom:4px;"> '+guest_fname+' <br><span style="font-weight:500; font-size:13px;">'+mydate+'</span></h2><p style="margin-bottom:0px;">'+guest_fname+' '+guest_lname+' is requested for Membership</p></div></li>');
                                  
                              }else if(type === 'requirement_update'){
                                  
                                  var customer_id = my_arr[i].customer_id;
                                  var notification_id =  my_arr[i].notification_id;
                                  
                                  var href = '<?php echo base_url(); ?>/dashboard/view_requirement_update/'+customer_id+'/'+notification_id;
                                  
                                  $('#admin_notification').prepend('<li style="width:100%; padding:15px; border-bottom:1px solid #ebebeb;"><div class="notification-content"><span class="notification-date" style="font-style:normal;"><a href="'+href+'" style="margin:0px;"><button type="button" class="btn" style="padding:1px 5px; background-color:#46c7fe; color:#ffffff; width:60px;">View</button></a></span><h2 style="margin-bottom:4px;">'+customer_fname+' <br><span style="font-weight:500; font-size:13px;">'+mydate+'</span></h2><p style="margin-bottom:0px;">'+customer_fname+ ' '+customer_lname+' has changed his dairy requirement</p></div></li>');
                              }
                             
                              
                         }
                         
                        
                     }
                     
     		      }
           });
        }
        check_admin_notidication();
    
       
        function check_new_order(){
            
            $.ajax({
                 type: 'POST',
                 url: '<?php echo base_url(); ?>dashboard/new_order',
                 
     		     success:function(noti){
     		     	
                     
                     var count = JSON.parse(noti).list.length;
                     
                     if(count > 0){
                     $('.new_order_span').html(count);
                     }else{
                         $('.new_order_span').hide();
                     }
                     //var my_arr = JSON.parse(noti).list;
                     var my_arr = JSON.parse(noti).list;
                     //alert(JSON.stringify(my_arr));
                     if(my_arr){
                         
                         for(var i = 0; i < my_arr.length; i++){
                             
                             var createdDate = new Date(my_arr[i].online_order_date);
                             var date = createdDate.toLocaleDateString();
                             var day = createdDate.getDate();
                             var month = createdDate.getMonth() + 1; //months are zero based
                             var year = createdDate.getFullYear();
                             
                             var time = createdDate.toLocaleTimeString().replace(/(.*)\D\d+/, '$1');
                             
                             var mydate = day + '-' + month + '-' + year + ' ' + time;
                              
                              var type = my_arr[i].order_type;
                              var customer_fname = my_arr[i].c_first_name;
                              var customer_lname = my_arr[i].c_last_name;
                              var guest_fname = my_arr[i].first_name;
                             var guest_lname = my_arr[i].last_name;
                             
                              if(type === 'e_order'){
                                  
                                  var guest_id = my_arr[i].guest_id;
                                 
                                  
                                   var href = '<?php echo base_url(); ?>/orders/orders/';
                                  
                                //  $('#order_notification').prepend('<li style="width:100%; padding:15px; border-bottom:1px solid #ebebeb;"><div class="notification-content"><span class="notification-date" style="font-style:normal;"><a href="'+href+'" style="margin:0px;"></a></span><h2 style="margin-bottom:4px;">'+guest_fname+' '+guest_lname+' </h2></div></li>');
                                  
                                  
                                  $('#order_notification').prepend('<a href="'+href+'" style="margin:0px;"><li style="width:100%; padding:15px; border-bottom:1px solid #ebebeb;"><div class="notification-content"><span class="notification-date" style="font-style:normal;">'+mydate+'</span><h2 style="margin-bottom:4px;">'+guest_fname+' '+guest_lname+' </h2></div></li></a>');
                                  
                            
                                  
                              }else if(type === 'membership'){
                                  
                                  var customer_id = my_arr[i].customer_id;
                                  var href = '<?php echo base_url(); ?>/orders/orders/';
                                  
                                  $('#order_notification').prepend('<a href="'+href+'" style="margin:0px;"><li style="width:100%; padding:15px; border-bottom:1px solid #ebebeb;"><div class="notification-content"><span class="notification-date" style="font-style:normal;">'+mydate+'</span><h2 style="margin-bottom:4px;">'+customer_fname+' '+customer_lname+' </h2></div></li></a>');
                              }
                             
                              
                         }
                         
                        
                     }
                     
                     
     		      }
           });
        }
        check_new_order();
    
    
       
         function feedback_notification(){
            
            $.ajax({
                 type: 'POST',
                 url: '<?php echo base_url(); ?>dashboard/feedback_notification',
                 
     		     success:function(noti){
     		     	
                     var count = JSON.parse(noti).list.length;
                     
                     if(count > 0){
                           $('.feedback_noti_span').html(count);
                     }else{
                             $('.feedback_noti_span').hide();
                     }
                   
                     
                     var my_arr = JSON.parse(noti).list;
                     
                     if(my_arr){
                         
                         for(var i = 0; i < my_arr.length; i++){
                             
                             var createdDate = new Date(my_arr[i].time_stamp);
                             var date = createdDate.toLocaleDateString();
                             var day = createdDate.getDate();
                             var month = createdDate.getMonth() + 1; //months are zero based
                             var year = createdDate.getFullYear();
                             
                             var time = createdDate.toLocaleTimeString().replace(/(.*)\D\d+/, '$1');
                             
                             var mydate = day + '-' + month + '-' + year + ' ' + time;
                              
                                  var feedback_id = my_arr[i].feedback_id;
                                  var fname = my_arr[i].first_name;
                                  var lname = my_arr[i].last_name;
                                 
                                  
                                  var href = '<?php echo base_url(); ?>/dashboard/read_feedback/'+feedback_id;
                                  
                                  $('#feedback_notification').prepend('<li style="width:100%; padding:15px; border-bottom:1px solid #ebebeb;"><div class="notification-content"><span class="notification-date" style="font-style:normal;"><a href="'+href+'" style="margin:0px;"><button type="button" class="btn" style="padding:1px 5px; background-color:#46c7fe; color:#ffffff; width:60px;">View</button></a></span><h2 style="margin-bottom:4px; font-weight:600;"> '+fname+' '+lname+' <br><span style="font-weight:500; font-size:13px;">'+mydate+'</span></h2></div></li>');
                                  
                           
                             
                              
                         }
                         
                        
                     }
                     
     		      }
           });
        }
        feedback_notification();
    
    
    
    // Plan countdown
    // Set the date we're counting down to
var countDownDate = new Date("Jan 5, 2022 15:37:25").getTime();

// Update the count down every 1 second
var x = setInterval(function() {

  // Get today's date and time
  var now = new Date().getTime();
    
  // Find the distance between now and the count down date
  var distance = countDownDate - now;
    
  // Time calculations for days, hours, minutes and seconds
  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    
  // Output the result in an element with id="demo"
 // document.getElementById("demo").innerHTML = days + "d " + hours + "h "
 // + minutes + "m " + seconds + "s ";
    
    
     document.getElementById("day_count").innerHTML = days;
     document.getElementById("hour_count").innerHTML = hours;
     document.getElementById("min_count").innerHTML = minutes;
     document.getElementById("sec_count").innerHTML = seconds;
    
  // If the count down is over, write some text 
  if (distance < 0) {
    clearInterval(x);
    document.getElementById("demo").innerHTML = "EXPIRED";
  }
}, 1000);
    
    
    
    
           
});
</script>   