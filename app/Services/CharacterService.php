<?php

namespace App\Services;

class CharacterService
{
    public $str;
    public $cha;
    public $dex;
    public $hp;
    public $chakra;
    public $ninjutsu;
    public $speed;
    public $taijutsu;
    public $kenjutsu;

    public function __construct(
        $str = null,
        $cha = null,
        $dex = null,
        $user_id = null,
    )
    {
        // Helzen
        if ($user_id === '268068444237201410') {

            $this->str = 100;
            $this->cha = 1200;
            $this->dex = 950;

            $multipliers = [
              'hp' => 20,
              'chakra' => 70,
              'ninjutsu' => 50,
              'speed' => 50,
              'taijutsu' => 30,
              'kenjutsu' => 0,
            ];

            $equipment_bonus = [
                'hp' => 6,
                'chakra' => 8,
                'ninjutsu' => 0,
                'speed' => 0,
                'taijutsu' => 0,
                'kenjutsu' => 0,
            ];

        // MVN
        } elseif ($user_id === '265279165010411521') {

            $this->str = 200;
            $this->cha = 1750;
            $this->dex = 300;

            $multipliers = [
                'hp' => 25,
                'chakra' => 70,
                'ninjutsu' => 70,
                'speed' => 50,
                'taijutsu' => 10,
                'kenjutsu' => 0,
            ];

            $equipment_bonus = [
                'hp' => 0,
                'chakra' => 0,
                'ninjutsu' => 0,
                'speed' => 0,
                'taijutsu' => 0,
                'kenjutsu' => 0,
            ];

        // Cayo '386225545819586562'
        } elseif ($user_id === '1011095226468806697') {
            $this->str = 200;
            $this->cha = 870;
            $this->dex = 1000;

            $multipliers = [
                'hp' => 30,
                'chakra' => 60,
                'ninjutsu' => 55,
                'speed' => 40,
                'taijutsu' => 40,
                'kenjutsu' => 0,
            ];

            $equipment_bonus = [
                'hp' => 0,
                'chakra' => 0,
                'ninjutsu' => 0,
                'speed' => 0,
                'taijutsu' => 0,
                'kenjutsu' => 0,
            ];
        }

        $this->hp = round(($this->str * 0.75 + $this->cha * 0.4 + $this->dex * 0.5) * (1 + ($multipliers['hp'] / 100)) * (1 + ($equipment_bonus['hp'] / 100)));
        $this->chakra = round(($this->cha * 0.5) * (1 + ($multipliers['chakra'] / 100)) * (1 + ($equipment_bonus['chakra'] / 100)));
        $this->ninjutsu = round(($this->cha * 0.2 + $this->dex * 0.1) * (1 + ($multipliers['ninjutsu'] / 100)) * (1 + ($equipment_bonus['ninjutsu'] / 100)));
        $this->speed = round(($this->dex * 0.1) * (1 + ($multipliers['speed'] / 100)) * (1 + ($equipment_bonus['speed'] / 100)));
        $this->taijutsu = round(($this->str * 0.2 + $this->dex * 0.1) * (1 + ($multipliers['taijutsu'] / 100)) * (1 + ($equipment_bonus['taijutsu'] / 100)));
        $this->kenjutsu = round(($this->dex * 0.2) * (1 + ($multipliers['kenjutsu'] / 100)) * (1 + ($equipment_bonus['kenjutsu'] / 100)));
    }
}