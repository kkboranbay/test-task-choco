<?php

class QueryBuilder
{
    protected $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function selectAll($table)
    {
        $statement = $this->pdo->prepare("select * from {$table}");

        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_CLASS);
    }

    public function selectOne($table, $id)
    {
        $statement = $this->pdo->prepare("select * from {$table} where id={$id}");

        $statement->execute();

        return $statement->fetch(PDO::FETCH_OBJ);
    }

    public function insert($table, $parameters)
    {
        $sql = sprintf(
            'insert into %s (%s) values (%s)',
            $table,
            implode(', ', array_keys($parameters)),
            ':' . implode(', :', array_keys($parameters))
        );

        try {
            $statement = $this->pdo->prepare($sql);

            return $statement->execute($parameters);

        } catch (\Exception $e) {
            var_dump($e->getMessage());
            exit();
        }
    }

    public function update($table, $id, $fields) {
        $set = '';
        $x = 1;

        foreach($fields as $name => $value) {
            $set .= "{$name} = \"{$value}\"";
            if($x < count($fields)) {
                $set .= ',';
            }
            $x++;
        }

        $sql = "UPDATE {$table} SET {$set} WHERE id = {$id}";

        try {
            $statement = $this->pdo->prepare($sql);

            return $statement->execute($fields);

        } catch (\Exception $e) {
            var_dump($e->getMessage());
            exit();
        }
    }
}