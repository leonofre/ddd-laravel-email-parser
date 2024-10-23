# Email Processing System

**Email Processing System** is an application developed in Laravel using Domain-Driven Design (DDD) principles to manage the processing and storage of successful email records. The system allows for the creation, retrieval, updating, and deletion of email records, ensuring data integrity and efficient information handling.

## Key Features:
- Registration of emails with data validation.
- Complete CRUD functionality for managing successful emails.
- Modular structure following DDD principles for easy maintenance and scalability.
- Secure user authentication with token support.

## Technologies Used:
- PHP 8.3
- Laravel
- MySQL
- Docker for containerization


## Running the application:
### First Usage

#### Using Make
1. Build containers
 - run `make build`
2. Start containers
 - Seeing logs: run `make up`
 - Hide logs: run `make up_hide`

#### Not using Make
1. Build containers
 - run `docker-compose build`
2. Start containers
 - Seeing logs: run `docker-compose up --remove-orphans`
 - Hide logs: run `docker-compose up -d --remove-orphans`

### Daily Usage

#### Using Make
1. Stop Container
 - run `make down`
2. Access main container
 - run `make open_container`

#### Not using Make
1. Stop Container
 - run `docker-compose down`
2. Access main container
 - run `docker exec -it laravel_project bash`

Contributions are welcome!
