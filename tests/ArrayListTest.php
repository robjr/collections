<?php
namespace Collections\Tests;

use Collections\ArrayList;
use PHPUnit\Framework\TestCase;

class ArrayListTest extends TestCase
{
    /** @var  ArrayList */
    protected $arrayList;

    protected function setUp()
    {
        $this->arrayList = new ArrayList(1, 3, 5, new ArrayList(7));
    }

    public function testBuild()
    {
        $this->assertInstanceOf(ArrayList::class, $this->arrayList);
    }

    public function testCount()
    {
        $this->assertEquals(4, count($this->arrayList));
        $this->assertEquals(4, $this->arrayList->count());
    }

    public function testGet()
    {
        $this->assertEquals(3, $this->arrayList->get(1));
        $this->assertEquals(3, $this->arrayList[1]);
    }

    public function testLast()
    {
        $this->assertInstanceOf(ArrayList::class, $this->arrayList->last());
    }

    public function testAdd()
    {
        $arraySize = count($this->arrayList);
        $this->arrayList->add(10);
        $this->assertEquals(10, $this->arrayList->last());
        $this->assertEquals(++$arraySize, count($this->arrayList));
    }

    public function testAddAt()
    {
        $arrayList = new ArrayList();
        $arrayList->addAt(0, 0);
        $arrayList->addAt(1, 1);
        $this->assertEquals(0, $arrayList->get(0));
        $this->assertEquals(1, $arrayList->get(1));
    }

    public function testAddAll()
    {
        $arrayList = new ArrayList(1, 2, 3);
        $arrayList->addAll(new ArrayList(4, 5));

        $this->assertCount(5, $arrayList);
        $this->assertArraySubset([1, 2, 3, 4, 5], $arrayList);
    }

    public function testContains()
    {
        $arrayList = $this->arrayList->last();

        $this->assertTrue($this->arrayList->contains($arrayList));
        $this->assertTrue($this->arrayList->contains(3));
        $this->assertFalse($this->arrayList->contains(new ArrayList(7)));
    }

    public function testContainsAll()
    {
        $this->assertTrue($this->arrayList->containsAll(new ArrayList(1, 3, 5)));
        $this->assertFalse($this->arrayList->containsAll(new ArrayList(1, 3, 5, 10)));
    }

    public function testEmpty()
    {
        $this->assertTrue((new ArrayList())->isEmpty());
        $this->assertFalse($this->arrayList->isEmpty());
    }

    public function testIsset()
    {
        $this->assertTrue(isset($this->arrayList[0]));
        $this->assertFalse(isset($this->arrayList[100]));
        $this->assertFalse(isset($this->arrayList['test']));
    }

    public function testLoop()
    {
        foreach ($this->arrayList as $key => $item) {
            $this->assertEquals($this->arrayList->get($key), $item);
        }
    }

    /**
     * @todo create a specific test for the iterator
     */
    public function testListIterator()
    {
        $iterator = $this->arrayList->getIterator();
        $this->assertInstanceOf(\Iterator::class, $iterator);

        $iterator = $this->arrayList->getIterator();
        $this->assertEquals(1, $iterator->current());

        $iterator->next();
        $this->assertEquals($iterator->key(), 1);
        $this->assertEquals(3, $iterator->current());

        $iterator->next();
        $this->assertTrue($iterator->valid());

        $iterator->next();
        $iterator->next();
        $this->assertFalse($iterator->valid());

        $iterator->rewind();
        $this->assertEquals(1, $iterator->current());
    }

    public function testFirst()
    {
        $this->assertEquals(1, $this->arrayList->first());
    }

    public function testToArray()
    {
        $arrayList = new ArrayList(1, 2);
        $this->assertEquals([1, 2], $arrayList->toArray());
    }

    public function testFirstIndexOf()
    {
        $arrayList = new ArrayList(7, 7, 7);
        $this->assertEquals(0, $arrayList->firstIndexOf(7));
        $this->assertEquals(-1, $arrayList->firstIndexOf(1234));
    }

    public function testLastIndexOf()
    {
        $arrayList = new ArrayList(7, 7, 7);
        $this->assertEquals(2, $arrayList->lastIndexOf(7));
        $this->assertEquals(-1, $arrayList->lastIndexOf(1234));
    }

    public function testRemove()
    {
        $arrayList = new ArrayList(1, 2, 2, 3);
        $arrayList->remove(2);
        $this->assertEquals(2, $arrayList[1]);
        $this->assertCount(3, $arrayList);
    }

    public function testRemoveAll()
    {
        $countries = new ArrayList('BR', 'CA', 'SG');
        $emptyList = new ArrayList();
        $arrayList = new ArrayList(1, '2', $emptyList, 4, 5, $countries);

        $arrayList->removeAll(new ArrayList(1, 2));

        $this->assertCount(5, $arrayList);
        $this->assertEquals(2, $arrayList->first());

        $arrayList->removeAll(new ArrayList(new ArrayList(), $countries));
        $this->assertCount(4, $arrayList);
        $this->assertEquals(5, $arrayList->last());
    }

    public function testRemoveAt()
    {
        $arrayList = new ArrayList(1, 2, 3);
        $arrayList->removeAt(1);
        $this->assertEquals(3, $arrayList[1]);
        $this->assertCount(2, $arrayList);
    }

    public function testOffsetUnset()
    {
        $arrayList = new ArrayList(1, 2, 3);
        $arrayList->offsetUnset(1);
        $this->assertEquals(3, $arrayList[1]);
        $this->assertCount(2, $arrayList);
    }

    public function testOffsetExists()
    {
        $arrayList = new ArrayList(1, 2, 3);
        $this->assertTrue($arrayList->offsetExists(2));
        $this->assertFalse($arrayList->offsetExists(3));
    }

    public function testOffsetGet()
    {
        $arrayList = new ArrayList(1, 2);
        $this->assertEquals(1, $arrayList->offsetGet(0));
        $this->assertEquals(2, $arrayList->offsetGet(1));
    }

    public function testOffsetSet()
    {
        $arrayList = new ArrayList();
        $arrayList->offsetSet(0, 0);
        $arrayList->offsetSet(1, 1);
        $this->assertEquals(0, $arrayList->get(0));
        $this->assertEquals(1, $arrayList->get(1));
    }

    public function testClear()
    {
        $arrayList = new ArrayList(7, 7, 7);
        $this->assertFalse($arrayList->isEmpty());
        $arrayList->clear();
        $this->assertTrue($arrayList->isEmpty());
    }

    public function testReplace()
    {
        $arrayList = new ArrayList(7, 7);
        $arrayList->replace(0, 1);
        $arrayList->replace(1, 2);

        $this->assertArraySubset([1, 2], $arrayList);
    }

    public function testSubList()
    {
        $arrayList = new ArrayList(1, 2, 3, 4);
        $sublist = $arrayList->subList(1, 2);

        $this->assertArraySubset([2, 3], $sublist->toArray());
    }

    public function testComodification()
    {
        $this->expectException(\Exception::class);

        $arrayList = new \ArrayIterator([1, 2, 3, 4, 5]);
        foreach ($arrayList as $key => $value) {
            $arrayList->offsetUnset($key);
        }
   }
}
