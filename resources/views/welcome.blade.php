<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ChatBot - Laravel & BotMan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, rgba(110, 142, 251, 0.8), rgba(167, 119, 227, 0.8));
            font-family: 'Nunito', sans-serif;
            color: #fff;
        }

        .chat-container {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            text-align: center;
            max-width: 450px;
            width: 100%;
            margin-top: 50px;
            border: 1px solid #f0f0f0;
        }

        .chat-container h1 {
            font-size: 2rem;
            font-weight: bold;
            color: #333;
        }

        .chat-container p {
            font-size: 1.1rem;
            color: #666;
        }

        .btn-custom {
            font-size: 1.2rem;
            font-weight: bold;
            border-radius: 50px;
            padding: 12px 25px;
            transition: all 0.3s ease-in-out;
            width: 100%;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .btn-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
        }

        .btn-chat {
            background: #007bff;
            color: white;
        }

        .btn-chat:hover {
            background: #0056b3;
        }

        .btn-login {
            background: #28a745;
            color: white;
            margin-top: 10px;
        }

        .btn-login:hover {
            background: #1e7e34;
        }

        .btn-support {
            background: #ffc107;
            color: #333;
            margin-top: 10px;
        }

        .btn-support:hover {
            background: #e0a800;
        }

        .footer-text {
            margin-top: 20px;
            font-size: 0.9rem;
            color: #ddd;
        }

        @media (max-width: 576px) {
            .chat-container {
                padding: 20px;
                width: 100%;
                max-width: 100%;
            }

            .btn-custom {
                font-size: 1.1rem;
            }
        }
    </style>
</head>

<body class="d-flex justify-content-center align-items-center vh-100">

    <div class="chat-container">
        <h1 class="mb-3">Bem-vindo ao Chat</h1>
        <p>Digite <strong>"feedback"</strong> para iniciar a conversa.</p>

        <button class="btn btn-custom btn-chat mt-3" onclick="openChat()">Iniciar Chat</button>

        <a href="/login" class="btn btn-custom btn-login">Acessar Dashboard</a>

        <p class="footer-text">Precisa de ajuda? Envie uma mensagem para o nosso suporte!</p>

        <a href="/suporte" class="btn btn-custom btn-support">
            <i class="fas fa-headset"></i> Enviar Mensagem
        </a>
    </div>

    <script>
        var botmanWidget = {
            aboutText: 'Para Iniciar o Chat, digite "feedback"',
            introMessage: "Olá, como posso ajudar?",
            frameEndpoint: '/botman/chat',
            bubble: false,
            chatServer: '/chat',
            title: "Chat de Feedback",
            timeFormat: "HH:MM",
            placeholderText: "Por Favor Insira uma Mensagem",
            desktopHeight: 600,
            desktopWidth: 600,
            mainColor: '#6e8efb'
        };

        function openChat() {
            window.botmanChatWidget.open();
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/botman-web-widget@0/build/js/widget.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
