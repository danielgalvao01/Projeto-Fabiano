Detalhes do Projeto:

Este projeto e um sistema web de cadastro de usuarios desenvolvido em PHP, HTML, CSS e SQL, executado em ambiente local via XAMPP.
O sistema permite cadastrar usuarios com nome, e-mail, senha e uma mensagem.
A senha informada pelo usuario e criptografada antes de ser salva no banco de dados.
Os registros cadastrados podem ser consultados, editados e excluidos pela tela de consulta.

Foi utilizado no projeto o formato PDO (PHP Data Objects) para realizar a conexao com o banco de dados MySQL. O PDO permite uma comunicacao segura e eficiente com o banco, alem de oferecer suporte a multiplos sistemas de gerenciamento de banco de dados.

═══════════════════════════════════════════════════════════════════════════

Tecnologias Utilizadas:

PHP para o back-end, HTML para a estrutura da interface, CSS para a estilizacao e SQL para o banco de dados

MySQL - armazenamento de dados

HTML, CSS - interface do usuario e estilização

XAMPP - servidor local (Apache + MySQL)

PDO - conexao com o banco de dados

═══════════════════════════════════════════════════════════════════════════

Requisitos:

XAMPP instalado (https://www.apachefriends.org/pt_br/index.html)

Utilizar navegador atualizado (seja Google Chrome, Mozilla Firefox, Microsoft Edge, entre outros.)

═══════════════════════════════════════════════════════════════════════════
Estrutura dos arquivos:

Projeto-Login/
├── index.php       → Redireciona para usuarios.php
├── usuarios.php    → Logica principal, interface e operacoes de cadastro, consulta, edicao e exclusao
├── conexao.php     → Configuracao da conexao com o banco
└── usuarios.css    → Estilizacao da interface

Banco de Dados/
└── projeto.sql     → Script de criacao do banco de dados e da tabela usuarios

═══════════════════════════════════════════════════════════════════════════

Extração do Projeto:

Ao extrair o projeto, a estrutura devera conter as pastas: "Projeto-Login" e "Banco de Dados".

Mova a pasta do projeto para o diretorio do servidor local do XAMPP:

C:\xampp\htdocs\

Inicie o XAMPP e ative os modulos Apache e MySQL.

Banco de Dados:

Abra o navegador e acesse o phpMyAdmin:

http://localhost/phpmyadmin/

Crie um novo banco de dados chamado: "projeto"

Clique em Importar e selecione o arquivo "projeto.sql" que esta dentro da pasta "Banco de Dados".

Confirme a importacao.

Usuario padrao do MySQL no XAMPP: root

Senha do banco: (em branco)

Se necessario, ajuste conforme sua configuracao de senha local no arquivo conexao.php.

═══════════════════════════════════════════════════════════════════════════

Como Executar:

Abra o seu navegador e acesse:

http://localhost/Projeto-Login/

═══════════════════════════════════════════════════════════════════════════

Solução de Problemas Possíveis:

Possível Causa & Solução:

Erro de conexao com o banco

MySQL nao esta ativo ou credenciais erradas

Verifique se o MySQL esta rodando no XAMPP e confirme as credenciais no arquivo conexao.php.

Erro ao importar o banco

Arquivo SQL selecionado incorretamente

Confirme se o arquivo importado e "Banco de Dados\projeto.sql".

Pagina em branco

Erros PHP ocultos

Ative a exibicao de erros no PHP (php.ini) ou verifique o log do Apache para detalhes.

═══════════════════════════════════════════════════════════════════════════

Licença:
Este sistema e distribuido para fins de atividades academicas estudantis.
