# API App

Este é um projeto de API configurado com Docker para facilitar o desenvolvimento. Aqui estão as instruções sobre como configurar e iniciar o projeto, incluindo a migração do banco de dados.

## Pré-requisitos

- Docker e Docker Compose devem estar instalados em sua máquina. Se você ainda não os instalou, consulte [a documentação do Docker](https://docs.docker.com/get-docker/) para obter instruções sobre como instalá-los.

## Configuração e Início do Projeto

1. **Clone o repositório**:
    - Primeiro, clone o repositório do projeto para a sua máquina local:

    ```bash
    git clone <URL_do_repositório>
    cd <nome_do_repositório>
    ```
2. **Arquivo .env**:
    - remova o 'EXEMPLE' do arquivo .env na raiz do projeto

    ```bash
   .env.EXEMPLE
    ```

3. **Inicie os contêineres Docker**:
    - Você pode usar o Docker Compose para iniciar o projeto. Execute o comando a partir do diretório raiz do projeto:

    ```bash
    docker-compose up --build
    ```

    - Isso construirá e iniciará os contêineres com a API.

4. **Realize a migração no banco de dados**:
    - Após iniciar os contêineres, entre na máquina do contêiner PHP para realizar a migração no banco de dados. Use o comando abaixo para acessar o contêiner PHP:

    ```bash
    docker exec -it <nome_do_contêiner_php> bash
    ```

    - Uma vez dentro do contêiner PHP, execute o comando de migração:

    ```bash
    php artisan migrate
    ```

    - Este comando aplicará todas as migrações necessárias ao banco de dados para configurar o esquema correto.

5. **Saia do contêiner PHP**:
    - Quando a migração estiver concluída, você pode sair do contêiner PHP digitando `exit`.

6. **Acesse a API**:
    - Após realizar a migração e garantir que os contêineres estejam em execução, você poderá acessar a API em seu navegador ou por meio de ferramentas de teste de API no seguinte endereço:

    ```plaintext
    http://localhost:<porta_da_API>/
    ```

7. **Parar os contêineres**:
    - Para parar os contêineres, execute o comando:

    ```bash
    docker-compose down
    ```

## Notas

- Certifique-se de que o banco de dados está configurado corretamente e que as credenciais estão corretas nos arquivos de configuração.
- Consulte a documentação do framework de sua API para mais informações sobre comandos e configurações específicos.

## Recursos Adicionais

- Consulte a [documentação do Docker](https://docs.docker.com/) para obter mais informações sobre como usar o Docker.
- Consulte a documentação do framework usado pela API para obter mais informações sobre o framework e suas funcionalidades.

## Licença

Este projeto está licenciado sob uma licença específica. Consulte o arquivo `LICENSE` para obter mais detalhes.
