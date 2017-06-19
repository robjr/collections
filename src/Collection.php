<?php
namespace Collections;

interface Collection extends \IteratorAggregate, \Countable
{

    public function add($element): void;
    public function addAll(Collection $collection): void;
    public function clear(): void;

    /**
     * Returns true if $element is present in the collection.
     *
     * @param $element mixed The element that should be present in this collection.
     * @return bool True if the $element is in the collection. False, otherwise.
     */
    public function contains($element): bool;

    /**
     * Returns true if all the elements in $collection is present in this collection.
     *
     * @param Collection $collection Collection containing all the elements that should be present in this collection.
     * @return bool True if the all elements in $collection are in this collection. False, otherwise.
     */
    public function containsAll(Collection $collection): bool;

    /**
     * Returns true if there is no elements in this collection.
     *
     * @return bool True if this collection contains no elements, false if it contains at least one element.
     */
    public function isEmpty(): bool;
    public function remove($element): void;
    public function removeAll(Collection $collection): void;
    public function toArray(): array;
}
