<?php

namespace PortfolioApp;

class Controller {
	protected function render($view, $data = []) {
		extract($data);

		include "Views/$view.php";
	}
}

