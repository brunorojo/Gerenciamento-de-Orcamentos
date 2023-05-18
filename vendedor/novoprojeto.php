<?php
session_start();
require_once "_autorize_vendedor.php";
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
        <h1>Cadastro de Projetos</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">Enviar projeto para desenvolvedores</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <form action="../scripts.php" method="POST">

        <section class="section dashboard">
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Nome do Projeto</label>
                <input type="text" name="nome" class="form-control" id="exampleFormControlInput1" />
            </div>

            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Link do PDF do Briefing</label>
                <textarea class="form-control" name="briefing" id="exampleFormControlTextarea1" rows="3"></textarea>
            </div>

        </section>
        <button type="submit" name="cadastrarprojetovendedor" class="btn btn-primary float-end">Cadastrar</button>
    </form>

</main><!-- End #main -->
<?php 
    $total_despesas_empresa =0;
    include ('../footer.php');

?>

</body>

</html>