<?php

class RemoveController extends Controller {

    public function __construct()
    {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: DELETE");
        header("Access-Control-Max-Age: 3600");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

        $this->model = new RemoveModel();

        $data = json_decode(file_get_contents("php://input"));

        $this->checkToken($data);
        $id = $this->checkID($data);

        $this->model->remove($id);

        $this->model->addChange($id, $data->token);

        http_response_code(200);
        echo json_encode(array("ok" => "true", "message" => "String removed."), JSON_UNESCAPED_UNICODE);
    }
}