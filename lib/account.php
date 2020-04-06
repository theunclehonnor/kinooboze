<?php
class Account
{
	public $idAccount;
	public $email;
	public $password;
	public $name;
	public $personalData;
	public $moderator;

	function registrationForm()
	{
		$this->email = trim($_POST['email']);
		$this->password = trim($_POST['password']);
		$this->name = trim($_POST['name']);
		$this->personalData = $_POST['personalData'];
		$this->moderator = "false";
	}

	function checkedEmail()
	{
		global $pdo;
		$sql = 'SELECT * FROM account WHERE email = :email';
		$request = $pdo->prepare($sql);
		$request->bindParam(':email', $this->email);
		$request->setFetchMode(PDO::FETCH_CLASS, 'Account');
		$request->execute();
		$data = $request->fetch();
		return $data;
	}

	function checkedName()
	{
		global $pdo;
		$sql = 'SELECT name FROM account WHERE name = :name';
		$params = [':name' =>  $this->name];
		$stmt = $pdo->prepare($sql);
		$stmt->execute($params);
		$data = $stmt->fetchObject();
		return $data;
	}

	private function generateHashPassword()
	{
		global $pdo;
		$this->password = password_hash($this->password, PASSWORD_DEFAULT);
	}

	function setAccount()
	{
		global $pdo;
		$this->generateHashPassword();
		$sql = 'INSERT INTO account(email, password, name, "personalData", moderator)
		VALUES(:email, :password, :name, :personalData, :moderator)';
		$params = [
			':email' =>  $this->email,
			':password' => $this->password,
			':name' => $this->name,
			':personalData' => $this->personalData,
			':moderator' => $this->moderator
		];
		$stmt = $pdo->prepare($sql);
		$stmt->execute($params);
	}

	function setIdAccount()
	{
		global $pdo;
		$sql = 'SELECT "idAccount" FROM account WHERE password = :password';
		$params = [':password' =>  $this->password];
		$stmt = $pdo->prepare($sql);
		$stmt->execute($params);
		$data = $stmt->fetch(PDO::FETCH_OBJ);
		$this->idAccount = $data->idAccount;
	}

	function verifyPassword($passwordCheck)
	{
		if(password_verify($this->password, $passwordCheck))
			return (true);
		else
			return (false);
	}
}