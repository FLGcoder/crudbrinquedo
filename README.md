Atividade de Recuperacao - CRUD PHP: Gestao de Brinquedos

Sistema completo de gerenciamento de brinquedos para loja, desenvolvido em PHP e MySQL com uso de Prepared Statements para a atividade de recuperacao.

Funcionalidades

- Cadastrar novo brinquedo (Nome, Categoria, Faixa Etaria, Preco e Quantidade)
- Listar brinquedos cadastrados
- Editar dados de um brinquedo
- Excluir brinquedo do banco de dados

Estrutura de Arquivos

- `db.sql`: Script SQL para criacao do banco de dados `crud_brinquedos` e da tabela `brinquedos`.
- `index.php`: Redireciona para a pagina inicial de listagem.
- `infra/conexao.php`: Conexao com o MySQL via MySQLi.
- `public/listar-brinquedo.php`: Visualizacao da tabela com os brinquedos.
- `public/cadastrar-brinquedo.php`: Formulario e processamento de cadastro.
- `public/editar-brinquedo.php`: Formulario e processamento de atualizacao.
- `public/excluir.php`: Execucao da exclusao de registros.

Como Executar

1. Importe o arquivo `db.sql` no MySQL (via phpMyAdmin ou terminal).
2. Mova a pasta do projeto para o diretorio do seu servidor local (ex: `htdocs` no XAMPP).
3. Verifique se as credenciais no arquivo `infra/conexao.php` batem com as do seu ambiente local (`localhost`, `root`, sem senha).
4. Acesse `http://localhost/nome-da-sua-pasta/` no navegador.