# Desafio - Vaga - Pessoa desenvolvedora back-end PHP - Laravel

Olá, bem-vindo ao desafio **OM30** para a vaga Pessoa Desenvolvedora back-end PHP!

Mais importante do que dizer quem somos, é dizer no que acreditamos. A **OM30** é uma empresa que acredita na inovação como a melhor forma de trazer qualidade de vida às pessoas.

Pensando nisso, nosso teste para essa oportunidade, elaboramos um pequeno projeto desafio para conhecermos um pouco de sua experiência ;)

## Objetivo

Desenvolver uma API de cadastro de pacientes, do qual possamos testar toda sua capacidade de criação de arquitetura, qualidade do código, validações e usabilidade.

## Diferenciais técnicos para a vaga:
- Experiência em desenvolvimento integrações entre sistemas;
- Conhecimento na realização de testes automatizados;
- Conhecimento em Vue.js (Obs: é interessante apenas sabermos se você tem conhecimento ou já trabalhou com vue, não é necessário fazer nada de front-end em seu desafio, foque em desenvolver o back-end).

## Requisitos

Sua aplicação deve:

- Obrigatoriamente para o desenvolvimento do back-end utilizar o framework Laravel.
- Obrigatoriamente a API deve estar nos padrões RESTful.
- Desenvolver uma listagem de pacientes com busca, do qual deve-se permitir a adição, edição, visualização e exclusão de cada um dos pacientes.
- Cada paciente deve ter um endereço cadastrado em uma tabela à parte.
- Utilizar para banco de dados PostgreSQL e Redis (Cache e Queue).
- Utilizar migration, factory, faker e seeder.
- Criar um endpoint para listagem onde seja possível consultar pacientes pelo nome ou CPF.
- Criar um endpoint para obter os dados de um único pacientes (paciente e seu endereço).
- Criar endpoints de cadastro e atualização de paciente, contendo os campos e suas respectivas validações (Obs: use tudo que o framework(Laravel) te oferece para não criar códigos repetidos e desnecessários):
  - Foto do Paciente;
  - Nome Completo do Paciente;
  - Nome Completo da Mãe;
  - Data de Nascimento;
  - CPF;
  - CNS;
  - Endereço completo, (CEP, Endereço, Número, Complemento, Bairro, Cidade e Estado)*;
 - Criar um endpoint para excluir um paciente (paciente e seu endereço).
 - Criar um endpoint para consulta de CEP que implemente a API do ViaCEP e faça cache (Redis) dos dados para futuras consultas.
 - Criar um endpoint que faça importação de dados (pacientes) via arquivo .csv e seja processada em queue **assincronamente**.
 - Utilizar docker e docker-compose para execução do projeto (queremos avaliar seu conhecimento, seja criativo e não use o Laravel Sail).

## Diferenciais que você pode entregar no seu projeto:
  - Utilizar algum padrão para commits;
  - Possuir cobertura de testes unitários de 80% do código (*PHP Unit*);
  - Integrar a aplicação ao *Laravel Horizon* para o monitoramento das *queues*;
  - Utilizar o *supervisord* para o gerenciamento dos serviços necessários para o desenvolvimento e a execução do projeto;
  - Utilizar elasticsearch para busca otimizada de pacientes;
  - Paginar a listagem de pacientes;

## Material de apoio: 

   - Endereço: Utilizar a API do ViaCEP - https://viacep.com.br/;
   - Algoritmo para validação do CNS (https://integracao.esusab.ufsc.br/ledi/documentacao/regras/algoritmo_CNS.html);

## Entrega

A entrega deve ser feita em um repositório público no GitHub, que deve conter:

- O código do projeto versionado no github em repositório público.
- O projeto deve ser entregue de forma "containerizada", com banco de dados (postgres, redis, e php), lembrando das configurações necessárias para execução dos testes.
- O projeto deve ter em sua pasta root, uma collection do insomnia nomeada (endpoints.json) contendo endpoints necessários para os testes e a avaliação do desafio.
- Deixe o .env.exemple configurado de maneira que o avaliador possa apenas criar uma cópia do mesmo e rodar o projeto sem perder tempo tentando entender como configurar seu projeto.
- O projeto deve ter em sua pasta root, um arquivo nomeado import.csv contento o template necessário para a importação.
- Um arquivo *README* que descreva o que foi feito e as etapas para rodar o projeto, executar os testes e gerar o code coverage.
- Enviar o link do repositório para o seguinte e-mail: desenvolvimento@om30.com.br, rh@om30.com.br
- No assunto, indicar "Desafio OM30 - PHP Laravel - [Seu nome]". 
- Não esqueça de identificar o seu nome completo no corpo do e-mail também.