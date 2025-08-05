<?php
namespace App\Services;

class CalcDamageService {

    public function execute(int $base, $mult, int $atk_type) {
        $damage = round($base + ($mult * $atk_type));
        return $damage;
    }
}
