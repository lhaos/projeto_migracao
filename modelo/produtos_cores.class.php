<?php
    class Pc{
        private $id;
        private $id_cor;
        private $id_produto;

        public function __construct(){}

        public function __destruct(){
            unset($this->id);
            unset($this->id_cor);
            unset($this->id_produto);
            unset($this);
        }

        public function __get($a){
            return $this->$a;
        }

        public function __set($a, $v){
            $this->$a = $v;
        }

    }//fecha classe