<?php
namespace Blog\Controller;

use NVFram\Controller;
use NVFram\Request;

class TestController extends Controller
{
    public function executeTest(Request $request)
    {
        return '1234';
    }
}
