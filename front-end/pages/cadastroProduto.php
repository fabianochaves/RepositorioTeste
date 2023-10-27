<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Sistema de Vendas - Produtos</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">


</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <?php include("menu.php"); ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">
                <?php include("menu_top.php"); ?>
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Cadastro de Produtos</h1>
                    </div>
                    <div class="row">
                        <!-- Content Column -->
                        <div class="col-lg-8 offset-md-2 mb-4">

                            <!-- Project Card Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Formulário</h6>
                                </div>
                                <div class="card-body">
                                    <div id="app">
                                        <form @submit.prevent="cadastrar" class="formulario" action="" method="POST" class="needs-validation" novalidate>
                                            <div class="form-group">
                                                <div class="form-row">
                                                    <div class="col-md-6">
                                                        <label>Nome do Produto</label>
                                                        <input autocomplete="off" required type="text" class="form-control form-control" v-model="nome_produto" id="nome_produto" name="nome_produto" placeholder="Digite o Nome do Produto...">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label>Tipo</label>
                                                        <select class="form-control" v-model="tipo_produto">
                                                            <option value="" disabled selected>Selecione a categoria</option>
                                                            <option v-for="categoria in categorias" :value="categoria.id_tipo_produto">{{ categoria.nome_tipo_produto }}</option>
                                                        </select>
                                                    </div>
                                               
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="form-row">
                                                    <div class="col-md-6">
                                                        <label>Preço de Venda Unitário (R$)</label>
                                                        <input autocomplete="off" required type="text" class="form-control form-control valorDecimal" v-model="preco_venda_produto" id="preco_venda_produto" name="preco_venda_produto" placeholder="Digite o Valor de Venda...">
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label>Preço de Custo Unitário (R$)</label>
                                                        <input autocomplete="off" required type="text" class="form-control form-control valorDecimal" v-model="preco_custo_produto" id="preco_custo_produto" name="preco_custo_produto" placeholder="Digite o Valor de Custo...">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="form-row">
                                                    <input type="submit" class="btn btn-primary btn-block col-md-4 offset-md-4" value="Salvar" />
                                                </div>
                                            </div>
                                            <hr>
                                        </form>
                                    </div>
                                </div>
                            </div>


                        </div>

                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
          

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->


    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.css">
   <!-- Inclua o script do Vue.js -->
   <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
        
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js"></script>
    <script src="js/config.js?t=<?php echo time(); ?>"></script>
    <script src="js/scripts/Produtos.js?t=<?php echo time(); ?>"></script>

</body>

</html>