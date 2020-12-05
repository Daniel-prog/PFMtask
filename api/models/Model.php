<?php

class Model {
    protected $db = null;

    public function __construct() {
        $this->db = DB::db_connect();
    }

    public function checkTokenInDB($token) {
        $sql = "SELECT EXISTS(SELECT 1 FROM permitted_tokens WHERE token =:token LIMIT 1)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':token', $token, PDO::PARAM_STR);
        $stmt->execute();

        if ($stmt->fetchColumn()) {
            return true;
        } else {
            return false;
        }
    }

    public function checkIDInDB($id) {
        $sql = "SELECT EXISTS(SELECT 1 FROM sequences WHERE id =:id LIMIT 1)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        if ($stmt->fetchColumn()) {
            return true;
        } else {
            return false;
        }
    }

    public function checkSusRequests($token) {
        $current_time = date("Y-m-d H:i:s", time());
        $timeBefore = date("Y-m-d H:i:s", time() - 2);
        $sql = "SELECT * FROM `changes` WHERE user_token =:token AND `time_of_change` BETWEEN :timeBefore
                AND :curTime";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':token', $token, PDO::PARAM_INT);
        $stmt->bindValue(':timeBefore', $timeBefore, PDO::PARAM_STR);
        $stmt->bindValue(':curTime', $current_time, PDO::PARAM_STR);
        $stmt->execute();

        if ($stmt->rowCount() > 3) {

            $sql = "INSERT INTO sus_actions (token, sus_action)
                    VALUES(:token, 'Calling the method more than 3 times per two seconds')";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':token', $data->token, PDO::PARAM_INT);
            $stmt->execute();
        }
    }
}