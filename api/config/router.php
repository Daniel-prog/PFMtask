<?php
//Класс роутинга

class Routing {

    public static function buildRoute() {

        $a = explode('?', $_SERVER['REQUEST_URI']);

        $request = $a[0];
        $method = $_SERVER['REQUEST_METHOD'];

        //POST /api/generate (возвращает идентификатор сгенерированной строки)
        if ($request == GEN_URL && $method == 'POST') {
            $controllerName = 'GenerateController';
            $modelName = 'GenerateModel';

            //GET /api/by-id (возвращает строку по идентификатору)
        } elseif ($request == GET_URL && $method == 'GET') {
            $controllerName = 'GetController';
            $modelName = 'GetModel';

            //DELETE /api/remove (удаление строки по идентификатору)
        } elseif ($request == RM_URL && $method == 'DELETE') {
            $controllerName = 'RemoveController';
            $modelName = 'RemoveModel';

            //При неправильных запросах
        } else {
            $controllerName = 'ErrorController';
            $modelName = 'ErrorModel';
        }

        require_once CONTROLLER_PATH . $controllerName . ".php";
        require_once MODEL_PATH . $modelName . ".php";

        $controller = new $controllerName();
        $controller->action();
    }

}