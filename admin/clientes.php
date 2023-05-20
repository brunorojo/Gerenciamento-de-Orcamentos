<?php
session_start();
require_once "_autorize_admin.php";
include_once "../header.php";
?>




<main id="main" class="main">
    <a href="novocliente.php">
        <button type="button" class="btn btn-primary float-end">Novo Cliente</button>
    </a>

    <div class="pagetitle">
        <h1>Clientes</h1>

        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="index.php">Home</a>
                </li>
                <li class="breadcrumb-item active">Clientes</li>

            </ol>
        </nav>
    </div>


    <div class="col-12 mt-4">
        <div class="card recent-sales overflow-auto">


            <div class="card-body">
                <h5 class="card-title">Clientes</h5>

                <table class="table table-borderless">
                    <thead>
                        <tr>
                            <th scope="col">Nome</th>
                            <th scope="col">Whatsapp</th>
                            <th scope="col">E-mail</th>
                            <th scope="col">Senha</th>
                            <th scope="col">Editar</th>
                            <th scope="col">Apagar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM cliente";
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
                                    <?php echo $dados["senha"]; ?>
                                </td>
                                <td>
                                    <a href="editarclientes.php?id=<?php echo $dados["id"]; ?>">
                                        <span class="material-symbols-outlined text-warning">edit</span>
                                    </a>
                                </td>
                                <td>
                                    <a href="../scripts.php?deletarcliente=<?php echo $dados["id"]; ?>" onclick="if(!confirm('Deseja remover este cliente?')) event.preventDefault()">
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

    if (isset($_GET["editarcliente"])) {
        $apagarcliente = $_GET["editarcliente"];

        if ($apagarcliente == 200) {
            echo "<script>
        Swal.fire(
          'Alterado com sucesso!',
          '',
          'success'
        )
        </script>";
        }
    }
    $total_despesas_empresa = 0;
    ?>


</main><!-- End #main -->
<?php
include('../footer.php');

?>


</body>

</html>