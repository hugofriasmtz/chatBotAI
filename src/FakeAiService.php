<?php

namespace app;

class FakeAiService implements AIServiceInterface
{
    public function getResponse(string $response): string
    {
        sleep(2); // espera dos segundos

        if ($this->esSaludo($response)) {
            return $this->respuestaSaludo();
        }

        return $this->respuestaTecnica($response);
    }

    private function esSaludo(string $texto): bool
    {
        return stripos($texto, 'Hola') !== false;
    }

    private function respuestaSaludo(): string
    {
        return "¡Hola! ¿En qué puedo ayudarte?";
    }

    private function respuestaTecnica(string $texto): string
    {
        if (stripos($texto, 'php') !== false) {
            return "Esto es una respuesta falsa sobre PHP.";
        }
        if (stripos($texto, 'javascript') !== false) {
            return "Esto es una respuesta falsa sobre JavaScript.";
        }
        if (stripos($texto, 'python') !== false) {
            return "Esto es una respuesta falsa sobre Python.";
        }
        return "Hey, sólo respondo preguntas acerca de PHP, JavaScript, Python o saludos.";
    }
}