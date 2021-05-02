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
    public function setId($id)
    {
        $id = (int) $id;
        if ($id > 0) {
            $this->_id = $id;
        }
    }

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
            $this->_password = $password;
        }
    }
}
