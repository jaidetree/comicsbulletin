<?php
error_reporting( E_ALL );
define( 'ROOT', dirname( __FILE__ ) . '/' );

require_once ROOT . "includes/app.class.php";

$files = array(
    "functions.php",
    "controller.class.php",
    "php-activerecord/ActiveRecord.php",
    "template.php",
);

foreach( $files as $file )
{
    require_once ROOT . 'includes/' . $file;
}

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
    $object = new $name();

    APP::add_controller($object);
}

ActiveRecord\Config::initialize(function($cfg){
    $cfg->set_model_directory( ROOT . '/' );
    $cfg->set_connections(array(
        'development' => 'mysql://' . 
        APP::cfg('db', 'username') . ':' . 
        APP::cfg('db', 'password') . '@' .
        APP::cfg('db', 'host') . '/' .
        APP::cfg('db', 'name') ));
});

?>
