<?php 
include 'HelyTree/IFunctor.class.php';
include 'HelyTree/FunctorSuper.class.php';
/*************************************************************************
 * No nativo de wordpress.
 * -----------------------------------------------------------------------
 * 	Creado por: 
 *		Helynai Elizabeth Chuc Maldonado.
 *		Daniel Noe Vera Morales: danyelmorales1991@gmail.com
 * -----------------------------------------------------------------------
 * La clase debe heredar de FunctorSuper e implementar los metodos
 * abstractos de la interfaz estandar.
 *************************************************************************/
class MenuFunctor extends FunctorSuper 
{

	# Overrided methods here
	public function setLevelAction()
	{
		// not supported
		$this->LevelAction = array
		(	
			1 => function($info)   
			{},
		);		
	}
	
	public function setLevelEventAction()
	{
		$this->EventAction = array
		(
			// Do you need the complete documentation of this and the others supported events?
			// contactme: danyelmorales1991@gmail.com
			// OnDetecting elements of tree
			'onLeaf' => function($level = null, $childs = null, $infox = null)
			{
				$title = $infox->title;
				$url  = $infox->url;
				
				return '<li><a href="' . $url . '" class="">' . $title . '</a></li>' . "\n";
			},
			
			'onParent' => function($level = null, $childs = null, $infox = null)
			{
				$title = $infox->title;
				$url  = $infox->url;
				$buffer = '<li>' . "\n\t";
				
				if(count(array_filter($infox->classes))>0)
				{
					$data = '';
					foreach($infox->classes as $cssClass)
					{
						$data .= ' ' . $cssClass; 
					}

					$buffer .= '<span  class="' . $data . '"></span>'. "\n";
					//$buffer .= '<span  class="hCandyBullet"></span>'. "\n";
				}
				
				$buffer .= '<a href="' . $url . '" class="">' . $title . '</a>' . "\n";
				$buffer .= '<div class="submenu">' . "\n\t" .  '<ul>' . "\n\t";
				return $buffer;
			},
			
			'onParentEnd' => function($level = null, $childs = null, $infox = null)
			{
				$buffer = '</li></ul>' . "\n\t" . '</div>' . "\n";
				return $buffer;
			}
		);
	}
	
	public function setargs()
	{
		$this->Args = array(
			'reorderNELeaf' => 'no'
		);
	}
	
	# your own methods here
	public function actualizarFooterAccion()
	{
		$this->mergeEventAction('onParent',
			function($level = null, $childs = null, $infox = null)
			{
				$title = $infox->title;
				$url  = $infox->url;
				$buffer = '<li><a href="' . $url . '" class="">' . $title . '</a>' . "\n";
				$buffer .= '<ul>' . "\n\t";
				return $buffer;
			}
		);
		
		$this->mergeEventAction('onParentEnd',
			function($level = null, $childs = null, $infox = null)
			{
				$buffer = '</li></ul>' . "\n";
				return $buffer;
			}
		);
	}
}