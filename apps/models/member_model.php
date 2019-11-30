<?php
class member_model
{
    private $DB;
    public function __construct()
    {
        $this->DB = new database;
    }

    public function getAllMember()
    {
        $this->DB->query('SELECT * FROM member JOIN user ON (member.account=user.username)');
        return $this->DB->resultSet();
    }
    public function addMember($data)
    {
        $uploadResult = utils::uploadImage($_FILES['ktp'], $data['nik']);
        if ($uploadResult['result'] == false) {
            flasher::setFlash($uploadResult['message'], 'danger');
            header('Location:' . BASEURL . '/admin/member_menu');
        }
        $ttl = strtotime($data['ttl']);
        $this->DB->query('INSERT INTO member values(:NIK,  :namaLengkap, :alamat,:ttl,:jk, :ktp, :akun)');
        $this->DB->bind('namaLengkap', $data['namaLengkap']);
        $this->DB->bind('alamat', $data['alamat']);
        $this->DB->bind('NIK', $data['nik']);
        $this->DB->bind('ttl', $ttl);
        $this->DB->bind('jk', $data['jk']);
        $this->DB->bind('ktp', $uploadResult['fileName']);
        $this->DB->bind('akun', '@' . $data['nik']);
        $this->DB->execute();
        if ($this->DB->rowCount() > 0) {
            flasher::setFlash('Berhasil Menambah Member', 'success');
            header('Location:' . BASEURL . '/admin/member_menu');
        } else {
            flasher::setFlash('Gagal Menambah Member', 'danger');
            header('Location:' . BASEURL . '/admin/member_menu');
        }
    }
    public function getMember($username)
    {
        $this->DB->query('SELECT * FROM member JOIN user ON (user.username=:username and member.account=user.username)');;
        $this->DB->bind('username', $username);
        return $this->DB->single();
    }
}
