<?php

require __DIR__ . '/../vendor/autoload.php';

use Buki\Redux\{Action, Reducer, Store};

// Define a Initial State
$initialState = [
    'counter' => [
        'count' => 1,
    ],
];

// Define action constants
const INCREMENT_ACTION = 'INCREMENT';
const DECREMENT_ACTION = 'DECREMENT';
const SUM_ACTION = 'SUM';

// Create an Action
$actions = new Action([
    'increment' => function () {
        return [
            'type' => INCREMENT_ACTION,
        ];
    },
    'decrement' => [
        'type' => DECREMENT_ACTION,
    ],
    'sum' => function ($value) {
        return [
            'type' => SUM_ACTION,
            'data' => $value,
        ];
    },
]);

// Create a Reducer
$reducer = new Reducer(function ($state, $action) {
    switch ($action['type']) {
        case INCREMENT_ACTION:
            return Action::updateState($state, [
                'counter' => ['count' => $state['counter']['count'] + 1],
            ]);
        case DECREMENT_ACTION:
            return Action::updateState($state, [
                'counter' => ['count' => $state['counter']['count'] - 1],
            ]);
        case SUM_ACTION:
            return Action::updateState($state, [
                'counter' => ['count' => $state['counter']['count'] + $action['data']],
            ]);
        default:
            return $state;
    }
});

// Create a Redux Store
$store = new Store($reducer, $initialState);

// Add a listener
$store->listen(function ($state) {
    print_r($state);
});

// Dispatch actions
$store->dispatch($actions->get('increment'));
$store->dispatch($actions->get('increment'));
$store->dispatch($actions->get('increment'));
$store->dispatch($actions->get('decrement'));
$store->dispatch($actions->get('sum')(5));
