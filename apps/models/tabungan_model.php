<?php
class tabungan_model
{
    private $DB, $utils;
    public function __construct()
    {
        $this->utils = new utils;
        $this->DB = new database;
    }
    public function getLogTabungan()
    {
        $member = $this->utils->getMember();
        $this->DB->query('SELECT * FROM simpanan_sukarela join member on(member.nik=:nik AND simpanan_sukarela.anggota=member.nik) ORDER BY simpanan_sukarela.tgl_nabung DESC');
        $this->DB->bind('nik', $member['nik']);
        return $this->DB->resultSet();
    }
    public function getLogPenarikan()
    {
        $member = $this->utils->getMember();
        $this->DB->query('SELECT * FROM penarikan join member on(member.nik=:nik AND penarikan.anggota=member.nik) ORDER BY penarikan.tgl_penarikan DESC');
        $this->DB->bind('nik', $member['nik']);
        return $this->DB->resultSet();
    }
    public function nabung($data)
    {
        // Persiapan
        $tgl = time();
        $jumlah = (int) $data['jumlah'];
        $status = 'Menunggu Konfirmasi';
        // Ambil data user dan member yang login
        $member = $this->utils->getMember();
        // Ambil data tabungan sebelumnya]
        $saldoTerakhir = $this->utils->getSaldoTerbesar($member['nik']);
        if ($saldoTerakhir == false) {
            $saldoTerakhir = 0;
        } else {
            $saldoTerakhir = (int) $saldoTerakhir['saldo'];
        }
        $saldo = $saldoTerakhir + $jumlah;


        //  Query ke DB
        $this->DB->query('INSERT INTO simpanan_sukarela(`anggota`, `tgl_nabung`, `jumlah`,`saldo_sebelumnya`, `saldo`, `status`) values(:anggota, :tgl, :jumlah,:saldoSeblumnya, 0, :status)');
        $this->DB->bind('anggota', $member['nik']);
        $this->DB->bind('tgl', $tgl);
        $this->DB->bind('jumlah', $jumlah);
        $this->DB->bind('saldoSeblumnya', $saldoTerakhir);
        // $this->DB->bind('saldo', $saldo);
        $this->DB->bind('status', $status);
        $this->DB->execute();

        if ($this->DB->rowCount() > 0) {
            flasher::setFlash('Berhasil, Tinggal tunggu konfirmasi dari admin', 'success');
            header('Location:' . BASEURL . '/member/tabungan');
        }
    }
    public function getTabunganTerakhir()
    {
        $member = $this->utils->getMember();
        $this->DB->query('SELECT * FROM simpanan_sukarela join member on(member.nik=:nik AND simpanan_sukarela.anggota=member.nik AND simpanan_sukarela.status="Dikonfirmasi") ORDER BY simpanan_sukarela.tgl_nabung DESC LIMIT 1');
        $this->DB->bind('nik', $member['nik']);
        return $this->DB->single();
    }
    function getPenarikanTerakhir()
    {
        $member = $this->utils->getMember();
        $this->DB->query('SELECT * FROM penarikan join member on(member.nik=:nik AND penarikan.anggota=member.nik AND penarikan.status="Dikonfirmasi") ORDER BY penarikan.tgl_penarikan DESC LIMIT 1');
        $this->DB->bind('nik', $member['nik']);
        return $this->DB->single();
    }
    function konfirmasiTabungan($noTransaksi, $jumlah)
    {
        $saldoSebelumnya = $this->utils->getSaldoTerbesar($this->utils->getMemberFromFromTabungan((int) $noTransaksi)['anggota']);
        if ($saldoSebelumnya == false) {
            $saldoSebelumnya = 0;
        } else {
            $saldoSebelumnya = $saldoSebelumnya['saldo'];
        }

        $this->DB->query('UPDATE simpanan_sukarela set saldo=:saldoSebelumnya+:jumlah, simpanan_sukarela.status="Dikonfirmasi"  WHERE simpanan_sukarela.nomer_transaksi=:noTransaksi');
        $this->DB->bind('noTransaksi', (int) $noTransaksi);
        $this->DB->bind('jumlah', (int) base64_decode($jumlah));
        $this->DB->bind('saldoSebelumnya', (int) $saldoSebelumnya);
        $this->DB->execute();
        $saldo = (int) $saldoSebelumnya + (int) base64_decode($jumlah);
        $tabungan = ['tabungan' => $saldo];
        $jsonfile = json_encode($tabungan, JSON_PRETTY_PRINT);
        file_put_contents('tabungan.json', $jsonfile);
        flasher::setFlash('Tabungan denan Nomer Transaksi: ' . $noTransaksi . 'Berhasil dikonfirmasi', 'success');
        header('Location: ' . BASEURL . '/admin/tabungan');
    }
    function konfirmasiPenarikan($noTransaksi, $jumlah)
    {
        $nik = $this->utils->getMemberFromPenarikan((int) $noTransaksi)['anggota'];
        $saldoTerbesar = $this->utils->getSaldoTerbesar($nik);
        if ($saldoTerbesar == false) {
            $saldoTerbesar = 0;
        } else {
            $saldoTerbesar = $saldoTerbesar['saldo'];
        }

        $this->DB->query("UPDATE penarikan SET penarikan.status='Dikonfirmasi',sisa_saldo=penarikan.saldo_sebelumnya-:jumlah WHERE penarikan.nomer_transaksi=:noTransaksi");
        $this->DB->bind('noTransaksi', (int) $noTransaksi);
        $this->DB->bind('jumlah', (int) base64_decode($jumlah));
        $this->DB->execute();

        $this->DB->query('UPDATE simpanan_sukarela set saldo=:saldoTerbesar-:jumlah WHERE simpanan_sukarela.anggota=:nik AND saldo=:saldoTerbesar');
        $this->DB->bind('jumlah', (int) base64_decode($jumlah));
        $this->DB->bind('saldoTerbesar', (int) $saldoTerbesar);
        $this->DB->bind('nik', $nik);
        $this->DB->execute();

        $saldo = (int) $saldoTerbesar - (int) base64_decode($jumlah);
        $tabungan = ['tabungan' => $saldo];
        $jsonfile = json_encode($tabungan, JSON_PRETTY_PRINT);
        file_put_contents('tabungan.json', $jsonfile);
        flasher::setFlash('Tabungan denan Nomer Transaksi: ' . $noTransaksi . 'Berhasil dikonfirmasi', 'success');
        header('Location: ' . BASEURL . '/admin/tabungan/tarik');
    }

    function tarikTabungan($data)
    {
        // Persiapan
        $tgl = time();
        $jumlah = (int) $data["jumlah"];
        $status = 'Menunggu Konfirmasi';
        // Ambil data user dan member yang login
        $member = $this->utils->getMember();
        // Ambil data tabungan sebelumnya]
        $saldoTerakhir = $this->utils->getSaldoTerbesar($member['nik']);
        if ($saldoTerakhir != false) {
            $saldoTerakhir = (int) $saldoTerakhir['saldo'];
        }
        if ($saldoTerakhir == false || $saldoTerakhir == 0) {
            flasher::setFlash('Gagal, Anda Belum pernah menabung', 'danger');
            header('Location:' . BASEURL . '/member/tabungan');
        } else if ($saldoTerakhir < $jumlah) {
            flasher::setFlash('Gagal, Saldo Anda tidak cukup', 'danger');
            header('Location:' . BASEURL . '/member/tabungan');
            exit;
        }
        //  Query ke DB
        $this->DB->query('INSERT INTO penarikan(`anggota`, `tgl_penarikan`, `jumlah`,`saldo_sebelumnya`,`sisa_saldo`, `status`) values(:anggota, :tgl, :jumlah,:saldoSebelumnya,:sisaSaldo, :status)');
        $this->DB->bind('anggota', $member['nik']);
        $this->DB->bind('tgl', $tgl);
        $this->DB->bind('jumlah', $jumlah);
        $this->DB->bind('status', $status);
        $this->DB->bind('saldoSebelumnya', (int) $saldoTerakhir);
        $this->DB->bind('sisaSaldo', (int) $saldoTerakhir);
        $this->DB->execute();

        if ($this->DB->rowCount() > 0) {
            flasher::setFlash('Berhasil, Tinggal tunggu konfirmasi dari admin', 'success');
            header('Location:' . BASEURL . '/member/tabungan');
        }
    }
}
