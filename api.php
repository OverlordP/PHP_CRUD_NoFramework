<?php
header("Content-Type: application/json");
include_once('class-libros.php');

if ($_SERVER['REQUEST_METHOD']=='GET'){

    if (isset($_GET['id'])){
        Libros::get_libro($_GET['id']);
    }else{
        Libros::get_libros();
    }
    
}

if ($_SERVER['REQUEST_METHOD']=='POST'){

    $_POST = json_decode(file_get_contents('php://input'),true);

    $newlibro = new libros($_POST["titulo"],$_POST["editorial"],$_POST["isbn"]);

    $newlibro->post_libro(); 
    echo "post ps";
}


if ($_SERVER['REQUEST_METHOD']=='PUT'){

    $_PUT = json_decode(file_get_contents('php://input'),true);

    $put_libro = new libros($_PUT['titulo'],$_PUT['editorial'],$_PUT['isbn']);

    $put_libro->update_libro($_GET['id']);

    echo "put ps";
}

if ($_SERVER['REQUEST_METHOD']=='DELETE'){

    Libros::delete_libro($_GET['id']);
}

?>