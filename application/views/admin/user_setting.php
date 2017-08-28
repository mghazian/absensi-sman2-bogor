<div class="col s10">
	<?php show_error_message(); ?>
	<?php show_success_message(); ?>
	<div class="card">
		<div class="card-content blue darken-2 white-text">
			<h5>Pengaturan akun</h5>
		</div>
		<div class="card-content">
			<div class="row">
				<form method="POST" action="<?php echo base_url ('admin/submit/user/ganti_pass'); ?>">
					<h5>Ubah password</h5>
					<div class="col s3">
						<div class="input-field">
							<input type="password" name="password_lama" placeholder="Password lama">
							<label>Password lama</label>
						</div>
					</div>
					<div class="col s3">
						<div class="input-field">
							<input type="password" name="password_baru" placeholder="Password baru">
							<label>Password baru</label>
						</div>
					</div>
					<div class="col s3">
						<div class="input-field">
							<input type="password" name="re_password_baru" placeholder="Ulangi password baru">
							<label>Ulangi password baru</label>
						</div>
					</div>
					<button type="submit" class="btn"><i class="material-icons right">send</i>Ganti</button>
				</form>
			</div>
		</div>
	</div>
</div>