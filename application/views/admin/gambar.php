<h2 class="card-title justify-content-center">Data Gambar</h2>
<div class="card mt-3">
	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-striped" id="table_id">
				<thead>
					<tr>
						<th>#</th>
						<th>Gambar</th>
						<th>Waktu</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php $i = 1;
					foreach ($gambar as $data) : ?>
						<tr>
							<td><?= $i++; ?></td>
							<td>
								<img src="<?= base_url('uploads/') . $data['name']; ?>" class="img-thumbnail" style="width: 200px; height: 200px;">
							</td>
							<td><?= $data['waktu']; ?></td>
							<td>
								<a href="<?= base_url(); ?>admin/delete_gambar/<?= $data['id']; ?>" class="btn btn-danger tombol-hapus"><i class="mdi mdi-delete"></i> Hapus</a>
							</td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>