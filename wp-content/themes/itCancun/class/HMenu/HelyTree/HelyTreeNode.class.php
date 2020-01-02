<?php
/*************************************************************************
 * No nativo de wordpress.
 * -----------------------------------------------------------------------
 *	Crea un nodo de un arbol multicamino
 * -----------------------------------------------------------------------
 * 	Creado por: 
 *		Helynai Elizabeth Chuc Maldonado.
 *		Daniel Noe Vera Morales: danyelmorales1991@gmail.com
 *************************************************************************/
class HelyTreeNode
{
	private $Child;
	private $ChildAnon;
	private $Dad;
	private $Info;
	private $Name;
	
	public function __construct()
	{
		$this->ChildAnon = array();
		$this->Child = array();
		$this->Info = '';
		$this->Dad = '';
	}
	
	public function setChild($child, $name = '')
	{
		if($name !== '')
		{
			if(!array_key_exists($name, $this->Child))
			{
				$this->Child[$name] = $child;
			}
		}
		else
		{
			$this->ChildAnon[] = $child;
		}
	}
	
	public function setChildElements($elements)
	{
		$this->Child = $elements;
	}
	
	public function setAnonChildElements($elements)
	{
		$this->ChildAnon = $elements;
	}
	
	public function setInfo($info)
	{
		$this->Info = $info;
	}
	
	public function setDad($dad)
	{
		$this->Dad = $dad;
	}
	
	public function setName($name)
	{
		$this->Name = $name;
	}
	
	public function getAnonChild()
	{
		return $this->ChildAnon;
	}
	
	public function getChild()
	{
		return $this->Child;
	}
	
	public function getDad()
	{
		return $this->Dad;
	}
	
	public function getName()
	{
		return $this->Name;
	}
	
	public function getInfo()
	{
		return $this->Info;
	}
	
	public function isEmpty()
	{
		if(count($this->ChildAnon) === 0 && count($this->Child) === 0)
		{
			return true;
		}
		
		return false;
	}
}