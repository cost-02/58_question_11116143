<?php
include_once 'Crypt/RSA.php';

// Inizializza la libreria RSA
$rsa = new Crypt_RSA();

// Carica la tua chiave privata
$privateKey = <<<KEY
-----BEGIN RSA PRIVATE KEY-----
MIICXgIBAAKBgQDjh+hNsqJe566JO0Sg7Iq5H1AdkauACdd8QMLp9YNY0HPslVH0
rXaOFo0zgH0Ktu/Ku3lS1lfxbFQAY8b6ywZKvu4eoxlnEwuBwy09CG+3ZiVLBjCj
TZHA/KOkpVLa+tA6KsoP6zv/xI/ACkSCxPGR0q3SiRuhXV/6tacoKxUYnwIDAQAB
-----END RSA PRIVATE KEY-----
KEY;

$rsa->loadKey($privateKey); // Carica la chiave privata
$rsa->setHash("sha256"); // Imposta l'algoritmo di hash SHA-256
$rsa->setSignatureMode(CRYPT_RSA_SIGNATURE_PKCS1);

// Dati da firmare
$data = 'abc';

// Firma i dati
$signature = $rsa->sign($data);

// Codifica la firma in base64 per la trasmissione
$encodedSignature = base64_encode($signature);

// Output della firma
echo "Firma codificata in base64: " . $encodedSignature;
?>
