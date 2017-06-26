<?php
namespace Collections\Tests;

use Collections\ArrayList;
use Collections\ListInterface;

class ArrayListTest extends BaseListTest
{
    public function createList(...$elements): ListInterface
    {
        return $this->createArrayList(...$elements);
    }

    public function createArrayList(...$elements): ArrayList
    {
        return new ArrayList(...$elements);
    }

    public function testIsset()
    {
        $arrayList = $this->createArrayList(0);

        $this->assertTrue(isset($arrayList[0]));
        $this->assertFalse(isset($arrayList[100]));
        $this->assertFalse(isset($arrayList['test']));
    }

    public function testLoop()
    {
        $arrayList = $this->createArrayList(1, 2, 3);

        foreach ($arrayList as $key => $item) {
            $this->assertEquals($arrayList->get($key), $item);
        }
    }

    public function testOffsetUnset()
    {
        $arrayList = $this->createArrayList(1, 2, 3);

        $arrayList->offsetUnset(1);
        $this->assertEquals(3, $arrayList[1]);
        $this->assertCount(2, $arrayList);
    }

    public function testOffsetExists()
    {
        $arrayList = $this->createArrayList(1, 2, 3);

        $this->assertTrue($arrayList->offsetExists(2));
        $this->assertFalse($arrayList->offsetExists(3));
    }

    public function testOffsetGet()
    {
        $arrayList = $this->createArrayList(1, 2);

        $this->assertEquals(1, $arrayList->offsetGet(0));
        $this->assertEquals(2, $arrayList->offsetGet(1));
    }

    public function testOffsetSet()
    {
        $arrayList = $this->createArrayList();

        $arrayList->offsetSet(0, 0);
        $arrayList->offsetSet(1, 1);
        $this->assertEquals(0, $arrayList->get(0));
        $this->assertEquals(1, $arrayList->get(1));
    }
}
