<?php 
class nomController{
	private $name;
	private $catId;
	private $nomCode;
	private $nomVoteCode;
	private $nomVotes;
	private $db;


	public function __construct(){
		$dbnew = new dbConnect( 'nominees' );
		$this->db = $dbnew;
		$nomList = $dbnew->getall();

		foreach($nomList as $nomRec){
		    $id[] = $nomRec['nom_id'];
    		$name[] = $nomRec['nom_name'];
    		$code[] = $nomRec['code'];
    		$voteCode[] = "ISANGO".$nomRec['code_cat'].$nomRec['code'];
    		$votes[] = $nomRec['nom_votes'];
		}
		$this->name = array_combine($id,$name);
		$this->nomCode = array_combine($id,$code);
		$this->nomVoteCode = array_combine($id,$voteCode);
		$this->nomVotes = array_combine($id,$votes);
	}
	public function get_name(){
		return $this->name;
	}
	public function get_code(){
		return $this->nomCode;
	}
	public function get_votecode(){
		return $this->nomVoteCode;
	}
	public function get_votes($nom){
		if($nom)
			return $this->nomVotes[$nom];
		return $this->nomVotes;
	}
	public function addNominee($insertArray){
		$this->db->insert($insertArray);
	}
	public function updateNominee($changes,$id){
		$this->db->update($changes,$id);
	}
	public function deleteNominee($id){
		$this->db->delete($id);
	}



	}

 ?>