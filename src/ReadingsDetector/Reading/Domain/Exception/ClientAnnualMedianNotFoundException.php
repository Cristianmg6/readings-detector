<?php

namespace Src\ReadingsDetector\Reading\Domain\Exception;

use Exception;
use Src\ReadingsDetector\Reading\Domain\ValueObject\ClientId;

class ClientAnnualMedianNotFoundException extends Exception
{
	public static function ofClientId(ClientId $clientId) : ClientAnnualMedianNotFoundException
    {
        return new self(sprintf("Median from clientId %s not found", $clientId->value()));
    }
}
