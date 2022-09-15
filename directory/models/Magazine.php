<?php
class Magazine
{
    private $conn;
    private $table = 'magazines';

    public $id;
    public $name;
    public $description;
    public $picture;
    public $authors;
    public $date;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Получить список журналов
    public function list()
    {
        $query = 'SELECT id, name, description, picture, authors, date FROM ' . $this->table . '';
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Получить журнал по id
    public function read()
    {
        $query = 'SELECT id, name, description, picture, authors, date FROM ' . $this->table . ' WHERE id = ? LIMIT 0,1';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->id = $row['id'];
        $this->name = $row['name'];
        $this->description = $row['description'];
        $this->picture = $row['picture'];
        $this->authors = $row['authors'];
        $this->date = $row['date'];
    }

    // Создать журнал
    public function create()
    {
        $query = 'INSERT INTO ' . $this->table . ' SET name = :name, description = :description, picture = :picture, authors = :authors, date = :date';
        $stmt = $this->conn->prepare($query);
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->picture = htmlspecialchars(strip_tags($this->picture));
        $this->authors = htmlspecialchars(strip_tags($this->authors));
        $this->date = htmlspecialchars(strip_tags($this->date));
        $stmt-> bindParam(':name', $this->name);
        $stmt-> bindParam(':description', $this->description);
        $stmt-> bindParam(':picture', $this->picture);
        $stmt-> bindParam(':authors', $this->authors);
        $stmt-> bindParam(':date', $this->date);
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
        $query = 'UPDATE ' . $this->table . ' SET name = :name, description = :description, picture = :picture, authors = :authors, date = :date WHERE id = :id';
        $stmt = $this->conn->prepare($query);
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->picture = htmlspecialchars(strip_tags($this->picture));
        $this->authors = htmlspecialchars(strip_tags($this->authors));
        $this->date = htmlspecialchars(strip_tags($this->date));
        $this->id = htmlspecialchars(strip_tags($this->id));
        $stmt-> bindParam(':name', $this->name);
        $stmt-> bindParam(':description', $this->description);
        $stmt-> bindParam(':picture', $this->picture);
        $stmt-> bindParam(':authors', $this->authors);
        $stmt-> bindParam(':date', $this->date);
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
