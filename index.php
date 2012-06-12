<?php
include "bootstrap.php";
/**
 * MySQL DB Exmaple
APP::$db->build_run_query(array( 
    'select' => '*',
    'from' => DB_PRE . 'node',
    'limit' => '0, 10'
)); 
while( $row = APP::$db->fetch() )
{
    echo $row['title'] . "<br />";
}
 */
APP::load_route( preg_replace('/^\//', '', $_SERVER['REQUEST_URI']) );
?>
