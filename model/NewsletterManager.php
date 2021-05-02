<?php
class NewsletterManager
{
    private $_db;

    public function __construct($db)
    {
        $this->setDb($db);
    }

    public function setDb(PDO $db)
    {
        $this->_db = $db;
    }

    public function add(User $user)
    {
        $query = $this->_db->prepare('INSERT INTO newsletter(email) VALUES(:email)');
        $query->bindValue(':email', $user->getEmail());
        $query->execute();
    }

    public function emailExists($email)
    {
        $query = $this->_db->prepare('SELECT COUNT(*) FROM newsletter WHERE email = :email');
        $query->bindValue(':email', $email);
        $query->execute();
        return (bool) $query->fetchColumn();
    }
}

