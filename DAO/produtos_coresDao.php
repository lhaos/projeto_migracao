<?php
    require_once '../persistencia/conexaoBanco.php';

    class Produtos_coresDao{
        private $conexao = null;

        public function __construct(){
            $this->conexao = conexaoBanco::getInstancia();
        }

        public function __destruct(){
            $this->conexao = null;
        }

        public function cadastrarProdutoCor($pc){
            try{
                $stat = $this->conexao->prepare("insert into produtos_cores(id, id_cor, id_produto) values(?, ?, ?)");

                $stat->bindValue(1, $pc->id);
                $stat->bindValue(2, $pc->id_cor);
                $stat->bindValue(3, $pc->id_produto);

                $stat->execute();
            }catch (Exception $e){
                echo 'Erro ao cadastrar produtos com cores'.$e;
            }//fecha catch
        }//fecha cadastrarProdutoCor

        public function consultarIdPC($id_cor, $id_produto ){
            try{
                $stat = $this->conexao->prepare("select id from produtos_cores where id_cor = ? and id_produto = ?");
                $stat->bindValue(1, $id_cor);
                $stat->bindValue(2, $id_produto);

                $stat->execute();

                $retorno = $stat->fetch(PDO::FETCH_OBJ);

                return (isset($retorno->id) && $retorno->id > 0) ? $retorno->id : false;
            }catch (Exception $e){
                echo 'Erro ao consultar produto '.$e;
            }
        }//fecha consultarProdutosCores

        public function buscarUltimoId(){
            try{
                $stat = $this->conexao->prepare("select max(id) as maxid from produtos_cores");
                $stat->execute();
                $uid = $stat->fetch(PDO::FETCH_OBJ);

                return isset($uid->maxid) ? $uid->maxid : 0;

            }catch (Exception $e){
                echo 'Erro ao consultar id '.$e;
            }
        }//fecha buscarid

    }//fecha classe