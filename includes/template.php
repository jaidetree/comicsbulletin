<?php 
/**
 * Template functions for rendering our views.
 */
function render($file, $args=array())
{
    extract( $args );

    ob_start();
    $file = preg_replace('/(.*)\..*$/', '$1', $file);
    include ROOT . 'views/' . $file . ".php";
    $output = ob_get_contents();
    ob_end_clean();

    return $output;
}
function static_url()
{
    echo "/static/";
}
?>
