<?php 
class voteController{
	private $ips;
	private $visitorIp;
	private $nomChosen;
	private $catChosen;
	private $nomVoted;
	private $catVoted;
	private $db;
	private $canVote;

	public function __construct($vip,$nomChosen,$catChosen){
		$dbnew = new dbConnect( 'visitors' );
		$this->visitorIp = $vip;
		$this->nomChosen = $nomChosen;
		$this->catChosen = $catChosen;
		$this->db = $dbnew;
		$this->canVote = true;
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
	private function timeExpired( $result ) {
		foreach($result as $res){
			$time = $res['visi_recent_time'];
			$savedTime = new DateTime( $time );

			$currentTime = new DateTime('now') ;
			$difftime = date_diff( $savedTime, $currentTime );
			$min = $difftime->format( '%R%a' ) * 24 * 60;
			$min += $difftime->h * 60;
			$min += $difftime->i;
			if ( $min < 30 ) {
				$this->canVote = false;
			}
		}
	}
	public function checkAndVote(){
		$nominees = new nomController();
		$visitorIp = $this->visitorIp;
		$ips = $this->ips;
		$table = $this->db;
		$enterCheck=[];
		$currentTime = new DateTime('now') ;
		if($this->visitorIp)
			$enterCheck += array('visi_ip'=> $this->visitorIp);
		if($this->catChosen)
			$enterCheck += array('cat_voted'=>$this->catChosen);

		if($result = $table->getAnd( $enterCheck)){
			$this->timeExpired($result);
		}

		if($this->canVote){

			if($this->addVote(array(NULL, $this->visitorIp, $currentTime->format('Y-m-d H:i:s'), $this->nomChosen, $this->catChosen))) {
				$updateVote = $nominees->get_votes($this->nomChosen) + 1;
				if($nominees->updateNominee(array('nom_votes'=> $updateVote),$this->nomChosen)){
					return true;
				}
			}
		}
		return false;
	}

	public function get_ip(){
		return $this->ips;
	}
	public function addVote($insertArray){
		return $this->db->insert($insertArray);
	}
}

?>