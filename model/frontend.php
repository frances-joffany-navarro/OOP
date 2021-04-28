<?php
class User
{
    private $_id;
    private $_firstname;
    private $_lastname;
    private $_email;
    private $_password;

    public function __construct(array $data)
    {
        $this->hydrate($data);
    }


    public function hydrate(array $data)
    {
        foreach ($data as $key => $value) {
            $method = 'set' . ucfirst($key);

            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }

    //Getters
    public function getId()
    {
        return $this->_id;
    }

    public function getFirstname()
    {
        return $this->_firstname;
    }

    public function getLastname()
    {
        return $this->_lastname;
    }

    public function getEmail()
    {
        return $this->_email;
    }

    public function getPassword()
    {
        return $this->_password;
    }

    public function getFullname()
    {
        return $this->_firstname . ' ' . $this->_lastname;;
    }

    //Setters
    /* public function setId($id)
    {
        $id = (int) $id;
        if ($id > 0) {
            $this->_id = $id;
        }
    } */

    public function setFirstname($firstname)
    {
        //sanitize
        htmlspecialchars($firstname);

        //filter
        if (is_string($firstname)) {
            $this->_firstname = $firstname;
        }
    }

    public function setLastname($lastname)
    {
        //sanitize
        htmlspecialchars($lastname);

        //filter
        if (is_string($lastname)) {
            $this->_lastname = $lastname;
        }
    }

    public function setEmail($email)
    {
        //sanitize
        htmlspecialchars($email);
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);

        //filter
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->_email = $email;
        }
    }

    public function setPassword($password)
    {
        //sanitize
        htmlspecialchars($password);

        //filter
        if (is_string($password)) {
            //hashing
            $password = password_hash($password, PASSWORD_DEFAULT);

            $this->_password = $password;            
        }
    }
}

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

    /*public function update(User $user)
    {
        $query = $this->_db->prepare('UPDATE user set firstname = :firstname, lastname = :lastname, email = :email, password = :password WHERE id = :id');

        $query->bindValue(':firstname', $newUser->getFirstname());
        $query->bindValue(':lastname', $newUser->getLastname());
        $query->bindValue(':email', $newUser->getEmail());
        $query->bindValue(':password', $newUser->getPassword());

        $query->execute();
    }*/

    /*public function delete(User $user)
    {
        $this->_db->exec('DELETE FROM user WHERE id = ' . $user->id);
    }*/

    /* public function get($email, $password)
    {
        //get the id of that
    } */

    /*public function exists($email)
    {
        if (is_string($email)) {
            return (bool) $this->_db->query('SELECT COUNT(*) FROM user WHERE email =' . $email)->fetchColumn();
        }

        $query = $this->_db->prepare('SELECT COUNT(*) FROM user WHERE ');
    }*/

    public function setDb(PDO $db)
    {
        $this->_db = $db;
    }
}