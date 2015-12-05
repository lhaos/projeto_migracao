<?php
    class Dados_antigos{
        private $codigo;
        private $titulo;
        private $cor;
        private $tamanho;

        public function __construct(){}

        public function __destruct(){
            unset($this->codigo);
            unset($this->cor);
            unset($this->tamanho);
            unset($this->titulo);
            unset($this);
        }

        public function __get($a){
            return $this->$a;
        }

        public function __set($a, $v){
            $this->$a = $v;
        }

    }//fecha classe