<?php

$db = new SQLite3('banco.db');


$db->exec('CREATE TABLE IF NOT EXISTS usuarios (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nome TEXT,
    email TEXT
)');


if (isset($_POST['nome']) && isset($_POST['email'])) {
    $nome = $_POST['nome'];
    $email = $_POST['email'];

    $stmt = $db->prepare('INSERT INTO usuarios (nome, email) VALUES (:nome, :email)');
    $stmt->bindValue(':nome', $nome, SQLITE3_TEXT);
    $stmt->bindValue(':email', $email, SQLITE3_TEXT);
    $stmt->execute();

    header('Location: index.php');
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>CRUD com PHP + SQLite</title>
    <style>
        body {
            font-family: Arial;
            background-color: #121212;
            color: white;
            text-align: center;
            margin-top: 50px;
        }
        input {
            padding: 10px;
            border-radius: 5px;
            border: none;
            margin: 5px;
        }
        button {
            padding: 10px 20px;
            background-color: 	#00FFFF;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        table {
            margin: 20px auto;
            border-collapse: collapse;
            width: 50%;
        }
        th, td {
            padding: 8px;
            border: 1px solid white;
        }
    </style>
    <script>
        function validarForm() {
            const nome = document.forms["formCadastro"]["nome"].value;
            const email = document.forms["formCadastro"]["email"].value;
            if (nome == "" || email == "") {
                alert("Preencha todos os campos!");
                return false;
            }
            return true;
        }
    </script>
</head>
<body>

    <h1>Cadastro de Usuarios</h1>
    <form name="formCadastro" method="POST" onsubmit="return validarForm()">
        <input type="text" name="nome" placeholder="Nome"><br>
        <input type="email" name="email" placeholder="Email"><br>
        <button type="submit">Cadastrar</button>
    </form>

    <h2>Usuarios Cadastrados</h2>
    <table>
        <tr>
            <th>ID</th><th>Nome</th><th>Email</th><th>Ações</th>
        </tr>
        <?php
        $resultado = $db->query('SELECT * FROM usuarios');
        while ($linha = $resultado->fetchArray()) {
            echo "<tr>";
            echo "<td>".$linha['id']."</td>";
            echo "<td>".$linha['nome']."</td>";
            echo "<td>".$linha['email']."</td>";
            echo "<td>
                    <a href='editar.php?id=".$linha['id']."'>Editar</a> |
                    <a href='excluir.php?id=".$linha['id']."' onclick='return confirm(\"Deseja excluir?\")'>Excluir</a>
                  </td>";
            echo "</tr>";
        }
        ?>
    </table>

</body>
</html>