<?php
class member extends controller
{
    private $utils;
    public function __construct()
    {
        $this->utils = new utils;
        // cek apakah client sudah login
        if (!isset($_SESSION['login']) or $_SESSION['user_data']['role'] == 1) {
            header('Location: ' . BASEURL . '/auth');
        }

        // Cek apakah akunnya aktif atau tidak
        if ($this->utils->getUserStatus($_SESSION['user_data']['username']) == false) {
            unset($_SESSION['login']);
            unset($_SESSION['user_data']);
            die('Akun dan Keanggotaan anda di nonaktifkan, hubungi admin untuk mengaktifkan akun dan status keanggotaan');
        }
    }
    public function index()
    {
        $data['pageTitle'] = "Member | Dashboard";
        $data['member'] = $this->model('member_model')->getMember($_SESSION['user_data']['username']);
        $data['tabungan'] = $data['tabungan'] = $this->model('tabungan_model')->getTabunganTerakhir();
        if ($data['tabungan'] == null) {
            $data['tabungan'] = ['saldo' => '-', 'jumlah' => '-', 'tgl_nabung' => '-'];
        } else {
            $data['tabungan']['saldo'] = $this->helper('utils')->rupiahFormat($data['tabungan']['saldo']);
            $data['tabungan']['jumlah'] = $this->helper('utils')->rupiahFormat($data['tabungan']['jumlah']);
        }
        $this->view('header/admin', $data);
        $this->view('navigasi/mainPrimary', $data);
        $this->view('member/dashboard', $data);
        $this->view('footer/main');;
    }
    public function tabungan()
    {
        // $data['member'] = $this->model('member_model')->getAllMember();
        $data['pageTitle'] = "Koperasi | Members";
        $data['tabungan'] = $this->model('tabungan_model')->getLogTabungan();
        $data['user'] = $_SESSION['user_data'];
        $this->view('header/data-tables', $data);
        $this->view('navigasi/mainPrimary', $data);
        $this->view('member/tabungan', $data);
        $this->view('footer/data-tables');
    }
    public function nabung()
    {
        $this->model('tabungan_model')->nabung($_POST);
    }
}
