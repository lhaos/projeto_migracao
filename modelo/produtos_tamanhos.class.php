<?php
    class Pt{
        private $id;
        private $id_tamanho;
        private $id_produto_cor;

        public function __construct(){}

        public function __destruct(){
            unset($this->id);
            unset($this->id_tamanho);
            unset($this->id_produto_cor);
            unset($this);
        }

        public function __get($a){
            return $this->$a;
        }

        public function __set($a, $v){
            $this->$a = $v;
        }

    }//fecha classe