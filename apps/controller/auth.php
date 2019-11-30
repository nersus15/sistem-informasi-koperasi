<?php
class auth extends controller
{
    public function __construct()
    {
        if (isset($_SESSION['login'])) {
            if ($_SESSION['user_data']['role'] == 1) {
                header('Location: ' . BASEURL . '/admin');
            } else if ($_SESSION['user_data']['role'] == 2) {
                header('Location: ' . BASEURL . '/member');
            }
        }
    }
    public function index()
    {
        $data['pageTitle'] = "Koperasi | Login";
        $this->view('header/main', $data);
        $this->view('auth/login');
        $this->view('footer/main');
    }
    public function login()
    {
        $data = $_POST;
        if (strlen($data['user']) == 0 && strlen($data['password']) == 0) {
            flasher::setFlash('Field Username dan Password Kosong, Mohon Isi Username dan Password', 'danger');
            header('Location:' . BASEURL . '/auth');
        } else if ($data['user'] == '' && $data['password'] != '') {
            flasher::setFlash('Field Username Kosong, Mohon Isi Username', 'danger');
            header('Location:' . BASEURL . '/auth');
        } else if ($data['user'] != '' && $data['password'] == '') {
            flasher::setFlash('Field Password Kosong, Mohon Isi Password', 'danger');
            header('Location:' . BASEURL . '/auth');
        } else {
            $this->model('user_model')->login($data);
        }
    }
    public function logout()
    {
        unset($_SESSION['login']);
        unset($_SESSION['user_data']);
        header('location:' . BASEURL . '/auth');
        exit;
    }
}
