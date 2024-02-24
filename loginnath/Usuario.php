<?php 

// AQUI É O NOSSO PASSO DA LOGICA DE LOGIN...... PRESTE BASTANTE ATENÇÃO

// CRIANDO UMA CLASSE USUARIO, QUE VAI EXTENDER A CLASSE CONECTAR, OU SEJA, A CLASSE USUARIO
// VAI HERDAR TODOS O ACESSO DA CLASSE CONECTAR QUE ESTA NO NOSSO CONEXAO.PHP
// ISSO SERVE PARA CLASSE USUARIO TER ACESSO AS INFORMAÇÕES DO NOSSO DB
class Usuario extends Conectar{

    // FUNCTION DE LOGIN QUE A GENTE CHAMA LA NO INICIO DO NO INDEX.PHP
    public function login(){

        //AQUI ESTAMOS CRIANDO UMA VARIAVEL CONECTAR QUE ESTA ARMAZENANDO A NOSSA FUNCTION CONEXAOO
        // PARA ESTABELECER UMA CONEXAO COM O DB
        $conectar = parent::Conexaoo();
        //CHAMANDO A FUNCTION DE FORMATACAO DE CARACTERES
        parent::set_names();


        // VERIFICANDO SE O FORMULARIO FOI ENVIADO
        if(isset($_POST["enviar"])){

            //CRIANDO VARIAVEIS PARA OBTER OS VALORES DO FORMULARIO QUE FORAM CRIADAS NO DB
            //LEMBRE DOS IDS QUE VOCE COLOCOU NOS INPUTS, E ESSES MESMOS VALORES
            //TEM QUE ESTAR NAS COLUNAS DO SEU BANCO DE DADOS

            $email = $_POST["usu_email"];
            $pass = $_POST["usu_pass"];
            $status = $_POST["status_id"];


            //ESSE IF, VERIFICA SE AS INFORMAÇÕES PASSADAS NOS INPUTS, SAO VAZIAS, SE FOR, RETORNA PARA SEU INDEX.PHP
            //E EXIBE A MENSAGEM 2, PREENCHA OS CAMPOS OBRIGATORIOS
            //LEMBRA QUE EU TE FALEI DAS ROTAS?? ENTAO, É ISSO
            if(empty($email) and empty($pass)){
                header("Local: " . Conectar::rota() . "index.php?mensagem=2");
                exit();
            } else {
                // ESSA PARTE É UMA VERIFICACAO DO DB MEU BEM, PROVALVEMENTE VOCE VAI TER QUE
                //ESTUDAR UM POUCO MAIS AQUI, MAS NAO É BICHO DE 7 CABEÇAS
                //ISSO AQUI É A CONSULTA DO NOSSO DB, ONDE TEM O NOME DE TODAS NOSSAS COLUNAS
                //VOU ANEXAR UMA FOTO DO BANCO DE DADOS PHPMYADMIN
                $sql = "SELECT * FROM tm_usuario WHERE usu_email=? and usu_pass=? and status_id=? and estado=1";
                $stmt = $conectar->prepare($sql);
                $stmt->bindValue(1, $email);
                $stmt->bindValue(2, $pass);
                $stmt->bindValue(3, $status);
                $stmt->execute();
                $resultado = $stmt->fetch();

                //AQUI VERIFICA SE AS INFORMAÇÕES PRINCIPAIS DO USUARIO QUE FORAM ENVIADAS NO FORM
                //ESTAO NO DB
                //O USU_ID = CADA USUARIO QUE VOCE CRIAR, VAI TER UM ID DIFERENTE
                //O USU_NOME = NOME DO USUARIO
                //O STATUS_ID = PARA SABER SE É ADMIN OU USUARIO

                //SE TODAS ESSAS VERIFICAÇÕES ESTIVEREM 100% CORRETAS NO SEU DB
                //VOCE SERA REDIRECIONADO PARA A PAGINA DE BOAS VINDAS
                if(is_array($resultado) and count($resultado)>0){
                    $_SESSION["usu_id"] = $resultado["usu_id"];
                    $_SESSION["usu_nom"] = $resultado["usu_nom"];
                    $_SESSION["status_id"] = $resultado["status_id"];
                    
                    //ROTA CRIADA PARA PAGINA DE ACESSO, SE TUDO DEU CERTO
                    header("Location: " . Conectar::rota() ."bemvindo.php");
                    exit();
                } else {

                    // ROTA RETORNA PARA PAGINA INDEX.PHP QUE É O SEU LOGIN, E EXIBE A MENSAGEM DE ERRO1, CREDENCIAIS INVALIDAS, LEMBRA DESSA??
                    header("Location: " . Conectar::rota() ."index.php?mensagem=1");
                    exit();
                }
            }
        }
    }
}

?>