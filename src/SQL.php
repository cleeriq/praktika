<?php

namespace Ven\App;

class SQL {
    

    private $db;

    public function __construct(){
        $this->connect();
    }

    public static function select($table, $column=NULL, $value=NULL, $column1=NULL, $value1=NULL, $sorted=NULL) {
        $self = new self;
        $db = $self->db;

        $request = "SELECT * FROM `$table`";

        if ($column != NULL && $value != NULL) {
            if (is_array($value)) {
                $request .= " WHERE $column IN (".implode(', ', $value).")";
            } else {
                $request .= " WHERE $column = '$value'";
            }
        } 
        if ($column1 != NULL && $value1 != NULL) {
            if (is_array($value1)) {
                $request .= " AND $column1 IN (".implode(', ', $value1).")";
            } else {
                $request .= " AND $column1 = '$value1'";
            }

        }
        if ($sorted != NULL) {
            $request .= " ORDER BY $sorted";
        }
        

        $result = $db->query($request);

        return $self->processing($result);
    }

    public static function insert($table, $array) {
        $self = new self;
        $db = $self->db;

        $column = implode(", ", array_keys($array));
        $value = implode("', '", array_values($array));

        $request = "INSERT INTO `$table`($column) VALUES ('$value')";

        $db->query($request);

        return $db->insert_id;
    }

    public static function update($table, $column, $value, $array)
    {
        $self = new self;
        $db = $self->db;

        foreach ($array as $key => $data) {
            $array[$key] = "$key = '$data'";
        }
        $newvalues = implode(", ", array_values($array));

        $request = "UPDATE `$table` SET $newvalues WHERE $column = '$value'";
        $db->query($request);

        return;

    }

    public static function delete($table, $column, $value) {
        $self = new self;
        $db = $self->db;

        $request = "DELETE FROM $table WHERE $column = '$value'";

        $db->query($request);

        return;
    }


    private function connect() {
        $this->db = include APP_PATH."/config/db.php";
    }

    private function processing($result) {
        $array = [];

        while ($row = $result->fetch_assoc()) {
            $array[] = $row;
        }

        return $array;
    }


}