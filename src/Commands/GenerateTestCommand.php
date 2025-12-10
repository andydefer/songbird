<?php

namespace AndyDefer\Songbird\Commands;

class GenerateTestCommand extends Command
{
    public function __construct()
    {
        $this->name = 'make:test';
        $this->description = 'Génère un fichier de test PHPUnit';
        $this->usage = 'artifact make:test <chemin/TestName>';
    }

    public function execute(array $args): void
    {
        $this->validateArguments($args, 1);
        $testPath = $args[0];

        // Extraire le nom de la classe à partir du chemin
        $pathParts = explode('/', $testPath);
        $className = end($pathParts);

        // Retirer l'extension .php si présente
        $className = str_replace('.php', '', $className);

        // Extraire le namespace à partir du chemin
        $namespaceParts = explode('/', $testPath);
        array_pop($namespaceParts); // Retirer le nom de la classe

        // Construire le namespace complet
        $baseNamespace = "AndyDefer\\Songbird\\Tests";
        $subNamespace = implode('\\', $namespaceParts);

        $fullNamespace = $subNamespace
            ? $baseNamespace . '\\' . trim($subNamespace, '\\')
            : $baseNamespace;

        // Déterminer le chemin du fichier
        $filePath = 'tests/' . $testPath;

        // S'assurer que le fichier se termine par .php
        if (!str_ends_with($filePath, '.php')) {
            $filePath .= '.php';
        }

        // Créer le répertoire s'il n'existe pas
        $directory = dirname($filePath);
        if (!is_dir($directory)) {
            mkdir($directory, 0755, true);
        }

        // Vérifier si le fichier existe déjà
        if (file_exists($filePath)) {
            echo "Erreur: Le fichier {$filePath} existe déjà.\n";
            exit(1);
        }

        // Générer le contenu du fichier de test
        $content = <<<PHP
<?php

namespace {$fullNamespace};

use PHPUnit\Framework\TestCase;

class {$className} extends TestCase
{
    public function test_basic_math()
    {
        \$this->assertEquals(2, 1 + 1);
    }
}

PHP;

        // Écrire le fichier
        if (file_put_contents($filePath, $content)) {
            echo "✓ Test créé avec succès: {$filePath}\n";
        } else {
            echo "✗ Erreur lors de la création du fichier: {$filePath}\n";
            exit(1);
        }
    }
}
