<?php
    class app{

        protected $controller = "Home";
        protected $method = "index";
        protected $params;

        public function __construct()
        {
            $url = $this->parseURL();
            if (file_exists('../app/controllers/' . ucwords($url[0]) . '.php')) {
                // set a new controller
                $this->controller = ucwords($url[0]);
                unset($url[0]);
            }
            //show($url);
            //show($this->controller);
            // Require the controller
            require_once '../app/controllers/' . $this->controller . '.php';
            $this->controller = new $this->controller;

            //check for second part of the url
            if (isset($url[1])) {
                $url[1] = strtolower($url[1]);
                if(method_exists($this->controller, $url[1])) {
                    $this->method = $url[1];
                    unset($url[1]);
                }
            }
            $this->params = (count($url) > 0) ? $url : ["home"];
            call_user_func_array([$this->controller,$this->method],$this->params);
        }

        private function parseURL()
        {
            $url = isset($_GET['url']) ? $_GET['url'] : "home";
            return explode('/',filter_var(trim($url,'/'),FILTER_SANITIZE_URL));
            //return $url;
        }
    }