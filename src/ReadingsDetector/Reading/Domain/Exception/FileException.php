<?php

namespace Src\ReadingsDetector\Reading\Domain\Exception;

use Exception;

final class FileException extends Exception
{

    public static function fromFileNotExists(string $filePath) : FileException
    {
        return new self(sprintf('File with path %s not exists.', $filePath));
    }

    public static function fromNotAvailableExtension(string $filePath, string $fileExtension,
        array $availableExtensions) : FileException
    {
        $stringAvailableExtensions = implode(',', $availableExtensions);
        return new self(
            sprintf(
                'File with path \'%s\' has not available extension \'%s\'.' .
                ' Available extensions: [%s]', $filePath, $fileExtension, $stringAvailableExtensions
            )
        );
    }

    public static function fromExternalError(string $filePath, string $details)  : FileException
    {
        return new self(
            sprintf('Error opening file %s', $filePath).
            ' Details: '.$details
        );
    }

    public static function failedToArrayConversion(string $filePath) : FileException
    {
        return new self(sprintf('File to array conversion failed, check \'%s\' file format.', $filePath));
    }
}
