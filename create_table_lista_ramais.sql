CREATE TABLE `lista_ramais` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `nome` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `depto` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `local` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `ramal` varchar(10) COLLATE latin1_general_ci DEFAULT NULL,
  `email` varchar(80) COLLATE latin1_general_ci DEFAULT NULL,
  `celular` varchar(20) COLLATE latin1_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

COMMIT;