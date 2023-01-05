<h2 class="card-title justify-content-center">Data Rekap</h2>
<div class="card mt-3">
    <div class="card-header">
        <div class="row">
            <div class="col-md-4">
                <a href="<?= base_url('admin/pdf'); ?>" class="btn btn-dark btn-sm"><i class="mdi mdi-cloud-print-outline"></i> Export PDF</a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped" id="table_id">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nilai Asap</th>
                        <th>Waktu</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1;
                    foreach ($asap as $data) : ?>
                        <tr>
                            <td><?= $i++; ?></td>
                            <td><?= $data['nilai']; ?></td>
                            <td><?= $data['waktu']; ?></td>
                            <td>
                                <a href="<?= base_url(); ?>admin/delete/<?= $data['id']; ?>" class="btn btn-danger tombol-hapus"><i class="mdi mdi-delete"></i> Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>