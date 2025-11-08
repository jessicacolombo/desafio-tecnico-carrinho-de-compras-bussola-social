<?php

return [
    "labels" => [
        "search" => "Pesquisar",
        "base_url" => "URL Base",
    ],

    "auth" => [
        "none" => "Esta API não requer autenticação.",
        "instruction" => [
            "query" => <<<TEXT
                Para autenticar requisições, inclua um parâmetro de consulta **`:parameterName`** na requisição.
                TEXT,
            "body" => <<<TEXT
                Para autenticar requisições, inclua um parâmetro **`:parameterName`** no corpo da requisição.
                TEXT,
            "query_or_body" => <<<TEXT
                Para autenticar requisições, inclua um parâmetro **`:parameterName`** na string de consulta ou no corpo da requisição.
                TEXT,
            "bearer" => <<<TEXT
                Para autenticar requisições, inclua um cabeçalho **`Authorization`** com o valor **`"Bearer :placeholder"`**.
                TEXT,
            "basic" => <<<TEXT
                Para autenticar requisições, inclua um cabeçalho **`Authorization`** no formato **`"Basic {credenciais}"`**.
                O valor de `{credenciais}` deve ser seu nome de usuário/id e sua senha, unidos por dois pontos (:),
                e então codificados em base64.
                TEXT,
            "header" => <<<TEXT
                Para autenticar requisições, inclua um cabeçalho **`:parameterName`** com o valor **`":placeholder"`**.
                TEXT,
        ],
        "details" => <<<TEXT
            Todos os endpoints que requerem autenticação estão marcados com um distintivo `requer autenticação` na documentação abaixo.
            TEXT,
    ],

    "headings" => [
        "introduction" => "Introdução",
        "auth" => "Autenticando requisições",
    ],

    "endpoint" => [
        "request" => "Requisição",
        "headers" => "Cabeçalhos",
        "url_parameters" => "Parâmetros da URL",
        "body_parameters" => "Parâmetros do Corpo",
        "query_parameters" => "Parâmetros de Consulta",
        "response" => "Resposta",
        "response_fields" => "Campos da Resposta",
        "example_request" => "Exemplo de requisição",
        "example_response" => "Exemplo de resposta",
        "responses" => [
            "binary" => "Dados binários",
            "empty" => "Resposta vazia",
        ],
    ],

    "try_it_out" => [
        "open" => "Experimente ⚡",
        "cancel" => "Cancelar 🛑",
        "send" => "Enviar Requisição 💥",
        "loading" => "⏱ Enviando...",
        "received_response" => "Resposta recebida",
        "request_failed" => "Requisição falhou com erro",
        "error_help" => <<<TEXT
            Dica: Verifique se você está conectado corretamente à rede.
            Se você é um mantenedor desta API, verifique se sua API está rodando e se você habilitou o CORS.
            Você pode verificar o console das Ferramentas de Desenvolvedor para informações de depuração.
            TEXT,
    ],

    "links" => [
        "postman" => "Ver coleção do Postman",
        "openapi" => "Ver especificação OpenAPI",
    ],
];
