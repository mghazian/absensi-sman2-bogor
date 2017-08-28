<div class="col s10">
	<?php show_error_message(); ?>
	<?php show_success_message(); ?>
	<div class="section">
		<!-- Card with tab -->
		<div class="card blue lighten-1">
			<div class="card-content card-title white-text">
				<h4>Anggota Kelas</h4>
			</div>
			
			<div class="card-tabs" id="card_jurusan_tab">
				<ul class="tabs tabs-fixed-with tabs-transparent white-text">
					<!-- Jurusan -->
					<li class="tab"><a class="active" href="#tab_daftar_anggota">Daftar Anggota Kelas</a></li>
					<li class="tab"><a href="#tab_daftarkan_siswa">Daftarkan Siswa</a></li>
				</ul>
			</div>
			
			<div class="card-content white">
				
				<div id="tab_daftar_anggota">
					<table id="table_anggota" style="width: 100%">
						<thead>
							<tr>
								<th>Nama Siswa</th>
								<th>Kelas</th>
								<th>Tahun ajaran</th>
								<th></th>
							</tr>
						</thead>
					</table>
				</div>
				
				<div id="tab_daftarkan_siswa">
					<form action="<?php echo base_url ('admin/submit/kelas/insert_kepesertaan_kelas'); ?>" method="POST">
						<div class="card">
							<div class="card-content blue lighten-4">
								<div class="row">
									<h4 class="bold">SISWA</h4>
									<p>Pilih siswa yang ingin didaftarkan dengan mencentang checkbox di sebelah kanan tabel</p>
								</div>
							</div>
							<div class="card-content">
								<table id="table_daftar" style="width: 100%">
									<thead>
										<th>NISN</th>
										<th>NIS</th>
										<th>Nama Siswa</th>
										<th>Jenis Kelamin</th>
										<th></th>
									</thead>
								</table>
							</div>
						</div>
						<div class="card">
							<div class="card-content blue lighten-4">
								<h4 class="bold">KELAS</h4>
								<p>Pilih kelas dimana siswa akan didaftarkan kedalamnya</p>
							</div>
							<div class="card-content">
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
							</div>
						</div>
						<div class="row">
							<button type="submit" class="btn"><i class="material-icons right">send</i>Tambah</button>
						</div>
					</form>
				</div>

			</div>
			
		</div>
		<!-- / Card with tab -->
	</div>
</div>

<script>

	var reloadTableAnggota = function ()
	{
		var tableName = '#table_anggota';
		var table = $(tableName);

		//	Initialize table #jurusan
		table.DataTable({
			"rowId": "id",
			"searching": false,
			"columns": [
				{	data: "nama",	width: "40%"		},
				{	data: null, render: function ( data, type, row, meta )
					{
						console.log ( row );
						return row.jenjang + " " + row.jurusan + " " + row.nomor;
					} , width: "25%"	},
				{	data: "tahun_ajar", width: "25%"},
				{	data: "action", width: "10%"		}
			],
			"ajax": {
				"url": "<?php echo base_url ('ajax/kelas/ajax_anggota_kelas'); ?>",
				"type": "POST"
			},
			"columnDefs": [
				{	"targets": [ 0, 1, 2 ], "searchable": true, "orderable:": true		},
				{	"targets": [ -1 ], "searchable": false, "orderable": false			},
			]
		});

		
		table.ready( function ()
		{
			var deleteElement = tableName + ' .delete-button';
			var editElement = tableName + ' .edit-button';

			var getRowData = function (row)
			{
				var cells = row.find ('td');
				var output =
				{
					input: {id: row.prop ('id').substr (2), jurusan: cells.eq(1).html() }
				};
				return output;
			}

			//	Initialize the delete button
			$(deleteElement).ready ( function ()
			{
				$(deleteElement).click ( function ()
				{
					initializeModalButton (deleteElement, '#modal_delete_jurusan');
					var row = $(this).closest ('tr');
					var cells = row.find ('td');

					var data = { input: {id: row.prop ('id').substr (2), jurusan: cells.eq(1).html() } };
					
					populateFormData ( '#modal_delete_jurusan', data );
				});
			});

			//	Initialize the edit button
			$(editElement).ready ( function ()
			{
				$(editElement).click ( function ()
				{
					initializeModalButton (editElement, '#modal_edit_jurusan');
					var row = $(this).closest ('tr');
					
					populateFormData ( '#modal_edit_jurusan', getRowData (row) );
				});
			});
		});
	};

	var reloadTableDaftar = function ()
	{
		var tableName = '#table_daftar';
		var table = $(tableName);

		//	Initialize table #jurusan
		table.DataTable({
			"columns": [
				{	data: "nisn", width: "15%"			},
				{	data: "nis", width: "15%"			},
				{	data: "nama", width: "55%"			},
				{	data: "jenis_kelamin", width: "5%"	},
				{	data: "checkbox", width: "10%"		}
			],
			"ajax": {
				"url": "<?php echo base_url ('ajax/siswa/ajax_pendaftaran_kelas'); ?>",
				"type": "POST"
			},
			"columnDefs": [
				{	"targets": [ 0, 1, 2, 3 ], "searchable": true, "orderable:": true	},
				{	"targets": [ -1 ], "searchable": false, "orderable": false		},
			]
		});

		table.ready( function ()
		{
			var deleteElement = tableName + ' .delete-button';
			var editElement = tableName + ' .edit-button';

			var getRowData = function (row)
			{
				var cells = row.find ('td');
				var output =
				{
					input:
					{
						id: row.prop ('id').substr (2),
						nomor_kelas: cells.eq(3).html()
					},
					select:
					{
						jenjang: cells.eq(1).html(),
						jurusan: cells.eq(2).html()
					}
				};
				return output;
			}
			//	Initialize the delete button
			$(deleteElement).ready ( function ()
			{
				initializeModalButton (deleteElement, '#modal_delete_kelas');
				$(deleteElement).click ( function ()
				{
					var row = $(this).closest ('tr');
					
					populateFormData ( '#modal_delete_kelas', getRowData (row) );
				});
			});

			//	Initialize the edit button
			$(editElement).ready ( function ()
			{
				initializeModalButton (editElement, '#modal_edit_kelas');
				$(editElement).click ( function ()
				{
					var row = $(this).closest ('tr');
					
					populateFormData ( '#modal_edit_kelas', getRowData (row) );
				});
			});
		});
	};

	$(document).ready( function () {
		reloadTableAnggota();
		reloadTableDaftar();
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