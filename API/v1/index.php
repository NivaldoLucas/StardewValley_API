<?php

require_once 'config/database.php';
require_once 'models/Fruta.php';
require_once 'models/Pedra.php';

header('Content-Type: application/json');

// Configuração da rota
$method = $_SERVER['REQUEST_METHOD'];
$path = $_SERVER['PATH_INFO'] ?? '/';


if ($method == 'GET' && $path == '/items') { //Okay
    // Obter todos os itens
    $items = getAllItems($conn);
    echo json_encode($items);

} elseif ($method == 'GET' && $path == '/frutas') { //Okay
    // Obter todos as frutas
    $items = getAllFrutas($conn);
    echo json_encode($items);

} elseif ($method == 'GET' && $path == '/pedras') { //Okay
    // Obter todos as pedras
    $items = getAllPedras($conn);
    echo json_encode($items);

} elseif ($method == 'GET' && preg_match('/\/frutas\/(\d+)/', $path, $matches)) { //Okay
    // Obter uma fruta em específico
    $itemId = $matches[1];
    $item = getFruitById($conn, $itemId);
    echo json_encode($item);



} elseif ($method == 'GET' && preg_match('/\/pedras\/(\d+)/', $path, $matches)) { //Okay
    // Obter uma pedra em específico
    $itemId = $matches[1];
    $item = getStoneById($conn, $itemId);
    echo json_encode($item);




} elseif ($method == 'POST' && $path == '/frutas') {            //Okay
    // Criar uma nova fruta
    $data = json_decode(file_get_contents('php://input'), true);
    
    $name = $data['name'];
    $description = $data['description'];
    $price = $data['price'];

    $newItem = createFruit($conn, $name, $description, $price);
    echo json_encode($newItem);



} elseif ($method == 'POST' && $path == '/pedras') {           //Okay
    // Criar uma nova pedra
    $data = json_decode(file_get_contents('php://input'), true);
    
    $name = $data['name'];
    $description = $data['description'];
    $price = $data['price'];

    $newItem = createStone($conn, $name, $description, $price);
    echo json_encode($newItem);


} elseif ($method == 'PUT' && preg_match('/\/frutas\/(\d+)/', $path, $matches)) {           //Okay
    // Atualizar uma fruta existente
    $itemId = $matches[1];
    $data = json_decode(file_get_contents('php://input'), true);

    $name = $data['name'];
    $description = $data['description'];
    $price = $data['price'];

    $updatedItem = updateFruit($conn, $itemId, $name, $description, $price);
    echo json_encode($updatedItem);

    

} elseif ($method == 'DELETE' && preg_match('/\/frutas\/(\d+)/', $path, $matches)) {        //Okay
    // Excluir uma fruta
    $itemId = $matches[1];
    deleteFruit($conn, $itemId);
    echo json_encode(['success' => true]);


} elseif ($method == 'PUT' && preg_match('/\/pedras\/(\d+)/', $path, $matches)) {           //Okay      
    // Atualizar uma pedra existente
    $itemId = $matches[1];
    $data = json_decode(file_get_contents('php://input'), true);

    $name = $data['name'];
    $description = $data['description'];
    $price = $data['price'];

    $updatedItem = updateStone($conn, $itemId, $name, $description, $price);
    echo json_encode($updatedItem);



} elseif ($method == 'DELETE' && preg_match('/\/pedras\/(\d+)/', $path, $matches)) {   //Okay
    // Excluir uma pedra
    $itemId = $matches[1];
    deleteStone($conn, $itemId);
    echo json_encode(['success' => true]);



} else {
    http_response_code(404);
    echo json_encode(['error' => 'Rota não encontrada']);
}

?>
