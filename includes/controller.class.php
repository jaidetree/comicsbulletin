<?php
class Controller
{
    function route($action, $args)
    {
        call_user_func_array( array( $this, $action ), $args ); 
    }
}
?>
