<?php

class RemoveController {

    private $model;

    public function __construct()
    {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: DELETE");
        header("Access-Control-Max-Age: 3600");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

        $this->model = new RemoveModel();

        $data = json_decode(file_get_contents("php://input"));

        if (isset($data->id)) {
            $id = (int)$data->id;
        } else {
            header('HTTP/1.1 400 Bad Request');
            http_response_code(400);
            echo json_encode(array(
                "ok" => "false",
                'error' => 'Bad Request'
            ));
            die();
        }

        $this->model->remove($id);

        http_response_code(200);
        echo json_encode(array("ok" => "true", "message" => "String removed."), JSON_UNESCAPED_UNICODE);
    }
}