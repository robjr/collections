<?php
namespace Collections;

interface Lists extends Collection
{
    /**
     * Inserts the $element at the specified position.
     *
     * @param int $index Positive integer that specifies the position.
     * @param mixed $element The element to be inserted.
     * @throws \OutOfBoundsException If $index < 0 || $index > count()
     */
    public function addAt(int $index, $element): void;

    /**
     * Returns the first element of this list.
     *
     * @return mixed The first element of this list.
     * @throws \OutOfBoundsException When there is no element in this list.
     */
    public function first();

    /**
     * @param $element
     * @return int
     */
    public function firstIndexOf($element): int;

    /**
     * Returns the element at the specified position in this list.
     *
     * @param int $index Positive integer that specifies the position.
     * @return mixed The element at the specified position.
     * @throws \OutOfBoundsException If $index < 0 || $index > count()
     */
    public function get(int $index);

    /**
     * Returns the last element of this list.
     *
     * @return mixed The last element of this list.
     * @throws \OutOfBoundsException When there is no element in this list.
     */
    public function last();

    /**
     * @param $element
     * @return int
     */
    public function lastIndexOf($element): int;

    /**
     * @param int $index
     * @return mixed
     * @throws \OutOfBoundsException
     */
    public function removeAt(int $index);

    /**
     * @param int $index
     * @param $element
     * @throws \OutOfBoundsException
     */
    public function replace(int $index, $element): void;

    /**
     * @param int $start
     * @param int $end
     * @return Lists
     * @throws \OutOfRangeException
     */
    public function subList(int $start, int $end): Lists;
}
