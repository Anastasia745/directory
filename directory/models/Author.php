<?php
class Author
{
    private $conn;
    private $table = 'authors';

    public $id;
    public $surname;
    public $name;
    public $patronymic;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Список авторов
    public function list()
    {
        $query = 'SELECT id, surname, name, patronymic FROM ' . $this->table . '';
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Получить журнал по id
    public function read()
    {
        $query = 'SELECT id, surname, name, patronymic FROM ' . $this->table . ' WHERE id = ? LIMIT 0,1';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->id = $row['id'];
        $this->name = $row['surname'];
        $this->description = $row['name'];
        $this->picture = $row['patronymic'];
    }

    // Создать журнал
    public function create()
    {
        $query = 'INSERT INTO ' . $this->table . ' SET surname = :surname, name = :name, patronymic = :patronymic';
        $stmt = $this->conn->prepare($query);
        $this->surname = htmlspecialchars(strip_tags($this->surname));
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->patronymic = htmlspecialchars(strip_tags($this->patronymic));
        $stmt-> bindParam(':surname', $this->surname);
        $stmt-> bindParam(':name', $this->name);
        $stmt-> bindParam(':patronymic', $this->patronymic);
        if($stmt->execute())
        {
            return true;
        }
        printf("Error: $s.\n", $stmt->error);
        return false;
    }

    // Обновить журнал
    public function update()
    {
        $query = 'UPDATE ' . $this->table . ' SET surname = :surname, name = :name, patronymic = :patronymic';
        $stmt = $this->conn->prepare($query);
        $this->surname = htmlspecialchars(strip_tags($this->surname));
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->patronymic = htmlspecialchars(strip_tags($this->patronymic));
        $this->id = htmlspecialchars(strip_tags($this->id));
        $stmt-> bindParam(':surname', $this->surname);
        $stmt-> bindParam(':name', $this->name);
        $stmt-> bindParam(':patronymic', $this->patronymic);
        $stmt-> bindParam(':id', $this->id);
        if($stmt->execute())
        {
            return true;
        }
        printf("Error: $s.\n", $stmt->error);
        return false;
    }

    // Удалить журнал
    public function delete()
    {
        $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';
        $stmt = $this->conn->prepare($query);
        $this->id = htmlspecialchars(strip_tags($this->id));
        $stmt-> bindParam(':id', $this->id);
        if($stmt->execute())
        {
            return true;
        }
        printf("Error: $s.\n", $stmt->error);
        return false;
    }
}
