<?php
class ErrorController extends Controller {

    public function __construct()
    {
        $this->model = new ErrorModel();
    }

    public function action()
    {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: *");
        header("Access-Control-Max-Age: 3600");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

        $data = json_decode(file_get_contents("php://input"));

        $this->checkToken($data);

        $method = $_SERVER['REQUEST_METHOD'];
        $url = $_SERVER['REQUEST_URI'];

        $susActionMessage = "User with token '{$data->token}' tried to access url '{$url}' with method '{$method}'!";

        $this->model->insertSusAction($data->token, $susActionMessage);

        header('HTTP/1.1 400 Bad Request');
        http_response_code(400);
        echo json_encode(array(
            'ok' => 'false',
            'error' => 'Bad Request'
        ));
        die();
    }
}