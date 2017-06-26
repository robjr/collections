<?php
namespace Collections;

class ArrayList extends AbstractList implements ListInterface, \ArrayAccess
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
     * {@inheritdoc}
     *
     * @param int $index {@inheritdoc}
     * @param mixed $element {@inheritdoc}
     * @throws \OutOfBoundsException {@inheritdoc}
     *
     * @todo check comodification
     */
    public function addAt(int $index, $element): void
    {
        if ($index < 0 || $index > $this->count()) {
            throw new \OutOfBoundsException($this->buildOutOfBoundsMessage($index));
        }

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
            throw new \OutOfBoundsException($this->buildOutOfBoundsMessage($index));
        }

        return $this->elements[$index];
    }

    /**
     * {@inheritdoc}
     *
     * @param int $index {@inheritdoc}
     * @throws \OutOfBoundsException {@inheritdoc}
     */
    public function removeAt(int $index)
    {
        if (!$this->offsetExists($index)) {
            throw new \OutOfBoundsException($this->buildOutOfBoundsMessage($index));
        }

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

    /**
     * @param int $index
     * @return string
     */
    private function buildOutOfBoundsMessage(int $index): string
    {
        return sprintf('The index "%d" doesn\'t exist.', $index);
    }
}
