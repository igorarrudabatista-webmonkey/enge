<?php

$loader = new \Nornas\Autoloader();
$loader->addNamespace(
	"\\Nornas\\",
	NORNAS_PATH
);
$loader->addNamespace(
    "\\App\\Controller\\",
    str_replace("/", DIRECTORY_SEPARATOR, SITE_PATH . "/src/App/Controller")
);
$loader->addNamespace(
    "\\App\\Model\\",
    str_replace("/", DIRECTORY_SEPARATOR, SITE_PATH . "/src/App/Model")
);
$loader->addNamespace(
	"\\App\\Adm\\Controller\\",
    str_replace("/", DIRECTORY_SEPARATOR, SITE_PATH . "/src/App/Adm/Controller")
);
$loader->addNamespace(
	"\\App\\Adm\\Model\\",
    str_replace("/", DIRECTORY_SEPARATOR, SITE_PATH . "/src/App/Adm/Model")
);