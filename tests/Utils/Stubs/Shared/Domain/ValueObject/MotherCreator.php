<?php

namespace Tests\Utils\Stubs\Shared\Domain\ValueObject;

use Faker\Factory;
use Faker\Generator;

final class MotherCreator
{
    private static $faker;
    private static int $seed = 0;

    public static function random(): Generator
    {
        if (self::$faker === null) {
            self::$faker = Factory::create();
        }

        self::$faker->seed(self::$seed++);

        return self::$faker;
    }
}
