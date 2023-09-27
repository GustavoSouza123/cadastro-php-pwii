<?php
    try {
        $conn = new PDO('mysql:host=localhost', 'root', '');
        $conn->exec("set names utf8");
        // criar banco de dados se ele não existir
        $sql = "CREATE DATABASE IF NOT EXISTS `cadastro`;
                USE `cadastro`;".
                // criar tabela para usuários
                "CREATE TABLE IF NOT EXISTS `usuarios` (
                `id` int NOT NULL AUTO_INCREMENT,
                `nome` varchar(55) NOT NULL,
                `email` varchar(55) NOT NULL,
                `idade` smallint NOT NULL,
                `sexo` varchar(1) NOT NULL,
                `estado_civil` varchar(16) NOT NULL,
                `humanas` smallint NOT NULL,
                `exatas` smallint NOT NULL,
                `biologicas` smallint NOT NULL,
                `senha` varchar(32) NOT NULL,
                PRIMARY KEY (`id`)
                ) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;".
                // backup
                "INSERT IGNORE INTO `usuarios` (`id`, `nome`, `email`, `idade`, `sexo`, `estado_civil`, `humanas`, `exatas`, `biologicas`, `senha`) VALUES
                (1, 'Gustavo Souza', 'gustavoelia7@gmail.com', 16, 'M', 'solteiro', 0, 1, 0, '412f262cb2c4371a3eb3ed15e02d4718'),
                (2, 'José \"JR\" Roberto', 'jr@etecsm\.sp\.gov\.br', 120, 'M', 'casado', 1, 0, 0, '8b28c7134887bb938e1ffed68456ffb2'),
                (3, 'João Paulo', 'joaopaulo@yahoo.com.br', 46, 'M', 'divorciado', 0, 1, 1, '1ae3688d9ecd1681a65aea3da816201d'),
                (4, 'Maria da Silva', 'mariadasilva2@gmail.com', 28, 'F', 'viuvo', 1, 0, 0, '0e2c5596b95c4b6c58772d884fccfe51'),
                (5, 'Estéfão Ferreira', 'estefao123@hotmail.com', 74, 'M', 'viuvo', 1, 1, 0, '101193d7181cc88340ae5b2b17bba8a1');
                COMMIT;";
        $conn->exec($sql);
    } catch(PDOException $e) {
        echo "Erro: " . $e->getMessage() . "<br>line: " . $e->getLine();
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel ="stylesheet" href="css/style.css" />
    <title>Menu Principal</title>
</head>
<body>
    <div id="interface" class="menu">
        <fieldset>
            <legend>.:: Menu Principal ::.</legend>
            <table>
                <tr><td><a href="aula_cadastro.php">Cadastro de Usuários</a></td></tr>
                <tr><td><a href="aula_lista.php">Lista de Usuários</a></td></tr>
            </table>
        </fieldset>
    </div>
</body>
</html>