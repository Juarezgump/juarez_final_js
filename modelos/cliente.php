<?php

include_once 'conexion.php';


class Cliente extends Conexion{
    public $cli_id;
    public $cli_nombres;
    public $cli_edad;
    public $cli_dpi;
    public $cli_nit;
    public $cli_telefono;
    public $cli_correo;
    public $cli_genero;
    public $cli_direccion;
    public $cli_situacion;

    public function __construct($args = []){
        $this->cli_id = $args['cli_id'] ?? null;
        $this->cli_nombres = $args['cli_nombres'] ?? '';
        $this->cli_edad = $args['cli_edad'] ?? '';
        $this->cli_dpi = $args['cli_dpi'] ?? '';
        $this->cli_nit = $args['cli_nit'] ?? '';
        $this->cli_telefono = $args['cli_telefono'] ?? '';
        $this->cli_correo = $args['cli_correo'] ?? '';
        $this->cli_genero = $args['cli_genero'] ?? '';
        $this->cli_direccion = $args['cli_direccion'] ?? '';
        $this->cli_situacion = $args['cli_situacion'] ?? 1;
    }

    public function guardar(){
        $sql = "INSERT INTO clientes(cli_nombres, cli_edad, cli_dpi, cli_nit, cli_telefono, cli_correo, cli_genero, cli_direccion)
                VALUES (:nombres, :edad, :dpi, :nit, :telefono, :correo, :genero, :direccion)";

        $params = [
            ':nombres' => $this->cli_nombres,
            ':edad' => $this->cli_edad,
            ':dpi' => $this->cli_dpi,
            ':nit' => $this->cli_nit,
            ':telefono' => $this->cli_telefono,
            ':correo' => $this->cli_correo,
            ':genero' => $this->cli_genero,
            ':direccion' => $this->cli_direccion,
        ];
        return $this->ejecutar($sql, $params);
    }

    public function buscar(...$columnas){
        $cols = count($columnas) > 0 ? implode(',', $columnas) : '*';
        $sql = "SELECT $cols FROM clientes WHERE cli_situacion = 1";
        $params = [];

        if(!empty($this->cli_nombres)){
            $sql .= "AND cli_nombres LIKE :nombres";
            $params[':nombres'] = "%{$this->cli_nombres}%"; 
        }

        if (!empty($this->cli_edad)) {
            $sql .= " AND cli_edad = :edad";
            $params[':edad'] = "%{$this->cli_edad}%";
        }

        if (!empty($this->cli_dpi)) {
            $sql .= " AND cli_dpi = :dpi";
            $params[':dpi'] = $this->cli_dpi;
        }

        if (!empty($this->cli_nit)) {
            $sql .= " AND cli_nit = :nit";
            $params[':nit'] = $this->cli_nit;
        }

        if(!empty($this->cli_genero)){
            $sql .= "AND cli_genero LIKE :genero";
            $params[':genero'] = "%{$this->cli_genero}%"; 
        }

        return self::servir($sql, $params);

    }

    public function buscarID($ID){
        
        $sql = "SELECT * FROM clientes where cli_situacion = 1 AND cli_id = $ID ";
    
        $resultado =  array_shift(self::servir($sql));
        return $resultado;
    }

    public function modificar(){
        $sql = "UPDATE clientes
                SET cli_nombres = :nombres,
                    cli_edad = :edad,
                    cli_dpi = :dpi,
                    cli_nit = :nit,
                    cli_telefono = :telefono,
                    cli_correo = :correo,
                    cli_genero = :genero,                   
                    cli_direccion = :direccion
                    WHERE cli_situacion = 1 AND cli_id = :id";
        
        $params = [
            ':nombres' => $this->cli_nombres,
            ':edad' => $this->cli_edad,
            ':dpi' => $this->cli_dpi,
            ':nit' => $this->cli_nit,
            ':telefono' => $this->cli_telefono,
            ':correo' => $this->cli_correo,
            ':genero' => $this->cli_genero,
            ':direccion' => $this->cli_direccion,
            ':id'   => $this->cli_id,
        ];

        return $this->ejecutar($sql, $params);
    }
    
    public function eliminar(){
        $sql = "UPDATE clientes SET cli_situacion = 0 WHERE cli_id = :id";

        $params = [
            ':id' => $this->cli_id
        ];

        return $this->ejecutar($sql, $params);
    }

    public function listarClientes(){
        $sql = "SELECT * FROM clientes WHERE cli_situacion = 1";
        return self::servir($sql);
    }
}

