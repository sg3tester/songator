<?php

/* Copyright (c) 2014, JDCofficial
 * All rights reserved.
 *
 * License information you can find in LICENSE.md
 */

/**
 * Less autocompiler
 *
 * @author JDC
 */
final class Lessify extends Nette\Object {
	
	/** @var \lessc */
	private $compiler;
	
	public $cacheDir;
	
	public function __construct() {
		$less = new lessc();
		$less->setFormatter("compressed");
		$this->compiler = $less;
	}
	
	/**
	 * Compile LESS
	 * @param string $in
	 * @param string $out
	 */
	public function compile($in, $out) {
		if ($this->cacheDir)
			$this->autoCompileLess($in, $out);
		else
			$this->compiler->checkedCompile($in, $out);
	}
	
	/**
	 * Directly access to less compiler
	 * @return \lessc
	 */
	public function getCompiler() {
		return $this->compiler;
	}

	/**
	 * Cached compile
	 * @param string $inputFile
	 * @param string $outputFile
	 */
	protected function autoCompileLess($inputFile, $outputFile) {
		// load the cache
		$tempDir = $this->cacheDir;
		@mkdir($tempDir);
		$cacheFile = $tempDir.basename($inputFile).".cache";

		if (file_exists($cacheFile)) {
			$cache = unserialize(file_get_contents($cacheFile));
		} else {
			$cache = $inputFile;
		}

		$less = $this->compiler;

		$newCache = $less->cachedCompile($cache);

		if (!is_array($cache) || $newCache["updated"] > $cache["updated"]) {
			file_put_contents($cacheFile, serialize($newCache));
			file_put_contents($outputFile, $newCache['compiled']);
		}
	}
}
