# TODO - Migração para PHP 8 / Clean Code / PSR

## Objetivo
Atualizar o projeto `SocialSaude` para PHP 8, adotando princípios de Clean Code e padrões PSR (PSR-1, PSR-12, PSR-4) progressivamente. O foco inicial é criar um plano de migração, identificar os principais pontos de risco e anotar os caminhos de alteração necessários.

---

## 1. Auditoria geral e primeiros passos

- Criar um `composer.json` na raiz do projeto com PHP mínimo `^8.0` ou `^8.1`.
- Definir autoload PSR-4 para novos componentes e classes.
- Adotar `declare(strict_types=1);` em novos arquivos e gradualmente nos módulos refatorados.
- Adicionar ferramentas de qualidade:
  - `phpcs` com `PSR12`
  - `phpstan` / `psalm`
  - `php-cs-fixer`
- Converter a base de inclusão de arquivos para uso de paths absolutos e/ou dependências injetadas, evitando `$_SESSION['root']`, `$_SESSION['modulo']` e strings de caminho espalhadas.
- Definir um arquivo de bootstrap compartilhado para configuração e autoload.

---

## 2. Arquivos de bootstrap, sessão e configuração

- `global.php`
  - Substituir `__autoload()` por `spl_autoload_register()`.
  - Remover definições globais diretas e usar constantes ou classes de configuração.
- `funcoes.db.php`
  - Mover a lógica de banco de dados para uma classe `Database` ou `PgDatabase`.
  - Remover o uso de `@` para supressão de erros.
  - Evitar `pg_query()` com SQL concatenado; use prepared statements sempre que possível.
- `funcoes.inc.php`
  - Refatorar funções utilitárias para classes estáticas ou serviços.
  - Remover variáveis globais implícitas.
- `config.inc.php`
  - Consolidar configurações num único objeto/array de configuração.

---

## 3. Funções PHP removidas no PHP 8

### Substituições obrigatórias
- `session_register()` -> `$_SESSION['login'] = ...`
  - `auth_pass.Val.php`
  - `auth_pass.Erro.php`
- `get_magic_quotes_gpc()` -> não existe em PHP 8
  - `app-saude-profissional.php`
  - `app-saude-cidadao.php`
- `split()` -> `explode()` ou `preg_split()`
  - `calendario.inc.php`
  - `apac_print_sesgunda_via.php`
  - `apac_print_.php`
  - `hiperdia/geralHiperdia.php`
  - possivelmente outros arquivos antigos
- `ereg_replace()` / `ereg()` -> `preg_replace()` / `preg_match()`
  - `e-sus-on/ThriftCidadao.php`
  - `e-sus/ThriftCidadao.php`
- `create_function()` -> closures ou funções nomeadas
  - varrer o repositório para presença dessa função
- `preg_replace(..., '...e...')` -> usar `preg_replace_callback()` ou outra lógica segura
- `eval()` em PHP e em templates gerados por PHP (grave risco de segurança)
  - `agendar_exame.php`
  - `medico.php`
  - `exame/buscaDatasDisponiveis.php`
  - `cad_lista_espera.php`
  - `fazer_agendamento.js.php`
  - `exame/exa_agendamento.js.php`
  - `farmacia/far_agendamento.js.php`
  - demais arquivos com `eval()` encontrado pela auditoria

### Ajustes de sintaxe e tags PHP
- Converter `<?` para `<?php` onde possível.
- Revisar `<?=` e garantir que está sendo usado apenas para saída segura.
- Evitar misturar HTML e PHP em larga escala; extrair views ou templates gradualmente.

---

## 4. Path e estrutura de arquivos

### Principais diretórios e módulos impactados
- Raiz PHP do projeto: muitos arquivos legados de rota e controladores
- `e-sus/`, `e-sus-on/`, `exportacao_esus/`
  - integração com E-SUS e Thrift
  - métodos antigos de parsing de strings e `ereg`
- `zf/`
  - já parece conter parte de uma aplicação mais estruturada
- `api/`
  - validação e estrutura de entrada de dados devem ser modernizadas
- `docs/`
  - atualizar documentação de instalação e migração

### Caminhos de alteração de dependências
- Substituir includes dinâmicos com `$_SESSION[root]` e `$_SESSION[modulo]` por um arquivo bootstrap único.
- Definir constantes de caminho como `SOCIAL_ROOT`, `COMUM_ROOT`, `SAUDE_ROOT` com `dirname(__FILE__)` ou `getcwd()`.
- Avaliar se o layout em `WebSocialSaude/` deve ser separado em sub-diretórios de módulo.

---

## 5. Arquivos de maior impacto para refatoração inicial

- `auth.php`
- `auth_pass.php`, `auth_pass.Val.php`, `auth_pass.Erro.php`
- `global.php`
- `funcoes.db.php`
- `funcoes.inc.php`
- `config.inc.php`
- `calendario.inc.php`
- `apac_print_sesgunda_via.php`
- `apac_print_.php`
- `e-sus-on/ThriftCidadao.php`
- `e-sus/ThriftCidadao.php`
- `hiperdia/geralHiperdia.php`
- `agendar_exame.php`
- `medico.php`
- `exame/buscaDatasDisponiveis.php`
- `cad_lista_espera.php`
- `fazer_agendamento.js.php`
- `exame/exa_agendamento.js.php`
- `farmacia/far_agendamento.js.php`
- `app-saude-cidadao.php`
- `app-saude-profissional.php`

> Nota: este conjunto inicial é baseado em um escaneamento rápido por padrões de código legados.

---

## 6. Adoção de PSR e Clean Code

- Migrar classes para namespaces e PSR-4 quando forem refatoradas.
- Usar nomes de classes e métodos claros e consistentes.
- Evitar métodos longos e fazer funções de responsabilidade única.
- Preferir injeção de dependência a `global` e `$_SESSION` para objetos de serviço.
- Extrair html, javascript e lógica de banco de dados para camadas separadas.
- Centralizar validações e sanitização em serviços/utilitários.

---

## 7. Segurança e robustez

- Substituir `eval()` por parse seguro ou JSON.
- Escapar toda saída HTML com `htmlspecialchars()` ou view helpers.
- Usar CSRF tokens em formulários críticos.
- Não concatenar variáveis diretamente em SQL: usar prepared statements.
- Substituir `addslashes()` por mecanismos seguros de query.
- Remover dependência de `@` para supressão de erro.
- Garantir que `session_start()` ocorra uma vez e de forma controlada no bootstrap.

---

## 8. Próximo ciclo de implementação

1. Criar `composer.json` e rodar `composer install`.
2. Configurar autoload e `phpcs` / `phpstan`.
3. Refatorar o bootstrap (`global.php`, `funcoes.db.php`, `config.inc.php`).
4. Substituir funções removidas do PHP 8.
5. Refatorar os primeiros módulos críticos de login e agendamento.
6. Adicionar testes unitários e/ou de integração para os módulos migrados.
7. Iterar módulo por módulo até a cobertura mínima.

---

## 9. Comandos de inspeção sugeridos

- `grep -R "session_register\|get_magic_quotes_gpc\|split(\|ereg_\|create_function\|eval(" .` 
- `phpcs --standard=PSR12 --extensions=php .`
- `phpstan analyse src tests --level=5`
- `composer require --dev squizlabs/php_codesniffer phpstan/phpstan phpunit/phpunit`

---

## Observação final

O projeto atual possui muitos arquivos misturando lógica, view e apresentação. A migração para PHP 8 deve ser feita em fases: primeiro compatibilidade, depois arquitetura e, por fim, aplicação completa de PSR e Clean Code.
