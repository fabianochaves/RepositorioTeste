// Call the dataTables jQuery plugin
$(document).ready(function() {
    $('#tabela_itens_venda').DataTable();
});

vm = new Vue({
    el: '#app',
    data: {
        itens: []
    },
    methods: {

        adicionarItem() {
            const selectedProduto = $('#produto').val();
            const quantidade = $('#quantidade').val();

            // Aqui, você pode criar um objeto que representa o novo item
            const novoItem = {
                produto: selectedProduto,
                quantidade: quantidade,
                // Adicione outros campos conforme necessário
            };

            // Adicione o novo item à matriz de itens
            this.itens.push(novoItem);
            $('#tabela_itens_venda').DataTable().destroy();

            // Feche o SweetAlert
            Swal.close();
            $('#tabela_itens_venda').DataTable();
        },

        async abrirNovoItem() {
            try {
                jQuery.ajax({
                    type: "POST",
                    url: urlBackEnd + "index.php",
                    data: { classe: "Venda", funcao: "carregarDadosVenda" },
                    success: function(data) {
                        Swal.fire({
                            title: 'Adicionar Item',
                            html: data,
                            width: '800px',
                            showCancelButton: true,
                            confirmButtonText: 'Confirmar',
                            cancelButtonText: 'Cancelar',
                            didOpen: () => {

                                $('#produto').on('change', function() {
                                    vm.changeProduto($(this).val());
                                });
                                $('#quantidade').on('change blur', function() {
                                    vm.changeProduto($('#produto').val());
                                });
                            },
                        }).then((result) => {
                            if (result.isConfirmed) {
                                if (result.isConfirmed) {
                                    vm.adicionarItem();
                                }

                            }
                        });

                    }
                });
            } catch (error) {
                console.error('Erro ao buscar produtos:', error);
            }
        },
        changeProduto(id_produto) {
            if (id_produto != "") {
                vm.buscaDadosProduto(id_produto)
                    .then(dadosProduto => {

                        var id_produto = $("#produto").val();
                        var quantidade_produto = $("#quantidade").val();

                        if (quantidade_produto > 0 && id_produto > 0) {

                            $("#percent_imposto").val(this.formatarNumero(dadosProduto[0].imposto_tipo_produto));
                            $("#valor_unitario").val(this.formatarNumero(dadosProduto[0].preco_venda_produto));

                            var valor_total_produto = parseFloat(dadosProduto[0].preco_venda_produto) * parseFloat(quantidade_produto);
                            var valor_total_imposto = parseFloat(valor_total_produto) * parseFloat(dadosProduto[0].imposto_tipo_produto / 100);
                            $("#valor_imposto").val(this.formatarNumero(valor_total_imposto));
                            $("#valor_total_produto").val(this.formatarNumero(valor_total_produto));

                        }
                    })
                    .catch(error => {
                        console.error('Erro ao buscar dados do produto:', error);
                    });
            } else {
                $(".inputs_novo_item").val("");
            }
        },

        buscaDadosProduto(id_produto) {
            return new Promise((resolve, reject) => {
                jQuery.ajax({
                    type: "POST",
                    url: urlBackEnd + "index.php",
                    data: { classe: "Produtos", funcao: "buscaDadosProduto", id_produto: id_produto },
                    success: function(data) {
                        try {
                            const parsedData = JSON.parse(data);
                            resolve(parsedData);
                        } catch (error) {
                            reject(error);
                        }
                    },
                    error: function(xhr, status, error) {
                        reject(error);
                    }
                });
            });
        },
        formatarNumero(numero) {
            const formatoBrasileiro = new Intl.NumberFormat('pt-BR', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2,
            });
            return formatoBrasileiro.format(numero);
        },

    }
});