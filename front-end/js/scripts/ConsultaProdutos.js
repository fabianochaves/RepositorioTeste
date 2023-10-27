vm = new Vue({
    el: '#app',
    data: {
        Produtos: [],
        loading: false,
        tipoOptions: [],
    },
    methods: {
        abrirModalEdicao(produto) {
            Swal.fire({
                title: 'Editar Produto',

                html: `
                <div>
                    <div style="display: flex; flex-direction: column;">
                        <label for="nome_produto" style="margin-bottom: -20px;">Nome:</label>
                        <input id="nome_produto" class="swal2-input" value="${produto.nome_produto}" placeholder="Nome do Produto">
                        <br>
                        <label for="tipo_produto" style="margin-bottom: -20px;">Tipo:</label>
                        <select id="tipo_produto" class="swal2-select">
                            ${tipoOptions}
                        </select>
                        <br>
                        <label for="preco_venda_produto" style="margin-bottom: -20px;">Preço de Venda:</label>
                        <input id="preco_venda_produto" class="swal2-input valorDecimal" value="${produto.preco_venda_produto}" placeholder="Preço de Venda">
                        <br>
                        <label for="preco_custo_produto" style="margin-bottom: -20px;">Preço de Custo:</label>
                        <input id="preco_custo_produto" class="swal2-input valorDecimal" value="${produto.preco_custo_produto}" placeholder="Preço de Custo">
                    </div>
                    <input type="hidden" id="id_produto" value="${produto.id_produto}">
                </div>
                `,

                showCancelButton: true,
                confirmButtonText: 'Salvar',
                cancelButtonText: 'Cancelar',
                didOpen: () => {

                    $('.valorDecimal').maskMoney({
                        prefix: '',
                        suffix: '',
                        allowZero: true,
                        decimal: ',',
                        thousands: '.',
                        precision: 2
                    });

                },
                preConfirm: () => {
                    const nome_produto = Swal.getPopup().querySelector('#nome_produto').value;
                    const tipo_produto = Swal.getPopup().querySelector('#tipo_produto').value;
                    const preco_venda_produto = Swal.getPopup().querySelector('#preco_venda_produto').value;
                    const preco_custo_produto = Swal.getPopup().querySelector('#preco_custo_produto').value;
                    const id_produto = Swal.getPopup().querySelector('#id_produto').value;

                    this.salvarAlteracoes(tipo_produto, nome_produto, preco_venda_produto, preco_custo_produto, id_produto);
                }
            });
        },

        salvarAlteracoes(tipo_produto, nome_produto, preco_venda_produto, preco_custo_produto, id_produto) {
            var classe = "Tipos";
            var funcao = "editarTipo";


            jQuery.ajax({
                type: "POST",
                url: urlBackEnd + "index.php",
                data: { classe: classe, funcao: funcao, id_tipo_produto: idTipoProduto, novo_nome: novoNome, novo_imposto: novoImposto },
                success: function(response) {

                    if (response.status === 1) {
                        Swal.fire('Sucesso', 'As alterações foram salvas com sucesso!', 'success');
                        vm.listar()
                    } else {
                        Swal.fire('Erro', 'Ocorreu um erro ao salvar as alterações.', 'error');
                    }
                },
                error: function(error) {
                    console.error("Erro ao editar tipo: " + error);
                    Swal.fire('Erro', 'Ocorreu um erro ao salvar as alterações.', 'error');
                }
            });
        },
        listar() {
            var classe = "Produtos";
            var funcao = "listarProdutos";
            var parametros = {
                is_ativo: ""
            };

            jQuery.ajax({
                type: "POST",
                url: urlBackEnd + "index.php",
                data: { classe: classe, funcao: funcao, is_ativo: parametros },
                success: function(data) {

                    data.forEach(function(produto) {
                        produto.status_produto = produto.status_produto === 1 ? "Ativo" : "Inativo";
                        produto.status_css = produto.status_produto === "Ativo" ? "ativo" : "inativo";
                    });

                    vm.Produtos = data;
                    setTimeout(() => {
                        $('#dataTable').DataTable();

                    }, 500);
                }
            });
        },
        status(produto) {
            let novoStatus = produto.status_produto === "Ativo" ? "Inativo" : "Ativo";
            let acao = produto.status_produto === "Ativo" ? "inativar" : "ativar";

            Swal.fire({
                title: 'Tem certeza?',
                text: `Esta ação irá ${acao} o registro. Deseja continuar?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: `Sim, ${acao}`,
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.processarAlteracaoStatus(produto, novoStatus);
                }
            });
        },
        processarAlteracaoStatus(produto, novo_status) {
            const id_produto = produto.id_produto;
            const classe = "Produtos";
            const funcao = "alterarStatus";

            const data = {
                classe: classe,
                funcao: funcao,
                id_produto: id_produto,
                novo_status: novo_status
            };

            this.loading = true;

            jQuery.ajax({
                type: "POST",
                url: urlBackEnd + "index.php",
                data: data,
                success: () => {
                    this.listar();
                    this.loading = false;
                },
                error: (error) => {
                    console.error("Erro ao alterar status: " + error);
                    this.loading = false;
                }
            });
        }


    },

    mounted() {
        this.listar();
    }
});