<?php

namespace App\Adm\Model;

use \Nornas\Model;

class Group extends Model
{
    protected $table = "groups";

    public function __construct()
    {
        parent::__construct();
    }
}