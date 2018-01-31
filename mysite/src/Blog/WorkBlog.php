<?php

namespace DNADesign\Blog\Model;

/**
 * Blog Holder for Work items
 */
class WorkBlog extends DNABlog
{

    private static $table_name = 'WorkBlog';

    private static $description = 'A showcase of the work that we do.';

    private static $allowed_children = ['WorkPost'];

    public function getPosts($type = null)
    {
        return $this->get_posts('Work');
    }
}
