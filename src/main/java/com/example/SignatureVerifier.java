package com.example;

import java.security.KeyFactory;
import java.security.PublicKey;
import java.security.Signature;
import java.security.spec.X509EncodedKeySpec;
import java.util.Base64;

public class SignatureVerifier {

    public boolean verify(String base64Signature, String data, String base64PublicKey) throws Exception {
        // Decodifica la chiave pubblica da Base64
        byte[] publicKeyBytes = Base64.getDecoder().decode(base64PublicKey);
        X509EncodedKeySpec keySpec = new X509EncodedKeySpec(publicKeyBytes);
        KeyFactory keyFactory = KeyFactory.getInstance("RSA");
        PublicKey publicKey = keyFactory.generatePublic(keySpec);

        // Decodifica la firma da Base64
        byte[] signatureBytes = Base64.getDecoder().decode(base64Signature);

        // Prepara i dati da verificare
        byte[] dataBytes = data.getBytes("UTF-8");

        // Inizializza la verifica della firma
        Signature signature = Signature.getInstance("SHA256withRSA");
        signature.initVerify(publicKey);
        signature.update(dataBytes);

        // Verifica la firma
        return signature.verify(signatureBytes);
    }
}
