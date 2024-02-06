<?php

$servername = "localhost";
$username = "root";
$password = "2410";
$dbname = "caapora";

$conn = new mysqli($servername, $username, $password, $dbname);


/*
if ($conn->connect_error) {
    die("Falha na conexão com o banco de dados: " . $conn->connect_error);
}

if ($conn->ping()) {
    echo "Conexão bem-sucedida!";
} else {
    echo "Erro de conexão: " . $conn->error;
}
*/


function getAllItems($conn) {                           //Okay
    $fresult = $conn->query("SELECT * FROM frutas");
    $presult = $conn->query("SELECT * FROM pedras");

    $fruits = $fresult->fetch_all(MYSQLI_ASSOC);
    $stones = $presult->fetch_all(MYSQLI_ASSOC);

    $result = [
        'fruits' => $fruits,
        'stones' => $stones,
    ];

    return $result;
}


function getAllFrutas($conn) {                          //Okay
    $result = $conn->query("SELECT * FROM frutas");
    return $result->fetch_all(MYSQLI_ASSOC);
}

function getAllPedras($conn) {                          //Okay
    $result = $conn->query("SELECT * FROM pedras");
    return $result->fetch_all(MYSQLI_ASSOC);
}

function getFruitById($conn, $itemId) {                 //Okay
    $result = $conn->query("SELECT * FROM frutas WHERE id = $itemId");
    return $result->fetch_assoc();
}

function getStoneById($conn, $itemId) {                 //Okay
    $result = $conn->query("SELECT * FROM pedras WHERE id = $itemId");
    return $result->fetch_assoc();
}

function createFruit($conn, $name, $description, $price) {  //Okay
    $name = $conn->real_escape_string($name);
    $description = $conn->real_escape_string($description);

    $conn->query("INSERT INTO frutas (name, description, price) VALUES ('$name', '$description', $price)");

    return getFruitById($conn, $conn->insert_id);
}

function createStone($conn, $name, $description, $price) {  //Okay
    $name = $conn->real_escape_string($name);
    $description = $conn->real_escape_string($description);

    $conn->query("INSERT INTO pedras (name, description, price) VALUES ('$name', '$description', $price)");

    return getStoneById($conn, $conn->insert_id);
}

function updateFruit($conn, $itemId, $name, $description, $price) {     //Okay
    $name = $conn->real_escape_string($name);
    $description = $conn->real_escape_string($description);

    $conn->query("UPDATE frutas SET name = '$name', description = '$description', price = $price WHERE id = $itemId");

    return getFruitById($conn, $itemId);
}

function deleteFruit($conn, $itemId) {                          //Okay
    $conn->query("DELETE FROM frutas WHERE id = $itemId");
}

function updateStone($conn, $itemId, $name, $description, $price) {  //Okay
    $name = $conn->real_escape_string($name);
    $description = $conn->real_escape_string($description);

    $conn->query("UPDATE pedras SET name = '$name', description = '$description', price = $price WHERE id = $itemId");

    return getStoneById($conn, $itemId);
}

function deleteStone($conn, $itemId) {                          //Okay
    $conn->query("DELETE FROM pedras WHERE id = $itemId");
}


?>


