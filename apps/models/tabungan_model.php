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
    public function nabung($data)
    {
        // Persiapan
        // Ambil data user dan member yang login
        $member = $this->utils->getMember();
        // Ambil data tabungan sebelumnya]
        $tabunganSebelumnya = $this->getLogTabungan();
        $tgl = time();
        if ($tabunganSebelumnya == null) {
            $saldo = (int) $_POST['jumlah'];
        } else {
            $saldo = (int) $tabunganSebelumnya[0]['saldo'] + (int) $_POST['jumlah'];
        }
        $jumlah = (int) $_POST['jumlah'];
        $status = 'Menunggu Konfirmasi';

        //  Query ke DB
        $this->DB->query('INSERT INTO simpanan_sukarela(`anggota`, `tgl_nabung`, `jumlah`, `saldo`, `status`) values(:anggota, :tgl, :jumlah, :saldo, :status)');
        $this->DB->bind('anggota', $member['nik']);
        $this->DB->bind('tgl', $tgl);
        $this->DB->bind('jumlah', $jumlah);
        $this->DB->bind('saldo', $saldo);
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
}
