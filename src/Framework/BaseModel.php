<?php

namespace Community\Framework;

use Community\Framework\Database;

class BaseModel
{
    protected $db;
    protected $table;

    public function __construct($table)
    {
        $this->db = Database::getDB();
        $this->table = $table;
    }

    public function findById($id)
    {
        $sql = 'SELECT * FROM ' . $this->table . ' WHERE id = :id';
        $query = $this->db->prepare($sql);
        $query->bindValue(':id', intval($id), \PDO::PARAM_INT);
        $query->execute();
        return $query->fetch(\PDO::FETCH_ASSOC);
    }

    public function findAll()
    {
        $sql = 'SELECT * FROM ' . $this->table;
        $res = $this->db->query($sql);
        return $res->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function update($data, $id)
    {
        $sql = 'UPDATE ' . $this->table . ' SET ';
        foreach ($data as $column => $datum) {
            $sql .= $column . ' = :' . $column . ', ';
        }
        // remove last ', '
        $sql = substr($sql, 0, -2);
        $sql .= ' WHERE id = :id';
        $query = $this->db->prepare($sql);
        foreach ($data as $column => $datum) {
            $query->bindValue(':'. $column, $datum);
        }
        $query->bindValue(':id', intval($id), \PDO::PARAM_INT);

        $query->execute();

        // $lastInsertId = $this->db->lastInsertId();
        // return $lastInsertId;
    }
}
