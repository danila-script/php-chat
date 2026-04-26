<?php 
	$file = 'file.json';
	
	if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
		$message = htmlspecialchars(trim($_POST['message']));
		if ($message) {
			$jsonfile = file_exists($file) ? json_decode(file_get_contents($file), true) : [];
			$date = ['message' => $message];
			$jsonfile[] = $date; 
			$enjson = json_encode($jsonfile, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
			file_put_contents($file, $enjson);
			header('Location: chats.php');
			exit;
		}
	}
	$jsonfile = file_exists($file) ? json_decode(file_get_contents($file), true) : [];
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Chats</title>
	</head>
	
	<body>
		<form method="post">
			<textarea name="message" placeholder="Your chat" required></textarea><br>
			<button type="submit" name="submit">Отправить</button>
		</form><hr />

		<?php if (empty($jsonfile)): ?>
			<p>Not chat.</p>
		<?php else: ?>
			<?php foreach($jsonfile as $json): ?>
				<p><?= htmlspecialchars($json['message'] ?? ''); ?></p>
			<?php endforeach ?>
		<?php endif; ?>
	</body>
</html>