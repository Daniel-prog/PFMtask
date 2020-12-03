<?php

class GenerateModel extends Model {

    function insert($seq) {
        $sql = "INSERT INTO sequences (sequence)
                    VALUES(:seq)";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":seq", $seq, PDO::PARAM_STR);
        $stmt->execute();
        $id = $this->db->lastInsertId();

        return $id;
    }
}