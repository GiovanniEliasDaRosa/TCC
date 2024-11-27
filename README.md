# TCC ETEC

This project was developed for use in Portuguese, but you can click the button below to access the explanation in Portuguese.

[![en](https://img.shields.io/badge/lang-en-red.svg)](https://github.com/GiovanniEliasDaRosa/TCC/blob/main/README.md)
[![pt-br](https://img.shields.io/badge/lang-pt--br-green.svg)](https://github.com/GiovanniEliasDaRosa/TCC/blob/main/README.pt-br.md)

## Project Explanation

This website was developed as part of the 2024 Final Project (TCC) for the Computer Science for the Internet course at ETEC João Berlamino, in collaboration with the school E. E. Prof. Clodoveu Barbosa. The goal of the project is to facilitate communication regarding schedule changes and announcements from Clodoveu school, promoting the transition to a digital format. This allows the school community to access information from anywhere, at any time.

## Project Structure

The web application uses XAMPP as a local server and a database to store information. Below is a detailed description of the project's folders and subfolders:

### 1. bats

This folder contains scripts to set up and tear down the development environment.

- **CONFIGURAR (English: CONFIGURE)**: Script that automates the setup of XAMPP and the database.
- **DESCONFIGURAR (English: TEAR DOWN)**: Script that removes the configurations of XAMPP and the database.

This is necessary because I am not using a framework; instead, I am creating a custom router system, and to function correctly, it is necessary to modify some XAMPP files.

### 2. Http

This folder contains the system logic, organized in the **controllers** subfolder.

The controllers manage the system logic, processing requests and determining which data will be displayed in the views.

### 3. public

This folder contains all publicly accessible files, such as styles, images, and JavaScript scripts. The subfolders are:

- **css**: Style files (CSS).
- **img**: Images used on the site.
- **js**: JavaScript scripts that add interactivity.

### 4. views

This folder contains the views, which are the pages displayed to the user. The views are controlled by the controllers located in `Http/controllers`. The subfolders are:

- **admin**: Contains all views related to the system administrator.
- **user**: Contains all views aimed at users.
- **session**: Contains views related to login and session management for the administrator.
