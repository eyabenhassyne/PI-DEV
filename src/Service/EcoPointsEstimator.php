<?php

namespace App\Service;

class EcoPointsEstimator
{
    public function estimate(string $type, float $quantiteKg): int
    {
        $type = mb_strtolower(trim($type));

        $rules = [
            'plastique' => 5,
            'papier'    => 3,
            'verre'     => 4,
            'metal'     => 8,
        ];

        $rate = $rules[$type] ?? 2; // default
        return (int) round($rate * $quantiteKg);
    }
}
