<?php
    $erro = null;
    $valido = false;

    try {
        $conn = new PDO('mysql:host=localhost;dbname=cadastro', 'root', '');
        $conn->exec('set names utf8');
    } catch(PDOException $e) {
        echo "Erro: " . $e->getMessage();
        exit();
    }

    if(isset($_REQUEST['validar']) && $_REQUEST['validar'] == true) {
        if(strlen(utf8_decode($_POST['nome'])) < 5) {
            $erro = 'Preencha o campo nome corretamente (5 ou mais caracteres)';
        } else if(strlen(utf8_decode($_POST['email'])) < 5) {
            $erro = 'E-mail inválido, preencha o campo email corretamente';
        } else if(is_numeric($_POST['idade']) == false) {
            $erro = 'O campo idade deve ser numérico';
        } else if(!isset($_POST['sexo'])) {
            $erro = 'Selecione o campo sexo corretamente';
        } else if(!isset($_POST['estadocivil']) || ($_POST['estadocivil'] != 'solteiro' && 
        $_POST['estadocivil'] != 'casado' && 
        $_POST['estadocivil'] != 'divorciado' && 
        $_POST['estadocivil'] != 'viuvo')) {
            $erro = 'Selecione o campo estado civil corretamente';
        } else if(!isset($_POST['senha']) || $_POST['senha'] == '') {
            $erro = 'Digite uma senha';
        } else {
            $valido = true;

            // início do código de cadastro
            $query = 'INSERT INTO usuarios
                    (nome, email, idade, sexo, estado_civil, humanas, exatas, biologicas, senha)
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)';
            $sql = $conn->prepare($query);

            $sql->bindParam(1, $_POST['nome']);
            $sql->bindParam(2, $_POST['email']);
            $sql->bindParam(3, $_POST['idade']);
            $sql->bindParam(4, $_POST['sexo']);
            $sql->bindParam(5, $_POST['estadocivil']);

            $humanas = isset($_POST['humanas']) ? 1 : 0;
            $sql->bindParam(6, $humanas);

            $exatas = isset($_POST['exatas']) ? 1 : 0;
            $sql->bindParam(7, $exatas);

            $biologicas = isset($_POST['biologicas']) ? 1 : 0;
            $sql->bindParam(8, $biologicas);

            $passwordHash = md5($_POST['senha']);
            $sql->bindParam(9, $passwordHash);

            $sql->execute();

            if($sql->errorCode() != '00000') {
                $valido = false;
                $erro = 'erro código ' . $sql->errorCode() . ": ";
                $erro .= implode(', ', $sql->errorInfo());
            }
            // fim do código de cadastro
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel ="stylesheet" href="css/style.css" />
    <title>Cadastro de Usuários</title>
</head>
<body>
    <?php
        if($valido == true) {
            echo '<p>Dados enviados com sucesso!</p>';
            echo '<a class="link" href="aula_lista.php">Visualizar registros</a>';
        } else {
            if(isset($erro)) {
                echo "<p class='erro'>".$erro."</p>";
            }
    ?>

    <div id=interface>
        <fieldset>
            <legend>.:: Cadastro de Usuário ::.</legend>
            <form action="?validar=true" method="post">
                <p>Nome: <input type="text" name="nome" <?php if(isset($_POST['nome'])) echo "value='" . $_POST['nome'] . "'"; ?> /></p>
                <p>E-mail: <input type="text" name="email" <?php if(isset($_POST['email'])) echo "value='" . $_POST['email'] . "'"; ?> /></p>
                <p>Idade: <input type="text" name="idade" <?php if(isset($_POST['idade'])) echo "value='" . $_POST['idade'] . "'"; ?> /></p>
                <p>Sexo:<br>
                    <input type="radio" name="sexo" value="M" <?php if(isset($_POST['sexo']) && $_POST['sexo'] == 'M') echo 'checked'; ?> />Masculino
                    <input type="radio" name="sexo" value="F" <?php if(isset($_POST['sexo']) && $_POST['sexo'] == 'F') echo 'checked'; ?> />Feminino
                </p>
                <p>Interesses:<br>
                    <input type="checkbox" name="humanas" <?php if(isset($_POST['humanas'])) echo 'checked'; ?> />Ciências humanas
                    <input type="checkbox" name="exatas" <?php if(isset($_POST['exatas'])) echo 'checked'; ?> />Ciências exatas<br>
                    <input type="checkbox" name="biologicas" <?php if(isset($_POST['biologicas'])) echo 'checked'; ?> />Ciências biológicas
                </p>
                <p>Estado civil:
                    <select name="estadocivil">
                        <option value="selecione" selected disabled <?php if(isset($_POST['estadocivil']) && $_POST['estadocivil'] == 'selecione') echo 'selected'; ?>>Selecione</option>
                        <option value="solteiro" <?php if(isset($_POST['estadocivil']) && $_POST['estadocivil'] == 'solteiro') echo 'selected'; ?>>Solteiro(a)</option>
                        <option value="casado" <?php if(isset($_POST['estadocivil']) && $_POST['estadocivil'] == 'casado') echo 'selected'; ?>>Casado(a)</option>
                        <option value="divorciado" <?php if(isset($_POST['estadocivil']) && $_POST['estadocivil'] == 'divorciado') echo 'selected'; ?>>Divorciado(a)</option>
                        <option value="viuvo" <?php if(isset($_POST['estadocivil']) && $_POST['estadocivil'] == 'viuvo)') echo 'selected'; ?>>Viúvo(a)</option>
                    </select>
                </p>
                <p>Senha: <input type="password" name="senha" /></p>
                <p><input type="reset" value="Limpar" /> <input type="submit" value="Enviar"></p>
            </form>
        </fieldset>
        
        <a class="link" href="aula_menu.php">Menu Principal</a>
    </div>

    <?php } ?>
</body>
</html>