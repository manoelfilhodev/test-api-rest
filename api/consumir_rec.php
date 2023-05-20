<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/database.php';
include_once '../class/Clubes.php';
include_once '../class/Recursos.php';

$database = new Database();
$db = $database->getConnection();

$item = new Clubes($db);
$item2 = new Recursos($db);

$data = json_decode(file_get_contents("php://input"));

$clubeId = $data->clube_id;
$recursoId = $data->recurso_id;

$item->ObterSaldoAnterior($clubeId);
$item2->ObterSaldoAnteriorRec($recursoId);

if ($item->id != null) {

    if ($item2->id != null) {

        $emp_arr = array(
            "id" => $item->id,
            "clube" => $item->clube,
            "saldo_disponivel" => $item->saldo_disponivel,
        );

        $emp_arr2 = array(
            "id" => $item2->id,
            "recurso" => $item2->recurso,
            "saldo_disponivel" => $item2->saldo_disponivel,
        );

        $clubeNome = $emp_arr['clube'];
        $saldoAnterior = $emp_arr['saldo_disponivel'];
        $saldoAnteriorInt = $saldoAnterior;

        $recursoNome = $emp_arr2['recurso'];
        $saldoAnteriorRec = $emp_arr2['saldo_disponivel'];
        $saldoAnteriorIntRec = $saldoAnteriorRec;

        $vlrConsumo = str_replace(",", ".", $data->valor_consumo);

        $saldoAtual = $saldoAnteriorInt - $vlrConsumo;
        $saldoAtualStr = $saldoAtual;

        $saldoAtualRec = $saldoAnteriorIntRec - $vlrConsumo;
        $saldoAtualStrRec = $saldoAtualRec;

        if ($saldoAtual > 0) {
            if ($saldoAtualRec > 0) {

                $item->updateSaldoClubes($clubeId, $saldoAtualStr);
                $item2->updateSaldoRecursos($recursoId, $saldoAtualStrRec);

                $emp_arr = array(
                    "clube" => $clubeNome,
                    "saldo_anterior" => $item->ConvertNum($saldoAnterior),
                    "saldo_atual" => $item->ConvertNum($saldoAtual),
                );
                http_response_code(200);
                echo json_encode($emp_arr);
            } else {
                http_response_code(400);
                echo "O saldo disponível do Recurso é insuficiente.";
            }
        } else {
            http_response_code(400);
            echo "O saldo disponível do Clube é insuficiente.";
        }

    } else {
        http_response_code(400);
        echo "Código Recurso Inexistente! Favor informe um ID válido.";
    }
} else {
    http_response_code(400);
    echo "Código Clube Inexistente! Favor informe um ID válido.";
}
