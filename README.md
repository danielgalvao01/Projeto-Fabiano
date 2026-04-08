Detalhes do Projeto:

Este projeto é um website de cadastro de usuário desenvolvido em PHP, HTML e SQL, executado em ambiente local via XAMPP.
O website salva as informações do login em um banco de dados ao efetuar o cadastro com nome,e-mail e uma mensagem.
Após a conclusão do cadastro, a senha selecionada pelo usuário é criptografada.
Os dados de usuários que ja foram cadastrados podem ser editados e ou excluidos na aba consulta.

Foi utilizado no projeto o formato PDO (PHP Data Objects) para realizar a conexão com o banco de dados MySQL. O PDO permite uma comunicação segura e eficiente com o banco, além de oferecer suporte a múltiplos sistemas de gerenciamento de banco de dados.

═════════════════════════════════════════════════════════════════════════

Tecnologias Utilizadas:

PHP para o back-end, HTML para o front-end, SQL para o banco de dados

MySQL — armazenamento de dados

HTML, CSS — interface do usuário e estilização

XAMPP — servidor local (Apache + MySQL)

═════════════════════════════════════════════════════════════════════════

Requisitos:

XAMPP instalado (https://www.apachefriends.org/pt_br/index.html)

Utilizar navegador atualizado (seja Google Chrome, Mozilla Firefox, Microsoft Edge, entre outros.)

═════════════════════════════════════════════════════════════════════════
Estrutura dos arquivos:

Projeto-Login/
├── index.php       → Redireciona para usuarios.php
├── usuarios.php    → Lógica principal e interface (CRUD)
├── conexao.php     → Configuração da conexão com o banco
├── usuarios.css    → Estilização da interface
└── projeto.sql     → Script de criação do banco de dados

═════════════════════════════════════════════════════════════════════════

Extração do Projeto:

Extraia a pasta Projeto-Login do arquivo .zip

Ao extrair, irá conter os arquivos: "usuarios.php" "conexao.php" "index.php" "projeto.sql" "usuarios.css".  

Mova a pasta para o diretório do servidor local do XAMPP:

C:\xampp\htdocs\

Inicie o XAMPP e ative os módulos Apache e MySQL.

Banco de Dados:

Abra o navegador e acesse o phpMyAdmin:

http://localhost/phpmyadmin/

Crie um novo banco de dados chamado: "projeto"

Clique em Importar e selecione o arquivo "projeto.sql" que está dentro da pasta "Projeto-Login".

Confirme a importação.

Usuário padrão do MySQL no XAMPP: root

Senha do banco: (em branco)

Se necessário, ajuste conforme sua configuração de senha local.

═════════════════════════════════════════════════════════════════════════

Como Executar:

Abra o seu navegador e acesse:

http://localhost/Projeto-Login/

═════════════════════════════════════════════════════════════════════════

Solução de Problemas Possíveis:

Possível Causa & Solução:

Erro de conexão com o banco

MySQL não está ativo ou credenciais erradas

Verifique se o MySQL está rodando no XAMPP e confirme as credenciais no arquivo conexao.php.

Erro de estilização (CSS)

Arquivos não extraídos corretamente

Confirme se todos os arquivos foram extraídos para a pasta correta dentro de htdocs.

Página em branco

Erros PHP ocultos

Ative a exibição de erros no PHP (php.ini) ou verifique o log do Apache para detalhes.

═════════════════════════════════════════════════════════════════════════

Licença:
Este sistema é distribuído para fins de atividades acadêmicas estudantis.

