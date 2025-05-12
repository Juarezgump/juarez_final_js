<?php

include_once 'conexion.php';


class Trabajadores extends Conexion{
    public $tra_id;
    public $tra_nombres;
    public $tra_edad;
    public $tra_dpi;
    public $tra_puesto;
    public $tra_telefono;
    public $tra_correo;
    public $tra_salario;
    public $tra_genero;
    public $tra_direccion;
    public $tra_situacion;

    public function __construct($args = []){
        $this->tra_id = $args['tra_id'] ?? null;
        $this->tra_nombres = $args['tra_nombres'] ?? '';
        $this->tra_edad = $args['tra_edad'] ?? '';
        $this->tra_dpi = $args['tra_dpi'] ?? '';
        $this->tra_puesto = $args['tra_puesto'] ?? '';
        $this->tra_telefono = $args['tra_telefono'] ?? '';
        $this->tra_correo = $args['tra_correo'] ?? '';
        $this->tra_salario = $args['tra_salario'] ?? '';
        $this->tra_genero = $args['tra_genero'] ?? '';
        $this->tra_direccion = $args['tra_direccion'] ?? '';
        $this->tra_situacion = $args['tra_situacion'] ?? 1;
    }

    public function guardar(){
        $sql = "INSERT INTO trabajadores(tra_nombres, tra_edad, tra_dpi, tra_puesto, tra_telefono, tra_correo, tra_salario, tra_genero, tra_direccion)
                VALUES (:nombres, :edad, :dpi, :puesto, :telefono, :correo, :salario, :genero, :direccion)";

        $params = [
            ':nombres' => $this->tra_nombres,
            ':edad' => $this->tra_edad,
            ':dpi' => $this->tra_dpi,
            ':puesto' => $this->tra_puesto,
            ':telefono' => $this->tra_telefono,
            ':correo' => $this->tra_correo,
            ':salario' => $this->tra_salario,
            ':genero' => $this->tra_genero,
            ':direccion' => $this->tra_direccion,
        ];
        return $this->ejecutar($sql, $params);
    }

    public function buscar(...$columnas){
        $cols = count($columnas) > 0 ? implode(',', $columnas) : '*';
        $sql = "SELECT $cols FROM trabajadores WHERE tra_situacion = 1";
        $params = [];

        if(!empty($this->tra_nombres)){
            $sql .= "AND tra_nombres LIKE :nombres";
            $params[':nombres'] = "%{$this->tra_nombres}%"; 
        }

        if (!empty($this->tra_edad)) {
            $sql .= " AND tra_edad = :edad";
            $params[':edad'] = "%{$this->tra_edad}%";
        }

        if (!empty($this->tra_dpi)) {
            $sql .= " AND tra_dpi = :dpi";
            $params[':dpi'] = $this->tra_dpi;
        }

        if(!empty($this->tra_puesto)){
            $sql .= "AND tra_puesto LIKE :puesto";
            $params[':puesto'] = "%{$this->tra_puesto}%"; 
        }

        if(!empty($this->tra_genero)){
            $sql .= "AND tra_genero LIKE :genero";
            $params[':genero'] = "%{$this->tra_genero}%"; 
        }
        return self::servir($sql, $params);

    }

    public function buscarID($ID){
        
        $sql = "SELECT * FROM trabajadores where tra_situacion = 1 AND tra_id = $ID ";
    
        $resultado =  array_shift(self::servir($sql));
        return $resultado;
    }

    public function modificar(){
        $sql = "UPDATE trabajadores
                SET tra_nombres = :nombres,
                    tra_edad = :edad,
                    tra_dpi = :dpi,
                    tra_puesto = :nit,
                    tra_telefono = :telefono,
                    tra_correo = :correo,
                    tra_salario = :salario,
                    tra_genero = :genero,                                                          
                    tra_direccion = :direccion
                    WHERE tra_situacion = 1 AND tra_id = :id";
        
        $params = [
            ':nombres' => $this->tra_nombres,
            ':edad' => $this->tra_edad,
            ':dpi' => $this->tra_dpi,
            ':nit' => $this->tra_puesto,
            ':telefono' => $this->tra_telefono,
            ':correo' => $this->tra_correo,
            ':salario' => $this->tra_salario,
            ':genero' => $this->tra_genero,
            ':direccion' => $this->tra_direccion,
            ':id'   => $this->tra_id,
        ];

        return $this->ejecutar($sql, $params);
    }
    
    public function eliminar(){
        $sql = "UPDATE trabajadores SET tra_situacion = 0 WHERE tra_id = :id";

        $params = [
            ':id' => $this->tra_id
        ];

        return $this->ejecutar($sql, $params);
    }

    public function listarTrabajadores(){
        $sql = "SELECT * FROM trabajadores WHERE tra_situacion = 1";
        return self::servir($sql);
    }
}

