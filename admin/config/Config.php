<?php
	// Inicia os dados em sessão, simulando um Banco de Dados
	class Config
	{
		public function init()
		{
			$this->initUsers();
			$this->initProducts();
			$this->initClients();
		}

		private function initUsers()
		{
			$users = [
				rand() => [
					'email'    => 'admin@gmail.com',
					'password' => 'admin'
				]
			];

			if (!isset($_SESSION['fakeDB']['Users']))
				$_SESSION['fakeDB']['Users'] = $users;
		}

		private function initProducts()
		{
			$products = [
				rand() => [
					'name' => 'Painel Solar 60cm x 60cm',
					'price' => 499.99
				],
				rand() => [
					'name' => 'Painel Solar 90cm x 90cm',
					'price' => 599.99
				],
				rand() => [
					'name' => 'Painel Solar 120cm x 120cm',
					'price' => 799.99
				],
				rand() => [
					'name' => 'Módulo Individual',
					'price' => 99.99
				],
			];

			if (!isset($_SESSION['fakeDB']['Products']))
				$_SESSION['fakeDB']['Products'] = $products;
		}

		private function initClients()
		{
			$clients = [
				rand() => [
					'name' => 'Pedro Vieira',
					'email' => 'vieirapcm@gmail.com'
				],
			];

			if (!isset($_SESSION['fakeDB']['Clients']))
				$_SESSION['fakeDB']['Clients'] = $clients;
		}
	}