<?php

function POSTS_getPostInfo($postID)
{
    $post = MySQL_runSQL("SELECT * FROM posts WHERE postID = '$postID';");

    if (count($post) != 0) {
        return $post[0];
    } else {
        return false;
    }
}

function POSTS_getAllPosts()
{
    $posts = MySQL_runSQL('SELECT * FROM posts');
    return $posts;
}

function POSTS_approve($postID)
{
    $sql = "UPDATE posts SET approveStatus='1' WHERE postID = '$postID';";

    return MySQL_runSQL($sql);
}
function POSTS_refuse($postID)
{
    $sql = "UPDATE posts SET approveStatus='0' WHERE postID = '$postID';";

    return MySQL_runSQL($sql);
}
