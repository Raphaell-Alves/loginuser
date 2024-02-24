<!--O TRECHO REQUIRE_ONCE ESTA INCLUINDO A NOSSA CONEXAO COM O BANCO DE DADOS, MINHA FLOR

ESSE IF GARANTE QUE O FORMULARIO SO SERA ENVIANDO QUANDO O BOTAO COM O NAME=ENVIAR SELECIONADO, TIVER O VALOR SIM (BOTAO NO FINAL DO FORM)

REQUIRE_ONCE Usuario.php É PARA INCLUIR O NOSSO ARQUIVO QUE CONTEM A FUNCTION DE LOGIN

$USUARIO = NEW Usuario, hmmmmmmm, É meio que uma folha, em que toda vez que voce cria um usuario, ela iria armazenar....... usuario novo, não se esqueça

$usuario-> é o metodo para voce chamar a nossa function de login, onde esta toda nossa verificacao

-->

<?php
require_once("conexao.php");
if(isset($_POST["enviar"]) and $_POST["enviar"]=="sim"){
    require_once("Usuario.php");
    $usuario = new Usuario();
    $usuario->login();
}
?>


<!-- HTML BASICO DE UM SIMPLES FORMULARIO DE LOGIN, ESTILIZAR EU VCU DEIXAR PARA VOCE, UM BEIJO 

VOU QUEBRAR UM POUCO SEU GALHO
-->


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    
    <style>
       
        form {
            margin: 50px auto;
            width: 300px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
        input[type="text"],
        input[type="password"],
        select {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 3px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            width: 100%;
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            margin: 10px 0;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

        <!-- METHODO POST PARA ENVIAR INFORMAÇÕES CONFIDENCIAIS -->

    <form  method="POST">
        <h2>Login</h2>

<!-- AQUI SERVE PARA VERIFICAR SE O PARAMETRO MENSAGEM TEM O VALOR DE 1, QUE REPRESENTA O PRIMEIRO ERRO1, EXIBE UMA MENSAGEM DE ERRO-->
        <?php if(isset($_GET['mensagem']) && $_GET['mensagem'] == 1): ?>
            <p style="color: red;">Credenciais inválidas. Por favor, tente novamente.</p>


            <!-- AQUI SERVE PARA VERIFICAR SE O PARAMETRO MENSAGEM TEM O VALOR DE 2, QUE REPRESENTA O SEGUNDO ERRO2, EXIBE UMA MENSAGEM DE ERRO
        
            E DAI POR DIANTE SE QUISER COLOCAR MAIS VERIFICAÇÕES COM MENSAGENS DE ERRO.
        -->

        <?php elseif(isset($_GET['mensagem']) && $_GET['mensagem'] == 2): ?>
            <p style="color: red;">Por favor, preencha todos os campos.</p>
        <?php endif; ?>



        
        <!-- INPUTS COMUNS
    
            UTILIZAR OS MESMOS ID DO BANCO E DA SUA LOGICA DE VERIFICAÇÃO
    -->


        <label for="usu_email">E-mail:</label>
        <input type="text" name="usu_email" id="usu_email" required>

        <label for="usu_pass">Senha:</label>
        <input type="password" name="usu_pass" id="usu_pass" required>

        <label for="status_id">Selecione o tipo de usuário:</label>
        <select name="status_id" id="status_id" required>
            <option value="">Selecione</option>
           
            <option value="1">Admin</option>
            <option value="2">Usuário</option>
        </select>


        <!-- ESSE É O BOTAO LA DO INICIO DO CODICO COM O NAME ENVIAR, E COM O SEU VALOR SIM -->
        <input type="submit" name="enviar" value="sim">
        
    </form>

    <!-- TUDO DENTRO DA TAG FORM -->
</body>
</html>
