<?php

namespace App\Commands;

use App\Controllers\AssignShipmentDestination;
use App\Models\Driver;
use App\Models\ShipmentDestination;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Helper\TableCell;
use Symfony\Component\Console\Helper\TableSeparator;

class AssignShipmentsCommand extends Command
{
    protected function configure(): void
    {
        $this->setName('assign:shipments')
            ->setDescription('Assign shipment destinations to drivers maximizing total SS');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $shipmentsFile = $this->askForFile($input, $output, 'Enter the file path for shipment destinations: ');

        /**
         * @todo Create a class to manage files
         */
        if (empty($shipmentsFile) || !$this->fileExists($shipmentsFile)) {
            $output->writeln('The specified shipments file does not exist.');
            return Command::FAILURE;
        }

        $shipmentsDestinations = $this->readLinesFromFile($shipmentsFile);

        $driversFile = $this->askForFile($input, $output, 'Enter the file path for drivers: ');

        if (empty($driversFile) || !$this->fileExists($driversFile)) {
            $output->writeln('The specified shipments file does not exist.');
            return Command::FAILURE;
        }

        $drivers = $this->readLinesFromFile($driversFile);

        /**
         * @todo Validate file Input
         * Check if there are duplicated names or addresses
         */

        $destinations = new ShipmentDestination($shipmentsDestinations);

        $drivers = new Driver($drivers);

        $assign = new AssignShipmentDestination($destinations, $drivers);

        $assignedShipments = $assign->run();

        $table = new Table($output);
        $table
            ->setHeaders(['Driver Name', 'Shipment Address', 'Suitability Score'])
            ->setRows($assignedShipments['assignments'])
            ->addRow(new TableSeparator())
            ->addRow([new TableCell("Total Suitability Score: {$assignedShipments['total_suitability_score']}", ['colspan' => 3])]);

        $table->render();

        return Command::SUCCESS;
    }

    /**
     * @todo move this logic to a different class FileReader
     */
    function readLinesFromFile($filename): array
    {
        $lines = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        $records = [];

        foreach ($lines as $line) {
            $record = str_getcsv($line);

            // Delete white spaces
            $record = array_map('trim', $record);

            $records = array_merge($records, $record);
        }

        return $records;
    }

    private function fileExists(string $filename): bool
    {
        return file_exists($filename) && is_file($filename);
    }

    private function askForFile(InputInterface $input, OutputInterface $output, string $message): string|null
    {
        $helper = $this->getHelper('question');
        $question = new Question($message);

        return $helper->ask($input, $output, $question);
    }
}
