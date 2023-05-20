<?php
class Clubes
{
    // Connection
    private $conn;
    // Table
    private $db_table = "clubes";
    // Columns
    public $id;
    public $clube;
    public $saldoDisponivel;
    // Db connection
    public function __construct($db)
    {
        $this->conn = $db;
    }
    // GET ALL
    public function getClubes()
    {
        $sqlQuery = "SELECT * FROM " . $this->db_table . "";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute();
        return $stmt;
    }
    // CREATE
    public function createClubes()
    {
        $sqlQuery = "INSERT INTO
                        " . $this->db_table . "
                    SET
                        clube = :clube,
                        saldo_disponivel = :saldo_disponivel
                        ";

        $stmt = $this->conn->prepare($sqlQuery);

        // sanitize
        $this->clube = htmlspecialchars(strip_tags($this->clube));
        $this->saldo_disponivel = htmlspecialchars(strip_tags($this->saldo_disponivel));

        // bind data
        $stmt->bindParam(":clube", $this->clube);
        $stmt->bindParam(":saldo_disponivel", $this->saldo_disponivel);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    //
    public function ObterSaldoAnterior($id)
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
        $this->clube = $dataRow['clube'];
        $this->saldo_disponivel = $dataRow['saldo_disponivel'];

    }

    //Atualiza o saldo disponivel
    public function updateSaldoClubes($id, $saldoAtual)
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
    public function ConvertNum($num)
    {
        return number_format($num, "2", ",", "");
    }

}
