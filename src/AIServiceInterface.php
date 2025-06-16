<?php
namespace App;


interface AIServiceInterface // Define la interfaz que debe implementar cualquier servicio de IA
{
    /**
     * Obtiene una respuesta de IA basada en la entrada del usuario.
     *
     * @param string $input La entrada del usuario.
     * @return string La respuesta generada por el servicio de IA.
     */
    public function getResponse(string $input): string; 
}