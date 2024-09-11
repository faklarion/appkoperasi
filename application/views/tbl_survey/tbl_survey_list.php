<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-warning box-solid">
                    <div class="box-header">
                        <h3 class="box-title">KELOLA DATA SURVEY</h3>
                    </div>
        
        <div class="box-body">
            <div class='row'>
            <div class='col-md-9'>
                <div style="padding-bottom: 10px;">
                    <?php echo anchor(site_url('tbl_survey/create'), '<i class="fa fa-wpforms" aria-hidden="true"></i> Tambah Data', 'class="btn btn-danger btn-sm"'); ?></div>
                </div>
            </div>
        
   
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right">
                
            </div>
        </div>
        <table class="table table-bordered" style="margin-bottom: 10px" id="tabelpengajuan">
            <thead>
            <tr>
                <th>No</th>
                <th>Nama Pengaju</th>
                <th>Foto Jaminan</th>
                <th>Foto Rumah</th>
                <th>Tempat Kerja</th>
                <th>Catatan</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($tbl_survey_data as $tbl_survey) { ?>
            <tr>
                <td width="10px"><?php echo ++$start ?></td>
                <td><?php echo $tbl_survey->nama ?></td>
                <td><button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modalJaminan<?= $tbl_survey->id_survey ?>">Lihat Foto</button></td> 
                <td><button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modalRumah<?= $tbl_survey->id_survey ?>">Lihat Foto</button></td>
                <td><?php echo $tbl_survey->tempat_kerja ?></td>
                <td><?php echo $tbl_survey->catatan ?></td>
                <td><?php echo nama_survey($tbl_survey->status) ?></td>
                <td style="text-align:center" width="200px">
                    <?php 
                    //echo anchor(site_url('tbl_survey/read/'.$tbl_survey->id_survey),'<i class="fa fa-eye" aria-hidden="true"></i>','class="btn btn-danger btn-sm"'); 
                    //echo '  '; 
                    echo anchor(site_url('tbl_survey/update/'.$tbl_survey->id_survey),'<i class="fa fa-pencil-square-o" aria-hidden="true"></i>','class="btn btn-danger btn-sm"'); 
                    echo '  '; 
                    echo anchor(site_url('tbl_survey/delete/'.$tbl_survey->id_survey),'<i class="fa fa-trash-o" aria-hidden="true"></i>','class="btn btn-danger btn-sm" Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
                    ?>
                </td>
		    </tr>
            <?php } ?>
            </tbody>
        </table>
        
        </div>
                    </div>
            </div>
            </div>
    </section>
</div>

<!-- Modal Jaminan -->
<?php foreach($tbl_survey_data as $tbl_survey) : ?>
<div id="modalJaminan<?= $tbl_survey->id_survey ?>" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<!-- konten modal-->
			<div class="modal-content">
				<!-- heading modal -->
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Lihat Foto Jaminan <?= $tbl_survey->nama ?></h4>
				</div>
				<!-- body modal -->
				<div class="modal-body">
					<table class="table table-responsive table-striped table-bordered">
                        <thead>
                            <tr>
                                <td>No</td>
                                <td>Foto</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                        $no = 1;
                        $daftarFoto = $this->Tbl_survey_model->get_foto_by_id($tbl_survey->id_survey);
                        foreach ($daftarFoto as $images) : 
                        $image_array = explode(',', $images->foto_jaminan);
                        ?>
                        <?php foreach ($image_array as $img): ?>
                            <?php if($img) { ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><img src="<?= base_url('assets/foto_jaminan/' . $img) ?>" alt="Uploaded Image" width="150px"></td>
                                <td>
                                            <!-- Form for delete action -->
                                            <form action="<?php echo site_url('tbl_survey/delete_photo_jaminan'); ?>" method="post">
                                                <input type="hidden" name="photo_url"
                                                    value="<?php echo htmlspecialchars((string) $img); ?>">
                                                <input type="hidden" name="id_survey"
                                                    value="<?php echo $images->id_survey; ?>">
                                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                            </form>
                                </td>
                            </tr>
                            <?php } else { ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td>Tidak Ada Foto diupload</td>
                            </tr>
                            <?php } ?>
                            
                        <?php endforeach ?>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
				</div>
				<!-- footer modal -->
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
				</div>
			</div>
		</div>
</div>
<?php endforeach ?>

<!-- Modal Rumah -->
<?php foreach($tbl_survey_data as $tbl_survey) : ?>
<div id="modalRumah<?= $tbl_survey->id_survey ?>" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<!-- konten modal-->
			<div class="modal-content">
				<!-- heading modal -->
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Lihat Foto Rumah <?= $tbl_survey->nama ?></h4>
				</div>
				<!-- body modal -->
				<div class="modal-body">
					<table class="table table-responsive table-striped table-bordered">
                        <thead>
                            <tr>
                                <td>No</td>
                                <td>Foto</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                        $no = 1;
                        $daftarFoto = $this->Tbl_survey_model->get_foto_by_id($tbl_survey->id_survey);
                        foreach ($daftarFoto as $images) : 
                        $image_array = explode(',', $images->foto_rumah);
                        ?>
                        <?php foreach ($image_array as $img): ?>
                            <?php if($img) { ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><img src="<?= base_url('assets/foto_jaminan/' . $img) ?>" alt="Uploaded Image" width="150px"></td>
                                <td>
                                            <!-- Form for delete action -->
                                            <form action="<?php echo site_url('tbl_survey/delete_photo_rumah'); ?>" method="post">
                                                <input type="hidden" name="photo_url"
                                                    value="<?php echo htmlspecialchars((string) $img); ?>">
                                                <input type="hidden" name="id_survey"
                                                    value="<?php echo $images->id_survey; ?>">
                                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                            </form>
                                </td>
                            </tr>
                            <?php } else { ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td>Tidak Ada Foto diupload</td>
                            </tr>
                            <?php } ?>
                            
                        <?php endforeach ?>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
				</div>
				<!-- footer modal -->
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
				</div>
			</div>
		</div>
</div>
<?php endforeach ?>