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
        if($_POST["senha"] != $_POST["senhaRepete"]) {
            $erro = "Senhas digitadas diferente<br><br>";
            $erro .= "<a href='?id=".$_POST["id"]."'>Tentar novamente</a>";
            echo $erro;
            exit();
        } else {
            $valido = true;
        
            // início do código de alteração da senha
            $query = "UPDATE usuarios SET
                senha = ?
                WHERE id = ?";
            $sql = $conn->prepare($query);

            $passawordHash = md5($_POST["senha"]);
            $sql->bindParam(1, $passawordHash);
            $sql->bindParam(2, $_POST["id"]);
            $sql->execute();

            if($sql->errorCode() != "00000") {
                $valido = false;
                $erro = "Erro código " . $sql->errorCode() . ": ";
                $erro .= implode(", ", $sql->erroInfo());
            }
            // fim do código de alteração da senha
        }
    } else {
        $sql = $conn->prepare("SELECT nome, email FROM usuarios WHERE id = ?");
        $sql->bindParam(1, $_REQUEST["id"]);

        if($sql->execute()) {
            if($registro = $sql->fetch(PDO::FETCH_OBJ)) {
                $_POST["nome"] = $registro->nome;
                $_POST["email"] = $registro->email;
            } else {
                $erro = "Registro não encontrado";
            }
        } else {
            $erro = "Falha na captura do registro";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Alterar Senha</title>
    <link rel="stylesheet" href="css/style.css"/>
</head>
<body>
    <?php
        if($valido == true) {
            echo '<p>Senha alterada com sucesso!</p>';
            echo '<a class="link" href="aula_lista.php">Visualizar registros</a>';
        } else {
            if(isset($erro)) {
                echo "<p class='erro'>".$erro."</p>";
            }
    ?>

    <div id="interface">
        <fieldset>
            <legend>.:: Alterar Senha do Usuário ::.</legend>
            <form action="?validar=true" method="post">
                <?php 
                    echo "<p>Usuário: " .$_POST["nome"]."</p>";
                    echo "<p>Email: ".$_POST["email"]."</p>";
                ?>
                <p>Digite a senha: <br><input type=pasaword name=senha></p>
                <p>Digite a senha novamente: <br><input type=passaword name=senhaRepete></p>
                <input type="hidden" name="id" value="<?php echo $_REQUEST["id"]; ?>">
                <p><input type="submit" value="Alterar Senha"></p>
            </form>
        </fieldset>

        <a class="link" href="aula_menu.php">Menu Principal</a>
    </div>

    <?php } ?>
</body>
</html>