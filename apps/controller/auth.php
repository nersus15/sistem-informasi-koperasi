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
        $this->model('user_model')->login($data);
    }
    public function logout()
    {
        unset($_SESSION['login']);
        unset($_SESSION['user_data']);
        header('location:' . BASEURL . '/auth');
        exit;
    }
}
