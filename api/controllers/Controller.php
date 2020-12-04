<?php

class Controller {

    protected $model;

    public function __construct()
    {
        $this->model = new Model();
    }

    protected function checkToken($data) {
        if (!isset($data->token) || !$this->model->checkTokenInDB($data->token)) {

            header('HTTP/1.1 403 Access denied');
            http_response_code(403);
            echo json_encode(array(
                "ok" => "false",
                'error' => 'Access denied'
            ));
            die();
        }
    }

    protected function checkID($data) {
        if (isset($data->id) && $this->model->checkIDInDB($data->id)) {
            return (int)$data->id;
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
}