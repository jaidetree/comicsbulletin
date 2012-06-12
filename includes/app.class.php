<?php
/**
 * This class is our main app. Holds our settings, data, and acces
 * to some global utilities.
 */
class APP
{
    static $data = array();
    static $urls = array();
    static $controllers = array();

    public static $db;

    public static function cfg($section, $key)
    {
        return self::$data[$section][$key];
    }

    public static function init()
    {
        include ROOT . "config.php";
        self::$data = $config;
        include ROOT . "routes.php";
        self::$urls = $routes;

    }

    public static function load_route($url)
    {
        foreach( self::$urls as $route )
        {
            if( preg_match( '#' . $route[0] . '#', $url, $args ) )
            {
                array_shift($args);

                $data = explode(".", $route[1]);

                $controller = $data[0];
                $action = $data[1];

                self::call_action( $controller, $action, $args ); 
            }
        }
    }

    public static function add_controller( $object )
    {
        $name = strtolower( get_class($object ) );
        self::$controllers[ $name ] = &$object;
    }

    /**
     * Grab the controller from our controllers array.
     */
    public static function controller( $controller_name )
    {
        return self::$controllers[ $controller_name ];
    }


    /**
     * Call the method on the controller.
     */
    public static function call_action( $controller_name, $action, $args )
    {
        $controller = self::controller( $controller_name );
        $controller->route( $action, $args );
    }

    /**
     * Reverse a URL by it's controller/view
     */
    public static function url($path, $args=array())
    {
        foreach( self::$urls as $route )
        {
            if( $route[1] == $path )
            {
                $url = $route[0];
                $url = preg_replace("/\(.*\)/", "%s", $url);
                $url = preg_replace('/[\[\]^\$]/', "", $url);

                if( ( is_array($args) && sizeof($args) > 0 ) || is_numeric($args) )
                {
                    $url = vsprintf( $url, $args );
                }

                $url = preg_replace('/\/$/', '', $url) . '/';

                return 'http://' . $_SERVER['HTTP_HOST'] . $url;

            }
        }
    }

}
APP::init();
?>
