<?php

class GetModel extends Model {

    function getStrByID($id) {
        $sql = "SELECT sequence FROM sequences WHERE id = :id";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":id", $id, PDO::PARAM_STR);
        $stmt->execute();

        $seq = $stmt->fetch(PDO::FETCH_ASSOC);

        return $seq['sequence'];
    }
}