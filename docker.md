# Guia de Docker para Projeto Hospital

Este guia explica como parar, iniciar e copiar/importar o dump do banco de dados MySQL do projeto.

---

## 1️⃣ Parar os containers

### Parar sem remover volumes (mantém os dados do MySQL)

```bash
docker-compose down
```

### Parar e remover volumes (apaga os dados do MySQL)

```bash
docker-compose down -v
```

> ⚠️ Use `-v` apenas se quiser resetar o banco.

### Parar containers individualmente

```bash
docker stop projeto_hospital_web projeto_hospital_db
```

---

## 2️⃣ Iniciar os containers

### Subir todos os containers do projeto

```bash
docker-compose up -d
```

### Subir containers específicos

```bash
docker start projeto_hospital_web projeto_hospital_db
```

### Verificar containers em execução

```bash
docker ps
```

---

## 3️⃣ Copiar e importar o dump do banco de dados

Supondo que o dump se chama `Banco de Dados.sql` e está na pasta `mysql-conf`.

### 3.1 Copiar o arquivo para o container MySQL

```bash
docker cp "./mysql-conf/Banco de Dados.sql" projeto_hospital_db:/tmp/banco_de_dados.sql
```

### 3.2 Entrar no container

```bash
docker exec -it projeto_hospital_db bash
```

### 3.3 Criar o banco se não existir

```bash
mysql -u root -p
```

* Senha: `rootpassword`

```sql
CREATE DATABASE IF NOT EXISTS projeto_hospital;
EXIT;
```

### 3.4 Importar o dump

Ainda dentro do terminal do container:

```bash
mysql -u root -p projeto_hospital < /tmp/banco_de_dados.sql
```

* Senha: `rootpassword`

### 3.5 Conferir se as tabelas foram importadas

```bash
mysql -u root -p
```

```sql
USE projeto_hospital;
SHOW TABLES;
```

> Agora o banco está pronto e o `login.php` deve funcionar corretamente.

---

## Observações importantes

* O volume `mysql_data` mantém os dados do MySQL entre reinicializações.
* Se clonar o projeto em outro PC, será necessário copiar/importar o dump, ou usar `docker-compose down -v` para inicializar o volume e importar automaticamente.
* Não é necessário rebuildar a imagem Docker se apenas estiver importando dados.
