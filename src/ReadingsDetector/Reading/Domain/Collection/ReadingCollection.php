<?php

namespace Src\ReadingsDetector\Reading\Domain\Collection;

use Doctrine\Common\Collections\ArrayCollection;
use Src\ReadingsDetector\Reading\Domain\Entity\Reading;

final class ReadingCollection extends ArrayCollection
{
    public function addReading(Reading $reading): void
    {
        parent::add($reading);
    }
}
