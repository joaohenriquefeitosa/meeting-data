# Ticket to manage info from the sales meeting potential clients


## Basic idea for Execution Flow


### 1. System Initialization
    
    Run the system once a day, ideally during a low activity time, such as 5 AM, to prepare the emails to be sent at 8 AM.


### 2. Event Retrieval and Filtering:

    Retrieve all events from the next 24 hours from the sales representatives' calendars, using filters to pull only the events that were created or modified since the last run.


### 3. Data Enrichment:

    3.1 Retrieve Participant Information (Check first in the database; if not there, call the API).

    For each event, use the participant's email address to retrieve detailed information about them through the data enrichment API.


    3.2 Store Participant Information
    Store participant data in the database to be used for 30 days.


### 4. Data Processing and Email Assembly

    4.1 Email Information Process

    Process and structure the JSON that will be used to render the HTML email template during the triggering email process.

    4.2 Email Queued

    Add the rendered email to the email queue, with a timestamp indicating when the email should be sent.

### 5. Email Sending

    5.1 Starting to process the queue and sending emails at 7:50 AM.

    5.2 Handle sending failures with retry attempts as needed.

### 6. Cleaning Old Participant Information

    Start a job to retrieve participant information that is 30 days old or older and remove it.


## Technologies choosed for this Task

### 1. Reasons for Constructing this Task as a Microservice

#### Independent Scalability  
```
Microservices allow for scaling specific parts of the system independently.
```

#### Service Isolation
```
This service can be developed, tested, deployed, and updated independently of other systems.
```

#### Fault Tolerance
```
In a microservices architecture, if one component fails, it does not disrupt the entire system.
```

#### Shorter Development Cycles
```
Microservices enable faster development and deployment cycles, facilitating the implementation of new features or changes.
```

#### Division by Functional Domain
```
Microservices are typically organized around business capabilities.
```

#### Data Isolation
```
Microservices can help ensure that sensitive data is handled and stored according to specific security policies.
```

### 2. Stack


* Laravel
    * Rapid Development Framework
    * Rich Ecosystem and Integration
    * Robust Security
    * MVC Architecture

* MariaDB

    * MySQL Compatibility
    * Performance Improvements
    * Open Source and Active Community

* Redis

    * In-Memory Data Storage
    * Advanced Data Structures
    * Persistence and Durability

* Docker
    * Container that facilitates deployment
    * Consistency across development, testing, and production environments

* Sentry
    * Real-Time Error Tracking
    * Detailed Error Reports    
    * Issue Management

* Supervisor
    * Manage redis queues
    * Reliability
    * Manageability

## Subtasks to achive this Final Task

### 1. Infrastrucural Tasks

#### 1.1 Dockerize the application
    Create a DockerFile and docker-compose.yml for this project and ensure to install all dependencies (PHP, PHP Libraries, Supervisor and others);

    Configure the supervisor for the laravel-worker.conf;

    The docker-compose.yml should have each service:

        - Application Service (for Laravel);
        - Database Service (MariaDB);
        - Cache Service (Redis);
        - Networking;

#### 1.2 Versioning the project
    Create a github repository for this project;

    Initializer the git into this project;

    Create a README file for this project;

#### 1.3 Configure Sentry for This Project
    Create an account with Sentry.

    Install the Sentry package using Composer.

    Complete the configuration to integrate Sentry into the project.


### 2. Create the models and migrations
    Refer to the database documentation below to create the Models and Migrations.

    Note: All changes to the database SHOULD be made using Migrations.

    Migrate them and check the changes directly into database;


### 3. Create the Command to Retrieve Data from Calendar API

#### 3.1. Retrieve Data from Calendar API
    Retrieve all events from the next 24 hours from the sales representatives' calendars.

#### 3.2. Data Enrichment 
    For each Participant (Potential Client), we need to retrive the information.

    First check into the database if we already have this information, if yes, return that. 
    If not, call the Person data API using the participant's email.

    Store this participant information into database;

    Focus here into error handling and loggin properly those errors.

### 4. Create the Command to Clean Participants Older Data

    Check from database which participants are equal or older than 30 days and remove them.

    Focus here into error handling and loggin properly those errors.

### 5. Configure the Task Scheduler
    Configure the Crontab into Operation System.

    Define Scheduled Tasks into Laravel's Kernel for those two commands above.


## Database Structure

TABLE: sales_personel

    id (primary_key, unsigned big integer)
    name (string)
    email (string)
    access_token (string)
    refresh_token (string)
    expires (big integer)
    created_at (timestamps)
    updated_at (timestamps)

TABLE: companies

    id (primary_key, unsigned big integer)
    name (string)
    linkedin_url (string)
    employees (integer)
    created_at (timestamps)
    updated_at (timestamps)

TABLE: participants

    id (primary_key, unsigned big integer)
    first_name (string)
    last_name (string)
    avatar (string)
    title (string)
    linkedin_url (string)
    company_id (foreing_key, unsigned big integer)
    created_at (timestamps)
    updated_at (timestamps)