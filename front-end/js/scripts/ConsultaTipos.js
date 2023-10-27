vm = new Vue({
    el: '#app',
    data: {
        tiposProdutos: [],
        loading: false
    },
    methods: {
        editar() {

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