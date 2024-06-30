<?php 
require_once 'class_aluno.php';
$p = new Aluno("cadastroaluno","localhost","root","");
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro Alunos</title>
    <link rel="stylesheet" href="estilo.css"> 
</head>
<body>
    <?php 
        if(isset($_POST['nome'])){ 
            //clicou no botao cadastrar ou editar
            //-------------------Editar----------------------
            if(isset($_GET['id_up']) && !empty($_GET['id_up'])){
                $id_update = addslashes($_GET['id_up']);
                $nome = addslashes($_POST['nome']);
                $sobrenome = addslashes($_POST['sobrenome']);
                $idade= addslashes($_POST['idade']);
                $telefone = addslashes($_POST['telefone']);
                $email = addslashes($_POST['email']);

                if (!empty($nome) && !empty($sobrenome) && !empty($idade) && !empty($telefone) && !empty($email)){
                    //editar
                    $p->atualizarDados($id_update, $nome, $sobrenome, $idade, $telefone, $email);
                    header("location: index.php");
                }else{
                    ?>
                    <div class="aviso">
                        <img src="./img/aviso.png">
                        <h4>Preencha todos os campos</h4>
                    </div>
                <?php
                }
            }//-------------Cadastrar------------------------
            else{
                $nome = addslashes($_POST['nome']);
                $sobrenome = addslashes($_POST['sobrenome']);
                $idade= addslashes($_POST['idade']);
                $telefone = addslashes($_POST['telefone']);
                $email = addslashes($_POST['email']);
                if (!empty($nome) && !empty($sobrenome) && !empty($idade) && !empty($telefone) && !empty($email)){
                    //cadastrar
                    if(!$p->cadastrarAluno($nome,$sobrenome,$idade,$telefone,$email)){
                        ?>
                    <div class="aviso">
                        <img src="./img/aviso.png">
                        <h4>Email já está cadastrado!</h4>
                    </div>
                <?php
                    }
                }else{
                    ?>
                    <div class="aviso">
                        <img src="./img/aviso.png">
                        <h4>Preencha todos os campos</h4>
                    </div>
                <?php
                }
            }
            
        }
    ?>
    <?php 
        if(isset($_GET['id_up'])){ //se a pessoa clicou em editar
            $id_update = addslashes($_GET['id_up']);
            $res = $p->buscarDadosAluno($id_update);
        }
    ?>
    <section id="esquerda">
        <form action="" method="post" style="">
            <h2>Cadastro de alunos</h2>

            <label for="nome">Nome:</label>
            <input type="text" name="nome" id="nome" 
            value="<?php if(isset($res)){echo $res['nome'];} ?>">

            <label for="sobrenome">Sobrenome:</label>
            <input type="text" name="sobrenome" id="sobrenome"
            value="<?php if(isset($res)){echo $res['sobrenome'];} ?>">

            <label for="idade">Idade:</label>
            <input type="text" name="idade" id="idade"
            value="<?php if(isset($res)){echo $res['idade'];} ?>">

            <label for="telefone">Telefone:</label>
            <input type="text" name="telefone" id="telefone"
            value="<?php if(isset($res)){echo $res['telefone'];} ?>">

            <label for="email">Email:</label>
            <input type="email" name="email" id="email"
            value="<?php if(isset($res)){echo $res['email'];} ?>">

            <input type="submit" value="<?php if(isset($res)){echo "Atualizar";}
            else{echo "Cadastrar";}?>">

        </form>
    </section>
    <section id="direita">
        <table>
            <tr id="titulo">
                <td>NOME</td>
                <td>SOBRENOME</td>
                <td>IDADE</td>
                <td>TELEFONE</td>
                <td colspan="2">EMAIL</td>
            </tr>
            <?php 
                $dados = $p->buscarDados();
                if(count($dados)>0){
                    for ($i=0; $i < count($dados); $i++){
                        echo "<tr>";
                        foreach($dados[$i] as $key => $value){
                            if($key != "cod_aluno"){
                                echo "<td>".$value."</td>";
                            }
                        }
                        ?>
                            <td>
                                <a href="index.php? id_up=<?php echo $dados[$i]['cod_aluno']; ?>">Editar</a>
                                <a href="index.php? id=<?php echo $dados[$i]['cod_aluno']; ?>">Excluir</a>
                            </td>
                        <?php
                        echo "</tr>";
                    }
                }else{//o banco de dados esta vazio
            ?>
        </table>
            <div class="aviso">
                <h4>Ainda não há pessoas cadastradas!</h4>
            </div>
            <?php
    }
                ?>
    </section>
</body>
</html>

<?php 
if(isset($_GET['id'])){
    $cod_aluno = addslashes($_GET['id']);
    $p->excluirAluno($cod_aluno);
    header("location: index.php");
    exit();
}
?>