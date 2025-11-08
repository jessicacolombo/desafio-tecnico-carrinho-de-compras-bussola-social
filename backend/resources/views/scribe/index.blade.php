<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Laravel API Documentation</title>

    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset("/vendor/scribe/css/theme-default.style.css") }}" media="screen">
    <link rel="stylesheet" href="{{ asset("/vendor/scribe/css/theme-default.print.css") }}" media="print">

    <script src="https://cdn.jsdelivr.net/npm/lodash@4.17.10/lodash.min.js"></script>

    <link rel="stylesheet"
          href="https://unpkg.com/@highlightjs/cdn-assets@11.6.0/styles/obsidian.min.css">
    <script src="https://unpkg.com/@highlightjs/cdn-assets@11.6.0/highlight.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jets/0.14.1/jets.min.js"></script>

    <style id="language-style">
        /* starts out as display none and is replaced with js later  */
                    body .content .bash-example code { display: none; }
                    body .content .javascript-example code { display: none; }
            </style>

    <script>
        var tryItOutBaseUrl = "http://localhost:8000";
        var useCsrf = Boolean();
        var csrfUrl = "/sanctum/csrf-cookie";
    </script>
    <script src="{{ asset("/vendor/scribe/js/tryitout-5.5.0.js") }}"></script>

    <script src="{{ asset("/vendor/scribe/js/theme-default-5.5.0.js") }}"></script>

</head>

<body data-languages="[&quot;bash&quot;,&quot;javascript&quot;]">

<a href="#" id="nav-button">
    <span>
        MENU
        <img src="{{ asset("/vendor/scribe/images/navbar.png") }}" alt="navbar-image"/>
    </span>
</a>
<div class="tocify-wrapper">
    
            <div class="lang-selector">
                                            <button type="button" class="lang-button" data-language-name="bash">bash</button>
                                            <button type="button" class="lang-button" data-language-name="javascript">javascript</button>
                    </div>
    
    <div class="search">
        <input type="text" class="search" id="input-search" placeholder="Pesquisar">
    </div>

    <div id="toc">
                    <ul id="tocify-header-introducao" class="tocify-header">
                <li class="tocify-item level-1" data-unique="introducao">
                    <a href="#introducao">Introdução</a>
                </li>
                            </ul>
                    <ul id="tocify-header-autenticando-requisicoes" class="tocify-header">
                <li class="tocify-item level-1" data-unique="autenticando-requisicoes">
                    <a href="#autenticando-requisicoes">Autenticando requisições</a>
                </li>
                            </ul>
                    <ul id="tocify-header-compras" class="tocify-header">
                <li class="tocify-item level-1" data-unique="compras">
                    <a href="#compras">Compras</a>
                </li>
                                    <ul id="tocify-subheader-compras" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="compras-POSTapi-purchase">
                                <a href="#compras-POSTapi-purchase">Registrar uma nova compra</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-pagamento" class="tocify-header">
                <li class="tocify-item level-1" data-unique="pagamento">
                    <a href="#pagamento">Pagamento</a>
                </li>
                                    <ul id="tocify-subheader-pagamento" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="pagamento-GETapi-payment-calculation">
                                <a href="#pagamento-GETapi-payment-calculation">Calcula as opções de pagamento com base no método selecionado.</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-produtos" class="tocify-header">
                <li class="tocify-item level-1" data-unique="produtos">
                    <a href="#produtos">Produtos</a>
                </li>
                                    <ul id="tocify-subheader-produtos" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="produtos-GETapi-products">
                                <a href="#produtos-GETapi-products">Listar Produtos</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="produtos-GETapi-products--id-">
                                <a href="#produtos-GETapi-products--id-">Exibir Detalhes do Produto</a>
                            </li>
                                                                        </ul>
                            </ul>
            </div>

    <ul class="toc-footer" id="toc-footer">
                    <li style="padding-bottom: 5px;"><a href="{{ route("scribe.postman") }}">Ver coleção do Postman</a></li>
                            <li style="padding-bottom: 5px;"><a href="{{ route("scribe.openapi") }}">Ver especificação OpenAPI</a></li>
                <li><a href="http://github.com/knuckleswtf/scribe">Documentation powered by Scribe ✍</a></li>
    </ul>

    <ul class="toc-footer" id="last-updated">
        <li>Last updated: November 8, 2025</li>
    </ul>
</div>

<div class="page-wrapper">
    <div class="dark-box"></div>
    <div class="content">
        <h1 id="introducao">Introdução</h1>
<aside>
    <strong>URL Base</strong>: <code>http://localhost:8000</code>
</aside>
<pre><code>Essa documentação tem como objetivo fornecer todas as informações necessárias para trabalhar a API do carrinho de compras.

Você encontrará detalhes sobre os endpoints disponíveis, parâmetros necessários, exemplos de solicitações e respostas e exemplos
de implementação em PHP e JavaScript.</code></pre>

        <h1 id="autenticando-requisicoes">Autenticando requisições</h1>
<p>Esta API não requer autenticação.</p>

        <h1 id="compras">Compras</h1>

    

                                <h2 id="compras-POSTapi-purchase">Registrar uma nova compra</h2>

<p>
</p>



<span id="example-requests-POSTapi-purchase">
<blockquote>Exemplo de requisição:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost:8000/api/purchase" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"products\": [
        {
            \"id\": 1,
            \"quantity\": 2
        },
        {
            \"id\": 3,
            \"quantity\": 1
        }
    ],
    \"installments\": 3,
    \"payment_method\": \"credit_card\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/purchase"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "products": [
        {
            "id": 1,
            "quantity": 2
        },
        {
            "id": 3,
            "quantity": 1
        }
    ],
    "installments": 3,
    "payment_method": "credit_card"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-purchase">
            <blockquote>
            <p>Exemplo de resposta (201):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;products&quot;: [
        {
            &quot;id&quot;: 1,
            &quot;quantity&quot;: 100
        }
    ],
    &quot;payment&quot;: {
        &quot;method&quot;: &quot;credit_card&quot;,
        &quot;installments&quot;: 12,
        &quot;amount&quot;: {
            &quot;value&quot;: 2999000,
            &quot;formatted&quot;: &quot;29.990,00&quot;
        },
        &quot;taxes&quot;: {
            &quot;value&quot;: 380348,
            &quot;formatted&quot;: &quot;3.803,48&quot;
        },
        &quot;total&quot;: {
            &quot;value&quot;: 3379348,
            &quot;formatted&quot;: &quot;33.793,48&quot;
        },
        &quot;discount&quot;: {
            &quot;value&quot;: 0,
            &quot;formatted&quot;: &quot;0,00&quot;
        },
        &quot;installmentValue&quot;: {
            &quot;value&quot;: 281612,
            &quot;formatted&quot;: &quot;2.816,12&quot;
        }
    }
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-purchase" hidden>
    <blockquote>Resposta recebida<span
                id="execution-response-status-POSTapi-purchase"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-purchase"
      data-empty-response-text="<Resposta vazia>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-purchase" hidden>
    <blockquote>Requisição falhou com erro:</blockquote>
    <pre><code id="execution-error-message-POSTapi-purchase">

Dica: Verifique se você está conectado corretamente à rede.
Se você é um mantenedor desta API, verifique se sua API está rodando e se você habilitou o CORS.
Você pode verificar o console das Ferramentas de Desenvolvedor para informações de depuração.</code></pre>
</span>
<form id="form-POSTapi-purchase" data-method="POST"
      data-path="api/purchase"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-purchase', this);">
    <h3>
        Requisição&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-purchase"
                    onclick="tryItOut('POSTapi-purchase');">Experimente ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-purchase"
                    onclick="cancelTryOut('POSTapi-purchase');" hidden>Cancelar 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-purchase"
                    data-initial-text="Enviar Requisição 💥"
                    data-loading-text="⏱ Enviando..."
                    hidden>Enviar Requisição 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/purchase</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Cabeçalhos</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-purchase"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-purchase"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Parâmetros do Corpo</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
        <details>
            <summary style="padding-bottom: 10px;">
                <b style="line-height: 2;"><code>products</code></b>&nbsp;&nbsp;
<small>object[]</small>&nbsp;
 &nbsp;
 &nbsp;
<br>
<p>Lista de produtos a serem comprados. Must have at least 1 items.</p>
            </summary>
                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="products.0.id"                data-endpoint="POSTapi-purchase"
               value="5"
               data-component="body">
    <br>
<p>Example: <code>5</code></p>
Must be one of:
<ul style="list-style-type: square;"><li><code>1</code></li> <li><code>2</code></li> <li><code>3</code></li> <li><code>4</code></li> <li><code>5</code></li></ul>
                    </div>
                                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>quantity</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="products.0.quantity"                data-endpoint="POSTapi-purchase"
               value="16"
               data-component="body">
    <br>
<p>Must be at least 1. Example: <code>16</code></p>
                    </div>
                                    </details>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>installments</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="installments"                data-endpoint="POSTapi-purchase"
               value="3"
               data-component="body">
    <br>
<p>Número de parcelas para o pagamento. Must be at least 1. Must not be greater than 12. Example: <code>3</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>payment_method</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="payment_method"                data-endpoint="POSTapi-purchase"
               value="credit_card"
               data-component="body">
    <br>
<p>Método de pagamento escolhido. Example: <code>credit_card</code></p>
Must be one of:
<ul style="list-style-type: square;"><li><code>credit_card</code></li> <li><code>pix</code></li></ul>
        </div>
        </form>

                <h1 id="pagamento">Pagamento</h1>

    

                                <h2 id="pagamento-GETapi-payment-calculation">Calcula as opções de pagamento com base no método selecionado.</h2>

<p>
</p>



<span id="example-requests-GETapi-payment-calculation">
<blockquote>Exemplo de requisição:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/payment-calculation?amount=150&amp;payment_method=credit_card" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/payment-calculation"
);

const params = {
    "amount": "150",
    "payment_method": "credit_card",
};
Object.keys(params)
    .forEach(key =&gt; url.searchParams.append(key, params[key]));

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-payment-calculation">
            <blockquote>
            <p>Exemplo de resposta (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;payment_method&quot;: &quot;credit_card&quot;,
    &quot;original_amount&quot;: 2000,
    &quot;options&quot;: [
        {
            &quot;installments&quot;: 1,
            &quot;installment_value&quot;: 1800,
            &quot;taxes&quot;: 0,
            &quot;discount&quot;: 200,
            &quot;total_amount&quot;: 1800
        },
        {
            &quot;installments&quot;: 2,
            &quot;installment_value&quot;: 1020,
            &quot;taxes&quot;: 40,
            &quot;discount&quot;: 0,
            &quot;total_amount&quot;: 2040
        },
        {
            &quot;installments&quot;: 3,
            &quot;installment_value&quot;: 687,
            &quot;taxes&quot;: 61,
            &quot;discount&quot;: 0,
            &quot;total_amount&quot;: 2061
        },
        {
            &quot;installments&quot;: 4,
            &quot;installment_value&quot;: 520,
            &quot;taxes&quot;: 81,
            &quot;discount&quot;: 0,
            &quot;total_amount&quot;: 2081
        },
        {
            &quot;installments&quot;: 5,
            &quot;installment_value&quot;: 420,
            &quot;taxes&quot;: 102,
            &quot;discount&quot;: 0,
            &quot;total_amount&quot;: 2102
        },
        {
            &quot;installments&quot;: 6,
            &quot;installment_value&quot;: 353,
            &quot;taxes&quot;: 123,
            &quot;discount&quot;: 0,
            &quot;total_amount&quot;: 2123
        },
        {
            &quot;installments&quot;: 7,
            &quot;installment_value&quot;: 306,
            &quot;taxes&quot;: 144,
            &quot;discount&quot;: 0,
            &quot;total_amount&quot;: 2144
        },
        {
            &quot;installments&quot;: 8,
            &quot;installment_value&quot;: 270,
            &quot;taxes&quot;: 166,
            &quot;discount&quot;: 0,
            &quot;total_amount&quot;: 2166
        },
        {
            &quot;installments&quot;: 9,
            &quot;installment_value&quot;: 243,
            &quot;taxes&quot;: 187,
            &quot;discount&quot;: 0,
            &quot;total_amount&quot;: 2187
        },
        {
            &quot;installments&quot;: 10,
            &quot;installment_value&quot;: 220,
            &quot;taxes&quot;: 209,
            &quot;discount&quot;: 0,
            &quot;total_amount&quot;: 2209
        },
        {
            &quot;installments&quot;: 11,
            &quot;installment_value&quot;: 202,
            &quot;taxes&quot;: 231,
            &quot;discount&quot;: 0,
            &quot;total_amount&quot;: 2231
        },
        {
            &quot;installments&quot;: 12,
            &quot;installment_value&quot;: 187,
            &quot;taxes&quot;: 254,
            &quot;discount&quot;: 0,
            &quot;total_amount&quot;: 2254
        }
    ]
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-payment-calculation" hidden>
    <blockquote>Resposta recebida<span
                id="execution-response-status-GETapi-payment-calculation"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-payment-calculation"
      data-empty-response-text="<Resposta vazia>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-payment-calculation" hidden>
    <blockquote>Requisição falhou com erro:</blockquote>
    <pre><code id="execution-error-message-GETapi-payment-calculation">

Dica: Verifique se você está conectado corretamente à rede.
Se você é um mantenedor desta API, verifique se sua API está rodando e se você habilitou o CORS.
Você pode verificar o console das Ferramentas de Desenvolvedor para informações de depuração.</code></pre>
</span>
<form id="form-GETapi-payment-calculation" data-method="GET"
      data-path="api/payment-calculation"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-payment-calculation', this);">
    <h3>
        Requisição&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-payment-calculation"
                    onclick="tryItOut('GETapi-payment-calculation');">Experimente ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-payment-calculation"
                    onclick="cancelTryOut('GETapi-payment-calculation');" hidden>Cancelar 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-payment-calculation"
                    data-initial-text="Enviar Requisição 💥"
                    data-loading-text="⏱ Enviando..."
                    hidden>Enviar Requisição 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/payment-calculation</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Cabeçalhos</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-payment-calculation"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-payment-calculation"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Parâmetros de Consulta</b></h4>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>amount</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="amount"                data-endpoint="GETapi-payment-calculation"
               value="150"
               data-component="query">
    <br>
<p>Valor total da compra. Must be at least 0. Example: <code>150</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>payment_method</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="payment_method"                data-endpoint="GETapi-payment-calculation"
               value="credit_card"
               data-component="query">
    <br>
<p>Método de pagamento escolhido. Example: <code>credit_card</code></p>
Must be one of:
<ul style="list-style-type: square;"><li><code>credit_card</code></li> <li><code>pix</code></li></ul>
            </div>
                </form>

                <h1 id="produtos">Produtos</h1>

    

                                <h2 id="produtos-GETapi-products">Listar Produtos</h2>

<p>
</p>



<span id="example-requests-GETapi-products">
<blockquote>Exemplo de requisição:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/products" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/products"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-products">
            <blockquote>
            <p>Exemplo de resposta (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">[
    {
        &quot;id&quot;: 1,
        &quot;name&quot;: &quot;T&ecirc;nis Esportivo Runner&quot;,
        &quot;price&quot;: 29990,
        &quot;description&quot;: &quot;T&ecirc;nis ideal para corridas e atividades f&iacute;sicas, com amortecimento avan&ccedil;ado.&quot;
    },
    {
        &quot;id&quot;: 2,
        &quot;name&quot;: &quot;Camiseta B&aacute;sica Preta&quot;,
        &quot;price&quot;: 4990,
        &quot;description&quot;: &quot;Camiseta de algod&atilde;o confort&aacute;vel, perfeita para o dia a dia.&quot;
    },
    {
        &quot;id&quot;: 3,
        &quot;name&quot;: &quot;Cal&ccedil;a Jeans Slim&quot;,
        &quot;price&quot;: 15990,
        &quot;description&quot;: &quot;Cal&ccedil;a jeans com corte slim, estilo e conforto para qualquer ocasi&atilde;o.&quot;
    },
    {
        &quot;id&quot;: 4,
        &quot;name&quot;: &quot;Moletom Casual Cinza&quot;,
        &quot;price&quot;: 12990,
        &quot;description&quot;: &quot;Moletom macio e quente, ideal para dias mais frios.&quot;
    },
    {
        &quot;id&quot;: 5,
        &quot;name&quot;: &quot;Bon&eacute; Aba Reta&quot;,
        &quot;price&quot;: 7990,
        &quot;description&quot;: &quot;Bon&eacute; estiloso com aba reta, perfeito para completar seu look.&quot;
    }
]</code>
 </pre>
    </span>
<span id="execution-results-GETapi-products" hidden>
    <blockquote>Resposta recebida<span
                id="execution-response-status-GETapi-products"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-products"
      data-empty-response-text="<Resposta vazia>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-products" hidden>
    <blockquote>Requisição falhou com erro:</blockquote>
    <pre><code id="execution-error-message-GETapi-products">

Dica: Verifique se você está conectado corretamente à rede.
Se você é um mantenedor desta API, verifique se sua API está rodando e se você habilitou o CORS.
Você pode verificar o console das Ferramentas de Desenvolvedor para informações de depuração.</code></pre>
</span>
<form id="form-GETapi-products" data-method="GET"
      data-path="api/products"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-products', this);">
    <h3>
        Requisição&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-products"
                    onclick="tryItOut('GETapi-products');">Experimente ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-products"
                    onclick="cancelTryOut('GETapi-products');" hidden>Cancelar 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-products"
                    data-initial-text="Enviar Requisição 💥"
                    data-loading-text="⏱ Enviando..."
                    hidden>Enviar Requisição 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/products</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Cabeçalhos</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-products"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-products"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="produtos-GETapi-products--id-">Exibir Detalhes do Produto</h2>

<p>
</p>



<span id="example-requests-GETapi-products--id-">
<blockquote>Exemplo de requisição:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/products/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/products/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-products--id-">
            <blockquote>
            <p>Exemplo de resposta (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;id&quot;: 3,
    &quot;name&quot;: &quot;Cal&ccedil;a Jeans Slim&quot;,
    &quot;price&quot;: {
        &quot;value&quot;: 15990,
        &quot;formatted&quot;: &quot;159,90&quot;
    },
    &quot;description&quot;: &quot;Cal&ccedil;a jeans com corte slim, estilo e conforto para qualquer ocasi&atilde;o.&quot;
}</code>
 </pre>
            <blockquote>
            <p>Exemplo de resposta (404):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Produto n&atilde;o encontrado.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-products--id-" hidden>
    <blockquote>Resposta recebida<span
                id="execution-response-status-GETapi-products--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-products--id-"
      data-empty-response-text="<Resposta vazia>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-products--id-" hidden>
    <blockquote>Requisição falhou com erro:</blockquote>
    <pre><code id="execution-error-message-GETapi-products--id-">

Dica: Verifique se você está conectado corretamente à rede.
Se você é um mantenedor desta API, verifique se sua API está rodando e se você habilitou o CORS.
Você pode verificar o console das Ferramentas de Desenvolvedor para informações de depuração.</code></pre>
</span>
<form id="form-GETapi-products--id-" data-method="GET"
      data-path="api/products/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-products--id-', this);">
    <h3>
        Requisição&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-products--id-"
                    onclick="tryItOut('GETapi-products--id-');">Experimente ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-products--id-"
                    onclick="cancelTryOut('GETapi-products--id-');" hidden>Cancelar 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-products--id-"
                    data-initial-text="Enviar Requisição 💥"
                    data-loading-text="⏱ Enviando..."
                    hidden>Enviar Requisição 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/products/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Cabeçalhos</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-products--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-products--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>Parâmetros da URL</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="GETapi-products--id-"
               value="1"
               data-component="url">
    <br>
<p>ID do Produto. Example: <code>1</code></p>
            </div>
                    </form>

            

        
    </div>
    <div class="dark-box">
                    <div class="lang-selector">
                                                        <button type="button" class="lang-button" data-language-name="bash">bash</button>
                                                        <button type="button" class="lang-button" data-language-name="javascript">javascript</button>
                            </div>
            </div>
</div>
</body>
</html>
