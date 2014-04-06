<?php
/**
 * TagCloud control
 *
 * @copyright Copyright (c) 2009 Jan Marek
 * @license MIT
 * @link http://nettephp.com/cs/extras/tagcloud
 * @version 0.1
 * 
 * @property array $data
 */

use Nette\Utils\Strings as String;

class TagCloud extends Nette\Application\UI\Control
{
	/** @var string */
	public $sortClass = "alphabetical";

	/** @var string */
	public $destination = "this";

	/** @var string */
	public $tagKey = "tag";

	/** @var array */
	private $data;

	/** @var int */
	private $minOccurs;

	/** @var int */
	private $maxOccurs;

	/** @var int */
	protected $minWeight = 1;

	/** @var int */
	protected $maxWeight = 5;

	/**
	 * Data setter
	 * @param array $data data
	 */
	public function setData(array $data)
	{
		$this->data = $data;

		$occurs = array_values($data);
		$this->maxOccurs = max($occurs);
		$this->minOccurs = min($occurs);
	}

	/**
	 * Data getter
	 * @return array data
	 */
	public function getData()
	{
		return $data;
	}

	/**
	 * Count weight
	 * @param int $currentOccurences
	 * @return int
	 */
	protected function countDistribution($currentOccurences)
	{
		//dump($this->maxOccurs);
		$weight = log($currentOccurences);
		//dump($weight);
		$distribution = $this->minWeight + round($weight * ($this->maxWeight - $this->minWeight));
		//$distribution = $currentOccurences;

		return $distribution;
	}

	/**
	 * Get CSS class name
	 * @param int $distribution
	 * @return string
	 */
	protected function getCssClass($distribution)
	{
		//dump($distribution);
		//dump($this->minWeight);
		return str_repeat('v', $distribution - $this->minWeight) . ($distribution > $this->minWeight ? '-' : '') . 'popular';
	}

	/**
	 * Render tag cloud
	 */
	public function render()
	{
		if (empty($this->data)) return;

		foreach ($this->data as $name => $occurs) {
			$distribution = $this->countDistribution($occurs);

			$tags[] = (object) array(
				"name" => $name,
				"class" => $this->getCssClass($distribution),
				"url" => String::webalize($name),
			);
		}

		$template = $this->getTemplate();
		$template->setFile(dirname(__FILE__) . '/template.phtml');

		$template->tags = $tags;
		$template->sortClass = $this->sortClass;
		$template->destination = $this->destination;
		$template->tagKey = $this->tagKey;

		$template->render();
	}
}