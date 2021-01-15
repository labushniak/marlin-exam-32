<?php
namespace App\Model;
use \Aura\SqlQuery\QueryFactory;
use PDO;

class QueryBuilder
{
private $queryFactory, $pdo;

    public function __construct(QueryFactory $queryFactory, PDO $pdo)
    {
        $this->queryFactory = $queryFactory;
        $this->pdo = $pdo;
        //$this->queryFactory = new \Aura\SqlQuery\QueryFactory('mysql');
    }

    public function getOne($table, $id)
    {
        
        $select = $this->queryFactory->newSelect();

    }

    public function get($table, $cols_names)
    {
        $select = $this->queryFactory->newSelect();
        $select->cols($cols_names)->from($table);
        $sth = $this->pdo->prepare($select->getStatement());
        $sth->execute($select->getBindValues());
        return $sth->fetch(PDO::FETCH_ASSOC);
    }

    public function insert($table, $col_name, $col_value)
    {
        $insert = $this->queryFactory->newInsert();
        $insert->into($table)->cols([$col_name => $col_value]);
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
