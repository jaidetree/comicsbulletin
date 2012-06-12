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
        echo "<pre>";
        echo "<h1>ERRORS:</h1>";
        print_r( self::$errors );
        echo "</pre>";
    }
}
$error = new ERROR();
?>
