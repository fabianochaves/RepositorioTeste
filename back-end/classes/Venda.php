<?php
require_once 'Produtos.php';
class Venda
{
    private $conn;
    public function __construct($conn)
    {
        $this->conn = $conn;
    }
    
    public function carregarDadosVenda()
    {
        if (!isset($this->conn)) {
            throw new PDOException("Falha na conexão");
        }
    
        $produtosClass = new Produtos($this->conn); // Crie uma instância da classe Produtos
        $produtos = $produtosClass->listarProdutos(); // Chama a função listarProdutos da classe Produtos para obter a lista de produtos.
       

        $form = '<div class="form-row">';
        $form .= '<div class="col-md-6 offset-md-3">';
        $form .= '<label for="produto">Selecione um produto:</label>';
        $form .= '<select class="form-control" id="produto" name="produto">';
        $form .= '<option value="">Escolha...</option>';
        
        foreach ($produtos as $produto) {
            $form .= '<option value="' . $produto['id_produto'] . '">' . $produto['nome_produto'] . '</option>';
        }
        
        $form .= '</select>';
        $form .= '<div class="col-md-12">';
        $form .= '</br>';

        $form .= '<label for="quantidade">Quantidade:</label>';
        $form .= '<input type="number" class="form-control inputs_novo_item" id="quantidade" name="quantidade" min="1" required>';
        $form .= '</div>';
        $form .= '<div class="col-md-12">';
        $form .= '</br>';

        $form .= '<label for="quantidade">Preço Unitário (R$):</label>';
        $form .= '<input readonly type="text" class="form-control inputs_novo_item" id="valor_unitario" name="valor_unitario">';
        $form .= '</div>';
        $form .= '<div class="col-md-12">';
        $form .= '</br>';

        $form .= '<label for="quantidade">% Imposto:</label>';
        $form .= '<input readonly type="text" class="form-control inputs_novo_item" id="percent_imposto" name="percent_imposto">';
        $form .= '</div>';
        $form .= '<div class="col-md-12">';
        $form .= '</br>';

        $form .= '<label for="quantidade">Valor Imposto (R$):</label>';
        $form .= '<input readonly type="text" class="form-control inputs_novo_item" id="valor_imposto" name="valor_imposto">';
        $form .= '</div>';
        $form .= '</br>';

        $form .= '<label for="quantidade">Valor Total do Produto (R$):</label>';
        $form .= '<input readonly type="text" class="form-control inputs_novo_item" id="valor_total_produto" name="valor_total_produto">';
        $form .= '</div>';
        $form .= '</div>';
        
        return $form;
    }


    
}
