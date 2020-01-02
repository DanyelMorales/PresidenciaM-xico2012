<?php
/*************************************************************************
 * No nativo de wordpress.
 * -----------------------------------------------------------------------
 *	Recorre el arbol multicamino.
 * -----------------------------------------------------------------------
 * 	Creado por: 
 *		Helynai Elizabeth Chuc Maldonado.
 *		Daniel Noe Vera Morales: danyelmorales1991@gmail.com
 *************************************************************************/
class HelyTreeTraversal
{
	private $LevelAction;
	private $LevelEventAction;
	private $Args;
	private $RootAdapter;
	private static $Buffer;
	private static $BufferElements;
	
	public function __construct()
	{
		$this->LevelAction = array();
		$this->LevelEventAction = array();	
		$this->Args = array();
		$this->RootAdapter = new HelyTreeNode();
		self::$Buffer = '';
		self::$BufferElements = '';
	}
	
	/*************************************************************************
	 * 	No nativo de wordpress.
	 * -----------------------------------------------------------------------
	 *	Recorrido del arbol multicamino
	 * -----------------------------------------------------------------------
	 *	Se recorre el arbol de forma Preorden, considere que no es un arbol
	 *	binario.
	 *	Visite la raíz
	 *  Atraviese el sub-árbol izquierdo
	 *  Atraviese el sub-árbol derecho
	 * -----------------------------------------------------------------------
	 * 	Creado por: 
	 *		Helynai Elizabeth Chuc Maldonado.
	 *		Daniel Noe Vera Morales: danyelmorales1991@gmail.com
	 *************************************************************************/
	
	# iterates from root array tree
	public function treeTraversal(array $Root)
	{
		self::$Buffer = '';
		ob_start(array('self', 'putDataOnBuffer'));
			$this->treeTraversalAdapter($Root);
        ob_end_flush();
	}
	
	private function treeTraversalAdapter(array $Root)
	{
		foreach($Root as $elements)
		{
			$this->nodeTraversalChildBased($elements);
		}
		#echo self::$BufferElements;
	}
	
	private function nodeTraversalChildBased($object, $level = 0)
	{
		$infox  = (is_object($object)) ? $object->getInfo() : '';
		$tugaPie = $this->getChild($object);
		$childs = count($tugaPie);
		$level++;
		
		#------ events support ------
		$this->onLevelStarts($level, $childs, $infox);
		#------ End events support ------
		#$this->dumpLevelChilds($level, $childs, $infox->title);
		
		if($childs === 0)
		{
			$this->onLeaf($level, $childs, $infox);
			return;		
		}
		else
		{
			$this->onParent($level, $childs, $infox);
			foreach($tugaPie as $patitasDeTuga)
			{	
				$this->nodeTraversalChildBased($patitasDeTuga, $level);		
			}
			$this->onParentEnd($level, $childs, $infox);
		}
		#------ events support ------
		$this->onLevelEnds($level, $childs, $infox);
		#------ End events support ------
	}

	# iterates from root object tree
	public function treeTraversalObject($Root)
	{
		self::$Buffer = '';
		ob_start(array('self', 'putDataOnBuffer'));
			$this->RootAdapter->setChildElements($Root);
			$this->nodeTraversal($this->RootAdapter);
        ob_end_flush();
	}
	
	private function nodeTraversal($object, $level = 0, $infox = null)
	{
		if($object->isEmpty())
		{
			return;
		}
		else
		{
			$tugaPie = $this->getChild($object);
			$childs = count($tugaPie);
			$level = ( $childs > 0)? $level + 1 : 0;
			$this->onLevelStarts($level);
			foreach($tugaPie as $patitasDeTuga)
			{	
				$this->onLevel($level, $patitasDeTuga->getInfo());
				$this->nodeTraversal($patitasDeTuga, $level, $patitasDeTuga->getInfo());		
			}
			$this->onLevelEnds($level);
		}
	}
	

	# events
	public function setLevelActions(array $levelAction, array $callBackEventActions = null, array $args = null)
	{
		$this->Args = $args;
		$this->LevelAction = $levelAction;
		$this->LevelEventAction = $callBackEventActions;
	}
	
	public function onLevel($level, $childs, $infox)
	{
		if(isset($this->LevelAction[$level]))
		{
			$this->LevelAction[$level]($childs, $infox);
		}
	}
	
	public function onLevelEnds($level, $childs, $infox)
	{
		if(isset($this->LevelEventAction['ole_' . $level]))
		{
			echo $this->LevelEventAction['ole_' . $level]($childs, $infox);
		}
	}
	
	public function onLevelStarts($level, $childs = null, $infox = null)
	{
		if(isset($this->LevelEventAction['ols_' . $level]))
		{
			echo $this->LevelEventAction['ols_' . $level]($childs, $infox);
		}
	}

	public function onLeaf($level = null, $childs = null, $infox = null)
	{
		if($this->getPermissonForAction('reorderNELeaf', $level) === 0)
		{
			return;
		}
		
		if(isset($this->LevelEventAction['onLeaf']))
		{
			echo $this->LevelEventAction['onLeaf']($level, $childs, $infox);
		}
	}
	
	public function onParentEnd($level = null, $childs = null, $infox = null)
	{		
		if(isset($this->LevelEventAction['onParentEnd']))
		{
			echo $this->LevelEventAction['onParentEnd']($level, $childs, $infox);
		}
	}
	
	public function onParent($level = null, $childs = null, $infox = null)
	{		
		if(isset($this->LevelEventAction['onParent']))
		{
			echo $this->LevelEventAction['onParent']($level, $childs, $infox);
		}
	}
	
	# other operations
	private function getChild($object)
	{
		if(count($object->getChild()) > 0)
		{
			return $object->getChild();
		}
		elseif(count($object->getAnonChild()) > 0)
		{
			return $object->getAnonChild();
		}
		else
		{
			return array();
		}
	}
	
	private function getPermissonForAction($action, $level)
	{	
		# 1 - allowed
		# 0 - not allowed
		if(!isset($this->Args[$action]))
		{
			return 1;
		}	

		if($this->Args[$action] === 'yes')
		{
			return 1;
		}
		
		if(isset($this->LevelAction[$level]) 
				|| isset($this->LevelEventAction['ols_' . $level]) 
				|| isset($this->LevelEventAction['ole_' . $level])
				|| isset($this->LevelEventAction['onParent']))
		{
			return 1;
		}

		return 0;
	}
	
	private function showDemoHelyTree($level, $data)
	{
		if($level === 1)
		{
			echo "--"; 		
		}
		else
		{
			echo str_repeat("---", $level);
		}
		echo  "&#09;&#09;&#09;&#09;[$level]&#09;&#09;";	
		echo $data . "<br>";
	}
	
	private function dumpLevelChilds($level, $childs, $infox)
	{
		echo "Data:" .  $infox . " Level:" . $level . " Childs" . $childs ."<br><br>";
	}
	
	# buffer
	public static function putDataOnBuffer($data)
	{
		self::$Buffer .= $data;
	}
	
	public function getDataBuffer()
	{
		return self::$Buffer;
	}
}