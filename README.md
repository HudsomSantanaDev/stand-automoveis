Stand Automóvel Web App📝
Descrição do Projeto
Aplicação web desenvolvida para a gestão e visualização de automóveis em um stand online. O sistema permite a listagem de veículos com paginação, visualização detalhada de especificações, autenticação de utilizadores, sistema de notificações e suporte a múltiplos idiomas.  🚀 Funcionalidades PrincipaisGestão de Carros: Listagem dinâmica com filtros de quantidade por página.  Visualização Detalhada: Exibição de especificações técnicas (ano, mês, cavalos, quilometragem, combustível) e dados do proprietário.  Autenticação: Sistema de login e controle de sessão para usuários.  Interatividade: Sistema de notificações em tempo real e marcação de Test Drives.  Internacionalização: Suporte a idiomas (Português/Inglês) via cookies.  🛠 Tecnologias UtilizadasLinguagem: PHP  Banco de Dados: MySQL (via mysqli)  Frontend: HTML5, CSS3, Bootstrap  Outros: Cookies para preferências, Sessões PHP  📋 Como rodar o projetoPré-requisitos: Certifique-se de ter um servidor local com PHP e MySQL (como XAMPP ou WAMP).Clone o repositório:git clone [link-do-seu-repositorio]3. **Configuração:**
   * Importe o ficheiro SQL do seu banco de dados para o `phpMyAdmin`.
   * Configure a constante `URL_BASE` nos seus arquivos de conexão.
4. **Execução:** Coloque a pasta do projeto no diretório `htdocs` (se usar XAMPP) e aceda via `localhost/nome-da-pasta` no seu navegador.

---

### Dicas de Ouro para seus arquivos:
*   **Organização de Pastas:** Como você tem arquivos como `cabecalho.php`, `rodape.php` e `funcoes.php`, certifique-se de que eles estão na raiz ou numa pasta `includes/`. Isso facilita muito a leitura do seu código por terceiros[cite: 4, 5, 6, 7].
*   **Segurança:** O seu código usa `mysqli` diretamente[cite: 6]. Uma ótima melhoria pa
