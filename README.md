#Technical assessment for Deputy
This is a minimal command line application developed according to the provided requirements.

### Installation/Prerequisites

You need a [Docker](https://www.docker.com/) with [docker-compose](https://docs.docker.com/compose/) to run it. (Docker-compose is already included into the recent versions of Docker Desktop)

### Running
To run the tests execute `docker-compose run cli vendor/bin/phpunit` The tests run automatically on container build to ensure the app correctness.

To run the application with a given user ID execute, `docker-compose run cli php hierarchy.php <USER_ID>` for example 
`docker-compose run cli php hierarchy.php 3`

### Notes

Data structures to contain the user hierarchy and to calculate roles subtrees are based on PHP associative arrays.
This approach helps to avoid over-engineering and provides average access time O(1). (It's known that for exceptionally huge arrays this can degrade to O(n) in the worst case)

All exceptions are just `\Exception`, because:
1. From the domain perspective they can be considered as invalid data exceptions (SPL `\InvalidArgumentException` can be used)
2. Defining an exception hierarchy is out of scope of this exercise

No classes introduced for roles and users as their introduction does not benefit in this exercise, but increases complexity. In a real life application we typically have more factors to decide on if a special class needed for a data object.

The validation part has not been explicitly requested, but ensures author's good sleep at night.