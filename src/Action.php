<?php

namespace Buki\Redux;

class Action implements ActionInterface
{
    /**
     * @var array
     */
    protected $actions = [];

    /**
     * Action constructor.
     *
     * @param array $actions
     */
    public function __construct(array $actions = [])
    {
        $this->actions = $actions;
    }

    /**
     * @param array|string        $action
     * @param array|callable|null $value
     *
     * @return void
     */
    public function add($action, $value = null): void
    {
        if (is_array($action)) {
            $this->actions = array_merge($this->actions, $action);
            return;
        }

        $this->actions[$action] = $value;
    }

    /**
     * @param string $action
     *
     * @return array|callable|null
     */
    public function get($action)
    {
        return $this->actions[$action] ?? null;
    }

    /**
     * @return array
     */
    public function getActions(): array
    {
        return $this->actions;
    }

    /**
     * @param string $action
     *
     * @return bool
     */
    public function remove($action): bool
    {
        if (array_key_exists($action, $this->actions)) {
            unset($this->actions[$action]);
            return true;
        }

        return false;
    }

    /**
     * Update State Helper
     *
     * @param array $state
     * @param array $newState
     *
     * @return array
     */
    public static function updateState(array $state, array $newState): array
    {
        return array_replace([], $state, $newState);
    }

    /**
     * @param $name
     *
     * @return array|null
     */
    public function __get($name)
    {
        return $this->get($name);
    }

    /**
     * @param $name
     * @param $value
     */
    public function __set($name, $value)
    {
        $this->add($name, $value);
    }
}
