# Gravatar image provider for Faker

[![Tests](https://github.com/ottaviano/faker-gravatar/actions/workflows/tests.yaml/badge.svg?branch=master)](https://github.com/ottaviano/faker-gravatar/actions/workflows/tests.yaml)
[![Latest Version](https://img.shields.io/github/release/ottaviano/faker-gravatar.svg?style=flat-square)](https://github.com/ottaviano/faker-gravatar/releases)

It is [Gravatar](https://en.gravatar.com/site/implement/images/) image provider for ~~[fzaninotto/Faker](https://github.com/fzaninotto/Faker)~~ [fakerphp/faker](https://github.com/fakerphp/faker)

Here are some examples of generated avatars:

> ![mp](https://www.gravatar.com/avatar/ottaviano/faker-gravatar?d=mp&size=50) (mode: `mp`)
>
> ![identicon](https://www.gravatar.com/avatar/ottaviano/faker-gravatar?d=identicon&size=50) (mode: `identicon`)
>
> ![monsterid](https://www.gravatar.com/avatar/ottaviano/faker-gravatar?d=monsterid&size=50) (mode: `monsterid`)
> 
> ![wavatar](https://www.gravatar.com/avatar/ottaviano/faker-gravatar?d=wavatar&size=50) (mode: `wavatar`)
> 
> ![retro](https://www.gravatar.com/avatar/ottaviano/faker-gravatar?d=retro&size=50) (mode: `retro`)
>
> ![robohash](https://www.gravatar.com/avatar/ottaviano/faker-gravatar?d=robohash&size=50) (mode: `robohash`)
>
> ![blank](https://www.gravatar.com/avatar/ottaviano/faker-gravatar?d=blank&size=50) (mode: `blank`, transparent image)

## Requirements
 
 - PHP >= 7.1|8.0

## Installation

```bash
composer require ottaviano/faker-gravatar --dev
```

## Usage

```php
<?php

// ...

$faker = Faker\Factory::create();
$faker->addProvider(new Ottaviano\Faker\Gravatar($faker));

$imageLocalPath = $faker->gravatar();
$imageContent = file_get_contents($imageLocalPath);

// OR

$imageUrl = $faker->gravatarUrl();
```
