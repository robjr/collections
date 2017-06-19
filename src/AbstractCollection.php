<?php
namespace Collections;

abstract class AbstractCollection implements Collection
{
    abstract public function add($element): void;
    abstract public function clear(): void;
    abstract public function count(): int;
    abstract public function getIterator(): \Iterator;
    abstract public function remove($element): void;

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
     * @param $element {@inheritdoc}
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
     * @param $element {@inheritdoc}
     * @return bool {@inheritdoc}
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

    public function removeAll(Collection $collection): void
    {
        foreach ($collection as $object) {
            $this->remove($object);
        }
    }

    public function toArray(): array
    {
        return iterator_to_array($this->getIterator());
    }
}
