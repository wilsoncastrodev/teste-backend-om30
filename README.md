
# Teste - Empresa OM30 - Vaga Pessoa Desenvolvedora Back-end PHP - Laravel 

![PHP](https://img.shields.io/badge/php-%23777BB4.svg?style=for-the-badge&logo=php&logoColor=white)  ![Laravel](https://img.shields.io/badge/laravel-%23FF2D20.svg?style=for-the-badge&logo=laravel&logoColor=white) ![PostgreSQL](https://img.shields.io/static/v1?style=for-the-badge&message=PostgreSQL&color=4169E1&logo=PostgreSQL&logoColor=FFFFFF&label=)  ![Nginx](https://img.shields.io/badge/nginx-%23009639.svg?style=for-the-badge&logo=nginx&logoColor=white)  ![Laravel Horizon](https://img.shields.io/static/v1?style=for-the-badge&message=Laravel+Horizon&color=405263&logo=Laravel+Horizon&logoColor=FFFFFF&label=)   ![Redis](https://img.shields.io/badge/redis-%23DD0031.svg?style=for-the-badge&logo=redis&logoColor=white)  ![ElasticSearch](https://img.shields.io/badge/-ElasticSearch-005571?style=for-the-badge&logo=elasticsearch)  ![Docker](https://img.shields.io/static/v1?style=for-the-badge&message=Docker&color=2496ED&logo=Docker&logoColor=FFFFFF&label=)  ![Git](https://img.shields.io/static/v1?style=for-the-badge&message=Git&color=F05032&logo=Git&logoColor=FFFFFF&label=)  ![GitHub](https://img.shields.io/static/v1?style=for-the-badge&message=GitHub&color=181717&logo=GitHub&logoColor=FFFFFF&label=)  ![Linux](https://img.shields.io/static/v1?style=for-the-badge&message=Linux&color=222222&logo=Linux&logoColor=FCC624&label=)

## Objetivo
Desenvolver uma API de cadastro de pacientes.

![Challenge - Completed](https://img.shields.io/badge/Challenge-Completed-31c754) ![PHPUnit - Passing](https://img.shields.io/badge/PHPUnit-Passing-31c754) ![Tests - 36 passed](https://img.shields.io/badge/Tests-36_passed-31c754) ![Coverage - 86.9%](https://img.shields.io/badge/Coverage-86.9%25-a1ce1f) ![Commits - 14](https://img.shields.io/badge/Commits-14-23bbca)

## Instruções do Teste
- [Clique aqui](https://github.com/wilsoncastrodev/teste-backend-om30/blob/master/TESTE.md) para visualizar as instruções do teste

## Índice
- [Funcionalidades Implementadas](#funcionalidades-implementadas)
- [Diferenciais Implementados](#diferenciais-implementados)
- [Informações Adicionais](#informações-adicionais)
- [Estrutura de Diretórios](#estrutura-de-diretórios)
- [Instalação e Execução da Aplicação](#instalação-e-execução-da-aplicação)
- [Modelo de Dados Lógicos](#modelo-de-dados-lógicos)
- [Documentação da API](#documentação-da-api)
- [Screenshots API](#screenshots-api)
- [Screenshots Testes Unitários](#screenshots-testes-unitários)
- [Screenshots Laravel Horizon](#screenshots-laravel-horizon)
- [APIs Utilizadas](#apis-utilizadas)
- [Depedências Utilizadas](#depedências-utilizadas)
- [Tecnologias Utilizadas](#tecnologias-utilizadas)
- [Referências](#referências)
- [Agradecimentos](#agradecimentos)
- [Contato](#contato)
- [Autores](#autores)
- [Licença](#licença)

## Funcionalidades Implementadas
- Listagem de pacientes com e sem paginação;
- Cadastro e atualização de pacientes;
- Exclusão de paciente com o seu endereço;
- Consulta de um único paciente;
- Busca de pacientes por meio do nome ou CPF utilizando ElasticSearch com e sem paginação;
- Instalação do supervisord para gerenciar os serviços;
- Instalação do Laravel Horizon para o monitoramento das filas;
- Busca de endereço por meio da API Viacep e utilizando Cache com Redis;
- Importação de pacientes por meio de arquivo CSV utilizando Queues do Laravel;

## Diferenciais Implementados
- Geração de CNS fakes utilizando a API Gerador Brasileiro;
- Utilização do padrão de projeto Observer para implementação do Log de acesso de usuários;
- Utilização do padrão de projeto Service para implementação das regras de negócio;
- Utilização do padrão de projeto Repository para implementação das consultas ao banco de dados;

## Informações Adicionais
- O resultado da cobertura de testes unitários foi de 86.9%;
- Foram criados os arquivos Migrations, Factories com Fakers e Seeders;
- Foram utilizados Docker e Docker Compose para desenvolvimento e execução do projeto;
- Foram criadas tabelas de pacientes e endereços separadas;
- O arquivo import.csv contém 1.000 pacientes registrados para testar a importação dos pacientes;
- Para validação de dados como CPF, CNS e CEP foi utilizado a dependência "Laravel Custom Validation";

> Nota: Utilizei a dependência "Laravel Custom Validation" apenas para simplificar o trabalho de ter que converter o código contido no material de apoio do desafio para PHP.

## Instalação e Execução da Aplicação

#### Pré-requisitos
São necessários os seguintes requisitos instalados na máquina local para testar a aplicação:
- Docker
- Docker Compose

### Instalando e executando o projeto com o Docker
- Clone o repositório:

```bash
  git clone https://github.com/wilsoncastrodev/teste-backend-om30.git
```
- Em seguida, entre no diretório raiz do projeto utilizando o comando a seguir:

```bash
  cd teste-backend-om30
```
- Execute o seguinte comando para iniciar a execução dos containers do Docker:

```bash
  docker-compose up -d
```
- Caso o servidor esteja sendo executado pela primeira vez é necessário rodar o comando abaixo, para carregar as dependências e realizar as configurações necessárias para que aplicação funcione corretamente:

```bash
  docker exec -it om30-server-app-php bash ../server-init.sh
```
- Se a instalação tiver ocorrido normalmente, abra o Insomnia e realize a importação do Workspace do Insomnia contido no arquivo "endpoints.json" localizado no diretório raiz do projeto.

- Se chegou até aqui, o projeto está pronto para execução.

- Agora, para gerenciar as filas do Laravel utilizando o painel do Laravel Horizon, abra o navegador e execute a URL a seguir:

```bash
  http://localhost:7000/horizon
```

> Nota: Ao importar os pacientes utilize o arquivo "import.csv" como modelo, que está localizado no diretório raiz do projeto.

## Rodando os testes

- Para rodar os testes, rode o seguinte comando:

```bash
  docker exec -it om30-server-app-php php artisan test
```

- Para gerar o relatório de cobertura de testes execute o comando a seguir:

```bash
  docker exec -it om30-server-app-php php artisan test --coverage
```
    
## Modelo de Dados Lógicos

![App Screenshot](https://github.com/wilsoncastrodev/teste-backend-om30/blob/master/server-app/public/images/database/imagem1.png)

## Estrutura de Diretórios
- Dentro do projeto você encontrará os seguintes diretórios:

```
teste-backend-OM30
│── database-app
│── elasticsearch-app
│── redis-app
│── server-app
│   │── app
│   │   │── Http
│   │   │   │── Requests
│   │   │   │── Resources
│   │   │   │── Controllers
│   │   │   │── Kernel.php
│   │   │   └── Middleware
│   │   │── Interfaces
│   │   │── Exceptions
│   │   │── Providers
│   │   │── Repositories
│   │   │── Models
│   │   │── Services
│   │   │── Imports
│   │   │── Jobs
│   │   │── Helpers
│   │   │── Observers
│   │   └── Console
│   │── bootstrap
│   │   └── cache
│   │── config
│   │── database
│   │   │── factories
│   │   │── migrations
│   │   └── seeders
│   │── nginx
│   │── resources
│   │   │── views
│   │   │── css
│   │   └── js
│   │── routes
│   │── public
│   │── storage
│   │   │── logs
│   │   │── framework
│   │   └── app
│   │       │── public
│   │       │   └── patients
│   │       │       │── photos
│   │       │       └── files
│   │── tests
│   │   │── Feature
│   │   │   │── Controllers
│   │   │   │── Repositories
│   │   │   │── Models
│   │   │   └── Services
│   │   │── Unit
│   │   │── storage
│   └── vendor
```

## Documentação da API

### Pacientes

#### Endpoints
| Método   | Rota       | Descrição                                   |
| :---------- | :--------- | :------------------------------------------ |
| `GET`      | `api/v1/patients` | Consuta lista de pacientes |
| `GET`      | `api/v1/patients/paginate/${length}` | Consulta lista de pacientes com paginação |
| `GET`      | `api/v1/patients/${patient}` | Consulta paciente por meio ID |
| `GET`      | `api/v1/search/${query}` | Busca paciente por meio do Nome ou CPF |
| `GET`      | `api/v1/patients/search/${query}/paginate/${length}` |  Busca paciente por meio do Nome ou CPF com paginação |
| `POST`      | `api/v1/patients` | Cria paciente |
| `POST`      | `api/v1/patients/import` | Importa pacientes a partir de um arquivo CSV |
| `POST`      | `api/v1/patients/${patient}` | Atualiza paciente por ID |
| `DELETE`      | `api/v1/patients/${patient}` | Exclui paciente por ID |

#### Retorna todos os pacientes

```
  GET /api/v1/patients
```
Exemplo de Resposta:

```json
{
    "data": [
        {
            "id": 1,
            "name": "Breno Ávila Lozano",
            "mother_name": "Analu Medina Garcia",
            "birth_date": "25/10/1990",
            "cpf": "784.378.067-04",
            "cns": "9402152860018",
            "photo": "http://localhost:7000/storage/patients/photos/breno-avila-lozano-1681316833.png",
            "created_at": "2023-04-12T16:27:13.000000Z",
            "updated_at": "2023-04-12T16:27:13.000000Z",
            "address": {
                "id": 1,
                "patient_id": 1,
                "zipcode": "05581-001",
                "address": "Avenida Corifeu de Azevedo Marques",
                "number": 45,
                "complement": "Casa 2",
                "neighborhood": "Butantã",
                "city": "São Paulo",
                "state": "SP",
                "created_at": "2023-04-12T16:27:13.000000Z",
                "updated_at": "2023-04-12T16:27:13.000000Z"
            }
        }
    ]
}
```

#### Retorna todos os pacientes com paginação

```
  GET /api/v1/patients/paginate/${length}
```

| Parâmetro   | Tipo       | Descrição                                   |
| :---------- | :--------- | :------------------------------------------ |
| `length`      | `integer` | **Obrigatório**. Quantidade de paciente por página. |

Exemplo de Resposta:

```json
{
    "data": {
        "current_page": 1,
        "data": [
            {
                "id": 2,
                "name": "Melissa Deverso Neves",
                "mother_name": "Tâmara Carmona Maia",
                "birth_date": "15/09/1988",
                "cpf": "130.692.320-43",
                "cns": "859072802785304",
                "photo": null,
                "created_at": "2023-04-12T16:13:25.000000Z",
                "updated_at": "2023-04-12T16:13:25.000000Z",
                "address": {
                    "id": 2,
                    "patient_id": 2,
                    "zipcode": "35359-937",
                    "address": "Travessa Simão",
                    "number": 3674,
                    "complement": "Bc. 19 Ap. 03",
                    "neighborhood": "Maldonado Serra",
                    "city": "Nayara do Sul",
                    "state": "MA",
                    "created_at": "2023-04-12T16:13:25.000000Z",
                    "updated_at": "2023-04-12T16:13:25.000000Z"
                }
            },
        ],
        "first_page_url": "http://localhost:7000/api/v1/patients/search/Melissa/paginate/5?query=Melissa&page=1",
        "from": 1,
        "last_page": 1,
        "last_page_url": "http://localhost:7000/api/v1/patients/search/Melissa/paginate/5?query=Melissa&page=1",
        "next_page_url": null,
        "path": "http://localhost:7000/api/v1/patients/search/Melissa/paginate/5",
        "per_page": 5,
        "prev_page_url": null,
        "to": 2,
        "total": 5
    }
}
```

#### Retorna um paciente

```
  GET /api/v1/patients/${patient}
```

| Parâmetro   | Tipo       | Descrição                                   |
| :---------- | :--------- | :------------------------------------------ |
| `patient`      | `integer` | **Obrigatório**. ID do paciente. |

Exemplo de Resposta:

```json
{
    "data": {
        "id": 3,
        "name": "William Sanches de Souza",
        "mother_name": "Maria Delvalle Lourenço",
        "birth_date": "12/05/1988",
        "cpf": "056.129.486-03",
        "cns": "913705770463018",
        "photo": null,
        "created_at": "2023-04-12T16:13:34.000000Z",
        "updated_at": "2023-04-12T16:13:34.000000Z",
        "address": {
            "id": 3,
            "patient_id": 3,
            "zipcode": "87944-234",
            "address": "Travessa Yuri",
            "number": 211,
            "complement": "Bloco C",
            "neighborhood": "Matias Maldonado",
            "city": "Vieira d'Oeste",
            "state": "TO",
            "created_at": "2023-04-12T16:13:34.000000Z",
            "updated_at": "2023-04-12T16:13:34.000000Z"
        }
    }
}
```

#### Busca pacientes pelo Nome ou CPF

```
  GET /api/v1/search/${query}
```

| Parâmetro   | Tipo       | Descrição                                   |
| :---------- | :--------- | :------------------------------------------ |
| `query`      | `string` | **Obrigatório**. Nome ou CPF do paciente. |

Exemplo de Resposta:

```json
{
    "data": [
        {
            "id": 4,
            "name": "Carlos Beltrão Pena",
            "mother_name": "Sophie Brito de Freitas",
            "birth_date": "29/10/2005",
            "cpf": "763.652.308-69",
            "cns": "799659171350983",
            "photo": null,
            "created_at": "2023-04-12T16:13:17.000000Z",
            "updated_at": "2023-04-12T16:13:17.000000Z",
            "address": {
                "id": 4,
                "patient_id": 4,
                "zipcode": "96285-208",
                "address": "Travessa Alves",
                "number": 4529,
                "complement": "Apto 729",
                "neighborhood": "Solano Furtado",
                "city": "São Thomas do Norte",
                "state": "AL",
                "created_at": "2023-04-12T16:13:17.000000Z",
                "updated_at": "2023-04-12T16:13:17.000000Z"
            }
        }
    ]
}
```

#### Busca pacientes pelo Nome ou CPF com paginação

```
  GET /api/v1/search/${query}/paginate/${length}
```

| Parâmetro   | Tipo       | Descrição                                   |
| :---------- | :--------- | :------------------------------------------ |
| `query`      | `string` | **Obrigatório**. Nome ou CPF do paciente. |
| `length`      | `string` | **Obrigatório**. Quantidade de paciente por página. |

Exemplo de Resposta:

```json
{
    "data": {
        "current_page": 1,
        "data": [
            {
                "id": 4,
                "name": "Carlos Beltrão Pena",
                "mother_name": "Sophie Brito de Freitas",
                "birth_date": "29/10/2005",
                "cpf": "763.652.308-69",
                "cns": "799659171350983",
                "photo": null,
                "created_at": "2023-04-12T16:13:17.000000Z",
                "updated_at": "2023-04-12T16:13:17.000000Z",
                "address": {
                    "id": 4,
                    "patient_id": 4,
                    "zipcode": "96285-208",
                    "address": "Travessa Alves",
                    "number": 4529,
                    "complement": "Apto 729",
                    "neighborhood": "Solano Furtado",
                    "city": "São Thomas do Norte",
                    "state": "AL",
                    "created_at": "2023-04-12T16:13:17.000000Z",
                    "updated_at": "2023-04-12T16:13:17.000000Z"
                }
            }
        ],
        "first_page_url": "http://localhost:7000/api/v1/patients/search/Carlos/paginate/5?query=Carlos&page=1",
        "from": 1,
        "last_page": 1,
        "last_page_url": "http://localhost:7000/api/v1/patients/search/Carlos/paginate/5?query=Carlos&page=1",
        "next_page_url": null,
        "path": "http://localhost:7000/api/v1/patients/search/Carlos/paginate/5",
        "per_page": 5,
        "prev_page_url": null,
        "to": 2,
        "total": 4
    }
}
```

#### Cadastra um paciente

```
  POST /api/v1/patients
```

Exemplo de corpo de Requisição:
```json
{
    "name": "Breno Ávila Lozano",
    "mother_name": "Analu Medina Garcia",
    "birth_date": "25/10/1990",
    "cpf": "784.378.067-04",
    "cns": "943602152860018",
    "photo": null,
    "zipcode": "05581-001",
    "address": "Avenida Corifeu de Azevedo Marques",
    "number": 45,
    "complement": "Casa 2",
    "neighborhood": "Butantã",
    "city": "São Paulo",
    "state": "SP",
}
```

#### Atualiza um paciente

```
  PATCH /api/v1/patients/${patient}
```

| Parâmetro   | Tipo       | Descrição                                   |
| :---------- | :--------- | :------------------------------------------ |
| `patient`      | `integer` | **Obrigatório**. ID do paciente. |

Exemplo de corpo de Requisição:
```json
{
    "name": "Laís Uchoa Urias",
    "mother_name": "Maria Delvalle Lourenço",
    "birth_date": "11/10/1981",
    "cpf": "333.691.948-72",
    "cns": "157556991340001",
    "photo": null,
    "zipcode": "30514-150",
    "address": "Rua Senador Lemos",
    "number": "8979",
    "complement": "Apto 150",
    "neighborhood": "Vista Alegre",
    "city": "Belo Horizonte",
    "state": "MG",
}
```

#### Exclui um paciente

```
  DELETE /api/v1/patients/${patient}
```

| Parâmetro   | Tipo       | Descrição                                   |
| :---------- | :--------- | :------------------------------------------ |
| `patient`      | `integer` | **Obrigatório**. ID do paciente. |

### Endereços

#### Endpoints
| Método   | Rota       | Descrição                                   |
| :---------- | :--------- | :------------------------------------------ |
| `POST`      | `api/v1/address/search` | Busca o endereço por meio do CEP |

#### Retorna o Endereço

```
  POST /api/v1/address/search
```

Exemplo de corpo de Requisição:
```json
{
    "zipcode": "30514-150",
}
```

Exemplo de Resposta:

```json
{
    "data": {
        "cep": "30514-150",
        "logradouro": "Rua Senador Lemos",
        "complemento": "",
        "bairro": "Vista Alegre",
        "localidade": "Belo Horizonte",
        "uf": "MG",
        "ibge": "3106200",
        "gia": "",
        "ddd": "31",
        "siafi": "4123"
    }
}
```

## Screenshots API

![App Screenshot](https://github.com/wilsoncastrodev/teste-backend-om30/blob/master/server-app/public/images/app/imagem1.png)

![App Screenshot](https://github.com/wilsoncastrodev/teste-backend-om30/blob/master/server-app/public/images/app/imagem2.png)

![App Screenshot](https://github.com/wilsoncastrodev/teste-backend-om30/blob/master/server-app/public/images/app/imagem3.png)

![App Screenshot](https://github.com/wilsoncastrodev/teste-backend-om30/blob/master/server-app/public/images/app/imagem4.png)

![App Screenshot](https://github.com/wilsoncastrodev/teste-backend-om30/blob/master/server-app/public/images/app/imagem5.png)

![App Screenshot](https://github.com/wilsoncastrodev/teste-backend-om30/blob/master/server-app/public/images/app/imagem6.png)

## Screenshots Testes Unitários

![App Screenshot](https://github.com/wilsoncastrodev/teste-backend-om30/blob/master/server-app/public/images/tests/imagem1.png)

![App Screenshot](https://github.com/wilsoncastrodev/teste-backend-om30/blob/master/server-app/public/images/tests/imagem2.png)

![App Screenshot](https://github.com/wilsoncastrodev/teste-backend-om30/blob/master/server-app/public/images/tests/imagem3.png)

## Screenshots Laravel Horizon

![App Screenshot](https://github.com/wilsoncastrodev/teste-backend-om30/blob/master/server-app/public/images/horizon/imagem1.png)

## APIs Utilizadas

- [ViaCEP](https://viacep.com.br/)
- [Gerador Brasileiro](https://geradorbrasileiro.com/api-doc)

## Depedências Utilizadas

- [Elastic Scout Driver (Autor: Ivan Babenko)](https://github.com/babenkoivan/elastic-scout-driver)
- [Laravel Scout (Autor: Taylor Otwell)](https://github.com/laravel/scout)
- [Laravel Excel (Autor: Patrick Brouwers)](https://github.com/SpartnerNL/Laravel-Excel)
- [Predis (Autor: Till Krüss)](https://github.com/predis/predis)
- [Laravel Custom Validation (Autor: Roberson A. Faria)](https://github.com/robersonfaria/validation)

> Nota: A dependência "Laravel Custom Validation" está desatualizada, então eu realizei um Fork e fiz as modificações necessárias para que ela funcionasse corretamente no projeto que está utilzando a versão do PHP 8.x e Laravel 10.x.

## Tecnologias Utilizadas

| Tecnologia | Versão
| :---: | :---: |
| PHP| 8.x |
| Laravel | 10.x |
| Laravel Horizon | 5.x |
| Postgres | 15.x |
| pgAdmin | 4.x |
| Nginx | 1.x |
| Redis | 7.x |
| Elasticsearch | 8.x |
| Docker (Docker Compose) | 23.x (3.x) |
| Phpunit | 10.x |
| APIs REST/RESTful | - |
| Git | - |

## Referências
 - [Documentação do Laravel](https://laravel.com/docs/10.x/)

## Agradecimentos
Agradeço a equipe da OM30 por ter desenvolvido este excelente desafio, que me permitiu testar minhas habilidades com Laravel. Que Deus possa abençoá-los.

## Contato
Qualquer coisa, sinta-se à vontade para entrar em contato comigo pelo e-mail contato@wilsoncastro.dev.

## Autores
- [@wcastro](https://github.com/wilsoncastrodev)

## Licença
[![MIT License](https://img.shields.io/badge/License-MIT-green.svg)](https://choosealicense.com/licenses/mit/)