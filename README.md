# Shipment Destinations

This project assigns shipment destinations to drivers, maximizing the total suitability score (SS) based on specific criteria. It is a command-line application written in PHP.

## Prerequisites

- Docker: [Install Docker](https://docs.docker.com/get-docker/)
- Docker Compose: [Install Docker Compose](https://docs.docker.com/compose/install/)

## Getting Started

Follow the instructions below to set up and run the project:

### 1. Clone the repository

```bash
git clone https://github.com/dlrdelarocha/shipment-destinations
```

### 2. Navigate to the project directory

```bash
cd shipment-destinations
```

### 3. **Build the Docker container**

```bash
   docker-compose build
```

When building Docker, Composer dependencies should be installed. If, for some reason, they are not installed,
after completing this guide execute: 
```bash
   docker-compose run --rm app composer install 
```

## Running the Project

### 1. Start the Docker container

```bash
   docker-compose up -d
```
This command will start the Docker container in detached mode.

### 2. Execute the project
```bash
   docker-compose exec app php main.php  assign:shipments
```
This command will execute the project. The output will be displayed in the console, including the total suitability score and the assignments of destinations to drivers.

Make sure to place the input files (destinations.file and drivers.file) in the project directory before running it.

## Response Example 

```json
{
  "total_ss": 42,
  "assignments": {
    "456 Elm St,Los Angeles, CA": {
      "driver_name": "David Wilson",
      "best_ss": 9
    },
    "321 Maple Ave, Houston, TX": {
      "driver_name": "David Wilson",
      "best_ss": 9
    },
    "123 Main St,New York,NY": {
      "driver_name": "Sarah Johnson",
      "best_ss": 8
    },
    "789 Oak St, Chicago, IL": {
      "driver_name": "Sarah Johnson",
      "best_ss": 8
    },
    "654 Pine St, Philadelphia, PA": {
      "driver_name": "Sarah Johnson",
      "best_ss": 8
    }
  }
}

```

## License

This project is licensed under the MIT License.