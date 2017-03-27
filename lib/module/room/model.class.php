<?php 
namespace lib\module\room;
class Model {

	private $id;
	private $userId;
	private $label;
	private $description;
	private $size;
	private $occMin;
	private $occMax;
	private $beds;
	private $breakfast;

	private $update = false;

	public __construct($data='') {

	}


	public __destruct() {
		if ( $this->update ) {
			// save
		}
	}


    /**
     * Gets the value of id.
     *
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Sets the value of id.
     *
     * @param mixed $id the id
     *
     * @return self
     */
    private function _setId($id)
    {
        $this->id = $id;
        $this->update = true;
        return $this;
    }

    /**
     * Gets the value of userId.
     *
     * @return mixed
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Sets the value of userId.
     *
     * @param mixed $userId the user id
     *
     * @return self
     */
    private function _setUserId($userId)
    {
        $this->userId = $userId;
        $this->update = true;

        return $this;
    }

    /**
     * Gets the value of label.
     *
     * @return mixed
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * Sets the value of label.
     *
     * @param mixed $label the label
     *
     * @return self
     */
    private function _setLabel($label)
    {
        $this->label = $label;
        $this->update = true;

        return $this;
    }

    /**
     * Gets the value of description.
     *
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Sets the value of description.
     *
     * @param mixed $description the description
     *
     * @return self
     */
    private function _setDescription($description)
    {
        $this->description = $description;
        $this->update = true;

        return $this;
    }

    /**
     * Gets the value of size.
     *
     * @return mixed
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * Sets the value of size.
     *
     * @param mixed $size the size
     *
     * @return self
     */
    private function _setSize($size)
    {
        $this->size = $size;
        $this->update = true;

        return $this;
    }

    /**
     * Gets the value of occMin.
     *
     * @return mixed
     */
    public function getOccMin()
    {
        return $this->occMin;
    }

    /**
     * Sets the value of occMin.
     *
     * @param mixed $occMin the occ min
     *
     * @return self
     */
    private function _setOccMin($occMin)
    {
        $this->occMin = $occMin;
        $this->update = true;

        return $this;
    }

    /**
     * Gets the value of occMax.
     *
     * @return mixed
     */
    public function getOccMax()
    {
        return $this->occMax;
    }

    /**
     * Sets the value of occMax.
     *
     * @param mixed $occMax the occ max
     *
     * @return self
     */
    private function _setOccMax($occMax)
    {
        $this->occMax = $occMax;
        $this->update = true;

        return $this;
    }

    /**
     * Gets the value of beds.
     *
     * @return mixed
     */
    public function getBeds()
    {
        return $this->beds;
    }

    /**
     * Sets the value of beds.
     *
     * @param mixed $beds the beds
     *
     * @return self
     */
    private function _setBeds($beds)
    {
        $this->beds = $beds;
        $this->update = true;

        return $this;
    }

    /**
     * Gets the value of breakfast.
     *
     * @return mixed
     */
    public function getBreakfast()
    {
        return $this->breakfast;
    }

    /**
     * Sets the value of breakfast.
     *
     * @param mixed $breakfast the breakfast
     *
     * @return self
     */
    private function _setBreakfast($breakfast)
    {
        $this->breakfast = $breakfast;
        $this->update = true;

        return $this;
    }
}