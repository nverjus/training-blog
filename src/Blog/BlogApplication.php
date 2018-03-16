<?php
namespace Blog;

use NVFram\Application;

class BlogApplication extends Application
{
    public function __construct()
    {
        $this->name = 'Blog';
        parent::__construct();
    }

    public function run()
    {
    }
}
