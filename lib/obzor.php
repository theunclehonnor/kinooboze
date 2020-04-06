<?php
class Obzor 
{
	public $idObzor;
	public $idAccount;
	public $nameFilm;
	public $dataAdd;
	public $linkTrailer;
	public $textObzor;
	public $poster = 'postersImg/';

	function createNewImage($path)
	{
		$size = getimagesize($path);

		$width = 459;
		$height = 632;

		header("Content-type: {$size['mime']}");

		list($width_orig, $height_orig) = getimagesize($path);

		if ($width && ($width_orig < $height_orig)) {
			$width = ($height / $height_orig) * $width_orig;
		} else {
			$height = ($width / $width_orig) * $height_orig;
		}

		$image_p = imagecreatetruecolor($width, $height);
		$image = imagecreatefromjpeg($path);
		imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);

		imagejpeg($image_p, $path, 82);
	}

	function setPoster()
	{
		if (isset($_FILES['file'])) {
			if(isset($_SESSION['file'])){
				$this->poster = $_SESSION['file'];
			} else{
                if (!preg_match('/[.](JPG)|(jpg)|(png)|(PNG)/', $_FILES['file']['name'])) {
                    throw new Exception('Файл имел неверный формат. Можно загружать только .jpg/.png файлы');
				}
				$this->poster = $this->poster . time() . $_FILES['file']['name'];
				move_uploaded_file($_FILES['file']['tmp_name'], '../' . $this->poster);
				$this->createNewImage('../' . $this->poster);
				$_SESSION['file'] = $this->poster;
            }
		} else {
			throw new Exception('Файл не найден');
		}
	}

	function checkParam()
	{
		$this->nameFilm = trim($_POST['nameFilm']);
		$this->textObzor = $_POST['textObzor'];
		$this->linkTrailer = $_POST['linkTrailer'];
		// проверяем все ли поля заполнены
		if(trim($_POST['nameFilm']) && trim($_POST['textObzor']) && isset($_POST['linkTrailer'])){
			// проверяем корректность нашего файла
			$this->setPoster(); 
			// корректная ли ссылка
			$parsed = parse_url($_POST['linkTrailer']);
			if(strcasecmp($parsed['host'] . $parsed['path'], 'www.youtube.com/watch') != 0)
				throw new Exception('Ссылка на трейлер должна быть с youtube!');
			list(,$link) = explode('=', $parsed['query']);
			$this->linkTrailer = "https://www.youtube.com/embed/" . $link;
		} else {
			throw new Exception('Пожалуйста, заполните все поля.');
		}
	}

	function setIdModer($idAccount)
	{
		$this->idAccount = $idAccount;
	}

	function setObzor()
	{
		global $pdo;
		$sql = 'INSERT INTO obzor("idAccount", "nameFilm", "dateAdd", "linkTrailer", "textObzor", poster) 
		VALUES(:idAccount, :nameFilm, CURRENT_DATE, :linkTrailer, :textObzor, :poster) RETURNING "idObzor"';
		$params = [
			':idAccount' =>  $this->idAccount,
			':nameFilm' => $this->nameFilm,
			':linkTrailer' => $this->linkTrailer,
			':textObzor' => $this->textObzor,
			':poster' => $this->poster
		];
		$stmt = $pdo->prepare($sql);
		$stmt->execute($params);
		$data = $stmt->fetch(PDO::FETCH_OBJ);
		$this->idObzor = $data->idObzor;
	}

	function getDataForIndexPage()
	{
		global $pdo;
		$sql = 'SELECT O."idObzor", O."nameFilm", O.poster, O."dateAdd" , A.name 
		FROM obzor O INNER JOIN account A 
		ON O."idAccount"=A."idAccount"
		ORDER BY O."dateAdd"';
		$request = $pdo->query($sql);
		$data = $request->fetchAll();
		return $data;
	}

	function getObzor($idObzor)
	{
		global $pdo;
		$sql = 'SELECT * FROM obzor WHERE "idObzor" = :idObzor';
		$request = $pdo->prepare($sql);
		$request->bindParam(':idObzor', $idObzor);
		$request->setFetchMode(PDO::FETCH_CLASS, 'Obzor');
		$request->execute();
		$data = $request->fetch();
		return $data;
	}

	function getAutorObzor()
	{
		global $pdo;
		$sql = 'SELECT name FROM account WHERE "idAccount" = :idAccount';
		$params = [':idAccount' =>  $this->idAccount];
		$stmt = $pdo->prepare($sql);
		$stmt->execute($params);
		$data = $stmt->fetchObject();
		return $data->name;
	}
}