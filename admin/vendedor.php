<?php
session_start();
require_once "_autorize_admin.php";
include_once "../header.php";
?>


<html>
<body>

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Vendedores Cadastrados</h1>

            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="index.html">Home</a>
                    </li>
                    <li class="breadcrumb-item active">Dashboard</li>

                </ol>
            </nav>
        </div>


        <div class="col-12 mt-4">
            <div class="card recent-sales overflow-auto">


                <div class="card-body">
                    <h5 class="card-title">Vendedores</h5>

                    <table class="table table-borderless">
                        <thead>
                            <tr>
                                <th scope="col">Nome</th>
                                <th scope="col">Whatsapp</th>
                                <th scope="col">E-mail</th>
                                <th scope="col">Editar</th>
                                <th scope="col">Apagar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT * FROM vendedor";
                            $resultado = mysqli_query($conn, $sql);

                            while ($dados = mysqli_fetch_assoc($resultado)) {

                                ?>
                                <tr>
                                    <td>
                                        <?php echo $dados["nome"]; ?>
                                    </td>
                                    <td>
                                        <?php echo $dados["whatsapp"]; ?>
                                    </td>
                                    <td>
                                        <?php echo $dados["email"]; ?>
                                    </td>
                                    <td>
                                        <a href="editarvendedor.php?id=<?php echo $dados["id"]; ?>">
                                            <span class="material-symbols-outlined text-warning">edit</span>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="../scripts.php?deletarvendedor=<?php echo $dados["id"]; ?>" onclick="if(!confirm('Deseja remover este vendedor?')) event.preventDefault()">
                                            <span class="material-symbols-outlined text-danger">delete</span>
                                        </a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>

                </div>

            </div>
        </div>

        <?php
        if (isset($_GET["apagarcliente"])) {
            $apagarcliente = $_GET["apagarcliente"];

            if ($apagarcliente == 200) {
                echo "<script>

      Swal.fire(
        'Apagado com sucesso!',
        '',
        'success'
      )

      </script>";
            }
        }

        if (isset($_GET["editarvendedor"])) {
            $apagarcliente = $_GET["editarvendedor"];

            if ($apagarcliente == 200) {
                echo "<script>

        Swal.fire(
          'Editado com sucesso',
          'Clique em ok para continuar',
          'success'
        )

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