<?php
include "bootstrap.php";
APP::load_route( preg_replace('/^\//', '', $_SERVER['REQUEST_URI']) );
?>
