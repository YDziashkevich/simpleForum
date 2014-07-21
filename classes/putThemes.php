<?php
class putTheme{
    private $titleId;
    private $tagTheme=array();

    public function __construct($host="localhost", $dbName="forum_st", $user="root", $password=""){
        try{
            $this->db = new PDO("mysql: host=$host; dbname=$dbName", $user, $password);
            $this->db->exec("set names utf8");
        }
        catch (PDOException $e){
            echo $e->getMessage();
        }
    }
    public function __destruct(){
        $this->db=null;
    }

    public function putTag(){
        foreach($this->tagTheme as $tag){
            $queryTag=$this->db->prepare("SELECT tagName FROM f_tag WHERE tagName=:tagName");
            $queryTag->bindParam(':tagName', $tag["tagName"]);
            $queryTag->execute();
            $count = count($queryTag->fetchAll(PDO::FETCH_ASSOC));
            if($count==0){
                $insertTag=$this->db->prepare("INSERT INTO f_tag (tagName) VALUE (:tagName)");
                $insertTag->bindParam(':tagName', $tag["tagName"]);
                $insertTag->execute();
                $queryTagId=$this->db->prepare("SELECT tagId FROM f_tag WHERE tagName=:tagName");
                $queryTagId->bindParam(':tagName', $tag["tagName"]);
                $queryTagId->execute();
                $tagDb=$queryTagId->fetchAll(PDO::FETCH_ASSOC);
                $insertTTP=$this->db->prepare("INSERT INTO f_tag_to_post (tagId, postId) VALUE (:tagId, :postId)");
                $insertTTP->bindParam(':tagId', $tagDb["id"]);
                $insertTTP->bindParam(':postId', $this->titleId);
                $insertTTP->execute();
            }else{
                $queryTagId=$this->db->prepare("SELECT tagId FROM f_tag WHERE tagName=:tagName");
                $queryTagId->bindParam(':tagName', $tag["tagName"]);
                $queryTagId->execute();
                $tagDb=$queryTagId->fetchAll(PDO::FETCH_ASSOC);
                $insertTTP=$this->db->prepare("INSERT INTO f_tag_to_post (tagId, postId) VALUE (:tagId, :postId)");
                $insertTTP->bindParam(':tagId', $tagDb["id"]);
                $insertTTP->bindParam(':postId', $this->titleId);
                $insertTTP->execute();
            }
        }
    }


}