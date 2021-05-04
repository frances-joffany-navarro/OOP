<?php
class Cart
{
    private $_id;
    private $_userId;
    private $_productId;
    private $_quantity;

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

    //getters
    public function getId()
    {
        return $this->_id;
    }

    public function getUserid()
    {
        return $this->_userId;
    }

    public function getProductid()
    {
        return $this->_productId;
    }

    public function getQuantity()
    {
        return $this->_quantity;
    }

    //setters
    public function setId($id)
    {
        $id = (int) $id;
        $this->_id = $id;
    }

    public function setUserid($userId)
    {
        if (!empty($userId)) {
            $userId = (int) $userId;
            $this->_userId = $userId;
        }
    }

    public function setProductid($productId)
    {
        if (!empty($productId)) {
            $productId = (int) $productId;
            $this->_productId = $productId;
        }
    }

    public function setQuantity($quantity)
    {
        if (!empty($quantity)) {
            $quantity = (int) $quantity;
            $this->_quantity = $quantity;
        }
    }

    public function isEqual($quantity)
    {
        if ($this->getQuantity() == $quantity) {
            return true;
        } else {
            return false;
        }
    }
}
