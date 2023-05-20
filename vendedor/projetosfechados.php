<?php
session_start();
require_once "_autorize_vendedor.php";
include_once "../header.php";
?>


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
        <h1>Projetos Fechados</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active">Projetos Fechados</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">



            <!-- Recent Sales -->
            <div class="col-12">
                <div class="card recent-sales overflow-auto">
                    <div class="card-body">
                        <h5 class="card-title">Projetos Fechados</h5>
                        <table class="table table-borderless">
                            <thead>
                                <tr>
                                    <th scope="col">Projeto</th>
                                    <th scope="col">Briefing</th>
                                    <th scope="col">Desenvolvedor</th>
                                    <th scope="col">Entrega</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql = "SELECT * FROM projeto WHERE status != 'orçado' AND status != 'aguardando' AND cliente LIKE '%$_SESSION[email]%' ORDER BY id DESC";
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
                                        <td><?php echo $dados["nome"]; ?></td>
                                        <td><a href="<?php echo $dados["briefing"]; ?>" target="_blank"><span class="material-symbols-outlined text-primary">description</a></span>
                                        </td>


                                        <td>
                                            <?php echo $dados["desenvolvedor"]; ?>
                                        </td>
                                        <td>
                                            <?php if ($dados["dataentrega"] && $dados["status"] == 'aprovado' || $dados["status"] == 'iniciado' || $dados["status"] == 'finalizado') : ?>

                                                <?= date('d/m/Y', strtotime($dados["data_inicio"] . " + " . ceil($dados["dataentrega"]) . " days")) ?>

                                            <?php endif; ?>
                                        </td>
                                        <td><span class="badge bg-success"><?php echo $dados["status"]; ?></span></td>

                                    </tr>
                                <?php }; ?>
                            </tbody>
                        </table>

                    </div>

                </div>
            </div><!-- End Recent Sales -->
        </div>
       
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
                        <input type="number" name="horas" required="" id="um" class="form-control" id="recipient-name">
                    </div>

                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Você receberá:</label>
                        <input type="number" readonly="on" id="dois" class="form-control" id="recipient-name">
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
if (isset($_GET["aprovado"])) {
    $resultado = $_GET["aprovado"];

    if ($resultado == 200) {
        echo "<script>
                            Swal.fire(
                            'Aprovado',
                            'Projeto aprovado com sucesso!',
                            'success'
                            )
                            </script>";
    }
}
?>

<?php
$total_despesas_empresa = 0;
include('../footer.php');

?>

</body>

</html>