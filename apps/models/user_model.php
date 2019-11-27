<?php
class user_model
{
    private $DB;
    public function __construct()
    {
        $this->DB = new database;
    }
    public function login($data)
    {
        $user = strtolower(stripslashes($data['user']));
        $password = $data['password'];
        $query = "SELECT * FROM user WHERE email =:user or username=:user";
        $this->DB->query($query);
        $this->DB->bind('user', $user);
        $account = $this->DB->single();
        if ($account !== false) {
            if (password_verify($password, $account['password'])) {
                $_SESSION["login"] = true;
                $_SESSION['log'] = [
                    'aksi' => 'Login',
                    'user' => $account['nama']
                ];
                $_SESSION['user_data'] = [
                    'id' => $account['id'],
                    'email' => $data['email'],
                    'username' => $account['username'],
                    'role' => $account['role'],
                    'image' => $account['img'],
                    'status' => $account['status'],
                    'password' => $password
                ];
                header('Location:' . BASEURL . '/auth');
            } else {
                flasher::setFlash('Password untuk akun ' . $user . '  Salah', 'danger');
                header('Location:' . BASEURL . '/auth');
            }
        } else {
            flasher::setFlash('Username (email/NIK) ' . $user . ' Salah/ Tidak terdaftar', 'danger');
            header('Location:' . BASEURL . '/auth');
        }
    }
    public function signUp($data)
    {
        if (!isset($data['email'])) {
            $data['email'] = "-";
        }
        $id = uniqid();
        $password = password_hash($data['nik'], PASSWORD_DEFAULT);
        $this->DB->query('INSERT INTO user VALUES(:id, :username, :email, :password, "default.jpg", 2)');
        $this->DB->bind('id', $id);
        $this->DB->bind('username', $data['nik']);
        $this->DB->bind('email', $data['email']);
        $this->DB->bind('password', $password);
        $this->DB->execute();
        if ($this->DB->rowCount() > 0) {
            flasher::setFlash('Berhasil Menambah Member', 'success');
            header('Location:' . BASEURL . '/admin/member_menu');
        } else {
            flasher::setFlash('Gagal Menambah Member', 'danger');
            header('Location:' . BASEURL . '/admin/member_menu');
        }
    }
    public function getAllMember()
    {
        $this->DB->query("SELECT * FROM member");
        return $this->DB->resultSet();
    }
}
