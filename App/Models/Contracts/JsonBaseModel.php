<?php

namespace App\Models\Contracts;

use App\Utilities\Dump;

class JsonBaseModel extends BaseModel
{
    private $db_folder;
    private $table_filepath;


    public function __construct()
    {
        $this->db_folder = BASE_PATH . "/storage/jsondb/";
        $this->table_filepath = $this->db_folder . $this->table . '.json';
    }

    private function write_table(array $data)
    {
        $data_json = json_encode($data);
        file_put_contents($this->table_filepath, $data_json);
    }

    private function read_table(): array
    {
       return json_decode(file_get_contents($this->table_filepath));
    }

    #create (insert)
    public function create(array $data): int
    {
        $table_data = [];
        $table_data = $this->read_table();
        Dump::nice_dump($table_data);
        $table_data[] = $data;
        Dump::nice_dump($table_data);    
        $this->write_table($table_data);
        return $data[$this->primaryKey];
    }

    #Read (select) single | multiple
    public function find(int $id): object
    {
        $table_data = $this->read_table();
        foreach ((array)$table_data as $row) {
            if ($row->{$this->primaryKey} == $id) {
                return $row;
            }
        }
        return null;
    }
    public function getAll(): array
    {
        return $this->read_table();
    }
    public function get(array $columns, array $where): array
    {
        $table_data = $this->read_table();
        $where_keys = array_keys($where);
        $lockuptable = [];
        $result = [];

        foreach ($where_keys as $w) {
            foreach ((array)$table_data as $row) {
                if ($where[$w] == $row->$w) {
                    $lockuptable[] = $row;
                }
            }
            $table_data = $lockuptable;
            $lockuptable = [];
        }

        $count = 0;
        foreach ($columns as $column) {
            foreach ($table_data as $finalRow) {
                $result[$column . "-" . $count] = $finalRow->$column;
                $count++;
            }
            $count = 0;
        }
        return $result;
    }

    #Update records
    public function update(array $columns, array $where): int
    {

        return 1;
    }

    #Delete
    public function delete(array $where): int
    {
        $table_data = $this->read_table();
        $where_keys = array_keys($where);
        unset($table_data[0]);
        foreach ($table_data as $key => $row) {
            if ($row->{$where_keys[0]} == $where[$where_keys[0]]) {
                unset($table_data[$key]);
            }
        }
        $this->write_table($table_data);

        return 1;
    }
}
