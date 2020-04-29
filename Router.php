<?php
namespace RouterApplication;
class Router {

    private static $nomatch = true;

    private static function getUrl() {
        return $_SERVER['REQUEST_URI'];
    }

    private static function getMatches( $pattern ) {
        $url = self::getUrl();
        // echo preg_match("~^/?$~","/mehedi/router/",$matches);
        if ( preg_match( $pattern, $url, $matches ) ) {
            return $matches;
        } else {
            return false;
        }
    }

    private static function process($pattern, $callback){
        $pattern = "~^{$pattern}/?$~";
        $params = self::getMatches( $pattern );
        if ( $params ) {
            self::$nomatch = false;
            $functionArguments = array_slice( $params, 1 );

            if ( is_callable( $callback ) ) {
                if(is_array($callback)){
                    $className = "RouterApplication\Controller\\".$callback[0];
                    $methodName = $callback[1];
                    $instance = $className::getInstance();
                    $instance->$methodName(...$functionArguments);
                }
                else{
                    $callback( ...$functionArguments );
                }
            }
            else{
                $callback = explode("@",$callback);
                $className = "RouterApplication\Controller\\".$callback[0];
                $methodName = $callback[1];
                $instance = $className::getInstance();
                $instance->$methodName(...$functionArguments);
            }
        }
    }

    public static function get( $pattern, $callback ) {
        
        if($_SERVER['REQUEST_METHOD'] != 'GET'){
            return;
        }
        self::process($pattern,$callback);
        
    }

    public static function post( $pattern, $callback ) {
        
        if($_SERVER['REQUEST_METHOD'] != 'POST'){
            return;
        }
        self::process($pattern,$callback);
        
    }

    public static function delete( $pattern, $callback ) {
        
        if($_SERVER['REQUEST_METHOD'] != 'DELETE'){
            return;
        }
        self::process($pattern,$callback);
        
    }

    static function notfound() {
        if ( self::$nomatch ) {
            echo "<h1>Not Found</h1><p>The requested URL /mehedi/router/hello was not found on this server.</p>";
        }
    }
}

?>