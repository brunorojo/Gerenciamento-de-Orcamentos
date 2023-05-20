<?php
session_start();
require_once "_autorize_admin.php";
include_once "../header.php";
?>



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
                                <td><a href="<?php echo $dados["briefing"]; ?> " target='_blank'><span class="material-symbols-outlined text-primary">description</a></span>
                                </td>
                                <td><?php echo $dados["desenvolvedor"]; ?></td>
                                <td><?= number_format($dados["valordev"], 2, ',', '.') ?></td>
                                <td><?= number_format($dados["valorcliente"], 2, ',', '.') ?></td>
                                <td><?= number_format($dados["lucroempresa"], 2, ',', '.') ?></td>
                                <td><?php echo $dados["cliente"]; ?></td>
                                <!-- Data de entrega -->
                                <td>
                                    <?php if ($dados["dataentrega"] && $dados["status"] == 'aprovado' || $dados["status"] == 'iniciado' || $dados["status"] == 'finalizado') : ?>

                                        <?= date('d/m/Y', strtotime($dados["data_inicio"] . " + " . ceil($dados["dataentrega"]) . " days")) ?>

                                    <?php else : ?>
                                        <?= $dados["dataentrega"] ? $dados["dataentrega"] . ' dias' : $dados["dataentrega"] ?>
                                    <?php endif; ?>
                                </td>
                                <td>

                                    <?php

                                    $sql_1_xyz = "SELECT * FROM orcamentos WHERE projeto_id = " . $dados['id'] . " ORDER BY id DESC";
                                    $resultadl_1_xyz = mysqli_query($conn, $sql_1_xyz);
                                    $orcamentos = mysqli_fetch_all($resultadl_1_xyz, MYSQLI_ASSOC);
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

                                    <?php if (!empty($orcamentos) && $dados['status'] == 'orçado') : ?>
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#modal-orcamentos" onclick='setOrcamentos(`<?= json_encode($orcamentos) ?>`)'>
                                            <span class="material-symbols-outlined text-success">done_all</span>
                                        </a>
                                    <?php else : ?>
                                        <span class="material-symbols-outlined text-secondary opacity-50">done_all </span>
                                    <?php endif; ?>

                                </td>

                                <td>
                                    <a href="../scripts.php?deletarprojeto=<?php echo $dados["id"]; ?>" onclick="if(!confirm('Deseja realmente remover este projeto?')) event.preventDefault()">
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
        'Apagado com sucesso!',
        '',
        'success'
      )
      </script>";
        }
    }

    $total_despesas_empresa = 0;
    ?>

</main><!-- End #main -->
<!-- Modal orçamento !-->
<?php
include('../footer.php');

?>


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
        return valor.toLocaleString('pt-br', {
            style: 'currency',
            currency: 'BRL'
        });
    }


    /* Add orçamentos em uma tabalela para visualiazar todos */
    function setOrcamentos(dados) {
        dados = JSON.parse(dados)
        console.log(dados)

        let orcamentos = document.getElementById('dados-orcamentos')
        orcamentos.innerHTML = ''


        for (let i in dados) {
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
                            
                        </div>

                    </td>
                </tr>
                `
        }


    }
</script>

</body>

</html>