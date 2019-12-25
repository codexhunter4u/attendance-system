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
					<!-- OVERVIEW -->
					<div class="panel panel-headline">
						<div class="panel-heading">
							<h3 class="panel-title">Yearly Overview</h3>
							<p class="panel-subtitle">Period: Jan 01, 2019 - Dec 31, 2019</p>
						</div>
						<div class="panel-body">
							<div class="row">
								<div class="col-md-3">
									<div class="metric">
										<span class="icon fa-success"><i class="fa fa-thumbs-up"></i></span>
										<p>
											<span class="number"><?php echo $userCount['registered'];?></span>
											<span class="title">Registred</span>
										</p>
									</div>
								</div>
								<div class="col-md-3">
									<div class="metric">
										<span class="icon fa-danger"><i class="fa fa-thumbs-down"></i></span>
										<p>
											<span class="number"><?php echo $userCount['nonregistered'];?></span>
											<span class="title">Non Registered</span>
										</p>
									</div>
								</div>
								<div class="col-md-3">
									<div class="metric">
										<span class="icon fa-primary"><i class="fa fa-user"></i></span>
										<p>
											<span class="number"><?php echo $userCount['male'];?></span>
											<span class="title">Male</span>
										</p>
									</div>
								</div>
								<div class="col-md-3">
									<div class="metric">
										<span class="icon fa-primary"><i class="fa fa-female"></i></span>
										<p>
											<span class="number"><?php echo $userCount['female'];?></span>
											<span class="title">Female</span>
										</p>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-9">
									<!-- RECENT PURCHASES -->
							<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">All Users</h3>
									<div class="right">
										<button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
										<button type="button" class="btn-remove"><i class="lnr lnr-cross"></i></button>
									</div>
								</div>
								<div class="panel-body no-padding">
									<table class="table table-bordered tblUsers" id="tblUsers">
										<thead>
											<tr>
												<th>Sr. No.</th>
												<th>User Name</th>
												<th>User Email</th>
												<th>User Type</th>
												<th>User Status</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody id="tblUsersBody">
											
										</tbody>
									</table>
								</div>
								
							</div>
							<!-- END RECENT PURCHASES -->
								</div>
								<div class="col-md-3">
									<div class="weekly-summary text-right">
										<span class="number total-register">
										<?php 
											if($AttCount['registered']['att_count'] > 50){
												$class = "fa fa-caret-up text-success";
											}else{
												$class = "fa fa-caret-down text-danger";
											}
										?>
										<?php echo $AttCount['registered']['att_count']; ?></span> <span class="percentage"><i class="<?php echo $class; ?>"></i>
										<?php echo $AttCount['registered']['per']; ?>%</span>
										<span class="info-label">Registered</span>
									</div>
									<div class="weekly-summary text-right">
										<span class="number total-non-register">
										<?php 
											if($AttCount['nonregistered']['att_count'] > 50){
												$class = "fa fa-caret-up text-success";
											}else{
												$class = "fa fa-caret-down text-danger";
											}
										?>		
										<?php echo $AttCount['nonregistered']['att_count']; ?></span> <span class="percentage"><i class="<?php echo $class; ?>"></i> 
										<?php echo $AttCount['nonregistered']['per']; ?>%</span>
										<span class="info-label">Non Registered</span>
									</div>
									<div class="weekly-summary text-right">
										<span class="number total-male">
											<?php 
												if($AttCount['male']['att_count'] > 50){
													$class = "fa fa-caret-up text-success";
												}else{
													$class = "fa fa-caret-down text-danger";
												}
											?>
											<?php echo $AttCount['male']['att_count']; ?></span> <span class="percentage"><i class="<?php echo $class; ?>"></i> 
												<?php echo $AttCount['nonregistered']['per']; ?>%</span>
										<span class="info-label">Male</span>
									</div>
									<div class="weekly-summary text-right">
										<span class="number total-male">
											<?php 
												if($AttCount['female']['att_count'] > 50){
													$class = "fa fa-caret-up text-success";
												}else{
													$class = "fa fa-caret-down text-danger";
												}
											?>
											<?php echo $AttCount['female']['att_count']; ?></span> <span class="percentage"><i class="<?php echo $class; ?>"></i> <?php echo $AttCount['nonregistered']['per']; ?>%</span>
										<span class="info-label">Female</span>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- END OVERVIEW -->
			</div>
			<!-- END MAIN CONTENT -->
		</div>
		<!-- END MAIN -->
		<div class="clearfix"></div>
	</div>
</body>
</html>
