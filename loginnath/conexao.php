<!-- CONEXAO COM O BANCO DE DADOS PHPADMIN -->


<!-- INICIA A SESSAO PRO DB -->
<?php
session_start();


//CLASSE CRIADA PARA LIDAR COM NOSSO BANCO DE DADOS
class Conectar {

    //ESSE TRECHO É PARA ACESSAR INFORMAÇÕES DO DB, É MEIO QUE UMA EXTENSAO DO PHP
    protected $dbh;


    // AQUI ESTABELECEMOS NOSSA CONEXAO COM O BANCO DE DADOS, NOME DO BANCO,HOST,ROOT,SENHA QUE ESTA EM BRANCO E ETC....

    // ESSE CATCH É PRA EXIBIR ERRO SE FALHAR A CONEXAO

    protected function Conexaoo() {
        try {
            $conectar = $this->dbh = new PDO("mysql:host=localhost;dbname=loginnath", "root", "");
            return $conectar;
        } catch (Exception $e) {
            print "¡Error BD!: " . $e->getMessage() . "<br/>";
            die();
        }
    }


    // USADO PARA DEFINIR O CARACTERES, PARA NAO TER NENHUM ERRO DE LETRAS COM O DB, UTIL
    public function set_names(){
        return $this->dbh->query("SET NAMES 'utf8'");
    }


    //ISSO DAQUI É UMA ROTA COM O VALOR DA SUA PAGINA INICIAL.
    
    //NO TRECHO DA LOGICA EM USUARIO.PHP, VOCE VAI ENTENDER MELHOR

    public static function rota(){
        return "http://localhost:80/loginnath/";
    }
}
?>
