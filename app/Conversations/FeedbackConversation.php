<?php

namespace App\Conversations;

use App\Models\Feedback;
use BotMan\BotMan\Messages\Conversations\Conversation;

class FeedbackConversation extends Conversation
{
    protected $nivelSatisfacao;
    protected $descricao;
    protected $nomeCliente = null;
    protected $cpfCliente = null;

    public function askSatisfacao()
    {
        $this->ask('Qual o seu nível de satisfação de 1 a 5?', function ($answer) {
            $resposta = trim($answer->getText());

            if (!is_numeric($resposta) || $resposta < 1 || $resposta > 5) {
                $this->say('Por favor, digite um número de 1 a 5.');
                return $this->askSatisfacao();
            }

            $this->nivelSatisfacao = (int) $resposta;
            $this->askDescricao();
        });
    }

    public function askDescricao()
    {
        $this->ask('Poderia nos dar mais detalhes sobre sua experiência?', function ($answer) {
            $this->descricao = trim($answer->getText());

            if (strlen($this->descricao) < 2) {
                $this->say('Por favor, forneça mais detalhes sobre sua experiência.');
                return $this->askDescricao();
            }

            $this->askIdentificacao();
        });
    }

    public function askIdentificacao()
    {
        $this->ask('Você deseja se identificar? (sim/não)', function ($answer) {
            $resposta = mb_strtolower(trim($answer->getText()));
            $resposta = str_replace('não', 'nao', $resposta);

            if ($resposta === 'sim') {
                $this->askNome();
            } elseif ($resposta === 'nao') {
                $this->saveFeedback();
            } else {
                $this->say('Por favor, responda com "sim" ou "não".');
                return $this->askIdentificacao();
            }
        });
    }

    public function askNome()
    {
        $this->ask('Qual é o seu nome?', function ($answer) {
            $this->nomeCliente = trim($answer->getText());

            if (strlen($this->nomeCliente) < 2) {
                $this->say('Por favor, informe um nome válido com pelo menos 2 caracteres.');
                return $this->askNome();
            }

            $this->askCpf();
        });
    }

    public function askCpf()
    {
        $this->ask('Informe seu CPF (somente números):', function ($answer) {
            $cpf = preg_replace('/\D/', '', $answer->getText()); // Remove tudo que não for número

            if (strlen($cpf) !== 11 || !ctype_digit($cpf)) {
                $this->say('CPF inválido! Digite 11 números corretamente.');
                return $this->askCpf();
            }

            $this->cpfCliente = $cpf;
            $this->saveFeedback();
        });
    }

    public function saveFeedback()
    {
        Feedback::create([
            'nivel_satisfacao' => $this->nivelSatisfacao,
            'descricao' => $this->descricao,
            'nome_cliente' => $this->nomeCliente,
            'cpf_cliente' => $this->cpfCliente,
        ]);

        $this->say('Obrigado pelo seu feedback!');
    }

    public function run()
    {
        $this->askSatisfacao();
    }
}
