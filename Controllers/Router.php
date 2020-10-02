<?php


namespace Controllers;


class Router
{
	private $_delimiter = '/';
	private $_pageGetter = "page";
	private $_defaultPage = "";

	public function __construct(?string $page)
	{
		if(!isset($page) || empty($page)){

		}
	}
}