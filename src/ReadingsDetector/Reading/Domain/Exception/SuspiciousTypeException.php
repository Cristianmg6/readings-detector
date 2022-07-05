<?php

namespace Src\ReadingsDetector\Reading\Domain\Exception;

use Exception;

final class SuspiciousTypeException extends Exception
{
	public function ofTypeNotAvailable(string $type, array $availableTypes) : SuspiciousTypeException
    {
        $stringAvailableTypes = implode(",", $availableTypes);
        return new self(
            sprintf('Type %s not available. Available types: '.
                    ' Available types: [%s]', $type, $stringAvailableTypes));
    }
}
