<?php
class Comment 
{
	public $idComment;
	public $idObzor;
	public $idAccount;
	public $dateComment;
	public $textComment;

	function setComment($idObzor, $idAccount, $textComment)
	{
		$this->idObzor = $idObzor;
		$this->idAccount= $idAccount;
		$this->textComment = $textComment;
		global $pdo;
		$sql = 'INSERT INTO comment("idObzor", "idAccount", "dateComment", "textComment") 
		VALUES(:idObzor, :idAccount, timezone(\'GMT-03\', CURRENT_TIMESTAMP), :textComment) RETURNING "idComment", "dateComment"';
		$params = [
			':idObzor' =>  $this->idObzor,
			':idAccount' => $this->idAccount,
			':textComment' => $this->textComment
		];
		$stmt = $pdo->prepare($sql);
		$stmt->execute($params);
		$data = $stmt->fetch(PDO::FETCH_OBJ);
		$this->idComment = $data->idComment;
		$this->dateComment = $data->dateComment;
	}

	function getAllComments($idObzor)
	{
		global $pdo;
		$sql = 'SELECT A.name,  C."dateComment", C."textComment" 
		FROM comment C INNER JOIN account A 
		ON C."idAccount" = A."idAccount" 
		WHERE C."idObzor" = :idObzor 
		ORDER BY "dateComment"';
		$request = $pdo->prepare($sql);
		$request->bindParam(':idObzor', $idObzor);
		$request->setFetchMode(PDO::FETCH_OBJ);
		$request->execute();
		$data = $request->fetchAll();
		return 	$data;
	}
}