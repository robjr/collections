<?php
namespace Collections;

abstract class AbstractCollection implements Collection
{
    abstract public function count(): int;
    abstract public function add($element): void;
    abstract public function remove($element): void;
    abstract public function clear(): void;
    abstract public function getIterator(): \Iterator;

    public function addAll(Collection $collection): void
    {
        $iterator = $collection->getIterator();

        foreach ($iterator as $object) {
            $this->add($object);
        }
    }

    public function contains($element): bool
    {
        $iterator = $this->getIterator();

        foreach ($iterator as $object) {
            if ($object === $element) {
                return true;
            }
        }

        return false;
    }

    public function containsAll(Collection $collection): bool
    {
        $iterator = $collection->getIterator();

        foreach ($iterator as $object) {
            if (!$this->contains($object)) {
                return false;
            }
        }

        return true;
    }

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
