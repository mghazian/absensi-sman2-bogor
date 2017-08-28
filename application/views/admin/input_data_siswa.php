<div class="col s10">
	<?php show_error_message(); ?>
	<?php show_success_message(); ?>
	<div class="section">
		<!-- Card with tab -->
		<div class="card blue lighten-1">
			<div class="card-content card-title white-text">
				<h4>Input Data Siswa</h4>
			</div>
			
			<div class="card-tabs" id="card_jurusan_tab">
				<ul class="tabs tabs-fixed-with tabs-transparent white-text">
					<li class="tab"><a class="active" href="#tab_input_siswa">Input</a></li>
					<li class="tab"><a href="#tab_import_siswa">Import</a></li>
				</ul>
			</div>
			
			<div class="card-content white">
				
				<div id="tab_input_siswa">
					<form action="<?php echo base_url ('admin/submit/siswa/insert_siswa'); ?>" method="POST">
						<div class="input-field">
							<i class="material-icons prefix">label</i>
							<input type="text" name="nisn" placeholder="NISN siswa tanpa spasi">
							<label>NISN</label>
						</div>
						<div class="input-field">
							<i class="material-icons prefix">label</i>
							<input type="text" name="nis" placeholder="NIS siswa">
							<label>NIS</label>
						</div>
						<div class="input-field">
							<i class="material-icons prefix">label</i>
							<input type="text" name="nama" placeholder="Nama siswa">
							<label>Nama Siswa</label>
						</div>
						<div class="input-field">
							<i class="material-icons prefix">label</i>
							<select name="jenis_kelamin">
								<option disabled selected>Pilih jenis kelamin</option>
								<option value="L">Laki-laki</option>
								<option value="P">Perempuan</option>
							</select>
							<label>Jenis Kelamin</label>
						</div>
						<button type="submit" class="btn"><i class="material-icons right">send</i>Tambah</button>
					</form>
				</div>
				
				<div id="tab_import_siswa">
					<form action="<?php echo base_url ('admin/submit/siswa/import_siswa'); ?>" method="POST" enctype="multipart/form-data">
						<div class="file-field input-field">
							<div class="btn">
								<i class="material-icons left">file_upload</i>
								<span>FILE</span>
								<input type="file" name="file">
							</div>
							<div class="file-path-wrapper">
								<input class="file-path" type="text">
							</div>
						</div>
						<div class="input-field">
							<select id="kelas" name="kelas">
								<option disabled selected>Pilih kelas</option>
							<?php foreach ($kelas as $k) { ?>
								<option value="<?php echo $k['id']; ?>">
									<?php echo $k['jenjang'] . ' ' . $k['jurusan'] . ' ' . $k['nomor']; ?>
								</option>
							<?php } ?>
							</select>
							<label for="kelas">Kelas</label>
						</div>
						<input type="hidden" name="tahun_ajar" id="tahun_ajar">
						<div class="row">
							<div class="input-field col s2">
								<input type="text" id="tahun_ajar_awal">
								<label for="tahun_ajar_awal">Tahun ajar awal</label>
							</div>
							<div class="input-field col s2">
								<input disabled type="text" id="tahun_ajar_akhir">
								<label for="tahun_ajar_akhir">Tahun ajar akhir</label>
							</div>
						</div>
						<button type="submit" class="btn"><i class="material-icons right">send</i>Tambah</button>
					</form>
				</div>
			</div>
		</div>
		<!-- / Card with tab -->
	</div>
</div>

<script>

	$(document).ready( function () {
		initializeMaterialSelect();
		initializeModal();
	} );
	
	$('#tahun_ajar_awal').on ('change', function ()
	{
		if ( $(this).val() == '' )
		{
			$('#tahun_ajar_akhir').val ('');
			$('#tahun_ajar').val ('');
		}
		else
		{
			var tahun = parseInt($(this).val()); 
			$('#tahun_ajar_akhir').val( tahun + 1 );
			$('#tahun_ajar').val ( tahun + '/' + (tahun + 1) );
		}

		Materialize.updateTextFields();
	});

</script>