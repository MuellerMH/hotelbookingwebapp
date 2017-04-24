<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use \lib\modules\reservation\Model;

/**
 * @covers \lib\modules\reservation\Model;
 */
final class ModelTest extends TestCase
{
    private $testObject;

    public function testCreateEmptyRoomModel()
    {
        $this->testObject = new Model();
        $this->assertEquals('lib\modules\reservation\Model', get_class($this->testObject));
    }

    public function testSetIntMethod()
    {
        $this->testObject = new Model();

        $intID = getmyuid();

        //Id
        $changeLog = $this->testObject->setId($intID);
        $this->assertEquals($this->testObject->getId(), $intID);
        $this->assertTrue($changeLog['Id']);
        $this->assertEquals($changeLog['oldValue'], null);
        $this->assertEquals($changeLog['newValue'], $intID);

        // guestID
        $changeLog = $this->testObject->setGuestId($intID);
        $this->assertEquals($this->testObject->getGuestId(), $intID);
        $this->assertTrue($changeLog['GuestId']);
        $this->assertEquals($changeLog['oldValue'], null);
        $this->assertEquals($changeLog['newValue'], $intID);
    }

    public function testSetStringMethod()
    {
        $this->testObject = new Model();

        $string = "foobar";
        $string2 = "barfoo";

        //Id
        $changeLog = $this->testObject->setCurrency($string);
        $this->assertEquals($this->testObject->getCurrency(), $string);
        $this->assertTrue($changeLog['Currency']);
        $this->assertEquals($changeLog['oldValue'], null);
        $this->assertEquals($changeLog['newValue'], $string);
        $changeLog = $this->testObject->setCurrency($string2);
        $this->assertEquals($changeLog['oldValue'], $string);
        $this->assertEquals($changeLog['newValue'], $string2);
    }

    public function testSetFloatMethod()
    {
        $this->testObject = new Model();

        $float = 9.99;
        $float2 = 9.98;

        //Id
        $changeLog = $this->testObject->setTotalPrice($float);
        $this->assertEquals($this->testObject->getTotalPrice(), $float);
        $this->assertTrue($changeLog['TotalPrice']);
        $this->assertEquals($changeLog['oldValue'], null);
        $this->assertEquals($changeLog['newValue'], $float);

        $changeLog = $this->testObject->setTotalPrice($float2);
        $this->assertEquals($changeLog['oldValue'], $float);
        $this->assertEquals($changeLog['newValue'], $float2);
    }

    public function testSetDateMethod()
    {
        $this->testObject = new Model();

        $timeValue = new \DateTime();
        $timeValue2 = new \DateTime();

        // Arrival
        $changeLog = $this->testObject->setArrival($timeValue);
        $this->assertEquals($this->testObject->getArrival(), $timeValue);
        $this->assertTrue($changeLog['Arrival']);
        $this->assertEquals($changeLog['oldValue'], null);
        $this->assertEquals($changeLog['newValue'], $timeValue);
        $changeLog = $this->testObject->setArrival($timeValue2);
        $this->assertEquals($changeLog['oldValue'], $timeValue);
        $this->assertEquals($changeLog['newValue'], $timeValue2);

        //Departure
        $changeLog = $this->testObject->setDeparture($timeValue);
        $this->assertEquals($this->testObject->getDeparture(), $timeValue);
        $this->assertTrue($changeLog['Departure']);
        $this->assertEquals($changeLog['oldValue'], null);
        $this->assertEquals($changeLog['newValue'], $timeValue);
        $changeLog = $this->testObject->setDeparture($timeValue2);
        $this->assertEquals($changeLog['oldValue'], $timeValue);
        $this->assertEquals($changeLog['newValue'], $timeValue2);


    }

}
