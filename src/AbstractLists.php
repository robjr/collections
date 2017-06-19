<?php
namespace Collections;

abstract class AbstractLists extends AbstractCollection implements Lists
{
    abstract public function addAt(int $index, $element): void;

    /**
     * Appends the $element to the end of this list.
     *
     * @param mixed $element The $element to be appended to the end of this list.
     */
    public function add($element): void
    {
        $this->addAt($this->count(), $element);
    }

    public function first()
    {
        return $this->get(0);
    }

    public function firstIndexOf($element): int
    {
        foreach ($this as $key => $value) {
            if ($value == $element) {
                return $key;
            }
        }

        return -1;
    }

    public function last()
    {
        return $this->get($this->count() - 1);
    }

    public function lastIndexOf($element): int
    {
        $pos = -1;

        foreach ($this as $key => $value) {
            if ($value == $element) {
                $pos = $key;
            }
        }

        return $pos;
    }

    /**
     * {@inheritdoc}
     *
     * Note that strict comparison is used to determine if $element is present in this collection and should be removed.
     *
     * @param mixed $element {@inheritdoc}
     */
    public function remove($element): void
    {
        foreach ($this as $key => $listElement) {
            if ($listElement === $element) {
                $this->removeAt($key);
                return;
            }
        }
    }

    public function replace(int $index, $element): void
    {
        $this->removeAt($index);
        $this->addAt($index, $element);
    }

    public function subList(int $start, int $end): Lists
    {
        /** @var AbstractLists $sublist */
        $sublist = new $this();

        for (; $start <= $end; $start++) {
            $sublist->add($this->get($start));
        }

        return $sublist;
    }

    public function clear(): void
    {
        while ($this->count()) {
            $this->removeAt(0);
        }
    }

    public function getIterator(): \Iterator
    {
        return new ListIterator($this);
    }
}
