# Projeto2_C214

-  Lucas Sawada Obana - 241
-  Pedro Hugo Coura Macaiba - 245

## Projeto PHP com PHPUnit

Este projeto PHP utiliza o PHPUnit para realizar testes unitários. Este README contém um guia passo a passo sobre como configurar o ambiente, instalar as dependências e executar os testes.

## Pré-requisitos

Antes de começar, verifique se você tem os seguintes requisitos instalados:

- [PHP](https://www.php.net/downloads.php) (recomendado PHP 8.1 ou superior)
- [Composer](https://getcomposer.org/) (gerenciador de dependências PHP)

## Instalação

Siga os passos abaixo para configurar o ambiente de desenvolvimento.

Execute os comandos para instalar as dependências.
- `composer install`
- `composer require --dev phpunit/phpunit ^11`

Abra o arquivo `composer.json` e edite a seção "autoload" para configurar o autoload das classes:
```json
{
  "autoload": {
    "psr-4": {
      "src\\": "src/",
      "tests\\": "tests/"
    }
  },
  "require-dev": {
    "phpunit/phpunit": "^11"
  }
}
```

Rode o comando para atualizar o psr-4
- `composer dump-autoload`

### Por fim
 Rode o comando para executar os testes
 - `php vendor\\bin\\phpunit tests\\IMCTest.php`
