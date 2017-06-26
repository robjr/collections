<?php
namespace Collections\Tests;

use Collections\CollectionInterface;
use Collections\ListInterface;

abstract class BaseListTest extends BaseCollectionTest
{
    abstract public function createList(...$elements): ListInterface;

    public function createCollection(...$elements): CollectionInterface
    {
        return $this->createList(...$elements);
    }

    public function testAddAt(): void
    {
        $list = $this->createList();

        $list->addAt(0, 0);
        $list->addAt(1, 1);
        $this->assertEquals(0, $list->get(0));
        $this->assertEquals(1, $list->get(1));

        $list->addAt(0, 2);
        $list->addAt(2, 3);
        $list->addAt(4, 4);
        $this->assertArraySubset([2, 0, 3, 1, 4], $list->toArray());
    }

    /**
     * @param int $index
     * @dataProvider indexOutOfBoundsProvider
     */
    public function testAddAtOufOfRangeException(int $index): void
    {
        $this->expectException(\OutOfBoundsException::class);

        $list = $this->createList();
        $list->addAt($index, 1);
    }

    public function testGet(): void
    {
        $list = $this->createList(1, 2);

        $this->assertEquals(1, $list->get(0));
        $this->assertEquals(2, $list->get(1));
    }

    /**
     * @param int $index
     *
     * @dataProvider indexOutOfBoundsProvider
     */
    public function testGetOutOfBoundsException(int $index): void
    {
        $this->expectException(\OutOfBoundsException::class);

        $list = $this->createList(1);
        $list->get($index);
    }

    public function testFirst(): void
    {
        $list = $this->createList(1, 2);
        
        $this->assertEquals(1, $list->first());
    }

    public function testFirstException(): void
    {
        $this->expectException(\OutOfBoundsException::class);

        $list = $this->createList();
        $list->first();
    }

    public function testFirstIndexOf(): void
    {
        $list = $this->createList(7, 7, 7);
        
        $this->assertEquals(0, $list->firstIndexOf(7));
        $this->assertEquals(-1, $list->firstIndexOf(8));
    }

    public function testLast(): void
    {
        $list = $this->createList(1, 2);

        $this->assertEquals(2, $list->last());
    }

    public function testLastException(): void
    {
        $this->expectException(\OutOfBoundsException::class);

        $list = $this->createList();
        $list->last();
    }

    public function testLastIndexOf(): void
    {
        $list = $this->createList(7, 7, 7);
        
        $this->assertEquals(2, $list->lastIndexOf(7));
        $this->assertEquals(-1, $list->lastIndexOf(8));
    }

    public function testRemoveAt(): void
    {
        $list = $this->createList(1, 2, 3);
        
        $list->removeAt(1);
        $this->assertEquals(3, $list->get(1));
        $this->assertCount(2, $list);
    }

    /**
     * @param int $index
     * @dataProvider indexOutOfBoundsProvider
     */
    public function testRemoveAtException(int $index): void
    {
        $this->expectException(\OutOfBoundsException::class);
        $list = $this->createList();

        $list->removeAt($index);
    }

    public function indexOutOfBoundsProvider(): array
    {
        return [[-1], [1], [100]];
    }

    public function testReplace(): void
    {
        $list = $this->createList(4, 5, 6);

        $list->replace(0, 1);
        $list->replace(1, 2);
        $list->replace(2, 3);

        $this->assertArraySubset([1, 2, 3], $list->toArray());
    }

    public function testSubList(): void
    {
        $list = $this->createList(1, 2, 3, 4);

        $sublist = $list->subList(1, 2);
        $this->assertArraySubset([2, 3], $sublist->toArray());
    }
}
