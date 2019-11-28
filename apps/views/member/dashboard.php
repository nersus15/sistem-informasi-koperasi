                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>

                    </div>
                    <!-- Content Row -->
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-4 col-lg-4 col-md-4">
                                <div class="table-responsive">
                                    <table class="table">
                                        <tr>
                                            <td>
                                                <img class="img-fluid" src="

use function PHPSTORM_META\type;

<?= BASEPATH . '/asset/img/profile/' . $data['member']['img'] ?>" alt="">
                                            </td>
                                            <th>Informasi Pribadi</th>
                                        </tr>
                                        <tr>
                                            <th>NIK: </th>
                                            <td><?= $data['member']['nik'] ?></td>
                                        </tr>
                                        <tr>
                                            <th>Nama Lengkap: </th>
                                            <td><?= $data['member']['nama_lengkap'] ?></td>
                                        </tr>
                                        <tr>
                                            <th>Alamat: </th>
                                            <td><?= $data['member']['alamat'] ?></td>
                                        </tr>
                                        <tr>
                                            <th>Tanggal Lahir: </th>
                                            <td><?= $data['member']['tanggal_lahir'] ?></td>
                                        </tr>
                                        <tr>
                                            <th>Username: </th>
                                            <td><?= $data['member']['username'] ?></td>
                                        </tr>
                                        <tr>
                                            <th>email: </th>
                                            <td><?= $data['member']['email'] ?></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="col-sm-5 col-lg-5 col-md-5 ml-5">
                                <div class="table-responsive">
                                    <table class="table">
                                        <tr>
                                            <th colspan="2">Informasi Transaksi</th>
                                        </tr>
                                        <tr>
                                            <th>Saldo: </th>
                                            <td><?= $data['tabungan']['saldo'] ?></td>
                                        </tr>
                                        <tr>
                                            <th>Terkhir Setoran/ Menabung: </th>
                                            <?php if ($data['tabungan']['tgl_nabung'] == '-') : ?>
                                                <td><?= $data['tabungan']['tgl_nabung'] ?></td>
                                            <?php else : ?>
                                                <td><?= date('d M Y', $data['tabungan']['tgl_nabung']); ?></td>
                                            <?php endif ?>

                                        </tr>
                                        <tr>
                                            <th>Terkhir Meminjam: </th>
                                            <td>24 Agustus 2019</td>
                                        </tr>
                                        <tr>
                                            <th> Jumlah Setoran Terakhir: </th>
                                            <td><?= $data['tabungan']['jumlah'] ?></td>
                                        </tr>
                                        <tr>
                                            <th> Jumlah Pinjaman Terakhir: </th>
                                            <td>Rp. 400.000</td>
                                        </tr>
                                        <tr>
                                            <th>Tenggat Waktu Pinjaman: </th>
                                            <td>31 Agustus 2019</td>
                                        </tr>
                                        <tr>
                                            <th>Status Pinjaman Terakhir: </th>
                                            <td>Lunas</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>