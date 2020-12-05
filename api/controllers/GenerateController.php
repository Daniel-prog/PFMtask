<?php

class GenerateController extends Controller {

    public function __construct()
    {
        $this->model = new GenerateModel();
    }

    public function action()
    {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: POST");
        header("Access-Control-Max-Age: 3600");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

        $data = json_decode(file_get_contents("php://input"));

        $this->checkToken($data);
        $this->model->checkSusRequests($data->token);

        //Создаём случайную последовательность символов
        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $strength = 16; // количество символов (максимум 16)
        $chars_length = strlen($permitted_chars);
        $random_seq = '';

        for($i = 0; $i < $strength; $i++) {
            $random_character = $permitted_chars[mt_rand(0, $chars_length - 1)];
            $random_seq .= $random_character;
        }

        $id = $this->model->insert($random_seq); // Записываем последовательность в бд
        $this->model->addChange($id, $data->token);// Записываем информацию о внесённом изменении

        http_response_code(200);
        echo json_encode(array("ok" => "true", "id" => "$id"), JSON_UNESCAPED_UNICODE);

    }
}