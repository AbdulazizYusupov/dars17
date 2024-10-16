<?php

namespace App\Models;

use App\Database\Database;
use PDO;

class Model extends Database
{
    public static function all()
    {
        $sql = "SELECT * FROM " . static::$table;
        $res = self::connect()->query($sql);
        return $res->fetchAll(PDO::FETCH_OBJ);
    }
    public static function create($data)
    {
        $columns = implode(", ", array_keys($data));
        $values = "'" . implode("','", array_values($data)) . "'";
        $query = "INSERT INTO " . static::$table . " ({$columns})  VALUES ({$values})";
        $stmt = self::connect()->prepare($query);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public static function hasKey($data)
    {
        $columps = implode(array_keys($data));
        $values = implode(array_values($data));

        $sql = "SELECT * FROM " . static::$table . " WHERE " . $columps . " = '{$values}'";

        $result = self::connect()->query($sql);
        return $result->fetch(PDO::FETCH_OBJ);
    }

    public static function createUser($data)
    {
        $columps = '';
        $values = '';
        foreach ($data as $key => $value) {
            if ($key == 'password') {
                $value = md5($value);
            }
            $columps = $columps . "{$key},";
            $values = $values . "'{$value}',";
        }

        $columps = rtrim($columps, ',');
        $values = rtrim($values, ',');
        $sql = "INSERT INTO " . static::$table . " (" . $columps . ") VALUES ({$values})";
        $result = self::connect()->exec($sql);

        return self::hasKey(['email' => $data['email']]);
    }
    public static function attach($data)
    {
        $stringValue = "";
        foreach ($data as $key => $value) {
            if ($key == "password") {
                $value = md5($value);
            }
            $stringValue = $stringValue . " {$key}= '{$value}' AND ";
        }
        $cleanedString = rtrim($stringValue, "AND ");

        $db = self::connect();
        $stmt = $db->query("SELECT * FROM " . static::$table . " WHERE {$cleanedString}");
        return $stmt->fetch(PDO::FETCH_OBJ);
    }
    public static function show($id)
    {
        $sql = "SELECT * FROM " . static::$table . " WHERE id = '{$id}'";
        $query = self::connect()->query($sql);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    public static function update(array $data, int $id)
    {
        $setParts = [];
        $params = [];

        foreach ($data as $key => $value) {
            $setParts[] = "{$key} = :{$key}";
            $params[":{$key}"] = $value;
        }

        $cleanedString = implode(", ", $setParts);

        $query = "UPDATE " . static::$table . " SET {$cleanedString} WHERE user_id = :id ";

        $params[':id'] = $id;

        $stat = self::connect()->prepare($query);

        foreach ($params as $key => $value) {
            $stat->bindValue($key, $value);
        }

        return $stat->execute();
    }
    public static function delete(int $id)
    {
        $query = "DELETE FROM " . static::$table . " WHERE id = {$id}";
        $stat = self::connect()->prepare($query);
        if ($stat->execute()) {
            header("location: /");
        } else {
            return false;
        }
    }
    public static function query($sql)
    {
        $stat = self::connect()->query($sql);
        return $stat->fetchAll(PDO::FETCH_OBJ);
    }
    public static function taskall($status)
    {
        $sql = "SELECT tasks.id,tasks.title,tasks.description,tasks.image,tasks.user_id,tasks.status,users.name from tasks LEFT JOIN users ON tasks.user_id = users.id WHERE tasks.status='{$status}'";
        $query = self::connect()->query($sql);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    public static function gettask($id,$status)
    {
        $sql = "SELECT * FROM " . static::$table . "  WHERE user_id = '{$id}' and status = '{$status}'";
        $query = self::connect()->query($sql);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>