<?php
/**
 * Created by Uprzejmy
 */

require_once ($_SERVER['DOCUMENT_ROOT']."/Front/App.php");

$app = App::getInstance();
$app->run();

die();
