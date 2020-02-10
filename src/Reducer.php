<?php

namespace Buki\Redux;

class Reducer implements ReducerInterface
{
    /**
     * @var callable|null
     */
    protected $reducer = null;

    /**
     * Reducer constructor.
     *
     * @param callable $reducer
     */
    public function __construct(callable $reducer)
    {
        $this->reducer = $reducer;
    }

    /**
     * @return callable|null
     */
    public function getReducer(): ?callable
    {
        return $this->reducer;
    }
}
