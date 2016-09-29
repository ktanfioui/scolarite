<?php
include_once '../../models/classes/admin.classe.php';
class adminManager
{
	private $db;

	public function __construct($BDD)
	{
		$this->db = $BDD;
	}

	public function getConnection($email,$password)
	{
		$login_info = array('email' => $email , 'password' => $password );
		$sql = 'SELECT * FROM admin WHERE email = :email AND password = :password';
		$qry = $this->db->prepare($sql);
		$qry->execute($login_info);

		$element = $qry->fetch(PDO::FETCH_ASSOC);
		
		if(empty($element))
			return null;
		else
			return new Admin($element['id'],$element['nom'],$element['prenom'],$element['password'],$element['email']);
	}

	
}
?>