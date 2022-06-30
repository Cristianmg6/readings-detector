<?php

namespace Src\ReadingsDetector\Client\Domain\Entity;

use Src\ReadingsDetector\Client\Domain\ValueObject\ClientName;
use Src\ReadingsDetector\Shared\Domain\ValueObject\ClientId;

final class Client
{
    public function __construct(
        private ClientId $id,
        private ClientName $name
    ){ }

    public function id() : ClientId
    {
        return $this->id;
    }

    public function name() : ClientName
    {
        return $this->name;
    }


}
