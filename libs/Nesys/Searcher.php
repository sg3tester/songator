<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Nesys;
/**
 * Description of Searcher
 *
 * @author JDC
 * @version API-4
 */
class Searcher extends \Nesys\Repository{
   
    protected function setup() {
	
    }
    
    /**
     * Search a condition in specific table
     * @param string $table
     * @param string $expression
     * @param array $conditions
     * @return \Nette\Database\Table\Selection
     * @version API-4
     */
    public function search($table, $expression, $conditions = array()) {
	return $this->connection->table($table)->where($expression,$conditions);
    }
    
    /**
     * Quick search by REGEXP in specific table by column
     * @param string $table
     * @param string $column
     * @param string $condition
     * @return \Nette\Database\Table\Selection
     * @version API-4
     */
    public function quickSearch($table, $column, $condition) {
	return $this->connection->table($table)->where($column." REGEXP ?",$condition);
    }
}

?>
