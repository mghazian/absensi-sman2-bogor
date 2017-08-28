<?php show_error_message(); ?>
<div style="padding: 20px">
	<div class="col s7">
	</div>
	<div class="col s5 valign-wrapper gray lighten-2 z-depth-2">
		<div class="col s3"><h4>LOGIN</h4></div>
		<div class="col s9" style="padding: 20px">
			<div class="content">
				<form method="POST" action="<?php echo base_url ('home/submit/login/auth'); ?>">
					<div class="input-field">
						<input type="text" name="username" placeholder="Username">
						<label>Username</label>
					</div>
					<div class="input-field">
						<input type="password" name="password" placeholder="Password">
						<label>Password</label>
					</div>
					<button type="submit" class="btn"><i class="material-icons right">send</i>Login</button>
				</form>
			</div>
		</div>
	</div>
</div>