<?php
    class Produtos{
        private $id;
        private $titulo;
        private $codigo;

        public function __construct(){}

        public function __destruct(){
            unset($this->id);
            unset($this->titulo);
            unset($this->codigo);
            unset($this);
        }

        public function __get($a){
            return $this->$a;
        }

        public  function __set($a, $v){
            $this->$a = $v;
        }

    }//fecha classe