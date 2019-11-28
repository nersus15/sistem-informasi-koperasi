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
            if ($account['status'] == 0) {
                die('Akun dan Keanggotaan anda di nonaktifkan, hubungi admin untuk mengaktifkan akun dan status keanggotaan');
            }
            if (password_verify($password, $account['password'])) {
                $_SESSION["login"] = true;
                $_SESSION['log'] = [
                    'aksi' => 'Login',
                    'user' => $account['nama']
                ];
                $_SESSION['user_data'] = [
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
        if ($data['jk'] === 'Perempuan') {
            $img = 'defaultP.jpg';
        } else if ($data['jk'] === 'Laki-laki') {
            $img = 'defaultL.jpg';
        }
        $password = password_hash($data['nik'], PASSWORD_DEFAULT);
        $this->DB->query('INSERT INTO user VALUES(:username, :email, :password,:img, 2,1)');
        $this->DB->bind('username', $data['nik']);
        $this->DB->bind('email', $data['email']);
        $this->DB->bind('password', $password);
        $this->DB->bind('img', $img);
        $this->DB->execute();
    }
    public function getAllMember()
    {
        $this->DB->query("SELECT * FROM member");
        return $this->DB->resultSet();
    }
    public function nonAktifkanUser($username)
    {
        $username = implode($username);
        $this->DB->query('UPDATE user SET user.status=0 WHERE user.username=:username');
        $this->DB->bind('username', $username);
        $this->DB->execute();
        flasher::setFlash('Member dengan Username: ' . $username . ' Di Non Aktifkan', 'warning');
        header('Location:' . BASEURL . '/admin/member_menu');
    }
    public function aktifkanUser($username)
    {
        $username = implode($username);
        $this->DB->query('UPDATE user SET user.status=1 WHERE user.username=:username');
        $this->DB->bind('username', $username);
        $this->DB->execute();
        flasher::setFlash('Member dengan Username: ' . $username . ' Berhasil Di Aktifkan', 'success');
        header('Location:' . BASEURL . '/admin/member_menu');
    }
    public function deleteUser($username, $ktp, $photoProfile)
    {
        if ($photoProfile != 'defaultL.jpg' && $photoProfile != 'defaultP.jpg') {
            try {
                unlink('pulic/asset/img/profile/' . $photoProfile);
            } catch (Exception $er) {
                die($er);
            }
        }
        try {
            unlink('public/asset/img/ktp/' . $ktp);
        } catch (Exception $er) {
            die($er);
        }

        $this->DB->query('DELETE from user WHERE user.username=:username');
        $this->DB->bind('username', $username);
        $this->DB->execute();
        flasher::setFlash('Member dengan Username: ' . $username . ' Telah di Hapus', 'danger');
        header('Location:' . BASEURL . '/admin/member_menu');
    }
}
