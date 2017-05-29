<?php
namespace lib\modules\reservation;


class Model
{

    private $id;
    public $dtCreateDate;
    public $dtArrival;
    public $dtDeparture;
    public $sCurrency;
    public $fTotalPrice;

    public $iGuestId;

    private $changes = [];

    private $dbConnection;

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
        $this->setArrival($array['arrival']);
        $this->setDeparture($array['departure']);
        $this->setCurrency($array['currency']);
        $this->setTotalPrice($array['total_price']); // danger
    }

    private function loadModel(int $id)
    {

    }

    /**
     * @return mixed
     */
    public function getId()
    {

        return $this->id;
    }

    /**
     * @param mixed $id
     * @return array
     */
    public function setId(int $id)
    {
        $arrayChangeLog = array('Id'=>true,"oldValue"=>$this->id,"newValue"=>$id);
        array_push($this->changes,$arrayChangeLog);
        $this->id = $id;
        return $arrayChangeLog;
    }

    /**
     * @return mixed
     */
    public function getCreateDate()
    {
        return $this->dtCreateDate;
    }

    /**
     * @return mixed
     */
    public function getArrival($format='Y-m-d hh:nn:ss')
    {
        return $this->dtArrival->format($format);
    }

    /**
     * @param mixed $dtArrival
     * @return array
     */
    public function setArrival(\DateTime $dtArrival)
    {
        $arrayChangeLog = array('Arrival'=>true,"oldValue"=>$this->dtArrival,"newValue"=>$dtArrival);
        array_push($this->changes,$arrayChangeLog);
        $this->dtArrival = $dtArrival;
        return $arrayChangeLog;
    }

    /**
     * @return mixed
     */
    public function getDeparture($format='Y-m-d hh:nn:ss')
    {
        return $this->dtDeparture->format($format);
    }

    /**
     * @param mixed $dtDeparture
     * @return array
     */
    public function setDeparture(\DateTime $dtDeparture)
    {
        $arrayChangeLog = array('Departure'=>true,"oldValue"=>$this->dtDeparture,"newValue"=>$dtDeparture);
        array_push($this->changes,$arrayChangeLog);
        $this->dtDeparture = $dtDeparture;
        return $arrayChangeLog;
    }

    /**
     * @return mixed
     */
    public function getCurrency()
    {
        return $this->sCurrency;
    }

    /**
     * @param mixed $sCurrency
     * @return array
     */
    public function setCurrency(string $sCurrency)
    {
        $arrayChangeLog = array('Currency'=>true,"oldValue"=>$this->sCurrency,"newValue"=>$sCurrency);
        array_push($this->changes,$arrayChangeLog);
        $this->sCurrency = $sCurrency;
        return $arrayChangeLog;
    }

    /**
     * @return mixed
     */
    public function getTotalPrice()
    {
        return $this->fTotalPrice;
    }

    /**
     * @param mixed $fTotalPrice
     * @return array
     */
    public function setTotalPrice(float $fTotalPrice)
    {#
        $arrayChangeLog = array('TotalPrice'=>true,"oldValue"=>$this->fTotalPrice,"newValue"=>$fTotalPrice);
        array_push($this->changes,$arrayChangeLog);
        $this->fTotalPrice = $fTotalPrice;
        return $arrayChangeLog;
    }

    /**
     * @return mixed
     */
    public function getGuestId()
    {
        return $this->iGuestId;
    }

    /**
     * @param mixed $iGuestId
     * @return array
     */
    public function setGuestId(int $iGuestId)
    {
        $arrayChangeLog = array('GuestId'=>true,"oldValue"=>$this->iGuestId,"newValue"=>$iGuestId);
        array_push($this->changes,$arrayChangeLog);
        $this->iGuestId = $iGuestId;
        return $arrayChangeLog;
    }

    public function save()
    {   
        $this->dbConnection->save($this);
        $this->setId($this->dbConnection->getInsertID());
        $this->changes = [];
        return $this;
    }

    public function __destruct()
    {
        if ( count($this->changes) ) {
            $this->save();         
        }
    }
}