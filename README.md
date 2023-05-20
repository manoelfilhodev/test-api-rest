# API REST - Gerenciamento de Recursos Financeiros de Clubes

Este é um sistema que permite calcular os valores resultantes após lançamentos de subtração. Ele é útil em cenários onde é necessário acompanhar o saldo ou total de um determinado valor ao subtrair diferentes montantes ao longo do tempo.

## Funcionamento

O sistema recebe um saldo inicial e permite que sejam realizados lançamentos de subtração. Cada lançamento de subtração é registrado, contendo o valor a ser subtraído do saldo. Após cada lançamento, o sistema recalcula o saldo atual, atualizando-o com base no valor subtraído. O sistema exibe o saldo atualizado após cada lançamento, fornecendo uma visão atualizada dos valores.

## Tecnologias Utilizadas

O sistema é desenvolvido utilizando as seguintes tecnologias:

- Linguagem de programação: PHP 8
- Banco de dados: MySQL 5.7

## Configuração

Para configurar e executar o sistema, siga as etapas abaixo:

1. Certifique-se de ter instalado o PHP em sua máquina.
2. Instale um servidor web local (ex: Apache) ou utilize um ambiente de desenvolvimento integrado (IDE) que inclua um servidor embutido.
3. Crie um banco de dados no seu sistema de gerenciamento de banco de dados (ex: MySQL) para armazenar os lançamentos de subtração e o saldo atual.
4. Importe a estrutura do banco de dados, executando o script fornecido.
5. Configure as informações de conexão com o banco de dados no arquivo de configuração do sistema (pasta config / raiz do projeto).
6. Inicie o servidor web local e abra o sistema no navegador.

## Utilização

Acesse o sistema por postman ou similar, por meio dos métodos GET e POST. 
Após cada lançamento, o sistema exibirá o saldo atualizado. Você pode continuar realizando lançamentos de subtração conforme necessário até que o saldo disponível do clube ou dos recursos se esgote.
