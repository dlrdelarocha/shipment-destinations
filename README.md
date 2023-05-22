# Shipment Destinations

This project assigns shipment destinations to drivers, maximizing the total suitability score (SS) based on specific criteria. It is a command-line application written in PHP.

## Prerequisites

- Docker: [Install Docker](https://docs.docker.com/get-docker/)
- Docker Compose: [Install Docker Compose](https://docs.docker.com/compose/install/)

## Getting Started

Follow the instructions below to set up and run the project:

### Clone the repository

```bash
git clone https://github.com/dlrdelarocha/shipment-destinations
```

### Navigate to the project directory

```bash
cd shipment-destinations
```

### **Build the Docker container**

```bash
docker-compose build
```

## Running the Project

### Start the Docker container

```bash
docker-compose up -d
```
This command will start the Docker container in detached mode.

### Install composer dependencies

```bash
docker-compose run --rm app composer install 
```

### Execute the project
```bash
docker-compose exec app php main.php  assign:shipments
```
This command will execute the project. The output will be displayed in the console, including the total suitability score and the assignments of destinations to drivers.

Make sure to place the input files (destinations.file and drivers.file) in the project directory before running it.

## Response Example
### Input Example
```bash
 Enter the file path for shipment destinations: destinations.file
 Enter the file path for drivers: drivers.file
```

```bash
+---------------+-------------------------------+-------------------+
| Driver Name   | Shipment Address              | Suitability Score |
+---------------+-------------------------------+-------------------+
| David Wilson  | 456 Elm St,Los Angeles, CA    | 9                 |
| Sarah Johnson | 123 Main St,New York,NY       | 8                 |
| Michael Brown | 789 Oak St, Chicago, IL       | 8                 |
| John Smith    | 654 Pine St, Philadelphia, PA | 7                 |
| Emily Davis   | 321 Maple Ave, Houston, TX    | 6                 |
+---------------+-------------------------------+-------------------+
| Total Suitability Score: 38                                       |
+---------------+-------------------------------+-------------------+
```

## License

This project is licensed under the MIT License.