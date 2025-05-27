<?php

namespace App\Exceptions;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class NotFoundHttpExceptionRenderer
{
    /**
     * URL毎に404エラーメッセージを返す
     * 
     * @param NotFoundHttpException $e
     * @param Request $request
     * @return Response
     */
    public function render(NotFoundHttpException $e, Request $request): Response
    {
        $message = '';

        if ($request->routeIs('posts.*')) {
            $message = '削除されたもしくは存在しない投稿です。';
        }

        $data = [
            'message' => $message,
        ];

        return response()->view('errors.404', $data, 404);
    }
}