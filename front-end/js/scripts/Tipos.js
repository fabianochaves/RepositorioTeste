vm = new Vue({
    el: '#app',
    data: {
        nome_tipo_produto: '',
        imposto_tipo_produto: '',
    },
    methods: {

        cadastrar() {
            if (this.nome_tipo_produto == "" || this.imposto_tipo_produto == "") {
                alerta("warning", "Atenção", "Preencha todos os Campos!", "");
                return false
            } else {
                var classe = "Tipos";
                var funcao = "cadastrar";

                jQuery.ajax({
                    type: "POST",
                    url: urlBackEnd + "index.php",
                    data: { classe: classe, funcao: funcao, nome_tipo_produto: this.nome_tipo_produto, imposto_tipo_produto: this.imposto_tipo_produto },
                    success: function(data) {
                        if (data.status == 1) {
                            alerta("success", "Sucesso!", data.body, "");
                        } else {
                            alerta("error", "Atenção!", data.body, "");
                        }

                        return false;
                    }
                });

                return false;
            }

        },

    }
});