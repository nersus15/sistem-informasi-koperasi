<?php
class admin extends controller
{
    public function __construct()
    {
        if (!isset($_SESSION['login'])) {
            header('Location: ' . BASEURL . '/auth');
        }
    }
    public function index()
    {
        $data['pageTitle'] = "Admin | Dashboard";
        $this->view('header/admin', $data);
        $this->view('navigasi/adminPanel', $data);
        $this->view('admin/dashboard');
        $this->view('footer/main');
    }
}
