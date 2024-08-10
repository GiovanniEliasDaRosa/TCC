CREATE DATABASE `HorarioEscolarDB` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `HorarioEscolarDB`;
CREATE TABLE `tb_horario` (
  `id_horario` INT NOT NULL AUTO_INCREMENT,
  `horario` TIME,
  `turma` varchar(30),
  `segunda` varchar(40),
  `terca` varchar(40),
  `quarta` varchar(40),
  `quinta` varchar(40),
  `sexta` varchar(40),
  PRIMARY KEY (`id_horario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


CREATE TABLE `tb_aviso` (
  `id` smallint NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `inicio` DATE,
  `fim` DATE,
  `titulo` varchar(40) NOT NULL,
  `corpo` varchar(360)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
