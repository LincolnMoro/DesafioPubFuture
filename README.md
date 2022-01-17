# DesafioPubFuture

### Requisitos para executar o código

* PHP versão 7.4
* Banco de dados MySQL 8
* Servidor Apache
* Navegador de internet padrão

### Conexão ao banco de dados
O banco de dados se localiza nesta mesma pasta inicial com o nome de pubfuture.sql.

A conexão ao banco de dados é configurada no arquivo /application/utils/Connection.php

### Login
Página de login: /login.php
* Usuário: pubfuture
* Senha: 12345678

### Detalhes
A alteração direta de saldo não é permitida pois a ideia do projeto 
não é a gestão de contas em si mas sim a gestão de financias. Logo, toda a alteração
de saldo é feita por meio da adição e remoção de receitas e despesas.
Note que ao excluir um registro do banco de dados, não é alterado o saldo da conta
pois isso poderia implicar em riscos de alteração de saldo com base em ações incorretas.

O widget lateral exibe o total de Receitas, Despesas e Saldo Total do sistema.

Uma versão online do sistema pode ser visto em lincolnmoro.site.