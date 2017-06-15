<?php
namespace Collections;

class ListIterator implements \Iterator
{
    /** @var int **/
    private $cursor = 0;

    /** @var Lists */
    private $list;

    /**
     * ListIterator constructor.
     *
     * @param Lists $list
     */
    public function __construct(Lists $list)
    {
        $this->list = $list;
    }

    public function current()
    {
        return $this->list->get($this->cursor);
    }

    /**
     * @todo it should throw nosuchelement
     *
     */
    public function next(): void
    {
        ++$this->cursor;
    }

    public function key(): int
    {
        return $this->cursor;
    }

    public function valid(): bool
    {
        return $this->cursor != $this->list->count();
    }

    public function rewind()
    {
        $this->cursor = 0;
    }
}
