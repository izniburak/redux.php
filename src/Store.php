<?php

namespace Buki\Redux;

use Closure;

class Store implements StoreInterface
{
    /**
     * @var array
     */
    protected $state;

    /**
     * @var Closure
     */
    protected $reducer;

    /**
     * @var array
     */
    protected $listeners = [];

    /**
     * Store constructor.
     *
     * @param Reducer $reducer
     * @param array   $initialState
     */
    public function __construct(Reducer $reducer, array $initialState)
    {
        $this->state = $initialState;
        $this->reducer = Closure::fromCallable($reducer->getReducer());
    }

    /**
     * @param array|callable $action
     *
     * @return void
     */
    public function dispatch($action): void
    {
        $this->state = ($this->reducer)($this->getState(), is_callable($action) ? $action() : $action);
        foreach ($this->listeners as $listener) {
            $listener($this->getState());
        }
    }

    /**
     * @return array
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @param callable $listener
     *
     * @return void
     */
    public function listen(callable $listener)
    {
        $this->listeners[] = Closure::fromCallable($listener);
    }
}
