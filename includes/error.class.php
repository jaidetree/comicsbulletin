<?php
class ERROR
{
    static $errors = array();

    public static function add($data)
    {
        self::$errors[] = $data;
    }

    public function __destruct()
    {
        ERROR::display_errors();
    }

    public static function display_errors()
    {
        if( ! self::has_errors() )
        {
            return;
        }
        echo "<pre>";
        echo "<h1>ERRORS:</h1>";
        print_r( self::$errors );
        echo "</pre>";
    }

    public static function has_errors()
    {
        if( count(self::$errors) > 0 )
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}
$error = new ERROR();
?>
