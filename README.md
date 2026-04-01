Este projeto é um website de login de usuário desenvolvido em PHP, HTML e SQL, executado em ambiente local via XAMPP.
O website salva as informações do login em um banco de dados ao efetuar o cadastro.

══════════════════════════════════════════════════════════════════════════════

Tecnologias Utilizadas:

PHP para o back-end, HTML para o front-end, SQL para o banco de dados

MySQL — armazenamento de dados

HTML, CSS — interface do usuário e estilização

XAMPP — servidor local (Apache + MySQL)

══════════════════════════════════════════════════════════════════════════════

Requisitos
XAMPP instalado (https://www.apachefriends.org/pt_br/index.html)

Utilizar navegador atualizado (seja Google Chrome, Mozilla Firefox, Microsoft Edge, entre outros.)

══════════════════════════════════════════════════════════════════════════════

Extração do Projeto:

Extraia a pasta Projeto-Login do arquivo .zip

Mova a pasta para o diretório do servidor local do XAMPP:

C:\xampp\htdocs\

Inicie o XAMPP e ative os módulos Apache e MySQL.

Banco de Dados:

Abra o navegador e acesse o phpMyAdmin:

http://localhost/phpmyadmin/

Crie um novo banco de dados chamado: "projeto"

Clique em Importar e selecione o arquivo .sql que está dentro da pasta "Projeto-Login".

Confirme a importação.

Usuário padrão do MySQL no XAMPP: root

Senha do banco: (zeromeia#06)

Se necessário, ajuste conforme sua configuração de senha local.

══════════════════════════════════════════════════════════════════════════════

Como Executar:

Abra o seu navegador e acesse:

http://localhost/Projeto-Fabiano/

══════════════════════════════════════════════════════════════════════════════

Solução de Problemas Comuns:

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

══════════════════════════════════════════════════════════════════════════════

Licença:
Este sistema é distribuído para fins de atividades acadêmicas estudantis.
