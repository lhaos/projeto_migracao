<?php
    require_once '../persistencia/conexaoBanco.php';

    class ProdutosDao{

        private $conexao = null;

        public function __construct(){
            $this->conexao = conexaoBanco::getInstancia();
        }

        public function __destruct(){
            $this->conexao = null;
        }

        public function cadastrarProduto($p){
            try{
                $stat = $this->conexao->prepare("insert into produtos(id, titulo, codigo) values(?, ?, ?)");

                $stat->bindValue(1, $p->id);
                $stat->bindValue(2, $p->titulo);
                $stat->bindValue(3, $p->codigo);

                $stat->execute();
            }catch (Exception $e){
                echo 'Erro ao cadastrar produto'.$e;
            }//fecha catch
        }//fecha cadastrarProduto

        public function consultarProduto($codigo){
            try{
                $stat = $this->conexao->prepare("select id from produtos where codigo=?");
                $stat->bindValue(1, $codigo);

                $stat->execute();

                $retorno = $stat->fetch(PDO::FETCH_OBJ);

                return (isset($retorno->id) && $retorno->id > 0) ? $retorno->id : false;
            }catch (Exception $e){
                echo 'Erro ao consultar produto'.$e;
            }
        }//fecha consultarProduto

        public function buscarUltimoId(){
            try{
                $stat = $this->conexao->prepare("select max(id) as maxid from produtos");
                $stat->execute();
                $uid = $stat->fetch(PDO::FETCH_OBJ);

                return isset($uid->maxid) ? $uid->maxid : 0;

            }catch (Exception $e){
                echo 'Erro ao consultar id de produto'.$e;
            }
        }//fecha buscarid

    }//fecha classe