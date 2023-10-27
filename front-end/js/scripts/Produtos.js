vm = new Vue({
    el: '#app',
    data: {
        nome_produto: '',
        tipo_produto: '',
        preco_venda_produto: '',
        preco_custo_produto: '',
        categorias: [],
    },
    mounted() {

        var classe = "Produtos";
        var funcao = "listarCategorias";

        $.ajax({
            type: 'POST',
            url: urlBackEnd + "index.php",
            data: { classe: classe, funcao: funcao, nome_tipo_produto: this.nome_tipo_produto, imposto_tipo_produto: this.imposto_tipo_produto },
            success: data => {
                this.categorias = data;
            },
            error: error => {
                console.error('Erro ao buscar categorias: ' + error);
            },
        });
    },
    methods: {

        cadastrar() {
            this.preco_venda_produto = $("#preco_venda_produto").val();
            this.preco_custo_produto = $("#preco_custo_produto").val();
            if (this.nome_produto == "" || this.tipo_produto == "" || this.preco_venda_produto == "" || this.preco_custo_produto == "") {
                alerta("warning", "Atenção", "Preencha todos os Campos!", "", 0);
                return false
            } else {
                var classe = "Produtos";
                var funcao = "cadastrar";

                jQuery.ajax({
                    type: "POST",
                    url: urlBackEnd + "index.php",
                    data: {
                        classe: classe,
                        funcao: funcao,
                        nome_produto: this.nome_produto,
                        tipo_produto: this.tipo_produto,
                        preco_venda_produto: this.preco_venda_produto,
                        preco_custo_produto: this.preco_custo_produto
                    },
                    success: function(data) {
                        if (data.status == 1) {
                            alerta("success", "Sucesso!", data.body, "", 1);
                        } else {
                            alerta("error", "Atenção!", data.body, "", 0);
                        }

                        return false;
                    }
                });

                return false;
            }

        },

    }
});