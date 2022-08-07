<?php 

// creamos ell modelo de la api de libros..
class Libros{
    
    private $titulo;
    private $editorial;
    private $isbn;

    public function __construct($titulo,$editorial,  $isbn){
        $this->titulo = $titulo;
        $this->editorial = $editorial;
        $this->isbn = $isbn;
    }


    //get de las propiedades...

    public function gettitulo(){ return $this->titulo;}
    public function geteditorial(){return $this->editorial;}
    public function getisbn(){return $this->isbn;}

    // sets de las propiedades...
    public function settitulo($titulo){ $this->titulo = $titulo; }
    public function seteditorial($editorial){ $this->editorial = $editorial; }
    public function setisbn($isbn){ $this->titulo = $isbn; }

    // metodos para el HTTP
 
    public static function get_libros (){
        $Libros = file_get_contents('api.json');

        echo $Libros;
    }
    public static function  get_libro ($id){

        $Libros = file_get_contents('api.json');
        $libros_decode = json_decode($Libros,true);
        
        echo json_encode($libros_decode[$id]);
    }
    public function post_libro (){

        $Libros = file_get_contents('api.json');
        $libros_decode = json_decode($Libros,true);

        $libros_decode[] = array(
            "titulo"=> $this->titulo,
            "editorial"=> $this->editorial,
            "isbn" => $this->isbn
        );

        $archivojs = fopen('api.json','w');

        fwrite($archivojs,json_encode($libros_decode));
        fclose($archivojs);

        echo "libro Guardado";

    }
    public function update_libro($id){
        $Libros = file_get_contents('api.json');
        $libro_decode = json_decode($Libros,true);

        $libro_decode[$id]= array(
            "titulo" => $this->titulo,
            "editorial" => $this->editorial,
            "isbn"  => $this->isbn
        );
        $archivo = fopen('api.json','w');
        fwrite($archivo ,json_encode($libro_decode));
        fclose($archivo);

        echo "libro actuaalizado";


    }
    public static function delete_libro($id){

        $Libros = file_get_contents('api.json');
        $libros_decode =  json_decode($Libros,true);
        array_splice($libros_decode,$id,1);
        

        $archivo = fopen('api.json','w');
        fwrite($archivo ,json_encode($libros_decode));
        fclose($archivo);

        echo "libro elimindado";

    }


}


?>