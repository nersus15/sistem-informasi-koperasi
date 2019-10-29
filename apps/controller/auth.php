<?php
class auth extends controller
{
    public function index()
    {
        $data['pageTitle'] = "Koperasi | Login";
        $this->view('header/main', $data);
        $this->view('auth/login');
        $this->view('footer/main');
    }
}
