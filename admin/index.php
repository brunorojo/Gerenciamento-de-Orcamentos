<?php
session_start();
require_once "_autorize_admin.php";
    include("../header.php")
?>
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

                                       
                                        $sql = "SELECT SUM(valor) as despesas_empresa FROM despesa
                                            WHERE data_pagamento <= '" . date('Y-m-d') . "';";
                                       
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

                                        
                                        $sql = "SELECT SUM(valor) as despesas_empresa FROM despesa
                                            WHERE data_pagamento >= '" . date('Y-m-01') . "' && data_pagamento <= '" . date('Y-m-d') . "';";
                                        
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

                                  
                                    <!-- End Line Chart -->

                                </div>
                            </div>
                        </div><!-- End Reports -->

                    </div>
                </div><!-- End Left side columns -->


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

   
<?php
    include('../footer.php')
?>

</body>

</html>