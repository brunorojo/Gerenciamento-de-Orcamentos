<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>RETENÇÃO DE ORÇAMENTOS</title>
    <meta content="" name="description" />
    <meta content="" name="keywords" />

    <!-- Favicons -->
    <link href="imagens/brfavicon.ico" rel="icon" />

    <!-- CUSTOM CSS -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="assets/css/style.css" />

    <!-- FONT AWESOME -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />

    <!-- GOOGLE FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800&display=swap"
        rel="stylesheet" />
</head>

<body>
    <div class="container">
        <div class="forms-container">

            <div class="signin-signup">
                <form action="scripts.php" method="POST" class="sign-in-form">
                    <h2 class="title">Acesse sua conta</h2>
                    <?php
                    if (isset($_GET["resultado"])) {
                        $resultado = $_GET["resultado"];
                        if ($resultado == 400) {
                            echo "<center><p style='color: red;'>E-mail ou senha incorreto.</p></center>";
                        }
                    }
                    if (isset($_GET["id"])) {
                        $resultado = $_GET["id"];
                        if ($resultado == 500) {
                            echo "<center><p style='color: red;'>A sua conta está bloqueada.</p></center>";
                        }
                    }
                    if (isset($_GET["id"])) {
                        $resultado = $_GET["id"];
                        if ($resultado == 600) {
                            echo "<center><p style='color: red;'>A sua conta ainda não foi aprovada, entre em contato com o administrador.</p></center>";
                        }
                    }
                    ?>

                    <div class="input-field">
                        <i class="fas fa-envelope"></i>
                        <input type="text" name="email" autocomplete="off" placeholder="E-mail" required="yes" />
                    </div>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="senha" autocomplete="off" placeholder="Senha" id="id_password"
                            required="yes" />
                        <i class="far fa-eye" id="togglePassword" style="cursor: pointer;"></i>
                    </div>
                    <input type="submit" value="Entrar" name="logar" class="btn solid" />
                </form>


                <form action="scripts.php" method="post" class="sign-up-form">
                    <h2 class="title">Crie a sua conta</h2>
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="text" name="nome" autocomplete="off" placeholder="Nome completo" required="yes" />
                    </div>
                    <div class="input-field">
                        <i class="fas fa-phone"></i>
                        <input type="number" name="whatsapp" maxlength="10" autocomplete="off" placeholder="Whatsapp"
                            required="no" />
                    </div>
                    <div class="input-field">
                        <i class="fas fa-envelope"></i>
                        <input type="email" name="email" autocomplete="off" placeholder="E-mail" required="yes" />
                    </div>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="senha" autocomplete="off" placeholder="Senha" id="id_reg"
                            required="yes" />
                        <i class="far fa-eye" id="toggleReg" style="cursor: pointer;"></i>
                    </div>
                    <br />
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="opcao" value="dev" id="flexRadioDefault1" />
                        <label class="form-check-label" for="flexRadioDefault1">
                            Eu sou desenvolvedor
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" value="vendedor" type="radio" name="opcao" id="flexRadioDefault2" checked />
                        <label class="form-check-label" for="flexRadioDefault2">
                            Eu sou vendedor
                        </label>
                    </div>
                    <br />
                    <input type="submit" value="Criar Conta" name="criar" class="btn solid" />
                </form>

                <?php
                if (isset($_GET["resultado"])) {
                    $resultado = $_GET["resultado"];
                    if ($resultado == 200) {
                        echo "<script>
                            Swal.fire(
                            'Cadastro realizado com sucesso!',
                            'Aguarde a aprovação do administrador.',
                            'success'
                            )
                            </script>";
                    }else if($resultado==400){
                        echo "<script>
                            Swal.fire(
                            'Usuário já possui cadastro',
                            'Aguarde a aprovação do administrador.',
                            'error'
                            )
                            </script>";
                    }
                }
                ?>
            </div>
        </div>

        <div class="panels-container">
            <div class="panel left-panel">
                <div class="content">
                    <h3>Você não tem uma conta?</h3>
                    <p>Crie sua conta agora mesmo!</p>
                    <button class="btn transparent" id="sign-up-btn">Criar conta</button>
                </div>
            </div>

            <div class="panel right-panel">
                <div class="content">
                    <h3>já tem uma conta?</h3>
                    <p>Faça login agora mesmo :D</p>
                    <button class="btn transparent" id="sign-in-btn">Entrar</button>
                </div>
            </div>
        </div>
    </div>
</body>

<script src="assets/js/script.js"></script>