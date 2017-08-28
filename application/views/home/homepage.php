<div class="col s12" style="padding: 25px">
	<div class="col s6">
	</div>
	<div class="col s6 valign-wrapper">
		<div class="col s6">
			<h3>PENCARIAN</h3>
		</div>
		<div class="col s6">
			<form method="GET" action="<?php echo base_url ('home/pencarian_kehadiran'); ?>">
				<div class="input-field">
					<input type="text" placeholder="Masukkan identitas siswa yang ingin dicari" name="keyword"/>
					<label>Kata kunci</label>
				</div>
				<button type="submit" class="btn"><i class="material-icons right">search</i>Cari</button>
			</form>
		</div>
	</div>
</div>