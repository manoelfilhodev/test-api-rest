<?php
class Recursos
{
    // Connection
    private $conn;
    // Table
    private $db_table = "recursos";
    // Columns
    public $id;
    public $recurso;
    public $saldoDisponivel;
    // Db connection
    public function __construct($db)
    {
        $this->conn = $db;
    }

    //Atualiza o saldo disponivel
    public function updateSaldoRecursos($id, $saldoAtual)
    {
        $sqlQuery = "UPDATE
                        " . $this->db_table . "
                    SET
                        saldo_disponivel = $saldoAtual
                    WHERE
                        id = $id";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute();
    }

    public function ObterSaldoAnteriorRec($id)
    {
        $sqlQuery = "SELECT
                        *
                      FROM
                        " . $this->db_table . "
                    WHERE
                       id = $id
                    LIMIT 0,1";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute();
        $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->id = $dataRow['id'];
        $this->recurso = $dataRow['recurso'];
        $this->saldo_disponivel = $dataRow['saldo_disponivel'];

    }

}
