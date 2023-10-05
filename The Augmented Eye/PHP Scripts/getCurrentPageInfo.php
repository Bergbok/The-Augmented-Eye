<?php
    function getCurrentPageInfo($value){
        //If called from within a function, the return() statement immediately ends execution of the current function, thus break; isn't needed.
        switch ($value) {
            case "uri": // Outputs: URI
                $uri = $_SERVER['REQUEST_URI'] ?? NULL;
                return urldecode($uri); 
            case "url": // Outputs: Full URL
                //busted with Live Preview
                $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
                $url = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] ?? NULL;
                return urldecode($url); 
            case "page": //Outputs current page identifier
                $uri = $_SERVER['REQUEST_URI'] ?? NULL;
                // can maybe remove rtrim
                return urldecode(rtrim(substr($uri, strrpos($uri, '/') + 1),"<br>"));
            case "query-string": // Outputs: Query String
                $query = $_SERVER['QUERY_STRING'] ?? NULL;
                return urldecode($query); 
            default:
                return "Error: please enter one of the accepted values (uri / url / query-string)";
        }
    }
?>