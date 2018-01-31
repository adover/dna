<?php

namespace DNADesign\Blog\Model;

use DNADesign\Blog\Model\DNABlog;

/**
 * Blog Holder for Insight items
 */
class InsightBlog extends DNABlog
{

    private static $table_name = 'InsightBlog';

    private static $description = 'The insights blog';

    private static $allowed_children = ['InsightPost'];

    public function getPosts($type = null)
    {
        return $this->get_posts('Insights');
    }
}
