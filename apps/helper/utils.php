<?php
class utils
{

    public static function uploadImage($data, $nik = null)
    {

        $nama_file = $data['name'];
        $ukuran_file = $data['size'];
        $error = $data['error'];
        $tmp = $data['tmp_name'];
        $format_sesuai = ['jpg', 'jpeg', 'png'];
        $format_file = explode('.', $nama_file);
        $format_file = strtolower(end($format_file));
        if (!in_array($format_file, $format_sesuai)) {
            $result = ['result' => false, "message" => 'Gagal, Pilih file yang Valid jpg/jpeg/png'];
        } elseif ($ukuran_file > 2500000) {
            $result = ['result' => false, "message" => 'Gagal, size file yang dipilih terlalu besar'];
        } else {
            $nama_image = 'ktp' . $nik;
            $nama_image .= ".";
            $nama_image .= $format_file;
            try {
                move_uploaded_file($tmp, 'public/asset/img/ktp/' . $nama_image);
                $result = ['result' => true, 'fileName' => $nama_image];
            } catch (Exception $e) {
                $result = ['result' => false, "message" => $e];
            }
        }
        return $result;
    }
}
