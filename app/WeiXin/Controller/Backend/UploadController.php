<?php

namespace WeiXin\Controller\Backend;

use Exception;
use JsonException;
use Polymer\Controller\Controller;
use Polymer\Utils\FuncUtils;
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
     * @throws Exception
     */
    public function uploadFile(ServerRequestInterface $request, ResponseInterface $response, $args): ResponseInterface
    {
        $fileNames = [];
        $uploadsDir = WEB_ROOT . DS . 'uploads';
        $uploadedFiles = $request->getUploadedFiles();
        foreach ($uploadedFiles as $key => $file) {
            $extension = pathinfo($file->getClientFilename())['extension'];
            $filename = FuncUtils::generateSalt(16) . '.' . $extension;
            $file->moveTo($uploadsDir . DS . $filename);
            $fileNames[] = $filename;
        }
        return $this->withJson($fileNames, $response);
    }
}