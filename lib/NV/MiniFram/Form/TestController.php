<?php
namespace Blog\Controller;

use NV\MiniFram\Controller;
use NV\MiniFram\Request;

class TestController extends Controller
{
    public function executeTest(Request $request)
    {
        return '1234';
    }
}
