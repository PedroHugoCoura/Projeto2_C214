<?php

namespace App;
session_start();

function calcularIMC($peso, $altura) {
    if ($altura > 0) {
        return $peso / ($altura * $altura);
    }
    return 0;
}

function classificarIMC($imc) {
    if ($imc < 18.5) return "Abaixo do peso";
    if ($imc >= 18.5 && $imc < 24.9) return "Peso normal";
    if ($imc >= 25 && $imc < 29.9) return "Sobrepeso";
    if ($imc >= 30) return "Obesidade";
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['calcular'])) {
    $peso = (float)$_POST['peso'];
    $altura = (float)$_POST['altura'];
    $imc = calcularIMC($peso, $altura);
    $categoria = classificarIMC($imc);
    
    $resultado = [
        'peso' => $peso,
        'altura' => $altura,
        'imc' => number_format($imc, 2),
        'categoria' => $categoria
    ];

    if (!isset($_SESSION['historico'])) {
        $_SESSION['historico'] = [];
    }
    if (!in_array($resultado, $_SESSION['historico'])) {
        array_unshift($_SESSION['historico'], $resultado);
    }

    header("Location: index.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['limpar'])) {
    $_SESSION['historico'] = [];
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora de IMC com Histórico</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Calculadora de IMC</h1>
        <form method="POST" action="index.php">
            <label for="peso">Peso (kg):</label>
            <input type="number" name="peso" step="0.1" required>
            
            <label for="altura">Altura (m):</label>
            <input type="number" name="altura" step="0.01" required>
            
            <button type="submit" name="calcular">Calcular</button>
        </form>

        <?php if (isset($resultado)): ?>
            <div class="resultado">
                <h2>Resultado</h2>
                <p>IMC: <?= $resultado['imc'] ?> - <?= $resultado['categoria'] ?></p>
            </div>
        <?php endif; ?>

        <h2>Histórico de Cálculos</h2>
        <div class="historico-container">
            <table>
                <thead>
                    <tr>
                        <th>Peso (kg)</th>
                        <th>Altura (m)</th>
                        <th>IMC</th>
                        <th>Categoria</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (isset($_SESSION['historico']) && count($_SESSION['historico']) > 0): ?>
                        <?php foreach ($_SESSION['historico'] as $item): ?>
                            <tr>
                                <td><?= $item['peso'] ?></td>
                                <td><?= $item['altura'] ?></td>
                                <td><?= $item['imc'] ?></td>
                                <td><?= $item['categoria'] ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="4">Nenhum cálculo realizado ainda.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>

            <form method="POST" action="index.php">
                <button type="submit" name="limpar" class="limpar-btn">Limpar Histórico</button>
            </form>
        </div>
    </div>
</body>
</html>
