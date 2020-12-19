<?php
namespace App;



class QueryBuilder
{
private $queryFactory = null;

    public function __construct()
    {
        $this->queryFactory = new \Aura\SqlQuery\QueryFactory('mysql');
    }

    public function getOne($table, $id)
    {
        
        $select = $this->queryFactory->newSelect();
    }

    public function getAll()
    {
        # code...
    }

    public function insert()
    {
        # code...
    }

    public function update()
    {
        # code...
    }

    public function delete()
    {
        # code...
    }
}
