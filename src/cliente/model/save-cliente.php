<?php

include('../../conexao/conn.php');

$requestData = $_REQUEST;

if(empty($requestData['NOME'])){
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
                $stmt = $pdo->prepare('INSERT INTO CLIENTE (NOME, CPF, RG, CEP, NUMERO, LOGRADOURO, BAIRRO, CIDADE, UF, EMAIL, CELULAR) VALUES (:a, :b, :c, :d, :e, :f, :g, :h, :i, :j, :k)');
                $stmt->execute(array(
                    ':a' => utf8_decode($requestData['NOME']),
                    ':b' => md5($requestData['CPF']),
                    ':c' => md5($requestData['RG']),
                    ':d' => $requestData['CEP'],
                    ':e' => $requestData['NUMERO'],
                    ':f' => utf8_decode($requestData['LOGRADOURO']),
                    ':g' => utf8_decode($requestData['BAIRRO']),
                    ':h' => utf8_decode($requestData['CIDADE']),
                    ':i' => $requestData['UF'],
                    ':j' => $requestData['EMAIL'],
                    ':k' => $requestData['CELULAR']
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
                $stmt = $pdo->prepare('UPDATE CLIENTE SET NOME = :a, CPF = :b, RG = :c, CEP = :d, NUMERO = :e, LOGRADOURO = :f, BAIRRO = :g, CIDADE = :h, UF = :i, EMAIL = :j, CELULAR = :k WHERE ID = :id');
                $stmt->execute(array(
                    'id' => $ID,
                    ':a' => utf8_decode($requestData['NOME']),
                    ':b' => md5($requestData['CPF']),
                    ':c' => md5($requestData['RG']),
                    ':d' => $requestData['CEP'],
                    ':e' => $requestData['NUMERO'],
                    ':f' => utf8_decode($requestData['LOGRADOURO']),
                    ':g' => utf8_decode($requestData['BAIRRO']),
                    ':h' => utf8_decode($requestData['CIDADE']),
                    ':i' => utf8_decode($requestData['UF']),
                    ':j' => utf8_decode($requestData['EMAIL']),
                    ':k' => $requestData['CELULAR']
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



