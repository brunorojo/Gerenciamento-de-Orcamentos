<?php
session_start();
require_once "_autorize_admin.php";

include_once "../conexao.php";

?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Administração</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">

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
            <a href="index.html" class="logo d-flex align-items-center">
               
            </a>
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

    <?php include_once "sadbar.php" ?>


    <main id="main" class="main">
        <a href="novoprojeto.php"><button type="button" class="btn btn-primary float-end">Novo Projeto</button></a>

        <div class="pagetitle">
            <h1>Projetos</h1>

            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item active">Projetos</li>

                </ol>
            </nav>
        </div>


        <div class="col-12 mt-4">
            <div class="card recent-sales overflow-auto">


                <div class="card-body">
                    <h5 class="card-title">Projetos</h5>

                    <table class="table table-borderless">
                        <thead>
                            <tr>
                                <th scope="col">Projeto</th>
                                <th scope="col">Briefing</th>
                                <th scope="col">Desenvolvedor</th>
                                <th scope="col">Valor dev</th>
                                <th scope="col">Valor cliente</th>
                                <th scope="col">Lucro</th>
                                <th scope="col">Cliente</th>
                                <th scope="col">Entrega</th>
                                <th scope="col">Status</th>
                                <th scope="col">Aprovar</th>
                                <th scope="col">Apagar</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            // $sql = "SELECT *,projeto.id as id, orcamentos.id as orc_id FROM projeto LEFT JOIN orcamentos ON projeto.id = orcamentos.projeto_id
                            //         ORDER BY projeto.id DESC";
                            $sql = "SELECT * FROM projeto ORDER BY id DESC";
                            $resultado = mysqli_query($conn, $sql);

                            while ($dados = mysqli_fetch_assoc($resultado)) {
                                # code...

                            ?>
                                <script>
                                    function idHidden(id) {
                                        $("#hidden").val(id);
                                    }
                                </script>
                                <tr>
                                    <td><?php echo $dados["nome"] ?></td>
                                    <td><a href="<?php echo $dados["briefing"]; ?>"><span class="material-symbols-outlined text-primary">description</a></span>
                                    </td>
                                    <td><?php echo $dados["desenvolvedor"]; ?></td>
                                    <td><?= number_format($dados["valordev"], 2, ',', '.') ?></td>
                                    <td><?= number_format($dados["valorcliente"], 2, ',', '.') ?></td>
                                    <td><?= number_format($dados["lucroempresa"], 2, ',', '.') ?></td>
                                    <td><?php echo $dados["cliente"]; ?></td>
                                    <!-- Data de entrega -->
                                    <td>
                                        <?php if($dados["dataentrega"] && $dados["status"] == 'aprovado' || $dados["status"] == 'iniciado' || $dados["status"] == 'finalizado' ): ?>

                                            <?= date('d/m/Y', strtotime($dados["data_inicio"] . " + " . ceil($dados["dataentrega"] ). " days")) ?>
                                            
                                        <?php else: ?>
                                            <?= $dados["dataentrega"] ? $dados["dataentrega"] . ' dias' : $dados["dataentrega"] ?>
                                        <?php endif; ?>
                                    </td>
                                    <td>

                                        <?php

                                        $sql_1_xyz = "SELECT * FROM orcamentos WHERE projeto_id = ".$dados['id']." ORDER BY id DESC";
                                        $resultadl_1_xyz = mysqli_query($conn, $sql_1_xyz);
                                        $orcamentos= mysqli_fetch_all($resultadl_1_xyz, MYSQLI_ASSOC);
                                        // echo '<pre>';
                                        // print_r($orcamentos);
                                        // echo '</pre>';
                                        
                                        ?>

                                        <?php if (!empty($orcamentos) && $dados['status'] == 'Aguardando') : ?>
                                            <span class="badge bg-success">orçado</span>
                                        <?php else : ?>
                                            <span class="badge bg-success"><?php echo $dados["status"]; ?></span>
                                        <?php endif; ?>
                                    </td>

                                    <td>
                                       
                                        <?php if (!empty($orcamentos) && $dados['status'] == 'Aguardando') : ?>
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#modal-orcamentos" 
                                                onclick='setOrcamentos(`<?= json_encode($orcamentos) ?>`)'>
                                                <span class="material-symbols-outlined text-success">done_all</span>
                                            </a>
                                        <?php else : ?>
                                            <span class="material-symbols-outlined text-secondary opacity-50">done_all</span>
                                        <?php endif; ?>

                                    </td>

                                    <td>
                                        <a href="../scripts.php?deletarprojeto=<?php echo $dados["id"]; ?>" 
                                        onclick="if(!confirm('Deseja realmente remover este projeto?')) event.preventDefault()">
                                            <span class="material-symbols-outlined text-danger">delete</span>
                                        </a>
                                    </td>
                                </tr>
                            <?php }; ?>
                        </tbody>
                    </table>

                </div>

            </div>
        </div>

        <?php
        if (isset($_GET["resultado"])) {
            $resultado = $_GET["resultado"];

            if ($resultado == 200) {
                echo "<script>
      
      Swal.fire(
        'Apagado com sucesso',
        'Cuidado para não apagar projetos que estão em execução',
        'success'
      )

      </script>";
            }
        }
        ?>

    </main><!-- End #main -->
    <!-- Modal orçamento !-->

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">
        <div class="copyright">
            &copy; Copyright <strong><span></span></strong>. Todos os direitos reservados
        </div>
        <div class="credits">
            <!-- All the links in the footer should remain intact. -->
            <!-- You can delete the links only if you purchased the pro version. -->
            <!-- Licensing information: https://bootstrapmade.com/license/ -->
            <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
        </div>
    </footer><!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

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


    <!-- Modal Confirmar aprovação -->
    <div class="modal fade" id="modalId" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="modalTitleId">Aprovar Projeto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="numero-parcelas" class="form-label">Número de parcelar</label>
                        <input type="number" class="form-control" value="1" min="1" id="numero-parcelas" require>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" onclick="aprovarProjeto()">Aprovar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Orçamentos -->
    <div class="modal fade" id="modal-orcamentos" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitleId">Orçamentos enviados</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    

                    <!-- Tabela orçamentos enviados -->
                    <div class="table-responsive">
                        <table class="table ">
                            <thead>
                                <tr class="text-truncate">
                                    <th scope="col">Desenvolvedor</th>
                                    <th scope="col">Valor Dev</th>
                                    <th scope="col">Cliente</th>
                                    <th scope="col">Lucro</th>
                                    <th scope="col">Entrega</th>
                                    <th scope="col">Mensagem</th>
                                    <th scope="col">Ações</th>
                                </tr>
                            </thead>
                            <tbody id="dados-orcamentos">
                                <!-- dados de orçamentos -->
                            </tbody>
                        </table>
                    </div>



                </div>
            </div>
        </div>
    </div>


    <!-- Optional: Place to the bottom of scripts -->
    <script>
        /* add url para aprovar orçamento */
        var url_aprovar_projeto = null;

        function setUrlAprovar(url) {
            url_aprovar_projeto = url;
        }

        function aprovarProjeto() {
            let total_parcelas = document.querySelector('#numero-parcelas').value
            if (total_parcelas == '' || total_parcelas == 0) {
                alert('Informe o total de parcelas do pagamento do projeto');
            } else {
                window.location.href = url_aprovar_projeto + '&total_parcelas=' + total_parcelas;
            }
        }

         /* Formatar número para moeda */
         function moeda(valor) {
            valor = parseFloat(valor)
            return valor.toLocaleString('pt-br',{style: 'currency', currency: 'BRL'});
        }


        /* Add orçamentos em uma tabalela para visualiazar todos */
        function setOrcamentos(dados) {
            dados = JSON.parse(dados)
            console.log(dados)

            let orcamentos = document.getElementById('dados-orcamentos')
            orcamentos.innerHTML=''

            
            for(let i in dados) {
                orcamentos.innerHTML += `
                <tr class="">
                    <td>${dados[i].dev}</td>
                    <td>${moeda(dados[i].valor_dev)}</td>
                    <td>${moeda(dados[i].valor_cliente)}</td>
                    <td>${moeda(dados[i].lucro_empresa)}</td>
                    <td>${dados[i].data_entrega} dias</td>
                    <td>
                        ${dados[i].observacao == null ? '' : atob(dados[i].observacao)}
                    </td>
                    <td>
                        <div class="d-flex gap-3">
                            <a href="#" data-bs-toggle="modal" data-bs-target="#modalId" onclick="setUrlAprovar('../scripts.php?aprovarprojeto=${dados[i].projeto_id}&orcamento_id=${dados[i].id}')" title="Aprovar">
                                <span class="material-symbols-outlined text-success">done_all</span>
                            </a>
                            <a href="../scripts.php?projeto_id=${dados[i].projeto_id}&orcamento_id=${dados[i].id}&encaminhar_orcamento_vendedor=true" title="Enviar orçamento para vendedor"
                            onclick="if(!confirm('Deseja realmente encaminhar este projeto para o vendedor?')) event.preventDefault()">
                                <span class="material-symbols-outlined text-primary">offline_share</span>
                            </a>
                        </div>

                    </td>
                </tr>
                `
            }


        }

       
    </script>

</body>

</html>