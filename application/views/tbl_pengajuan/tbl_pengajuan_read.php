
<div class="content-wrapper">
	
	<section class="content">
		<div class="box box-warning box-solid">
			<div class="box-header with-border">
				<h3 class="box-title">DETAIL DATA TBL_PENGAJUAN</h3>
			</div>
		
		<table class='table table-bordered'>        

	
			<tr>
				<td>No Pengajuan</td>
				<td><?php echo $no_pengajuan; ?></td>
			</tr>
	
			<tr>
				<td>Nama</td>
				<td><?php echo $nama; ?></td>
			</tr>
	
			<tr>
				<td>Alamat</td>
				<td><?php echo $alamat; ?></td>
			</tr>
	
			<tr>
				<td>Penghasilan</td>
				<td><?php echo $penghasilan; ?></td>
			</tr>
	
			<tr>
				<td>Jaminan</td>
				<td><?php echo $jaminan; ?></td>
			</tr>
	
			<tr>
				<td>Total Pinjaman</td>
				<td><?php echo $total_pinjaman; ?></td>
			</tr>
	
			<tr>
				<td>Tenor</td>
				<td><?php echo $tenor; ?></td>
			</tr>
	
			<tr>
				<td>Status</td>
				<td><?php echo $status; ?></td>
			</tr>
	
			<tr>
				<td></td>
				<td><a href="<?php echo site_url('tbl_pengajuan') ?>" class="btn btn-default">Kembali</a></td>
			</tr>
	
		</table>
		</div>
	</section>
</div>