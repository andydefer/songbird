<?php

namespace AndyDefer\Songbird\Contracts;

interface CommandInterface
{
    public function getName(): string;
    public function getDescription(): string;
    public function getUsage(): string;
    public function execute(array $args): void;
}
