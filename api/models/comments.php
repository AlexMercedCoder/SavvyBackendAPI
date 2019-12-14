<?PHP

$DBURL = getenv('DATABASE_URL');

$dsn="psql:host=$DBURL;dbname=d3qvmqtmq9s8b user=cticedgggntdqf;user=cticedgggntdqf;port=5432;password=5d17168b471db3b178e8ede79d5f92605d765375ea153444cd403c0a544f2146";

$db = new PDO($dsn);

// $dbconn = pg_connect("host=$DBURL dbname=d3qvmqtmq9s8b user=cticedgggntdqf port=5432 password=5d17168b471db3b178e8ede79d5f92605d765375ea153444cd403c0a544f2146");
// (id SERIAL, restid int, author varchar(30), comment varchar(140), password varchar(8), date timestamp DEFAULT now())

class Comment {
    public $id;
    public $restid;
    public $author;
    public $comment;
    public $password;
    public $date

    public function __construct($id, $restid, $estValue, $comment, $password, $date) {
        $this->id = $id;
        $this->restid = $restid;
        $this->author = $author;
        $this->comment = $comment;
        $this->password = $password;
        $this->date = $date;
    }
}

class Comments {



    static function all(){
        //create an empty array
        $comments = array();

        //query the database
        $results = pg_query("SELECT * FROM comments");

        $row_object = pg_fetch_object($results);
        // var_dump($row_object);
        while($row_object){

                    $new_comment = new Comment(
                        intval($row_object->id),
                        intval($row_object->restid),
                        intval$row_object->author,
                        $row_object->comment,
                        $row_object->password,
                        $row_object->date

                    );
                    $comments[] = $new_comment;

                    // print_r($comments);
                    $row_object = pg_fetch_object($results);
                }

        // die(); //halt execution

        // print_r($comments);
        return $comments;
    }


    static function create($comment){
        $query = "INSERT INTO comments (restid, author, comment, password, date) VALUES ($1, $2, $3, $4, $5)";
        $query_params = array($comment->restid, $comment->author, $comment->comment, $comment->password, $comment->date);
        pg_query_params($query, $query_params);
        return self::all();
    }

    static function update($updated_comment){
        $query = "UPDATE comments SET restid = $1, author = $2, comment = $3, password=$4, date = $5 WHERE id = $6";
        $query_params = array($updated_comment->restid, $updated_comment->author, $updated_comment->comment, $updated_comment->password,$updated_comment->date,$updated_comment->id);
        $result = pg_query_params($query, $query_params);

        return self::all();
    }

    static function delete($id){
    $query = "DELETE FROM comments WHERE id = $1";
    $query_params = array($id);
    $result = pg_query_params($query, $query_params);

    return self::all();
    }



}


?>
