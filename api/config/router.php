<?php
class Routing {

    public static function buildRoute() {

        $a = explode('?', $_SERVER['REQUEST_URI']);

        $request = $a[0];
        $method = $_SERVER['REQUEST_METHOD'];

        if ($request == GEN_URL && $method == 'POST') {
            $controllerName = 'GenerateController';
            $modelName = 'GenerateModel';

        } elseif ($request == GET_URL && $method == 'GET') {
            $controllerName = 'GetController';
            $modelName = 'GetModel';

        } elseif ($request == RM_URL && $method == 'DELETE') {
            $controllerName = 'RemoveController';
            $modelName = 'RemoveModel';

        } else {
            header('HTTP/1.1 400 Bad Request');
            http_response_code(400);
            echo json_encode(array(
                'ok' => 'false',
                'error' => 'Bad Request'
            ));
            die();
        }

        require_once CONTROLLER_PATH . $controllerName . ".php";
        require_once MODEL_PATH . $modelName . ".php";

        $controller = new $controllerName(); //переменная $controller не применяется (!!!)
    }

}