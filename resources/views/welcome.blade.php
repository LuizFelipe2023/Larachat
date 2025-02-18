<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ChatBot - Laravel & BotMan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
</head>

<body class="d-flex justify-content-center align-items-center vh-100">
    <div class="chat-container">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <h1 class="mb-3">Bem-vindo ao Chat</h1>
        <p>Digite <strong>"feedback"</strong> para iniciar a conversa.</p>

        <button class="btn btn-custom btn-chat mt-3" onclick="openChat()">Iniciar Chat</button>

        <a href="{{ route('login') }}" class="btn btn-custom btn-login">Acessar Dashboard</a>

        <a href="{{ route('feedbacks.public') }}" class="btn btn-custom btn-feedback-publicos mt-3">Ver Feedbacks Públicos</a>


        <p class="footer-text">Precisa de ajuda? Envie uma mensagem para o nosso suporte!</p>

        <a href="/suportes/create" class="btn btn-custom btn-support">
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