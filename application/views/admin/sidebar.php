<div class="col s2 sidebar z-depth-3">
	<div class="logo center">
		<div class="header">NAVIGASI</div>
	</div>
	<div class="content">
		<div class="group">
			<div class="subheader">
				<a href="<?php echo base_url ('admin'); ?>">
					<div class="col s3"><i class="material-icons">home</i></div>
					<div class="col s9">Dashboard</div>
				</a>
			</div>
		</div>
		<div class="group">
			<div class="subheader">
				<div class="col s3"><i class="material-icons">local_library</i></div>
				<div class="col s9">Kelas</div>
			</div>
			<div class="link"><a href="<?php echo base_url ('admin/pengaturan_kelas'); ?>">Pengaturan Kelas</a></div>
			<div class="link"><a href="<?php echo base_url ('admin/anggota_kelas'); ?>">Anggota Kelas</a></div>
		</div>
		<div class="group">
			<div class="subheader">
				<div class="col s3"><i class="material-icons">person</i></div>
				<div class="col s9">Siswa</div>
			</div>
			<div class="link"><a href="<?php echo base_url ('admin/data_siswa'); ?>">Data Siswa</a></div>
			<div class="link"><a href="<?php echo base_url ('admin/input_data_siswa'); ?>">Input Data Siswa</a></div>
		</div>
		<div class="group">
			<div class="subheader">
				<div class="col s3"><i class="material-icons">event_available</i></div>
				<div class="col s9">Absensi</div>
			</div>
			<div class="link"><a href="<?php echo base_url ('admin/histori_absensi'); ?>">Histori Absensi</a></div>
			<div class="link"><a href="<?php echo base_url ('admin/input_absensi'); ?>">Inputasi Absensi</a></div>
		</div>
	</div>
</div>