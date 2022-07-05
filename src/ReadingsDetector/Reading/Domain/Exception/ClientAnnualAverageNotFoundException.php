<?php

namespace Src\ReadingsDetector\Reading\Domain\Exception;

use Exception;
use Src\ReadingsDetector\Reading\Domain\ValueObject\ClientId;

class ClientAnnualAverageNotFoundException extends Exception
{
	public static function ofClientId(ClientId $clientId) : ClientAnnualAverageNotFoundException
    {
        return new self(sprintf("Average from clientId %s not found", $clientId->value()));
    }
}
