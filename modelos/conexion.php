<?php 
abstract class Conexion{ 
    protected static $conexion = null; 
    
    static function conectar(): PDO { 
        try {
            self::$conexion = new PDO("informix:host=host.docker.internal; service=9088; database=farmaceutica; server=informix; protocol=onsoctcp;EnableScrollableCursors=1", "informix", "in4mix");
            self::$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "No hay conexion a la Base de Datos <br>"; 
            echo $e->getMessage();
            self::$conexion = null;
            exit;
        }
        return self::$conexion; 
    } 

    public function traer($sql){
        $conexion = self::conectar();
        $sentencia = $conexion->prepare($sql);
        $sentencia->execute();
        $data = $sentencia->fetchAll(PDO::FETCH_ASSOC);
        $datos = [];
        foreach ($data as $key => $value) {
            $datos[] = array_change_key_case($value, CASE_LOWER);
        }
        self::$conexion = null;
        return $datos;
    }

    public function ejecutar($sql, $params = []){
        $conexion = self::conectar();
        $sentencia = $conexion->prepare($sql);
        $resultado = $sentencia->execute($params);
        $idInsertado = $conexion->lastInsertId();
        self::$conexion = null;

        return [
            "resultado" => $resultado,
            "id" => $idInsertado
        ];
    }

    public function servir($sql, $params = [])
    {
        $conexion = self::conectar();
        $sentencia = $conexion->prepare($sql);
        $sentencia->execute($params);
        
        $data = $sentencia->fetchAll(PDO::FETCH_ASSOC);

        $datos = [];
        foreach ($data as $k => $v) {
            $datos[] = array_change_key_case($v, CASE_LOWER);
        }
        self::$conexion = null;
        return $datos;
    }

    public static function getConexion(): PDO
    {
        self::conectar();
        return self::$conexion;
    }
}
?>