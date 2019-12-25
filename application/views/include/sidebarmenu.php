<div id="sidebar-nav" class="sidebar">
	<div class="sidebar-scroll">
		<nav>
			<ul class="nav">
				<li><a href="<?php echo base_url('dashboard'); ?>" class="active"><i class="lnr lnr-home"></i> <span>Dashboard</span></a></li>
				<?php
					if($userdata->is_admin==1){
				?>
				<li><a href="<?php echo base_url('dashboard'); ?>" class=""><i class="lnr lnr-hourglass"></i> <span>Attendence</span></a></li>
				<li>
					<a href="#users" data-toggle="collapse" class="collapsed"><i class="lnr lnr-user"></i> <span>Users</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
					<div id="users" class="collapse ">
						<ul class="nav">
							<li><a href="#" onclick="getUsersDetails(1,'reg')" class="">Registered</a></li>
							<li><a href="#" onclick="getUsersDetails(0,'reg')" class="">Non Registered</a></li>
							<li><a href="#" onclick="getUsersDetails('Male','gender')" class="">Male</a></li>
							<li><a href="#" onclick="getUsersDetails('Female','gender')" class="">Female</a></li>
						</ul>
					</div>
				</li>
				<li>
					<a href="#reports" data-toggle="collapse" class="collapsed"><i class="lnr lnr-chart-bars"></i> <span>Download Reports</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
					<div id="reports" class="collapse ">
						<ul class="nav">
							<li><a href="<?php echo base_url('userDashboard/downloadCsv/1/reg'); ?>" class="">Registered</a></li>
							<li><a href="<?php echo base_url('userDashboard/downloadCsv/0/reg'); ?>" class="">Non Registered</a></li>
							<li><a href="<?php echo base_url('userDashboard/downloadCsv/male/gender'); ?>" class="">Male</a></li>
							<li><a href="<?php echo base_url('userDashboard/downloadCsv/female/gender'); ?>" class="">Female</a></li>
						</ul>
					</div>
				</li>
				<?php
					}
				?>
			</ul>
		</nav>
	</div>
</div>