
<?php

class Account {
    private $link;
    public $table = "user_info";

    public $userid;
    public $username;
    public $firstname;
    public $lastname;
    public $email;
    public $password;
    public $mobile;
    public $address;
    public $user_type;

    public function __construct($db) {
        $this->link = $db;
    }

    public function read() {
        $query = "SELECT * FROM " . $this->table;

        $stmt = $this->link->prepare($query);

        $stmt->execute();

        return $stmt;
    }

    public function read_single($id) {
        $query = "SELECT * FROM " . $this->table . " WHERE user_id = :id";

        $stmt = $this->link->prepare($query);
        $stmt->bindParam(":id", $id);

        $stmt->execute();

        return $stmt;
    }

    public function EditAccount() {
        $query = "UPDATE " . $this->table . " SET 
        first_name = :firstname, 
        last_name = :lastname, 
        user_name = :username 
        WHERE user_id = :id";

        $stmt = $this->link->prepare($query);
        $stmt->bindParam(":id", $this->userid);
        $stmt->bindParam(":firstname", $this->firstname);
        $stmt->bindParam(":lastname", $this->lastname);
        $stmt->bindParam(":username", $this->username);

        if($stmt->execute()) {
            return true;
        }
        printf("Error: %s\n",$stmt->error);
        return false;
    }


}

?>