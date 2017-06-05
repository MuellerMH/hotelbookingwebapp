<?php
namespace lib\modules\media;
use lib\Core\Controller as AController;

class Controller extends AController
{

	public function getRoomImages($aRooms)
	{
		$dal = new DAL($this->dataBaseConnection);
		$mediaFiles = $dal->getHasByRoom($roomID);
	}
}