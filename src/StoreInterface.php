<?php

namespace Buki\Redux;

interface StoreInterface
{
    /**
     * @param array|callable $action
     *
     * @return void
     */
    public function dispatch($action): void;
}
