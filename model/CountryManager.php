<?php
class CountryManager
{
    private $_db;

    public function __construct($db)
    {
        $this->setDb($db);
    }

    public function setDb($db)
    {
        $this->_db = $db;
    }

    public function getList()
    {
        $query = $this->_db->prepare('SELECT * FROM country');
        $query->execute();
        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function getStateByCountry($countryId)
    {
        $query = $this->_db->prepare('SELECT * FROM country_states WHERE countryId = :countryId');
        $query->bindValue(':countryId', $countryId);
        $query->execute();
        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
}
