<?php

namespace Buki\Redux;

interface ActionInterface
{
    /**
     * @return array
     */
    public function getActions(): array;
}