<?php

include_once 'conexion.php';


class Medicamentos extends Conexion{
    public $med_id;
    public $med_nombre;
    public $med_vencimiento;
    public $med_desc;
    public $med_presentacion;
    public $med_casa;
    public $med_disponible;
    public $med_precio;
    public $med_situacion;

    public function __construct($args = []){
        $this->med_id = $args['med_id'] ?? null;
        $this->med_nombre = $args['med_nombre'] ?? '';
        $this->med_vencimiento = $args['med_vencimiento'] ?? '';
        $this->med_desc = $args['med_desc'] ?? '';
        $this->med_presentacion = $args['med_presentacion'] ?? '';
        $this->med_casa = $args['med_casa'] ?? '';
        $this->med_disponible = $args['med_disponible'] ?? '';
        $this->med_precio = $args['med_precio'] ?? '';
        $this->med_situacion = $args['med_situacion'] ?? 1;
    }

    public function guardar(){
        $sql = "INSERT INTO medicamentos(med_nombre, med_vencimiento, med_desc, med_presentacion, med_casa, med_disponible, med_precio)
                VALUES (:nombres, :venc, :descr, :pre, :med_casa, :disp, :precio)";

        $params = [
            ':nombres' => $this->med_nombre,
            ':venc' => $this->med_vencimiento,
            ':descr' => $this->med_desc,
            ':pre' => $this->med_presentacion,
            ':med_casa' => $this->med_casa,
            ':disp' => $this->med_disponible,
            ':precio' => $this->med_precio,
        ];
        return $this->ejecutar($sql, $params);
    }

    public function buscar(){
        $sql = "SELECT m.*, c.casa_nombre
                FROM medicamentos m
                JOIN casa c ON m.med_casa = c.casa_id
                WHERE m.med_situacion = 1";
        $params = [];

        if(!empty($this->med_nombre)){
            $sql .= " AND med_nombre LIKE :nombres";
            $params[':nombres'] = "%{$this->med_nombre}%"; 
        }

        if (!empty($this->med_vencimiento)) {
            $sql .= " AND med_vencimiento LIKE :venc";
            $params[':venc'] = "%{$this->med_vencimiento}%";
        }

        if (!empty($this->med_desc)) {
            $sql .= " AND med_desc LIKE :descr";
            $params[':descr'] = "%{$this->med_desc}%";
        }

        if (!empty($this->med_presentacion)) {
            $sql .= " AND med_presentacion LIKE :pre";
            $params[':pre'] = "%{$this->med_presentacion}%";
        }

        if(!empty($this->med_precio)){
            $sql .= " AND med_precio = :precio";
            $params[':precio'] = $this->med_precio; 
        }

        return self::servir($sql, $params);

    }

    public function buscarID($ID){
        $sql = "SELECT m.*, c.casa_nombre
                FROM medicamentos m
                JOIN casa c ON m.med_casa = c.casa_id
                WHERE m.med_situacion = 1 AND m.med_id = :ID";
    
        $params = [':ID' => $ID];
        $resultados = self::servir($sql, $params);  
        $resultado = array_shift($resultados);      
        return $resultado;
    }

    public function modificar(){
        $sql = "UPDATE medicamentos
                SET med_nombre = :nombres,
                    med_vencimiento = :venc,
                    med_desc = :descr,
                    med_presentacion = :pre,
                    med_casa = :med_casa,
                    med_disponible = :disp,
                    med_precio = :precio                   
                WHERE med_situacion = 1 AND med_id = :id";
        
        $params = [
            ':nombres' => $this->med_nombre,
            ':venc' => $this->med_vencimiento,
            ':descr' => $this->med_desc,
            ':pre' => $this->med_presentacion,
            ':med_casa' => $this->med_casa,
            ':disp' => $this->med_disponible,
            ':precio' => $this->med_precio,
            ':id'   => $this->med_id,
        ];

        return $this->ejecutar($sql, $params);
    }
    
    public function eliminar(){
        $sql = "UPDATE medicamentos SET med_situacion = 0 WHERE med_id = :id";

        $params = [
            ':id' => $this->med_id
        ];

        return $this->ejecutar($sql, $params);
    }
    public function listarMedicamentos(){
        $sql = "SELECT * FROM medicamentos WHERE med_situacion = 1";
        return self::servir($sql);
    }
}

