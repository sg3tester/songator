<?php

namespace Nesys;
/**
 * Description of Podobne
 *
 * @author JDC
 */
class Podobne extends \Nesys\Repository {
    
   public function setup() {
	$this->tablename = "podobne";
    }
    
    /**
     * Match valid key by alias
     * @param string $keyword
     * @return \Nette\Database\Table\Selection
     */
    public function match($keyword) {
		return $this->getTable()->where("aliases REGEXP ?","(^|,)".$keyword."(,|$)");
    }
    
	public function bind($term) {
		return $this->getTable()->where("valid LIKE ? OR aliases REGEXP ?","%$term%","(^|,)".$term."(,|$)");
	}

	/**
     * Match valid key by Levenshtein function (keyword similarity)
     * @param string $keyword
     * @return \Nette\Database\Table\Selection
     */
    public function levenshtein($keyword) {
	return $this->getTable()->select("*,levenshtein(valid,'$keyword') AS distance")
		->where("levenshtein(valid, ?) < 10",$keyword)
		->order("distance ASC");
    }
}
