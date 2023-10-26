<?php

class Tipos
{
    private $conn;
    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function cadastrar($dados)
    {
        if (!isset($this->conn)) {
            throw new PDOException("Falha na conexão");
        }

            $colunas = '';
            $valores = '';
            $parametros = [];

            foreach ($dados as $chave => $valor) {
                if($chave != "classe" && $chave != "funcao"){
                    $colunas .= $chave . ', ';
                    $valores .= ':' . $chave . ', ';
                    $parametros[':' . $chave] = $valor;
                }
            
            }
            $colunas = rtrim($colunas, ', ');
            $valores = rtrim($valores, ', ');

            $parametros_verificacao = [
                ':nome_tipo_produto' => $dados['nome_tipo_produto']
            ];

            $busca = $this->conn->prepare("
                SELECT * FROM tipos_produtos
                WHERE nome_tipo_produto = :nome_tipo_produto
            ");

            foreach ($parametros_verificacao as $chave => &$valor) {
                $busca->bindParam($chave, $valor);
            }
            try {
                $busca->execute();
            } catch (PDOException $e) {
                throw new PDOException("Erro ao Consultar o Tipo de Produto: " . $e->getMessage());
            }

            if ($busca->rowCount() > 0) {
                throw new PDOException("Tipo já Cadastrado!");
            }

            $query = $this->conn->prepare("
                    INSERT INTO tipos_produtos ($colunas, status_tipo_produto) 
                    VALUES ($valores, 1)");

            foreach ($parametros as $chave => &$valor) {
                $query->bindParam($chave, $valor);
            }

            try {
                $query->execute();
            } catch (PDOException $e) {
                throw new PDOException("Erro ao Consultar o Tipo de Produto: " . $e->getMessage());
            }

            
            $response = array(
                "status" => 1,
                "message" => "Salvo com Sucesso!"
            );

            return $response;
    }
 
}
