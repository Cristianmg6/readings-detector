# Suspicious Readings Detector
At Holaluz we are worried about fraud in electricity readings and we have decided to implement a suspicious reading detector.

In this APP, we have a command that, given a file name, lists a table of suspicious readings like this:

| Client         | Month        | Suspicious     | Median      |
|----------------|--------------|----------------|-------------|
| \<clientid>    | \<month>     | \<reading>     | \<median>   |         


## Project set up

```
composer install 
```


## How it works

```
composer detector {nameFile} 
```
Available Name Files:
* 2016-readings.xml
* 2016-readings.csv


## Run tests

```
composer test
composer test-cov
```


## Development explanation

Using the Laravel framework we have created a Console command that receives as a single argument the name of a file.\
The command is responsible for instantiating the Application Service (use case) and, given the corresponding results, listing them in a command line table.

The development code is located in the src directory under Hexagonal Architecture, distributed in its corresponding layers (Infrastructure, Application, Domain).\
It has been developed according to the following principles:
* Clean Code
* SOLID principles
* Decoupling
* Error handling
* Unit Testing
* Hexagonal Architecture

### Application layer
* Get Suspicious Readings application service\
It is responsible for traversing the existing readings in the repository and detecting suspicious ones.\
It returns SuspiciousReadingsResponse, consisting of a list of suspicious readings and the annual median of that client.

### Domain layer
The domain layer is distributed in:
* Collection
* Contract
* Entity
* Exception
* ValueObject

### Infrastructure layer
There is a single implementation of the repository interface, FileReadingRepository.\
It is responsible for, given the directory of a file, reading it, transforming it into a domain entity and returning it in a collection.\
It is also helped by a FileManager that validates the existence of the file, the file extension and its subsequent conversion to an array.


### Testing
* There is a large testing suite, covering the src path of the application.
* Tests are following the same architecture as the base code, helping to understand it better.
* Generic and domain stubs (Entity and ValueObject) are implemented.
* Example files (path: storage/tests/data) are used in the single repository implementation covering the handle of all possible errors.
