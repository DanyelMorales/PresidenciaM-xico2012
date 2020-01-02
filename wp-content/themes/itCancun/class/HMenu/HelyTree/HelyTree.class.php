<?php
/*************************************************************************
 * 	No nativo de wordpress.
 * -----------------------------------------------------------------------
 *	Crea un arbol multicamino ascendente recursivo.
 * -----------------------------------------------------------------------
 * 	Consideraciones: isset array_key_exists
 * -----------------------------------------------------------------------
 * 	Creado por: 
 *		Helynai Elizabeth Chuc Maldonado.
 *		Daniel Noe Vera Morales: danyelmorales1991@gmail.com
 *************************************************************************/
class HelyTree
{
	private $Node;
	private $Root;
	private $DadList;
	private $ChildList;
	private $RootAdapter;
	
	public function __construct()
	{
		$this->ChildList = array();
		$this->DadList = array();
		$this->Root = array();
	}
	/*************************************************************************
	 * 	No nativo de wordpress.
	 * -----------------------------------------------------------------------
	 * 	Creación de un arbol multicamino ascendente recursivo
	 * -----------------------------------------------------------------------
	 *	Los datos son de tipo ascendente recursivo por lo tanto el árbol
	 *	multicamino que se generará es de tipo ascendente recursivo. Los nodos
	 *  que se crean son nodos anonimos o padres y nodos conocidos o hijos, por 
	 *	la forma en que wordpress almacena sus datos en el array.
	 *
	 *	1)	Siempre se intentará crear el nodo hijo puesto que es el nodo que
	 *		más información tiene. 
	 *		
		 *		1.1 el prospecto de nodo debe buscarse a si mismo en el 
		 *			contenedor de nodos padre sin definiciones.
		 *		1.2 Si existe en el contenedor entonces se obtiene la 
		 *			direccion de memoria y se define el campo info 
		 *		1.3 si no existe registro, entonces se genera un nuevo 
		 *			nodo con datos.
		 *		1.4 se procede a verificar si contiene un padre o si 
		 *			es la raiz(no contiene padre).
		 *		1.5 si es la raiz entonces se agrega como padre al contenedor 
		 *			de padres.
	 *		
	 *	2)	si este nodo contiene un padre entonces
		 *		2.0 El padre se busca en el contenedor, si existe se obtiene 
		 *			la dirección de memoria para agregarle hijos.
		 *		2.1 De lo contrario se reserva el espacio de memoria del padre 
		 *			sin definirlo
		 *		2.2 se agrega el nodo hijo al espacio del nodo padre
		 *		2.3 se registra el nombre del padre al hijo
		 *		2.4 se agrega al contenedor de padres 
	 * ----------------------------------------------------------------------
	 * 	NOTA: Los nodos con padre nunca se agregan directamente al contenedor
	 *	los padres son los que se agregan directamente.
	 * -----------------------------------------------------------------------
	 *	Creado por: Helynai Elizabeth Chuc Maldonado.
	 *		Daniel Noe Vera Morales: danyelmorales1991@gmail.com
	 *************************************************************************/
	public function createBottomTopNode($name, $childName, $childInfo)
	{
		$tmpObj2 = null;
		if(isset($this->DadList[$childName]))
		{
			$tmpObj2 = $this->DadList[$childName];
		}
		else
		{
			$tmpObj2 = new HelyTreeNode(); 
			$tmpObj2->setName($childName);
			$this->ChildList[$childName] = $tmpObj2;
		}
		
		$tmpObj2->setInfo($childInfo);
		$this->createDadNode($name, $tmpObj2, $childName);
	}
	
	private function createDadNode($name, $tmpObj2, $childName)
	{
		if($name === 0)
		{
			$this->DadList[$childName] = $tmpObj2;
			$this->Root[] = $tmpObj2;
			return;
		}

		$tmpObj2->setDad($name);
		$tmpObj = null;
		
		if(isset($this->DadList[$name]))
		{
			$tmpObj = $this->DadList[$name]; // para agregar multiples hijos
		}
		elseif(isset($this->ChildList[$name]))
		{
			$tmpObj = $this->ChildList[$name];
			$this->DadList[$name] = $tmpObj;
			unset($this->ChildList[$name]);
		}
		else
		{
			$tmpObj = new HelyTreeNode(); // no existe creamos la direccion de memoria
			$tmpObj->setName($name);
			$this->DadList[$name] = $tmpObj;
		}
		
		$tmpObj->setChild($tmpObj2, $childName); // por la referencia de memoria esto funciona
	}
	/*************************************************************************
	* 	No nativo de wordpress.
	* -----------------------------------------------------------------------
	*	public stuff to be used by a tuga.
	* -----------------------------------------------------------------------
	* 	Creado por: 
	*		Helynai Elizabeth Chuc Maldonado.
	*		Daniel Noe Vera Morales: danyelmorales1991@gmail.com
	*************************************************************************/
	public function isEmpty()
	{
		 return $this->Root === null;
	}
	
	public function printAll()
	{
		echo "<em>";
		var_dump($this->Root);
		echo "</em>";
	}
	
	public function getRootElements()
	{
		unset($this->DadList);
		unset($this->ChildList);
		return $this->Root;
	}
}