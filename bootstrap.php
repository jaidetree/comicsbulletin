<?php
error_reporting( E_ALL & ~E_NOTICE );
define( 'ROOT', dirname( __FILE__ ) . '/' );

require_once ROOT . "includes/app.class.php";
/**
 * Files to include 
 */
$files = array(
    "functions.php",
    "controller.class.php",
    "template.php",
    "db.class.php",
    "mysql.class.php",
    "manager.class.php",
    "model.class.php",
    "error.class.php",
    "pagination.class.php"
);

/**
 * Include those required files
 */
foreach( $files as $file )
{
    if( ! file_exists( ROOT . 'includes/' . $file ) )
    {
        continue;
    }
    require_once ROOT . 'includes/' . $file;
}

/**
 * Initalize our drivers
 */
APP::$db = new MySQL( APP::cfg('db', 'host'), APP::cfg('db', 'username'), APP::cfg('db', 'password'), APP::cfg('db', 'name') );

define( 'DB_PRE', APP::cfg('db', 'prefix') );


/** 
 * Load our Controllers 
 */
$controller_dir = ROOT . 'controllers/';
$dir = dir($controller_dir);
while( ($file = $dir->read()) !== false )
{
    if( ! preg_match( '/\.class\.php$/', $file ) )
    {
        continue;
    }
    require_once $controller_dir . $file;
    $name = ucwords(basename($file, ".class.php"));
    $class_name = $name . "Controller";
    $object = new $class_name();

    APP::add_controller($name, $object);
}

/**
 * Load our Models 
 */
$model_dir = ROOT . 'models/';
$dir = dir($model_dir);
while( ($file = $dir->read()) !== false )
{
    if( ! preg_match( '/\.php$/', $file ) )
    {
        continue;
    }
    require_once $model_dir . $file;
}

?>
