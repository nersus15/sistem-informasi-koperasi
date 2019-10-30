<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Anggota</h1>

    </div>
    <!-- Content Row -->
    <div class="row">
        <div class="add-member">
            <button type="button" class="btn btn-success mb-3" data-toggle="modal" data-target="#add-member-modal">
                <i class="fas fa-user-plus mr-1"></i>Tambah Member
            </button>
        </div>
        <div class="col-md col-sm">
            <div><?= flasher::flash(); ?></div>
        </div>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">Nama Lengkap</th>
                    <th scope="col">Alamat</th>
                    <th scope="col">NIK</th>
                    <th scope="col">Tanggal Lahir</th>
                    <th scope="col">Username</th>
                    <th scope="col">Status</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['member'] as $member) : ?>
                    <tr>
                        <th scope="row"><?= $member['id'] ?></th>
                        <td><?= $member['nama_lengkap'] ?></td>
                        <td><?= $member['alamat'] ?></td>
                        <td><?= $member['NIK'] ?></td>
                        <td><?= $member['tanggal_lahir'] ?></td>
                        <td><?= $member['account'] ?></td>
                        <td><?= $member['status'] ?></td>
                        <td>
                            <button class="btn btn-sm btn-danger">Hapus</button>
                            <button class="btn btn-sm btn-warning">Non Aktifkan</button>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>

<!-- Add Member Modal -->
<div class="modal fade" id="add-member-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Modal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= BASEURL . '/admin/member_menu' ?>" enctype="multipart/form-data" method="POST">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="namaLengkap">Nama Lengkap</label>
                            <input type="text" name="namaLengkap" class="form-control" id="namaLengkap">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="alamat">Alamat</label>
                            <textarea class="form-control" name="alamat" id="alamat" rows="1"></textarea>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="nik">NIK</label>
                            <input type="text" name="NIK" class="form-control" id="nik">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="ttl">Tanggal Lahir</label>
                            <input type="date" name="tanggalLahir" class="form-control" id="ttl">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="ktp">KTP</label>
                            <input type="file" name="KTP" class="form-control" id="ktp">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Email</label>
                            <input type="email" name="email" class="form-control" id="inputEmail4" placeholder="Email">
                        </div>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button name="add" type="submit" type="button" class="btn btn-primary">Save changes</button>
            </div>
            </form>
        </div>

    </div>
</div>