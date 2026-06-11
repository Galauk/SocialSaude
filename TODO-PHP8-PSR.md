# TODO - Migração para PHP 8 / Clean Code / PSR (Atualizado em 11/06/2026)

## Objetivo
Atualizar o projeto **ProSaude / SocialSaude** para PHP 8, adotando Clean Code e padrões PSR de forma **progressiva**, mantendo o sistema legado funcionando durante toda a transição.

**Foco da migração:**
- [x] Manter o sistema legado funcionando
- [x] Criar uma fundação moderna em `src/`
- [x] Reduzir riscos críticos de segurança
- [x] Migrar módulos aos poucos
- [x] Aplicar PSR-1, PSR-4 e PSR-12 nos arquivos novos
- [ ] Criar testes para proteger os fluxos migrados

---

## Progresso Atual (11/06/2026)

**Fases concluídas / em andamento:**
- **Fase 0** – Inventário e controle inicial → **Quase completa**
- **Fase 1** – Fundação moderna → **Bem avançada**
- **Fase 2** – Bootstrap, paths e configuração → **Em andamento / Avançada**
- **Fase 3** – Banco de dados → **Início**

**Principais conquistas recentes:**
- `composer.json` + autoload PSR-4 (`App\` → `src/`)
- Pasta `src/` com estrutura moderna (`Core/`, `Models/`, `Repositories/`, `Controllers/`, `Routing/`, etc.)
- Suporte a `.env`
- `SessionManager`, Router básico, Config e Database singleton
- Limpeza significativa de arquivos obsoletos, imagens e código morto
- Bootstrap moderno em `public/index.php` e `config/`

---

## Fase 0 - Inventário e controle inicial
- [x] Maior parte das definições e descobertas concluídas
- [ ] Definir versão exata do PHP 8.x para Docker/local
- [ ] Definir versão exata do PostgreSQL
- [ ] Estratégia clara de migração de senhas MD5
- [ ] Mapear módulos críticos vs módulos de menor risco

---

## Fase 1 - Fundação moderna (Pacote Zero)
**Status: Avançada**

### Composer e autoload
- [x] `composer.json` criado
- [x] Autoload PSR-4 configurado (`App\\` → `src/`)
- [x] Autoload-dev para testes
- [x] Dependências de qualidade incluídas (PHPUnit, PHPStan, PHPCS, PHP-CS-Fixer)
- [x] Scripts Composer (`cs`, `fix`, `analyse`)

### Estrutura
- [x] Pasta `src/` criada com namespaces
- [x] `declare(strict_types=1)` nos novos arquivos
- [ ] Completar estrutura recomendada em `src/Modules/`

---

## Fase 2 - Bootstrap, paths e configuração
**Status: Avançada**

- [x] Bootstrap moderno iniciado (`public/index.php`, `config/`)
- [x] Suporte a `.env` e carregamento de configurações
- [x] `SessionManager` implementado
- [x] Router + Controllers básicos
- [ ] Refatorar `global.php`, `config.inc.php` e `sessao_controller.php` para usar o novo bootstrap
- [ ] Definir constantes de caminho de forma centralizada

---

## Fase 3 - Banco de dados e camada de compatibilidade (Próxima prioridade)
**Status: Início**

### Nova camada de banco
- [x] Configuração básica e singleton de conexão
- [ ] Criar `App\Core\Database\PgConnection`
- [ ] Criar `App\Core\Database\PgDatabase` com prepared statements
- [ ] Tratamento adequado de erros (sem `die()` e `@`)
- [ ] Exceções personalizadas

### Compatibilidade legado
- [ ] Fazer `funcoes.db.php` delegar para a nova camada
- [ ] Preservar funções antigas (`db_query()`, `db_getRow()`, etc.)

---

## Fase 4 - Compatibilidade obrigatória com PHP 8
- [ ] Substituir funções removidas (`session_register()`, `split()`, `ereg()`, etc.)
- [ ] Corrigir sintaxe incompatível (`<?`, arrays sem aspas, null coalescing, etc.)
- [ ] Testar todo o sistema em PHP 8

---

## Fase 5 - Segurança crítica (Paralela à Fase 3)
**Alta prioridade**
- [ ] Migrar autenticação e senhas MD5 → `password_hash()`
- [ ] Eliminar SQL Injection nos pontos críticos (login, agendamento, cadastro)
- [ ] CSRF, escaping de saída, sessão segura
- [ ] Revisar `auth.php`, `auth_pass.php`, `api/login.php`

---

## Próximas Fases (6 a 8)
- Clean Code incremental
- Testes (unitários + caracterização)
- Migração modular (ordem sugerida):
  1. Login / Autenticação
  2. Usuário e Permissões
  3. Cadastro de Paciente
  4. Agendamento
  5. Demais módulos

