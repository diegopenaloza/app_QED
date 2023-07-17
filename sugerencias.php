1 <?php
  2 // Manejar la solicitud de la API
  3 if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['valor'])) {
  4   $valor = $_GET['valor'];
  5
  6   // Realizar una solicitud HTTP GET al backend para obtener los datos de la API
  7   $url = 'http://localhost:8000/sugerencias?valor=' . urlencode($valor);
  8   $response = file_get_contents($url);
  9
 10   if ($response !== false) {
 11     // Decodificar la respuesta JSON y mostrar los datos
 12     $data = json_decode($response, true);
 13
 14     if (isset($data['sugerencias']) && is_array($data['sugerencias'])) {
 15       $sugerencias = $data['sugerencias'];
 16
 17       // Construir un array de sugerencias
 18       $sugerenciasArray = [];
 19
 20       foreach ($sugerencias as $sugerencia) {
 21         $sugerenciasArray[] = $sugerencia;
 22       }
 23
 24       // Devolver las sugerencias como JSON
 25       header('Content-Type: application/json');
 26       echo $response;
 27     } else {
 28       // Devolver un mensaje de error si no hay sugerencias o el formato no es válido
 29       $errorMessage = 'La respuesta de la API no contiene sugerencias válidas.';
 30       echo json_encode(['error' => $errorMessage]);
 31     }
 32   } else {
 33     // Devolver un mensaje de error en caso de fallar la solicitud a la API
 34     $errorMessage = 'Error al realizar la solicitud a la API.';
 35     echo json_encode(['error' => $errorMessage]);
 36   }
 37 }
 38 ?>