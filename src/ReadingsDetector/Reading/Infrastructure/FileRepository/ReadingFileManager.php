<?php

namespace Src\ReadingsDetector\Reading\Infrastructure\FileRepository;

use League\Csv\Exception as CsvException;
use League\Csv\Reader as CSVReader;
use Sabre\Xml\LibXMLException;
use Sabre\Xml\Reader as XMLReader;
use Src\ReadingsDetector\Reading\Domain\Exception\FileException;

final class ReadingFileManager
{

    private const AVAILABLE_FILE_EXTENSIONS = ['csv', 'xml'];

    public function __construct(private string $filePath){ }

    /** * @throws FileException */
    public function fromFileToArray() : array
    {
        $this->validateFileExists();
        $fileExtension = $this->getExtensionByFilePath();
        try{
            return match ($fileExtension) {
                'csv' => $this->fromCsvFileToArray(),
                'xml' => $this->fromXmlFileToArray()
            };
        }catch(CsvException | LibXMLException $e){
            throw FileException::fromExternalError($this->filePath, $e->getMessage());
        }
    }

    /** * @throws CsvException
     * @throws FileException
     */
    private function fromCsvFileToArray() : array
    {
        $reader = CSVReader::createFromPath($this->filePath, 'r');
        $reader->setHeaderOffset(0);
        $resultArray = iterator_to_array($reader, true);
        if(empty($resultArray)) throw FileException::failedToArrayConversion($this->filePath);
        return $resultArray;
    }

    /** * @throws LibXMLException
     * @throws FileException
     */
    private function fromXmlFileToArray() : array
    {
        $resultArray = [];
        $xml    = file_get_contents($this->filePath);
        $reader = new XMLReader();
        $reader->xml($xml);
        $xmlArray = $reader->parse();
        foreach($xmlArray['value'] as $xmlItem){
            $resultArray[] = [
                'client'  => $xmlItem['attributes']['clientID'],
                'period'  => $xmlItem['attributes']['period'],
                'reading' => $xmlItem['value']
            ];
        }
        if(empty($resultArray)) throw FileException::failedToArrayConversion($this->filePath);
        return $resultArray;
    }

    /** * @throws FileException */
    private function validateFileExists() : void
    {
        if(!file_exists($this->filePath))
            throw FileException::fromFileNotExists($this->filePath);
    }

    /** * @throws FileException */
    private function getExtensionByFilePath() : string
    {
        $pathInfo      = pathinfo($this->filePath);
        $fileExtension = $pathInfo['extension'];
        $this->validateIsAvailableExtension($fileExtension);
        return $fileExtension;
    }

    /** * @throws FileException */
    private function validateIsAvailableExtension(string $fileExtension) : void
    {
        if(!in_array($fileExtension, self::AVAILABLE_FILE_EXTENSIONS))
            throw FileException::fromNotAvailableExtension($this->filePath, $fileExtension, self::AVAILABLE_FILE_EXTENSIONS);
    }

}
