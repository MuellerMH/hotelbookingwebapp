<?php 
namespace lib\module\media;
use lib\core\database;
class Dal {
	private $db;

	public function __construct() {
		$this->db = database::getConnection();
	}

	public function getAllRooms()
	{
		$this->db->prepare('select * from room');
		$this->db->exec();
		return $this->db->fetchAll();
	}

	public function getRoomByMinOcc()
	{
		$this->db->prepare('select * from room');
		$this->db->exec();
		return $this->db->fetchAll();
	}

	public function getRoomByMaxOcc()
	{
		$this->db->prepare('select * from room');
		$this->db->exec();
		return $this->db->fetchAll();
	}

	public function getRoomById()
	{
		$this->db->prepare('select * from room');
		$this->db->exec();
		return $this->db->fetchAll();
	}

	public function getRoomByUserId()
	{
		$this->db->prepare('select * from room');
		$this->db->exec();
		return $this->db->fetchAll();
	}
}