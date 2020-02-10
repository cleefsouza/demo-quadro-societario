
# Quadro Societário API
API Rest para cadastro de empresas e seu quadro de sócios de uma forma simples e prática.

## Começando
Essas instruções fornecerão um passo-a-passo para executar o projeto localmente.

#### Pré-requisitos
É necessário ter instalado/configurado em sua máquina as seguintes tecnologias
* [PHP 7.1+](https://www.php.net/docs.php)
* [Composer Dependency Manager](https://getcomposer.org/)

#### Tecnologias Utilizadas
* [Symfony 4](https://symfony.com/doc/4.0/setup.html) - Framework PHP
* [Insomnia 4+](https://insomnia.rest/) - Rest Client
* [PostgreSQL](https://www.pgadmin.org/download/) - Sistema Gerenciador de Banco de Dados
* [PhpStorm](https://www.jetbrains.com/phpstorm/download/download-thanks.html) - IDE para Desenvolvimento PHP

**Obs:**  Caso não possua instalado em sua máquina algumas das tecnologias listadas a cima, clique no nome da tecnologia que você será direcionado para a página de downloads oficial da mesma.

#### Instalação
Abra o diretório de sua preferência e execute os seguintes comandos em seu terminal

* Realize o `clone` do repositório:
```
git clone https://gitlab.com/cleefsouza/app-quadro-societario.git
cd app-quadro-societario/api-rest
```

* Instale as bibliotecas do projeto
```
composer install
```
  
#### Configurando Conexão com Banco de Dados
* No arquivo .env na pasta raiz do projeto adicione a seguinte linha caso não exista (substitua o que estiver dentro dos `[ ]` por suas credenciais)
```
DATABASE_URL=postgresql://[db_user]:[db_password]@127.0.0.1:5432/db_quadro_societario?serverVersion=11&charset=utf8
```

* Execute o seguinte comando para criar o banco de dados
```
php bin/console doctrine:database:create
```

* Execute a migração dos dados mapeados para o banco
```
php bin/console doctrine:migrations:diff
php bin/console doctrine:migrations:migrate
```

**Obs:** Antes de executar o comando para criar o banco de dados, se estiver no sistema operacional `Windows` atente-se a um ponto. Quando o PHP é instalado, ele `não vem com o PostgreSQL habilitado`. Será necessário buscar o arquivo php.ini-development ou php.ini-production, copiá-lo e colá-lo com o nome php.ini. Se já houver um arquivo php.ini, pode apenas editá-lo sem problemas. Em um editor, pressione `Ctrl + F` e busque por `pdo_pgsql`. Você encontrará a linha `;extension=pdo_pgsql`, que originalmente possui um ponto e vírgula `;` na frente. Remova o `;` e salve a sua alteração usando `Ctrl + S`. Assim a extensão será habilitada

## Executando Testes

#### Servidor
* Dentro da pasta do projeto execute o seguinte comando para subir o servidor localmente
```
php -S localhost:8080 -t public
```

#### Rest Client
* Execute o `Insomnia`
* Siga o menu `Application > Preferences > Data > Import Data > From File`, adicione o arquivo abaixo que está na pasta raiz do projeto e clique em `OK`
```
testes_insomnia_2020-02-08.json
```

#### Index

##### POST
* Informações da API
> URL: git `localhost:8080/`
<br/> Response Body:
```json
{
    "api": "quadro-societario-api",
    "versao": "0.1",
    "descicao": "API Rest para cadastro de empresas e seu quadro de sócios de uma forma simples e prática.",
    "autor": "Aryosvalldo Cleef de Souza",
    "repositorio": "https:\/\/gitlab.com\/cleefsouza\/app-quadro-societario",
    "metodo": "GET",
    "url": "http:\/\/localhost:8080\/",
    "content": null
}
```

#### Empresa

##### POST
* Inserir empresa
> URL: `localhost:8080/empresa`
<br/> Request Body:
```json
{
    "razaoSocial": "Exemplo Tecnologia LTDA",
    "nomeFantasia": "Ex Tecnologia",
    "cnpj": "12345678910000",
    "atividadePrincipal": "Desenvolvimento de programas e software",
    "dataAbertura": "2020-02-08",
    "situacaoCadastral": true
}
```

##### GET
* Buscar empresa por `id`
> URL: `localhost:8080/empresa/1`
<br/>Response Body:
```json
{
    "id" : 1,
    "razaoSocial": "Exemplo Tecnologia LTDA",
    "nomeFantasia": "Ex Tecnologia",
    "cnpj": "12345678910000",
    "atividadePrincipal": "Desenvolvimento de programas e software",
    "dataAbertura": "08/02/2020",
    "situacaoCadastral": true
}
```

* Buscar todas as empresas
> URL: `localhost:8080/empresas`
<br/>Response Body:
```json
{
    "id" : 1,
    "razaoSocial": "Exemplo Tecnologia LTDA",
    "nomeFantasia": "Ex Tecnologia",
    "cnpj": "12345678910000",
    "atividadePrincipal": "Desenvolvimento de programas e software",
    "dataAbertura": "08/02/2020",
    "situacaoCadastral": true
},
{
    ...
}
```

##### PUT
* Alterar empresa por `id`
> URL: `localhost:8080/empresa/1`
<br/>Request Body:
```json
{
    "razaoSocial": "Exemplo Tecnologia LTDA",
    "nomeFantasia": "Ex Tech",
    "cnpj": "12345678911111",
    "atividadePrincipal": "Desenvolvimento de software",
    "dataAbertura": "2020-02-08",
    "situacaoCadastral": false
}
```

##### DELETE
* Deletar empresa por `id`
> URL: `localhost:8080/empresa/1`

#### Sócio

##### POST
* Inserir sócio 
> URL: `localhost:8080/socio`
<br/>Request Body:
```json
{
    "nomeCompleto" : "Exemplo da Silva",
    "cpf" : "12345678910",
    "email" : "ex_silva@gmail.com",
    "sexo" : "Masculino",
    "nascimento" : "1995-07-03",
    "empresaId" : 1
}
```

##### GET
* Buscar socio por `id`
> URL: `localhost:8080/socio/1`
<br/>Response Body:
```json
{
    "id" : 1,
    "nomeCompleto" : "Exemplo da Silva",
    "cpf" : "12345678910",
    "email" : "ex_silva@gmail.com",
    "sexo" : "Masculino",
    "nascimento" : "03/07/1995",
    "empresaId" : 1
}
```

* Buscar todos os sócios
> URL: `localhost:8080/socios`
<br/>Response Body:
```json
{
    "id" : 1,
    "nomeCompleto" : "Exemplo da Silva",
    "cpf" : "12345678910",
    "email" : "ex_silva@gmail.com",
    "sexo" : "Masculino",
    "nascimento" : "03/07/1995",
    "empresaId" : 1
},
{
    ...
}
```

* Buscar todos os sócios de uma determinada empresa
> URL: `localhost:8080/socios/empresa/1`
<br/>Response Body:
```json
{
    "id" : 1,
    "nomeCompleto" : "Exemplo da Silva",
    "cpf" : "12345678910",
    "email" : "ex_silva@gmail.com",
    "sexo" : "Masculino",
    "nascimento" : "03/07/1995",
    "empresaId" : 1
},
{
    ...
}
```

##### PUT
* Alterar sócio por `id`
> URL: `localhost:8080/socio/1`
<br/>Request Body:
```json
{
    "nomeCompleto" : "Exemplo de Souza",
    "cpf" : "12345678910",
    "email" : "ex_souza@hotmail.com",
    "sexo" : "Masculino",
    "nascimento" : "1994-07-03",
    "empresaId" : 1
}
```

##### DELETE
* Deletar sócio por `id`
> URL: `localhost:8080/socio/1`

## Equipe
  * Aryosvalldo Cleef de Souza - [Linkedin](https://www.linkedin.com/in/aryosvalldo-cleef/)