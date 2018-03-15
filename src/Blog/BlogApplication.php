<?php
namespace Blog;

use NVFram\Application;

class BlogApplication extends Application
{
    public function __construct()
    {
        parent::__construct();
        $this->name = 'Blog';
    }

    public function run()
    {
    }
}
