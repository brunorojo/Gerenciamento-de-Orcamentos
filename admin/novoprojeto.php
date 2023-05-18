<?php
session_start();
require_once "_autorize_admin.php";
include_once "../header.php";
?>


<?php
if (isset($_GET["resultado"])) {
    $resultado = $_GET["resultado"];

    if ($resultado == 200) {
        echo "<script>
      Swal.fire(
        'Cadastrado com sucesso!',
        '',
        'success'
      )
      </script>";
    }
}
?>
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Cadastrar Projeto</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">Cadastrar projeto e vincular a um cliente.</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <form action="../scripts.php" method="POST">

        <section class="section dashboard">
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Nome do Projeto</label>
                <input type="text" name="nome" class="form-control" id="exampleFormControlInput1">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Cliente</label>
                <select name="cliente" class="form-select" id="floatingSelect"
                    aria-label="Floating label select example">
                    <option selected>Selecione o cliente</option>
                    <?php
                    $sql = "SELECT * FROM cliente";
                    $resultado = mysqli_query($conn, $sql);
                    while ($dados = mysqli_fetch_assoc($resultado)) {
                    ?>
                    <option value="<?php echo $dados["nome"]; ?>"><?php echo $dados["nome"]; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Link do PDF do Briefing</label>
                <textarea class="form-control" name="briefing" id="exampleFormControlTextarea1" rows="3"></textarea>
            </div>

        </section>
        <button type="submit" name="cadastrarprojeto" class="btn btn-primary float-end">Cadastrar</button>
    </form>

</main><!-- End #main -->

<?php
$total_despesas_empresa = 0;
include('../footer.php');

?>
</body>

</html>