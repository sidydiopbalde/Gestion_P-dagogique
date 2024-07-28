<?php
namespace Core;
// use App\Core\Validator\Validator1;

interface ControllerInterface {
    public function renderView(string $view, array $data = []);
    public function redirect(string $url);
}