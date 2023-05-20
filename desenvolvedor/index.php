<?php
session_start();
require_once "_autorize_dev.php";
include_once "../header.php";
?>


<script>
    const myModal = new bootstrap.Modal(document.getElementById('modalId'))
    myModal.show()
</script>


<?php
if (isset($_GET["jaorçado"])) {

    if ($_GET["jaorçado"] == 200) {
        echo "<script>alert('projeto já orçado por outro desenvolvedor, não roube a vez do coleguinha.')</script>";
    }
}
if (isset($_GET["orcamentoenviado"])) {

    if ($_GET["orcamentoenviado"] == 200) {
        echo "<script>alert('Orçamento enviado com sucesso')</script>";
    }
}
?>


<main id="main" class="main">

    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">

            <!-- Left side columns -->
            <div class="col-lg-12">
                <div class="row">

                    <!-- Sales Card -->
                    <div class="col-xxl-4 col-md-6">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <h5 class="card-title">Projetos</h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-cart"></i>
                                    </div>
                                    <?php

                                    $sql = "SELECT * from projeto 
                                                WHERE desenvolvedor = '$_SESSION[email]' && status = 'aprovado' OR status = 'iniciado' OR status = 'finalizado';";

                                    if ($resultado = mysqli_query($conn, $sql)) {

                                        // Return the number of rows in result set
                                        $rowcount = mysqli_num_rows($resultado);

                                    ?>
                                        <h6><?php echo $rowcount ?></h6>
                                    <?php }; ?>

                                </div>
                            </div>

                        </div>
                    </div><!-- End Sales Card -->

                    <!-- Revenue Card -->
                    <div class="col-xxl-4 col-md-6">
                        <div class="card info-card revenue-card">


                            <div class="card-body">
                                <h5 class="card-title">Ganhos</h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-currency-dollar"></i>
                                    </div>
                                    <?php



                                    $sql = "SELECT * FROM projeto WHERE status IN ('aprovado', 'finalizado','iniciado') AND desenvolvedor = '$_SESSION[email]';";
                                    $valor = 0;
                                    if ($resultado = mysqli_query($conn, $sql)) {

                                        while ($dados = mysqli_fetch_assoc($resultado)) {
                                            $valor += $dados['valordev'];

                                            ($dados);
                                        }
                                    }
                                    echo "<div class='ps-3'>
                                                <h6>R$$valor</h6>
                                                </div>"
                                    ?>
                                </div>
                            </div>

                        </div>
                    </div><!-- End Revenue Card -->




                </div>

            </div>
        </div><!-- End Reports -->

        <!-- Recent Sales -->
        <div class="col-12">
            <div class="card recent-sales overflow-auto">
                <div class="card-body">
                    <h5 class="card-title">Projetos Abertos</h5>
                    <table class="table table-borderless">
                        <thead>
                            <tr>
                                <th scope="col">Projeto</th>
                                <th scope="col">Briefing</th>
                                <th scope="col">Fazer Orçamento</th>
                                <!-- <th scope="col">Iniciar</th>
                                    <th scope="col">Finalizar</th> -->
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            $sql = "SELECT * FROM projeto 
                                        WHERE status = 'aguardando'  ORDER BY id DESC;";
                            $resultado = mysqli_query($conn, $sql);

                            while ($dados = mysqli_fetch_assoc($resultado)) {

                                $ax_sql = "SELECT * FROM orcamentos WHERE dev_id = " . $_SESSION['id'] . " && projeto_id = " . $dados['id'];
                                $ax_resultado = mysqli_query($conn, $ax_sql);
                                $ax_dados = mysqli_fetch_all($ax_resultado);

                                if (!empty($ax_dados)) {
                                    continue;
                                }



                            ?>
                                <script>
                                    function idHidden(id) {
                                        $("#hidden").val(id);
                                    }
                                </script>
                                <tr>
                                    <td><?php echo $dados["nome"]; ?></td>
                                    <td><a href="<?php echo $dados["briefing"]; ?> " target='_blank'><span class="material-symbols-outlined text-primary">description</a></span>

                                    </td>
                                    <td><a href="" onClick="idHidden(<?php echo $dados["id"]; ?>)" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo"><span class="material-symbols-outlined text-success">payments</span></a></td>
                                    <!-- <td>ss<a href="../scripts.php?iniciarprojeto=<?php echo $dados["id"]; ?>"><span
                                                class="material-symbols-outlined text-success">slow_motion_video</span></a>
                                    </td>
                                    <td><a href="../scripts.php?finalizarprojeto=<?php echo $dados["id"]; ?>"><span
                                                class="material-symbols-outlined text-primary">playlist_add_check_circle</span></a>
                                    </td> -->
                                    <td><span class="badge bg-success"><?php echo $dados["status"]; ?></span></td>

                                </tr>
                            <?php }; ?>
                        </tbody>
                    </table>

                </div>

            </div>
        </div><!-- End Recent Sales -->



        
    </section>

</main><!-- End #main -->
<!-- Modal orçamento !-->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Enviar orçamento</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="../scripts.php" method="POST">
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Quantas horas você acredita que
                            gastará?</label>
                        <input type="number" name="horas" required="" id="um" class="form-control" id="recipient-name" required>
                    </div>

                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Você receberá:</label>
                        <input type="number" name="valordesenvolvedor" id="dois" class="form-control" id="recipient-name" require>
                    </div>

                    <div class="mb-3">
                        <label for="observacao" class="col-form-label">Mensagem: <span class=" opacity-50" style="font-size: 11px">(Opcional)</span></label>
                        <input type="text" name="observacao" id="dois" class="form-control" id="observacao" maxlength="500">
                    </div>

                    <input type="hidden" name="id" id="hidden" value="">
                    <script>
                        function trim(str) {
                            return str.replace(/[^a-zA-Z0-9]/g, '')
                        }

                        let input = document.getElementById('um')
                        let input2 = document.getElementById('dois')


                        input.onkeyup = function() {
                            if (input.value < 20) {
                                input2.value = trim(input.value) * 25
                                exit();
                            } else {
                                input2.value = trim(input.value) * 17
                            }
                        }
                    </script>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success" name="enviarvalor">Enviar</button>
            </div>
        </div>
        </form>
    </div>

</div>


<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<?php

if (isset($_POST["enviar"])) {
?>
    <script>
        Swal.fire(
            'Orçamento enviado com sucesso!',
            'Aguarde a resposta do cliente.',
            'success'
        )
    </script>
<?php } ?>


<?php
if (isset($_POST["apagar"])) {
?>
    <script>
        Swal.fire(
            'Apagado com sucesso!',
            '',
            'success'
        )
    </script>
<?php } ?>


<?php
$total_despesas_empresa = 0;
include('../footer.php');

?>
</body>

</html>