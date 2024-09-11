
<div class="content-wrapper">
	
	<section class="content">
		<div class="box box-warning box-solid">
			<div class="box-header with-border">
				<h3 class="box-title">DETAIL DATA TBL_SURVEY</h3>
			</div>
		
		<table class='table table-bordered'>        

	
			<tr>
				<td>Catatan</td>
				<td><?php echo $catatan; ?></td>
			</tr>
	
			<tr>
				<td>Foto Jaminan</td>
				<td><?php echo $foto_jaminan; ?></td>
			</tr>
	
			<tr>
				<td>Foto Rumah</td>
				<td><?php echo $foto_rumah; ?></td>
			</tr>
	
			<tr>
				<td>Id Pengajuan</td>
				<td><?php echo $id_pengajuan; ?></td>
			</tr>
	
			<tr>
				<td>Status</td>
				<td><?php echo $status; ?></td>
			</tr>
	
			<tr>
				<td>Tempat Kerja</td>
				<td><?php echo $tempat_kerja; ?></td>
			</tr>
	
			<tr>
				<td></td>
				<td><a href="<?php echo site_url('tbl_survey') ?>" class="btn btn-default">Kembali</a></td>
			</tr>
	
		</table>
		</div>
	</section>
</div>