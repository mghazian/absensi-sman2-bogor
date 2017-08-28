<div class="col s10">
	<?php show_error_message(); ?>
	<?php show_success_message(); ?>
	<div class="section">
		
		<div class="card blue lighten-1">
			<div class="card-content white-text">
				<h4>Input Absensi</h4>
				<p>Laman untuk memasukkan data kehadiran siswa</p>
			</div>

			<div class="card-content white">
				<div class="card red darken-3">
					<div class="card-content white-text">
						<h5><strong><i class="material-icons">info</i> PERHATIAN</strong></h5>
						<p>File yang diimport harus mengikuti ketentuan berikut:</p>
						<ol>
							<li>File berekstensi csv</li>
							<li>Format csv memiliki tiga kolom:</li>
							<ol>
								<li>Nomor induk siswa (NIS)</li>
								<li>Status presensi</li>
							</ol>
							<li>Baris pertama tidak boleh berupa nama kolom (seperti "NIS", "Nama", "Status", dll.)</li>
							<li>Satu file yang diimport hanya berisi presensi satu kelas pada satu hari tertentu</li>
						</ol>
						<p>Status presensi yang diperbolehkan adalah sebagai berikut:</p>
						<ol>
							<li><strong>H</strong> - artinya hadir</li>
							<li><strong>S</strong> - artinya sakit</li>
							<li><strong>I</strong> - artinya izin</li>
							<li><strong>A</strong> - artinya alfa</li>
							<li><strong>T</strong> - artinya terlambat</li>
							<li><strong>D</strong> - artinya mendapat dispensasi</li>
						</ol>
					</div>
				</div>
				<div class="row">
					<form action="<?php echo base_url ('admin/submit/absensi/import_absensi'); ?>" method="POST" enctype="multipart/form-data">
						<div class="file-field input-field">
							<div class="btn">
								<i class="material-icons left">file_upload</i>
								<span>FILE</span>
								<input type="file" name="absensi">
							</div>
							<div class="file-path-wrapper">
								<input class="file-path" type="text">
							</div>
						</div>
						<div class="input-field">
							<i class="material-icons prefix">event</i> 
							<input type="text" class="datepicker" name="tanggal" />
							<label>Tanggal kehadiran</label>
						</div>
						<button type="submit" class="btn"><i class="material-icons right">send</i>Tambah</button>
					</form>
				</div>
			</div>	
		</div>
	</div>
</div>

<script>

	$(document).ready( function () {
		initializeMaterialSelect();
		initializeDatepicker();
	} );
	
</script>