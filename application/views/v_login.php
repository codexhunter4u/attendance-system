<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
?>

<body>
	<!-- WRAPPER -->
	<div id="wrapper">
		<div class="vertical-align-wrap">
			<div class="vertical-align-middle">
				<div class="auth-box ">
					<div class="left">
						<div class="content">
							<div class="header">
								<div class="logo text-center"><img src="assets/img/stallion.png" alt="Stallion Logo"></div>
								<p class="lead">Login to your account</p>
							</div>
							<div class="col-md-12 formLogin">
								<form class="form-auth-small" action="#" id="frmLogin" name="frmLogin">
									<div class="form-group">
										<input type="email" class="form-control" id="username" name="user_name" placeholder="Enter username">
									</div>
									<div class="form-group">
										<input type="password" class="form-control" id="userpassword" name="password" placeholder="Password">
									</div>
									<div class="form-group clearfix">
										<label class="fancy-checkbox element-left">
											<input type="checkbox" id="brand" class='rememberMe' value="loggedIn">
											<span>Remember me</span>
										</label>
									</div>
									<button type="button" class="btn btn-primary btn-lg btn-block" id="signIn">LOGIN</button>
									<div class="bottom">
										<span class="helper-text"><i class="fa fa-lock"></i> <a href="#" id="resetPassBtn">Forgot password?</a></span>
									</div>
								</form>
							</div>
							<div class="col-md-12 formRegister">
								<form class="form-auth-small" action="#" name="userRegister" id="userRegister">
									<div class="form-group">
										<input type="text" class="form-control" name="user_name" id="user_name" placeholder="Enter Name">
									</div>
									<div class="form-group">
										<input type="text" class="form-control" name="date_of_birth" id="date_of_birth" placeholder="Enter date of birth">
									</div>
									<div class="form-group">
										<input type="email" class="form-control" name="user_email" id="user_email" placeholder="Enter your email">
									</div>
									<div class="form-group">
										<input type="password" class="form-control" name="password" id="password" placeholder="Password">
									</div>
									<div class="form-group">
										<input type="password" class="form-control" name="user_confirmpassword" id="user_confirmpassword" placeholder="Confirm Password">
									</div>
									<div class="form-group" style="margin-left:-116px;">
										<label>Gender</label>
										<label class="radio-inline"><input type="radio" name="gender" value="Male" 
											name="gender">Male</label>
										<label class="radio-inline"><input type="radio" name="gender" value="Female" 
											name="gender">Female</label>
									</div>
								</form>
								<button type="button" id="registerBtn" class="btn btn-primary btn-lg btn-block">Register</button>
							</div>
							<div class="col-md-12 formPasswordReset">
								<form class="form-auth-small" action="#" id="frmPassReset" name="frmPassReset">
									<div class="form-group">
										<input type="email" class="form-control" id="useremail" name="useremail" placeholder="Enter username">
									</div>
									<div class="form-group">
										<input type="password" class="form-control" id="usernewpassword" name="usernewpassword" placeholder="Password">
									</div>
									<button type="button" class="btn btn-primary btn-lg btn-block" id="resetPass">RESET</button>
								</form>
							</div>
						</div>
					</div>
					<div class="right">
						<div class="overlay"></div>
						<div class="content text">
							<h1 class="heading">Register here for Stallion club and enjoy the party on floor...</h1>
							<hr>
							<p><button type="button" class="btn btn-warning btn-lg" id="registerEvent">Register</button></p>
						</div>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
	</div>
	<!-- END WRAPPER -->
</body>
</html>