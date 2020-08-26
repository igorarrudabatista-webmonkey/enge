<?php

namespace App\Adm\Model;

use \Nornas\Model;

class Company extends Model
{
    protected $table = "companies";

    public function __construct()
    {
        parent::__construct();
    }
}