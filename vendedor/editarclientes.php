<?php
session_start();
include_once("../header.php");
?>


<main id="main" class="main">

    <div class="pagetitle">
        <h1>Alterar cliente</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">Alterar informações do cliente</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <?php
        $id = $_GET["id"];
        $sql = "SELECT * FROM cliente WHERE id = '$id'";
        $resultado = mysqli_query($conn, $sql);

        while ($dados = mysqli_fetch_assoc($resultado)) {

            ?>

    <section class="section dashboard">
        <form action="../scripts.php" method="POST">
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Nome cliente</label>
                <input type="text" value="<?php echo $dados["nome"]; ?>" name="nome" class="form-control"
                    id="exampleFormControlInput1" />
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Whatsapp</label>
                <input type="number" value="<?php echo $dados["whatsapp"]; ?>" name="whatsapp" class="form-control"
                    id="exampleFormControlInput1" />
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">E-mail</label>
                <input type="email" value="<?php echo $dados["email"]; ?>" name="email" class="form-control"
                    id="exampleFormControlInput1" />
                <input type="hidden" name="id" value="<?php echo $dados["id"]; ?>" />
            </div>
            <button type="submit" name="editarcliente2" class="btn btn-primary float-end mt-3">Confirmar</button>
        </form>
        <?php }
        ; ?>
    </section>

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



</main><!-- End #main -->


<?php 
    $total_despesas_empresa =0;
    include ('../footer.php');

?>

</body>

</html>