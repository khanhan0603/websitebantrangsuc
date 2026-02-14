<?php
//Class Router
class Router {
    protected $routers = [];
     public function getRoutes() {
        return $this->routers;
    }
    public function get($url, $action) {
        $this->routers['GET'][$url] = $action;
    }

    public function post($url, $action) {
        $this->routers['POST'][$url] = $action;
    }

    public function resolve($method, $uri) {
        if (isset($this->routers[$method][$uri])) {
            return $this->routers[$method][$uri];
        }
        return null;
    }
   
   public function xuLyPath($method,$url){
        $url = $url ?: '/';//nếu uri rỗng thì gán '/'
        // echo "File router web";
        // echo "<pre>";
        // print_r($this->getRoutes());
        // echo "</pre>";
        if(isset($this->routers[$method][$url])){
            $action=$this->routers[$method][$url];
            //echo $action;
            [$controller,$funcs]=explode('@',$action);
            
            //echo $controller;
            //require_once "./app/Controllers/".$controller.".php";//nạp file controller tương ứng
            require_once __DIR__ . '/../app/Controllers/' . $controller . '.php';

            $controllerFile = __DIR__ . '/../app/Controllers/' . $controller . '.php';

            // echo "<pre>";
            // echo "DIR: " . __DIR__ . "\n";
            // echo "Trying load: " . $controllerFile . "\n";
            // echo "</pre>";

            // if (!file_exists($controllerFile)) {
            //     die("FILE KHÔNG TỒN TẠI");
            // }

            $controllerObj=new $controller();
            $controllerObj->$funcs();
        }else{
            echo "404 ERROR";
        }
    }
     
}