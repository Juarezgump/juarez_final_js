<?php

include_once 'conexion.php';

class Ventas extends Conexion{
    public $venta_id;
    public $med_venta;
    public $venta_cant;
    public $med_cliente;
    public $med_tra;
    public $med_situacion;

    public function __construct($args = []){
        $this->venta_id = $args['venta_id'] ?? null;
        $this->med_venta = $args['med_venta'] ?? '';
        $this->venta_cant = $args['venta_cant'] ?? '';
        $this->med_cliente = $args['med_cliente'] ?? '';
        $this->med_tra = $args['med_tra'] ?? '';
        $this->med_situacion = $args['med_situacion'] ?? 1;
    }

    public function guardar(){
        $sql = "INSERT INTO venta(med_venta, venta_cant, med_cliente, med_tra)
                VALUES (:med_venta, :cant, :med_cliente, :med_tra)";

        $params = [
            ':med_venta' => $this->med_venta,
            ':cant' => $this->venta_cant,
            ':med_cliente' => $this->med_cliente,
            ':med_tra' => $this->med_tra,
        ];
        
        $resultado = $this->ejecutar($sql, $params);
        
        $sql2 = "UPDATE medicamentos 
                      SET med_disponible = med_disponible - :med_disponible 
                      WHERE med_id = :med_id";
        
        $params2 = [
            ':med_id' => $this->med_venta,
            ':med_disponible' => $this->venta_cant
        ];
        
        $this->ejecutar($sql2, $params2);
        
        return $resultado;
    }

    public function buscar(){
        $sql = "SELECT v.venta_id, m.med_nombre, v.venta_cant, t.tra_nombres, c.cli_nombres
                FROM venta v
                JOIN medicamentos m ON v.med_venta = m.med_id
                JOIN trabajadores t ON v.med_tra = t.tra_id
                JOIN clientes c ON v.med_cliente = c.cli_id
                WHERE m.med_situacion = 1";
        $params = [];

        if(!empty($this->med_venta)){
            $sql .= " AND v.med_venta = :med_venta";
            $params[':med_venta'] = $this->med_venta; 
        }

        if (!empty($this->venta_cant)) {
            $sql .= " AND v.venta_cant = :cant";
            $params[':cant'] = $this->venta_cant;
        }

        if (!empty($this->med_cliente)) {
            $sql .= " AND v.med_cliente = :med_cliente";
            $params[':med_cliente'] = $this->med_cliente;
        }

        if (!empty($this->med_tra)) {
            $sql .= " AND v.med_tra = :med_tra";
            $params[':med_tra'] = $this->med_tra;
        }

        return self::servir($sql, $params);
    }

    public function buscarID($ID){
        $sql = "SELECT v.venta_id, m.med_nombre, v.venta_cant, t.tra_nombres, c.cli_nombres
                FROM venta v
                JOIN medicamentos m ON v.med_venta = m.med_id
                JOIN trabajadores t ON v.med_tra = t.tra_id
                JOIN clientes c ON v.med_cliente = c.cli_id
                WHERE v.venta_id = :ID AND m.med_situacion = 1";
    
        $params = [':ID' => $ID];
        $resultados = self::servir($sql, $params);  
        $resultado = array_shift($resultados);      
        return $resultado;
    }
}