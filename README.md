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

## SDE Code Exercise: Shipment Destination Assignment

### Problem Description
Our sales team has secured a deal with Acme Inc. to become their exclusive provider for routing product shipments via 3rd party trucking fleets. However, we can only route one shipment to one driver per day. Our data scientists have developed a mathematical model to determine the best drivers for each shipment, based on the suitability score.

### Algorithm
The algorithm for calculating the suitability score (SS) is as follows:
- If the length of the shipment's destination street name is even, the base SS is the number of vowels in the driver's name multiplied by 1.5.
- If the length of the shipment's destination street name is odd, the base SS is the number of consonants in the driver's name multiplied by 1.
- If the length of the shipment's destination street name shares any common factors (besides 1) with the length of the driver's name, the SS is increased by 50% above the base SS.

### Task
Write an application that assigns shipment destinations to drivers, maximizing the total suitability score over all drivers. The application should take two newline-separated files as input: one containing the street addresses of the shipment destinations and the other containing the names of the drivers. The output should be the total suitability score and the matching between shipment destinations and drivers.

### Requirements
- The application should be implemented in the language of your choice.
- You may make use of any existing open-source libraries.
- Handle both upper and lower case names.
- The application should run on the command line.

### Deliverables
Please provide the following deliverables using a public GitHub (or similar) repository:

1. Full source code, including any additional code not part of the normal program run (e.g., build scripts).
2. Clear instructions on how to build and run the application.

### Evaluation
Your solution will be evaluated based on the following criteria:

- Code craftsmanship.
- Problem-solving approach and explanation.
- Code organization and readability.
- Quality of instructions.


