<?php
namespace lib\modules\reservation;
use lib\Core\Database;

class Dal {
    private $dbConnection;
    public function __construct($db)
    {
        $this->dbConnection = $db;
    }
    private function getSQLString () 
    {
        return '
            SELECT 
                idreservation,
                reservation_createdate,
                reservation_arrival,
                reservation_departure,
                reservation_currency,
                reservation_total_price 
            FROM 
                reservation
        ';
    }
    private function getWhereById() 
    {
        return '
            WHERE 
                idreservation = :id
        ';
    }
    public function getById($id)
    {
        $sqlString = $this->getSqlString() . $this->getWhereById();
        $this->dbConnection->execute($sqlString,array('id'=>$id));
        return $this->dbConnection->fetch();
    }

    public function getAll()
    {
        $sqlString = $this->getSqlString();
        $this->dbConnection->execute($sqlString,array());
        return $this->dbConnection->fetchAll();
    }
    
    public function getError()
    {
        return $this->dbConnection->getError();
    }

    public function getInsertID()
    {
        return $this->dbConnection->getInsertID();
    }

    public function save($Model)
    {
        $sqlString = '
            INSERT INTO reservation
            (
                idreservation,
                reservation_arrival,
                reservation_departure,
                reservation_currency,
                reservation_total_price,
                guest_idguest
            )
            VALUES
            (
                :idreservation,
                :reservation_arrival,
                :reservation_departure,
                :reservation_currency,
                :reservation_total_price,
                :guest_idguest
            );
        ';
        $this->dbConnection->execute($sqlString,array(
            "idreservation"=>$Model->getId(),
                "reservation_arrival"=>$Model->getArrival(),
                "reservation_departure"=>$Model->getDeparture(),
                "reservation_currency"=>$Model->getCurrency(),
                "reservation_total_price"=>$Model->getTotalPrice(),
                "guest_idguest"=>$Model->getGuestId()
        ));
    }

    public function delete($id)
    {
        $sqlString = 'DELETE FROM reservation ' . $this->getWhereById();
        $this->dbConnection->execute($sqlString,array('id'=>$id));
    }
}