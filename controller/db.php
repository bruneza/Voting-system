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
  
  public function getall() {
    $table = $this->table;
    try {
      $conn = $this->db();
      $sql = $sql = "select * from $table ;";
      $stmt = $conn->prepare( $sql );
      if ( $stmt->execute() ) {
        return $stmt->fetchall( PDO::FETCH_ASSOC );
      }

    } catch ( PDOException $e ) {
      echo "Error: " . $sql . $e->getMessage();
    }
    return "failed config";
  }


  public function insert( $array ) {
    $vnum = count( $array ) - 1;
    // $fields = implode( ',', array_keys( $array ) );  for Fields
    $conn = $this->db();
    $table = $this->table;
    $sql = "insert into $table values (" . str_repeat( '? , ', $vnum ) . " ? )";
    try {
      // $conn->prepare( $sql )->execute( array_values( $array ) ); if fields are specified
      $conn->prepare( $sql )->execute( $array ); 
      return true;
    } catch ( PDOException $e ) {
      echo "Error: " . $sql . $e->getMessage();
      return false;
    }
  } 
}




// class votesDB {
//   private $expiry = true;
//   private $ip;
//   private $voted;
//   private $time;
//   private $table;
//     private $vote;
//   public function __construct( $ip ) {
//     $this->ip = $ip;
//     $this->table = new dbConnect( 'visitors' );
//     $this->vote = new dbConnect( 'nominees' );
//     //      $var =$table->getAndOr( array('ip'=>$ip,'vote'=>$voted), 'and' );
//     //      if(count($var)>0){
//     //          $this->expiry = $var['visi_recent_time'];
//     //      }
//   }
//   private function timeExpired( $time ) {
//     $savedtime = date_create( $time );
//     $difftime = date_diff( date_create( date( 'Y-m-d H:i:s' ) ), $savedtime )->format( '%R%i' );
//     if ( $difftime > 15 ) {
//       return true;
//     }
//     return false;
//   }
//   private function checkExpiry( $voted, $category ) {
//     $array = array();
//     $array1 = array();
//     $array2 = array();
//     $voteip = $this->table->getby( 'ip', $this->ip );
//     foreach ( $voteip as $key => $values ) {
//       array_push( $array, array_values( $values )[ 3 ] );
//       array_push( $array1, array_values( $values )[ 2 ] );
//       array_push( $array2, array_values( $values )[ 4 ] );

//     }
//     $voteinfo = array_combine( $array, $array1 );
//     foreach ( $voteinfo as $key => $value ) {
//       if ( $voted == $key || in_array( $category, $array2 ) ) {
//         if ( !$this->timeExpired( $value ) )
//           $this->expiry = false;
//       }
//     }
//     return $this->expiry;
//   }
//   private function insertDB( $voted, $category, $curtime ) {
//     if ( $this->table->insert( array( 'visi_ip' => $this->ip, 'visi_voted' => $voted, 'visi_recent_time' => $curtime->format( 'Y-m-d H:i:s' ), 'cat_voted' => $category ) ) )
//       return "Urakoze gutora";
//     else
//       return "Watoye";
//   }
//   public function savevisitor( $voted, $category ) {
//     $curtime = date_create( date( 'Y-m-d H:i:s' ) );

//     if ( !$this->table->getby( 'ip', $this->ip ) ) {
//       $this->insertDB( $voted, $category, $curtime );
//         //added
//         $getvote = $this->vote->getby( 'id', $voted );
//             $add = array_values($getvote[0])[3]+1;
//        if( $this->vote->update(array('nom_votes'=>$add),'id',$voted))
//            return $add; 
//     } else {
//       if ( $this->checkExpiry( $voted, $category ) ) {
//         $this->insertDB( $voted, $category, $curtime );
//           //added
//         $getvote = $this->vote->getby( 'id', $voted );
//             $add = array_values($getvote[0])[3]+1;
//         if( $this->vote->update(array('nom_votes'=>$add),'id',$voted))
//            return $add;
//       } else {
//         return "Watoye";
//       }
//     }
//   }
// }
?>