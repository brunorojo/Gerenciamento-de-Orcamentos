<?php
session_start();
require_once "_autorize_admin.php";
include_once "../header.php";
?>


<main id="main" class="main">

    <div class="pagetitle">
        <h1>Parceiros</h1>

        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="index.php">Home</a>
                </li>
                <li class="breadcrumb-item active">Parceiros</li>

            </ol>
        </nav>
    </div>


    <div class="col-12 mt-4">
        <div class="card recent-sales overflow-auto">


            <div class="card-body">
                <h5 class="card-title">Desenvolvedores</h5>

                <table class="table table-borderless">
                    <thead>
                        <tr>
                            <th scope="col">Nome</th>
                            <th scope="col">Whatsapp</th>
                            <th scope="col">E-mail</th>
                            <th scope="col">Senha</th>
                            <th scope="col">Nivel</th>
                            <th scope="col">Status</th>
                            <th scope="col">Bloquear</th>
                            <th scope="col">Aprovar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM login";
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
                                    <?php echo $dados["nivel"]; ?>
                                </td>

                                <?php

                                switch ($dados['status']) {

                                    case (0):
                                        echo "<td>Ativo</td>";
                                        break;

                                    case (1):
                                        echo "<td>Bloqueado</td>";
                                        break;
                                }

                                ?>
                                <td>
                                    <a href="../scripts.php?bloqueardev=<?php echo $dados["id"]; ?>" onclick="if(!confirm('Deseja bloquear este usuário?')) event.preventDefault()">
                                        <span class="material-symbols-outlined text-danger">cancel</span>
                                    </a>
                                </td>
                                <td>
                                    <a href="../scripts.php?aprovardev=<?php echo $dados["id"]; ?>" onclick="if(!confirm('Deseja aprovar este usuário?')) event.preventDefault()">
                                        <span class="material-symbols-outlined text-success">done</span>
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
    ?>


</main><!-- End #main -->

<?php
$total_despesas_empresa = 0;
include('../footer.php');

?>

</body>

</html>