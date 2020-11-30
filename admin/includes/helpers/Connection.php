<?php

class Connection
{
    const HOST     = 'guaraci-db.cvv1mrt2tufo.sa-east-1.rds.amazonaws.com';
    const DATABASE = 'guaraci-db';
    const PORT     = 3306;
    const USERNAME = 'guaraci';
    const PASSWORD = '!2020#Guara#123';

    private $conn;

    private function connect()
    {
        try {
            $this->conn = mysqli_connect(self::HOST, self::USERNAME, self::PASSWORD);
        } catch (mysqli_sql_exception $e) {
            throw $e;
        }
    }

    private function destroy()
    {
        mysqli_close($this->conn);
    }

    public function run($query)
    {
        // Escaping Characters
        $query = str_replace('"', '\"', $query);
        
        // Init connection
        $conn = $this->connect();
        
        // Query running
        $response = mysqli_query($this->conn, $query);
        
        // Parsing return
        $result = [];
        if ($response->num_rows > 0) {

            while ($row = mysqli_fetch_assoc($response)) {
                $result[] = $row;
            }
        }

        // Destroy connection
        $this->destroy();
        
        return $result;
    }
}