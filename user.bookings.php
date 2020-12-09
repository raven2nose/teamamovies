<?php
session_start();
include_once ('db_config.php');
if(isset($_SESSION['userID']) && !empty($_SESSION['userID']) && !($_SESSION['userID']=='0')) {

    $user = "SELECT * FROM tbl_users WHERE `user_id` = '{$_SESSION['userID']}'";
	$user_result = $db->query($user);
	$user_row = $user_result->fetch_assoc();
?>

<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	
		<!--JQuery Toast CSS-->
        <link rel="stylesheet" type="text/css" href="css/jquery.toast.min.css">

		<!--Custom Style CSS-->
		<link rel="stylesheet" type="text/css" href="css/style.css?v=<?php echo time(); ?>">
		
		<link rel="shortcut icon" type="image/png" href="images/icon.png">
		
        <title>TeamAMovie - <?php echo $user_row['first_name'];?> | Bookings</title>
        
        <style>
            .navbar {
                background:black !important;
            }
            @media (max-width: 575px){
                #ticketIDForm .form-control {
                    margin-bottom: 15px;
                }
                #ticketIDForm .row {
                    margin-left: 0;
                }
                #ticketIDForm .col-sm-8, .col-sm-2 {
                    padding-left: 0;
                    padding-right: 0;
                }
                #publishTicket_ticketIDForm .form-control {
                    margin-bottom: 15px;
                }
                #publishTicket_ticketIDForm .row {
                    margin-left: 0;
                }
                #publishTicket_ticketIDForm .col-sm-7, .col-sm-3 {
                    padding-left: 0;
                    padding-right: 0;
                }
            }
        </style>

	</head>

	
  <body id="itemid-3" style="background-color:#ebebeb">

	<!--Navbar Code - Start-->
    <?php include('header.php'); ?>
    <!--Navbar Code - End-->

	
    <div style="margin-top:100px; margin-bottom:25px">
        <div class="container mt-3" style="background:#FFF;padding-bottom:15px">
            <div style="padding:15px"><h1 style="font-size:35px; font-weight:normal;">Bookings</h1></div>

            <div class="table-responsive" style="padding:0 15px">
                <table id="bookings_table" class="table table-striped table-bordered table-sm">
                    <thead style="text-align:center">
                        <tr>
                            <th>#</th>
                            <th>Ticket ID</th>
                            <th>Booking Time</th>
                            <th>Movie</th>
                            <th>Theater</th>
                            <th>Show Date</th>
                            <th>Show Time</th>
                            <th>Category</th>
                            <th>Ticket Count</th>
                            <th>Seat(s)</th>
                            <th>Total Amount</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $sql = "SELECT A.*, GROUP_CONCAT(A.seat_number ORDER BY A.seat_id ASC) AS seat_number, B.movie_name, C.theatre_name, C.city, E.starting_time FROM tbl_bookings A, tbl_movies B, tbl_theatres C, tbl_shows D, tbl_showtimes E WHERE A.user_id = '{$_SESSION['userID']}' AND A.show_id = D.show_id AND B.movie_id = D.movie_id AND C.theatre_id = D.theatre_id AND A.showtime_id = E.showtime_id GROUP BY A.ticket_id ORDER BY booking_id DESC";
                            $result = $db->query($sql);
                            if($result->num_rows>0){
                                $i=0;
                                while($row=$result->fetch_assoc()){
                                    $i++;
                                    $show_datetime = strtotime($row['show_date']." ".$row['starting_time']);
                                    $current_datetime = time();
                                    $timeDiff =  $show_datetime - $current_datetime;
                                    echo "<tr>";
                                        echo "<td>{$i}</td>";
                                        echo "<td>{$row['ticket_id']}</td>";
                                        echo "<td>{$row['booking_time']}</td>";
                                        echo "<td>{$row['movie_name']}</td>";
                                        echo "<td>{$row['theatre_name']} - {$row['city']}</td>";
                                        echo "<td>{$row['show_date']}</td>";
                                        echo "<td>".date('h:i A', strtotime($row['starting_time']))."</td>";
                                        echo "<td>{$row['ticket_category']}</td>";
                                        echo "<td>"."Full: {$row['full_seat_count']}"."<br>"."Kids: {$row['kids_seat_count']}"."</td>";
                                        echo "<td>{$row['seat_number']}</td>";
                                        echo "<td>RMB ".number_format((float)$row['total_amount'], 2, '.', '')."</td>";
                                        echo "<td style='text-align:center'>";
                                            if($row['status'] == '2'){
                                                echo "<span style='font-weight:bold;color:#c40099'>Sold<br>(&#10003;)</span>";
                                            }else if($row['status'] == '1'){
                                                if ($timeDiff > 3600){
                                                    echo "<span style='font-weight:bold;color:#017ec6'>Published</span>";
                                                }else{
                                                    echo "<span style='font-weight:bold;color:#ce0000'>Not sold<br>(&#10007;)</span>";
                                                }
                                            }else{
                                                if ($timeDiff > 0){
                                                    echo "<span style='font-weight:bold;color:green'>Booked</span>";
                                                }else{
                                                    echo "<span style='font-weight:bold;font-size:20px;color:green'>&#10003;</span>";
                                                }
                                            }
                                            echo "</td>";
                                    echo "</tr>";
                                }
                            }else{
                                echo "<tr><td colspan='12' style='padding-left:7px'>No bookings found.</td></tr>";
                            }
                        ?>
                    </tbody>
                    <tfoot style="text-align:center">
                        <tr>
                            <th>#</th>
                            <th>Ticket ID</th>
                            <th>Booking Time</th>
                            <th>Movie</th>
                            <th>Theater</th>
                            <th>Show Date</th>
                            <th>Show Time</th>
                            <th>Category</th>
                            <th>Ticket Count</th>
                            <th>Seat(s)</th>
                            <th>Total Amount</th>
                            <th>Status</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            
        </div>
    </div>


    <div style="margin-top:25px; margin-bottom:25px">
        <div class="container mt-3" style="background:#FFF;padding-bottom:15px">
            <div style="padding:15px"><h1 style="font-size:35px; font-weight:normal">Purchased Tickets</h1></div>

            <div class="table-responsive" style="padding:0 15px">
                <table id="bookings_table" class="table table-striped table-bordered table-sm">
                    <thead style="text-align:center">
                        <tr>
                            <th>#</th>
                            <th>Ticket ID</th>
                            <th>Booking Time</th>
                            <th>Movie</th>
                            <th>Theater</th>
                            <th>Show Date</th>
                            <th>Show Time</th>
                            <th>Category</th>
                            <th>Ticket Count</th>
                            <th>Seat(s)</th>
                            <th>Total Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $sql = "SELECT A.*, GROUP_CONCAT(A.seat_number ORDER BY A.seat_id ASC) AS seat_number, B.movie_name, C.theatre_name, C.city, E.starting_time, F.timestamp FROM tbl_bookings A, tbl_movies B, tbl_theatres C, tbl_shows D, tbl_showtimes E, tbl_bookings_purchase F WHERE F.user_id = '{$_SESSION['userID']}' AND F.ticket_id = A.ticket_id AND A.show_id = D.show_id AND B.movie_id = D.movie_id AND C.theatre_id = D.theatre_id AND A.showtime_id = E.showtime_id GROUP BY A.ticket_id ORDER BY booking_id DESC";
                            $result = $db->query($sql);
                            if($result->num_rows>0){
                                $i=0;
                                while($row=$result->fetch_assoc()){
                                    $i++;
                                    $show_datetime = strtotime($row['show_date']." ".$row['starting_time']);
                                    $current_datetime = time();
                                    $timeDiff =  $show_datetime - $current_datetime;
                                    echo "<tr>";
                                        echo "<td>{$i}</td>";
                                        echo "<td>{$row['ticket_id']}</td>";
                                        echo "<td>{$row['timestamp']}</td>";
                                        echo "<td>{$row['movie_name']}</td>";
                                        echo "<td>{$row['theatre_name']} - {$row['city']}</td>";
                                        echo "<td>{$row['show_date']}</td>";
                                        echo "<td>".date('h:i A', strtotime($row['starting_time']))."</td>";
                                        echo "<td>{$row['ticket_category']}</td>";
                                        echo "<td>"."Full: {$row['full_seat_count']}"."<br>"."Kids: {$row['kids_seat_count']}"."</td>";
                                        echo "<td>{$row['seat_number']}</td>";
                                        echo "<td>RMB ".number_format((float)$row['total_amount'], 2, '.', '')."</td>";
                                        
                                    echo "</tr>";
                                }
                            }else{
                                echo "<tr><td colspan='11' style='padding-left:7px'>No purchased tickets found.</td></tr>";
                            }
                        ?>
                    </tbody>
                    <tfoot style="text-align:center">
                        <tr>
                            <th>#</th>
                            <th>Ticket ID</th>
                            <th>Booking Time</th>
                            <th>Movie</th>
                            <th>Theater</th>
                            <th>Show Date</th>
                            <th>Show Time</th>
                            <th>Category</th>
                            <th>Ticket Count</th>
                            <th>Seat(s)</th>
                            <th>Total Amount</th>
                        </tr>
                    </tfoot>
                </table>
            </div>

        </div>
    </div>
        
  
        
	
	<!--Footer Code - Start-->
	<?php include('footer.php') ?>
	<!--Footer Code - End-->
	
	<!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.toast.min.js"></script>
		

   
  </body>
</html>

<?php
}else{
    header('location: index.php');
}
?>