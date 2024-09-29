<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AuthController
{
    /**
     * @Route("/api/login_check", name="api_login_check", methods={"POST"})
     */
    public function loginCheck(): Response
    {
        return new Response(null, Response::HTTP_NO_CONTENT);
    }
}
