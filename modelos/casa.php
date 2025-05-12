<?php

include_once 'conexion.php';


class Casa extends Conexion{
    public $casa_id;
    public $casa_nombre;
    public $casa_direccion;
    public $casa_telefono;
    public $casa_jefe;
    public $casa_situacion;

    public function __construct($args = []){
        $this->casa_id = $args['casa_id'] ?? null;
        $this->casa_nombre = $args['casa_nombre'] ?? '';
        $this->casa_direccion = $args['casa_direccion'] ?? '';
        $this->casa_telefono = $args['casa_telefono'] ?? '';
        $this->casa_jefe = $args['casa_jefe'] ?? '';
        $this->casa_situacion = $args['casa_situacion'] ?? 1;
    }

    public function guardar(){
        $sql = "INSERT INTO casa(casa_nombre, casa_direccion, casa_telefono, casa_jefe)
                VALUES (:nombres, :direccion, :telefono, :jefe)";

        $params = [
            ':nombres' => $this->casa_nombre,
            ':direccion' => $this->casa_direccion,
            ':telefono' => $this->casa_telefono,
            ':jefe' => $this->casa_jefe,

        ];
        return $this->ejecutar($sql, $params);
    }

    public function buscar(...$columnas){
        $cols = count($columnas) > 0 ? implode(',', $columnas) : '*';
        $sql = "SELECT $cols FROM casa WHERE casa_situacion = 1";
        $params = [];

        if(!empty($this->casa_nombre)){
            $sql .= "AND casa_nombre LIKE :nombres";
            $params[':nombres'] = "%{$this->casa_nombre}%"; 
        }

        if (!empty($this->casa_direccion)) {
            $sql .= " AND casa_direccion = :direccion";
            $params[':direccion'] = "%{$this->casa_direccion}%";
        }

        if (!empty($this->casa_telefono)) {
            $sql .= " AND casa_telefono = :telefono";
            $params[':telefono'] = $this->casa_telefono;
        }

        if(!empty($this->casa_jefe)){
            $sql .= " AND casa_jefe LIKE :jefe";
            $params[':jefe'] = "%{$this->casa_jefe}%"; 
        }


        return self::servir($sql, $params);

    }

    public function buscarID($ID){
        
        $sql = "SELECT * FROM casa where casa_situacion = 1 AND casa_id = $ID ";
    
        $resultado =  array_shift(self::servir($sql));
        return $resultado;
    }

    public function modificar(){
        $sql = "UPDATE casa
                SET casa_nombre = :nombres,
                    casa_direccion = :direccion,
                    casa_telefono = :telefono,
                    casa_jefe = :jefe
                    WHERE casa_situacion = 1 AND casa_id = :id";
        
        $params = [
            ':nombres' => $this->casa_nombre,
            ':direccion' => $this->casa_direccion,
            ':telefono' => $this->casa_telefono,
            ':jefe' => $this->casa_jefe,
            ':id'   => $this->casa_id,
        ];

        return $this->ejecutar($sql, $params);
    }
    
    public function eliminar(){
        $sql = "UPDATE casa SET casa_situacion = 0 WHERE casa_id = :id";

        $params = [
            ':id' => $this->casa_id
        ];

        return $this->ejecutar($sql, $params);
    }

    public function listarCasas(){
        $sql = "SELECT * FROM casa WHERE casa_situacion = 1";
        return self::servir($sql);
    }
}

