<?php


// Datos de ejemplo de gatos (podrías reemplazar esto con una base de datos si es necesario)
$cats = [
    [
        'id' => 1,
        'name' => 'Whiskers',
        'breed' => 'Persian',
        'age' => 3
    ],
    [
        'id' => 2,
        'name' => 'Fluffy',
        'breed' => 'Maine Coon',
        'age' => 5
    ],
    [
        'id' => 3,
        'name' => 'Mittens',
        'breed' => 'Siamese',
        'age' => 2
    ]
];

// Obtener el método HTTP
$method = $_SERVER['REQUEST_METHOD'];

// Procesar la solicitud según el método HTTP
switch ($method) {
    case 'GET':
        // Verificar si se solicita un gato específico por su ID
        if (isset($_GET['id'])) {
            $catId = (int) $_GET['id'];
            getCatById($catId, $cats);
        } else {
            getCats($cats);
        }
        break;

    default:
        // Si no es un método GET, devolver un error
        http_response_code(405);
        echo json_encode(['message' => 'Método no permitido']);
        break;
}

// Función para obtener todos los gatos
function getCats($cats) {
    echo json_encode($cats);
}

// Función para obtener un gato por su ID
function getCatById($id, $cats) {
    foreach ($cats as $cat) {
        if ($cat['id'] == $id) {
            echo json_encode($cat);
            return;
        }
    }
    http_response_code(404);
    echo json_encode(['message' => 'Gato no encontrado']);
}
