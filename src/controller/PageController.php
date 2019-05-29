<?php

namespace wor\controller;

use wor\lib\mvc\Controller;
use wor\service\DataTool;

/**
 * Class PageController
 *
 * @package wor\controller
 */
class PageController extends Controller
{
    /*
    public function __construct()
    {
        parent::register("/upload", "GET", array($this, "uploadPage"));
        parent::register("/upload", "POST", array($this, "uploadFile"));
    }
    */

    /**
     * @GetMapping(url="/upload")
     */
    public function uploadPage()
    {
        return "file_test.php";
    }

    /**
     * @PostMapping(url="/upload")
     */
    public function uploadFile()
    {
        $fileInfo = self::getRequestContext()->getFileInfo();

        // 오류 확인
        $error = $fileInfo["userfile"]["error"];
        if ($error != UPLOAD_ERR_OK) {
            switch ($error) {
                case UPLOAD_ERR_INI_SIZE:
                case UPLOAD_ERR_FORM_SIZE:
                    echo "파일이 너무 큽니다. ($error)";
                    break;
                case UPLOAD_ERR_NO_FILE:
                    echo "파일이 첨부되지 않았습니다. ($error)";
                    break;
                default:
                    echo "파일이 제대로 업로드되지 않았습니다. ($error)";
            }
        }

        $fileName = $fileInfo["userfile"]["tmp_name"];

        DataTool::csv2MySql($fileName);

        return "index.html";
    }
}