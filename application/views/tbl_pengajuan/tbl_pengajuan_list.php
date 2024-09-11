<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-warning box-solid">
    
                    <div class="box-header">
                        <h3 class="box-title">KELOLA DATA PENGAJUAN</h3>
                    </div>
        
        <div class="box-body">
            <div class='row'>
                <div class='col-md-9'>
                    <div style="padding-bottom: 10px;">
                        <?php echo anchor(site_url('tbl_pengajuan/create'), '<i class="fa fa-wpforms" aria-hidden="true"></i> Tambah Data', 'class="btn btn-danger btn-sm"'); ?>
                    </div>
                </div>
            </div>
        
   
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
        </div>
        <table class="table table-bordered" style="margin-bottom: 10px" id="tabelpengajuan">
            <thead>
                <tr>
                    <th class="text-center">No</th>
                    <th class="text-center">No Pengajuan</th>
                    <th class="text-center">Nama</th>
                    <th class="text-center">Alamat</th>
                    <th class="text-center">Penghasilan</th>
                    <th class="text-center">Jaminan</th>
                    <th class="text-center">Total Pinjaman</th>
                    <th class="text-center">Tenor</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
            foreach ($tbl_pengajuan_data as $tbl_pengajuan)
            {
                ?>
            <tr>
                    <td width="10px"><?php echo ++$start ?></td>
                    <td><?php echo $tbl_pengajuan->no_pengajuan ?></td>
                    <td><?php echo $tbl_pengajuan->nama ?></td>
                    <td><?php echo $tbl_pengajuan->alamat ?></td>
                    <td><?php echo rupiah($tbl_pengajuan->penghasilan) ?></td>
                    <td><?php echo $tbl_pengajuan->jaminan ?></td>
                    <td><?php echo rupiah($tbl_pengajuan->total_pinjaman) ?></td>
                    <td><?php echo $tbl_pengajuan->tenor ?> Bulan</td>
                    <td><?php echo nama_status($tbl_pengajuan->status) ?></td>
                    <td style="text-align:center" width="200px">
                        <?php 
                        //echo anchor(site_url('tbl_pengajuan/read/'.$tbl_pengajuan->id_pengajuan),'<i class="fa fa-eye" aria-hidden="true"></i>','class="btn btn-danger btn-sm"'); 
                        //echo '  '; 
                        echo anchor(site_url('tbl_pengajuan/update/'.$tbl_pengajuan->id_pengajuan),'<i class="fa fa-pencil-square-o" aria-hidden="true"></i>','class="btn btn-danger btn-sm"'); 
                        echo '  '; 
                        echo anchor(site_url('tbl_pengajuan/delete/'.$tbl_pengajuan->id_pengajuan),'<i class="fa fa-trash-o" aria-hidden="true"></i>','class="btn btn-danger btn-sm" Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
                        ?>
                    </td>
		        </tr>
                <?php
            }
            ?>
            </tbody>
                
        </table>

        </div>
                    </div>
            </div>
            </div>
    </section>
</div>