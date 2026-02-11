<?php

namespace App\Controller;

use App\Repository\DechetRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

class MapDechetController extends AbstractController
{
    #[Route('/api/map/dechets/mine', name: 'api_map_dechets_mine', methods: ['GET'])]
    public function mine(DechetRepository $repo): JsonResponse
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        $user = $this->getUser();
        if (!$user) {
            return $this->json(['error' => 'Unauthorized'], 401);
        }

        $rows = $repo->findForMapByUser($user);

        // Format createdAt pour JS
        foreach ($rows as &$r) {
            if (isset($r['createdAt']) && $r['createdAt'] instanceof \DateTimeInterface) {
                $r['createdAt'] = $r['createdAt']->format('d/m/Y H:i');
            }
        }

        return $this->json($rows);
    }
}
