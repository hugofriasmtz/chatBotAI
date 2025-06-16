<?php

namespace App;

use ArdaGnsrn\Ollama\Ollama; // Librería Ollama para PHP

/**
 * Clase OllamaAiService
 * Servicio que implementa la interfaz AIServiceInterface para interactuar con un modelo de IA usando Ollama.
 * Este servicio está especializado en responder preguntas sobre PHP.
 */
class OllamaAiService implements AIServiceInterface
{
    /**
     * @var Ollama $client Cliente Ollama para interactuar con el servicio de IA.
     */
    protected $client;

    /**
     * Constructor de la clase OllamaAiService.
     * Inicializa el cliente Ollama con la configuración necesaria.
     */
    public function __construct()
    {
        $this->client = Ollama::client();
    }

    /**
     * Obtiene una respuesta del modelo de IA a partir de una entrada del usuario.
     *
     * @param string $input Pregunta o mensaje del usuario.
     * @return string Respuesta generada por el modelo de IA.
     */
    public function getResponse(string $input): string
    {
        // Realiza una solicitud al modelo de IA con un mensaje de sistema personalizado
        $result = $this->client->chat()->create([
            'model' => $_ENV['MODEL_DEEPSEEK'], // Nombre del modelo, por ejemplo: 'deepseek-r1:1.5b'
            'messages' => [
                [
                    'role' => 'system', 'content' => <<<EOT
                        Eres un asistente especializado exclusivamente en PHP.
                        - Tu objetivo es responder preguntas sobre PHP de manera precisa y concisa.
                        - Tus respuestas deben ser en español.
                        - No debes proporcionar información sobre otros lenguajes de programación.
                        - Si no sabes la respuesta, simplemente di "No sé".
                    EOT
                ],
                ['role' => 'user', 'content' => $input ],
            ],
        ]);

        // Extrae y retorna el contenido de la respuesta generada por el modelo
        $chatMessageResponse = $result->message->content;
        return $chatMessageResponse;
    }
}