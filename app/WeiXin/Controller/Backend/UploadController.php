<?php

namespace WeiXin\Controller\Backend;

use JsonException;
use Polymer\Controller\Controller;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class UploadController extends Controller
{
    /**
     * 文件上传
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @param $args
     * @return ResponseInterface
     * @throws JsonException
     */
    public function uploadFile(ServerRequestInterface $request, ResponseInterface $response, $args): ResponseInterface
    {
        $fileNames = [];
        $uploadsDir = WEB_ROOT . DS . 'uploads';
        $uploadedFiles = $request->getUploadedFiles();
        foreach ($uploadedFiles as $key => $value) {
            $extension = pathinfo($value->getClientFilename())['extension'];
            //$filename = md5() . '.' . $extension;
            $value->moveTo($uploadsDir . DS . $value->getClientFilename());
            $fileNames[] = $value->getClientFilename();
        }
        return $this->withJson($fileNames, $response);
    }
}