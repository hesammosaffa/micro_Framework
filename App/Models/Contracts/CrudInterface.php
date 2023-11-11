<?php

namespace App\Models\Contracts;

interface CrudInterface
{
   #create (insert)
   public function create(array $data) : int;

   #Read (select) single | multiple
   public function find(int $id) : object;
   public function get(array $columns,array $where) : array;

   #Update records
   public function update(array $columns,array $where) : int;

   #Delete
   public function delet(array $where) : int; 
   
}