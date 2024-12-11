<?php
namespace Lib;

class Pages {
    public function render(string $view, array $data = []) {
        extract($data);
        require_once __DIR__ . '/../Views/' . $view . '.php';
    }
}
?>
