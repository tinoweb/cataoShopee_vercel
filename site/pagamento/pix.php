<?php
// Recebe o valor do formulário
$price = $_POST['price'] ?? '';

// Converte o valor para o formato correto (centavos para reais)
$priceInReais = number_format($price / 100, 2, '.', '');

// Define os links de redirecionamento baseado no valor
switch ($priceInReais) {
    case '34.90':
        $redirectUrl = 'https://go.perfectpay.com.br/PPU38CPGI5O';
        break;
    case '29.58':
        $redirectUrl = 'https://go.perfectpay.com.br/PPU38CPGI68';
        break;
    case '27.97':
        $redirectUrl = 'https://go.perfectpay.com.br/PPU38CPGI6Q';
        break;
    default:
        // Em caso de valor não reconhecido, redireciona para a página inicial
        $redirectUrl = '../index.html';
}

// Redireciona para a URL apropriada
header("Location: " . $redirectUrl);
exit();
?>
