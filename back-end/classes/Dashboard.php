<?php
class Dashboard
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function buscaVendasMesAMes()
    {
        if (!isset($this->conn)) {
            throw new PDOException("Falha na conexão");
        }

        $query = $this->conn->prepare("
            SELECT MONTH(datetime_venda) as mes, SUM(valor_total_venda) as total
            FROM vendas
            WHERE YEAR(datetime_venda) = YEAR(NOW())
            GROUP BY mes
        ");

        try {
            $query->execute();
        } catch (PDOException $e) {
            throw new PDOException("Erro ao buscar as vendas mês a mês: " . $e->getMessage());
        }

        $dadosVendasMesAMes = $query->fetchAll(PDO::FETCH_ASSOC);

        return json_encode($dadosVendasMesAMes);
    }


    public function buscaTotalVendasMes()
    {
        if (!isset($this->conn)) {
            throw new PDOException("Falha na conexão");
        }

        $query = $this->conn->prepare("SELECT SUM(valor_total_venda) as total FROM vendas WHERE MONTH(datetime_venda) = MONTH(NOW())");
        try {
            $query->execute();
        } catch (PDOException $e) {
            throw new PDOException("Erro ao buscar o total de vendas do mês: " . $e->getMessage());
        }

        $result = $query->fetch(PDO::FETCH_ASSOC);
        if($result['total'] == 0){
            $retorno = "0,00";
        }
        else{
            $retorno = number_format($result['total'], 2, ',', '.');;
        }
        return $retorno;
    }

    public function buscaTotalVendasUltimos7Dias()
    {
        if (!isset($this->conn)) {
            throw new PDOException("Falha na conexão");
        }

        $query = $this->conn->prepare("SELECT SUM(valor_total_venda) as total FROM vendas WHERE datetime_venda >= DATE_SUB(NOW(), INTERVAL 7 DAY)");
        try {
            $query->execute();
        } catch (PDOException $e) {
            throw new PDOException("Erro ao buscar o total de vendas dos últimos 7 dias: " . $e->getMessage());
        }

        $result = $query->fetch(PDO::FETCH_ASSOC);
        if($result['total'] == 0){
            $retorno = "0,00";
        }
        else{
            $retorno = number_format($result['total'], 2, ',', '.');;
        }
        return $retorno;
    }

    public function buscaTotalVendasHoje()
    {
        if (!isset($this->conn)) {
            throw new PDOException("Falha na conexão");
        }

        $query = $this->conn->prepare("SELECT SUM(valor_total_venda) as total FROM vendas WHERE DATE(datetime_venda) = CURDATE()");
        try {
            $query->execute();
        } catch (PDOException $e) {
            throw new PDOException("Erro ao buscar o total de vendas de hoje: " . $e->getMessage());
        }

        $result = $query->fetch(PDO::FETCH_ASSOC);
        if($result['total'] == 0){
            $retorno = "0,00";
        }
        else{
            $retorno = number_format($result['total'], 2, ',', '.');;
        }
        return $retorno;
    }
}

?>
