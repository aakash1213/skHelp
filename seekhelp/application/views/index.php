<!DOCTYPE html>
<!--[if IE 8]><html class="ie ie8"> <![endif]-->
<!--[if IE 9]><html class="ie ie9"> <![endif]-->
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Market Research Nest">
  	<meta name="author" content="Market Research Nest">
  	<title>Market Research Nest</title>

    <!-- Favicons-->
    <link rel="shortcut icon" href="<?php echo BASE_PATH; ?>assets/img/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" type="image/x-icon" href="<?php echo BASE_PATH; ?>assets/img/apple-touch-icon-57x57-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="<?php echo BASE_PATH; ?>assets/img/apple-touch-icon-72x72-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="114x114" href="<?php echo BASE_PATH; ?>assets/img/apple-touch-icon-114x114-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="144x144" href="<?php echo BASE_PATH; ?>assets/img/apple-touch-icon-144x144-precomposed.png">

	<!-- Google web fonts -->
    <link href="https://fonts.googleapis.com/css?family=Gochi+Hand|Lato:300,400|Montserrat:400,400i,700,700i" rel="stylesheet">

    <!-- CSS -->
    <link href="<?php echo BASE_PATH; ?>assets/css/base.css" rel="stylesheet">

    <!-- SPECIFIC CSS -->
    <link href="<?php echo BASE_PATH; ?>assets/css/skins/square/grey.css" rel="stylesheet">
    <link href="<?php echo BASE_PATH; ?>assets/css/date_time_picker.css" rel="stylesheet">
    <link href="<?php echo BASE_PATH; ?>assets/css/font-awesome.min.css" rel="stylesheet">

    <!--[if lt IE 9]>
      <script src="<?php echo BASE_PATH; ?>assets/js/html5shiv.min.js"></script>
      <script src="<?php echo BASE_PATH; ?>assets/js/respond.min.js"></script>
    <![endif]-->

</head>
<body>

<!--[if lte IE 8]>
    <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a>.</p>
<![endif]-->

    <div id="preloader">
        <div class="sk-spinner sk-spinner-wave">
            <div class="sk-rect1"></div>
            <div class="sk-rect2"></div>
            <div class="sk-rect3"></div>
            <div class="sk-rect4"></div>
            <div class="sk-rect5"></div>
        </div>
    </div>
    <!-- End Preload -->

    <div class="layer"></div>
    <!-- Mobile menu overlay mask -->

     <!-- Header================================================== -->
    <?php include "header.php";?>
	<section id="search_container">
		<div id="search">
			<div class="tab-content">
				<div class="tab-pane active" id="tours">
					<h3 align="center">Bring An <span>Idea</span>, And Get A <span>Report</span>.</h3>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group" align="center">
                                <form id="search_form" action="<?php echo BASE_URL; ?>report/search" method="post" >
								                    <input type="text" class="form-control" id="firstname_booking" name="firstname_booking" placeholder="Type your search terms" style="margin-bottom:10px;">
                                    <div id="suggestions">
                                        <div id="autoSuggestionsList"></div>
                                    </div>
                                    <a href="javascript:void(0);"><button type="submit" class="btn_1 green"><i class="icon-search"></i>Search now</button></a>
                                </form>
							</div>
						</div>
					</div>
					<!-- End row -->

					<!-- End row -->
          <div align="center">

        </div>
				</div>
				<!-- End rab -->

			</div>
		</div>
	</section>
	<!-- End hero -->

	<main>
    <div class="container margin_60">

			<div class="main_title">
				<h2>Some <span>good</span> reasons</h2>

			</div>

			<div class="row">

				<div class="col-md-4 wow zoomIn" data-wow-delay="0.2s">
					<div class="feature_home">
						<i class="icon_set_1_icon-41"></i>
						<h3><span>World wide</span> Publishers</h3>
						<p>
							Market Research Reports from hundreds of renowned publishers from all over world.
						</p>
						<a href="<?php echo BASE_URL; ?>home/aboutus" class="btn_1 outline">Read more</a>
					</div>
				</div>

				<div class="col-md-4 wow zoomIn" data-wow-delay="0.4s">
					<div class="feature_home">
						<i class="icon-doc-text-inv"></i>
						<h3><span>Customized</span> Reports</h3>
						<p>
							Specialized tailor-made services such as competitive analysis and specialized reports.
						</p>
						<a href="<?php echo BASE_URL; ?>home/aboutus" class="btn_1 outline">Read more</a>
					</div>
				</div>

				<div class="col-md-4 wow zoomIn" data-wow-delay="0.6s">
					<div class="feature_home">
						<i class="icon_set_1_icon-57"></i>
						<h3><span>24 x 7</span> Support</h3>
						<p>
							Experienced market research professionals to help organizations find best solution..
						</p>
						<a href="<?php echo BASE_URL; ?>home/aboutus" class="btn_1 outline">Read more</a>
					</div>
				</div>

			</div>
    </div>


		<div class="white_bg">
			<div class="container margin_60">
				<div class="main_title">
					<h2>FEATURED <span>CATEGORIES</span></h2>
          <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>

				</div>
				<div class="row add_bottom_45">
					<div class="col-md-3 other_tours">
						<ul>
							<li><a href="<?php echo BASE_URL; ?>report/search/Agriculture"><i class="icon-pagelines"></i> AGRICULTURE</a>
							</li>
							<li><a href="<?php echo BASE_URL; ?>report/search/Consumer_Goods"><i class=" icon-shop"></i> CONSUMER GOODS</a>
							</li>
							<li><a href="<?php echo BASE_URL; ?>report/search/Energy"><i class="icon-lightbulb"></i> ENERGY</a>
							</li>
							<li><a href="<?php echo BASE_URL; ?>report/search/Pharmaceuticals_and_Healthcare"><i class=" icon-pharmacy"></i> PHARMACEUTICALS & HEALTHCARE</a>
							</li>

						</ul>
					</div>
					<div class="col-md-3 other_tours">
						<ul>
							<li><a href="<?php echo BASE_URL; ?>report/search/Automotive"><i class="icon-truck"></i> AUTOMOTIVE</a>
							</li>
							<li><a href="<?php echo BASE_URL; ?>report/search/Aerospace_and_Defense"><i class="icon-plane"></i> AEROSPACE & DEFENCE</a>
							</li>
							<li><a href="<?php echo BASE_URL; ?>report/search/Food_and_Beverage"><i class=" icon-food"></i> FOOD & BEVERAGE</a>
							</li>
							<li><a href="<?php echo BASE_URL; ?>report/search/Manufacturing_and_Construction"><i class="icon-building"></i> MANUFACTURING & CONSTRUCTION</a>
							</li>

						</ul>
					</div>
					<div class="col-md-3 other_tours">
						<ul>
							<li><a href="<?php echo BASE_URL; ?>report/search/Medical_Devices"><i class="icon-stethoscope"></i> MEDICAL DEVICES</a>
							</li>
							<li><a href="<?php echo BASE_URL; ?>report/search/Machinery_and_Equipments"><i class="icon-cogs"></i> MACHINERY & EQUIPMENTS</a>
							</li>
							<li><a href="<?php echo BASE_URL; ?>report/search/Semiconductor_and_Electronics"><i class="icon-sweden"></i> SEMICONDUCTOR & ELECTRONICS</a>
							</li>
							<li><a href="<?php echo BASE_URL; ?>report/search/Travel_and_Tourism"><i class="icon-globe"></i> TRAVEL & TOURISM</a>
							</li>

						</ul>
					</div>
                    <div class="col-md-3 other_tours">
						<ul>
                            <li><a href="<?php echo BASE_URL; ?>report/search/Chemicals_and_Materials"><i class=" icon-flask"></i> CHEMICALS & MATERIALS</a>
							</li>
							<li><a href="<?php echo BASE_URL; ?>report/search/Business_and_Finance"><i class="icon-chart-bar-3"></i> BUSINESS & FINANCE</a>
							</li>
							<li><a href="<?php echo BASE_URL; ?>report/search/It_and_Telecom"><i class="icon-laptop"></i> IT AND TELECOM</a>
							</li>
							<li><a href="<?php echo BASE_URL; ?>report/search/Company_Profiles"><i class="icon-industrial-building"></i> COMPANY PROFILES</a>
							</li>
						</ul>
					</div>
				</div>
				<!-- End row -->
				<!-- End row -->
			</div>
			<!-- End container -->
		</div>
		<!-- End white_bg -->

    <div class="container margin_60">

  			<div class="main_title">
  				<h2>Latest <span>Reports</span></h2>
  				<p>Quisque at tortor a libero posuere laoreet vitae sed arcu. Curabitur consequat.</p>
  			</div>

  			<div class="row">

  				<?php 
            foreach ($reports as $row) {
          ?>
          <div class="col-md-3 col-sm-6 wow zoomIn" data-wow-delay="0.1s" style="visibility: visible; animation-delay: 0.1s; animation-name: zoomIn;">
            <div class="tour_container">
              <div class="img_container">
                <a href="<?php echo BASE_URL.$row['url']; ?>">
                  <img src="<?php echo BASE_PATH; ?>assets/img/image/tour_box_1.jpg" width="800" height="533" class="img-responsive" alt="Image">
                </a>
              </div>
              <div class="tour_title">
                <h3><?php echo $row['Title']; ?></h3>
              </div>
            </div>
            <!-- End box tour -->
          </div>
          <!-- End col-md-4 -->
          <?php
            }
          ?>

  			</div>
  			<!-- End row -->


  			<p class="text-center nopadding">
  				<a href="<?php echo BASE_URL; ?>report/latestreports/" class="btn_1 medium"><i class="icon-eye-7"></i>View More </a>
  			</p>
  		</div>
		<!-- End section -->



    <div class="white_bg">
		    <div class="container margin_60">

          			<div class="row">
          				<div class="col-md-6 col-sm-6 hidden-xs">
          					<img src="<?php echo BASE_PATH; ?>assets/img/image/laptop.png" alt="Laptop" class="img-responsive laptop">
          				</div>
          				<div class="col-md-6 col-sm-6">
          					<h3><span>Get started</span> with Market Research Nest</h3>
          					<p>
          						Lorem ipsum dolor sit amet, vix erat audiam ei. Cum doctus civibus efficiantur in. Nec id tempor imperdiet deterruisset.
          					</p>
          					<ul class="list_order">
          						<li><span>1</span>Search</li>
          						<li><span>2</span>Select</li>
          						<li><span>3</span>Buy</li>
          					</ul>
          					<a href="<?php echo BASE_URL; ?>report/search" class="btn_1">Start now</a>
          				</div>
          			</div>
			<!-- End row -->

		  </div>
    </div>



    <div class="container margin_60">
      <div class="wrapper">
        <div class="col-lg-3 col-md-3" style="margin-bottom:20px;">
          <div class="counter " align="center">
            <i class="fa fa-file-o fa-2x"></i>
            <h2 class="timer count-title count-number" data-to="100000" data-speed="1500"></h2>
            <p class="count-text ">Reports Available</p>
          </div>
        </div>
        <div class="col-lg-3 col-md-3"  style="margin-bottom:20px;">
          <div class="counter " align="center">
            <i class="fa fa-users fa-2x"></i>
            <h2 class="timer count-title count-number" data-to="100" data-speed="1500">+</h2>
            <p class="count-text ">Publishers</p>
          </div>
        </div>
        <div class="col-lg-3 col-md-3" style="margin-bottom:20px;">
          <div class="counter" align="center">
            <i class="fa fa-globe fa-2x"></i>
            <h2 class="timer count-title count-number" data-to="20" data-speed="1500"></h2>
            <p class="count-text ">Countries</p>
          </div>
        </div>
        <div class="col-lg-3 col-md-3" style="margin-bottom:20px;">
          <div class="counter" align="center">
            <i class="fa fa-list fa-2x"></i>
            <h2 class="timer count-title count-number" data-to="16" data-speed="1500"></h2>
            <p class="count-text ">Categories</p>
          </div>
        </div>

      </div>
      </div>
		<!-- End container -->



    <div class="white_bg">
      <div class="container margin_60">

    			<div class="main_title">
    				<h2>Our <span>Clients</span></h2>
    				<p>Quisque at tortor a libero posuere laoreet vitae sed arcu. Curabitur consequat.</p>
    			</div>

    			<div class="row">

    				<div class="col-md-2 col-sm-4 wow " >
              <div class="tour_container">
    							<a href="#">
    								<img src="<?php echo BASE_PATH; ?>assets/img/image/tour_box_4.jpg"  class="img-responsive" alt="Image">
    							</a>
    					</div>
    					<!-- End box tour -->
    				</div>
    				<!-- End col-md-4 -->

    				<div class="col-md-2 col-sm-4">
              <div class="tour_container">
    							<a href="#">
    								<img src="<?php echo BASE_PATH; ?>assets/img/image/tour_box_4.jpg"  class="img-responsive" alt="Image">
    							</a>
    					</div>
    					<!-- End box tour -->
    				</div>
    				<!-- End col-md-4 -->

    				<div class="col-md-2 col-sm-4" >
              <div class="tour_container">
    							<a href="#">
    								<img src="<?php echo BASE_PATH; ?>assets/img/image/tour_box_4.jpg"  class="img-responsive" alt="Image">
    							</a>
    					</div>
    					<!-- End box tour -->
    				</div>

            <div class="col-md-2 col-sm-4" >
              <div class="tour_container">
    							<a href="#">
    								<img src="<?php echo BASE_PATH; ?>assets/img/image/tour_box_4.jpg"  class="img-responsive" alt="Image">
    							</a>
    					</div>
    					<!-- End box tour -->
    				</div>
            <div class="col-md-2 col-sm-4" >
              <div class="tour_container">
    							<a href="#">
    								<img src="<?php echo BASE_PATH; ?>assets/img/image/tour_box_4.jpg"  class="img-responsive" alt="Image">
    							</a>
    					</div>
    					<!-- End box tour -->
    				</div>
            <div class="col-md-2 col-sm-4" >
              <div class="tour_container">
    							<a href="#">
    								<img src="<?php echo BASE_PATH; ?>assets/img/image/tour_box_4.jpg"  class="img-responsive" alt="Image">
    							</a>
    					</div>
    					<!-- End box tour -->
    				</div>
    				<!-- End col-md-4 -->


    				<!-- End col-md-4 -->
    			</div>
    			<!-- End row -->
    			<p class="text-center nopadding">
    				<a href="<?php echo BASE_URL; ?>home/clients" class="btn_1 medium"><i class="icon-eye-7"></i>View More </a>
    			</p>
    		</div>
    </div>



	</main>
	<!-- End main -->
  <?php include "footer.php";?>




 <!-- Common scripts -->
<script src="<?php echo BASE_PATH; ?>assets/js/jquery-2.2.4.min.js"></script>
<script src="<?php echo BASE_PATH; ?>assets/js/common_scripts_min.js"></script>
<script src="<?php echo BASE_PATH; ?>assets/js/functions.js"></script>

 <!-- Specific scripts -->
<script src="<?php echo BASE_PATH; ?>assets/js/icheck.js"></script>
<script>
$('input').iCheck({
   checkboxClass: 'icheckbox_square-grey',
   radioClass: 'iradio_square-grey'
 });
 </script>
 <script src="<?php echo BASE_PATH; ?>assets/js/bootstrap-datepicker.js"></script>
 <script src="<?php echo BASE_PATH; ?>assets/js/bootstrap-timepicker.js"></script>
 <script>
  $('input.date-pick').datepicker('setDate', 'today');
  $('input.time-pick').timepicker({
    minuteStep: 15,
    showInpunts: false
})
</script>
<script src="<?php echo BASE_PATH; ?>assets/js/jquery.ddslick.js"></script>
<script>
    $("select.ddslick").each(function(){
            $(this).ddslick({
                showSelectedHTML: true
            });
        });
    
    $("#firstname_booking").keyup(function() {
        if($("#firstname_booking").val().length>3){
            $.ajax({
                type: "post",
                url: "<?php echo BASE_URL; ?>report/live_search",
                cache: false,    
                data:'search='+$("#firstname_booking").val(),
                success: function(response){
                    $('#finalResult').html("");
                    var obj = JSON.parse(response);
                    if(obj.length>0){
                        try{
                          var items=[];  
                          $.each(obj, function(i,val){           
                              items.push($('<li/>').text(val.cat_name));
                          }); 
                            $('#suggestions').show();
                            $('#autoSuggestionsList').addClass('auto_list');
                            $('#autoSuggestionsList').html(items)
                        }catch(e) {  
                              alert('Exception while request..');
                          }  
                      }else{
                        $('#suggestions').show();
                        $('#autoSuggestionsList').addClass('auto_list');                            
                        $('#autoSuggestionsList').html($('<li/>').text("No Data Found"));  
                   }  

                },error: function(){      
                    alert('Error while request..');
                }
            });
        }
        return false;
    });

    $(".auto_list li").click(function(){
        alert($(this).text());
    });
</script>
<style type="text/css">
    #autoSuggestionsList > li {
        border-bottom: 1px solid #cccccc;
        list-style: none outside none;
        padding: 3px 15px 3px 15px;
        text-align: left;
    }

    #autoSuggestionsList > li a { color: #800000; }

    .auto_list {
        border: 1px solid #cccccc;
        border-radius: 5px 5px 5px 5px;
        position: absolute;
    }

    #suggestions {
        top: 63%;
        position: absolute;
        left: 4.5%;
    }
</style>
<!-- for live search -->

</body>
</html>
