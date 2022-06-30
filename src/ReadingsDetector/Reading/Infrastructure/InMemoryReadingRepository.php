<?php
namespace Src\ReadingsDetector\Reading\Infrastructure;

use Src\ReadingsDetector\Reading\Domain\Collection\ReadingCollection;
use Src\ReadingsDetector\Reading\Domain\Contract\ReadingRepositoryInterface;
use Src\ReadingsDetector\Reading\Domain\Entity\Reading;
use Src\ReadingsDetector\Reading\Domain\ValueObject\ReadingCount;
use Src\ReadingsDetector\Reading\Domain\ValueObject\ReadingPeriod;
use Src\ReadingsDetector\Shared\Domain\ValueObject\ClientId;

class InMemoryReadingRepository implements ReadingRepositoryInterface
{

    public function __construct(){ }

    public function getAll() : ReadingCollection
    {
        $collection = new ReadingCollection();

        foreach($this->values() as $readingArray)
        {
            $collection->addReading(
                new Reading(
                    new ClientId($readingArray['client']),
                    new ReadingPeriod($readingArray['period']),
                    new ReadingCount($readingArray['reading'])
                )
            );
        }

        return $collection;
    }

    private function values(): array
    {
       return [
            0 => [
                'client' => '583ef6329d7b9',
                'period' => '2016-01',
                'reading' => '42451',
            ],
            1 => [
                'client' => '583ef6329d7b9',
                'period' => '2016-02',
                'reading' => '44279',
            ],
            2 => [
                'client' => '583ef6329d7b9',
                'period' => '2016-03',
                'reading' => '44055',
            ],
            3 => [
                'client' => '583ef6329d7b9',
                'period' => '2016-04',
                'reading' => '40953',
            ],
            4 => [
                'client' => '583ef6329d7b9',
                'period' => '2016-05',
                'reading' => '42566',
            ],
            5 => [
                'client' => '583ef6329d7b9',
                'period' => '2016-06',
                'reading' => '41216',
            ],
            6 => [
                'client' => '583ef6329d7b9',
                'period' => '2016-07',
                'reading' => '43597',
            ],
            7 => [
                'client' => '583ef6329d7b9',
                'period' => '2016-08',
                'reading' => '43324',
            ],
            8 => [
                'client' => '583ef6329d7b9',
                'period' => '2016-09',
                'reading' => '3564',
            ],
            9 => [
                'client' => '583ef6329d7b9',
                'period' => '2016-10',
                'reading' => '44459',
            ],
            10 => [
                'client' => '583ef6329d7b9',
                'period' => '2016-11',
                'reading' => '42997',
            ],
            11 => [
                'client' => '583ef6329d7b9',
                'period' => '2016-12',
                'reading' => '42600',
            ],
            12 => [
                'client' => '583ef6329d81f',
                'period' => '2016-01',
                'reading' => '39760',
            ],
            13 => [
                'client' => '583ef6329d81f',
                'period' => '2016-02',
                'reading' => '38785',
            ],
            14 => [
                'client' => '583ef6329d81f',
                'period' => '2016-03',
                'reading' => '37519',
            ],
            15 => [
                'client' => '583ef6329d81f',
                'period' => '2016-04',
                'reading' => '39028',
            ],
            16 => [
                'client' => '583ef6329d81f',
                'period' => '2016-05',
                'reading' => '39469',
            ],
            17 => [
                'client' => '583ef6329d81f',
                'period' => '2016-06',
                'reading' => '37463',
            ],
            18 => [
                'client' => '583ef6329d81f',
                'period' => '2016-07',
                'reading' => '37152',
            ],
            19 => [
                'client' => '583ef6329d81f',
                'period' => '2016-08',
                'reading' => '37756',
            ],
            20 => [
                'client' => '583ef6329d81f',
                'period' => '2016-09',
                'reading' => '37398',
            ],
            21 => [
                'client' => '583ef6329d81f',
                'period' => '2016-10',
                'reading' => '37770',
            ],
            22 => [
                'client' => '583ef6329d81f',
                'period' => '2016-11',
                'reading' => '38948',
            ],
            23 => [
                'client' => '583ef6329d81f',
                'period' => '2016-12',
                'reading' => '37342',
            ],
            24 => [
                'client' => '583ef6329d85d',
                'period' => '2016-01',
                'reading' => '35181',
            ],
            25 => [
                'client' => '583ef6329d85d',
                'period' => '2016-02',
                'reading' => '36095',
            ],
            26 => [
                'client' => '583ef6329d85d',
                'period' => '2016-03',
                'reading' => '34258',
            ],
            27 => [
                'client' => '583ef6329d85d',
                'period' => '2016-04',
                'reading' => '35233',
            ],
            28 => [
                'client' => '583ef6329d85d',
                'period' => '2016-05',
                'reading' => '34573',
            ],
            29 => [
                'client' => '583ef6329d85d',
                'period' => '2016-06',
                'reading' => '35527',
            ],
            30 => [
                'client' => '583ef6329d85d',
                'period' => '2016-07',
                'reading' => '34428',
            ],
            31 => [
                'client' => '583ef6329d85d',
                'period' => '2016-08',
                'reading' => '37182',
            ],
            32 => [
                'client' => '583ef6329d85d',
                'period' => '2016-09',
                'reading' => '35544',
            ],
            33 => [
                'client' => '583ef6329d85d',
                'period' => '2016-10',
                'reading' => '35793',
            ],
            34 => [
                'client' => '583ef6329d85d',
                'period' => '2016-11',
                'reading' => '37420',
            ],
            35 => [
                'client' => '583ef6329d85d',
                'period' => '2016-12',
                'reading' => '37771',
            ],
            36 => [
                'client' => '583ef6329d89b',
                'period' => '2016-01',
                'reading' => '59700',
            ],
            37 => [
                'client' => '583ef6329d89b',
                'period' => '2016-02',
                'reading' => '61524',
            ],
            38 => [
                'client' => '583ef6329d89b',
                'period' => '2016-03',
                'reading' => '59532',
            ],
            39 => [
                'client' => '583ef6329d89b',
                'period' => '2016-04',
                'reading' => '62011',
            ],
            40 => [
                'client' => '583ef6329d89b',
                'period' => '2016-05',
                'reading' => '58325',
            ],
            41 => [
                'client' => '583ef6329d89b',
                'period' => '2016-06',
                'reading' => '58386',
            ],
            42 => [
                'client' => '583ef6329d89b',
                'period' => '2016-07',
                'reading' => '59355',
            ],
            43 => [
                'client' => '583ef6329d89b',
                'period' => '2016-08',
                'reading' => '59681',
            ],
            44 => [
                'client' => '583ef6329d89b',
                'period' => '2016-09',
                'reading' => '162078',
            ],
            45 => [
                'client' => '583ef6329d89b',
                'period' => '2016-10',
                'reading' => '7759',
            ],
            46 => [
                'client' => '583ef6329d89b',
                'period' => '2016-11',
                'reading' => '60952',
            ],
            47 => [
                'client' => '583ef6329d89b',
                'period' => '2016-12',
                'reading' => '56894',
            ],
            48 => [
                'client' => '583ef6329d8d9',
                'period' => '2016-01',
                'reading' => '40095',
            ],
            49 => [
                'client' => '583ef6329d8d9',
                'period' => '2016-02',
                'reading' => '37849',
            ],
            50 => [
                'client' => '583ef6329d8d9',
                'period' => '2016-03',
                'reading' => '36841',
            ],
            51 => [
                'client' => '583ef6329d8d9',
                'period' => '2016-04',
                'reading' => '36940',
            ],
            52 => [
                'client' => '583ef6329d8d9',
                'period' => '2016-05',
                'reading' => '39392',
            ],
            53 => [
                'client' => '583ef6329d8d9',
                'period' => '2016-06',
                'reading' => '37873',
            ],
            54 => [
                'client' => '583ef6329d8d9',
                'period' => '2016-07',
                'reading' => '38951',
            ],
            55 => [
                'client' => '583ef6329d8d9',
                'period' => '2016-08',
                'reading' => '39436',
            ],
            56 => [
                'client' => '583ef6329d8d9',
                'period' => '2016-09',
                'reading' => '38961',
            ],
            57 => [
                'client' => '583ef6329d8d9',
                'period' => '2016-10',
                'reading' => '39332',
            ],
            58 => [
                'client' => '583ef6329d8d9',
                'period' => '2016-11',
                'reading' => '36984',
            ],
            59 => [
                'client' => '583ef6329d8d9',
                'period' => '2016-12',
                'reading' => '39187',
            ],
            60 => [
                'client' => '583ef6329d916',
                'period' => '2016-01',
                'reading' => '41080',
            ],
            61 => [
                'client' => '583ef6329d916',
                'period' => '2016-02',
                'reading' => '39599',
            ],
            62 => [
                'client' => '583ef6329d916',
                'period' => '2016-03',
                'reading' => '40886',
            ],
            63 => [
                'client' => '583ef6329d916',
                'period' => '2016-04',
                'reading' => '41026',
            ],
            64 => [
                'client' => '583ef6329d916',
                'period' => '2016-05',
                'reading' => '39568',
            ],
            65 => [
                'client' => '583ef6329d916',
                'period' => '2016-06',
                'reading' => '42946',
            ],
            66 => [
                'client' => '583ef6329d916',
                'period' => '2016-07',
                'reading' => '40223',
            ],
            67 => [
                'client' => '583ef6329d916',
                'period' => '2016-08',
                'reading' => '41512',
            ],
            68 => [
                'client' => '583ef6329d916',
                'period' => '2016-09',
                'reading' => '2479',
            ],
            69 => [
                'client' => '583ef6329d916',
                'period' => '2016-10',
                'reading' => '41334',
            ],
            70 => [
                'client' => '583ef6329d916',
                'period' => '2016-11',
                'reading' => '42664',
            ],
            71 => [
                'client' => '583ef6329d916',
                'period' => '2016-12',
                'reading' => '40179',
            ],
            72 => [
                'client' => '583ef6329d954',
                'period' => '2016-01',
                'reading' => '21510',
            ],
            73 => [
                'client' => '583ef6329d954',
                'period' => '2016-02',
                'reading' => '20825',
            ],
            74 => [
                'client' => '583ef6329d954',
                'period' => '2016-03',
                'reading' => '21479',
            ],
            75 => [
                'client' => '583ef6329d954',
                'period' => '2016-04',
                'reading' => '21573',
            ],
            76 => [
                'client' => '583ef6329d954',
                'period' => '2016-05',
                'reading' => '21798',
            ],
            77 => [
                'client' => '583ef6329d954',
                'period' => '2016-06',
                'reading' => '21280',
            ],
            78 => [
                'client' => '583ef6329d954',
                'period' => '2016-07',
                'reading' => '20150',
            ],
            79 => [
                'client' => '583ef6329d954',
                'period' => '2016-08',
                'reading' => '21926',
            ],
            80 => [
                'client' => '583ef6329d954',
                'period' => '2016-09',
                'reading' => '21462',
            ],
            81 => [
                'client' => '583ef6329d954',
                'period' => '2016-10',
                'reading' => '21668',
            ],
            82 => [
                'client' => '583ef6329d954',
                'period' => '2016-11',
                'reading' => '20516',
            ],
            83 => [
                'client' => '583ef6329d954',
                'period' => '2016-12',
                'reading' => '20639',
            ],
            84 => [
                'client' => '583ef6329d990',
                'period' => '2016-01',
                'reading' => '43968',
            ],
            85 => [
                'client' => '583ef6329d990',
                'period' => '2016-02',
                'reading' => '40389',
            ],
            86 => [
                'client' => '583ef6329d990',
                'period' => '2016-03',
                'reading' => '42994',
            ],
            87 => [
                'client' => '583ef6329d990',
                'period' => '2016-04',
                'reading' => '42569',
            ],
            88 => [
                'client' => '583ef6329d990',
                'period' => '2016-05',
                'reading' => '42635',
            ],
            89 => [
                'client' => '583ef6329d990',
                'period' => '2016-06',
                'reading' => '40736',
            ],
            90 => [
                'client' => '583ef6329d990',
                'period' => '2016-07',
                'reading' => '43023',
            ],
            91 => [
                'client' => '583ef6329d990',
                'period' => '2016-08',
                'reading' => '44412',
            ],
            92 => [
                'client' => '583ef6329d990',
                'period' => '2016-09',
                'reading' => '42656',
            ],
            93 => [
                'client' => '583ef6329d990',
                'period' => '2016-10',
                'reading' => '43445',
            ],
            94 => [
                'client' => '583ef6329d990',
                'period' => '2016-11',
                'reading' => '44071',
            ],
            95 => [
                'client' => '583ef6329d990',
                'period' => '2016-12',
                'reading' => '43752',
            ],
            96 => [
                'client' => '583ef6329d9cd',
                'period' => '2016-01',
                'reading' => '34099',
            ],
            97 => [
                'client' => '583ef6329d9cd',
                'period' => '2016-02',
                'reading' => '32920',
            ],
            98 => [
                'client' => '583ef6329d9cd',
                'period' => '2016-03',
                'reading' => '32325',
            ],
            99 => [
                'client' => '583ef6329d9cd',
                'period' => '2016-04',
                'reading' => '34928',
            ],
            100 => [
                'client' => '583ef6329d9cd',
                'period' => '2016-05',
                'reading' => '33003',
            ],
            101 => [
                'client' => '583ef6329d9cd',
                'period' => '2016-06',
                'reading' => '34826',
            ],
            102 => [
                'client' => '583ef6329d9cd',
                'period' => '2016-07',
                'reading' => '33001',
            ],
            103 => [
                'client' => '583ef6329d9cd',
                'period' => '2016-08',
                'reading' => '32115',
            ],
            104 => [
                'client' => '583ef6329d9cd',
                'period' => '2016-09',
                'reading' => '34088',
            ],
            105 => [
                'client' => '583ef6329d9cd',
                'period' => '2016-10',
                'reading' => '32621',
            ],
            106 => [
                'client' => '583ef6329d9cd',
                'period' => '2016-11',
                'reading' => '34249',
            ],
            107 => [
                'client' => '583ef6329d9cd',
                'period' => '2016-12',
                'reading' => '34426',
            ],
            108 => [
                'client' => '583ef6329da0b',
                'period' => '2016-01',
                'reading' => '28798',
            ],
            109 => [
                'client' => '583ef6329da0b',
                'period' => '2016-02',
                'reading' => '29233',
            ],
            110 => [
                'client' => '583ef6329da0b',
                'period' => '2016-03',
                'reading' => '28823',
            ],
            111 => [
                'client' => '583ef6329da0b',
                'period' => '2016-04',
                'reading' => '29762',
            ],
            112 => [
                'client' => '583ef6329da0b',
                'period' => '2016-05',
                'reading' => '27959',
            ],
            113 => [
                'client' => '583ef6329da0b',
                'period' => '2016-06',
                'reading' => '28496',
            ],
            114 => [
                'client' => '583ef6329da0b',
                'period' => '2016-07',
                'reading' => '29880',
            ],
            115 => [
                'client' => '583ef6329da0b',
                'period' => '2016-08',
                'reading' => '29852',
            ],
            116 => [
                'client' => '583ef6329da0b',
                'period' => '2016-09',
                'reading' => '30100',
            ],
            117 => [
                'client' => '583ef6329da0b',
                'period' => '2016-10',
                'reading' => '28645',
            ],
            118 => [
                'client' => '583ef6329da0b',
                'period' => '2016-11',
                'reading' => '30207',
            ],
            119 => [
                'client' => '583ef6329da0b',
                'period' => '2016-12',
                'reading' => '29129',
            ]
        ];
    }
}
