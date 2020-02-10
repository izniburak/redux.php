<?php

namespace Buki\Redux;

interface ReducerInterface
{
    /**
     * @return callable|null
     */
    public function getReducer(): ?callable;
}
