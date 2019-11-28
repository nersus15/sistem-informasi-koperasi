          <!-- Begin Page Content -->
          <div class="container-fluid">

            <!-- Page Heading -->
            <h1 class="h3 mb-2 text-gray-800">Members</h1>
            <!-- Message -->
            <div><?= flasher::flash(); ?></div>
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
              <div class="card-header py-3">
                <h6 class="float-left mr-3 m-0 font-weight-bold text-primary">DataTables Member</h6>
                <!-- Button trigger modal -->
                <i style="cursor:pointer" class="text-success fas fa-user-plus" data-toggle="modal" data-target="#modalAddAnggota"> Tambah Anggota</i>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                      <tr>
                        <th>Action</th>
                        <th>NIK</th>
                        <th>Nama Lengkap</th>
                        <th>Alamat</th>
                        <th>Tanggal Lahir</th>
                        <th>Jenis Kelamin</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Photo Profile</th>
                        <th>KTP</th>
                        <th>Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($data['member'] as $member) : ?>
                        <tr>
                          <?php if ($member['status'] == 0) : ?>
                            <td class='text-danger'><a class='mb-2 btn btn-xs btn-warning' href="<?= BASEURL . '/admin/aktif_member/' . $member['username'] ?>">Aktifkan</a> <a class='btn btn-xs btn-danger' href="<?= BASEURL . '/admin/delete_member/' . $member['username'] . '/' . $member['ktp'] . '/' . $member['img'] ?>">Delete</a></td>
                            <td class='text-danger'><?= $member['nik'] ?></td>
                            <td class='text-danger'><?= $member['nama_lengkap'] ?></td>
                            <td class='text-danger'><?= $member['alamat'] ?></td>
                            <td class='text-danger'><?= date('d-F-Y', $member['tanggal_lahir']); ?></td>
                            <td class='text-danger'><?= $member['jenis_kelamin'] ?></td>
                            <td class='text-danger'><?= $member['username'] ?></td>
                            <td class='text-danger'><?= $member['email'] ?></td>
                            <td><img src="<?= BASEPATH . '/asset/img/profile/' . $member['img'] ?>" class="img-fluid" alt="<?= $member['img'] ?>"></td>
                            <td><img src="<?= BASEPATH . '/asset/img/ktp/' . $member['ktp'] ?>" class="img-fluid" alt="<?= $member['ktp'] ?>"></td>
                            <td><?= $member['status'] ?></td>
                          <?php else : ?>
                            <td><a class='mb-2 btn btn-xs btn-warning' href="<?= BASEURL . '/admin/nonaktif_member/' . $member['username'] ?>">Nonaktifkan</a> <a class='btn btn-xs btn-danger' href="<?= BASEURL . '/admin/delete_member/' . $member['username'] . '/' . $member['ktp'] . '/' . $member['img'] ?>">Delete</a></td>
                            <td><?= $member['nik'] ?></td>
                            <td><?= $member['nama_lengkap'] ?></td>
                            <td><?= $member['alamat'] ?></td>
                            <td><?= date('d-F-Y', $member['tanggal_lahir']); ?></td>
                            <td><?= $member['jenis_kelamin'] ?></td>
                            <td><?= $member['username'] ?></td>
                            <td><?= $member['email'] ?></td>
                            <td><img src="<?= BASEPATH . '/asset/img/profile/' . $member['img'] ?>" class="img-fluid" alt="<?= $member['img'] ?>"></td>
                            <td><img src="<?= BASEPATH . '/asset/img/ktp/' . $member['ktp'] ?>" class="img-fluid" alt="<?= $member['ktp'] ?>"></td>
                            <td><?= $member['status'] ?></td>
                          <? endif ?>
                        </tr>
                      <?php endforeach ?>
                    </tbody>
                    <!-- <tfoot>
                      <tr>
                        <th>NIK</th>
                        <th>Nama Lengkap</th>
                        <th>Alamat</th>
                        <th>Tanggal Lahir</th>
                        <th>Jenis Kelamin</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Photo Profile</th>
                        <th>KTP</th>
                        <th>Status</th>
                      </tr>
                    </tfoot> -->
                  </table>
                </div>
              </div>
            </div>
          </div>
          <!-- /.container-fluid -->

          </div>
          <!-- End of Main Content -->

          </div>
          <!-- End of Content Wrapper -->

          </div>
          <!-- End of Page Wrapper -->

          <!-- Scroll to Top Button-->
          <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
          </a>

          <!-- Modal untuk menambah anggota -->
          <div class="modal fade" id="modalAddAnggota" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <!-- Form untuk tambah anggota -->
                  <form action="<?= BASEURL . '/admin/member_menu ' ?>" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                      <label for="nik">NIK</label>
                      <input required class="form-control" type="text" name="nik" id="nik">
                    </div>
                    <div class="form-group">
                      <label for="namaLengkap">Nama Lengkap</label>
                      <input required class="form-control" type="text" name="namaLengkap" id="namaLengkap">
                    </div>
                    <div class="form-group">
                      <label for="alamat">Alamat</label>
                      <textarea required class="form-control" name="alamat" id="" rows="2"></textarea>
                    </div>
                    <div class="form-group">
                      <label for="ttl">Tanggal Lahir</label>
                      <input required class="datepicker form-control" type="date" name="ttl" id="ttl">
                    </div>
                    <div class="form-group">
                      <label for="">Jenis Kelamin</label>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="jk" id="laki-laki" value="Laki-laki" checked>
                        <label class="form-check-label" for="laki-laki">
                          Laki-laki
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="jk" id="Perempuan" value="Perempuan">
                        <label class="form-check-label" for="Perempuan">
                          Perempuan
                        </label>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="email">Email</label>
                      <input required name="email" type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email">
                    </div>
                    <div class="form-group">
                      <label for="ktp">Upload KTP</label>
                      <small>Max: 2.5 MB</small>
                      <input required name="ktp" type="file" class="form-control" id="ktp" placeholder="Password">
                    </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" name="add" class="btn btn-primary">Tambah</button>
                </div>
              </div>
            </div>
          </div>
          </form>
          <!-- end modal -->