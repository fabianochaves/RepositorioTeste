<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Sistema de Vendas - Consulta de Produtos</title>

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    
    <style>
        .ativo {
            color: green;
            font-weight: bold;
        }

        .inativo {
            color: red;
            font-weight: bold;
        }

        .acao-botoes {
            width: 1%;
            white-space: nowrap;
        }

        .acao-botoes button {
            margin-right: 5px;
        }

    </style>

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
                    <h1 class="h3 mb-2 text-gray-800">Consulta de Produtos</h1>
                    <div id="app">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Produtos</h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table v-if="Produtos.length > 0" class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <!-- Cabeçalho da tabela -->
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>ID</th>
                                                <th>Status</th>
                                                <th>Nome</th>
                                                <th>Tipo</th>
                                                <th>Preço Venda</th>
                                                <th>Preço Custo</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="(produto, index) in Produtos" :key="index">
                                                <td class="acao-botoes"> 
                                                    <a href="#" class="btn btn-circle alterarStatus" :class="{'btn-danger': produto.status_produto === 'Ativo', 'btn-success': produto.status_produto === 'Inativo'}" @click="status(produto)">
                                                        <i :class="{'fas fa-times': produto.status_produto === 'Ativo', 'fas fa-check': produto.status_produto === 'Inativo'}"></i>
                                                    </a>
                                                    <a href="#" class="btn btn-primary btn-circle editarRegistro" @click="abrirModalEdicao(produto)">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                </td>
                                                <td>{{ produto.id_produto }}</td>
                                                <td :class="produto.status_css">{{ produto.status_produto }}</td>
                                                <td>{{ produto.nome_produto }}</td>
                                                <td>{{ produto.nome_tipo_produto }}</td>
                                                <td>{{ formatarNumero(produto.preco_venda_produto) }}</td>
                                                <td>{{ formatarNumero(produto.preco_custo_produto) }}</td>
                                            </tr>
                                            <tr v-if="loading">
                                                <td colspan="5" class="text-center">Carregando...</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <p v-else>Nenhum dado disponível.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>


    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

        <!-- SweetAlert -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.css">

    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js"></script>

    <script src="js/config.js?t=<?php echo time(); ?>"></script>
    <script src="js/scripts/Produtos.js?t=<?php echo time(); ?>"></script>

</body>

</html>