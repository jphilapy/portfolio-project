<?php

namespace PortfolioApp;

class Controller {
	protected function render($view, $data = []): void
	{
		extract($data);

		include "Views/$view.php";
	}
}

