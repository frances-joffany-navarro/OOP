<?php
class Product
{
    private $_id;
    private $_name;
    private $_description;
    private $_image;
    private $_price;
    private $_salePrice;
    private $_available;
    private $_sold;
    private $_category;

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

    public function getName()
    {
        return $this->_name;
    }

    public function getDescription()
    {
        return $this->_description;
    }

    public function getImage()
    {
        return $this->_image;
    }

    public function getPrice()
    {
        return $this->_price;
    }

    public function getSaleprice()
    {
        return $this->_salePrice;
    }

    public function getAvailable()
    {
        return $this->_available;
    }

    public function getSold()
    {
        return $this->_sold;
    }

    public function getCategory()
    {
        return $this->_category;
    }

    //setters

    public function setId($id)
    {
        $id = (int) $id;
        if ($id > 0) {
            $this->_id = $id;
        }
    }

    public function setName($name)
    {
        if (is_string($name)) {
            $this->_name = $name;
        }
    }

    public function setDescription($description)
    {
        if (is_string($description)) {
            $this->_description = $description;
        }
    }

    public function setImage($image)
    {
        if (is_string($image)) {
            $this->_image = $image;
        }
    }

    public function setPrice($price)
    {
        $this->_price = $price;
    }

    public function setSaleprice($salePrice)
    {
        $this->_salePrice = $salePrice;
    }

    public function setAvailable($available)
    {
        $available = (int) $available;
        $this->_available = $available;
    }

    public function setSold($sold)
    {
        $sold = (int) $sold;
        $this->_sold = $sold;
    }

    public function setCategory($category)
    {
        $this->_category = $category;
    }
}
