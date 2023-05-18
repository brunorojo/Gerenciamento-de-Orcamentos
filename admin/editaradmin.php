<?php
session_start();
require_once "_autorize_admin.php";
include_once "../header.php";
?>


<main id="main" class="main">
    <div class="pagetitle">
        <h1>Alterar Administrador</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">Alterar informações do Administrador</li>
            </ol>
        </nav>
    </div>

    <section class="section dashboard">
        <?php
            $sql = "SELECT * FROM login WHERE id = '$_GET[id]'";
            $resultado = mysqli_query($conn, $sql);

            while ($dados = mysqli_fetch_assoc($resultado)) {

                ?>
        <form action="../scripts.php" method="POST">
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Nome completo</label>
                <input type="text" name="nome" value="<?php echo $dados["nome"]; ?>" class="form-control"
                    id="exampleFormControlInput1" />
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Whatsapp</label>
                <input type="number" name="whatsapp" value="<?php echo $dados["whatsapp"]; ?>" class="form-control"
                    id="exampleFormControlInput1" />
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">E-mail</label>
                <input type="email" name="email" value="<?php echo $dados["email"]; ?>" class="form-control"
                    id="exampleFormControlInput1" />
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Senha</label>
                <input type="password" value="<?php echo $dados["senha"]; ?>" name="senha" class="form-control"
                    id="exampleFormControlInput1" />
                <input type="hidden" name="id" value="<?php echo $dados["id"]; ?>" class="form-control"
                    id="exampleFormControlInput1" />

            </div>
            <button type="submit" name="editaradmin" class="btn btn-primary float-end">Confirmar</button>
        </form>
        <?php } ?>
    </section>
    <?php
        if (isset($_GET["editaradmin"])) {
            $resultado = $_GET["editaradmin"];

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
</main><!-- End #main -->

<?php 
    $total_despesas_empresa =0;
    include ('../footer.php');

?>

</body>

</html>