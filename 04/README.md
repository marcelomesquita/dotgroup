# Tarefas
A aplicação foi criada utilizando o template básico do Yii 2 (http://www.yiiframework.com/).

## Configuração
### Diretórios
Conceder privilégio de escrita para a aplicação aos seguintes diretórios:
```
	runtime/            contém os arquivos gerados em tempo de execução
	web/assets/         contém os arquivos utilizados pela página web
```

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

## API
### Tarefa
#### Index

Retorna a lista de tarefas.

* http://localhost/web/tarefa/index `GET`


##### Response

```json
{
	tarefas: [
		{
			id: 1,
			titulo: "Tarefa 1",
			descricao: "Lorem",
			prioridade: 1
		},
		{
			id: 2,
			titulo: "Tarefa 2",
			descricao: "Ipsum",
			prioridade: 2
		},
		{
			id: 3,
			titulo: "Tarefa 3",
			descricao: "Sit amet",
			prioridade: 3
		}
	]
}
```

#### Create

Cria uma tarefa e retorna seu id.

* http://localhost/web/tarefa/create `POST`

##### Request

```json
{
	tarefa: {
		titulo: "Tarefa 4",
		descricao: "Dolor",
		prioridade: 4
	}
}
```

##### Response

```json
{
	tarefa: {
		id: 4,
		titulo: "Tarefa 4",
		descricao: "Dolor",
		prioridade: 4
	},
	mensagem: "Tarefa cadastrada com sucesso"
}
```

#### Update

Atualizar uma tarefa.

* http://localhost/web/tarefa/update/{$id} `POST`

##### Request

```json
{
	tarefa: {
		id: 4,
		titulo: "Tarefa 4",
		descricao: "Lorem",
		prioridade: 2
	}
}
```

##### Response

```json
{
	mensagem: "Tarefa atualizada com sucesso"
}
```

#### Delete

Delete uma tarefa.

* http://localhost/web/tarefa/delete/{$id} `DELETE`


##### Response

```json
{
	mensagem: "Tarefa deletada com sucesso"
}
```

#### Order

Ordena as tarefas.

* http://localhost/web/tarefa/order `POST`

##### Request

```json
{
	tarefas: [
		{
			id: 1,
			prioridade: 1
		},
		{
			id: 2,
			prioridade: 2
		},
		{
			id: 3,
			prioridade: 3
		},
		{
			id: 4,
			prioridade: 4
		}
	]
}
```

##### Response

```json
{
	mensagem: "Tarefas ordenadas com sucesso"
}
```
