<?php 
class voteController{
	private $ips;
	private $visitorIp;
	private $nomChosen;
	private $catChosen;
	private $nomVoted;
	private $catVoted;
	private $db;
	private $expiry = true;

	public function __construct($vip,$nomChosen,$catChosen){
		$dbnew = new dbConnect( 'visitors' );
		$this->visitorIp = $vip;
		$this->nomChosen = $nomChosen;
		$this->catChosen = $catChosen;
		$this->db = $dbnew;
		$voteList = $dbnew->getall();

		foreach($voteList as $voteRec){
		    $id[] = $voteRec['visi_id'];
    		$ips[] = $voteRec['visi_ip'];
    		$rtime[] = $voteRec['visi_recent_time'];
    		$voted[] = $voteRec['visi_voted'];
    		$cvoted[] = $voteRec['cat_voted'];
		}
		$this->ips = array_combine($id,$ips);
		$this->recentTime = array_combine($id,$rtime);
		$this->nomVoted = array_combine($id,$voted);
		$this->catVoted = array_combine($id,$cvoted);


	}
	 private function timeExpired( $time ) {
    $savedtime = date_create( $time );
    $difftime = date_diff( date_create( date( 'Y-m-d H:i:s' ) ), $savedtime )->format( '%R%i' );
    if ( $difftime > 15 ) {
      return 1;
    }
    return 0;
  }
	public function checkOrVote(){
		$visitorIp = $this->visitorIp;
		$ips = $this->ips;
		$table = $this->db;
		$enterCheck=[];
		if($this->visitorIp)
			$enterCheck += array('visi_ip'=> $this->visitorIp);
		if($this->nomChosen)
			$enterCheck += array('visi_voted'=>$this->nomChosen);
		if($this->catChosen)
			$enterCheck += array('cat_voted'=>$this->catChosen);

		if($result = $table->getAnd( $enterCheck)){
			foreach($result as $res){
				$recentTime = $res['visi_recent_time'];
				
				$this->timeExpired($recentTime);
			}
		}else{
			echo "not found";
		}

	}
	public function get_ip(){
		return $this->ips;
	}
	public function addVote($insertArray){
		$this->db->insert($insertArray);
	}





//   private function checkExpiry( $voted, $category ) {
//     $array = array();
//     $array1 = array();
//     $array2 = array();
//     $voteip = $this->table->getby( 'ip', $this->ips );
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
//     if ( $this->table->insert( array( 'visi_ip' => $this->ips, 'visi_voted' => $voted, 'visi_recent_time' => $curtime->format( 'Y-m-d H:i:s' ), 'cat_voted' => $category ) ) )
//       return "Urakoze gutora";
//     else
//       return "Watoye";
//   }
//   public function savevisitor( $voted, $category ) {
//     $curtime = date_create( date( 'Y-m-d H:i:s' ) );

//     if ( !$this->table->getby( 'ip', $this->ips ) ) {
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
	
	}

 ?>