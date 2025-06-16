<?php
namespace App;

use OpenAI;

/**
 * Clase OpenAiService
 * Servicio que implementa la interfaz AIServiceInterface para interactuar con el modelo de OpenAI.
 * Permite enviar mensajes y obtener respuestas usando la API de OpenAI.
 */
class OpenAiService implements AIServiceInterface
{
    /**
     * @var \OpenAI\Client $client Cliente de OpenAI para interactuar con la API.
     */
    protected $client;
    
    /**
     * Constructor de la clase OpenAiService.
     * Inicializa el cliente de OpenAI utilizando la clave de API almacenada en las variables de entorno.
     */
    public function __construct() 
    {
        $this->client = OpenAI::client($_ENV['OPENAI_API_KEY']);
    }

    /**
     * Obtiene una respuesta del modelo de OpenAI a partir de una entrada del usuario.
     *
     * @param string $input Pregunta o mensaje del usuario.
     * @return string Respuesta generada por el modelo de OpenAI.
     */
    public function getResponse(string $input): string 
    {
        // Realiza una solicitud al modelo de OpenAI con el mensaje del usuario
        $result = $this->client->chat()->create([
            'model' => 'gpt-4o-mini', // Puedes cambiar el modelo si lo deseas
            'messages' => [
                ['role' => 'user', 'content' => $input],
            ],
        ]);

        // Retorna el contenido de la respuesta generada por el modelo
        return $result['choices'][0]['message']['content'];
    }
}