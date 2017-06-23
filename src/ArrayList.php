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
     * {@inheritdoc}
     *
     * @param int $index {@inheritdoc}
     * @return mixed {@inheritdoc}
     * @throws \OutOfBoundsException {@inheritdoc}
     */
    public function get(int $index)
    {
        if (!$this->offsetExists($index)) {
            throw new \OutOfBoundsException(sprintf('The index "%d" doesn\'t exist.', $index));
        }

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
        return isset($this->elements[$offset]);
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
