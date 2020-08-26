<?php

namespace App\Adm\Model;

use \Nornas\Model;

class User extends Model
{
	protected $table = "users";

	public function __construct()
	{
		parent::__construct();
	}
}