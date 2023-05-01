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
    <link rel="stylesheet" href="style.css" />

    <!-- FONT AWESOME -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />

    <!-- GOOGLE FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet" />
</head>

<style>
    :root {
        --bg-color: #f5f5f5;
        --bg-round-a: #1E537C;
        --bg-round-b: #1e537c;
        --panel-color: #fff;
        --title: #444;
        --bg-input: #e0e0e0;
        --input-icon: #8a8a8a;
        --input: #333;
        --input-hover: #222;
        --btn-color: #1e537c;
        --btn-text: #fff;
        --btn-hover: #4d84e2;
        --social-text: #444;
        --social-icon: #1E537C;
        --icon-color: #333;
        --check-text: #333;
        --check-hover: #333;
        --check-link: #4d84e2;
        --pass-color: #444;
        --key-color: #777;
        --pass-hover-color: #4d84e2;
        --keyboard-color: #e0e0e0;
        --key-letter: #333;
    }

    :root[data-theme="dark"] {
        --bg-color: #222;
        --bg-round-a: #4a4a4a;
        --bg-round-b: #2e2e2e;
        --panel-color: #fff;
        --title: #f2f2f2;
        --bg-input: #444;
        --input-icon: #ccc;
        --input: #ccc;
        --input-hover: #aaa;
        --btn-color: #333;
        --btn-text: #f2f2f2;
        --btn-hover: #444;
        --social-text: #ccc;
        --social-icon: #fff;
        --icon-color: #aaa;
        --check-text: #fff;
        --check-hover: #fff;
        --check-link: #5995fd;
        --pass-color: #fff;
        --pass-hover-color: #5995fd;
        --key-color: #f0f0f0;
        --keyboard-color: #444;
        --key-letter: #fff;
    }

    * {
        padding: 0;
        margin: 0;
        box-sizing: border-box;
        font-family: "Poppins", sans-serif;
    }

    .container {
        position: relative;
        width: 100%;
        min-height: 100vh;
        background-color: var(--bg-color);
        overflow: hidden;
    }

    .container:before {
        content: "";
        position: absolute;
        width: 2000px;
        height: 2000px;
        border-radius: 50%;
        background: linear-gradient(-45deg, var(--bg-round-a), var(--bg-round-b));
        top: -10%;
        right: 48%;
        transform: translateY(-50%);
        z-index: 6;
        transition: 1.8s ease-in-out;
    }

    .forms-container {
        position: absolute;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
    }

    .signin-signup {
        position: absolute;
        top: 50%;
        left: 75%;
        transform: translate(-50%, -50%);
        width: 50%;
        display: grid;
        grid-template-columns: 1fr;
        z-index: 5;
        transition: 1s 0.7s ease-in-out;
    }

    form {
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        padding: 0 5rem;
        overflow: hidden;
        grid-column: 1 / 2;
        grid-row: 1 / 2;
        transition: 0.2s 0.7s ease-in-out;
    }

    form.sign-in-form {
        z-index: 2;
    }

    form.sign-up-form {
        z-index: 1;
        opacity: 0;
    }

    /* MODAL */
    .btn-modal {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background: pink;
        font-size: 20px;
        color: white;
        padding: 10px 30px;
        cursor: pointer;
    }

    #popUpBox {
        width: 500px;
        overflow: hidden;
        background: pink;
        box-shadow: 0 0 10px black;
        border-radius: 10px;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 9999;
        padding: 10px;
        text-align: center;
        display: none;
    }

    .title {
        font-size: 2.2rem;
        color: var(--title);
        margin-bottom: 10px;
    }

    .input-field {
        width: 85%;
        height: 55px;
        background-color: var(--bg-input);
        margin: 10px 0;
        border-radius: 55px;
        display: grid;
        grid-template-columns: 15% 70% 15%;
        padding: 0 0.4rem;
    }

    .input-field i {
        text-align: center;
        line-height: 55px;
        color: var(--input-icon);
        font-size: 1.1rem;
    }

    .key {
        color: var(--key-color);
        text-decoration: none;
    }

    .key:hover {
        color: var(--pass-hover-color);
    }

    .pass {
        margin: 12px 0;
        color: var(--pass-color);
    }

    .pass:hover {
        color: var(--pass-hover-color);
    }

    #togglePassword {
        text-align: center;
        color: var(--input-icon);
    }

    #toggleReg {
        text-align: center;
        color: var(--input-icon);
    }

    .input-field input {
        background: none;
        outline: none;
        border: none;
        line-height: 1;
        font-weight: 600;
        font-size: 1.1rem;
        color: var(--input);
    }

    .input-field input::placeholder {
        color: var(--input-hover);
        font-weight: 500;
    }

    .btn {
        width: 150px;
        height: 49px;
        border: none;
        outline: none;
        border-radius: 49px;
        cursor: pointer;
        background-color: var(--btn-color);
        color: var(--btn-text);
        text-transform: uppercase;
        font-weight: 600;
        margin: 10px 0;
        transition: 0.5s;
    }

    .btn:hover {
        background-color: var(--btn-hover);
    }

    .check {
        display: block;
        position: relative;
        margin: 12px 0;
        cursor: pointer;
        font-size: 16px;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }

    .checkmark {
        color: var(--check-text);
    }

    .checkmark a {
        color: var(--check-link);
        text-decoration: underline;
    }

    .checkmark a:hover {
        color: var(--check-hover);
    }

    .social-text {
        padding: 0.7rem 0;
        font-size: 1rem;
        color: var(--social-text);
    }

    .social-media {
        display: flex;
        justify-content: center;
    }

    .social-icon {
        height: 46px;
        width: 46px;
        border: 1px solid var(--icon-color);
        margin: 0 0.45rem;
        display: flex;
        justify-content: center;
        align-items: center;
        text-decoration: none;
        color: var(--icon-color);
        font-size: 1.1rem;
        border-radius: 50%;
        transition: 0.3s;
    }

    .social-icon:hover {
        color: var(--social-icon);
        border-color: var(--social-icon);
    }

    .icon-mode {
        height: 32px;
        width: 32px;
        border: 1px solid var(--icon-color);
        margin: 40px 5px 0 5px;
        display: flex;
        justify-content: center;
        align-items: center;
        text-decoration: none;
        color: var(--icon-color);
        font-size: 1rem;
        border-radius: 50%;
        transition: 0.3s;
    }

    .icon-mode:hover {
        color: var(--social-icon);
        border-color: var(--social-icon);
    }

    .text-mode {
        padding: 0.5rem 0;
        font-size: 0.8rem;
        font-style: italic;
        color: var(--social-text);
    }

    .panels-container {
        position: absolute;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        display: grid;
        grid-template-columns: repeat(2, 1fr);
    }

    .panel {
        display: flex;
        flex-direction: column;
        align-items: flex-end;
        justify-content: space-around;
        text-align: center;
        z-index: 7;
    }

    .left-panel {
        pointer-events: all;
        padding: 3rem 17% 2rem 12%;
    }

    .right-panel {
        pointer-events: none;
        padding: 3rem 12% 2rem 17%;
    }

    .panel .content {
        color: var(--panel-color);
        transition: 0.9s 0.6s ease-in-out;
    }

    .panel h3 {
        font-weight: 600;
        line-height: 1;
        font-size: 1.5rem;
    }

    .panel p {
        font-size: 0.95rem;
        padding: 0.7rem 0;
    }

    .btn.transparent {
        margin: 0;
        background: none;
        border: 2px solid #fff;
        width: 130px;
        height: 41px;
        font-weight: 600;
        font-size: 0.8rem;
    }

    .image {
        width: 90%;
        margin-top: 10px;
        transition: 1.1s 0.4s ease-in-out;
    }

    .right-panel .content,
    .right-panel .image {
        transform: translateX(800px);
    }

    /* ANIMATION */
    .container.sign-up-mode:before {
        transform: translate(100%, -50%);
        right: 52%;
    }

    .container.sign-up-mode .left-panel .image,
    .container.sign-up-mode .left-panel .content {
        transform: translateX(-800px);
    }

    .container.sign-up-mode .right-panel .content,
    .container.sign-up-mode .right-panel .image {
        transform: translateX(0px);
    }

    .container.sign-up-mode .left-panel {
        pointer-events: none;
    }

    .container.sign-up-mode .right-panel {
        pointer-events: all;
    }

    .container.sign-up-mode .signin-signup {
        left: 25%;
    }

    .container.sign-up-mode form.sign-in-form {
        z-index: 1;
        opacity: 0;
    }

    .container.sign-up-mode form.sign-up-form {
        z-index: 2;
        opacity: 1;
    }

    /* KEYBOARD */
    .keyboard {
        position: fixed;
        left: 0;
        bottom: 0;
        width: 100%;
        padding: 5px 0;
        background: var(--keyboard-color);
        box-shadow: 0 0 50px rgba(0, 0, 0, 0.5);
        user-select: none;
        transition: bottom 0.4s;
        z-index: 999;
    }

    .keyboard--hidden {
        bottom: -100%;
    }

    .keyboard__keys {
        text-align: center;
    }

    .keyboard__key {
        height: 45px;
        width: 6%;
        max-width: 90px;
        margin: 3px;
        border-radius: 4px;
        border: none;
        background: rgba(255, 255, 255, 0.2);
        color: var(--key-letter);
        font-size: 1.05rem;
        outline: none;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        vertical-align: top;
        padding: 0;
        -webkit-tap-highlight-color: transparent;
        position: relative;
    }

    .keyboard__key:active {
        background: rgba(255, 255, 255, 0.12);
    }

    .keyboard__key--wide {
        width: 12%;
    }

    .keyboard__key--extra-wide {
        width: 36%;
        max-width: 500px;
    }

    .keyboard__key--activatable::after {
        content: "";
        top: 10px;
        right: 10px;
        position: absolute;
        width: 8px;
        height: 8px;
        background: rgba(0, 0, 0, 0.4);
        border-radius: 50%;
    }

    .keyboard__key--active::after {
        background: #08ff00;
    }

    .keyboard__key--dark {
        background: rgba(0, 0, 0, 0.25);
    }

    /* MEDIA SCREEN */
    @media (max-width: 870px) {
        .container {
            min-height: 800px;
            height: 100vh;
        }

        .container::before {
            width: 1500px;
            height: 1500px;
            left: 30%;
            bottom: 68%;
            transform: translateX(-50%);
            right: initial;
            top: initial;
            transition: 2s ease-in-out;
        }

        .signin-signup {
            width: 100%;
            left: 50%;
            top: 80%;
            transform: translate(-50%, -100%);
            transition: 1s 0.8s ease-in-out;
        }

        .panels-container {
            grid-template-columns: 1fr;
            grid-template-rows: 1fr 2fr 1fr;
        }

        .panel {
            flex-direction: row;
            justify-content: space-around;
            align-items: center;
            padding: 2.5rem 8%;
        }

        .panel .content {
            padding-right: 15%;
            transition: 0.9s 0.8s ease-in-out;
        }

        .panel h3 {
            font-size: 1.2rem;
        }

        .panel p {
            font-size: 0.7rem;
            padding: 0.5rem 0;
        }

        .btn.transparent {
            width: 110px;
            height: 35px;
            font-size: 0.7rem;
        }

        .image {
            display: none;
        }


        .left-panel {
            grid-row: 1 / 2;
        }

        .right-panel {
            grid-row: 3 / 4;
        }

        .right-panel .content,
        .right-panel .image {
            transform: translateY(300px);
        }

        .container.sign-up-mode:before {
            transform: translate(-50%, 100%);
            bottom: 32%;
            right: initial;
        }

        .container.sign-up-mode .left-panel .image,
        .container.sign-up-mode .left-panel .content {
            transform: translateY(-300px);
        }

        .container.sign-up-mode .signin-signup {
            top: 5%;
            transform: translate(-50%, 0);
            left: 50%;
        }

        .keyboard,
        .key {
            opacity: 0;
            visibility: hidden;
            font-size: 0.1px;
        }
    }

    @media (max-width: 570px) {

        form {
            padding: 0 1.5rem;
        }

        .image {
            display: none;
        }

        .panel .content {
            padding: 0.5rem 1rem;
        }

        .panel p {
            opacity: 0;
        }

        .container:before {
            bottom: 75%;
            left: 50%;
        }

        .container.sign-up-mode:before {
            bottom: 24%;
            left: 50%;
        }

        .field-icon {
            float: right;
            margin-left: 300px;
            margin-top: -55px;
            position: relative;
            z-index: 1;
        }
    }

    @media (max-width: 385px) {
        .field-icon {
            float: right;
            margin-left: 260px;
            margin-top: -55px;
            position: relative;
            z-index: 1;
        }
    }

    @media (max-width: 350px) {
        .field-icon {
            float: right;
            margin-left: 200px;
            margin-top: -55px;
            position: relative;
            z-index: 1;
        }
    }
</style>

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
                        <input type="password" name="senha" autocomplete="off" placeholder="Senha" id="id_password" required="yes" />
                        <i class="far fa-eye" id="togglePassword" style="cursor: pointer;"></i>
                    </div>
                    <input type="submit" value="Entrar" name="logar" class="btn solid" />
                </form>


                <form action="scripts.php" method="POST" class="sign-up-form">
                    <h2 class="title">Crie a sua conta</h2>
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="text" name="nome" autocomplete="off" placeholder="Nome completo" required="yes" />
                    </div>
                    <div class="input-field">
                        <i class="fas fa-phone"></i>
                        <input type="number" name="whatsapp" maxlength="10" autocomplete="off" placeholder="Whatsapp" required="no" />
                    </div>
                    <div class="input-field">
                        <i class="fas fa-envelope"></i>
                        <input type="email" name="email" autocomplete="off" placeholder="E-mail" required="yes" />
                    </div>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="senha" autocomplete="off" placeholder="Senha" id="id_reg" required="yes" />
                        <i class="far fa-eye" id="toggleReg" style="cursor: pointer;"></i>
                    </div>
                    <br />
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="opcao" value="Aguardando" id="flexRadioDefault1" />
                        <label class="form-check-label" for="flexRadioDefault1">
                            Eu sou desenvolvedor
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" value="Aguardando" type="radio" name="opcao" id="flexRadioDefault2" checked />
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

    <script src="main.js"></script>

</body>


<script>
    const sign_in_btn = document.querySelector("#sign-in-btn");
    const sign_up_btn = document.querySelector("#sign-up-btn");
    const container = document.querySelector(".container");

    sign_up_btn.addEventListener("click", () => {
        container.classList.add("sign-up-mode");
    });

    sign_in_btn.addEventListener("click", () => {
        container.classList.remove("sign-up-mode");
    });

    const htmlEl = document.getElementsByTagName("html")[0];
    const currentTheme = localStorage.getItem("theme") ?
        localStorage.getItem("theme") :
        null;
    if (currentTheme) {
        htmlEl.dataset.theme = currentTheme;
    }
    const toggleTheme = (theme) => {
        htmlEl.dataset.theme = theme;
        localStorage.setItem("theme", theme);
    };

    const togglePassword = document.querySelector("#togglePassword");
    const password = document.querySelector("#id_password");

    togglePassword.addEventListener("click", function(e) {
        const type =
            password.getAttribute("type") === "password" ? "text" : "password";
        password.setAttribute("type", type);
        this.classList.toggle("fa-eye-slash");
    });

    const toggleReg = document.querySelector("#toggleReg");
    const pass = document.querySelector("#id_reg");

    toggleReg.addEventListener("click", function(e) {
        const type = pass.getAttribute("type") === "password" ? "text" : "password";
        pass.setAttribute("type", type);
        this.classList.toggle("fa-eye-slash");
    });
</script>