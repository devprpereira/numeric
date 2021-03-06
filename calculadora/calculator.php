<?php 
/**
 * @author: Paulo Roberto
 * @version: 1.0.0
 * @copyright: Copyright (c) 2002, Paulo Roberto (github.com/prpereira31)
 * @since: 05/06/2021
 */

header('Content-Type: application/json; charset: utf-8');
$retorno = array();
$n1 = filter_input(INPUT_POST, 'n1', FILTER_SANITIZE_NUMBER_FLOAT);
$n2 = filter_input(INPUT_POST, 'n2', FILTER_SANITIZE_NUMBER_FLOAT);
$retorno['n1'] = $n1;

if( $n1  == false || $n2 == false ) {
    header('HTTP/1.1 400 Parametro Invalido');
    if($n1 == false){
        $retorno['status'] = "ERRO";
        $retorno['codigo'] = "1001";
        $retorno['mensagem'] = 'Para realizar o cálculo é preciso enviar valores numéricos no campo Primeiro Número.';
        echo json_encode($retorno);
        exit;
    };

    if($n2 == false){
        $retorno['status'] = "ERRO";
        $retorno['codigo'] = "1002";
        $retorno['mensagem'] = 'Para realizar o cálculo é preciso enviar valores numéricos no campo Segundo Número.';
        echo json_encode($retorno);
        exit;
    };
};

$retorno['status'] = "SUCESSO";
$retorno['operacoes'] = array(
    'Soma' => $n1 + $n2,
    'Subtração (' . $n1 . ' - ' . $n2 . ')' => bcsub( $n2 , $n1, 3),
    'Subtração (' . $n2 . ' - ' . $n1 . ')' => bcsub( $n1 , $n2, 3),
    'Multiplicação' => number_format($n2 * $n1,0,null,'.'),
    'Divisão   (' . $n1 . ' / ' . $n2 . ')' => bcdiv($n1,$n2,4),
    'Diferença (' . $n1 . ' / ' . $n2 . ') em %' => (bcdiv($n1,$n2,4) -1) * 100 . '%',
    'Divisão (' . $n2 . ' / ' . $n1 . ')' => bcdiv($n2,$n1,4),
    'Diferença (' . $n2 . ' / ' . $n1 . ') em %' =>  (bcdiv($n2,$n1,4) -1) * 100 . '%',
);
echo json_encode($retorno);
?>