<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Alterar senha</title>
    <link rel="stylesheet" href="form.css"/>
</head>
<body>
    <div id="interface">
        <?php
            $erro = null;
            $valido = false;

            // início código de conexão do banco de dados
            try {
                $conn = new PDO('mysql:host=localhost;dbname=cadastro', 'root', '');
                $conn->exec('set names utf8');
            } catch(PDOException $e) {
                echo "Erro: " . $e->getMessage();
                exit();
            }
        
            if(isset($_REQUEST["validar"]) && $_REQUEST[("validar")] == true) {
                if($_POST["senha"] != $_POST["senhaRepete"]) {
                    $erro = "Senhas digitadas diferente";
                    $erro .= "<br><a href='?id=".$_POST["id"]."'>Tentar novamente</a>";
                    echo $erro;
                    exit();
                } else {
                    $valido = true;
                
                    $query = "UPDATE usuarios SET
                        senha = ?
                        WHERE id = ?";
                    $sql = $conn->prepare($query);

                    $passawordHash = md5($_POST["senha"]);
                    $sql->bindParam(1, $passawordHash);
                    $sql->bindParam(2, $_POST["id"]);
                    $sql->execute();

                    if($sql->errorCode() !="00000") {
                        $valido = false;
                        $erro = "Erro código " . $sql->errorCode() . ": ";
                        $erro .= implode(", ", $sql->erroInfo());
                    }
                }
            } else {
                // $rs = $conn->prepare("SELECT nome, email FROM usuarios WHERE id = ?");
                // $rs->bindParam(1, $_REQUEST["id"]);

                // if($rs->execute()) {
                //     if($registro = $sql->fetch(PDO::FETCH_OBJ)) {
                //         $_POST["nome"] = $registro->nome;
                //         $_POST["email"] = $registro->email;
                //     } else {
                //         $erro = "Registro não encontrado";
                //     }
                // } else {
                //     $erro = "Falha na captura do registro";
                // }
            }
        ?>

        <?php
            if($valido == true) {
                echo "Senha alterada com sucesso!<br>";
                echo "<a href='aula_lista.php'>Visualizar registros</a>";
            } else {
                if(isset($erro)) {
                    echo $erro . "<br><br>";
                }
        ?>

        <form method=POST action="?validar=true">
            <fieldset>
                <legend>Alterar Senha do Usuário</legend>
                
                <!-- <?php 
                    // echo "Usuário: " .$_POST["nome"]."<br />";
                    // echo "Email: ".$_POST["email"]."<br />";
                ?> -->

                <p>Digite a senha: <input type=pasaword name=senha></p>
                <p>Digite a senha novamente: <input type=passaword name=senhaRepete></p>

                <input type=hidden name=id value="<?php echo $_REQUEST["id"]; ?>">
                <p><input type=submit value="Alterar Senha"></p>
            </fieldset>                   
        </form>

        <?php } ?>
    </div>
</body>
</html>