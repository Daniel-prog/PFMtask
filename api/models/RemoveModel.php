<?php

class RemoveModel extends Model {

    function remove($id) {

        $sql = "DELETE FROM sequences WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function addChange($id, $token) {
        $sql = "INSERT INTO changes (string_id, action_name, user_token)
                    VALUES(:id, 'Delete', :token)";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        $stmt->bindValue(":token", $token, PDO::PARAM_STR);
        $stmt->execute();

    }
}