<?php
/** @noinspection ALL */
require '/var/www/html/vendor/autoload.php';

 class DB {

    /**
     * $db     Stores the database connection
     * $coll   Stores the collection
     * $doc    Stores the document retrieved
     * $res    Stores the array fetched from the collection
     */
    private $conn, $db, $coll, $doc, $res;

    /**
     * @author Dishant Mishra
     * @version 0.1.0
     * 
     * Constructor to connect to the database.
     * Also turns error reporting off for security.
     */
    public function __construct() {
        try {
            $this->conn = new MongoDB\Client();
            $this->db = $this->conn->newsdata;
        } catch (Exception $e) {
            die ("Error in MongoDB constructor...");
        }
    }

     /**
      * @author Dishant Mishra
      * @version 0.1.0
      *
      * Fetches the default limited result set from the database.
      * For landing page use only...
      */
    public function fetchArticles() {
        try {
            $this->coll = $this->db->{'articles'};
            $cursor = $this->coll->find([],['limit' => 100, 'projection' => ['id' => 1, 'title' => 1, 'publication' => 1]]);
            foreach ($cursor as $row) {
                echo "<div class=\"box is-block is-inline-block\">";
                switch($row['publication']) {
                    case "New York Times":
                        $this->fetchImage('nyt.png');
                        break;
                    case "Breitbart":
                        $this->fetchImage('bb.jpg');
                        break;
                    case "CNN":
                        $this->fetchImage('cnn.jpg');
                        break;
                    case "Business Insider":
                        $this->fetchImage('bi.png');
                        break;
                    case "Atlantic":
                        $this->fetchImage('ta.png');
                        break;
                    case "Fox News":
                        $this->fetchImage('fn.png');
                        break;
                    case "Talking Points Memo":
                        $this->fetchImage('tpm.png');
                        break;
                    case "Buzzfeed News":
                        $this->fetchImage('bn.png');
                        break;
                    case "National Review":
                        $this->fetchImage('nr.jpg');
                        break;
                    case "New York Post":
                        $this->fetchImage('nyp.png');
                        break;
                    case "Guardian":
                        $this->fetchImage('tg.png');
                        break;
                    case "NPR":
                        $this->fetchImage('npr.jpg');
                        break;
                    case "Reuters":
                        $this->fetchImage('tr.jpg');
                        break;
                    case "Vox":
                        $this->fetchImage('vox.png');
                        break;
                    case "Washington Post":
                        $this->fetchImage('wp.png');
                        break;
                }
                echo "<div class='is-block' style='margin-left: 1rem; float: right;'>";
                foreach ($row as $key=>$col) {
                    switch ($key) {
                        case "_id":
                            $id = $col;
                            break;
                        case "publication":
                            echo "<h6 class='title is-6'>$col</h6>";
                            break;
                        case "title":
                            echo "<h1 class='subtitle is-5'>$col</h1>";
                            break;
                        default:
                            break;
                    }
                }
                echo "<br><form method='get' action='content.php'><input name='id' value='". $id ."' class='is-hidden'><input type='submit' value='Select Article' class='button is-black is-small'></form>";
                echo '</div>';
                echo "</div>";
                echo "<br>";
            }
        } catch (Exception $e) {
            die ("Error in fetchArticles()...");
        }
    }

    public function searchArticles($term, $type) {
        try {
            $this->coll = $this->db->{'articles'};
            $cursor = null;

            switch ($type) {
                case "title":
                    $cursor = $this->coll->find([$type => new \MongoDB\BSON\Regex('^.*\b'.$term.'\b.*$', 'i')],['limit' => 1000, 'projection' => ['_id' => 1, 'title' => 1, 'publication' => 1]]);
                    break;
                case "content":
                    $cursor = $this->coll->find([$type => new \MongoDB\BSON\Regex('^.*\b'.$term.'\b.*$', 'i')],['limit' => 1000, 'projection' => ['_id' => 1, 'title' => 1, 'publication' => 1]]);
                    break;
                case "author":
                    $cursor = $this->coll->find([$type => new \MongoDB\BSON\Regex('^.*\b'.$term.'\b.*$', 'i')],['limit' => 1000, 'projection' => ['_id' => 1, 'title' => 1, 'publication' => 1]]);
                    break;
                case "publication":
                    $cursor = $this->coll->find([$type => new \MongoDB\BSON\Regex('^.*\b'.$term.'\b.*$', 'i')],['limit' => 1000, 'projection' => ['_id' => 1, 'title' => 1, 'publication' => 1]]);
                    break;
                default:
                    header('Location: index.php');
                    break;
            }

            foreach ($cursor as $row) {
                echo "<div class=\"box is-block is-inline-block\">";
                switch($row['publication']) {
                    case "New York Times":
                        $this->fetchImage('nyt.png');
                        break;
                    case "Breitbart":
                        $this->fetchImage('bb.jpg');
                        break;
                    case "CNN":
                        $this->fetchImage('cnn.jpg');
                        break;
                    case "Business Insider":
                        $this->fetchImage('bi.png');
                        break;
                    case "Atlantic":
                        $this->fetchImage('ta.png');
                        break;
                    case "Fox News":
                        $this->fetchImage('fn.png');
                        break;
                    case "Talking Points Memo":
                        $this->fetchImage('tpm.png');
                        break;
                    case "Buzzfeed News":
                        $this->fetchImage('bn.png');
                        break;
                    case "National Review":
                        $this->fetchImage('nr.jpg');
                        break;
                    case "New York Post":
                        $this->fetchImage('nyp.png');
                        break;
                    case "Guardian":
                        $this->fetchImage('tg.png');
                        break;
                    case "NPR":
                        $this->fetchImage('npr.jpg');
                        break;
                    case "Reuters":
                        $this->fetchImage('tr.jpg');
                        break;
                    case "Vox":
                        $this->fetchImage('vox.png');
                        break;
                    case "Washington Post":
                        $this->fetchImage('wp.png');
                        break;
                }
                echo "<div class='is-block' style='margin-left: 1rem;  float: right;'>";
                $id = null;
                foreach ($row as $key=>$col) {
                    switch ($key) {
                        case "_id":
                            $id = $col;
                            break;
                        case "publication":
                            echo "<h6 class='title is-6'>$col</h6>";
                            break;
                        case "title":
                            echo "<h1 class='subtitle is-5'>$col</h1>";
                            break;
                        default:
                            break;
                    }
                }
                echo "<br><form method='get' action='content.php'><input name='id' value='{$id}' class='is-hidden'><input type='submit' value='Select Article' class='button is-black is-small'></form>";
                echo "</div>";
                echo "</div>";

                echo "<br>";
            }
        } catch (Exception $e) {

        }
    }

    public function selectArticle($oid) {
            try {
                $this->coll = $this->db->{'articles'};
                $cursor = $this->coll->find(['_id' => new MongoDB\BSON\ObjectId($oid)],['limit' => 100, 'projection' => ['_id' => 1, 'title' => 1, 'publication' => 1, 'date' => 1, 'author' =>1, 'content' => 1]]);
                foreach ($cursor as $row) {
                    switch($row['publication']) {
                        case "New York Times":
                            $this->fetchImage('nyt.png');
                            break;
                        case "Breitbart":
                            $this->fetchImage('bb.jpg');
                            break;
                        case "CNN":
                            $this->fetchImage('cnn.jpg');
                            break;
                        case "Business Insider":
                            $this->fetchImage('bi.png');
                            break;
                        case "Atlantic":
                            $this->fetchImage('ta.png');
                            break;
                        case "Fox News":
                            $this->fetchImage('fn.png');
                            break;
                        case "Talking Points Memo":
                            $this->fetchImage('tpm.png');
                            break;
                        case "Buzzfeed News":
                            $this->fetchImage('bn.png');
                            break;
                        case "National Review":
                            $this->fetchImage('nr.jpg');
                            break;
                        case "New York Post":
                            $this->fetchImage('nyp.png');
                            break;
                        case "Guardian":
                            $this->fetchImage('tg.png');
                            break;
                        case "NPR":
                            $this->fetchImage('npr.jpg');
                            break;
                        case "Reuters":
                            $this->fetchImage('tr.jpg');
                            break;
                        case "Vox":
                            $this->fetchImage('vox.png');
                            break;
                        case "Washington Post":
                            $this->fetchImage('wp.png');
                            break;
                    }
                    echo "<div class='is-block' style='margin-left: 1rem; float: right;'>";
                    foreach ($row as $key=>$col) {
                        switch ($key) {
                            case "_id":
                                $id = $col;
                                break;
                            case "publication":
                                echo "<span class='tag is-success'>Publication: $col</span><br>";
                                break;
                            case "author":
                                echo "<span class='tag is-danger'>Author[s]: $col</span><br>";
                                break;
                            case "date":
                                echo "<span class='tag is-black'>Published on: $col</span><br>";
                                break;
                            case "content":
                                echo "<br><p>$col</p>";
                                break;
                            case "title":
                                echo "<h1 class='subtitle is-2'>$col</h1>";
                                break;
                            default:
                                break;
                        }
                    }
                    echo "</div>";
                    echo "<br>";
                }
        } catch (Exception $e) {
            die ("Error in selectArticle()...");
        }
    }

    public function fetchComments($oid) {
        try {
            $this->coll = $this->db->{'comments'};
            $cursor = $this->coll->find(['oid' => $oid],['limit' => 100, 'projection' => ['_id' => 0, 'user' => 1, 'comment' => 1]]);
            foreach ($cursor as $row) {
                echo "<div class='box is-box'>";
                foreach ($row as $key=>$col) {
                    switch ($key) {
                        case "user":
                            echo "<h6 class='title is-6'>$col</h6>";
                            break;
                        case "comment":
                            echo "<h6 class='subtitle is-6'>$col</h6>";
                            break;
                        default:
                            break;
                    }
                }
                echo "</div><br>";
            }
        } catch (Exception $e) {
            die ("Error in fetchComments()...");
        }
    }

    public function fetchImage($filename) {
        try {
            $this->coll = $this->db->selectGridFSBucket();
            $cursor = $this->coll->openDownloadStreamByName($filename, ['revision' => -1]);
            $contents = stream_get_contents($cursor);
            $image = base64_encode($contents);
            echo '<figure class="image is-64x64 has-text-right" style="float: left;"><img src="data:jpeg;base64, '.$image.'"></figure>';
        } catch (Exception $e) {
            die ("Error in fetchImages()...");
        }
    }

    public function storeComment($user, $comment, $oid) {
        try {
            $this->coll = $this->conn->selectCollection('newsdata','comments');
            $insertOneResult = $this->coll->insertOne(['user' => $user, 'comment' => $comment, 'oid' => $oid]);
        } catch (Exception $e) {

        }
    }

    /**
     * @author Dishant Mishra
     * @version 0.1.0
     * 
     * Static function to convert BSON strins to PHP arrays.
     */
    public function toArray($bson) {
        return json_decode(MongoDB\BSON\toJSON(($bson)));
    }

 }


