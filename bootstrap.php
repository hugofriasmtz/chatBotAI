<?php
/**
 * Archivo de arranque (bootstrap) de la aplicación.
 * 
 * - Carga el autoloader de Composer.
 * - Carga las variables de entorno desde el archivo .env.
 * - Inicializa el servicio de IA deseado (Fake, OpenAI u Ollama).
 * - Retorna una instancia de la clase Chat con el servicio de IA seleccionado.
 */

require __DIR__ . '/vendor/autoload.php';

// Carga las variables de entorno desde el archivo .env
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ );
$dotenv->load();

// Inicializa el servicio de IA (descomenta el que desees usar)
// $aiService = new App\FakeAiService();
// $aiService = new App\OpenAiService();
$aiService = new App\OllamaAiService();

// Retorna una instancia de Chat con el servicio de IA seleccionado
return new App\Chat($aiService);