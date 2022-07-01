<?php

namespace Tests\Unit\ReadingsDetector\Reading\Domain\ValueObject;

use Src\ReadingsDetector\Reading\Domain\ValueObject\ClientId;
use Tests\Utils\Stubs\Shared\Domain\ValueObject\StringMother;

final class ClientIdMother
{
    public static function create(string $id): ClientId
    {
        return new ClientId($id);
    }

    public static function random(): ClientId
    {
        return self::create(StringMother::random());
    }
}
