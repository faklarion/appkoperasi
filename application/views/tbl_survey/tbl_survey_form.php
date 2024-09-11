<div class="content-wrapper">
	<section class="content">
		<div class="box box-warning box-solid">
			<div class="box-header with-border">
				<h3 class="box-title"><?php echo strtoupper($button) ?> DATA SURVEY</h3>
			</div>
			<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
				<table class='table table-bordered'>
					<tr>
						<td width='200'>Nama Pengaju</td>
						<td>
							<select name="id_pengajuan" id="id_pengajuan" class="form-control">
								<?php foreach ($data_pengajuan as $row) : ?>
									<option value="<?php echo $row->id_pengajuan ?>"><?php echo $row->nama?></option>
								<?php endforeach ?>
							</select>
						</td>
							
					</tr>

					<tr>
						<td width='200'>Foto Jaminan </td>
						<td> <input type="file" class="form-control" name="foto_jaminan[]" id="foto_jaminan" multiple></td>
					</tr>
	    
					<tr>
						<td width='200'>Foto Rumah</td>
						<td> <input type="file" class="form-control" rows="3" name="foto_rumah[]" id="foto_rumah" multiple></td>
					</tr>
	
					<tr>
						<td width='200'>Tempat Kerja <?php echo form_error('tempat_kerja') ?></td><td><input type="text" class="form-control" name="tempat_kerja" id="tempat_kerja" placeholder="Tempat Kerja" value="<?php echo $tempat_kerja; ?>" /></td>
					</tr>

					<tr>
						<td width='200'>Catatan <?php echo form_error('catatan') ?></td>
						<td> <textarea class="form-control" rows="3" name="catatan" id="catatan" placeholder="Catatan"><?php echo $catatan; ?></textarea></td>
					</tr>
	
					<tr>
						<td></td>
						<td>
							<input type="hidden" name="id_survey" value="<?php echo $id_survey; ?>" /> 
							<button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button> 
							<a href="<?php echo site_url('tbl_survey') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a>
						</td>
					</tr>
	
				</table>
			</form>
		</div>
	</section>
</div>