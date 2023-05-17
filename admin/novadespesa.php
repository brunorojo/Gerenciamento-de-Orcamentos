<?php
session_start();
require_once "_autorize_admin.php";
include_once "../header.php";
?>


    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Cadastro de Despesas</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active">
                        Desde pagamento de desenvolvedores até o salário no final do mês
                    </li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section dashboard">
            <form action="../scripts.php" method="POST">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Nome da despesa</label>
                    <input type="text" name="nome" class="form-control" id="exampleFormControlInput1" />
                </div>
                <div class="mb-3">
                    <label for="valor-despesa" class="form-label">Valor total da despesa</label>
                    <input type="number" name="valor" class="form-control" id="valor-despesa" />
                </div>
                <div class="mb-3">
                    <label for="total-parcelas" class="form-label">Total de parcelas</label>
                    <input type="number" name="total_parcelas" class="form-control" id="total-parcelas" value="" required />
                </div>


                <!-- Parcelas -->
                <div id="parcelas">
                    <!-- inner parcelas -->
                </div>


                <div class="form-floating">
                    <textarea name="descricao" class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"></textarea>
                    <label for="floatingTextarea2">Descrição da despesa</label>

                </div>
                <button type="submit" name="cadastrardespesa" class="btn btn-primary float-end mt-3">Cadastrar</button>
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
    $total_despesas_empresa =0;
    include ('../footer.php');

?>

    <!-- script para add parcelas -->
    <script>
        function obterDataParcela(meses) {

            meses--;

            let currentDate = new Date();

            let x = currentDate.setMonth(currentDate.getMonth() + meses);
            x = dateFormat = new Date(x);

            let dia = x.getDate();
            let mes = x.getMonth() + 1;
            mes = mes < 10 ? '0' + mes : mes;
            let ano = x.getFullYear();

            return `${ano}-${mes}-${dia}`;
        }


        function addParcelas() {
            let valor_despesa = document.getElementById('valor-despesa').value;
            let total_parcelas = document.getElementById('total-parcelas').value;

            let valor_parcela = valor_despesa / total_parcelas;
            valor_parcela = valor_parcela.toFixed(2)

            let el_parcelas = document.getElementById('parcelas')
            el_parcelas.innerHTML = '';


            for (let i = 1; i <= total_parcelas; i++) {

                let data_parcela= obterDataParcela(i);

                el_parcelas.innerHTML += `
                    <div class="mb-3">
                        <div class="fw-bold small mb-1">${i}º Parcela</div>
                        <div class="row">
                            <div class="col-6 col-lg-3">
                                <label for="ab${i}" class="form-label">Data de pagamento</label>
                                <input type="date" name="data_parcelas[]" class="form-control" id="ab${i}" value="${data_parcela}" required>
                            </div>
                            <div class="col-6 col-lg-2">
                                <label for="xy${i}" class="form-label">Valor</label>
                                <input type="number" name="valor_parcelas[]" class="form-control" id="xy${i}" value="${valor_parcela}" required>
                            </div>
                        </div>
                    </div>
                `

            }

        }

        document.getElementById('valor-despesa').onkeyup = function() {
            addParcelas();
        }
        document.getElementById('total-parcelas').onkeyup = function() {
            addParcelas();
        }
    </script>

</body>

</html>