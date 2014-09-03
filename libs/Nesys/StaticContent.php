<?php
namespace Nesys;
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of StaticContent
 *
 * @author JDC
 * @version API-1
 */
class StaticContent extends Repository {
    
    function setup() {
	$this->tablename = "static";
    }
    
    /**
     * Gets page by shortcut
     * @param string $shortcut
     * @return \Nette\Database\Table\ActiveRow
     * @version API-1
     * @since API-1
     */
    public function getByShortcut($shortcut){
	return $this->getTable()->where("shortcut",$shortcut)->fetch();
    }
    
    /**
     * Gets page by id
     * @param int $id
     * @return \Nette\Database\Table\ActiveRow
     * @version API-1
     */
    public function getById($id) {
	return $this->getTable()->where("id",$id)->fetch();
    }
    
    /**
     * Update a page
     * @param int $id
     * @param array|stdClass $page
     * @return int
     * @version API-1
     */
    public function updatePage($id,$page) {
	return $this->getTable()->where("id",$id)->update($page);
    }
    
    /**
     * Create a page
     * @param array|stdClass $page
     * @return \Nette\Database\Table\ActiveRow
     * @version API-1
     */
    public function createPage($page) {
	return $this->getTable()->insert($page);
    }
}
?>
