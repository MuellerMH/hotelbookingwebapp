<?php
namespace lib\modules\room;
use lib\Core\Controller as AController;

class Controller extends AController
{
	public function __construct($DB)
	{
		$this->dataBaseConnection = $DB;
	}

	public function validateRoom($Model){
		if (empty($Model->getLabel())) {
			return false;
		}
		if (empty($Model->getDescription())) {
			return false;
		}
		if (empty($Model->getOccMin())) {
			return false;
		}
		if (empty($Model->getOccMax())) {
			return false;
		}
		if (empty($Model->getBreakfast()) && $Model->getBreakfast() !== false) {
			return false;
		}
		return true;
	}

	public function saveRoom($Model){
		$dal = new Dal($this->dataBaseConnection);
		$dal->save($Model);
		return $Model;
	}

	public function actionGet(){
		$dal = new Dal($this->dataBaseConnection);
		return $dal->getAll();
	}

	public function actionPost($data){

		$Model = new Model($data,$this->dataBaseConnection);
		if ( $this->validateRoom($Model)) {
			return $this->saveRoom($Model);
		}
		return array('status'=>-1,'message'=>"post not valid");
	}

	public function actionGetById($id){
		$dal = new Dal($this->dataBaseConnection);

		return $dal->getById($id);
	}

	public function actionDelete($id){
		$dal = new Dal($this->dataBaseConnection);
		return $dal->delete($id);
	}
}