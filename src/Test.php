<?php

namespace PortfolioApp;
class Test
{
	public string $val;
	public function __construct($message)
	{
		$this->val = $message;
	}

	public function showTest()
	{
		return $this->val;
	}
}
