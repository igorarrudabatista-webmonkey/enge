<?php

/**
 * ===============================
 * Configurações da base de dados.
 * ===============================
 */

define("DB_TYPE", "mysql");
define("DB_HOST", "192.185.223.157");
define("DB_NAME", "aptii251_engeagropat");
define("DB_USER", "aptii251_enge");
define("DB_PASS", "c2m9p#e");

/**
 * Configurações de URL.
 */

define("SITE_URL", "http://localhost/engeagro/");
define("ADM_URL", SITE_URL . "sistemapat/");
define("STATIC_URL", SITE_URL . "public/static/");

define("SITE_NAME", "Sistemapat | ");

/**
 * Configurações de PATH.
 */

define("SITE_PATH", realpath(dirname(__FILE__) . "/../"));
define("STATIC_PATH", realpath(dirname(__FILE__) . "/../public/static/"));
define("CONFIG_PATH", realpath(dirname(__FILE__)));
define("APP_PATH", realpath(dirname(__FILE__) . "/../src/App/") . DIRECTORY_SEPARATOR);
define("NORNAS_PATH", realpath(dirname(__FILE__) . "/../vendor/Nornas/") . DIRECTORY_SEPARATOR);
define("VIEW_PATH", str_replace("/", DIRECTORY_SEPARATOR, APP_PATH . "View"));
define("ADM_VIEW_PATH", str_replace("/", DIRECTORY_SEPARATOR, APP_PATH . "Adm/View"));
define("USR_VIEW_PATH", str_replace("/", DIRECTORY_SEPARATOR, APP_PATH . "Usr/View"));

define("MAX_UPLOAD_SIZE", 5000);

/**
 * ICONES
 */

define("ICON_COMPANY", "fa-building-o");
define("ICON_USER", "fa-users");
define("ICON_GROUP", "fa-tags");

