<?php
include 'HelyTree/HelyTreeNode.class.php';
include 'HelyTree/HelyTree.class.php';
include 'HelyTree/HelyTreeTraversal.class.php';

/*************************************************************************
 * No nativo de wordpress.
 * -----------------------------------------------------------------------
 * Generador de menu, interfaz con el arbol multicamino.
 * Pasa los datos al arbol para ir creando los nodos. 
 * -----------------------------------------------------------------------
 * 	Creado por: 
 *		Helynai Elizabeth Chuc Maldonado.
 *		Daniel Noe Vera Morales: danyelmorales1991@gmail.com
 *************************************************************************/

class MenuGen
{
	private $HelyTree;
	private $MenuWP;
	private $HelyTreeTraversal;
	
	public function __construct(array $menuWP)
	{
		$this->HelyTree = new HelyTree();
		$this->MenuWP = $menuWP;
		$this->HelyTreeTraversal = new HelyTreeTraversal();
	}
	
	public function createChocolateTree(FunctorSuper $MenuHeaderFunctor)
	{
		if(!is_array($this->MenuWP) || !is_object($MenuHeaderFunctor))
		{
			return false;
		}
		
		$callBackActions = $MenuHeaderFunctor->getLevelAction();
		$callBackEventActions = $MenuHeaderFunctor->getEventAction();
		$args = $MenuHeaderFunctor->getargs();
		
		foreach($this->MenuWP as $item)
		{
			$dadID = (int)$item->menu_item_parent;
			$MyID = (int)$item->ID;
			$this->HelyTree->createBottomTopNode($dadID, $MyID, $item); # agregamos datos al nodo
		}
		
		$root = $this->HelyTree->getRootElements();
		$this->HelyTreeTraversal->setLevelActions($callBackActions, $callBackEventActions, $args);
		$this->HelyTreeTraversal->treeTraversal($root);
		
		return $this->HelyTreeTraversal->getDataBuffer();
	}
}
