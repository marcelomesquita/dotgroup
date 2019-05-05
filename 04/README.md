# Tarefas
A aplicação foi criada utilizando o template básico do Yii 2 (http://www.yiiframework.com/).

## Configuração
### Diretórios
Conceder privilégio de escrita para a aplicação aos seguintes diretórios:
		runtime/            contém os arquivos gerados em tempo de execução
		web/assets/         contém os arquivos utilizados pela página web

~~~
$ chmod 777 runtime/ web/assets/
~~~

### Banco de Dados
Editar o arquivo `config/db.php` com os dados de conexão do seu banco:

```php
return [
	'class' => 'yii\db\Connection',
	'dsn' => 'mysql:host=localhost;dbname=tarefas',
    'username' => 'root',
    'password' => 'root',
    'charset' => 'utf8',
];
```

## Instalação
No terminal, acessar o diretório da aplicação e executar o comando a seguir,
para criar as tabelas no banco:

~~~
$ php yii migrate
~~~

## Utilização
Copie os arquivo para o diretório raiz de seu servidor web e acesse:

 * http://localhost/web/
