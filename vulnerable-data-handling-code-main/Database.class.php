<?

include __DIR__ . '/index.php';

class Database
{
    public static $conn;
    public static function dbconnection()
    {
        if (Database::$conn == null) {
            if (isset($_POST['username']) && isset($_POST['userid']) && isset($_POST['profession'])) {
                $configfile = $_SERVER['DOCUMENT_ROOT'].'/../jsonconfig.json';
                $config = json_decode(file_get_contents($configfile),true);
                $servername = $config['db_server_name'];
                $usernames = $config['db_user_name'];
                $password = $config['db_password'];
                $databasename = $config['db_name'];

                $connection = new mysqli($servername, $usernames, $password, $databasename);

                $pattern = "/[()']/i";
                $uname = preg_replace($pattern, "", strip_tags($_POST['username']));
                $uid = preg_replace($pattern, "", strip_tags($_POST['userid']));
                $prof = preg_replace($pattern, "", strip_tags($_POST['profession']));

                if ($connection->connect_error) {
                    echo "Error Occured " . $connection->connect_error;
                } else {
                    $sql = "INSERT INTO userentry(UserName,UserID,Profession)VALUES('$uname','$uid','$prof')";
                    if ($connection->query($sql) == true) {
                        echo "Data uploaded Successfuly";
                        Database::$conn=$connection;
                        return Database::$conn;
                    } else {
                        echo "Problem Occured " . $connection->error;
                    }
                }
            }
        }else {
            echo "Using Existing Connection";
            return Database::$conn;
        }
    }
}

Database::dbconnection();
