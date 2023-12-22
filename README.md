![](./front-end-alphacode/images/logo_rodape_alphacode.png)

---
## Sobre
Este projeto é uma avaliação para teste de conhecimentos para uma vaga de emprego na empresa Alphacode.

## Tecnologias utilizadas
- PHP
- MySQL
- HTML
- CSS
- Javascript
- Bootstrap
- XAMPP
- Postman
- Composer


# Banco de dados
Abaixo o Script utilizado para criar o banco de dados:
```sql
create database db_alphacode;
use db_alphacode;
create table tbl_usuario(
	id int not null auto_increment primary key,
    nome varchar(150) not null,
    data_nascimento date not null,
    email varchar(255) not null,
    profissao varchar(50) not null,
    telefone varchar(20) not null,
    celular varchar(20) not null,
    whatsapp boolean ,
    notificacoes_email boolean ,
    notificacoes_sms boolean ,
    
    unique index (id)
);
```

# Aplicação
Para o desenvolvimento da aplicação foi utilizado o XAMPP. Então, segue as orientações para rodar a aplicação:
- 1º Baixe o PHP e o Composer.
- 2º Baixe e configure o XAMPP.
- 3º Abra o seu explorador de arquivos e encontre o arquivo do XAMPP em seu computador. Siga o caminho  "XAMPP > htdocs" e cole o clone desse [projeto](https://claudiosousa44.github.io/projeto-alphacode).
- 4º Abra esse clone no seu editor de texto e siga esse caminho "back-end-alphacode > src > model > database > conexaoBanco.php" e mude as seguintes variáveis para ficar de acordo com o seu banco de dados.
```php
const DBSERVER = 'localhost';
const DBUSER = 'root';
const DBPASSWORD = 'bcd127';
const DBNAME = 'db_alphacode';
```
- 5º Abra o XAMPP e clique em "start" no Apache.
- 6º Volte para pasta "front-end-alphacode" e rode o index.html localmente.

## Vídeo da aplicação
[Clique aqui](https://drive.google.com/file/d/1qZrDj1c7InBHTuZJHVnXTzQVE-C7zWvv/view?usp=drive_link) para ver o vídeo.








# Autor
Claudio Sosua
