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
