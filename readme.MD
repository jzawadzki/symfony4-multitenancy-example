# Multitenancy example

This repository is PoC of simple multitenancy model based on Symfony 4 and Doctrine.
There are 2 entities available:
- **App\Entity\Organization** - tenant model
- **App\Entity\Note** - tenant-specific notes

Organization is distinguished by subdomain and, by design, while being on subdomain of one organization we should see notes only added by them. 

## Prerequisities
- php 7
- composer

## Installation
```
composer install &&
php bin/console doctrine:database:create &&
php bin/console doctrine:migration:migrate
```

## Start / stop server
```bash
#start
php bin/console server:start

#stop
php bin/console server:stop
```

## Examples

Fixtures are configured to create 2 organizations: `test1` and `test2` by default.
Each organization is filled with 2 notes at start.

You can view them on `http://test.localhost:8000/notes` and `http://test2.localhost:8000/notes` respectively.

You can also add notes to each organization by sending PUT request
 
```bash
curl -X PUT -d message="Test note" http://test1.localhost:8000/notes   
```