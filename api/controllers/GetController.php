<?php

class GetController extends Controller {

    public function __construct()
    {
        $this->model = new GetModel();
    }

    public function action()
    {
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Headers: access");
        header("Access-Control-Allow-Methods: GET");
        header("Access-Control-Allow-Credentials: true");
        header("Content-Type: application/json");

        $data = json_decode(file_get_contents("php://input"));

        $this->checkToken($data);
        $id = $this->checkID($data);
        $this->model->checkSusRequests($data->token);

        $seq = $this->model->getStrByID($id);
        $this->model->addChange($id, $data->token);

        http_response_code(200);
        echo json_encode(array("ok" => "true", "string" => "$seq"), JSON_UNESCAPED_UNICODE);
    }
}