    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?php if($this->session->userdata('title')){  echo $this->session->userdata('title'); } ?></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=1024">
    <!-- favicon
		============================================ -->
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
    <!-- Google Fonts
		============================================ -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700,900" rel="stylesheet">
    <!-- Bootstrap CSS
		============================================ -->
    <link rel="stylesheet" href="<?php echo base_url('catalogs'); ?>/css/bootstrap.min.css">
    <!-- Bootstrap CSS
		============================================ -->
    <link rel="stylesheet" href="<?php echo base_url('catalogs'); ?>/css/font-awesome.min.css">
    <!-- owl.carousel CSS
		============================================ -->
    <link rel="stylesheet" href="<?php echo base_url('catalogs'); ?>/css/owl.carousel.css">
    <link rel="stylesheet" href="<?php echo base_url('catalogs'); ?>/css/owl.theme.css">
    <link rel="stylesheet" href="<?php echo base_url('catalogs'); ?>/css/owl.transitions.css">
    <!-- animate CSS
		============================================ -->
    <link rel="stylesheet" href="<?php echo base_url('catalogs'); ?>/css/animate.css">
    <!-- normalize CSS
		============================================ -->
    <link rel="stylesheet" href="<?php echo base_url('catalogs'); ?>/css/normalize.css">
    <!-- meanmenu icon CSS
		============================================ -->
    <link rel="stylesheet" href="<?php echo base_url('catalogs'); ?>/css/meanmenu.min.css">
    <!-- main CSS
		============================================ -->
    <link rel="stylesheet" href="<?php echo base_url('catalogs'); ?>/css/main.css">
    <!-- educate icon CSS
		============================================ -->
    <link rel="stylesheet" href="<?php echo base_url('catalogs'); ?>/css/educate-custon-icon.css">
    <!-- morrisjs CSS
		============================================ -->
    <link rel="stylesheet" href="<?php echo base_url('catalogs'); ?>/css/morrisjs/morris.css">
    <!-- mCustomScrollbar CSS
		============================================ -->
    <link rel="stylesheet" href="<?php echo base_url('catalogs'); ?>/css/scrollbar/jquery.mCustomScrollbar.min.css">
    <!-- metisMenu CSS
		============================================ -->
    <link rel="stylesheet" href="<?php echo base_url('catalogs'); ?>/css/metisMenu/metisMenu.min.css">
    <link rel="stylesheet" href="<?php echo base_url('catalogs'); ?>/css/metisMenu/metisMenu-vertical.css">
    <!-- calendar CSS
		============================================ -->
    <link rel="stylesheet" href="<?php echo base_url('catalogs'); ?>/css/calendar/fullcalendar.min.css">
    <link rel="stylesheet" href="<?php echo base_url('catalogs'); ?>/css/calendar/fullcalendar.print.min.css">
    <!-- style CSS
		============================================ -->
    <link rel="stylesheet" href="<?php echo base_url('catalogs'); ?>/style.css">
    <!-- responsive CSS
		============================================ -->
    <link rel="stylesheet" href="<?php echo base_url('catalogs'); ?>/css/responsive.css">
	<link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <!-- modernizr JS
		============================================ -->
    <script src="<?php echo base_url('catalogs'); ?>/js/vendor/modernizr-2.8.3.min.js"></script>
	<!-- normalize CSS
		============================================ -->
    <link rel="stylesheet" href="<?php echo base_url('catalogs'); ?>/css/data-table/bootstrap-table.css">
    <link rel="stylesheet" href="<?php echo base_url('catalogs'); ?>/css/data-table/bootstrap-editable.css">

	<link rel="stylesheet" href="<?php echo base_url('catalogs'); ?>/css/ionicons/css/ionicons.min.css">
	<style type="text/css">
    .head_title{
        color:#ffffff; font-size: 26px; margin-top:5px;
          text-shadow: 2px 2px 4px #000000;
        font-weight: 600;
        }
	.mycard{


	-webkit-box-shadow: 0px 2px 7px -3px rgba(33,111,255,1);
-moz-box-shadow: 0px 2px 7px -3px rgba(33,111,255,1);
box-shadow: 0px 2px 7px -3px rgba(33,111,255,1);
	background-color:#ffffff;
	}
	.headbar{

	width:100%;
	height:40px;
	font-family: "Arial";
	font-size:15px;
	padding-top:5px;
	color:#333333;
	border-bottom: 1px solid #d8d8d8;
	margin-bottom: 25px;
	}
	#table tbody tr td{

       padding:7px;

	}

	.mybt{

	background-color:#2c6be0;

	}

	.search_engine{

		padding-top: 7px;
		height:40px;

	}
	.search_engine .mycard{

		padding: 15px;
	}
	.search_engine .sr-input-func{
	  width:100%;
    }

	.search_engine .sr-input-func .search_input{
	width:100%;
	border-radius: 0px;
	border: 1px solid transparent;
	border-bottom: 1px solid #46c7fe;
	padding-left:0px;
	margin-top:5px;
	margin-bottom:5px;
   }
   .search_engine .sr-input-func .search_input:focus{
	border-radius: 0px;
	padding-left:0px;
	border: 1px solid transparent;
	border-bottom: 1px solid #46c7fe;
   }


   .search_engine .sr-input-func a{
	   padding: 3px 5px;
	   background-color: #46c7fe;
	   color:#ffffff;
       right:0px;
   }

   .st_active{

	   color:#2196f3;
	   text-transform: uppercase;
   }
   .st_deactive{

	   text-transform: uppercase;
	   color:#ff0909;
   }
#top_titile{
        height: 60px;
        background-color: #ffffff;
        display: none;
 }

@media (max-width:980px) and (min-width:280px){

      #top_titile{
          display: block;
      }
      .title_bar_second_box{
          position:relative;
         width:100%;

      }
    
    #print{
        display:none;
    }

  }


.mobo_menu{
	position: absolute;
	width:0px;
	height: 100vh;
	background-color: rgba(0,0,0,0.85);
	z-index: 2122;
	top:0;
	left:0;
	bottom:0;
	padding: 30px 15px;
	box-shadow: 3px 0px 5px -1px rgba(0,0,0.4);
	display:none;
}
.mobo_menu .mobo_menu_box{

}
.mobo_menu .mobo_menu_box li{
	font-size:13px;
	font-weight:600;
	color:#ffffff;
	margin-bottom:20px;
}
.mobo_menu .mobo_menu_box li a{
    text-transform: uppercase;
	color:#ffffff;

}

 #my_nav{
     display: none;
 }
@media (max-width:1000px) and (min-width:280px){
    #my_nav{
     display: block;
 }

}
.profile_menu{
    display:none;
    position: absolute;
    width:100px;
    height:;
    background-color: #ffffff;
    top: 40px;
    margin-left: 124px;
    z-index: 1999;
     border: 1px solid #9a9a9a;
}
        .profile_menu a{
            padding: 0px;
        }
        .profile_menu .div_li{
            width: 100%;
            height: 30px;
            color: #1c1c1c;
            padding: 5px;
            padding-left: 15px;
            text-align: left;


        }

        .profile_menu .div_li:hover{
            cursor: pointer;
            background-color: #232323;
            color:#ffffff;
        }

        .active_submenu{
            border: 1px solid #111517;
            background-color: #161b1d;

        }

        .active_submenu a span{


        }

.menu_counting_span{
float: right;
background-color: red;
padding: 2px;
width: 20px;
height: 20px;
line-height: 14px;
font-size: 11px;
text-align: center;
border-radius: 4px;
        }
        
        
        
        #my_count_down{
      color: #ffffff;
    text-align: center;
    float: left;
    margin-top: -3px;
        }
        #my_count_down .count_box{
              border: 1px solid #3e3c3c;
    padding: 4px;
    padding-top: 3px;
    width: 50px;
    display: inline-block;
    background-color: #303332;
}
        
        #my_count_down .count_box .count_title{
             margin-top: -1px;
    display: block;
    background-color: #232323;
    color: #ffffff;
    font-size: 9px;
    text-align: center;
    border-top: none;
    padding: 1px;
   
    height: 17px;
        }
</style>
