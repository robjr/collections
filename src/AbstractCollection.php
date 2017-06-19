<?php
namespace Collections;

abstract class AbstractCollection implements Collection
{
    /**
     * {@inheritdoc}
     *
     * @param mixed $element {@inheritdoc}
     */
    abstract public function add($element): void;

    /**
     * {@inheritdoc}
     */
    abstract public function clear(): void;

    /**
     * {@inheritdoc}
     *
     * @return int {@inheritdoc}
     */
    abstract public function count(): int;

    /**
     * {@inheritdoc}
     *
     * @return \Iterator {@inheritdoc}
     */
    abstract public function getIterator(): \Iterator;

    /**
     * {@inheritdoc}
     *
     * @param mixed $element {@inheritdoc}
     */
    abstract public function remove($element): void;

    /**
     * {@inheritdoc}
     *
     * @param Collection $collection {@inheritdoc}
     * @see add
     */
    public function addAll(Collection $collection): void
    {
        foreach ($collection as $object) {
            $this->add($object);
        }
    }

    /**
     * {@inheritdoc}
     *
     * Note that $element is present in this collection, if it has the same type and value of at least one element
     * in this collection. In other words, strict comparison is used to determine if the $element is present.
     *
     * @param mixed $element {@inheritdoc}
     * @return bool {@inheritdoc}
     */
    public function contains($element): bool
    {
        foreach ($this as $object) {
            if ($object === $element) {
                return true;
            }
        }

        return false;
    }

    /**
     * {@inheritdoc}
     *
     * Note that each element of $collection is present in this collection, if it has the same type and value of
     * at least one element in this collection. In other words, strict comparison is used to determine
     * if an $element is present.
     *
     * @param mixed $element {@inheritdoc}
     * @return bool {@inheritdoc}
     * @see contains
     */
    public function containsAll(Collection $collection): bool
    {
        foreach ($collection as $object) {
            if (!$this->contains($object)) {
                return false;
            }
        }

        return true;
    }

    /**
     * {@inheritdoc}
     *
     * @return bool {@inheritdoc}
     */
    public function isEmpty(): bool
    {
        return 0 === $this->count();
    }

    /**
     * {@inheritdoc}
     *
     * @param Collection $collection {@inheritdoc}
     * @see remove
     */
    public function removeAll(Collection $collection): void
    {
        foreach ($collection as $object) {
            $this->remove($object);
        }
    }

    /**
     * {@inheritdoc}
     *
     * @return array {@inheritdoc}
     */
    public function toArray(): array
    {
        return iterator_to_array($this->getIterator());
    }
}
