<?php
function criptografa($password)
{
    // Vetor de bytes (IV) 
    $iv = pack("H*", "5008f1ddde3cf2184474192c5349abbc");
    // Chave interna em Base64 
    $cryptoKey = "Q3JpcHRvZ3JhZmlhcyBjb20gUmluamRhZWwgLyBBRVM=";
    // Decodifica a chave para o formato binário
    $key = base64_decode($cryptoKey);
    // Criptografa a senha
    if (!empty($password)) {
        // Criptografa utilizando o método aes-256-cbc e retorno em dados binários
        $encrypted = openssl_encrypt($password, 'aes-256-cbc', $key, OPENSSL_RAW_DATA, $iv);
        if ($encrypted === false) {
            throw new Exception("Erro ao criptografar");
        }
        // Converte o resultado para Base64 para facilitar o armazenamento/transmissão
        return base64_encode($encrypted);
    }
    return null;
}
function desCriptografa($encryptedPassword)
{
    // Vetor de bytes (IV) conforme definido no script 
    $iv = pack("H*", "5008f1ddde3cf2184474192c5349abbc");
    // Chave interna em Base64 conforme definido no script 
    $cryptoKey = "Q3JpcHRvZ3JhZmlhcyBjb20gUmluamRhZWwgLyBBRVM=";
    // Decodifica a chave para o formato binário
    $key = base64_decode($cryptoKey);
    // Descriptografa a senha
    if (!empty($encryptedPassword)) {
        // Converte a senha criptografada de Base64 para binário
        $decoded = base64_decode($encryptedPassword);
        // Descriptografa utilizando o mesmo método e parâmetros
        $decrypted = openssl_decrypt($decoded, 'aes-256-cbc', $key, OPENSSL_RAW_DATA, $iv);
        if ($decrypted === false) {
            throw new Exception("Erro ao descriptografar");
        }
        return $decrypted;
    }
    return null;
}
?>
 