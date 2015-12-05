<?php
    class Cores{
        private $titulo;
        private $id;

        public function __construct(){}

        public function __destruct(){
            unset($this->titulo);
            unset($this->id);
            unset($this);
        }

        public function __get($a){
            return $this->$a;
        }

        public function __set($a, $v){
            $this->$a = $v;
        }

    }//fecha classe