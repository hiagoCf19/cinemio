# Guia Rápido do Ambiente Docker (Cinemio)

Este documento serve como um guia rápido com os comandos e fluxos de trabalho essenciais para o desenvolvimento neste projeto.

## 1. Gerenciando os Contêineres

Comandos básicos para iniciar, parar e verificar o status do seu ambiente Docker.

- **Iniciar o ambiente (em background):**
  ```bash
  docker-compose up -d
  ```

- **Parar o ambiente:**
  ```bash
  docker-compose down
  ```

- **Verificar o status dos contêineres:**
  ```bash
  docker-compose ps
  ```

- **Reiniciar um serviço específico (ex: a aplicação):**
  ```bash
  docker-compose restart app
  ```

---

## 2. Trabalhando com a Aplicação (CodeIgniter)

Todos os comandos do CodeIgniter (`php spark`) devem ser executados de dentro do contêiner da aplicação.

### Acessando o Terminal da Aplicação (O Jeito Certo)

Para evitar problemas de permissão de arquivos entre o contêiner e a sua máquina, **sempre** use o comando abaixo para entrar no terminal. Ele executa os comandos com o seu usuário local, e não como `root`.

```bash
docker-compose exec --user $(id -u):$(id -g) app bash
```

### Criando um Arquivo de Migração

Depois de entrar no terminal com o comando acima, crie um novo arquivo de migração.

```bash
# Exemplo: criando uma tabela 'produtos'
php spark make:migration CreateProdutosTable
```
O novo arquivo será criado em `app/Database/Migrations/` e você poderá editá-lo normalmente no seu editor de código, sem precisar usar `sudo`.

### Rodando as Migrações

Para aplicar todas as migrações pendentes e atualizar a estrutura do banco de dados:

```bash
php spark migrate
```

### Revertendo a Última Migração

Para desfazer o último lote de migrações que foi aplicado:

```bash
php spark migrate:rollback
```

---

## 3. Acessando o Banco de Dados (PostgreSQL)

Para inspecionar o banco de dados diretamente via linha de comando.

- **1. Acesse o terminal do contêiner do banco:**
  ```bash
  docker-compose exec db bash
  ```

- **2. Conecte-se ao banco `cinemio` com o cliente `psql`:**
  ```bash
  psql -U ci_user -d cinemio
  ```

- **Comandos úteis dentro do `psql`:**
  - `\l`: Lista todos os bancos de dados.
  - `\dt`: Lista todas as tabelas do banco de dados atual.
  - `SELECT * FROM migrations;`: Mostra quais migrações já foram executadas.
  - `\q`: Sai do `psql`.

---

## 4. Solução de Problemas Comuns

- **"Rodei `php spark migrate` com o arquivo vazio e agora ele não roda de novo!"**
  - A migração foi registrada como "executada". Você precisa apagar o registro manualmente no seu cliente de banco (DBeaver, etc.) antes de tentar rodar de novo.
  ```sql
  -- Substitua o nome da classe pelo da sua migração
  DELETE FROM migrations WHERE class = 'App\Database\Migrations\NomeDaSuaMigration';
  ```

- **"Criei um arquivo e não consigo editar (erro de permissão)!"**
  - Isso acontece se você criou o arquivo como `root` (usando `docker-compose exec app bash` sem a flag `--user`). Para corrigir a permissão de todos os arquivos do projeto de uma vez, rode na sua máquina local:
  ```bash
  sudo chown -R $(whoami):$(whoami) .
  ```

---

## 5. Acesso aos Serviços

- **Aplicação (CodeIgniter):** http://localhost:8080
- **MinIO (Painel):** http://localhost:9001
- **Keycloak (Painel):** http://localhost:8005
- **PostgreSQL (para DBeaver/etc):**
  - **Host:** `localhost`
  - **Porta:** `5432`
  - **Usuário:** `ci_user`
  - **Senha:** `ci_pass`
  - **Database:** `cinemio`
