<?php

namespace App\Models\Contracts;

use App\Utilities\Dump;
use PDOException;
use Medoo\Medoo;

class MysqlBaseModel extends BaseModel
{

  public function __construct($id = null)
  {
    try {

      $this->connection = new Medoo([
        // [required]
        'type' => 'mysql',
        'host' => $_ENV['DB_HOST'],
        'database' => $_ENV['DB_NAME'],
        'username' => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASS'],

        // [optional]
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_general_ci',
        'port' => $_ENV['DB_PORT'],

        // [optional] The table prefix. All table names will be prefixed as PREFIX_table.
        'prefix' => '',

        // [optional] To enable logging. It is disabled by default for better performance.
        'logging' => true,

        // [optional]
        // Error mode
        // Error handling strategies when the error has occurred.
        // PDO::ERRMODE_SILENT (default) | PDO::ERRMODE_WARNING | PDO::ERRMODE_EXCEPTION
        // Read more from https://www.php.net/manual/en/pdo.error-handling.php.
        'error' => \PDO::ERRMODE_EXCEPTION,

        // [optional] Medoo will execute those commands after the database is connected.
        'command' => [
          'SET SQL_MODE=ANSI_QUOTES'
        ]
      ]);
    } catch (PDOException $ex) {
      echo "Connection Failed: ".$ex->getMessage();
    }
    if(!is_null($id))
    {
      return $this->find($id);
    }
  }

public function remove(): int
{
  $record_id = $this->{$this->primaryKey};
  return $this->delete([$this->primaryKey => $record_id]);
  //return $record_id;
}

public function save(): int
{
  $record_id = $this->{$this->primaryKey};
 return $this->update($this->attributes, [$this->primaryKey => $record_id]);
}

public function __get($property)
{
  return $this->getAttrubite($property);
}

public function __set($property, $value)
{
  if (!array_key_exists($property, $this->attributes)) {
    return null;
}
$this->attributes[$property] = $value;
}
  #create (insert)
  public function create(array $data): int
  {

    $this->connection->insert($this->table, $data);

    return $this->connection->id();;
  }

  #Read (select) single | multiple
  public function find(int $id): object
  {
    $record = $this->connection->get($this->table, '*', [$this->primaryKey => $id]);
    if(is_null($record)){
      return (object)null;
    }
    foreach ($record as $col => $val) {
      $this->attributes[$col] = $val;
    }

    return $this;
  }

  public function getAll(): array
  {
    return $this->connection->select($this->table, "*");
  }

  public function get(array $columns, array $where): array
  {
    return $this->connection->select($this->table, $columns, $where);
  }

  #Update records
  public function update(array $data, array $where): int
  {
    $result = $this->connection->update($this->table, $data, $where);
    return $result->rowCount();
  }

  #Delete
  public function delete(array $where): int
  {
    $result = $this->connection->delete($this->table, $where);
    return $result->rowCount();
  }
}
