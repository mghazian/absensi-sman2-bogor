<div class="col s10">
	<?php show_error_message(); ?>
	<?php show_success_message(); ?>
	<div class="section">
		<!-- Card with tab -->
		<div class="card blue lighten-1">
			<div class="card-content card-title white-text">
				<h4>Pengaturan Kelas</h4>
			</div>
			
			<div class="card-tabs" id="card_jurusan_tab">
				<ul class="tabs tabs-fixed-with tabs-transparent white-text">
					<!-- Jurusan -->
					<li class="tab"><a class="active" href="#tab_jurusan_daftar">Daftar Jurusan</a></li>
					<li class="tab"><a href="#tab_jurusan_tambah">Tambah Jurusan</a></li>

					<!-- Kelas -->
					<li class="tab"><a href="#tab_kelas_daftar">Daftar Kelas</a></li>
					<li class="tab"><a href="#tab_kelas_tambah">Tambah Kelas</a></li>
				</ul>
			</div>
			
			<div class="card-content white">
				
				<!-- Jurusan -->
				<div id="tab_jurusan_daftar">
					<table id="jurusan_table" style="width: 100%">
						<thead>
							<tr>
								<th>No</th>
								<th>Nama Jurusan</th>
								<th></th>
							</tr>
						</thead>
					</table>
				</div>
				
				<div id="tab_jurusan_tambah">
					<form action="<?php echo base_url ('admin/submit/kelas/insert_jurusan'); ?>" method="POST">
						<div class="input-field">
							<i class="material-icons prefix">school</i>
							<input type="text" name="jurusan">
							<label>Nama Jurusan</label>
						</div>
						<button type="submit" class="btn"><i class="material-icons right">send</i>Tambah</button>
					</form>
				</div>

				<!-- Kelas -->
				<div id="tab_kelas_daftar">
					<table id="kelas_table" style="width: 100%">
						<thead>
							<tr>
								<th>No</th>
								<th>Jenjang</th>
								<th>Jurusan</th>
								<th>Nomor Kelas</th>
								<th></th>
							</tr>
						</thead>
					</table>
				</div>
				
				<div id="tab_kelas_tambah">
					<form action="<?php echo base_url ('admin/submit/kelas/insert_kelas'); ?>" method="POST">
						<div class="input-field col s2">
							<select name="jenjang">
								<option disabled value="">Pilih Jenjang</option>
								<option value="X">X</option>
								<option value="XI">XI</option>
								<option value="XII">XII</option>
							</select>
							<label>Jenjang</label>
						</div>
						<div class="input-field col s5">
							<select name="id_jurusan">
								<option disabled value="">Pilih Jurusan</option>
								<?php foreach ($jurusan as $row) { ?>
								<option value="<?php echo $row['id']; ?>"><?php echo $row['jurusan']; ?></option>
								<?php } ?>
							</select>
							<label>Jurusan</label>
						</div>
						<div class="input-field col s5">
							<input type="text" name="nomor">
							<label>Nomor Kelas</label>
						</div>
						<button type="submit" class="btn"><i class="material-icons right">send</i>Tambah</button>
					</form>
				</div>
			</div>
			
		</div>
		<!-- / Card with tab -->
	</div>
</div>

<!-- Modal -->
<div id="modal_delete_jurusan" class="modal">
	<form action="<?php echo base_url ('admin/submit/kelas/delete_jurusan'); ?>" method="POST">
		<div class="modal-content blue darken-4 white-text valign-wrapper">
			<h4>Hapus Data</h4>
		</div>
		<div class="modal-content">
			<div class="row">
				<p>Apakah anda yakin akan menghapus data ini? Data lain yang bergantung pada data ini akan ikut terhapus!</p>
				<input type="hidden" name="id" value="">
				<div class="input-field">
					<i class="material-icons prefix">school</i>
					<input type="text" name="jurusan" value=" " disabled>
					<label class="active">Nama Jurusan</label>
				</div>
			</div>
		</div>
		<div class="modal-footer">
			<button type="submit" class="btn-flat waves-effect waves-teal">Hapus</button>
			<a href="#!" class="modal-action modal-close btn-flat waves-effect waves-teal">Batal</a>
		</div>
	</form>
</div>

<div id="modal_edit_jurusan" class="modal">
	<form action="<?php echo base_url ('admin/submit/kelas/update_jurusan'); ?>" method="POST">
		<div class="modal-content blue darken-4 white-text valign-wrapper">
			<h4>Edit Data</h4>
		</div>
		<div class="modal-content">
			<div class="row">
				<input type="hidden" name="id" value="">
				<div class="input-field">
					<i class="material-icons prefix">school</i>
					<input type="text" name="jurusan" value=" ">
					<label>Nama Jurusan</label>
				</div>
			</div>
		</div>
		<div class="modal-footer">
			<button type="submit" class="btn-flat waves-effect waves-teal">Edit</button>
			<a href="#!" class="modal-action modal-close btn-flat waves-effect waves-teal">Batal</a>
		</div>
	</form>
</div>

<div id="modal_delete_kelas" class="modal">
	<form action="<?php echo base_url ('admin/submit/kelas/delete_kelas'); ?>" method="POST">
		<div class="modal-content blue darken-4 white-text valign-wrapper">
			<h4>Hapus Data</h4>
		</div>
		<div class="modal-content">
			<div class="row">
				<p>Apakah anda yakin akan menghapus data ini? Data lain yang bergantung pada data ini akan ikut terhapus!</p>
				<input type="hidden" name="id" value="">
				<div class="input-field col s2">
					<select disabled name="jenjang">
						<option disabled value="">Pilih Jenjang</option>
						<option value="X">X</option>
						<option value="XI">XI</option>
						<option value="XII">XII</option>
					</select>
					<label>Jenjang</label>
				</div>
				<div class="input-field col s5">
					<select disabled name="id_jurusan">
						<option disabled value="">Pilih Jurusan</option>
						<?php foreach ($jurusan as $row) { ?>
						<option value="<?php echo $row['id']; ?>"><?php echo $row['jurusan']; ?></option>
						<?php } ?>
					</select>
					<label>Jurusan</label>
				</div>
				<div class="input-field col s5">
					<input disabled type="text" name="nomor" value=" ">
					<label>Nomor Kelas</label>
				</div>
			</div>
		</div>
		<div class="modal-footer">
			<button type="submit" class="btn-flat waves-effect waves-teal">Hapus</button>
			<a href="#!" class="modal-action modal-close btn-flat waves-effect waves-teal">Batal</a>
		</div>
	</form>
</div>

<div id="modal_edit_kelas" class="modal">
	<form action="<?php echo base_url ('admin/submit/kelas/update_kelas'); ?>" method="POST">
		<div class="modal-content blue darken-4 white-text valign-wrapper">
			<h4>Edit Data</h4>
		</div>
		<div class="modal-content">
			<div class="row">
				<input type="hidden" name="id" value="">
				<div class="input-field col s2">
					<select name="jenjang">
						<option disabled value="">Pilih Jenjang</option>
						<option value="X">X</option>
						<option value="XI">XI</option>
						<option value="XII">XII</option>
					</select>
					<label>Jenjang</label>
				</div>
				<div class="input-field col s5">
					<select name="id_jurusan">
						<option disabled value="">Pilih Jurusan</option>
						<?php foreach ($jurusan as $row) { ?>
						<option value="<?php echo $row['id']; ?>"><?php echo $row['jurusan']; ?></option>
						<?php } ?>
					</select>
					<label>Jurusan</label>
				</div>
				<div class="input-field col s5">
					<input type="text" name="nomor" value=" ">
					<label>Nomor Kelas</label>
				</div>
			</div>
		</div>
		<div class="modal-footer">
			<button type="submit" class="btn-flat waves-effect waves-teal">Edit</button>
			<a href="#!" class="modal-action modal-close btn-flat waves-effect waves-teal">Batal</a>
		</div>
	</form>
</div>

<script>

	var reloadTableJurusan = function ()
	{
		var tableName = '#jurusan_table';
		var table = $(tableName);

		//	Initialize table #jurusan
		table.DataTable({
			"rowId": "id",
			"columns": [
				{	data: "no",	width: "20%"		},
				{	data: "jurusan", width: "50%"	},
				{	data: "action", width: "30%"	}
			],
			"ajax": {
				"url": "<?php echo base_url ('ajax/kelas/ajax_jurusan_kelas'); ?>",
				"type": "POST"
			},
			"columnDefs": [
				{	"targets": [ 0, 1 ], "searchable": true, "orderable:": true		},
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

	var reloadTableKelas = function ()
	{
		var tableName = '#kelas_table';
		var table = $(tableName);

		//	Initialize table #jurusan
		table.DataTable({
			"columns": [
				{	data: "no",	width: "10%"		},
				{	data: "jenjang", width: "15%"	},
				{	data: "jurusan", width: "15%"	},
				{	data: "nomor", width: "15%"		},
				{	data: "action", width: "45%"	}
			],
			"ajax": {
				"url": "<?php echo base_url ('ajax/kelas/ajax_list_kelas'); ?>",
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
		reloadTableJurusan();
		reloadTableKelas();
		initializeMaterialSelect();
		initializeModal();
	} );
	
</script>