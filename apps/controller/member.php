<?php
class member extends controller
{
    private $utils;
    public function __construct()
    {
        $this->utils = new utils;
        // cek apakah client sudah login
        if (!isset($_SESSION['login'])) {
            header('Location: ' . BASEURL . '/auth');
        }

        // Cek apakah akunnya aktif atau tidak
        if ($this->utils->getUserStatus($_SESSION['user_data']['username']) == false) {
            unset($_SESSION['login']);
            unset($_SESSION['user_data']);
            die('Akun dan Keanggotaan anda di nonaktifkan, hubungi admin untuk mengaktifkan akun dan status keanggotaan');
        }
    }
}
