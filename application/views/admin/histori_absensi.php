<div class="col s10">
	<?php show_error_message(); ?>
	<?php show_success_message(); ?>
	<div class="section">
		
		<div class="card blue lighten-1">
			<div class="card-content card-title white-text">
				<h4>Input Data Siswa</h4>
			</div>

			<div class="card-content white">
				<table class="attendance">
					<thead>
						<tr>
							<td><!-- month and year --></td>
							<!-- only for name -->
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><!-- date (1 - 31)--></td>
							<!-- attendance status -->
						</tr>
					</tbody>
				</table>
			</div>	
		</div>
	</div>
</div>

<script>

	$(document).ready( function () {
		initializeMaterialSelect();
		initializeModal();
	} );
	
</script>