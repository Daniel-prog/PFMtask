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
}