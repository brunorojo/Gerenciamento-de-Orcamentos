<?php
session_start();
include_once "conexao.php";
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
   <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
</body>

</html>

<?php
// Tela de login
if (isset($_POST["logar"])) {
   $email = $_POST["email"];
   $senha = $_POST["senha"];

   $niveis = ['admin', 'dev', 'vendedor', 'bloq', 'Aguardando'];
   $redirects = ['admin/', 'desenvolvedor/', 'vendedor/', 'index.php?id=500', 'index.php?id=600'];

   foreach ($niveis as $index => $nivel) {
      $sql = "SELECT * FROM login WHERE email = '$email' AND senha = '$senha' AND nivel = '$nivel' and status=0;";
      $resultado = mysqli_query($conn, $sql);

      if (mysqli_num_rows($resultado) > 0) {
         $dados = mysqli_fetch_assoc($resultado);
         $_SESSION["logado"] = "logado";
         $_SESSION['usuario'] = $nivel;
         $_SESSION['nome'] = $dados['nome'];
         // $_SESSION['usuario'] = $nivel;


         if ($nivel === 'dev' || $nivel === 'vendedor') {

            $_SESSION['email'] = $dados["nome"];
            $_SESSION['id'] = $dados["id"];
         }

         echo "<script> window.location.href = '{$redirects[$index]}'; </script>";
         return;
      }
   }
   echo "<script> window.location.href = 'index.php?resultado=400'; </script>";
}

// tela de cadastro
if (isset($_POST["criar"])) {
   $nome = $_POST["nome"];
   $whatsapp = $_POST["whatsapp"];
   $email = $_POST["email"];
   $senha = $_POST["senha"];
   $nivel = $_POST["opcao"];
   $status = 1;
   $_SESSION['email'] = $nome;
   $desenvolvedor = $_SESSION['email'];

   $buscaEmail = "SELECT * FROM login WHERE email = '$email'";
   $resultbusca = mysqli_query($conn, $buscaEmail);

   if (mysqli_num_rows($resultbusca) > 0) {

      echo "
      <script>
       window.location.href = 'index.php?resultado=400';
      </script>
   ";

      exit();
   }


   if ($nivel == 'vendedor') {
      $sql = "INSERT INTO vendedor (nome, whatsapp, email) VALUES ('$nome', '$whatsapp', '$email')";
      $resultado = mysqli_query($conn, $sql);
   }

   $sql = "INSERT INTO login (nome, whatsapp, email, senha, nivel, status) VALUES ('$nome', '$whatsapp', '$email', '$senha', '$nivel', '1')";
   $resultado = mysqli_query($conn, $sql);

   if (isset($resultado)) {
      $sql = "SELECT whatsapp FROM login WHERE nivel = '$nivel'";
      $resultado = mysqli_query($conn, $sql);

      echo "
         <script>
          window.location.href = 'index.php?resultado=200';
         </script>
      ";
   }
}

// tela de cadastro para admin
if (isset($_POST["cadastraradmin"])) {
   $nome = $_POST["nome"];
   $whatsapp = $_POST["whatsapp"];
   $email = $_POST["email"];
   $senha = $_POST["senha"];
   $admin = $_SESSION['email'];
   $sql = "INSERT INTO login (nome, whatsapp, email, senha, nivel) VALUES ('$nome', '$whatsapp', '$email', '$senha', 'admin')";
   $resultado = mysqli_query($conn, $sql);

   if (isset($resultado)) {
      echo "
         <script>
          window.location.href = 'admin/novoadmin.php?resultado=200';
         </script>
      ";
   }
}

// tela de cadastro de projetos de clientes
if (isset($_POST["cadastrarprojeto"])) {
   $nome = $_POST["nome"];
   $cliente = $_POST["cliente"];
   $briefingpuro = $_POST["briefing"];
   $briefing = str_replace(" ", "", $briefingpuro);
   $data = date("Y-m-d");
   $sql = "INSERT INTO projeto (nome, cliente, briefing, status, data_inicio) VALUES ('$nome', '$cliente', '$briefing', 'Aguardando', '$data')";
   $resultado = mysqli_query($conn, $sql);

   if ($resultado) {
      echo "
      <script>
      window.location.href = 'admin/novoprojeto.php?resultado=200';
      </script>
   ";
   } else {
      echo "erro" . mysqli_error($conn);
   }
}


// tela de cadastro de projetos de vendedores
if (isset($_POST["cadastrarprojetovendedor"])) {
   $nome = $_POST["nome"];
   $briefing = $_POST["briefing"];
   $briefingpuro = $_POST["briefing"];
   $briefing = str_replace(" ", "", $briefingpuro);


   $data = date("d-m-y");
   $sql = "INSERT INTO projeto (nome, cliente, briefing, status, data_inicio) VALUES ('$nome', ' $_SESSION[email]', '$briefing', 'Aguardando', '$data')";
   $resultado = mysqli_query($conn, $sql);

   if (isset($resultado)) {

      $sql = "SELECT whatsapp FROM login WHERE nivel = 'dev'";
      $resultado = mysqli_query($conn, $sql);

      echo "
         <script>
          window.location.href = 'vendedor/novoprojeto.php?resultado=200';
         </script>
      ";
   }
}


// tela de cadastro de clientes

if (isset($_POST["cadastrarcliente"])) {
   $nome = $_POST["nome"];
   $whatsapp = $_POST["whatsapp"];
   $email = $_POST["email"];
   $senha = $_POST["senha"];
   $projeto = $_POST["projeto"];

   $sql = "INSERT INTO cliente (nome, whatsapp, email, senha) VALUES ('$nome', '$whatsapp', '$email', '$senha')";
   $resultado = mysqli_query($conn, $sql);


   if (isset($resultado)) {
      echo "

         <script>


          window.location.href = 'admin/novocliente.php?resultado=200';


         </script>

      ";
   }
}

// tela de cadastro de clientes 2

if (isset($_POST["cadastrarcliente2"])) {
   $nome = $_POST["nome"];
   $whatsapp = $_POST["whatsapp"];
   $email = $_POST["email"];
   $senha = $_POST["senha"];
   $projeto = $_POST["projeto"];

   $sql = "INSERT INTO cliente (nome, whatsapp, email, senha) VALUES ('$nome', '$whatsapp', '$email', '$senha')";
   $resultado = mysqli_query($conn, $sql);


   if (isset($resultado)) {
      echo "

         <script>


          window.location.href = 'vendedor/novocliente.php?resultado=200';


         </script>

      ";
   }
}

// tela de cadastro de vendedores

if (isset($_POST["cadastrarvendedor"])) {
   $nome = $_POST["nome"];
   $whatsapp = $_POST["whatsapp"];
   $email = $_POST["email"];
   $senha = $_POST["senha"];
   $projeto = $_POST["projeto"];

   $sql = "INSERT INTO vendedor (nome, whatsapp, email, senha) VALUES ('$nome', '$whatsapp', '$email', '$senha')";
   $resultado = mysqli_query($conn, $sql);



   if (isset($resultado)) {
      echo "

         <script>


          window.location.href = 'admin/novovendedor.php?resultado=200';


         </script>

      ";
   }
}

// tela de cadastro de despesas

if (isset($_POST["cadastrardespesa"])) {
   $nome = $_POST["nome"];
   $valor = $_POST["valor"];
   $total_parcelas = $_POST["total_parcelas"];
   $descricao = $_POST["descricao"];

   foreach ($_POST['data_parcelas'] as $key => $value) {

      $data_p = $_POST['data_parcelas'][$key];
      $valor_p = $_POST['valor_parcelas'][$key];

      $sql = "INSERT INTO despesa (nome, valor, descricao, data_pagamento) VALUES ('$nome', $valor_p, '$descricao', '$data_p')";

      $resultado = mysqli_query($conn, $sql);
   }



   $sql = "INSERT INTO despesa (nome, valor, total_parcelas, descricao) VALUES ('$nome', '$valor', '$total_parcelas', '$descricao')";
   $resultado = mysqli_query($conn, $sql);

   if (isset($resultado)) {


      echo "

         <script>


          window.location.href = 'admin/novadespesa.php?resultado=200';


         </script>

      ";
   }
}

if (isset($_GET["confirmar_pagamento_despesa"])) {

   $sql = "UPDATE despesa SET status_pagamento = 1 WHERE id = '" . $_GET['despesa_id'] . "';";
   $resultado = mysqli_query($conn, $sql);

   echo "
   <script>
      window.location.href = 'admin/despesas.php';
   </script>
   ";
}

// Apagar projeto admin

if (isset($_GET["deletarprojeto"])) {
   $id = $_GET["deletarprojeto"];

   $sql = "DELETE FROM projeto WHERE id = '$id'";
   $resultado = mysqli_query($conn, $sql);

   if (isset($resultado)) {
      echo "

         <script>


          window.location.href = 'admin/projetos.php?resultado=200';


         </script>

      ";
   }
}

// Apagar projeto vendedor

if (isset($_GET["deletarprojetovendedor"])) {
   $id = $_GET["deletarprojetovendedor"];
   $sql = "DELETE FROM projeto WHERE id = '$id'";
   $resultado = mysqli_query($conn, $sql);

   if (isset($resultado)) {
      echo "

         <script>


          window.location.href = 'vendedor/index.php?resultado=200';


         </script>

      ";
   }
}

// Apagar projeto vendedor orçado
if (isset($_GET["deletarprojetoorcado"])) {
   $id = $_GET["deletarprojetoorcado"];
   $sql = "DELETE FROM projeto WHERE id = '$id'";
   $resultado = mysqli_query($conn, $sql);

   if (isset($resultado)) {
      echo "

         <script>


          window.location.href = 'vendedor/seusprojetos.php?resultado=200';


         </script>

      ";
   }
}

// Apagar cliente
if (isset($_GET["deletarcliente"])) {
   $id = $_GET["deletarcliente"];
   $sql = "DELETE FROM cliente WHERE id = '$id'";
   $resultado = mysqli_query($conn, $sql);

   if (isset($resultado)) {
      echo "

         <script>


          window.location.href = 'admin/clientes.php?apagarcliente=200';


         </script>

      ";
   }
}

// Apagar cliente 2
if (isset($_GET["deletarcliente2"])) {
   $id = $_GET["deletarcliente2"];
   $sql = "DELETE FROM cliente WHERE id = '$id'";
   $resultado = mysqli_query($conn, $sql);

   if (isset($resultado)) {
      echo "

         <script>


          window.location.href = 'vendedor/clientes.php?apagarcliente=200';


         </script>

      ";
   }
}

// Apagar vendedor
if (isset($_GET["deletarvendedor"])) {
   $id = $_GET["deletarvendedor"];
   $sql = "DELETE FROM vendedor WHERE id = '$id'";
   $resultado = mysqli_query($conn, $sql);

   if (isset($resultado)) {
      echo "

         <script>


          window.location.href = 'admin/vendedor.php?apagarcliente=200';


         </script>

      ";
   }
}

// Apagar candidato
if (isset($_GET["deletarcandidato"])) {
   $id = $_GET["deletarcandidato"];
   $sql = "DELETE FROM dados WHERE id = '$id'";
   $resultado = mysqli_query($conn, $sql);

   if (isset($resultado)) {
      echo "

         <script>


          window.location.href = 'admin/vendedor.php?apagarcliente=200';


         </script>

      ";
   }
}

// Apagar admin
if (isset($_GET["deletaradmin"])) {
   $id = $_GET["deletaradmin"];
   $sql = "DELETE FROM login WHERE id = '$id'";
   $resultado = mysqli_query($conn, $sql);

   if (isset($resultado)) {
      echo "

         <script>


          window.location.href = 'admin/admins.php?apagarcliente=200';


         </script>

      ";
   }
}

//editar clientes
if (isset($_POST["editarcliente"])) {

   $id = $_POST["id"];
   $nome = $_POST["nome"];
   $whatsapp = $_POST["whatsapp"];
   $email = $_POST["email"];


   $sql = "UPDATE cliente SET nome = '$nome', whatsapp = '$whatsapp', email = '$email' WHERE id = '$id'";
   $resultado = mysqli_query($conn, $sql);

   if (isset($resultado)) {
      echo "

         <script>


          window.location.href = 'admin/clientes.php?editarcliente=200';


         </script>

      ";
   }
}

//editar clientes
if (isset($_POST["editarcliente2"])) {

   $id = $_POST["id"];
   $nome = $_POST["nome"];
   $whatsapp = $_POST["whatsapp"];
   $email = $_POST["email"];


   $sql = "UPDATE cliente SET nome = '$nome', whatsapp = '$whatsapp', email = '$email' WHERE id = '$id'";
   $resultado = mysqli_query($conn, $sql);

   if (isset($resultado)) {
      echo "

         <script>


          window.location.href = 'vendedor/clientes.php?editarcliente=200';


         </script>

      ";
   }
}

//editar vendedor
if (isset($_POST["editarvendedor"])) {

   $id = $_POST["id"];
   $nome = $_POST["nome"];
   $whatsapp = $_POST["whatsapp"];
   $email = $_POST["email"];
   $senha = $_POST["senha"];


   $sql = "UPDATE vendedor SET nome = '$nome', whatsapp = '$whatsapp', email = '$email', senha = '$senha' WHERE id = '$id'";
   $resultado = mysqli_query($conn, $sql);

   if (isset($resultado)) {
      echo "

         <script>


          window.location.href = 'admin/vendedor.php?editarcliente=200';


         </script>

      ";
   }
}


//editar admin
if (isset($_POST["editaradmin"])) {

   $id = $_POST["id"];
   $nome = $_POST["nome"];
   $whatsapp = $_POST["whatsapp"];
   $email = $_POST["email"];
   $senha = $_POST["senha"];


   $sql = "UPDATE login SET nome = '$nome', whatsapp = '$whatsapp', email = '$email', senha = '$senha' WHERE id = '$id'";
   $resultado = mysqli_query($conn, $sql);

   if (isset($resultado)) {
      echo "

         <script>


          window.location.href = 'admin/admins.php?editaradmin=200';


         </script>

      ";
   }
}


// atualizar tabela projeto com os dados do desenvolvedor
if (isset($_POST["enviarvalor"])) {

   $id = $_POST["id"];


   $sql = "SELECT * FROM projeto WHERE id = '$id'";
   $resultado = mysqli_query($conn, $sql);

   while ($dados = mysqli_fetch_assoc($resultado)) {
      $status = $dados["status"];
      $nome = $dados["nome"];
      $cliente = $dados["cliente"];
      $briefing = $dados["briefing"];
      $nome = $dados["nome"];
   }
   if ($status == 'aprovado' or $status == 'orçado' or $status == 'iniciado' or $status == 'finalizado') {
      echo "<script>

      window.location.href = 'desenvolvedor/index.php?jaorçado=200';


      </script>";

      exit();
   }


   $desenvolvedor = $_SESSION['email'];

   $horas = $_POST["horas"];

   if ($horas <= 20) {
      $valordev = 25;
   } else {
      $valordev = 17;
   }

   $orcamento = $_POST["valordesenvolvedor"];


   if ($orcamento <= 2000) {
      $valorcliente = $orcamento + (60 / 100 * $orcamento) + 500;
   } else {
      $valorcliente = $orcamento + (50 / 100 * $orcamento) + 500;
   }

   $data_atual = date('d-m-Y');
   $dataentrega = $horas / 4;

   // Converte a data em um timestamp
   $timestamp = strtotime($data_atual);

   // Adiciona três dias ao timestamp
   $timestamp_final = $timestamp + ($dataentrega * 24 * 60 * 60);

   // Converte o timestamp final em uma data no formato desejado
   $data_final = date("Y-m-d", $timestamp_final);

   $lucroempresa = $valorcliente - $orcamento;

   //codigo comentado
   $sql = "UPDATE projeto SET desenvolvedor = '$desenvolvedor',
    valordev = '$orcamento', valorcliente = '$valorcliente', lucroempresa =
     '$lucroempresa', status='orçado', dataentrega='$dataentrega' WHERE id = '$id'";
   $resultado = mysqli_query($conn, $sql);

   $dev_id = $_SESSION['id'];

   $observacao = isset($_POST['observacao']) ? $_POST['observacao'] : null;
   $observacao = base64_encode(htmlentities($observacao));

   $sql = "INSERT INTO
               orcamentos (projeto_id, dev_id, dev, valor_dev, valor_cliente, lucro_empresa, orc_status, data_entrega, observacao)
            VALUES($id, $dev_id, '$desenvolvedor', '$orcamento', '$valorcliente', '$lucroempresa','orçado', '$dataentrega', '$observacao');";
   $resultado = mysqli_query($conn, $sql);


   if (isset($resultado)) {

      $sql = "SELECT whatsapp FROM login WHERE nivel = 'admin'";
      $resultado = mysqli_query($conn, $sql);

      while ($dados = mysqli_fetch_assoc($resultado)) {

         if ($api_whats_habilitada) :
            $curl = curl_init();

            curl_setopt_array($curl, array(
               CURLOPT_URL => $url_point_whats,
               CURLOPT_RETURNTRANSFER => true,
               CURLOPT_ENCODING => "",
               CURLOPT_MAXREDIRS => 10,
               CURLOPT_TIMEOUT => 0,
               CURLOPT_FOLLOWLOCATION => true,
               CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
               CURLOPT_CUSTOMREQUEST => "POST",
               CURLOPT_POSTFIELDS => "",
               CURLOPT_HTTPHEADER => array(
                  "Content-Type: application/x-www-form-urlencoded"
               ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            echo $response;
         endif;
      }


      echo "

        <script>


         window.location.href = 'desenvolvedor/index.php?orcamentoenviado=200';


        </script>

    ";
   }


   $sql = "SELECT * FROM projeto WHERE id = '$id'";
   $resultado = mysqli_query($conn, $sql);

   while ($dados = mysqli_fetch_assoc($resultado)) {
      $cliente = $dados["cliente"];
      $nome = $dados["nome"];
   }

   $sql = "SELECT whatsapp FROM cliente WHERE nome = '$cliente'";
   $resultado = mysqli_query($conn, $sql);



   echo "

        <script>


         window.location.href = 'desenvolvedor/index.php?orcamentoenviado=200';


        </script>

    ";
}



// atualizar status do projeto para aprovado
if (isset($_GET["aprovarprojeto"])) {
   $id = $_GET["aprovarprojeto"];
   $sql = "UPDATE projeto SET status = 'aprovado', data_inicio = '" . date('Y-m-d H:i:s') . "' WHERE id = '$id'";
   $resultado = mysqli_query($conn, $sql);


   if (isset($resultado)) {


      if (isset($_GET['orcamento_id'])) :
         /* add dados do orcamento ao projeto */
         $sql = "SELECT * FROM orcamentos WHERE id = " . $_GET['orcamento_id'];
         $resultado = mysqli_query($conn, $sql);
         $dados_orc = mysqli_fetch_object($resultado);

         $sql = "UPDATE projeto SET
            desenvolvedor = '" . $dados_orc->dev . "',
            valordev = " . $dados_orc->valor_dev . ",
            valorcliente = " . $dados_orc->valor_cliente . ",
            lucroempresa = '" . $dados_orc->lucro_empresa . "',
            dataentrega = '" . $dados_orc->data_entrega . "'
            WHERE id = '$id'";
         $resultado = mysqli_query($conn, $sql);

         $sql = "DELETE FROM orcamentos WHERE projeto_id = $id && id != " . $dados_orc->id;
         $resultado = mysqli_query($conn, $sql);

      else :

         $sql = "SELECT * FROM projeto WHERE id = '$id'";
         $resultado = mysqli_query($conn, $sql);
         $dados_x = mysqli_fetch_object($resultado);

         $sql = "DELETE FROM orcamentos
            WHERE projeto_id = $id && dev != '" . $dados_x->desenvolvedor . "';";
         $resultado = mysqli_query($conn, $sql);
      endif;


      /* ======== */
      $sql = "SELECT * FROM projeto WHERE id = '$id'";
      $resultado = mysqli_query($conn, $sql);



      while ($dados = mysqli_fetch_assoc($resultado)) {
         $desenvolvedor = $dados["desenvolvedor"];
         $projeto = $dados["nome"];
         $lucroempresa = $dados['lucroempresa'];
         $status = $dados['status'];
      }

      // adicionar parcelas
      if (isset($_GET['total_parcelas'])) {
         $total_parcelas = intval($_GET['total_parcelas']);
         $valor_parcela = $lucroempresa / $total_parcelas;

         $sql_remover_repeditos = "DELETE FROM lucro_empresa WHERE projeto_id = $id;";
         mysqli_query($conn, $sql_remover_repeditos);

         $sql_add_parcelas = '';
         for ($i = 1; $i <= $total_parcelas; $i++) {
            $data_parcela = date('Y-m-d', strtotime(date('Y-m-d') . " + " . ($i - 1) . " months"));
            $sql_add_parcelas = "INSERT INTO lucro_empresa (total_parcela, valor_parcela, projeto_id, data_parcela) VALUES ($total_parcelas, $valor_parcela, $id, '$data_parcela');";
            mysqli_query($conn, $sql_add_parcelas);
         }
      }


      //
      $sql = "SELECT * FROM login WHERE nome = '$desenvolvedor'";
      $resultado = mysqli_query($conn, $sql);

      while ($dados = mysqli_fetch_assoc($resultado)) {
         $whatsapp = $dados["whatsapp"];
         $nome = $dados["nome"];
      }


      if ($_SESSION['usuario'] == 'admin') :
         echo "
        <script>
               window.location.href = 'admin/projetos.php?aprovado=200';
         </script>
      ";
      endif;
      if ($_SESSION['usuario'] == 'vendedor') :
         echo "
        <script>
               window.location.href = 'vendedor/projetosfechados.php?aprovado=200';
         </script>
      ";
      endif;
   }
}



// Inciar projeto  aprovado
if (isset($_GET["iniciarprojeto"])) {
   $id = $_GET["iniciarprojeto"];

   $sql = "SELECT * FROM projeto WHERE id = '$id'";
   $resultado = mysqli_query($conn, $sql);

   while ($dados = mysqli_fetch_assoc($resultado)) {
      $valordev = $dados["valordev"];
      if ($dados["status"] == 'Aguardando' || $dados["status"] == 'orçado') {
         echo " <script>
       window.location.href = 'desenvolvedor/seusprojetos.php?resultado=550';
      </script>";
         // echo "Esse projeto ainda não foi aprovado!";
         exit;
      }
   }
   if ($valordev == '0') {
      echo "<script>
            alert('Você deve orçar o projeto antes de inciar');
                      window.location.href = 'desenvolvedor/seusprojetos.php';

       </script>";
   } else {
      $sql = "UPDATE projeto SET status = 'iniciado' WHERE id = '$id'";
      $resultado = mysqli_query($conn, $sql);

      $sql = "SELECT * from projeto WHERE id = '$id'";
      $resultado = mysqli_query($conn, $sql);

      while ($dados = mysqli_fetch_assoc($resultado)) {
         $desenvolvedor = $dados["desenvolvedor"];
         $nomeprojeto = $dados["nome"];
      }

      if (isset($resultado)) {

         $sql = "SELECT * FROM login WHERE nivel = 'admin'";
         $resultado = mysqli_query($conn, $sql);




         echo "

         <script>


          window.location.href = 'desenvolvedor/seusprojetos.php?iniciado=200';


         </script>

      ";
      }
   }
}

// Finalizar projeto
if (isset($_GET["finalizarprojeto"])) {
   $id = $_GET["finalizarprojeto"];

   $sql = "SELECT * from projeto WHERE id = '$id'";
   $resultado = mysqli_query($conn, $sql);

   $dados_projeto = mysqli_fetch_object($resultado);

   $sql = "SELECT * FROM projeto WHERE id = '$id'";
   $resultado = mysqli_query($conn, $sql);

   while ($dados = mysqli_fetch_assoc($resultado)) {
      $valordev = $dados["valordev"];
      if ($dados["status"] == 'Aguardando' || $dados["status"] == 'orçado') {
         echo " <script>
         window.location.href = 'desenvolvedor/seusprojetos.php?resultado=550';
        </script>";
         exit;
      }
   }

   $sql = "UPDATE projeto SET status = 'finalizado' WHERE id = '$id'";
   $resultado = mysqli_query($conn, $sql);



   $sql = "SELECT * from projeto WHERE id = '$id'";
   $resultado = mysqli_query($conn, $sql);

   while ($dados = mysqli_fetch_assoc($resultado)) {
      $desenvolvedor = $dados["desenvolvedor"];
      $nomeprojeto = $dados["nome"];
   }

   if (isset($resultado)) {

      $sql = "SELECT * FROM login WHERE nivel = 'admin'";
      $resultado = mysqli_query($conn, $sql);

      while ($dados = mysqli_fetch_assoc($resultado)) {

         $whatsapp = $dados["whatsapp"];
         $nome = $dados["nome"];

         if ($api_whats_habilitada) :
            $curl = curl_init();

            curl_setopt_array($curl, array(
               CURLOPT_URL => $url_point_whats,
               CURLOPT_RETURNTRANSFER => true,
               CURLOPT_ENCODING => "",
               CURLOPT_MAXREDIRS => 10,
               CURLOPT_TIMEOUT => 0,
               CURLOPT_FOLLOWLOCATION => true,
               CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
               CURLOPT_CUSTOMREQUEST => "POST",
               CURLOPT_POSTFIELDS => "",
               CURLOPT_HTTPHEADER => array(
                  "Content-Type: application/x-www-form-urlencoded"
               ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            echo $response;
         endif;
      }


      echo "

     <script>


      window.location.href = 'desenvolvedor/seusprojetos.php?iniciado=200';


     </script>

  ";
   }
}

// atualizar tabela projeto com os dados do desenvolvedor
if (isset($_POST["parcelar"])) {

   $id = $_POST["id"];
   $parcelas = $_POST["parcelas"];

   $sql = "SELECT * FROM projeto WHERE id = '$id'";
   $resultado = mysqli_query($conn, $sql);

   while ($dados = mysqli_fetch_assoc($resultado)) {
      $valorcliente = $dados["valorcliente"];
   }
   $resultado = $valorcliente / $parcelas;

   if ($parcela == 2) {
      $parcela2 = $resultado;


      $sql = "UPDATE projeto SET valorcliente = '$parcela', parcela2='$parcela2' WHERE id = '$id'";
      $resultado = mysqli_query($conn, $sql);
   }
   if ($parcela == 3) {
      $parcela2 = $resultado;
      $parcela3 = $resultado;
   }
   if ($parcela == 4) {
      $parcela2 = $resultado;
      $parcela3 = $resultado;
      $parcela4 = $resultado;
   }
}

if (isset($_POST["cadastrarcontato"])) {
   $nome = $_POST["nome"];
   $telefone = $_POST["telefone"];
   $projeto = $_POST["projeto"];

   $sql = "INSERT INTO contato (nome, telefone, projeto, status) VALUES('$nome', '$telefone', '$projeto', 'contato')";
   $resultado = mysqli_query($conn, $sql);


   echo "

     <script>


      window.location.href = 'vendedor/funil.php?contato';


     </script>

  ";
}

if (isset($_POST["enviarproposta"])) {

   $proposta = $_POST["valorproposta"];
   $id = $_POST["id"];

   $sql = "UPDATE contato SET proposta = '$proposta', status = 'proposta' WHERE id = '$id'";
   $resultado = mysqli_query($conn, $sql);


   echo "

     <script>


      window.location.href = 'vendedor/funil.php?proposta';


     </script>

  ";
}

if (isset($_POST["perdido"])) {
   $id = $_POST["id"];

   $sql = "UPDATE contato SET status = 'perdido' WHERE id = '$id'";
   $resultado = mysqli_query($conn, $sql);

   echo "

   <script>


    window.location.href = 'vendedor/funil.php?perdidos';


   </script>

";
}

if (isset($_POST["fechado"])) {
   $id = $_POST["id"];
   $sql = "UPDATE contato SET status = 'fechado' WHERE id = '$id'";
   $resultado = mysqli_query($conn, $sql);

   echo "

   <script>


    window.location.href = 'vendedor/funil.php?fechados';


   </script>

";
}

if (isset($_POST["extrairfechados"])) {
   $sql = "SELECT telefone FROM contato WHERE status = 'fechado'";
   $resultado = mysqli_query($conn, $sql);

   //Arquivo txt
   $arquivo = "contatos.txt";

   //abrir arquivo txt
   $arq = fopen($arquivo, "w");

   //faz consulta no banco de dados

   $cabecalho = "Clientes Fechados\n\n";

   fwrite($arq, $cabecalho);


   while ($escrever = mysqli_fetch_array($resultado)) {
      $conteudo = $escrever['telefone'] . "\n";

      //escreve no arquivo txt

      fwrite($arq, $conteudo);
   }
   echo "<script>

   window.location.href = 'contatos.txt';


   </script>";
   //fecha o arquivo
   fclose($arq);
}

if (isset($_POST["fechado"])) {
   $id = $_POST["id"];
   $sql = "UPDATE contato SET status = 'fechado' WHERE id = '$id'";
   $resultado = mysqli_query($conn, $sql);

   echo "

      <script>


       window.location.href = 'vendedor/funil.php?fechados';


      </script>

   ";
}

if (isset($_POST["extrairperdidos"])) {
   $sql = "SELECT telefone FROM contato WHERE status = 'perdido'";
   $resultado = mysqli_query($conn, $sql);

   //Arquivo txt
   $arquivo = "contatos.txt";

   //abrir arquivo txt
   $arq = fopen($arquivo, "w");

   //faz consulta no banco de dados

   $cabecalho = "Clientes Perdidos\n\n";

   fwrite($arq, $cabecalho);


   while ($escrever = mysqli_fetch_array($resultado)) {
      $conteudo = $escrever['telefone'] . "\n";

      //escreve no arquivo txt

      fwrite($arq, $conteudo);
   }
   echo "<script>

      window.location.href = 'contatos.txt';


      </script>";
   //fecha o arquivo
   fclose($arq);
}

//bloquear desenvolvedor

if (isset($_GET["bloqueardev"])) {
   $id = $_GET["bloqueardev"];

   $sql = "UPDATE login SET status = 1 WHERE id = '$id'";
   $resultado = mysqli_query($conn, $sql);

   echo "<script>

      window.location.href = 'admin/desenvolvedores.php';


      </script>";
}

//aprovar desenvolvedor

if (isset($_GET["aprovardev"])) {
   $id = $_GET["aprovardev"];

   $sql = "UPDATE login SET status = 0  WHERE id = '$id'";
   $resultado = mysqli_query($conn, $sql);

   echo "<script>
      window.location.href = 'admin/desenvolvedores.php';
      </script>";
}


/* Enviar orçamento para vendedor */
if (isset($_GET["encaminhar_orcamento_vendedor"])) {

   $id = $_GET["projeto_id"];
   $orcamento_id = $_GET['orcamento_id'];

   /* add dados do orcamento ao projeto */
   $sql = "SELECT * FROM orcamentos WHERE id = " . $orcamento_id;
   $resultado = mysqli_query($conn, $sql);
   $dados_orc = mysqli_fetch_object($resultado);

   $sql = "UPDATE projeto SET
      desenvolvedor = '" . $dados_orc->dev . "',
      valordev = " . $dados_orc->valor_dev . ",
      valorcliente = " . $dados_orc->valor_cliente . ",
      lucroempresa = '" . $dados_orc->lucro_empresa . "',
      dataentrega = '" . $dados_orc->data_entrega . "',
      status = 'orçado'
      WHERE id = '$id'";
   $resultado = mysqli_query($conn, $sql);

   // remover os orçamentos que não forem encaminhados
   $sql = "DELETE FROM orcamentos WHERE projeto_id = $id && id != " . $dados_orc->id;
   $resultado = mysqli_query($conn, $sql);

   echo "<script>
            alert('Projeto encaminhado para o vendedor!');
            window.location.href = 'admin/projetos.php';
         </script>";
}
