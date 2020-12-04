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

    public function addChange($id, $token) {
        $sql = "INSERT INTO changes (string_id, action_name, user_token)
                    VALUES(:id, 'Generate', :token)";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        $stmt->bindValue(":token", $token, PDO::PARAM_STR);
        $stmt->execute();

    }
}