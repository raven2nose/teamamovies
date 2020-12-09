<?php
session_start();
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
		
		<!--Font Awesome CSS-->
		<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
		
		<!--Custom Style CSS-->
		<link rel="stylesheet" type="text/css" href="css/style.css">

		<!--Favicon Image-->
		<link rel="shortcut icon" type="image/png" href="images/icon.png">
		
		<title>TeamAMovie</title>

        <style>
            .about_us p {
                text-align: justify;
                margin: 0 0 10px;
            }
            .about_us .banner img {
              width:100%
            }
        </style>

	</head>

	
  <body>

		<!--Navbar Code - Start-->
		<?php include('header.php'); ?>
    <!--Navbar Code - End-->

	
    <!--About Us Body - Start-->
    <div class="about_us">
			
        <!--Banner Code - Start-->
        <div class="banner">
            <img src="images/banner.jpg?v=<?php echo time(); ?>">
        </div>
        <!--Banner Code - End-->

        <div class="container mt-4" style="line-height:22px; font-size: 14px; color: #606978; font-family:sans-serif">
            <h2 style="font-weight:normal; color: #3f3545; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif; font-size:48px; margin-bottom:30px; padding-top:15px">About Us</h2>
            
            <div>
                <p style="font-size: 18px;"><strong>Project Overview</strong></p>
                <p>TeamAMovie is an online cinema ticket booking website consisting the simulations of booking payments. This website has been designed by the Team A as a project Software Engineering, Hangzhou Dianzi University.</p>
                <p>The project took a duration from mid of September 2020 upto end of December 2020 to get Completed as a functioning website.</p>
                <p>This website is under simulation. This does not actually accept payments.</p>
                <p>&nbsp;</p>
                <p style="font-size: 18px;"><strong>Objective</strong></p>
                <p>&nbsp;</p>
                <p style="font-size: 18px;"><strong>Key Features</strong></p>
                <p class="double_indent">Simple theme and easy handling</p>
                <p class="indent">User accounts can be created and deleted when needed.</p>
                <p class="double_indent">Tickets can be booked for movies in theatres.</p>
                <p class="double_indent">Booked ticket can be cancelled until two hours before the showtime.</p>
                <p class="indent">Available movies, theatres and offers can be viewed in relevant pages of TeamAMovie.</p>
                <p class="indent">Available movies and theatres can be rated by the users.</p>
                <p class="indent">User account can be recovered when password is forgotten.</p>
                <p class="double_indent">User account password can be changed when required.</p>
                <p class="double_indent">Users can contact the admin online through contact us section.</p>
            </div>
        </div>
    </div>
    <!--About Us Body - End-->
        
        
        
	
	<!--Footer Code - Start-->
	<?php include('footer.php') ?>
	<!--Footer Code - End-->
	
	<!-- Optional JavaScript -->
		<script src="js/jquery.min.js"></script>
		<script src="js/popper.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		

		<script>
			$(".site-footer .bottom-footer .footer-item-5").addClass("active");
		</script>

  </body>
</html>