## Router
```
  _____            _                         _            
 |  __ \          | |                       | |           
 | |__) | ___   __| | _   _ __  __    _ __  | |__   _ __  
 |  _  / / _ \ / _` || | | |\ \/ /   | '_ \ | '_ \ | '_ \ 
 | | \ \|  __/| (_| || |_| | >  <  _ | |_) || | | || |_) |
 |_|  \_\\___| \__,_| \__,_|/_/\_\(_)| .__/ |_| |_|| .__/ 
                                     | |           | |    
                                     |_|           |_|    

```
simple Redux implementation for PHP

[![Total Downloads](https://poser.pugx.org/izniburak/redux/d/total.svg)](https://packagist.org/packages/izniburak/redux)
[![Latest Stable Version](https://poser.pugx.org/izniburak/redux/v/stable.svg)](https://packagist.org/packages/izniburak/redux)
[![Latest Unstable Version](https://poser.pugx.org/izniburak/redux/v/unstable.svg)](https://packagist.org/packages/izniburak/redux)
[![License](https://poser.pugx.org/izniburak/redux/license.svg)](https://packagist.org/packages/izniburak/redux)

Today (10 Feb 2020), I found a blog post on [Reddit](https://www.reddit.com/r/PHP/comments/f195ti/redux_in_30_lines_of_php/) about "Redux in 30 lines of PHP". You can reach it via [this link](https://sorin.live/redux-in-50-lines-of-php/). 
I wondered it and read blog post. I liked it! Then, I wanted to create a PHP package about that. 



## Install

composer.json file:
```json
{
    "require": {
        "izniburak/redux": "^1"
    }
}
```
after run the install command.
```
$ composer install
```

OR run the following command directly.

```
$ composer require izniburak/redux
```

## Example Usage
```php
<?php

require __DIR__ . '/vendor/autoload.php';

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
```

## ToDo
- Write Test

## Support
[izniburak's homepage][author-url]

[izniburak's twitter][twitter-url]

## Licence
[MIT Licence][mit-url]

## Contributing

1. Fork it ( https://github.com/izniburak/redux.php/fork )
2. Create your feature branch (git checkout -b my-new-feature)
3. Commit your changes (git commit -am 'Add some feature')
4. Push to the branch (git push origin my-new-feature)
5. Create a new Pull Request

## Contributors

- [izniburak](https://github.com/izniburak) İzni Burak Demirtaş - creator, maintainer

[mit-url]: http://opensource.org/licenses/MIT
[author-url]: https://burakdemirtas.org
[twitter-url]: https://twitter.com/izniburak