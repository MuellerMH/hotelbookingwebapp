<?php
/**
 * MIT License
 *
 * Copyright (c) 2017. Manuel H. Müller
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 *                                           LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */

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
