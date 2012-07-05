<?php 
/**
 * General Functions File
 */
function slugify($str)
{
    $str = preg_replace( '/-/', ' ', $str );
    $str = preg_replace( '/\s\s+/', ' ', $str );
    preg_match_all('/([\s_a-z0-9]+)/', strtolower($str), $chars);
    $str = implode( '', $chars[1] );
    $str = str_replace(' ', '-', $str);
    return $str;
}

function is_page($controller)
{
   $test_url = APP::url($controller);
   $url = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

   if( $url == $test_url )
   {
       echo "active ";
   }
}
?>
