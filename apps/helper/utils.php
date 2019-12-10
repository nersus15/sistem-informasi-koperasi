<?php
class utils
{
    public function __construct()
    {
        $this->DB = new database;
    }

    public static function uploadImage($data, $nik = null)
    {

        $nama_file = $data['name'];
        $ukuran_file = $data['size'];
        $error = $data['error'];
        $tmp = $data['tmp_name'];
        $format_sesuai = ['jpg', 'jpeg', 'png'];
        $format_file = explode('.', $nama_file);
        $format_file = strtolower(end($format_file));
        if (!in_array($format_file, $format_sesuai)) {
            $result = ['result' => false, "message" => 'Gagal, Pilih file yang Valid jpg/jpeg/png'];
        } elseif ($ukuran_file > 2500000) {
            $result = ['result' => false, "message" => 'Gagal, size file yang dipilih terlalu besar'];
        } else {
            $nama_image = 'ktp' . $nik;
            $nama_image .= ".";
            $nama_image .= $format_file;
            try {
                move_uploaded_file($tmp, 'public/asset/img/ktp/' . $nama_image);
                $result = ['result' => true, 'fileName' => $nama_image];
            } catch (Exception $e) {
                $result = ['result' => false, "message" => $e];
            }
        }
        return $result;
    }
    public function getUserStatus($username)
    {
        $this->DB->query('SELECT user.status FROM user WHERE user.username=:username');
        $this->DB->bind('username', $username);
        $userStatus = $this->DB->single();
        if ($userStatus['status'] == 0) {
            return false;
        } else {
            return true;
        }
    }
    public function getMember()
    {
        $this->DB->query('SELECT * FROM member WHERE member.account=:username ');
        $this->DB->bind('username', $_SESSION['user_data']['username']);
        return $this->DB->single();
    }
    function rupiahFormat($angka)
    {

        $hasil_rupiah = "Rp. " . number_format($angka, 2, ',', '.');
        return $hasil_rupiah;
    }
    function getPengajuanTabungan()
    {
        $this->DB->query('SELECT * FROM simpanan_sukarela WHERE simpanan_sukarela.status="Menunggu Konfirmasi" ORDER BY simpanan_sukarela.nomer_transaksi');
        return $this->DB->resultSet();
    }
    function getPengajuanPenarikan()
    {
        $this->DB->query('SELECT * FROM penarikan WHERE penarikan.status="Menunggu Konfirmasi" ORDER BY penarikan.nomer_transaksi');
        return $this->DB->resultSet();
    }
    function getUserDataFromTabungan()
    {
        $this->DB->query('SELECT * FROM simpanan_sukarela WHERE simpanan_sukarela.status="Menunggu Konfirmasi" GROUP BY simpanan_sukarela.anggota');
        $member = $this->DB->resultSet();
        $user = [];
        foreach ($member as $m) {
            $this->DB->query('SELECT * FROM member WHERE member.nik=:member');
            $this->DB->bind('member', $m['anggota']);
            $memberData = $this->DB->single();

            $this->DB->query('SELECT * FROM user WHERE user.username=:username');
            $this->DB->bind('username', $memberData['account']);
            $userData = $this->DB->single();
            array_push($user, $userData);
        }
        return $user;
    }
    function getSaldoMember($nik)
    {
        $this->DB->query("SELECT sum(simpanan_sukarela.jumlah) as saldo from simpanan_sukarela WHERE simpanan_sukarela.status='Dikonfirmasi' AND simpanan_sukarela.anggota=:nik GROUP BY simpanan_sukarela.anggota");
        $this->DB->bind('nik', $nik);
        return $this->DB->single();
    }
    function getSaldoTerbesar($nik)
    {
        $this->DB->query("SELECT saldo from simpanan_sukarela WHERE simpanan_sukarela.status='Dikonfirmasi' AND simpanan_sukarela.anggota=:nik ORDER BY saldo DESC LIMIT 1");
        $this->DB->bind('nik', $nik);
        return $this->DB->single();
    }
    function getMemberFromFromTabungan($noTransaksi)
    {
        $this->DB->query("SELECT anggota FROM simpanan_sukarela WHERE simpanan_sukarela.nomer_transaksi=:notran");
        $this->DB->bind('notran', $noTransaksi);
        return $this->DB->single();
    }
    function getMemberFromPenarikan($noTransaksi)
    {
        $this->DB->query("SELECT anggota FROM penarikan WHERE penarikan.nomer_transaksi=:notran");
        $this->DB->bind('notran', $noTransaksi);
        return $this->DB->single();
    }
}
