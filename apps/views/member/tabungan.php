     <?php $utils = new utils; ?>
     <!-- Begin Page Content -->
     <div class="container-fluid">

         <!-- Page Heading -->
         <h1 class="h3 mb-2 text-gray-800">Tabungan</h1>
         <!-- Message -->
         <div><?= flasher::flash(); ?></div>
         <!-- DataTales Example -->
         <div class="card shadow mb-4">
             <div class="card-header py-3">
                 <h6 class="float-left mr-3 m-0 font-weight-bold text-primary">Catatan Tabungan</h6>
                 <!-- Button trigger modal -->
                 <button class='btn btn-xs btn-primary' data-toggle="modal" data-target="#nabungModal">Nabung</button>
                 <button class='btn btn-xs btn-warning' data-toggle="modal" data-target="#tarikModal">Tarik Tabungan</button>

             </div>
             <div class="card-body">
                 <div class="table-responsive">
                     <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                         <thead>
                             <tr>
                                 <th>Nomer Transaksi</th>
                                 <th>NIK</th>
                                 <th>Nama Lengkap</th>
                                 <th>Username</th>
                                 <th>Tanggal Nabung</th>
                                 <th>Jumlah</th>
                                 <th>Saldo Sebelumnya</th>
                                 <th>Saldo Sekarang</th>
                                 <th>Status</th>
                             </tr>
                         </thead>
                         <tbody>
                             <?php foreach ($data['tabungan'] as $tabungan) : ?>
                                 <tr>
                                     <td><?= $tabungan['nomer_transaksi'] ?></td>
                                     <td><?= $tabungan['nik'] ?></td>
                                     <td><?= $tabungan['nama_lengkap'] ?></td>
                                     <td><?= $data['user']['username'] ?></td>
                                     <td><?= date('d M Y', $tabungan['tgl_nabung']) ?></td>
                                     <td><?= utils::rupiahFormat((int) $tabungan['jumlah']) ?></td>
                                     <td><?= utils::rupiahFormat((int) $tabungan['saldo_sebelumnya']) ?></td>
                                     <td><?= utils::rupiahFormat((int) $tabungan['saldo']) ?></td>
                                     <td><?= $tabungan['status'] ?></td>

                                 </tr>
                             <?php endforeach ?>
                         </tbody>
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

     <!-- Modal untuk menabung -->
     <div class="modal fade" id="nabungModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog" role="document">
             <div class="modal-content">
                 <div class="modal-header">
                     <h5 class="modal-title" id="exampleModalLabel">Nabung</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                     </button>
                 </div>
                 <div class="modal-body">
                     <!-- Form untuk Menabung -->
                     <form action="<?= BASEURL . '/member/nabung ' ?>" method="POST" enctype="multipart/form-data">
                         <div class="form-group">
                             <label for="jumlah">Jumlah</label>
                             <input required class="form-control" type="text" name="jumlah" id="jumlah">
                         </div>
                 </div>
                 <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                     <button type="submit" class="btn btn-primary">Tambah</button>
                 </div>
             </div>
         </div>
     </div>
     </form>
     <!-- end modal -->
     <!-- Modal untuk Mengambil Tabungan -->
     <div class="modal fade" id="tarikModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog" role="document">
             <div class="modal-content">
                 <div class="modal-header">
                     <h5 class="modal-title" id="exampleModalLabel">Tarik Tabungan</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                     </button>
                 </div>
                 <div class="modal-body">
                     <!-- Form untuk Mengambil Tabungan -->
                     <form action="<?= BASEURL . '/member/tarik ' ?>" method="POST" enctype="multipart/form-data">
                         <div class="form-group">
                             <label for="jumlah">Jumlah</label>
                             <input required class="form-control" type="text" name="jumlah" id="jumlah">
                         </div>
                 </div>
                 <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                     <button type="submit" class="btn btn-primary">Tarik</button>
                 </div>
             </div>
         </div>
     </div>
     </form>
     <!-- end modal -->