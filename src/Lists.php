<?php
namespace Collections;

interface Lists extends Collection
{
    public function addAt(int $index, $element): void;
    public function get(int $index);
    public function firstIndexOf($element): int;
    public function lastIndexOf($element): int;
    public function removeAt(int $index);
    public function replace(int $index, $element): void;
    public function subList(int $start, int $end): Lists;
    public function first();
    public function last();
}
