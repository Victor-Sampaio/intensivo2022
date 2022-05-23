<?php

include('../../conexao/conn.php');

$requestData = $_REQUEST;

if(empty($requestData['LOGIN'])){
    $dados = array(
        "tipo" => 'error',
        "mensagem" =>'Exist(em) campo(s) obrigatorio(s) não preenchido(s)'
    );

}else{
    $ID = isset($requestData['ID']) ? $requestData['ID'] : '';
    $operacao = isset($requestData['operacao']) ? $requestData['operacao'] : '';

    //verificar se é para cadastrar um novo registro ou atulizar um registro existente

    if($operacao == "insert"){
        //prepara o comando insert para ser executado
            try{
                $stmt = $pdo->prepare('INSERT INTO ATENDENTE (NOME, LOGIN, SENHA) VALUES (:a, :b, :c)');
                $stmt->execute(array(
                    ':a' => utf8_decode($requestData['NOME']),
                    ':b' => utf8_decode($requestData['LOGIN']),
                    ':c' => md5($requestData['SENHA'])
                ));
                $dados = array(
                    "tipo" => 'success',
                    "mensagem" =>'Registro salvo com sucesso'
                );
            }catch(PDOException $e){
                $dados = array(
                    "tipo" => 'error',
                    "mensagem" =>'Erro ao tentar salvar o registro: ' .$e
                );
            }
    }else{
            try{
                $stmt = $pdo->prepare('UPDATE ATENDENTE SET NOME = :a, LOGIN = :b, SENHA = :c WHERE ID = :id');
                $stmt->execute(array(
                    'id' => $ID,
                    ':a' => utf8_decode($requestData['NOME']),
                    ':b' => utf8_decode($requestData['LOGIN']),
                    ':c' => md5($requestData['SENHA'])
                ));
                $dados = array(
                    "tipo" => 'success',
                    "mensagem" =>'Registro atualizado com sucesso'
                );
            }catch(PDOException $e){
                $dados = array(
                    "tipo" => 'error',
                    "mensagem" =>'Erro ao tentar salvar o registro: ' .$e
                );
            }
    }
}

echo json_encode($dados);






