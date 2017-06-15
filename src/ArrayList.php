<?php
namespace Collections;

class ArrayList extends AbstractLists implements Lists, \ArrayAccess
{
    /** @var array */
    protected $elements;

    public function __construct(... $elements)
    {
        $this->elements = $elements;
    }

    public function count(): int
    {
        return count($this->elements);
    }

    /**
     * @todo check range for add
     * @todo check comodification
     */
    public function addAt(int $index, $element): void
    {
        array_splice($this->elements, $index, 0, $element);
    }

    /**
     * @todo check if index exists
     */
    public function get(int $index)
    {
        return $this->elements[$index];
    }

    /**
     * @todo check range
     */
    public function removeAt(int $index)
    {
        array_splice($this->elements, $index, 1);
    }

    public function offsetExists($offset): bool
    {
        return is_int($offset) && $offset < $this->count();
    }

    public function offsetGet($offset)
    {
        return $this->get($offset);
    }

    public function offsetSet($offset, $element): void
    {
        $this->addAt($offset, $element);
    }

    public function offsetUnset($offset)
    {
        $this->removeAt($offset);
    }
}
