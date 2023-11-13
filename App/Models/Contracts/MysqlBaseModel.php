<?php

namespace App\Models\Contracts;

class MysqlBaseModel extends BaseModel
{
     #create (insert)
   public function create(array $data) : int{

    return 1;
   }

   #Read (select) single | multiple
   public function find(int $id) : object{

    return (object)[];
   }
   public function get(array $columns,array $where) : array{

    return [];
   }

   #Update records
   public function update(array $columns,array $where) : int{

    return 1;
   }

   #Delete
   public function delet(array $where) : int{

    return 1;
   }
}
