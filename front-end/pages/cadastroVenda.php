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
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <style>
        .total-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            margin-top: 10px;
        }
        
        .total-label {
            font-weight: bold;
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
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Nova Venda</h1>
                    <div id="app">
                        <!-- DataTales Example -->
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="container-btn-novo-item">
                                            <a href="#" class="btn btn-success btn-icon-split" @click="abrirNovoItem">
                                                <span class="icon text-white-50">
                                                    <i class="fas fa-plus"></i>
                                                </span>
                                                <span class="text">Novo Item</span>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-4 text-center">
                                        <h6 class="m-0 font-weight-bold text-primary">
                                            <span class="total-container">
                                                <span class="total-label">Total Venda:</span>
                                                <span class="total-valor-venda">R$ 0,00</span>
                                            </span>
                                            <span class="total-container">
                                                <span class="total-label">Total Imposto:</span>
                                                <span class="total-valor-imposto">R$ 0,00</span>
                                            </span>
                                        </h6>
                                    </div>
                                    <div class="col-4 text-right">
                                        <div class="container-btn-finalizar">
                                            <!-- Conteúdo do container-btn-finalizar -->
                                        </div>
                                    </div>
                                </div>
                            </div>                            
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="tabela_itens_venda" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>ID Produto</th>
                                                <th>Produto</th>
                                                <th>Quantidade</th>
                                                <th>Valor Unitário</th>
                                                <th>% Imposto</th>
                                                <th>Valor Total Imposto (R$)</th>
                                                <th>Valor Total Produto (R$)</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th>Totais</th>
                                                <th></th>
                                                <th></th>
                                                <th class="total-valor-imposto">R$ 0,00</th>
                                                <th class="total-valor-venda">R$ 0,00</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            <tr v-for="(item, index) in itens" :key="index">
                                                <td> 
                                                    <a href="#" class="btn btn-danger btn-circle excluirItem" @click="removerItem(index)" :data-index="index">

                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                </td>
                                                <td>{{ item.id_produto }}</td>
                                                <td>{{ item.nome_produto }}</td>
                                                <td>{{ item.quantidade }}</td>
                                                <td>R${{ item.valor_unitario }}</td>
                                                <td>{{ item.percent_imposto }}%</td>
                                                <td>R${{ item.valor_imposto }}</td>
                                                <td>R${{ item.valor_total_produto }}</td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- /.container-fluid -->
                </div>
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

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <script src="js/config.js?t=<?php echo time(); ?>"></script>
    <script src="js/scripts/Venda.js?t=<?php echo time(); ?>"></script>

</body>

</html>