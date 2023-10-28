vm = new Vue({
    el: '#app',
    data: {
        Vendas: [],
        loading: false,
    },
    methods: {
        formatarData(datetime) {
            const data = new Date(datetime);

            const dia = data.getDate().toString().padStart(2, '0');
            const mes = (data.getMonth() + 1).toString().padStart(2, '0');
            const ano = data.getFullYear();
            const hora = data.getHours().toString().padStart(2, '0');
            const minuto = data.getMinutes().toString().padStart(2, '0');
            const segundo = data.getSeconds().toString().padStart(2, '0');

            return `${dia}/${mes}/${ano} ${hora}:${minuto}:${segundo}`;
        },
        formatarNumero(numero) {
            const formatter = new Intl.NumberFormat('pt-BR', {
                style: 'decimal',
                minimumFractionDigits: 2,
            });
            return formatter.format(numero);
        },
        verItens(venda) {
            var classe = "Venda";
            var funcao = "verItens";

            jQuery.ajax({
                type: "POST",
                url: urlBackEnd + "index.php",
                data: { classe: classe, funcao: funcao, id_venda: venda.id_venda },
                success: function(data) {
                    if (data.status) {
                        var tableHTML = '<div class="table-responsive">' + // Adicione a classe table-responsive ao elemento pai
                            '<table class="table table-bordered table-striped">' +
                            '<thead>' +
                            '<tr>' +
                            '<th>ID</th>' +
                            '<th>Nome</th>' +
                            '<th>Quantidade</th>' +
                            '<th>Valor Unitário (R$)</th>' +
                            '<th>Total do Produto</th>' +
                            '<th>% Imposto</th>' +
                            '<th>Total de Imposto</th>' +
                            '</tr>' +
                            '</thead>' +
                            '<tbody>';

                        data.itens.forEach(function(item) {
                            tableHTML += '<tr>' +
                                '<td>' + item.cod_produto_venda + '</td>' +
                                '<td>' + item.nome_produto + '</td>' +
                                '<td>' + item.qtd_produto_venda + '</td>' +
                                '<td>R$' + vm.formatarNumero(item.valor_unitario_venda) + '</td>' +
                                '<td>R$' + vm.formatarNumero(item.total_produto_venda) + '</td>' +
                                '<td>' + vm.formatarNumero(item.imposto_produto_venda) + '%</td>' +
                                '<td>R$' + vm.formatarNumero(item.total_imposto_venda) + '</td>' +
                                '</tr>';
                        });

                        tableHTML += '</tbody>' +
                            '</table>' +
                            '</div>';

                        Swal.fire({
                            icon: 'info',
                            title: 'Itens da Venda',
                            html: tableHTML,
                            width: 1200,
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Erro',
                            text: data.message
                        });
                    }
                },
                error: function(xhr, status, error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Erro',
                        text: 'Ocorreu um erro na requisição AJAX. Tente novamente mais tarde.'
                    });
                }
            });
        },


        listar() {
            var classe = "Venda";
            var funcao = "listar";
            var parametros = {
                is_ativo: 1
            };

            jQuery.ajax({
                type: "POST",
                url: urlBackEnd + "index.php",
                data: { classe: classe, funcao: funcao, is_ativo: parametros },
                success: function(data) {
                    vm.Vendas = data;
                    let totalVendas = 0;
                    let totalImposto = 0;
                    data.forEach((venda) => {
                        totalVendas += parseFloat(venda.valor_total_venda);
                        totalImposto += parseFloat(venda.valor_imposto_venda);
                    });
                    const totalLiquido = totalVendas - totalImposto;

                    document.getElementById("totalVendas").textContent = vm.formatarNumero(totalVendas);
                    document.getElementById("totalImposto").textContent = vm.formatarNumero(totalImposto);
                    document.getElementById("totalLiquido").textContent = vm.formatarNumero(totalLiquido);



                    setTimeout(() => {
                        $('#dataTable').DataTable();

                    }, 500);
                }
            });
        },


    },

    mounted() {
        this.listar();
    }
});