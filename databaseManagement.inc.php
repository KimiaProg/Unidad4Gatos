<?php
$servidor = "localhost";
$baseDatos = "animales";
$usuario = "root";
$pass = "root";
function obtenerGato($id)
{
    try {
        $con = new PDO("mysql:host=" . $GLOBALS['servidor'] . ";dbname=" . $GLOBALS['baseDatos'], $GLOBALS['usuario'], $GLOBALS['pass']);
        $sql = $con->prepare("SELECT * from gatos where id=:id");
        $sql->bindParam(":id", $id);
        $sql->execute();
        $row = $sql->fetch(PDO::FETCH_ASSOC);
        $con = null;
        return $row;
    } catch (PDOException $e) {
        echo $e;
    }
}
function eliminarGato($id)
{
    $retorno = false;
    try {
        $con = new PDO("mysql:host=" . $GLOBALS['servidor'] . ";dbname=" . $GLOBALS['baseDatos'], $GLOBALS['usuario'], $GLOBALS['pass']);
        $sql = $con->prepare("DELETE from gatos where id=:id");
        $sql->bindParam(":id", $id);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $retorno = true;
        }
    } catch (PDOException $e) {
        echo $e;
    }
    $con = null;
    return $retorno;
}
function editarGato($id, $nombre, $dni, $edad, $sexo, $raza, $fechaAlta, $foto)
{
    $retorno = false;
    try {
        $con = new PDO("mysql:host=" . $GLOBALS['servidor'] . ";dbname=" . $GLOBALS['baseDatos'], $GLOBALS['usuario'], $GLOBALS['pass']);
        $sql = $con->prepare("UPDATE gatos  set nombre=:nombre , dni=:dni, edad=:edad, sexo=:sexo, raza=:raza, fechaAlta=:fechaAlta, foto=:foto where id=:id;");
        $sql->bindParam(":id", $id);
        $sql->bindParam(":nombre", $nombre);
        $sql->bindParam(":dni", $dni);
        $sql->bindParam(":edad", $edad);
        $sql->bindParam(":sexo", $sexo);
        $sql->bindParam(":raza", $raza);
        $sql->bindParam(":fechaAlta", $fechaAlta);
        $sql->bindParam(":foto", $foto);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $retorno = true;
        }
    } catch (PDOException $e) {
        echo $e;
    }
    $con = null;
    return $retorno;
}
function obtenerTodos()
{
    try {
        $con = new PDO("mysql:host=" . $GLOBALS['servidor'] . ";dbname=" . $GLOBALS['baseDatos'], $GLOBALS['usuario'], $GLOBALS['pass']);
        $sql = $con->prepare("SELECT id, nombre,dni,raza,fechaAlta from gatos;");
        $sql->execute();
        $miArray = [];
        while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
            $miArray[] = $row;
        }
    } catch (PDOException $e) {
        echo $e;
    }
    $con = null;
    return $miArray;
}
function insertaGato($nombre, $dni, $edad, $sexo, $raza, $fechaAlta, $foto)
{
    try {
        $con = new PDO("mysql:host=" . $GLOBALS['servidor'] . ";dbname=" . $GLOBALS['baseDatos'], $GLOBALS['usuario'], $GLOBALS['pass']);
        $sql = $con->prepare("INSERT into gatos values(null,:nombre,:dni,:edad,:sexo,:raza,:fechaAlta,:foto)");
        $sql->bindParam(":nombre", $nombre);
        $sql->bindParam(":dni", $dni);
        $sql->bindParam(":edad", $edad);
        $sql->bindParam(":sexo", $sexo);
        $sql->bindParam(":raza", $raza);
        $sql->bindParam(":fechaAlta", $fechaAlta);
        $sql->bindParam(":foto", $foto);
        $sql->execute();
        $id = $con->lastInsertId();
    } catch (PDOException $e) {
        echo $e;
    }
    $con = null;
    return $id;
}

function obtenerTodosCSV(){
    try {
        $con = new PDO("mysql:host=" . $GLOBALS['servidor'] . ";dbname=" . $GLOBALS['baseDatos'], $GLOBALS['usuario'], $GLOBALS['pass']);
        $sql = $con->prepare("SELECT id, nombre,dni,edad,sexo,raza,fechaAlta from gatos;");
        $sql->execute();
        $miArray = [];
        while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
            $miArray[] = $row;
        }
    } catch (PDOException $e) {
        echo $e;
    }
    $con = null;
    return $miArray;
}