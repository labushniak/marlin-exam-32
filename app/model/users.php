<?php
namespace App\Model;

use \Aura\SqlQuery\QueryFactory;
use PDO;

class Users
{
    public function __construct(QueryFactory $queryFactory, PDO $pdo)
    {
        $this->queryFactory = $queryFactory;
        $this->pdo = $pdo;
        //$this->queryFactory = new \Aura\SqlQuery\QueryFactory('mysql');
    }

    public function getAllUsers()
    {
        $select = $this->queryFactory->newSelect();
        $select->cols(['*']);
        $select
        ->from('users')
        ->from('users_info')
        ->from('users_links')
        ->where('users_info.user_id = users.id')
        ->where('users_links.user_id = users.id');

        $sth = $this->pdo->prepare($select->getStatement());

        $sth->execute($select->getBindValues());

        $result = $sth->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    public function setAvatar($user_id, $avatar)
    {
        
            //директория загрузки
            $upload_dir = $_SERVER['DOCUMENT_ROOT'] . '/public/uploads/';
        
            //создаем уникальное имя файла взяв хэш всего файла
            $avatar_name = 'avatar_' . $user_id;
        
            //берем расширение файла
            $avatar_file = pathinfo($avatar['name']);
	        $avatar_extention = $avatar_file['extension'];
            
            //создаем название файла с уникальным именем и прежним расширением, которое привязано к id пользователя
            $avatar_full_name = $avatar_name . "." . $avatar_extention;
        
            //формируем конечный путь загрузки файла
            $upload_file = $upload_dir . $avatar_full_name;
        
            //загружаем файл
            move_uploaded_file($avatar['tmp_name'], $upload_file);
            
            return $avatar_full_name;            
    }

    public function insert($table, $cols, $values)
    {
        $insert = $this->queryFactory->newInsert();
        
        $insert->into($table)
            ->cols($cols)
            ->bindValues($values);

            $sth = $this->pdo->prepare($insert->getStatement());
            $sth->execute($insert->getBindValues());
            
    }

    public function editInfo($userId)
    {
        $update = $this->queryFactory->newUpdate();

        $update
            ->table('users_info')
            ->cols([
                'name',
                'job_title',
                'phone',
                'address'
            ])
            ->where('user_id = :user_id')

            ->bindValues([
                'user_id' => $userId,
                'name' => $_POST['name'],
                'job_title' => $_POST['job_title'],
                'phone' => $_POST['phone'],
                'address' => $_POST['address'],
            ]);

            $sth = $this->pdo->prepare($update->getStatement());
            
            $sth->execute($update->getBindValues());

    }

    public function getOne($userId)
    {
        $select = $this->queryFactory->newSelect();
        $select->cols(['*']);
        $select
        ->from('users_info')
        ->where('user_id = :user_id')
        ->bindValues(['user_id' => $userId]);

        $sth = $this->pdo->prepare($select->getStatement());

        $sth->execute($select->getBindValues());

        return $sth->fetch(PDO::FETCH_ASSOC);
         
    }

    public function getEmail($userId)
    {
        $select = $this->queryFactory->newSelect();
        $select->cols(['*']);
        $select
        ->from('users')
        ->where('id = :id')
        ->bindValues(['id' => $userId]);

        $sth = $this->pdo->prepare($select->getStatement());

        $sth->execute($select->getBindValues());

        return $sth->fetch(PDO::FETCH_ASSOC);
         
    }
}
