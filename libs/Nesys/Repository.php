<?php
namespace Nesys;
use Nette;
/**
 * Provádí operace nad databází. Základ pro práci s DB
 * @version API-1
 */
abstract class Repository extends Nette\Object
{
    /** @var Nette\Database\Connection */
    protected $connection;
    /** @var string */
    protected $tablename;
    /** @var \Nesys\NesysCore */
    protected $core;
    
    /**
     * 
     * @param Nette\Database\Connection $db
     * @param \Nesys\NesysCore $core
     * @version API-1
     */
    public function __construct(Nette\Database\Connection $db, \Nesys\NesysCore $core)
    {
        $this->connection = $db;
	$this->setup();
	$this->core = $core;
    }
    
    /**
     * Setup NESys Repository accessor
     * @version API-1
     */
    abstract protected function setup();

    /**
     * Vrací objekt reprezentující databázovou tabulku.
     * @return Nette\Database\Table\Selection
     * @version API-1
     */
    protected function getTable()
    {
        // název tabulky odvodíme z názvu třídy
        //preg_match('#(\w+)Repository$#', get_class($this), $m);
        return $this->connection->table($this->tablename);
    }
    
    /**
     * Vrací objekt reprezentující subtabulku (eg. table_subtable)
     * @param string $subtable
     * @return type
     * @version API-1
     */
    protected function getSubTable($subtable) {
	return $this->connection->table($this->tablename."_".$subtable);
    }

    /**
     * Vrací všechny řádky z tabulky.
     * @return Nette\Database\Table\Selection
     * @version API-1
     */
    public function findAll()
    {
        return $this->getTable();	
    }

    /**
     * Vrací řádky podle filtru, např. array('name' => 'John').
     * @return Nette\Database\Table\Selection
     * @version API-1
     * @deprecated since version API-2
     */
    public function findBy(array $by)
    {
        return $this->getTable()->where($by);
    }
    
    /**
     * 
     * @param type $by
     * @return type
     * @version API-1
     * @deprecated since version API-2
     */
    public function find($by)
    {
        return $this->getTable()->where($by);
    }
    
    /**
     * Vrátí ID uživatele, který přidal danou položku
     * @param type $id ID položky
     * @return int
     * @version API-1
     * @deprecated since version API-2
     */
    public function getUid($id) {
	return $this->getTable()->where("id",$id)->fetch()->uid;
    }

}