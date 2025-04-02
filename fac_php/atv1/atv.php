<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atividades Práticas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            width: 100%;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        ol {
            padding: 0;
            list-style: none;
        }

        li h2 {
            background: #007bff;
            color: white;
            padding: 10px;
            margin: 5px 0;
            border-radius: 5px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Atividades Práticas</h1>
        <ol>
            <li>
                <h2>Crie um array com 5 nomes de cidades e exiba cada uma delas em uma linha diferente.</h2>
                <div>
                    <?php
                    $cidades = array("São Paulo", "Rio de Janeiro", "Belo Horizonte", "Salvador", "Porto Alegre");
                    foreach ($cidades as $cidade) {
                        echo "<p>$cidade</p>";
                    }
                    ?>
                </div>
            </li>
            <li>
                <h2>Crie um array associativo com nomes de três amigos e suas idades. Exiba a idade de um amigo específico.</h2>
                <div>
                    <?php
                    $amigos = array("João" => 25, "Maria" => 30, "Pedro" => 28);
                    echo "<p>A idade de Pedro é: " . $amigos["Pedro"] . "</p>";
                    ?>
                </div>
            </li>
            <li>
                <h2>Dado um array de números, percorra-o e exiba apenas os valores maiores que 10.</h2>
                <div>
                    <?php
                    $numeros = array(0, 5, 15, 25, 35, 45);
                    $total;
                    foreach ($numeros as $numero) {
                        if ($numero > 10) {
                            echo "<p>$numero</p>";
                        }
                    }
                    ?>
                </div>
            </li>
            <li>
                <h2>Crie um array de números, adicione um novo número, remova o último e exiba o array final.</h2>
                <div>
                    <?php
                    $numeros = array(0, 5, 15, 25, 35, 45);
                    $numeros[] = 55;
                    //unset($numeros[count($numeros) - 1]);
                    array_pop($numeros);
                    foreach ($numeros as $numero) {
                        echo "<p>$numero</p>";
                    }
                    ?>
                </div>
            </li>
            <li>
                <h2>Dado um array de números, utilize um foreach para somar todos os valores e exibir o resultado.</h2>
                <div>
                    <?php
                    $numeros = array(0, 5, 15, 25, 35, 45);
                    $total = 0;
                    foreach ($numeros as $numero) {
                        $total += $numero;
                    }
                    echo "<p>$total</p>";
                    ?>
                </div>
            </li>
            <li>
                <h2>Dado um array com 15 números, percorra-o usando um for ou foreach e exiba apenas os números pares.</h2>
                <?php
                $numeros = array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15);
                foreach ($numeros as $numero) {
                    if ($numero % 2 == 0) {
                        echo "<p>$numero</p>";
                    } else {
                        echo "<p>..</p>";
                    }
                }
                ?>
            </li>
            <li>
                <h2>Crie um array de números e use um loop para encontrar e exibir o maior e o menor valor.</h2>
                <?php
                $numeros = array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15);

                echo "<p>Maior: " . max($numeros) . " - Menor: " . min($numeros) . "</p>";
                ?>
            </li>
            <li>
                <h2>Dado um array com valores repetidos, utilize array_unique() para remover duplicatas e exiba o resultado.</h2>
                <?php
                $numeros = array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15);
                $numeros = array_unique($numeros);
                foreach ($numeros as $numero) {
                    echo "<p>$numero</p>";
                }
                ?>
            </li>
        </ol>
    </div>
</body>

</html>