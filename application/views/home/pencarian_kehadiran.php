<div class="col s12">
	<div class="section">
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
							<th>Kelas</th>
							<th>Kehadiran</th>
							<th>Tanggal</th>
						</tr>
					</thead>
				</table>
			</div>
		</div>
	</div>
</div>

<script>
	var reloadTableSiswa = function ()
	{
		var tableName = '#table_siswa';
		var table = $(tableName);

		//	Initialize table #jurusan
		table.DataTable({
			"search": {
				"search": "<?php echo $keyword; ?>"
			},
			"columns": [
				{	data: "no",	width: "5%"				},
				{	data: "nisn", width: "15%"			},
				{	data: "nis", width: "15%"			},
				{	data: "nama", width: "35%"			},
				{	data: "kelas", width: "11%"			},
				{	data: "kehadiran", width: "8%"		},
				{	data: "tanggal", width: "11%"		}
			],
			"ajax": {
				"url": "<?php echo base_url ('ajax/siswa/ajax_view_kehadiran'); ?>",
				"type": "POST"
			},
			"columnDefs": [
				{	"targets": [ 0, 1, 2, 3, 4, 5, 6 ], "searchable": true, "orderable:": true		},
			]
		});
	};

	$(document).ready( function () {
		reloadTableSiswa();
		initializeMaterialSelect();
		initializeModal();
	} );
	
</script>