<?php

    include('../../conexao/conn.php');

    $ID = $_REQUEST['ID'];

    $sql = "SELECT * FROM ATENDENTE WHERE ID = $ID";

    $resultado = $pdo->query($sql);

    if($resultado){
        $result = array();
        while($row = $resultado->fetch(PDO::FETCH_ASSOC)){
            $result = array_map('utf8_encode', $row);
        }
        $dados = array(
            'tipo' => 'success',
            'mensagem' => '',
            'dados' => $result
        );
    } else {
        $dados = array(
            'tipo' => 'error',
            'mensagem' => 'Não foi possível obter o registro solicitado.',
            'dados' => array()
        );
    }

    echo json_encode($dados);