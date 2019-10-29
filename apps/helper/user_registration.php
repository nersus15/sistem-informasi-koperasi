<?php
class user_registration
{
    public function newAccount($data)
    {

        // cek apakah inputan sesuai
        if (strlen($data['inputan']['Password']) < 8) {
            flasher::setFlash('Gagal, Karakter Password/ NIM kurang dari 8', 'danger');
            $result = false;
        } elseif ($data['inputan']['Password'] != $data['inputan']['Password2']) {
            flasher::setFlash('Gagal, Password tidak cocok', 'danger');
            $result = false;
        } elseif ($data['akun'] !== false) {
            flasher::setFlash('Gagal, Email Sudah digunakan', 'danger');
            $result = false;
        } else {
            flasher::setFlash('Akun Baru Berhasil ditambahkan', 'success');
            $result = true;
        }
        return $result;
    }
    public function newPeserta($data, $register)
    {
        if ($data['jurusan'] === 'Pilih Jurusan') {
            flasher::setFlash('Gagal,Jurusan belum dipilih', 'danger');
            $result = false;
        } elseif ($data['semester'] === 'Pilih Semester') {
            flasher::setFlash('Gagal, Semester belum dipilih', 'danger');
            $result = false;
        } elseif (!isset($data['jenis_kelamin'])) {
            flasher::setFlash('GagalJenis Kelamin belum dipilih', 'danger');
            $result = false;
        } elseif ($data['matkul1'] === 'Mata Kuliah') {
            flasher::setFlash('Gagal, Mata Kuliah 1, belum dipilih', 'danger');
            $result = false;
        } elseif ($register !== false) {
            flasher::setFlash('Gagal, NIM Sudah Terdaftar', 'danger');
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }
}
