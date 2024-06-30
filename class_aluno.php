<?php 
class Aluno{

    private $pdo;

    //Conexao com o banco de dados
    public function __construct($dbname,$host,$user,$senha){
        try{
            $this->pdo = new PDO("mysql:dbname=".$dbname.";host=".$host,$user,$senha);
        }
        catch (PDOException $e){
            echo "Erro com banco de dados: ".$e->getMessage();
            exit();
        }
        catch (Exception $e){
            echo "Erro generico: ".$e->getMessage();
            exit();
        }
    }

    public function buscarDados(){
        $res = array();
        $cmd = $this->pdo->query("SELECT * FROM tbl_aluno ORDER BY cod_aluno DESC");
        $res = $cmd->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }

    public function cadastrarAluno($nome, $sobrenome, $idade, $telefone, $email){
        //antes de cadastrar verificar se ja tem o email
        $cmd = $this->pdo->prepare("SELECT cod_aluno FROM tbl_aluno WHERE email = :e");
        $cmd->bindValue(":e",$email);
        $cmd->execute();
        
        if($cmd->rowCount() > 0){//email ja existe
            return false;
        }else{
            $cmd = $this->pdo->prepare("INSERT INTO tbl_aluno (nome,sobrenome,idade,telefone,email)
            VALUES (:nome,:sobrenome,:idade,:telefone,:email)");
            $cmd->bindValue(":nome",$nome);
            $cmd->bindValue(":sobrenome",$sobrenome);
            $cmd->bindValue(":idade",$idade);
            $cmd->bindValue(":telefone",$telefone);
            $cmd->bindValue(":email",$email);
            $cmd->execute();
            return true;
        }
    }

    public function excluirAluno($cod_aluno){
        $cmd = $this->pdo->prepare("DELETE FROM tbl_aluno WHERE cod_aluno = :cod_aluno");
        $cmd->bindValue("cod_aluno",$cod_aluno);
        $cmd->execute();
    }
    //buscae dados de um aluno
    public function buscarDadosAluno($cod_aluno){
        $res = array();
        $cmd = $this->pdo->prepare("SELECT * FROM tbl_aluno WHERE cod_aluno = :cod_aluno");
        $cmd->bindValue(":cod_aluno",$cod_aluno);
        $cmd->execute();
        $res = $cmd->fetch(PDO::FETCH_ASSOC);
        return $res;
    }

    //atualiza dados no banco de dados
    public function atualizarDados($cod_aluno, $nome, $sobrenome, $idade, $telefone, $email){
        $cmd = $this->pdo->prepare("UPDATE tbl_aluno SET nome=:nome , sobrenome=:sobrenome,
        idade=:idade, telefone=:telefone,email=:email WHERE cod_aluno=:cod_aluno");
        $cmd->bindValue(":nome",$nome);
        $cmd->bindValue(":sobrenome",$sobrenome);
        $cmd->bindValue(":idade",$idade);
        $cmd->bindValue(":telefone",$telefone);
        $cmd->bindValue(":email",$email);
        $cmd->bindValue(":cod_aluno",$cod_aluno);
        $cmd->execute();
        return true;
        
    }


}
?>