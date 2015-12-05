<?php
    try{
        $conexao = new \PDO("mysql:host=localhost;dbname=teste_selecao", "root", "root");
    }catch (\PDOException $e){
        die("Erro código ".$e->getCode().": ".$e->getMessage());
    }//fecha catch

$sql = "Select * from dados_antigos";
$stmt = $conexao->prepare($sql);
$stmt->execute();
$res = $stmt->fetchAll(PDO::FETCH_ASSOC);

print_r($res);
