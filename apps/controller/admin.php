<?php
class admin extends controller
{
    public function __construct()
    {
        // cek apakah client sudah login
        if (!isset($_SESSION['login']) or $_SESSION['user_data']['role'] == 2) {
            header('Location: ' . BASEURL . '/auth');
        }
    }
    public function index()
    {
        $data['pageTitle'] = "Admin | Dashboard";
        $data['user'] = $_SESSION['user_data'];
        $this->view('header/admin', $data);
        $this->view('navigasi/main', $data);
        $this->view('admin/dashboard', $data);
        $this->view('footer/main');;
    }
    public function member_menu()
    {
        if (isset($_POST['add'])) {
            $this->model('user_model')->signUp($_POST);
            $this->model('member_model')->addMember($_POST);
        } else {
            $data['member'] = $this->model('member_model')->getAllMember();
            $data['pageTitle'] = "Koperasi | Members";
            $data['user'] = $_SESSION['user_data'];
            $this->view('header/data-tables', $data);
            $this->view('navigasi/main', $data);
            $this->view('admin/member-menu', $data);
            $this->view('footer/data-tables');
        }
    }
    public function delete_member($data)
    {
        $this->model('user_model')->deleteUser($data[0], $data[1], $data[2]);
    }
    public function nonaktif_member($username)
    {
        $this->model('user_model')->nonAktifkanUser($username);
    }
    public function aktif_member($username)
    {
        $this->model('user_model')->aktifkanUser($username);
    }
    public function tabungan($params)
    {
        $page = $params[0];
        if ($page == 'konfirmasi') {
            $data['user'] = $_SESSION['user_data'];
            $data['tabungan'] = $this->helper('utils')->getPengajuanTabungan();
            $data['pageTitle'] = "Koperasi | Tabungan";
            $this->view('header/data-tables', $data);
            $this->view('navigasi/main', $data);
            $this->view('admin/konfirmasi-tabungan', $data);
            $this->view('footer/data-tables');
        } else if ($page == 'konfirm') {
            $noTransaksi = $params[1];
            $jumlah = $params[2];
            $this->model('tabungan_model')->konfirmasiTabungan($noTransaksi, $jumlah);
        }
    }
}
