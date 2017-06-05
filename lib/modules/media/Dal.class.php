<?php
namespace lib\modules\media;


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
                idmedia,
                media_url,
                user_iduser
            FROM 
                media
        ';
    }

    private function getWhereById() 
    {
        return '
            WHERE 
                idmedia = :id
        ';
    }

    public function getById($id)
    {
        $sqlString = $this->getSqlString() . $this->getWhereById();
        $this->dbConnection->execute($sqlString,array('id'=>$id));
        return $this->dbConnection->fetch();
    }

    public function getHasByRoom(roomID)
    {
    	$sqlString = "SELECT * FROM media JOIN room_has_media ON room_has_media.room_idroom = room.idroom WHERE room_has_media.room_idroom = :id";
        $this->dbConnection->execute($sqlString,array('id'=>$roomID));
        return $this->dbConnection->fetchAll();
    }

	public function getRoomMediaByID(roomID)
	{

	}

    public function delete($id)
    {
        $sqlString = 'DELETE FROM room ' . $this->getWhereById();
        return $this->dbConnection->execute($sqlString,array('id'=>$id));
    }
}