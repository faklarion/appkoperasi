<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-warning box-solid">

                    <div class="box-header">
                        <h3 class="box-title">KELOLA DATA USER</h3>
                    </div>

                    <div class="box-body">
                        <div style="padding-bottom: 10px;">
                            <?php echo anchor(site_url('user/create'), '<i class="fa fa-wpforms" aria-hidden="true"></i> Tambah Data', 'class="btn btn-danger btn-sm"'); ?>
                            <!-- <?php echo anchor(site_url('user/excel'), '<i class="fa fa-file-excel-o" aria-hidden="true"></i> Export Ms Excel', 'class="btn btn-success btn-sm"'); ?> -->
                            <!-- <?php echo anchor(site_url('user/word'), '<i class="fa fa-file-word-o" aria-hidden="true"></i> Export Ms Word', 'class="btn btn-primary btn-sm"'); ?> -->
                        </div>
                        <!-- Wrapper dengan class table-responsive -->
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped dt-responsive nowrap" id="mytable">
                                <thead>
                                    <tr>
                                        <th width="30px">No</th>
                                        <th>Full Name</th>
                                        <th>Email</th>
                                        <th>Nama Level</th>
                                        <th>Status</th>
                                        <th width="200px">Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
    </section>
</div>
<!-- DataTables CSS -->
<link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css" rel="stylesheet">

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>

<!-- DataTables Responsive JS -->
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<link href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap4.min.css" rel="stylesheet">
<script type="text/javascript">
    $(document).ready(function () {
        $.fn.dataTableExt.oApi.fnPagingInfo = function (oSettings) {
            return {
                "iStart": oSettings._iDisplayStart,
                "iEnd": oSettings.fnDisplayEnd(),
                "iLength": oSettings._iDisplayLength,
                "iTotal": oSettings.fnRecordsTotal(),
                "iFilteredTotal": oSettings.fnRecordsDisplay(),
                "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
                "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
            };
        };

        var t = $("#mytable").dataTable({
            initComplete: function () {
                var api = this.api();
                $('#mytable_filter input')
                    .off('.DT')
                    .on('keyup.DT', function (e) {
                        if (e.keyCode == 13) {
                            api.search(this.value).draw();
                        }
                    });
            },
            oLanguage: {
                sProcessing: "loading..."
            },
            processing: true,
            responsive: true,
            serverSide: true,
            ajax: { "url": "user/json", "type": "POST" },
            columns: [
                {
                    "data": "id_users",
                    "orderable": false
                }, { "data": "full_name" }, { "data": "email" }, { "data": "nama_level" }, { "data": "is_aktif" },
                {
                    "data": "action",
                    "orderable": false,
                    "className": "text-center"
                }
            ],
            order: [[0, 'desc']],
            rowCallback: function (row, data, iDisplayIndex) {
                var info = this.fnPagingInfo();
                var page = info.iPage;
                var length = info.iLength;
                var index = page * length + (iDisplayIndex + 1);
                $('td:eq(0)', row).html(index);
            }
        });
    });
</script>