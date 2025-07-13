<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pontuação</title>
    <style>
 
    body {
        font-family: Arial, sans-serif;
        background-color: #f7f7f7;
        margin: 0;
        padding: 20px;
        text-align: center;
    }

    h1 {
        color: #000;
        margin-bottom: 20px;
    }

    table {
        margin: 0 auto;
        border-collapse: collapse;
        width: 60%; /* Tabela menor */
        background-color: #fff;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    thead tr {
        background-color: #007bff;
        color: #fff;
    }

    th, td {
        padding: 9px; /* Reduzido */
        border: 1px solid #ddd;
        color: #000;
        font-size: 14px;
    }

    td form {
        margin: 0;
    }

    td input[type="submit"],
    td button {
        padding: 4px 10px; /* Mais compacto */
        font-size: 20px;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    td input[type="submit"]:hover,
    td button:hover {
        background-color: #0056b3;
    }

    tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    form {
        margin: 10px;
        display: inline-block;
    }

    input[type="submit"] {
        background-color: #007bff;
        color: #fff;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
        font-size: 15px;
        transition: background-color 0.3s ease;
    }

    input[type="submit"]:hover {
        background-color: #0056b3;
    }


    </style>
</head>
<body>
    <h1>Pontuação</h1>
    
    <table>
        <thead>
            <tr>
                {{jogadores}}
            </tr>
        </thead>
        <tbody>
            {{dados}}
        </tbody>
    </table>

    <form action="cPontuacao.php" method="get">
        <input type="submit" value="Zerar Pontos" name="zerar">
    </form>
    <form action="cPontuacao.php" method="get">
        <input type="submit" value="Voltar para Listar Usuários" name="voltar">
    </form>
</body>
</html>
