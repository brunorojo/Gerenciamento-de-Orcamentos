<?php
session_start();
require_once "_autorize_admin.php";
include_once "../header.php";
?>


<main id="main" class="main">

    <div class="pagetitle">
        <h1>Cadastro de admins</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">Cadastrar novo admin</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <form action="../scripts.php" method="POST">
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Nome completo</label>
                <input type="text" name="nome" class="form-control" id="exampleFormControlInput1" />
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Whatsapp</label>
                <input type="number" name="whatsapp" class="form-control" id="exampleFormControlInput1" />
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">E-mail</label>
                <input type="email" name="email" class="form-control" id="exampleFormControlInput1" />
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Senha</label>
                <input type="password" name="senha" class="form-control" id="exampleFormControlInput1" />
            </div>
            <button type="submit" name="cadastraradmin" class="btn btn-primary float-end">Cadastrar</button>
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
<?php
$total_despesas_empresa = 0;
include('../footer.php');

?>
</body>

</html>