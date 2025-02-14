<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel 11 - BotMan Chatbot</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet"> 
</head>
<body class="bg-light d-flex justify-content-center align-items-center vh-100">
    <div class="container text-center">
        <h1 class="mb-4">Bem-vindo ao Chat</h1>
        <p class="text-muted">Digite "feedback" para iniciar</p>
    </div>
    <!-- <link rel="stylesheet" type="text/css"
        href="https://cdn.jsdelivr.net/npm/botman-web-widget@0/build/assets/css/chat.min.css"> -->
    <script>
        var botmanWidget = {
            aboutText: 'Para Iniciar o Chat, digite feedback',
            introMessage: "Olá, como posso ajudar?",
            frameEndpoint: '/botman/chat',
            bubble: false, 
            chatServer: '/chat',
           
        };

    </script>
    <script src="https://cdn.jsdelivr.net/npm/botman-web-widget@0/build/js/widget.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>