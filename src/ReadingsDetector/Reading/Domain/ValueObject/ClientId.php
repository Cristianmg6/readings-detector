<?php

namespace Src\ReadingsDetector\Reading\Domain\ValueObject;

final class ClientId
{
    public function __construct(private string $id){ }

    public function value() : string
    {
        return $this->id;
    }

}
