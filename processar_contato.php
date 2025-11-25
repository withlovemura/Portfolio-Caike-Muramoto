<?php
header('Content-Type: application/json');

// Verificar se o formulário foi enviado via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obter os dados do formulário
    $nome = isset($_POST['nome']) ? trim($_POST['nome']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $mensagem = isset($_POST['mensagem']) ? trim($_POST['mensagem']) : '';

    // Validar se os campos foram preenchidos
    if (empty($nome) || empty($email) || empty($mensagem)) {
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

    // Exemplo: registrar em um arquivo de log (opcional)
    $log_file = 'logs/contato.log';
    if (!is_dir('logs')) {
        mkdir('logs', 0755, true);
    }
    
    $log_data = date('Y-m-d H:i:s') . " - Nome: $nome, Email: $email, Mensagem: $mensagem\n";
    file_put_contents($log_file, $log_data, FILE_APPEND);

    // Retornar resposta de sucesso em JSON
    echo json_encode(['sucesso' => true, 'mensagem' => "Obrigado pela mensagem, $nome!"]);
    exit;
} else {
    echo json_encode(['sucesso' => false, 'mensagem' => 'Método de requisição inválido']);
    exit;
}
?>
