<?php

//Biblioteca responsável por gerar o QRCode
require_once __DIR__ . '/vendor/autoload.php';
use chillerlan\QRCode\QRCode;

//Chama a classe contendo os métodos para criação do payload (código pix).
require_once './pix/Payload.php';

/**
 * Chamada da classe e informando os parâmetros necessários.
 * 
 * Obs: Os dados informados abaixo são dados da empresa que irá receber os valores (vendedor).
 * 
 * setPixKey        -> São chaves PIX válidas como telefone, cpf, email ou chaves aleatórias.
 * setDescription   -> Descrição do pagamento, não deve usar caracteres especiais.
 * setMerchantName  -> Nome do vendedor que irá receber.
 * setMerchantCity  -> Cidade do vendedor, não user caracteres especiais.
 * setAmount        -> Valor a receber.
 * setTxid          -> Pode ser gerado com qualquer valor, desde que tenha 1 caracter até 25.
 */
$obPayload = (new Payload)->setPixKey('12345678900')
                          ->setDescription("Pagamento do pedido 123456")
                          ->setMerchantName("Felipe Anjos")
                          ->setMerchantCity("TIJUCAS")
                          ->setAmount(100.00)
                          ->setTxid('FSA1234');

//Código de pagamento pix
$payloadQrCode = $obPayload->getPayload();
?>
<html>
    <head>
        <title>Payload PIX + QRCode Estático</title>
    </head>
    <body>
        <h3>QRCode Pix</h3>
        <img src="<?php echo (new QRCode)->render($payloadQrCode); ?>" alt="QRCode Pix" width="300" />
        
        <h3>Código Pix</h3>
        <?php echo $payloadQrCode; ?>
    </body>
</html>

