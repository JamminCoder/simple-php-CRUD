<?php


class BlogpostController {
    public $dbConn;
    public string $username;

    public function __construct($username) {
        $this->dbConn = $GLOBALS["dbConn"];
        $this->username = $username;
    }

    public function createPost($postTitle, $postBody, $postID) {
        if ($this->username !== null) {
            $query = "INSERT INTO posts (post_title, post_body, post_author, post_id) VALUES (:post_title, :post_body, :post_author, :post_id);";
            $stmt = $this->dbConn->prepare($query);

            $stmt->execute([
                "post_title" => $postTitle,
                "post_body" => $postBody,
                "post_author" => $this->username,
                "post_id" => $postID
            ]);
        }
        
    }

    public function getUsersPosts() {
        $query = "SELECT * FROM posts WHERE post_author = (:post_author);";
        $stmt = $this->dbConn->prepare($query);

        $stmt->execute([
            "post_author" => $this->username
        ]);

        $rows = $stmt->fetch();

        if ($rows) {
            return $rows;
        } else {
            return false;
        }
    }

    public function editPost($newTitle, $newBody, $postID) {
        $query = "UPDATE posts SET post_title = (:post_title), post_body = (:post_body) WHERE post_id = (:post_id) AND post_author = (:post_author);";
        $stmt = $this->dbConn->prepare($query);

        $stmt->execute([
            "post_title" => $newTitle,
            "post_body" => $newBody,
            "post_id" => $postID,
            "post_author" => $this->username
        ]);
    }

}