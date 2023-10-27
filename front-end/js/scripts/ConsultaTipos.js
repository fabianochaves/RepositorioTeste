vm = new Vue({
    el: '#app',
    data: {
        tiposProdutos: [],
        loading: false
    },
    methods: {
        abrirModalEdicao(tipo) {
            Swal.fire({
                title: 'Editar Tipo de Produto',
                html: `
                    <input id="nome" class="swal2-input" value="${tipo.nome_tipo_produto}" placeholder="Nome do Tipo">
                    <input id="imposto" class="swal2-input percentual" value="${tipo.imposto_tipo_produto}" placeholder="Imposto">
                    <input type="hidden" id="id_tipo_produto" value="${tipo.id_tipo_produto}">
                `,
                showCancelButton: true,
                confirmButtonText: 'Salvar',
                cancelButtonText: 'Cancelar',
                didOpen: () => {
                    // Aplicar a máscara de percentual ao campo "percentual"
                    $('#imposto').maskMoney({
                        prefix: '',
                        suffix: '',
                        allowZero: true,
                        decimal: ',',
                        precision: 2
                    });

                    // Adicionar validação ao campo "percentual" (se necessário)
                    $('#imposto').on('blur', function() {
                        let valor = parseFloat($(this).maskMoney('unmasked')[0]);

                        if (valor < 0) {
                            valor = 0;
                        } else if (valor > 100) {
                            valor = 100;
                        }

                        $(this).maskMoney({ allowZero: true }).maskMoney('mask', valor);
                    });
                },
                preConfirm: () => {
                    const novoNome = Swal.getPopup().querySelector('#nome').value;
                    const novoImposto = Swal.getPopup().querySelector('#imposto').value;
                    const idTipoProduto = Swal.getPopup().querySelector('#id_tipo_produto').value;

                    // Chame a função para salvar as alterações no backend
                    this.salvarAlteracoes(idTipoProduto, novoNome, novoImposto);
                }
            });
        },

        salvarAlteracoes(idTipoProduto, novoNome, novoImposto) {
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
            var classe = "Tipos";
            var funcao = "listar";

            jQuery.ajax({
                type: "POST",
                url: urlBackEnd + "index.php",
                data: { classe: classe, funcao: funcao },
                success: function(data) {

                    data.forEach(function(tipo) {
                        tipo.status_tipo_produto = tipo.status_tipo_produto === 1 ? "Ativo" : "Inativo";
                        tipo.status_css = tipo.status_tipo_produto === "Ativo" ? "ativo" : "inativo";
                    });

                    vm.tiposProdutos = data;
                    setTimeout(() => {
                        $('#dataTable').DataTable();

                    }, 500);
                }
            });
        },
        status(tipo) {
            let novoStatus = tipo.status_tipo_produto === "Ativo" ? "Inativo" : "Ativo";
            let acao = tipo.status_tipo_produto === "Ativo" ? "inativar" : "ativar";

            Swal.fire({
                title: 'Tem certeza?',
                text: `Esta ação irá ${acao} o registro. Deseja continuar?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: `Sim, ${acao}`,
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.processarAlteracaoStatus(tipo, novoStatus);
                }
            });
        },
        processarAlteracaoStatus(tipo, novo_status) {
            const id_tipo_produto = tipo.id_tipo_produto;
            const classe = "Tipos";
            const funcao = "alterarStatus";

            const data = {
                classe: classe,
                funcao: funcao,
                id_tipo_produto: id_tipo_produto,
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