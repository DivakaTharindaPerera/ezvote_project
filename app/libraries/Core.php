<?php

    //URL format : /controller/method/params
    session_start();
    class Core{

        protected $currentController = 'Pages';
        protected $currentMethod = 'index';
        protected $params = [];

        public function __construct(){
            date_default_timezone_set("Asia/Colombo");
            $url = $this->getURL();

            if(file_exists('../app/Controller/' . ucwords($url[0]) . '.php')){
                //if exists, set as controller
                $this->currentController = ucwords($url[0]);
                //unset 0 index
                unset($url[0]);
            }

            require_once '../app/Controller/' . $this->currentController . '.php';
            $this->currentController = new $this->currentController;

            if(isset($url[1])){
                if(method_exists($this->currentController, $url[1])){
                    $this->currentMethod = $url[1];
                    unset($url[1]);
                }
            }

            //get params

            $this->params = $url ? array_values($url) : [];
            call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
        }

        public function getURL(){
            if (isset($_GET['url'])){
                $url = rtrim($_GET['url'], '/');
                $url = filter_var($url, FILTER_SANITIZE_URL);
                $url = explode('/', $url);
                return $url;
            }
        }

    }