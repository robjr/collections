<?php
namespace Collections\Tests;

use Collections\CollectionInterface;
use PHPUnit\Framework\TestCase;

abstract class BaseCollectionTest extends TestCase
{
    abstract public function createCollection(...$elements): CollectionInterface;

    public function testToArray(): void
    {
        $collection = $this->createCollection(1, 2);
        $this->assertEquals([1, 2], $collection->toArray());
    }

    public function testCount(): void
    {
        $collection1 = $this->createCollection();
        $collection2 = $this->createCollection(1, 2, 3);
        
        $this->assertEquals(0, $collection1->count());
        $this->assertEquals(3, $collection2->count());
        $this->assertEquals(3, count($collection2));
    }

    public function testContains(): void
    {
        $strings = $this->createCollection('test1', 'test2');
        $collection = $this->createCollection(4, 5, $strings);

        $this->assertTrue($collection->contains(4));
        $this->assertTrue($collection->contains($strings));
        $this->assertFalse($collection->contains(7));
        $this->assertFalse($collection->contains($this->createCollection('test1', 'test2')));
    }
    
    public function testAdd(): void
    {
        $collection = $this->createCollection();
        
        $collection->add('test');
        $this->assertCount(1, $collection);
        $this->assertTrue($collection->contains('test'));
    }

    public function testAddAll(): void
    {
        $collection = $this->createCollection(1, 2, 3);
        $collection->addAll($this->createCollection(4, 5));

        $this->assertCount(5, $collection);
        $this->assertArraySubset([1, 2, 3, 4, 5], $collection->toArray());
    }

    public function testContainsAll(): void
    {
        $collection = $this->createCollection(1, 2, 3);

        $this->assertTrue($collection->containsAll($this->createCollection(1, 2, 3)));
        $this->assertFalse($collection->containsAll($this->createCollection(1, 2, 3, 10)));
    }

    public function testEmpty(): void
    {
        $this->assertTrue(($this->createCollection())->isEmpty());
        $this->assertFalse(($this->createCollection(1))->isEmpty());
    }

    public function testClear(): void
    {
        $collection = $this->createCollection(7, 7, 7);

        $this->assertFalse($collection->isEmpty());
        $collection->clear();
        $this->assertTrue($collection->isEmpty());
    }

    public function testRemove(): void
    {
        $countries = $this->createCollection('BR', 'US');
        $collection = $this->createCollection(1, 2, 3, $countries);

        $collection->remove(2);
        $this->assertFalse($collection->contains(2));
        $this->assertCount(3, $collection);

        $collection->remove($this->createCollection('BR', 'US'));
        $this->assertCount(3, $collection);

        $collection->remove($countries);
        $this->assertCount(2, $collection);
    }

    public function testRemoveAll(): void
    {
        $countries = $this->createCollection('BR', 'CA', 'SG');
        $collection = $this->createCollection(1, '2', $countries, $this->createCollection());

        $collection->removeAll($this->createCollection(1, 2));
        $this->assertCount(3, $collection);
        $this->assertFalse($collection->contains(1));
        $this->assertTrue($collection->contains('2'));


        $collection->removeAll($this->createCollection($countries, $this->createCollection()));
        $this->assertCount(2, $collection);
        $this->assertFalse($collection->contains($countries));
    }

    public function testGetIterator(): void
    {
        $collection = $this->createCollection(1, 2, 3);

        $iterator = $collection->getIterator();
        $this->assertInstanceOf(\Iterator::class, $iterator);
    }
}
