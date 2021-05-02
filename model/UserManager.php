<?php
class UserManager
{
    private $_db;
    /**
     * Register a new User
     * Modify User Information
     * x Delete User
     * x Select User
     * x Retrieve List of the user
     * x Find out if a users email exist
     * Add Setters and construct method
     */

    public function __construct($db)
    {
        $this->setDb($db);
    }

    public function add(User $newUser)
    {
        $query = $this->_db->prepare('INSERT INTO user(firstname, lastname, email, password) VALUES(:firstname, :lastname, :email, :password)');

        $query->bindValue(':firstname', $newUser->getFirstname());
        $query->bindValue(':lastname', $newUser->getLastname());
        $query->bindValue(':email', $newUser->getEmail());
        
        $query->bindValue(':password', $newUser->getPassword());

        $query->execute();

        $newUser->hydrate([
            'id' => $this->_db->lastInsertId()
        ]);
    }

    public function getHashPassword($email)
    {
        $query = $this->_db->prepare('SELECT password FROM user WHERE email = :email');
        $query->bindValue(':email', $email);
        $query->execute();
        $hashPassword = $query->fetch(PDO::FETCH_COLUMN);
        
        return $hashPassword;
    }

    public function emailExists($email)
    {
        $query = $this->_db->prepare('SELECT COUNT(*) FROM user WHERE email = :email');
        $query->bindValue(':email', $email);
        $query->execute();
        return (bool) $query->fetchColumn();
    }

    public function get($email)
    {
        $query = $this->_db->prepare('SELECT * FROM user WHERE email = :email');
        $query->bindValue(':email', $email);
        $query->execute();
        $data = $query->fetch(PDO::FETCH_ASSOC);

        return new User($data);
    }

    public function setDb(PDO $db)
    {
        $this->_db = $db;
    }
}
