<?php
session_start();
require_once "_autorize_admin.php";
include_once "../conexao.php";
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />

    <title>Administração</title>
    <meta content="" name="description" />
    <meta content="" name="keywords" />

    <!-- Favicons -->
    <link href="..imagens/brfavicon.ico" rel="icon" />

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
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.36.3/apexcharts.min.css"> -->

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

    <?php include_once "sidebar.php" ?>

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Dashboard</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="index.php">Home</a>
                    </li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="row">

                <!-- Left side columns -->
                <div class="col-lg-12s">
                    <div class="row">

                        <!-- projetos fechados -->
                        <div class="col-lg-4 col-md-6">
                            <div class="card info-card sales-card">

                                <div class="card-body">
                                    <h5 class="card-title">Projetos fechados</h5>

                                    <div class="d-flex align-items-center">
                                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-cart"></i>
                                        </div>
                                        <div class="ps-3">
                                            <?php
                                            $sql = "SELECT count(*) as total_projetos_fechados from projeto
                                                    where status in('aprovado', 'iniciado', 'finalizado')";
                                            $exec_sql = mysqli_query($conn, $sql);
                                            $resultado = mysqli_fetch_object($exec_sql);
                                            ?>
                                            <h6>
                                                <?= $resultado->total_projetos_fechados ?>
                                            </h6>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <!-- Customers Card -->
                        <div class="col-lg-4 col-md-6">

                            <div class="card info-card customers-card">


                                <div class="card-body">
                                    <h5 class="card-title">Clientes</h5>

                                    <div class="d-flex align-items-center">
                                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-people"></i>
                                        </div>
                                        <div class="ps-3">
                                            <?php

                                            $sql = "SELECT * from cliente WHERE MONTH(now())";

                                            if ($resultado = mysqli_query($conn, $sql)) {

                                                // Return the number of rows in result set
                                                $rowcount = mysqli_num_rows($resultado);

                                                ?>
                                                <h6>
                                                    <?php echo $rowcount; ?>
                                                </h6>

                                            <?php }
                                            ; ?>

                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div><!-- End Customers Card -->

                        <!-- Customers Card -->
                        <div class="col-lg-4 col-md-6">



                            <div class="card info-card customers-card">


                                <div class="card-body">
                                    <h5 class="card-title">Desenvolvedores</h5>

                                    <div class="d-flex align-items-center">
                                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-people"></i>
                                        </div>
                                        <div class="ps-3">
                                            <?php
                                            $sql = "SELECT count(*) as total_devs from login
                                                    where nivel = 'dev';";
                                            $exec_sql = mysqli_query($conn, $sql);
                                            $resultado = mysqli_fetch_object($exec_sql);
                                            ?>
                                            <h6>
                                                <?= $resultado->total_devs ?>
                                            </h6>

                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div><!-- End Customers Card -->

                        <!-- Revenue Card -->
                        <div class="col-lg-4 col-md-6">
                            <div class="card info-card revenue-card">

                                <div class="card-body">
                                    <h5 class="card-title">
                                        Faturamento Total
                                        <span class="d-inline-block" tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover focus"
                                            data-bs-content="Faturamento total até o dia de hoje! Esse valor não contém o valor de parcelas de projetos dos próximos dias e meses, apenas até o dia atual. Se tiver uma parcela atrasada até o dia atual, o valor será somado mesmo assim ao faturamento">
                                            <a class="text-decoration-none" href="#">
                                                <span class="material-symbols-outlined" style="font-size: 16px;">
                                                    info
                                                </span>
                                            </a>
                                        </span>
                                    </h5>

                                    <div class="d-flex align-items-center">
                                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-currency-dollar"></i>
                                        </div>
                                        <?php

                                        $sql = "SELECT SUM(valor_parcela) as dinheiro_empresa
                                            FROM lucro_empresa
                                            WHERE data_parcela <= '" . date('Y-m-d') . "';";
                                        $resultado = mysqli_query($conn, $sql);

                                        $dados = mysqli_fetch_object($resultado);
                                        $total_dinheiro_empresa = $dados->dinheiro_empresa;
                                        $dinheirototal_faturamento = $total_dinheiro_empresa;

                                        ?>

                                        <div class='ps-3'>
                                            <h6>
                                                R$ <?= number_format($dinheirototal_faturamento, 2, ',', '.') ?>
                                            </h6>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div><!-- End Revenue Card -->
                        <!-- Revenue Card -->
                        <div class="col-lg-4 col-md-6">
                            <div class="card info-card revenue-card">

                                <div class="card-body">
                                    <h5 class="card-title">
                                        Despesas Totais
                                        <span class="d-inline-block" tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover focus"
                                            data-bs-content="A soma do valor de todas as despesas pagas e pendentes até o dia de hoje!">
                                            <a class="text-decoration-none" href="#">
                                                <span class="material-symbols-outlined" style="font-size: 16px;">
                                                    info
                                                </span>
                                            </a>
                                        </span>
                                    </h5>

                                    <div class="d-flex align-items-center">
                                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-currency-dollar"></i>
                                        </div>
                                        <?php

                                        // $sql = "SELECT SUM(valor) as despesas_empresa FROM despesa WHERE data <= '". date('Y-m-t') ."';";
                                        $sql = "SELECT SUM(valor) as despesas_empresa FROM despesa
                                            WHERE data_pagamento <= '" . date('Y-m-d') . "';";
                                        // $sql = "SELECT SUM(valor) as despesas_empresa FROM despesa
                                        //     WHERE status_pagamento = 0 && data_pagamento <= '" . date('Y-m-d') . "';";
                                        $resultado = mysqli_query($conn, $sql);
                                        $dados = mysqli_fetch_object($resultado);
                                        $total_despesas_empresa = $dados->despesas_empresa;

                                        ?>

                                        <div class='ps-3'>
                                            <h6>
                                                R$ <?= number_format($total_despesas_empresa, 2, ',', '.') ?>
                                            </h6>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div><!-- End Revenue Card -->
                        <!-- Revenue Card -->
                        <div class="col-lg-4 col-md-6">
                            <div class="card info-card revenue-card">

                                <div class="card-body">
                                    <h5 class="card-title">
                                        Lucro Total
                                        <span class="d-inline-block" tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover focus"
                                            data-bs-content="O valor do lucro total é o faturamento total menos o valor das despesas totais">
                                            <a class="text-decoration-none" href="#">
                                                <span class="material-symbols-outlined" style="font-size: 16px;">
                                                    info
                                                </span>
                                            </a>
                                        </span>
                                    </h5>

                                    <div class="d-flex align-items-center">
                                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-currency-dollar"></i>
                                        </div>
                                        <?php


                                        $lucro_total = $dinheirototal_faturamento - $total_despesas_empresa;

                                        ?>

                                        <div class='ps-3'>
                                            <h6>
                                                R$ <?= number_format($lucro_total, 2, ',', '.') ?>
                                            </h6>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div><!-- End Revenue Card -->


                        <!--  -->
                        <!-- Revenue Card -->
                        <div class="col-lg-4 col-md-6">
                            <div class="card info-card revenue-card">

                                <div class="card-body">
                                    <h5 class="card-title">
                                        Faturamento no Mês
                                        <span class="d-inline-block" tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover focus"
                                            data-bs-content="Valor total do faturamento de 01 deste mês até o dia de hoje (<?= date('d/m') ?>)! Esse valor inclui parcelas de projetos que já foram pagas ou serão pagas nesse periódo do dia 01 até hoje.">
                                            <a class="text-decoration-none" href="#">
                                                <span class="material-symbols-outlined" style="font-size: 16px;">
                                                    info
                                                </span>
                                            </a>
                                        </span>
                                    </h5>

                                    <div class="d-flex align-items-center">
                                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-currency-dollar"></i>
                                        </div>
                                        <?php

                                        $sql = "SELECT SUM(valor_parcela) as dinheiro_empresa
                                        FROM lucro_empresa
                                        WHERE data_parcela >= '" . date('Y-m-01') . "' && data_parcela <= '" . date('Y-m-d') . "';";
                                        $resultado = mysqli_query($conn, $sql);

                                        $dados = mysqli_fetch_object($resultado);
                                        $total_dinheiro_empresa = $dados->dinheiro_empresa;
                                        $dinheirototal_faturamento_mes = $total_dinheiro_empresa;

                                        ?>

                                        <div class='ps-3'>
                                            <h6>
                                                R$ <?= number_format($dinheirototal_faturamento_mes, 2, ',', '.') ?>
                                            </h6>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div><!-- End Revenue Card -->
                        <!-- Revenue Card -->
                        <div class="col-lg-4 col-md-6">
                            <div class="card info-card revenue-card">

                                <div class="card-body">
                                    <h5 class="card-title">
                                        Despesas no Mês
                                        <span class="d-inline-block" tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover focus"
                                            data-bs-content="A soma do valor de todas as despesas pagas e pendentes do dia 01 deste mês até hoje (<?= date('d/m') ?>)!">
                                            <a class="text-decoration-none" href="#">
                                                <span class="material-symbols-outlined" style="font-size: 16px;">
                                                    info
                                                </span>
                                            </a>
                                        </span>
                                    </h5>

                                    <div class="d-flex align-items-center">
                                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-currency-dollar"></i>
                                        </div>
                                        <?php

                                        // $sql = "SELECT SUM(valor) as despesas_empresa FROM despesa WHERE data <= '". date('Y-m-t') ."';";
                                        $sql = "SELECT SUM(valor) as despesas_empresa FROM despesa
                                            WHERE data_pagamento >= '" . date('Y-m-01') . "' && data_pagamento <= '" . date('Y-m-d') . "';";
                                        // $sql = "SELECT SUM(valor) as despesas_empresa FROM despesa
                                        //     WHERE status_pagamento = 0 && data_pagamento <= '" . date('Y-m-d') . "';";
                                        $resultado = mysqli_query($conn, $sql);
                                        $dados = mysqli_fetch_object($resultado);
                                        $total_despesas_empresa_mes = $dados->despesas_empresa;

                                        ?>

                                        <div class='ps-3'>
                                            <h6>
                                                R$ <?= number_format($total_despesas_empresa_mes, 2, ',', '.') ?>
                                            </h6>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div><!-- End Revenue Card -->
                        <!-- Revenue Card -->
                        <div class="col-lg-4 col-md-6">
                            <div class="card info-card revenue-card">

                                <div class="card-body">
                                    <h5 class="card-title">
                                        Lucro no Mês
                                        <span class="d-inline-block" tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover focus"
                                            data-bs-content="O valor do lucro no mês é o faturamento do mês menos o valor das despesas no mês, do dia 01 até hoje (<?= date('d/m') ?>)!">
                                            <a class="text-decoration-none" href="#">
                                                <span class="material-symbols-outlined" style="font-size: 16px;">
                                                    info
                                                </span>
                                            </a>
                                        </span>
                                    </h5>

                                    <div class="d-flex align-items-center">
                                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-currency-dollar"></i>
                                        </div>
                                        <?php

                                        $lucro_total_mes = $dinheirototal_faturamento_mes - $total_despesas_empresa_mes;

                                        ?>

                                        <div class='ps-3'>
                                            <h6>
                                                R$ <?= number_format($lucro_total_mes, 2, ',', '.') ?>
                                            </h6>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div><!-- End Revenue Card -->




                        <!-- Chart -->
                        <!-- Reports -->
                        <div class="col-12 d-none">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Desempenho</h5>

                                    <!-- Line Chart -->
                                    <div id="reportsChart"></div>

                                    <script>
                                        // document.addEventListener("DOMContentLoaded", () => {
                                        //     new ApexCharts(document.querySelector("#reportsChart"), {
                                        //         series: [{
                                        //             name: 'Projetos',
                                        //             data: [31, 40, 28, 51, 42, 82, 56],
                                        //         }, {
                                        //             name: 'Lucro',
                                        //             data: [11, 32, 45, 32, 34, 52, 41]
                                        //         }, {
                                        //             name: 'Clientes',
                                        //             data: [15, 11, 32, 18, 9, 24, 11]
                                        //         }],
                                        //         chart: {
                                        //             height: 350,
                                        //             type: 'area',
                                        //             toolbar: {
                                        //                 show: false
                                        //             },
                                        //         },
                                        //         markers: {
                                        //             size: 4
                                        //         },
                                        //         colors: ['#4154f1', '#2eca6a', '#ff771d'],
                                        //         fill: {
                                        //             type: "gradient",
                                        //             gradient: {
                                        //                 shadeIntensity: 1,
                                        //                 opacityFrom: 0.3,
                                        //                 opacityTo: 0.4,
                                        //                 stops: [0, 90, 100]
                                        //             }
                                        //         },
                                        //         dataLabels: {
                                        //             enabled: false
                                        //         },
                                        //         stroke: {
                                        //             curve: 'smooth',
                                        //             width: 2
                                        //         },
                                        //         xaxis: {
                                        //             type: 'datetime',
                                        //             categories: ["2018-09-19T00:00:00.000Z",
                                        //                 "2018-09-19T01:30:00.000Z",
                                        //                 "2018-09-19T02:30:00.000Z",
                                        //                 "2018-09-19T03:30:00.000Z",
                                        //                 "2018-09-19T04:30:00.000Z",
                                        //                 "2018-09-19T05:30:00.000Z",
                                        //                 "2018-09-19T06:30:00.000Z"
                                        //             ]
                                        //         },
                                        //         tooltip: {
                                        //             x: {
                                        //                 format: 'dd/MM/yy HH:mm'
                                        //             },
                                        //         }
                                        //     }).render();
                                        // });
                                    </script>
                                    <!-- End Line Chart -->

                                </div>
                            </div>
                        </div><!-- End Reports -->

                    </div>
                </div><!-- End Left side columns -->

                <!-- Right side columns -->




                <!-- Website Traffic -->



                <!-- ========== Início Demandas x Desenvolvedores ========== -->
                <div class="col-12">
                    <div class="card">
                        <div class="card-body pb-0">
                            <h5 class="card-title">Demandas x Desenvolvedores</h5>

                            <div id="desenvolver-demanda" style="min-height: 400px;" class="echart"></div>

                        </div>
                    </div>
                </div>
                <!-- ========== Fim Demandas x Desenvolvedores ========== -->

                <!-- ========== Início Faturamento nos útimos 12 meses ========== -->
                <div class="col-12">
                    <div class="card">
                        <div class="card-body pb-0">
                            <h5 class="card-title">Faturamento nos útimos 12 meses</h5>

                            <div id="chart-faturamento-meses" style="min-height: 400px;" class="echart"></div>

                        </div>
                    </div>
                </div>
                <!-- ========== Fim Faturamento nos útimos 12 meses ========== -->

            </div>
        </section>

    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">
        <div class="copyright">
            &copy; Copyright. Todos os direitos reservados.
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

    <?php

    /* Obter total de desenvolvedores */
    $sql = "SELECT count(*) as total FROM login WHERE nivel = 'dev';";
    $resultado = mysqli_query($conn, $sql);
    // $dados = mysqli_fetch_all($resultado);
    $devs = mysqli_fetch_object($resultado);
    $totalDevs = $devs->total;

    /* Obter total de projetos cadastrados */
    $sql = "SELECT count(*) as total FROM projeto WHERE 1";
    $resultado = mysqli_query($conn, $sql);
    $projetos = mysqli_fetch_object($resultado);
    $totalProjetos = $projetos->total;

    /* Dados de faturamento no útimos 12 meses */
    $meses_abreviado = array(
        1 => 'Jan',
        'Fev',
        'Mar',
        'Abr',
        'Mai',
        'Jun',
        'Jul',
        'Ago',
        'Set',
        'Out',
        'Nov',
        'Dez'
    );
    $dataFaturamento = [
        'meses' => [],
        'valores' => [],
    ];

    for ($i = 0; $i < 12; $i++) {

        $mesCorrente = date('n', strtotime(date('Y-m-15') . " - $i months"));
        $anoCorrente = date('Y', strtotime(date('Y-m-15') . " - $i months"));

        array_unshift($dataFaturamento['meses'], $meses_abreviado[$mesCorrente] . '/' . $anoCorrente);

        $sql = "SELECT SUM(valor) as despesas_empresa FROM despesa WHERE data <= '" . date('Y-m-t') . "';";
        $resultado = mysqli_query($conn, $sql);
        $despesas = mysqli_fetch_object($resultado);

        $sql = "SELECT sum(valor_parcela) as lucro_mes FROM lucro_empresa WHERE YEAR(data_parcela) <= " . date('Y') . " AND MONTH(data_parcela) = $mesCorrente;";
        $resultado = mysqli_query($conn, $sql);
        $projetos = mysqli_fetch_object($resultado);
        array_unshift($dataFaturamento['valores'], ($projetos->lucro_mes == '' ? 0 : $projetos->lucro_mes - $total_despesas_empresa));
    }
    ?>

    <!-- Gráfico devs/demandas -->
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            echarts.init(document.querySelector("#desenvolver-demanda")).setOption({
                tooltip: {
                    trigger: 'item'
                },
                legend: {
                    top: '5%',
                    left: 'center'
                },
                series: [{
                    // name: 'Access From',
                    type: 'pie',
                    radius: ['40%', '70%'],
                    avoidLabelOverlap: false,
                    label: {
                        show: false,
                        position: 'center'
                    },
                    emphasis: {
                        label: {
                            show: true,
                            fontSize: '18',
                            fontWeight: 'bold'
                        }
                    },
                    labelLine: {
                        show: false
                    },
                    data: [{
                            value: <?= $totalDevs ?>,
                            name: 'Desenvolvedores'
                        },
                        {
                            value: <?= $totalProjetos ?>,
                            name: 'Demandas'
                        }
                    ]
                }]
            });
        });
    </script>

    <!-- Grafíco faturamento -->
    <script>
        var options = {
            series: [{
                data: JSON.parse(`<?= json_encode($dataFaturamento['valores']) ?>`),
            }],
            chart: {
                height: 350,
                type: 'bar',
                events: {
                    click: function(chart, w, e) {
                        // console.log(chart, w, e)
                    }
                }
            },
            // colors: colors,
            plotOptions: {
                bar: {
                    columnWidth: '45%',
                    distributed: true,
                }
            },
            dataLabels: {
                enabled: false
            },
            legend: {
                show: false
            },
            xaxis: {
                categories: JSON.parse(`<?= json_encode($dataFaturamento['meses']) ?>`),
                labels: {
                    style: {
                        // colors: colors,
                        fontSize: '12px'
                    }
                }
            },
            tooltip: {
                y: {
                    formatter: function(val) {
                        return val.toLocaleString('pt-br', {
                            style: 'currency',
                            currency: 'BRL'
                        });

                    },
                    title: {
                        formatter: function(seriesName) {
                            return 'Lucro:'
                        }
                    }
                }
            }
        };

        var chart = new ApexCharts(document.querySelector("#chart-faturamento-meses"), options);
        chart.render();



        /*  */
        const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]')
        const popoverList = [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl))
    </script>



</body>

</html>