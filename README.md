# Cadastro_de_Alunos
 Sistema simples utilizando Html,CSS,PHP e Mysql

# Registro Alunos

Este é um sistema simples de cadastro de alunos desenvolvido em PHP. Ele permite cadastrar, editar e excluir informações de alunos. O sistema utiliza uma base de dados MySQL para armazenar os dados.

## Tecnologias Utilizadas

- PHP
- MySQL
- HTML
- CSS

## Instalação

1. **Clone o repositório:**


git clone https://github.com/seu-usuario/nome-do-repositorio.git
cd nome-do-repositorio

2 - Configure o banco de dados:
Crie um banco de dados MySQL com o nome cadastroaluno e configure as tabelas necessárias utilizando o seguinte script SQL:

CREATE DATABASE cadastroaluno;

USE cadastroaluno;

CREATE TABLE alunos (
    cod_aluno INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(50),
    sobrenome VARCHAR(50),
    idade INT,
    telefone VARCHAR(20),
    email VARCHAR(50)
);

3 - Configure a conexão com o banco de dados:
Edite o arquivo class_aluno.php e configure as credenciais do banco de dados de acordo com sua configuração local:
class Aluno {
    private $pdo;
    public function __construct($dbname, $host, $user, $senha) {
        try {
            $this->pdo = new PDO("mysql:dbname=".$dbname.";host=".$host, $user, $senha);
        } catch (PDOException $e) {
            echo "Erro com banco de dados: ".$e->getMessage();
            exit();
        } catch (Exception $e) {
            echo "Erro genérico: ".$e->getMessage();
            exit();
        }
    }
}

Utilização
1. Abra o arquivo index.php no seu navegador:
http://localhost/nome-do-repositorio/index.php

2. Cadastro de Alunos:
Preencha o formulário de cadastro com os dados do aluno e clique em "Cadastrar".

3. Edição de Alunos:
Clique no botão "Editar" ao lado do aluno que deseja editar, altere os dados no formulário e clique em "Atualizar".

4. Exclusão de Alunos:
Clique no botão "Excluir" ao lado do aluno que deseja remover.

Estrutura do Projeto
index.php: Arquivo principal que contém o formulário e a listagem de alunos.
class_aluno.php: Classe PHP que gerencia as operações com o banco de dados.
estilo.css: Arquivo de estilos para a página.
img/: Pasta que contém as imagens utilizadas no projeto.

Contribuição
Contribuições são bem-vindas! Sinta-se à vontade para enviar pull requests ou abrir issues para melhorias e correções.

Licença
Este projeto está licenciado sob a MIT License.

Desenvolvido por Igor Gomes.


```bash