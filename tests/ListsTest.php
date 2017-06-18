<?php
namespace Collections\Tests;

use Collections\Collection;
use Collections\Lists;

abstract class ListsTest extends CollectionTest
{
    abstract public function createLists(...$elements): Lists;

    public function createCollection(...$elements): Collection
    {
        return $this->createLists(...$elements);
    }

    public function testGet(): void
    {
        $list = $this->createLists(1, 2);

        $this->assertEquals(1, $list->get(0));
        $this->assertEquals(2, $list->get(1));
    }

    public function testFirst(): void
    {
        $list = $this->createLists(1, 2);
        
        $this->assertEquals(1, $list->first());
    }

    public function testFirstIndexOf(): void
    {
        $list = $this->createLists(7, 7, 7);
        
        $this->assertEquals(0, $list->firstIndexOf(7));
        $this->assertEquals(-1, $list->firstIndexOf(8));
    }

    public function testLast(): void
    {
        $list = $this->createLists(1, 2);

        $this->assertEquals(2, $list->last());
    }

    public function testLastIndexOf(): void
    {
        $list = $this->createLists(7, 7, 7);
        
        $this->assertEquals(2, $list->lastIndexOf(7));
        $this->assertEquals(-1, $list->lastIndexOf(8));
    }

    public function testRemoveAt(): void
    {
        $list = $this->createLists(1, 2, 3);
        
        $list->removeAt(1);
        $this->assertEquals(3, $list->get(1));
        $this->assertCount(2, $list);
    }

    public function testAddAt(): void
    {
        $list = $this->createLists();
        
        $list->addAt(0, 0);
        $list->addAt(1, 1);
        $this->assertEquals(0, $list->get(0));
        $this->assertEquals(1, $list->get(1));
    }

    public function testReplace(): void
    {
        $list = $this->createLists(7, 7);

        $list->replace(0, 1);
        $list->replace(1, 2);

        $this->assertArraySubset([1, 2], $list->toArray());
    }

    public function testSubList(): void
    {
        $list = $this->createLists(1, 2, 3, 4);

        $sublist = $list->subList(1, 2);
        $this->assertArraySubset([2, 3], $sublist->toArray());
    }
}
