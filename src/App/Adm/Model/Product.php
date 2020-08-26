<?php

namespace App\Adm\Model;

use \Nornas\Model;

class Product extends Model
{
	protected $table = "products";

	public function __construct()
	{
		parent::__construct();
	}
}