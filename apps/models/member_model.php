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
        $this->DB->query('SELECT * FROM member');
        return $this->DB->resultSet();
    }
    public function addMember($data)
    {

        $id = uniqid();
        $status = 1;
        $this->DB->query('INSERT INTO member values(:id, :namaLengkap, :alamat, :NIK, :ttl, :ktp, :email, :status)');
        $this->DB->bind('id', $id);
        $this->DB->bind('namaLengkap', $data['namaLengkap']);
        $this->DB->bind('alamat', $data['alamat']);
        $this->DB->bind('NIK', $data['NIK']);
        $this->DB->bind('ttl', $data['tanggalLahir']);
        $this->DB->bind('ktp', $_FILES['KTP']['name']);
        $this->DB->bind('email', $data['email']);
        $this->DB->bind('status', $status);
        $this->DB->execute();
        if ($this->DB->rowCount() > 0) {
            flasher::setFlash('Berhasil Menambah Member', 'success');
            header('Location:' . BASEURL . '/admin/member_menu');
        }
    }
    public function deleteMember($id)
    {
        $id = implode($id);
        $this->DB->query('DELETE FROM member WHERE id=:id');
        $this->DB->bind('id', $id);
        $this->DB->execute();
        flasher::setFlash('Berhasil Menghapus Member dengan Id: ' . $id, 'success');
        header('Location:' . BASEURL . '/admin/member_menu');
    }
}
