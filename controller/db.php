<?php
//setup db variables
class dbConnect {
  private $username;
  private $password;
  private $table;
  public function __construct( $table ) {
    $this->username = 'bruce';
    $this->password = 'rwanda';
	   if($table){
      $this->table = 'isang0_'.$table;
     }
  }

  public function getTable() {
    return $this->table;
  }

  
  private function db() {
    $servername = "127.0.0.1";
    $db = "isango21";
    try {
      $conn = new PDO( "mysql:host=$servername;dbname=$db", $this->username, $this->password );
      // set the PDO error mode to exception
      $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
      return $conn;
    } catch ( PDOException $e ) {
      return $e->getMessage();
    }
  }

  private function getPrimary(){
   $table = $this->table;
    try {
      $conn = $this->db();
      $sql = "SHOW KEYS FROM $table WHERE Key_name = 'PRIMARY'";
      $stmt = $conn->prepare( $sql );
      if ( $stmt->execute() ) {
        $result = $stmt->fetch( PDO::FETCH_ASSOC );
        return $result['Column_name'];
      }

    } catch ( PDOException $e ) {
      echo "Error: " . $sql . $e->getMessage();
    }
    return "no primary key";
}

  public function getall() {
    $table = $this->table;
    try {
      $conn = $this->db();
      $sql = "select * from $table ;";
      $stmt = $conn->prepare( $sql );
      if ( $stmt->execute() ) {
        return $stmt->fetchall( PDO::FETCH_ASSOC );
      }

    } catch ( PDOException $e ) {
      echo "Error: " . $sql . $e->getMessage();
    }
    return "failed config";
  }

  public function getAnd( $array ) {
    $conn = $this->db();
    $table = $this->table;
    $condKeys= implode( '=? and ', array_keys( $array ) ).'=?;';
    $sql = "select * from $table Where $condKeys";
     try {
    $stmt = $conn->prepare( $sql );
        if ( $stmt->execute(array_values( $array ) )) {
          return $stmt->fetchall( PDO::FETCH_ASSOC );
        }
      }
    catch ( PDOException $e ) {
      echo "Error: " . $sql . $e->getMessage();
    }
    return "failed config";
  }




  public function insert( $array ) {
    $vnum = count( $array ) - 1;
    $conn = $this->db();
    $table = $this->table;
    $sql = "insert into $table values (" . str_repeat( '? , ', $vnum ) . " ? ";
    try {
      $conn->prepare( $sql )->execute( $array ); 
      return true;
    } catch ( PDOException $e ) {
      echo "Error: " . $sql . $e->getMessage();
      return false;
    }
  }

 public function update( $changes, $id ) {
    $conn = $this->db();
    $table = $this->table;
    foreach($changes as $key=>$value){
      $changeField[]="$key = '$value'";
    }
    $sql = "UPDATE $table SET " . implode( ',', array_values( $changeField ) ) ." Where ".$this->getPrimary()." = $id;";
    try {
      $conn->prepare( $sql )->execute();
      return true;
    } catch ( PDOException $e ) {
      echo "Error: " . $sql . $e->getMessage();
      return false;
    }
  }
 public function delete($id ) {
    $conn = $this->db();
    $table = $this->table;
    $sql = "DELETE from $table Where ".$this->getPrimary()." = $id;";
    try {
      $conn->prepare( $sql )->execute();
      return true;
    } catch ( PDOException $e ) {
      echo "Error: " . $sql . $e->getMessage();
      return false;
    }
  }

}

?>