<?php

namespace AndyDefer\Songbird\Commands;

use AndyDefer\Songbird\Contracts\CommandInterface;

abstract class Command implements CommandInterface
{
    protected string $name;
    protected string $description;
    protected string $usage;

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getUsage(): string
    {
        return $this->usage;
    }

    protected function validateArguments(array $args, int $requiredCount): void
    {
        if (count($args) < $requiredCount) {
            echo "Erreur: Nombre d'arguments insuffisant.\n";
            echo "Usage: {$this->getUsage()}\n";
            exit(1);
        }
    }
}
