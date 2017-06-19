<?php
namespace Collections;

interface Collection extends \IteratorAggregate, \Countable
{
    /**
     * Adds the $element to this collection.
     *
     * @param mixed $element The element to be added to this collection.
     */
    public function add($element): void;

    /**
     * Adds to this collection all the $elements from $collection.
     *
     * @param Collection $collection
     * @see add
     */
    public function addAll(Collection $collection): void;

    /**
     * Removes all the elements from this collection.
     */
    public function clear(): void;

    /**
     * Returns the number of elements present in this collection.
     * Note that you can use the count() function over this class.
     *
     * @return int Number of elements of this collection.
     */
    public function count(): int;

    /**
     * Returns true if $element is present in the collection.
     *
     * @param mixed $element The element that should be present in this collection.
     * @return bool True if the $element is in the collection. False, otherwise.
     */
    public function contains($element): bool;

    /**
     * Returns true if all the elements in $collection is present in this collection.
     *
     * @param Collection $collection Collection containing all the elements that should be present in this collection.
     * @return bool True if the all elements in $collection are in this collection. False, otherwise.
     * @see contains
     */
    public function containsAll(Collection $collection): bool;

    /**
     * Returns an iterator over the elements in this collection.
     * Note that you can iterate over the elements without getting the iterator. Instead, use the object directly
     * in the foreach ($collection as $key => value).
     *
     * @return \Iterator An iterator over the elements in this collection.
     */
    public function getIterator(): \Iterator;

    /**
     * Returns true if there is no elements in this collection.
     *
     * @return bool True if this collection contains no elements, false if it contains at least one element.
     */
    public function isEmpty(): bool;

    /**
     * Removes one instance of $element from this collection, if it is present.
     *
     * @param mixed $element The element to be removed from this collection, if present.
     */
    public function remove($element): void;

    /**
     * Removes from this collection one instance of each element of $collection.
     *
     * @param Collection $collection
     * @see remove
     */
    public function removeAll(Collection $collection): void;

    /**
     * Returns an array containing all the elements of this collection.
     *
     * @return array An array containing all the elements of this collection.
     */
    public function toArray(): array;
}
