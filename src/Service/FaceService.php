<?php

namespace App\Service;

class FaceService
{
    // Seuil classique (à ajuster). Plus bas = plus strict.
    private float $threshold = 0.55;

    public function distance(array $a, array $b): float
    {
        if (count($a) !== count($b) || count($a) === 0) {
            return 999.0;
        }

        $sum = 0.0;
        $n = count($a);

        for ($i = 0; $i < $n; $i++) {
            $da = (float) $a[$i];
            $db = (float) $b[$i];
            $sum += ($da - $db) * ($da - $db);
        }

        return sqrt($sum);
    }

    public function isMatch(array $stored, array $probe): bool
    {
        return $this->distance($stored, $probe) <= $this->threshold;
    }
}
