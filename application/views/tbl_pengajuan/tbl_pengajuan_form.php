<div class="content-wrapper">
	<section class="content">
		<div class="box box-warning box-solid">
			<div class="box-header with-border">
				<h3 class="box-title"><?php echo strtoupper($button) ?> DATA PENGAJUAN</h3>
			</div>
			<form action="<?php echo $action; ?>" method="post">
			
				<table class='table table-bordered'>
	
					<tr>
						<td width='200'>No Pengajuan <?php echo form_error('no_pengajuan') ?></td><td><input type="text" class="form-control" name="no_pengajuan" id="no_pengajuan" placeholder="No Pengajuan" value="<?php echo $no_pengajuan; ?>" /></td>
					</tr>
	
					<tr>
						<td width='200'>Nama <?php echo form_error('nama') ?></td><td><input type="text" class="form-control" name="nama" id="nama" placeholder="Nama" value="<?php echo $nama; ?>" /></td>
					</tr>
	    
					<tr>
						<td width='200'>Alamat <?php echo form_error('alamat') ?></td>
						<td> <textarea class="form-control" rows="3" name="alamat" id="alamat" placeholder="Alamat"><?php echo $alamat; ?></textarea></td>
					</tr>
	
					<tr>
						<td width='200'>Penghasilan <?php echo form_error('penghasilan') ?></td><td><input type="number" class="form-control" name="penghasilan" id="penghasilan" placeholder="Penghasilan" value="<?php echo $penghasilan; ?>" /></td>
					</tr>
	
					<tr>
						<td width='200'>Jaminan <?php echo form_error('jaminan') ?></td><td><input type="text" class="form-control" name="jaminan" id="jaminan" placeholder="Jaminan" value="<?php echo $jaminan; ?>" /></td>
					</tr>
	
					<tr>
						<td width='200'>Total Pinjaman <?php echo form_error('total_pinjaman') ?></td><td><input type="number" class="form-control" name="total_pinjaman" id="total_pinjaman" placeholder="Total Pinjaman" value="<?php echo $total_pinjaman; ?>" /></td>
					</tr>
	
					<tr>
						<td width='200'>Tenor <small>(bulan)</small> <?php echo form_error('tenor') ?></td><td><input type="number" class="form-control" name="tenor" id="tenor" placeholder="Tenor" value="<?php echo $tenor; ?>" /></td>
					</tr>
	
					<tr>
						<td></td>
						<td>
							<input type="hidden" name="id_pengajuan" value="<?php echo $id_pengajuan; ?>" /> 
							<button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button> 
							<a href="<?php echo site_url('tbl_pengajuan') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a>
						</td>
					</tr>
	
				</table>
			</form>
		</div>
	</section>
</div>