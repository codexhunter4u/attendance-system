<body onload="getDashboardData()">
	<!-- WRAPPER -->
	<div id="wrapper">
		<!-- NAVBAR -->
		<?php include('include/navbar.php');?>
		<!-- END NAVBAR -->
		<!-- LEFT SIDEBAR -->
		<?php include('include/sidebarmenu.php');?>
		<!-- END LEFT SIDEBAR -->
		<!-- MAIN -->
		<div class="main">
			<!-- MAIN CONTENT -->
			<div class="main-content">
				<div class="container-fluid">
					<div class="panel panel-profile">
						<div class="clearfix">
							<!-- LEFT COLUMN -->
							<div class="profile-left">
								<!-- PROFILE HEADER -->
								<div class="profile-header">
									<div class="overlay"></div>
									<div class="profile-main">
										<?php 
											$img = ($userdata->gender == 'Male') ? 'user-medium.png' : 'female.png'; 
										?>
										<img src="assets/img/<?php echo $img;?>" class="img-circle" alt="Avatar">
										<h3 class="name"><?php echo $userdata->user_name; ?></h3>
										<span class="online-status status-available">Available</span>
									</div>
									<div class="profile-stat">
										<div class="row">
											<div class="col-md-4 stat-item">
												<?php echo $attendence['present']; ?> <span>Present</span>
											</div>
											<div class="col-md-4 stat-item">
												<?php echo $attendence['absent']; ?> <span>Absent</span>
											</div>
											<div class="col-md-4 stat-item">
												52 <span>Totals</span>
											</div>
										</div>
									</div>
								</div>
							</div>
							<!-- END LEFT COLUMN -->
							<!-- RIGHT COLUMN -->
							<div class="profile-right">
								<h4 class="heading">Users Details</h4>
								<!-- AWARDS -->
								<div class="profile-detail">
									<div class="profile-info">
										<h4 class="heading">Basic Info</h4>
										<ul class="list-unstyled list-justify">
											<li>Name <span><?php echo $userdata->user_name; ?></span></li>
											<li>Email <span><?php echo $userdata->user_email; ?></span></li>
											<li>Gender <span><?php echo $userdata->gender; ?></span></li>
											<li>Your Birthday <span><?php echo $userdata->date_of_birth; ?></span></li>
										</ul>
									</div>
									<div class="profile-info">
										<h4 class="heading">Social</h4>
										<ul class="list-inline social-icons">
											<li><a href="#" class="facebook-bg"><i class="fa fa-facebook"></i></a></li>
											<li><a href="#" class="twitter-bg"><i class="fa fa-twitter"></i></a></li>
											<li><a href="#" class="google-plus-bg"><i class="fa fa-google-plus"></i></a></li>
											<li><a href="#" class="github-bg"><i class="fa fa-github"></i></a></li>
										</ul>
									</div>
								</div>
								
								<!-- END TABBED CONTENT -->
							</div>
							<!-- END RIGHT COLUMN -->
						</div>
					</div>
				</div>
			</div>
			<!-- END MAIN CONTENT -->
		</div>
		<div class="clearfix"></div>
</body>
</html>
