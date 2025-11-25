<?php
header('Content-Type: application/json');

// Verificar se o formulário foi enviado via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obter os dados do formulário
    $nome = isset($_POST['nome']) ? trim($_POST['nome']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $assunto = isset($_POST['assunto']) ? trim($_POST['assunto']) : '';
    $mensagem = isset($_POST['mensagem']) ? trim($_POST['mensagem']) : '';

    // Validar se os campos foram preenchidos
    if (empty($nome) || empty($email) || empty($assunto) || empty($mensagem)) {
        echo json_encode(['sucesso' => false, 'mensagem' => 'Todos os campos são obrigatórios']);
        exit;
    }

    // Validar o formato do email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(['sucesso' => false, 'mensagem' => 'E-mail inválido']);
        exit;
    }

    // Aqui você pode adicionar lógica adicional, como:
    // - Enviar um e-mail (usando mail() ou uma biblioteca)
    // - Salvar em um banco de dados
    // - Registrar em um arquivo de log

    // Para este exercício, apenas simulamos o envio
    // e retornamos uma resposta de sucesso

    // Salvar os dados em um arquivo CSV
    $csv_file = 'contatos.csv';
    $cabecalho = ['Data', 'Nome', 'Email', 'Assunto', 'Mensagem'];
    $linha = [date('Y-m-d H:i:s'), $nome, $email, $assunto, $mensagem];

    // Se o arquivo não existe, cria com cabeçalho
    if (!file_exists($csv_file)) {
        $fp = fopen($csv_file, 'w');
        fputcsv($fp, $cabecalho);
        fclose($fp);
    }
    // Adiciona a linha ao arquivo
    $fp = fopen($csv_file, 'a');
    fputcsv($fp, $linha);
    fclose($fp);

    echo json_encode(['sucesso' => true, 'mensagem' => "Obrigado pela mensagem, $nome! Dados salvos com sucesso."]);
    exit;

    // Retornar resposta de sucesso em JSON
    // ...código movido para cima...
} else {
    echo json_encode(['sucesso' => false, 'mensagem' => 'Método de requisição inválido']);
    exit;
}
?>
