<?php
	header('Content-type: application/json;');
	session_start();

	$autenticate = false;

	$users = isset($_SESSION['fakeDB']['Users']) ? $_SESSION['fakeDB']['Users'] : [];
	foreach ($users as $users_id => $user) {
		if ($users[$users_id]['email'] == $_POST['email'] &&
			$users[$users_id]['password'] == $_POST['password']) {

			$_SESSION['session_users'] = [
				'email' => $_POST['email'],
			];
			$autenticate = true;
			break;
		}
	}

	echo json_encode([
		'autenticate'   => $autenticate,
		'session_users' => $_SESSION['session_users']
	]);
?>