<?php
include_once "./Interfaces.php";

class DB {
    private $con;

    public function __construct(IDatabaseConnection $con) {
        $this->con = $con->getConnection();
    }

    public function query($sql, $params = []) {
        $stmt = $this->con->prepare($sql);
        if (!$stmt) {
            throw new Exception('Failed to prepare SQL statement: ' . $this->con->error);
        }

        if (count($params) > 0) {
            $types = '';
            $values = [];
            foreach ($params as $param) {
                if (is_int($param)) {
                    $types .= 'i';
                } elseif (is_float($param)) {
                    $types .= 'd';
                } elseif (is_string($param)) {
                    $types .= 's';
                } else {
                    $types .= 'b';
                }
                $values[] = $param;
            }

            if (!$stmt->bind_param($types, ...$values)) {
                throw new Exception('Failed to bind parameters');
            }
        }

        if (!$stmt->execute()) {
            throw new Exception('Failed to execute query: ' . $this->con->error . ' Query: ' . $sql);
        }

        $result = $stmt->get_result();
        $rows = [];

        if (strpos($sql, 'SELECT') === 0) {
            while ($row = $result->fetch_assoc()) {
                foreach ($row as $key => $value) {
                    $row[$key] = htmlspecialchars($value, ENT_QUOTES | ENT_SUBSTITUTE);
                }
                $rows[] = $row;
            }
        } elseif (strpos($sql, 'INSERT') === 0) {
            $rows = $this->con->insert_id;
        } elseif (strpos($sql, 'UPDATE') === 0 || strpos($sql, 'DELETE') === 0) {
            $rows = $this->con->affected_rows;
        }

        $stmt->close();
        return $rows;
    }
}

class MySQLiConnection implements IDatabaseConnection {
    private $host;
    private $user;
    private $pass;
    private $db;

    public function __construct($host, $user, $pass, $db) {
        $this->host = $host;
        $this->user = $user;
        $this->pass = $pass;
        $this->db = $db;
    }

    public function getConnection() {
        $con = new mysqli($this->host, $this->user, $this->pass, $this->db);
        if ($con->connect_error) {
            throw new Exception('Failed to connect to database: ' . $con->connect_error);
        }
        return $con;
    }
}
?>