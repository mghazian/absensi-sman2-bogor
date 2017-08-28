<div class="col s10">
	<div class="section">
		<!-- Card with tab -->
		<div class="card blue lighten-1">
			<div class="card-content card-title white-text">
				<h4>Data Siswa</h4>
			</div>
			<div class="card-content white">
				<table id="table_siswa" width="100%">
					<thead>
						<tr>
							<th>No</th>
							<th>NISN</th>
							<th>NIS</th>
							<th>Nama</th>
							<th>Jenis Kelamin</th>
							<th></th>
						</tr>
					</thead>
				</table>
			</div>
		</div>
		<!-- / Card with tab -->
	</div>
</div>

<!-- Modal -->
<div id="modal_delete_siswa" class="modal">
	<form action="<?php echo base_url ('admin/submit/siswa/delete_siswa'); ?>" method="POST">
		<div class="modal-content blue darken-4 white-text valign-wrapper">
			<h4>Hapus Data</h4>
		</div>
		<div class="modal-content">
			<div class="row">
				<p>Apakah anda yakin akan menghapus data ini? Data lain yang bergantung pada data ini akan ikut terhapus!</p>
				<input type="hidden" name="id" value="">
				<div class="input-field">
					<i class="material-icons prefix">label</i>
					<input disabled type="text" name="nisn" value=" ">
					<label>NISN</label>
				</div>
				<div class="input-field">
					<i class="material-icons prefix">label</i>
					<input disabled type="text" name="nis" value=" ">
					<label>NIS</label>
				</div>
				<div class="input-field">
					<i class="material-icons prefix">label</i>
					<input disabled type="text" name="nama" value=" ">
					<label>Nama Siswa</label>
				</div>
				<div class="input-field">
					<i class="material-icons prefix">label</i>
					<select disabled name="jenis_kelamin">
						<option disabled>Pilih jenis kelamin</option>
						<option value="L">Laki-laki</option>
						<option value="P">Perempuan</option>
					</select>
					<label>Jenis Kelamin</label>
				</div>
			</div>
		</div>
		<div class="modal-footer">
			<button type="submit" class="btn-flat waves-effect waves-teal">Hapus</button>
			<a href="#!" class="modal-action modal-close btn-flat waves-effect waves-teal">Batal</a>
		</div>
	</form>
</div>

<div id="modal_edit_siswa" class="modal">
	<form action="<?php echo base_url ('admin/submit/siswa/update_siswa'); ?>" method="POST">
		<div class="modal-content blue darken-4 white-text valign-wrapper">
			<h4>Edit Data</h4>
		</div>
		<div class="modal-content">
			<div class="row">
				<input type="hidden" name="id" value="">
				<div class="input-field">
					<i class="material-icons prefix">label</i>
					<input type="text" name="nisn" value=" ">
					<label>NISN</label>
				</div>
				<div class="input-field">
					<i class="material-icons prefix">label</i>
					<input type="text" name="nis" value=" ">
					<label>NIS</label>
				</div>
				<div class="input-field">
					<i class="material-icons prefix">label</i>
					<input type="text" name="nama" value=" ">
					<label>Nama Siswa</label>
				</div>
				<div class="input-field">
					<i class="material-icons prefix">label</i>
					<select name="jenis_kelamin">
						<option disabled>Pilih jenis kelamin</option>
						<option value="L">Laki-laki</option>
						<option value="P">Perempuan</option>
					</select>
					<label>Jenis Kelamin</label>
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

	var reloadTableSiswa = function ()
	{
		var tableName = '#table_siswa';
		var table = $(tableName);

		//	Initialize table #jurusan
		table.DataTable({
			"rowId": "id",
			"columns": [
				{	data: "no",	width: "5%"				},
				{	data: "nisn", width: "15%"			},
				{	data: "nis", width: "15%"			},
				{	data: "nama", width: "40%"			},
				{	data: "jenis_kelamin", width: "5%"	},
				{	data: "action", width: "20%"		}
			],
			"ajax": {
				"url": "<?php echo base_url ('ajax/siswa/ajax_list_siswa'); ?>",
				"type": "POST"
			},
			"columnDefs": [
				{	"targets": [ 0, 1, 2, 3, 4 ], "searchable": true, "orderable:": true		},
				{	"targets": [ -1 ], "searchable": false, "orderable": false					}
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
						nisn: cells.eq(1).html(),
						nis: cells.eq(2).html(),
						nama: cells.eq(3).html()
					},
					select:
					{
						jenis_kelamin: cells.eq(4).html()
					}
				};
				return output;
			};

			//	Initialize the delete button
			$(deleteElement).ready ( function ()
			{
				initializeModalButton (deleteElement, '#modal_delete_siswa');
				$(deleteElement).click ( function ()
				{
					var row = $(this).closest ('tr');
					
					populateFormData ( '#modal_delete_siswa', getRowData (row) );
				});
			});

			
			//	Initialize the edit button
			$(editElement).ready ( function ()
			{
				initializeModalButton (editElement, '#modal_edit_siswa');
				$(editElement).click ( function ()
				{
					var row = $(this).closest ('tr');
					
					populateFormData ( '#modal_edit_siswa', getRowData (row) );
				});
			});
		});
	};

	$(document).ready( function () {
		reloadTableSiswa();
		initializeMaterialSelect();
		initializeModal();
	} );
	
</script>