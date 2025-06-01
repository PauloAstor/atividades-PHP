<?php

$db = new SQLite3('banco.db');


$db->exec("CREATE TABLE IF NOT EXISTS usuarios (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nome TEXT NOT NULL,
    email TEXT NOT NULL
)");


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $email = $_POST['email'];

   
    $stmt = $db->prepare('INSERT INTO usuarios (nome, email) VALUES (:nome, :email)');
    $stmt->bindValue(':nome', $nome, SQLITE3_TEXT);
    $stmt->bindValue(':email', $email, SQLITE3_TEXT);
    $stmt->execute();

    echo "<p style='color:green;'>Dados inseridos com sucesso!</p>";
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>ExemploPHPSQLite1</title>
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
</head>
<body>

    <h1>Cadastro de Usuarios</h1>
    <form method="POST">
        <input type="text" name="nome" placeholder="Digite seu nome" required><br>
        <input type="email" name="email" placeholder="Digite seu e-mail" required><br>
        <button type="submit">Cadastrar</button>
    </form>

    <h2>Usuarios cadastrados:</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Email</th>
        </tr>
        <?php
        $result = $db->query('SELECT * FROM usuarios');
        while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['nome']}</td>
                    <td>{$row['email']}</td>
                  </tr>";
        }
        ?>
    </table>

</body>
</html>
