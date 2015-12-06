<?php
    require_once '../persistencia/conexaoBanco.php';

    class Produtos_tamanhosDao{
        private $conexao = null;

        public function __construct(){
            $this->conexao = conexaoBanco::getInstancia();
        }

        public function __destruct(){
            $this->conexao = null;
        }

        public function cadastrarProdutoTamanho($pt){
            try{
                $stat = $this->conexao->prepare("insert into produtos_tamanhos(id, id_produto_cor, id_tamanho) values(?, ?, ?)");

                $stat->bindValue(1, $pt->id);
                $stat->bindValue(2, $pt->id_produto_cor);
                $stat->bindValue(3, $pt->id_tamanho);

                $stat->execute();
            }catch (Exception $e){
                echo 'Erro ao cadastrar produtos com tamanhos '.$e;
            }//fecha catch
        }//fecha cadastrarProdutoTamanho

        public function consultarIdPT($id_produto_cor, $id_tamanho ){
            try{
                $stat = $this->conexao->prepare("select id from produtos_tamanhos where id_produto_cor = ? and id_tamanho = ?");
                $stat->bindValue(1, $id_produto_cor);
                $stat->bindValue(2, $id_tamanho);

                $stat->execute();

                $retorno = $stat->fetch(PDO::FETCH_OBJ);

                return (isset($retorno->id) && $retorno->id > 0) ? $retorno->id : false;
            }catch (Exception $e){
                echo 'Erro ao consultar produto '.$e;
            }
        }//fecha consultarTamanhos

        public function buscarUltimoId(){
            try{
                $stat = $this->conexao->prepare("select max(id) as maxid from produtos_tamanhos");
                $stat->execute();
                $uid = $stat->fetch(PDO::FETCH_OBJ);

                return isset($uid->maxid) ? $uid->maxid : 0;

            }catch (Exception $e){
                echo 'Erro ao consultar id '.$e;
            }
        }//fecha buscarid

    }//fecha classe