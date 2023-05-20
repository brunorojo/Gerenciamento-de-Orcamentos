<?php
session_start();
require_once "_autorize_admin.php";
include_once "../header.php";
?>




<main id="main" class="main">
    <a href="novoadmin.php"><button type="button" class="btn btn-primary float-end">Novo Admin</button></a>

    <div class="pagetitle">
        <h1>Administradores</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active">Administradores</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">


        <!-- Recent Sales -->
        <div class="col-12">
            <div class="card recent-sales overflow-auto">


                <div class="card-body">
                    <h5 class="card-title">Admnistradores</h5>

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

                            $sql = "SELECT * FROM login WHERE nivel = 'admin'";
                            $resultado = mysqli_query($conn, $sql);

                            while ($dados = mysqli_fetch_assoc($resultado)) {

                            ?>
                                <tr>
                                    <td><?php echo $dados["nome"]; ?></td>
                                    <td><?php echo $dados["whatsapp"]; ?></td>
                                    <td><?php echo $dados["email"]; ?></td>
                                    <td><a href="editaradmin.php?id=<?php echo $dados["id"]; ?>"><span class="material-symbols-outlined text-warning">edit</span></a></td>
                                    <td><a href="../scripts.php?deletaradmin=<?php echo $dados["id"]; ?>" onclick="if(!confirm('Deseja remover este admin?')) event.preventDefault()"><span class="material-symbols-outlined text-danger">delete</span></a></td>
                                </tr>
                            <?php }; ?>
                        </tbody>
                    </table>

                </div>

            </div>
        </div><!-- End Recent Sales -->

    </section>

</main><!-- End #main -->


<?php
$total_despesas_empresa = 0;
include('../footer.php');
if (isset($_GET["editaradmin"])) {
    $editaradmin = $_GET["editaradmin"];
    if ($editaradmin == 200) {
        echo "<script>
        Swal.fire(
          'Alterado com sucesso',
          '',
          'success'
        )
        </script>";
    }
}

?>