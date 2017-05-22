<?php
namespace lib\modules\room;


class Model
{
	private $id;
	private $label;
	private $description;
	private $size=1;
	private $occMin=1;
	private $occMax=2;
	private $beds=1;
	private $breakfast=false;
	private $user=1;

	public function __construct($id=null, $DB)
    {
        $this->dbConnection = $DB;
        if ( !is_null($id) )
        {
            if (is_array($id) )  {
                $this->exchangeData($id);
                return $this;
            }
            $this->loadModel($id);
        }
        return $this;
    }

    private function exchangeData(array $array)
    {
        $this->_setLabel($array['label']);
        $this->_setDescription($array['description']);
        $this->_setOccMin($array['occmin']);
        $this->_setOccMax($array['occmax']);
        $this->_setBreakfast($array['breakfast']);
    }

    private function loadModel(int $id)
    {

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

        return $this;
    }

    /**
     * Gets the value of user.
     *
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Sets the value of user.
     *
     * @param mixed $user the user
     *
     * @return self
     */
    private function _setUser($user)
    {
        $this->user = $user;

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

        return $this;
    }

    /**
     * Gets the value of breakfast.
     *
     * @return mixed
     */
    public function getBreakfast()
    {
    	if ($this->breakfast)
    	    return 1;
    	return 0;
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

        return $this;
    }
}