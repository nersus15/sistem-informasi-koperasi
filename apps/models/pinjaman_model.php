<?php
class tabungan_model
{
    private $DB, $utils;
    public function __construct()
    {
        $this->utils = new utils;
        $this->DB = new database;
    }
}
