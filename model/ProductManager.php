<?php
class ProductManager
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

    public function getList()
    {
        $product = [];

        $query = $this->_db->prepare('SELECT 
        product.id as id,
        product.name as name,
        product.description as description,
        product.image as image,
        product.price as price,
        product.saleprice as saleprice,
        product.available as available,
        product.sold as sold,
        freshshop.category.name as category
            FROM
                freshshop.product_category
            JOIN
                freshshop.product 
                    ON
                        freshshop.product_category.product_id = freshshop.product.id
            JOIN
                freshshop.category 
                    ON
                    freshshop.product_category.category_id = freshshop.category.id');

        $query->execute();

        while ($data = $query->fetch(PDO::FETCH_ASSOC)) {
            $product[] = new Product($data);
        }

        return $product;
    }

    /* public function idValid($id)
    {
        $query = $this->_db->prepare('SELECT COUNT(*) FROM product WHERE id = :id');
        $query->bindValue(':id', $id);
        $query->execute();
        return (bool) $query->fetchColumn();
    } */

    public function get($id)
    {
        $query = $this->_db->prepare('SELECT 
        product.id as id,
        product.name as name,
        product.description as description,
        product.image as image,
        product.price as price,
        product.saleprice as saleprice,
        product.available as available,
        product.sold as sold,
        freshshop.category.name as category
            FROM
                freshshop.product_category
            JOIN
                freshshop.product 
                    ON 
                        freshshop.product_category.product_id = freshshop.product.id
            JOIN
                freshshop.category 
                    ON 
                        freshshop.product_category.category_id = freshshop.category.id
            WHERE 
                product.id = :id');

        $query->bindValue(':id', $id);
        $query->execute();
        $data = $query->fetch(PDO::FETCH_ASSOC);

        return new Product($data);
    }
}
