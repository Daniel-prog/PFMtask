<?php

class RemoveModel extends Model {

    function remove($id) {

        $sql = "DELETE FROM sequences WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
    }
}