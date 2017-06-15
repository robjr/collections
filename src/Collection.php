<?php
namespace Collections;

interface Collection extends \IteratorAggregate, \Countable
{
    public function add($element): void;
    public function addAll(Collection $collection): void;
    public function clear(): void;
    public function contains($element): bool;
    public function containsAll(Collection $collection): bool;
    public function isEmpty(): bool;
    public function remove($element): void;
    public function removeAll(Collection $collection): void;
    public function toArray(): array;
}
