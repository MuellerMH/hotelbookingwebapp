<?php
namespace lib\modules\room;


class Dal
{
	private $dbConnection;
    public function __construct($db)
    {
        $this->dbConnection = $db;
    }

    private function getSQLString () 
    {
        return '
            SELECT  
                id_room,
                user_id,
                room_label,
                room_description,
                room_size,
                room_occ_min,
                room_occ_max,
                room_beds,
                room_breakfast,
                media.media_url as image,
                prices.price_per_night as price
            FROM 
                room
                
            LEFT JOIN room_has_prices ON room_has_prices.room_idroom = room.id_room
            LEFT JOIN prices ON room_has_prices.prices_idprices = prices.idprices
            
            LEFT JOIN room_has_media ON room_has_media.room_idroom = room.id_room 
            LEFT JOIN media ON room_has_media.media_idmedia = media.idmedia
            
            
        ';
    }
    private function getWhereById() 
    {
        return '
            WHERE 
                id_room = :id
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
            INSERT INTO room
            (
                id_room,
                user_id,
                room_label,
                room_description,
                room_size,
                room_occ_min,
                room_occ_max,
                room_beds,
                room_breakfast
            )
            VALUES
            (
                :idRoom,
                :userId,
                :roomLabel,
                :roomDescription,
                :roomSize,
                :roomOccMin,
                :roomOccMax,
                :roomBeds,
                :roomBreakfast
            );
        ';
        $result = $this->dbConnection->execute($sqlString,array(
            "idRoom"=>$Model->getId(),
            "userId"=>$Model->getUser(),
            "roomLabel"=>$Model->getLabel(),
            "roomDescription"=>$Model->getDescription(),
            "roomSize"=>$Model->getSize(),
            "roomOccMin"=>$Model->getOccMin(),
            "roomOccMax"=>$Model->getOccMax(),
            "roomBeds"=>$Model->getBeds(),
            "roomBreakfast"=>$Model->getBreakfast()
        ));
    }

    public function delete($id)
    {
        $sqlString = 'DELETE FROM room ' . $this->getWhereById();
        return $this->dbConnection->execute($sqlString,array('id'=>$id));
    }
}