<?php

class GetModel extends Model {

    function getStrByID($id) {
        $sql = "SELECT sequence FROM sequences WHERE id = :id";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":id", $id, PDO::PARAM_STR);
        $stmt->execute();

        $seq = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($seq['sequence'] != NULL) {
            return $seq['sequence'];
        } else {
            header('HTTP/1.1 400 Bad Request');
            http_response_code(400);
            echo json_encode(array(
                "ok" => "false",
                'error' => 'Bad Request'
            ));
            die();
        }
    }

    public function addChange($id, $token) {
        $sql = "INSERT INTO changes (string_id, action_name, user_token)
                    VALUES(:id, 'Get', :token)";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        $stmt->bindValue(":token", $token, PDO::PARAM_STR);
        $stmt->execute();
    }
}