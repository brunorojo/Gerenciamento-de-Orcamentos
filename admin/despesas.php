<?php
session_start();
require_once "_autorize_admin.php";
include_once "../header.php";
?>


<main id="main" class="main">
    <a href="novadespesa.php">
        <button type="button" class="btn btn-primary float-end">Nova despesa</button>
    </a>

    <div class="pagetitle">
        <h1>Despesas</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="index.php">Home</a>
                </li>
                <li class="breadcrumb-item active">Despesas</li>

            </ol>
        </nav>
    </div>

    <div class="col-12 mt-4">
        <div class="card recent-sales overflow-auto">


            <div class="card-body">
                <h5 class="card-title">Despesas</h5>

                <table class="table table-borderless">
                    <thead>
                        <tr class="">
                            <th scope="col">Despesa</th>
                            <th scope="col">Valor</th>
                            <th scope="col">Descrição</th>
                            <th scope="col">Status</th>
                            <th scope="col">Data Pagamento</th>
                            <th scope="col">Confirmar Pagamento</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                            $sql = "SELECT * FROM despesa ORDER BY status_pagamento, data_pagamento ";
                            $resultado = mysqli_query($conn, $sql);

                            while ($dados = mysqli_fetch_assoc($resultado)) {

                                ?>
                        <tr>
                            <td>
                                <?php echo $dados["nome"]; ?>
                            </td>
                            <td class="fw-semibold text-success">
                                <?= number_format($dados["valor"], 2, ',', '.') ?>
                            </td>
                            <td>
                                <?php echo $dados["descricao"]; ?>
                            </td>
                            <td>
                                <?php if ($dados["status_pagamento"]): ?>
                                <span class="badge rounded-pill text-bg-success">Pago</span>
                                <?php else: ?>
                                <span class="badge rounded-pill text-bg-warning">Pendente</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?= date('d/m/Y', strtotime($dados['data_pagamento'])) ?>
                            </td>
                            <td>
                                <a class="link-success text-decoration-none"
                                    href="../scripts.php?confirmar_pagamento_despesa=true&despesa_id=<?= $dados['id'] ?>"
                                    onclick="if(!confirm('Confirmar este pagamento?')) event.preventDefault()">
                                    <span class="material-symbols-outlined text-success">done_all</span>
                                </a>
                            </td>
                        </tr>
                        <?php }
                            ; ?>
                    </tbody>
                </table>

            </div>

        </div>
    </div>

</main><!-- End #main -->
<?php 
    $total_despesas_empresa =0;
    include ('../footer.php');

?>

</body>

</html>