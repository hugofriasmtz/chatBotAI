<?php

/**
 * Archivo principal de la aplicación web.
 * 
 * - Carga la instancia de la aplicación desde bootstrap.php.
 * - Procesa el formulario enviado por el usuario.
 * - Muestra la interfaz del chatbot utilizando Tailwind CSS para los estilos.
 */

$app = require __DIR__ . '/../bootstrap.php';

$question = $_POST['question'] ?? '';
$answer = null;

// Si se envía el formulario y hay una pregunta, obtiene la respuesta del chatbot
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $question) {
    $answer = $app->getResponse($question);
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>ChatBot PHP IA</title>
    <!-- Tailwind CDN -->
   <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded shadow-md w-full max-w-md">
        <form method="POST" class="mb-4">
            <label for="question" class="block mb-2 font-bold">Pregúntame algo de PHP</label>
            <input 
                type="text" 
                name="question" 
                <!-- value="<?= htmlspecialchars($question) ?>"
                required
                class="w-full px-3 py-2 border rounded mb-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
            >
            <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded hover:bg-blue-600 transition">
                Preguntar
            </button>
        </form>

        <?php if ($answer): ?>
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded">
                <strong>Respuesta:</strong> 
                <?= htmlspecialchars($answer) ?>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>