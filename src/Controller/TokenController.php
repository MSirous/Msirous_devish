<?php
namespace App\Controller;

use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class TokenController
{
    private $jwtManager;

    public function __construct(JWTTokenManagerInterface $jwtManager)
    {
        $this->jwtManager = $jwtManager;
    }

    /**
     * @Route("/api/token", name="api_token", methods={"POST"})
     */
    public function createToken(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $name = $data['name'] ?? null;

        // در اینجا باید احراز هویت کاربر را بررسی کنید
        // مثلاً با جستجوی کاربر با نام کاربری در دیتابیس

        if ($name) {
            // در صورت موفقیت، توکن را تولید کنید
            $token = $this->jwtManager->create($name);

            return new JsonResponse(['token' => $token]);
        }

        return new JsonResponse(['error' => 'Unauthorized'], 401);
    }
}
