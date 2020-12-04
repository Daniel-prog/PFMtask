<?php

define("ROOT", $_SERVER['DOCUMENT_ROOT']);
define("CONTROLLER_PATH", ROOT . "/api/controllers/");
define("MODEL_PATH", ROOT . "/api/models/");
define("GEN_URL", "/api/generate");
define("GET_URL", "/api/by-id");
define("RM_URL", "/api/remove");

require_once("db.php");
require_once("router.php");
require_once MODEL_PATH . 'Model.php';
require_once CONTROLLER_PATH . 'Controller.php';

Routing::buildRoute();