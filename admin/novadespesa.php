<?php
session_start();
require_once "_autorize_admin.php";
include_once "../conexao.php";
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />

    <title>RETENÇÃO DE ORÇAMENTOS</title>
    <meta content="" name="description" />
    <meta content="" name="keywords" />

    <!-- Favicons -->
    <link href="../imagens/brfavicon.ico" rel="icon" />

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect" />
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet" />

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet" />
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet" />
    <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet" />
    <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet" />
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet" />
    <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet" />

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet" />

    <!-- =======================================================
  * Template Name: NiceAdmin - v2.4.1
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">

        <div class="d-flex align-items-center justify-content-between">
            <a href="index.html" class="logo d-flex align-items-center"></a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div><!-- End Logo -->

        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">

                <li class="nav-item dropdown pe-3">

                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">

                        <span class="d-none d-md-block dropdown-toggle ps-2">Usuário</span>
                    </a><!-- End Profile Iamge Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="../logout.php">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Sair</span>
                            </a>
                        </li>

                    </ul><!-- End Profile Dropdown Items -->
                </li><!-- End Profile Nav -->

            </ul>
        </nav><!-- End Icons Navigation -->

    </header><!-- End Header -->

    <!-- ======= Sidebar ======= -->
    <?php include_once "sadbar.php" ?>


    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Cadastro de Despesas</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active">
                        Desde pagamento de desenvolvedores até o salário no final do mês
                    </li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section dashboard">
            <form action="../scripts.php" method="POST">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Nome da despesa</label>
                    <input type="text" name="nome" class="form-control" id="exampleFormControlInput1" />
                </div>
                <div class="mb-3">
                    <label for="valor-despesa" class="form-label">Valor total da despesa</label>
                    <input type="number" name="valor" class="form-control" id="valor-despesa" />
                </div>
                <div class="mb-3">
                    <label for="total-parcelas" class="form-label">Total de parcelas</label>
                    <input type="number" name="total_parcelas" class="form-control" id="total-parcelas" value="" required />
                </div>


                <!-- Parcelas -->
                <div id="parcelas">
                    <!-- inner parcelas -->
                </div>


                <div class="form-floating">
                    <textarea name="descricao" class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"></textarea>
                    <label for="floatingTextarea2">Descrição da despesa</label>

                </div>
                <button type="submit" name="cadastrardespesa" class="btn btn-primary float-end mt-3">Cadastrar</button>
            </form>
        </section>

        <?php
        if (isset($_GET["resultado"])) {
            $resultado = $_GET["resultado"];
            if ($resultado == 200) {
                echo "<script>
                     Swal.fire('Cadastrado com sucesso!','','success')
                     </script>";
            }
        }
        ?>


    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer mt-5">
        <div class="copyright">
            &copy; Copyright. Todos os direitos reservados
        </div>
        <div class="credits">
            <!-- All the links in the footer should remain intact. -->
            <!-- You can delete the links only if you purchased the pro version. -->
            <!-- Licensing information: https://bootstrapmade.com/license/ -->
            <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
        </div>
    </footer><!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center">
        <i class="bi bi-arrow-up-short"></i>
    </a>

    <!-- Vendor JS Files -->
    <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/chart.js/chart.min.js"></script>
    <script src="assets/vendor/echarts/echarts.min.js"></script>
    <script src="assets/vendor/quill/quill.min.js"></script>
    <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>

    <!-- script para add parcelas -->
    <script>
        function obterDataParcela(meses) {

            meses--;

            let currentDate = new Date();

            let x = currentDate.setMonth(currentDate.getMonth() + meses);
            x = dateFormat = new Date(x);

            let dia = x.getDate();
            let mes = x.getMonth() + 1;
            mes = mes < 10 ? '0' + mes : mes;
            let ano = x.getFullYear();

            return `${ano}-${mes}-${dia}`;
        }


        function addParcelas() {
            let valor_despesa = document.getElementById('valor-despesa').value;
            let total_parcelas = document.getElementById('total-parcelas').value;

            let valor_parcela = valor_despesa / total_parcelas;
            valor_parcela = valor_parcela.toFixed(2)

            let el_parcelas = document.getElementById('parcelas')
            el_parcelas.innerHTML = '';


            for (let i = 1; i <= total_parcelas; i++) {

                let data_parcela= obterDataParcela(i);

                el_parcelas.innerHTML += `
                    <div class="mb-3">
                        <div class="fw-bold small mb-1">${i}º Parcela</div>
                        <div class="row">
                            <div class="col-6 col-lg-3">
                                <label for="ab${i}" class="form-label">Data de pagamento</label>
                                <input type="date" name="data_parcelas[]" class="form-control" id="ab${i}" value="${data_parcela}" required>
                            </div>
                            <div class="col-6 col-lg-2">
                                <label for="xy${i}" class="form-label">Valor</label>
                                <input type="number" name="valor_parcelas[]" class="form-control" id="xy${i}" value="${valor_parcela}" required>
                            </div>
                        </div>
                    </div>
                `

            }

        }

        document.getElementById('valor-despesa').onkeyup = function() {
            addParcelas();
        }
        document.getElementById('total-parcelas').onkeyup = function() {
            addParcelas();
        }
    </script>

</body>

</html>