# 🏥 Sistema Hospitalar - Fullstack

Este é um projeto fullstack de um sistema hospitalar desenvolvido para fins de estudo e portfólio. O sistema permite gerenciar médicos, pacientes e operações, utilizando tecnologias modernas para a construção de aplicações web.

## 🚀 Tecnologias Utilizadas

- **Frontend:** HTML, CSS, JavaScript, Bootstrap
- **Backend:** PHP
- **Banco de Dados:** MySQL

## 📌 Funcionalidades

- Cadastro, edição e exclusão de médicos e pacientes
- Gerenciamento de operações hospitalares
- Interface responsiva com Bootstrap
- Autenticação de usuários (com melhorias planejadas)

## ⚠️ Melhorias Planejadas

Atualmente, o projeto possui algumas limitações que serão corrigidas nas próximas versões:

- **Segurança das senhas:** As senhas estão armazenadas com MD5, o que não é seguro. A próxima versão usará **bcrypt** ou **password_hash()**.
- **Proteção de páginas:** Atualmente, qualquer usuário pode acessar páginas internas via URL. Será implementada uma verificação de sessão para restringir o acesso.
- **Refinamento da UI:** Melhorias no design para proporcionar uma experiência mais intuitiva e profissional.

## 📂 Como Rodar o Projeto

1. Clone o repositório:
   ```bash
   git clone https://github.com/seu-usuario/sistema-hospitalar.git
   ```
2. Configure o banco de dados MySQL e importe o arquivo `banco.sql`.
3. Atualize as credenciais do banco no arquivo de configuração.
4. Inicie um servidor local para rodar o PHP:
   ```bash
   php -S localhost:porta
   ```
5. Acesse `http://localhost:porta` no navegador.

## 📜 Licença

Este projeto é de código aberto e pode ser utilizado para aprendizado. Caso utilize partes do código, por favor, mencione a fonte. 😊

---

🔗 **Conecte-se comigo no [LinkedIn](https://www.linkedin.com/in/seu-perfil/)** para conversar sobre tecnologia!
