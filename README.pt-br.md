# TCC ETEC

Este projeto foi desenvolvido para uso em português, mas você pode clicar no botão abaixo para acessar a explicação em inglês.

[![en](https://img.shields.io/badge/lang-en-red.svg)](https://github.com/GiovanniEliasDaRosa/TCC/blob/main/README.md)

## Explicação do Projeto

Este website foi desenvolvido como parte do Trabalho de Conclusão de Curso (TCC) de 2024 do curso de Informática para Internet da ETEC João Berlamino, em colaboração com a escola E. E. Prof. Clodoveu Barbosa. O objetivo do projeto é facilitar a comunicação de mudanças de horários e avisos da escola Clodoveu, promovendo a migração para um formato digital. Isso permite que a comunidade escolar acesse informações de qualquer lugar, a qualquer momento.

## Equipe de Desenvolvimento

| Nome                            | Função                                   |
| ------------------------------- | ---------------------------------------- |
| Giovanni (GiovanniEliasDaRosa)  | Desenvolvimento Full-Stack               |
| Lais (LaisVitoriaS)             | Desenvolvimento Front-End e Documentação |
| Otávio (CarambolasDeCatapimbas) | Desenvolvimento Back-End e Documentação  |
| Eduardo (bla4k10)               | Desenvolvimento Front-End e Documentação |
| Beatriz (BiaCorsi)              | Documentação                             |

## Estrutura do Projeto

A aplicação web utiliza o XAMPP como servidor local e um banco de dados para armazenar informações. Abaixo, apresentamos uma descrição detalhada das pastas e subpastas do projeto:

### 1. bats

Esta pasta contém scripts para configurar e desconfigurar o ambiente de desenvolvimento.

- **CONFIGURAR**: Script que automatiza a configuração do XAMPP e do banco de dados.
- **DESCONFIGURAR**: Script que remove as configurações do XAMPP e do banco de dados.

É necessário isso, pois não estou utilizado framework, e sim criando um sistema de rodeador customizado, e para funcionar corretamente é necessário alterar alguns arquivos do xampp

### 2. Http

Nesta pasta, está a lógica do sistema, organizada na subpasta **controllers**.

Os controladores gerenciam a lógica do sistema, processando as requisições e determinando quais dados serão exibidos nas views.

### 3. public

Esta pasta contém todos os arquivos acessíveis publicamente, como estilos, imagens e scripts JavaScript. As subpastas são:

- **css**: Arquivos de estilo (CSS).
- **img**: Imagens utilizadas no site.
- **js**: Scripts JavaScript que adicionam interatividade.

### 4. views

Esta pasta contém as views, que são as páginas exibidas ao usuário. As views são controladas pelos controladores localizados em `Http/controllers`. As subpastas são:

- **admin**: Contém todas as views relacionadas ao administrador do sistema.
- **user**: Contém todas as views voltadas para os usuários.
- **session**: Contém as views relacionadas ao login e à gestão de sessões do administrador.
