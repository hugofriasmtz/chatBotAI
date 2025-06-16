<?php

namespace App;

class Chat
{
    /**
     * Constructor de la clase Chat.
     *
     * @param AIServiceInterface $service El servicio de IA que se utilizará para obtener respuestas.
     */
    
    public function __construct(
        protected AIServiceInterface $service
    ) {}
    /**
     * Ejecuta el chat, permitiendo al usuario interactuar con la IA.
     */

    public function run()
    {
        $this->welcome();

        while ($input = $this->prompt()) {
            if ($this->exit($input)) {
                break;
            }

            $response = $this->service->getResponse($input);

            $this->output($response);
        }
    }
    /**
     * Muestra un mensaje de bienvenida al usuario.
     */
    private function welcome(): void
    {
        echo 'Hazme una pregunta' . PHP_EOL;
    }
    /**
     * Solicita al usuario una entrada.
     *
     * @return string La entrada del usuario.
     */

    private function prompt(): string
    {
        return readline('> ');
    }
    /**
     * Verifica si la entrada del usuario es 'exit'.
     *
     * @param string $input La entrada del usuario.
     * @return bool Verdadero si la entrada es 'exit', falso en caso contrario.
     */

    private function exit(string $input): bool
    {
        return trim($input) === 'exit';
    }
    /**
     * Muestra la respuesta de la IA al usuario.
     *
     * @param string $response La respuesta de la IA.
     */

    private function output(string $response): void
    {
        echo $response . PHP_EOL;
    }
    /**
     * Obtiene una respuesta de la IA basada en la entrada del usuario.
     *
     * @param string $input La entrada del usuario.
     * @return string La respuesta generada por el servicio de IA.
     */
    public function getResponse(string $input): string
    {
        return $this->service->getResponse($input);
    }
}
