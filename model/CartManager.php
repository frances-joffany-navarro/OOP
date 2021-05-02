<?php
class CartManager
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

    public function add(Cart $userCart)
    {
        $query = $this->_db->prepare('INSERT INTO user_cart(user_id, product_id, quantity) VALUES(:userid, :productid, :quantity)');

        $query->bindValue(':userid', $userCart->getUserid());
        $query->bindValue(':productid', $userCart->getProductid());
        $query->bindValue(':quantity', $userCart->getQuantity());

        $query->execute();

        $userCart->hydrate([
            'id' => $this->_db->lastInsertId()
        ]);
    }

    public function getCart($userId)
    {
        $cart = [];
        $query = $this->_db->prepare('SELECT id, user_id as userid, product_id as productid, quantity FROM user_cart WHERE user_id = :userId');

        $query->bindValue(':userId', $userId);
        $query->execute();

        while ($data = $query->fetch(PDO::FETCH_ASSOC)) {
            $cart[] = new Cart($data);
        }
        return $cart;
    }

    public function get($id)
    {
        $id = (int) $id;
        $query = $this->_db->prepare('SELECT id, user_id as userid, product_id as productid, quantity FROM user_cart WHERE id = :id');

        $query->bindValue(':id', $id);
        $query->execute();
        $data = $query->fetch(PDO::FETCH_ASSOC);

        return new Cart($data);
    }

    public function update(Cart $userCart)
    {
        $query = $this->_db->prepare('UPDATE user_cart SET quantity = :quantity WHERE id = :id');
        $query->bindValue(':quantity', $userCart->getQuantity(), PDO::PARAM_INT);
        $query->bindValue(':id', $userCart->getId(), PDO::PARAM_INT);

        $query->execute();
    }

    public function delete(Cart $userCart)
    {
        $this->_db->exec('DELETE FROM user_cart WHERE id = ' . $userCart->getId());
    }

    public function exists(Cart $userCart)
    {
        $query = $this->_db->prepare('SELECT COUNT(*) FROM user_cart WHERE user_id = :userId AND product_id = :productId');
        $query->bindValue(':userId', $userCart->getUserid());
        $query->bindValue(':productId', $userCart->getProductid());
        $query->execute();

        return (bool) $query->fetchColumn();
    }

    public function getInfo(Cart $userCart)
    {
        $query = $this->_db->prepare('SELECT id, user_id as userid, product_id as productid, quantity FROM user_cart WHERE user_id = :userId AND product_id = :productId');
        $query->bindValue(':userId', $userCart->getUserid());
        $query->bindValue(':productId', $userCart->getProductid());
        $query->execute();

        $data = $query->fetch(PDO::FETCH_ASSOC);

        return new Cart($data);
    }

    public function getQuantity(Cart $userCart)
    {
        $query = $this->_db->prepare('SELECT quantity FROM user_cart WHERE user_id = :userId AND product_id = :productId');
        $query->bindValue(':userId', $userCart->getUserid());
        $query->bindValue(':productId', $userCart->getProductid());
        $query->execute();

        $quantity = (int) $query->fetch(PDO::FETCH_COLUMN);

        return $quantity;
    }
}
