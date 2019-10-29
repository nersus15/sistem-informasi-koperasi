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
        if (isset($account)) {

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
                flasher::setFlash('Username/Password Salah', 'danger');
                header('Location:' . BASEURL . '/auth');
            }
        }
    }
}