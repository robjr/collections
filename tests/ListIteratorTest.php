<?php
namespace Collections\Tests;

use Collections\ArrayList;
use Collections\ListIterator;
use PHPUnit\Framework\TestCase;

class ListIteratorTest extends TestCase
{
    /**
     * @var ListIterator
     */
    protected $listIterator;

    public function setUp(): void
    {
        $this->listIterator = new ListIterator(new ArrayList(1, 2, 3));
    }

    public function testKey(): void
    {
        $this->assertEquals(0, $this->listIterator->key());
    }

    public function testCurrent(): void
    {
        $this->assertEquals(1, $this->listIterator->current());
    }

    public function testNext(): ListIterator
    {
        $iterator = $this->listIterator;

        $iterator->next();
        $this->assertEquals(1, $iterator->key());
        $this->assertEquals(2, $iterator->current());

        $iterator->next();
        $this->assertEquals(2, $iterator->key());
        $this->assertEquals(3, $iterator->current());

        return $iterator;
    }

    /**
     * @depends testNext
     *
     * @param ListIterator $iterator
     * @return ListIterator
     */
    public function testValid(ListIterator $iterator): ListIterator
    {
        $this->assertTrue($iterator->valid());
        $iterator->next();
        $this->assertFalse($iterator->valid());

        return $iterator;
    }

    /**
     * @depends testValid
     *
     * @param ListIterator $iterator
     */
    public function testRewind(ListIterator $iterator): void
    {
        $iterator->rewind();
        $this->assertTrue($iterator->valid());
        $this->assertEquals(0, $iterator->key());
        $this->assertEquals(1, $iterator->current());
    }
}
