## 🎯 Objetivo

Rodar localmente um projeto PHP (com ou sem MySQL) em **containers Docker**, utilizando:

* `Dockerfile` para construir o ambiente PHP
* `docker-compose` para orquestrar os serviços
* Práticas como:

  * Montagem de volumes para desenvolvimento
  * Separação de arquivos de configuração
  * Uso de `.env` para variáveis sensíveis
  * Estrutura limpa e reaproveitável

---
# Criar os arquivos necessários

---

## 📄 1. `.env`

Crie um arquivo `.env`:

```env
APP_PORT=3030
DB_NAME=meubanco
DB_USER=root
DB_PASSWORD=123456
```

---

## 📄 2. `Dockerfile`

```Dockerfile
# Usa imagem oficial do PHP com Apache
FROM php:8.1-apache

# Instala extensões do PHP
RUN docker-php-ext-install pdo pdo_mysql mysqli

# Ativa o mod_rewrite do Apache (importante para frameworks)
RUN a2enmod rewrite

# Copia arquivo de configuração customizado
COPY apache.conf /etc/apache2/sites-available/000-default.conf

# Copia os arquivos do projeto para o container
COPY . /var/www/html/

# Define permissões
RUN chown -R www-data:www-data /var/www/html
```

---

## 📄 3. `apache.conf` (configuração do Apache)

```apache
<VirtualHost *:80>
    DocumentRoot /var/www/html/public

    <Directory /var/www/html/public>
        AllowOverride All
        Require all granted
    </Directory>

    ErrorLog ${APACHE_LOG_DIR}/error.log
    CustomLog ${APACHE_LOG_DIR}/access.log combined
</VirtualHost>
```

> 📝 **Nota**: se você **não usa a pasta `public`**, mude `DocumentRoot` e o `<Directory>` para `/var/www/html`.

---

## 📄 4. `docker-compose.yml`

```yaml
version: '3.8'

services:
  app:
    build: .
    container_name: php_app
    ports:
      - "${APP_PORT}:80"
    volumes:
      - .:/var/www/html
    environment:
      DB_NAME: ${DB_NAME}
      DB_USER: ${DB_USER}
      DB_PASSWORD: ${DB_PASSWORD}
    depends_on:
      - db

  db:
    image: mysql:8
    container_name: mysql_db
    restart: always
    environment:
      MYSQL_ROOT_PASSWORD: ${DB_PASSWORD}
      MYSQL_DATABASE: ${DB_NAME}
    ports:
      - "3306:3306"
    volumes:
      - db_data:/var/lib/mysql

volumes:
  db_data:
```

---

# 🚀 ETAPA 3 — Rodar o projeto

Dentro da pasta do seu projeto, execute:

```bash
# 1. Subir os containers
docker compose up --build
```

Aguarde a construção da imagem.
Depois, acesse sua aplicação em:

📍 `http://localhost:3030`

---

# 🧼 ETAPA 4 — Boas práticas de mercado

### ✅ Organização

* Mantenha o código separado por função (`/public`, `/src`, `/config`)
* Use `.env` para esconder senhas e configs variáveis
* Ignore arquivos sensíveis com `.gitignore`

### ✅ Segurança

* Nunca envie `.env` para o GitHub
* Em produção, não monte volumes diretamente (use imagens fixas)
* Use usuário específico no MySQL (evite root)

### ✅ Escalabilidade

* Adicione um container `nginx` na frente se for necessário proxy reverso
* Use `php-fpm` ao invés de Apache em produção para melhor performance
* Configure logs (ex: enviar para Loki/Grafana depois)

---

# 🧪 ETAPA 5 — Testar e depurar

Para entrar no container e debugar:

```bash
docker exec -it php_app bash
```

Para checar logs:

```bash
docker logs php_app
docker logs mysql_db
```

---

# 📦 ETAPA 6 — Encerrar containers

```bash
# Parar containers
docker compose down

# Parar e limpar volumes
docker compose down -v
```

---

## ✅ Conclusão

Você agora tem um ambiente Dockerizado profissional rodando sua aplicação PHP, pronto para integrar com:

* **Grafana + Loki** (logs)
* **Grafana + Prometheus** (métricas)
* **Grafana Cloud** (se quiser nuvem)

---

Se quiser, posso expandir este setup e incluir:

* Stack completa com Grafana
* Promtail para logs da aplicação
* Monitoramento com dashboards

Quer que eu monte esse próximo passo pra você?

