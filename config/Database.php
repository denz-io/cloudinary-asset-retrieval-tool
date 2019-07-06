 <?php


class Database 
{
    public function mysqlConnection()
    {
        global $myslq_conn;
         
        $servername = env(MYSQL_SERVER);
        $username   = env(USERNAME);
        $password   = env(PASSWORD);
        $dbname     = env(DB_NAME); 

        $mysql_conn = new mysqli($servername, $username, $password, $dbname);

        if ($mysql_conn->connect_error) {
            die("Connection failed: " . $mysql_conn->connect_error);
        }

        return $mysql_conn;
    }

}
