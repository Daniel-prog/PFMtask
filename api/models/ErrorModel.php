<?php
class ErrorModel extends Model {

    public function insertSusAction($token, $message) {
        $sql = "INSERT INTO sus_actions (token, sus_action)
                    VALUES(:token, :message)";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":token", $token, PDO::PARAM_STR);
        $stmt->bindValue(":message", $message, PDO::PARAM_STR);
        $stmt->execute();
    }
}