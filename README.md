# TCC

Este projeto é uma aplicação web que utiliza XAMPP para o servidor local e um banco de dados para armazenar informações. Abaixo está uma descrição detalhada de cada pasta e subpasta do projeto.

## bats

Esta pasta contém scripts para configurar e desconfigurar o ambiente de desenvolvimento, incluindo o XAMPP e o banco de dados.

- **CONFIGURAR**: Script para configurar o XAMPP e o banco de dados.
- **DESCONFIGURAR**: Script para desconfigurar o XAMPP e o banco de dados.

## Http

Esta pasta contém a lógica do sistema, organizada na subpasta **controllers**.

- **controllers**: Os controladores são responsáveis pela lógica do sistema. Eles processam as requisições e determinam quais dados serão exibidos nas _views_.

## public

Esta pasta contém todos os arquivos públicos, como estilos, imagens e scripts JavaScript. As subpastas são:

- **css**: Arquivos de estilo (CSS).
- **img**: Imagens.
- **js**: Scripts JavaScript.

> **Todos os arquivos de estilo, imagem ou JavaScript devem ser colocados aqui.**

## views

Esta pasta contém as views, que são as páginas exibidas ao usuário. As views são controladas pelos controladores localizados em `Http/controllers`. As subpastas são:

- **admin**: Contém todas as views relacionadas ao administrador.
- **user**: Contém todas as views relacionadas ao usuário.
- **session**: Contém as views relacionadas ao login e à sessão do administrador.
