<?php
namespace SystemModule;
use Nette;
/**
 * Base presenter for all application presenters.
 */
abstract class BasePresenter extends \Nesys\NesysPresenter
{
    protected $perms;
    
    function startup() {
	parent::startup();
	$this->addLayoutDir(\SystemModule\Adminex::getAdminexTemplateDir());
	$this->addTemplateDir(\SystemModule\Adminex::getAdminexTemplateDir());
	//dump($this->formatTemplateFiles());
	//Do řízení systému pustíme jen adminy
	if(!$this->getUser()->isAllowed("system", "view"))
	    $this->redirect(":homepage:default");
	$this->perms = $this->context->opravneni;
	$this->template->perms = $this->perms;
	$this->context->userRepository->updateActivity($this->getUser()->getId());
	$this->template->sitename = $this->core->getOption("nesys_sitename");
	$this->template->sitedesc = $this->core->getOption("nesys_sitedesc");
	if ($this->getUser()->isLoggedIn())
	    $usr = $this->getUser()->getIdentity()->user;
	else
	    $usr = "guest";
	$this->core->log(\Nesys\NesysCore::LOG_ACCESS, "Přístup z ".$_SERVER['REMOTE_ADDR']." (".$usr.") do ".$_SERVER['REQUEST_URI']);
	
    }
    
    /**
     * Generuje item do menu s glyphem
     * @param type $glyph Symbol či obrázek (FontAwesome)
     * @param type $label Text odkazu
     * @param type $href Adresa odkazu
     * @return \Murdej\MenuNode
     */
    public function genItem($glyph, $label, $href){
	$menuItem = new \Murdej\MenuNode;
	$menuItem->link = $href;
	$symbol = Nette\Utils\Html::el('span')->addAttributes(array("class" => "symboled"));
	$symbol->setHtml($glyph);
	$text = Nette\Utils\Html::el()->setText(" ".$label);
	$polozka = Nette\Utils\Html::el()->add($symbol);
	$polozka->add($text);
	$menuItem->name = $polozka;
	return $menuItem;
    }
    
    /**
     * Generuje text itemu pro menu
     * @param type $glyph
     * @param type $label
     * @param type $href
     * @return type
     */
    public function genItemText($glyph, $label, $href){
	$menuItem = new \Murdej\MenuNode;
	$menuItem->link = $href;
	$symbol = Nette\Utils\Html::el('span')->addAttributes(array("class" => "symboled"));
	$symbol->setHtml($glyph);
	$text = Nette\Utils\Html::el()->setText(" ".$label);
	$polozka = Nette\Utils\Html::el()->add($symbol);
	$polozka->add($text);
	return $polozka;
    }

        public function createComponentMenu() {
    $menu = new \Murdej\Menu;
    
    $menu->rootNode->add($this->genItem("&#xf015;", "Přehled", "System:default"));
    $menu->rootNode->add($this->genItem("&#xf007;", "Správa uživatelů", "System:users"));
    $menu->rootNode->add($this->genItem("&#xf108;", "Správa systému", "System:control"));
    $menu->rootNode->add($this->genItem("&#xf0a0;", "Správa obsahu", "System:content"));
    $menu->rootNode->add($this->genItem("&#xf02d;", "Logování", "System:logging"));
    $menu->rootNode->add($this->genItem("&#xf05a;", "About", "System:about"));
    
    
    return $menu;
    }

}
