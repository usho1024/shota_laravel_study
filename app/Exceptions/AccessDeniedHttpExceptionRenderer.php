<?php

namespace App\Exceptions;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class AccessDeniedHttpExceptionRenderer
{
    /**
     * URL毎に403エラーメッセージを返す
     * 
     * @param AccessDeniedHttpException $e
     * @param Request $request
     * @return Response
     */
    public function render(AccessDeniedHttpException $e, Request $request): Response
    {
        $message = '';

        if ($request->routeIs('posts.*')) {
            $message = 'この投稿に対する権限がありません。';
        }

        $data = [
            'message' => $message,
        ];

        return response()->view('errors.403', $data, 403);
    }
}