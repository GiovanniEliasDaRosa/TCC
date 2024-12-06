CREATE DATABASE `HORARIOESCOLARDB` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `HORARIOESCOLARDB`;
CREATE TABLE `Tb_horario` (
  `id_horario` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `horario` varchar(5),
  `turma` varchar(30),
  `segunda` varchar(40),
  `terca` varchar(40),
  `quarta` varchar(40),
  `quinta` varchar(40),
  `sexta` varchar(40)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE `Tb_aviso` (
  `id_aviso` smallint NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `dt_inicio` DATE,
  `dt_fim` DATE,
  `titulo` varchar(40) NOT NULL,
  `corpo` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE `Tb_usuario` (
  `id_usuario` smallint NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- CREATE TABLE `users` (
--   `id` smallint NOT NULL PRIMARY KEY AUTO_INCREMENT,
--   `name` varchar(255) NOT NULL,
--   `password` varchar(255) NOT NULL
-- ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
