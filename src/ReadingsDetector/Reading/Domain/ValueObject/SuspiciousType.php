<?php

namespace Src\ReadingsDetector\Reading\Domain\ValueObject;

use Src\ReadingsDetector\Reading\Domain\Exception\SuspiciousTypeException;

final class SuspiciousType
{
    private const SUSPICIOUS_TYPE_AVAILABLE = ['average', 'median'];

    /** * @throws SuspiciousTypeException */
    public function __construct(private string $type){
        $this->ensureIsAvailableType();
    }

    public function value() : string
    {
        return $this->type;
    }

    /** * @throws SuspiciousTypeException */
    private function ensureIsAvailableType()
    {
        if(!in_array($this->type, self::SUSPICIOUS_TYPE_AVAILABLE))
            throw new SuspiciousTypeException();
    }
}
