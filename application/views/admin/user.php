<h2 class="card-title justify-content-center">Data Rekap</h2>
<div class="card mt-3">
    <div class="card-header">
        <div class="row">
            <div class="col-md-4">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Tambah User
                </button>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped" id="table_id">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Foto</th>
                        <th>Waktu</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1;
                    foreach ($user as $data) : ?>
                        <tr>
                            <td><?= $i++; ?></td>
                            <td><?= $data->nama; ?></td>
                            <td>
                                <img src="<?= base_url('uploads/') . $data->foto; ?>" class="img-thumbnail" style="width: 100px; height: 100px;">
                            </td>
                            <td><?= $data->waktu; ?></td>
                            <td>
                                <a href="<?= base_url('admin/deleteUser/' . $data->id); ?>" class="btn btn-danger tombol-hapus"><i class="mdi mdi-delete"></i> Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- tambah data -->
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?= $title; ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('admin/addUser'); ?>" method="POST">
                    <div class="mb-3">
                        <label class="form-label">Nama</label>
                        <input type="text" class="form-control" name="nama">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" class="form-control" name="password1">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Retype Password</label>
                        <input type="password" class="form-control" name="password2">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>