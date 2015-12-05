<?php
    /**try{
        $conexao = new \PDO("mysql:host=localhost;dbname=teste_selecao", "root", "root");
    }catch (\PDOException $e){
        die("Erro código ".$e->getCode().": ".$e->getMessage());
    }//fecha catch

$sql = "Select * from dados_antigos";
$stmt = $conexao->prepare($sql);
$stmt->execute();
$produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach($produtos as $produto){
    echo $produto['codigo']." - ".$produto['titulo']." - ".$produto['cor']." - ".$produto['tamanho']."<br>";
}//fecha foreach**/

class ConexaoBanco extends PDO{

    private static $instancia=null;

    public function ConexaoBanco($dsn,$usuario,$senha){
        //Construtor da classe pai PDO
        parent::__construct($dsn,$usuario,$senha);
    }

    public static function getInstancia(){
        if(!isset(self::$instancia)){
            try{
                /* Cria e retorna uma nova conexão*/

                self::$instancia = new ConexaoBanco("mysql:dbname=teste_selecao;host=localhost","root","root");

            }catch(Exception $e){
                echo 'Erro ao conectar';
                exit();
            }//fecha catch
        }//fecha if
        return self::$instancia;
    }//fecha método
}//fecha classe
