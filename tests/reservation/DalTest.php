<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use \lib\modules\reservation\Dal;

/**
* @covers \lib\modules\reservation\Model;
*/
final class DalTest extends TestCase
{
    public function testGetById()
    {
        $arrayAll= Dal::getAll();

    }

    public function testGetAll()
    {
        $arrayAll= Dal::getById();
    }

    public function testSave()
    {
        $result = Dal::save();
    }

    public function testDelete()
    {
        $result = Dal::delete();
    }
}