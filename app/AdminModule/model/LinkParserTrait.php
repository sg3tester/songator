<?php
/**
 * Created by PhpStorm.
 * User: JDC
 * Date: 26.7.2014
 * Time: 18:45
 */

trait LinkParserTrait {
	/**
	 * Returns Module name
	 * @return string
	 */
	public function getModuleName()
	{
		$pos = strrpos($this->name, ':');
		if (is_int($pos)) {
			return substr($this->name, 0, $pos);
		}
		return NULL;
	}

	/**
	 * Return presenter pure name
	 * @return string
	 */
	public function getPresenterName()
	{
		$pos = strrpos($this->name, ':');
		if (is_int($pos)) {
			return substr($this->name, $pos + 1);
		}
		return $this->name;
	}

	/**
	 * Rozparsuje link na modul, presenter, akci - př. :Administration:Default:default
	 * @param string $link
	 * @return array associativní pole s klíči module, presenter, action
	 */
	public function parseLink($link) {
		$tokens = explode(':',$link);
		$module = array();
		for ($i = 0; $i < count($tokens) - 1; $i++) {
			$module[] = $tokens[$i];
		}
		return array (
			"presenter" => count($module) ? implode(':', $module) : $this->name,
			"action" => $tokens[count($tokens) - 1] ?: 'default'
		);
	}
} 