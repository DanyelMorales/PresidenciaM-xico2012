<?php 
/*************************************************************************
 * No nativo de wordpress.
 * -----------------------------------------------------------------------
 * 	Creado por: 
 *		Helynai Elizabeth Chuc Maldonado.
 *		Daniel Noe Vera Morales: danyelmorales1991@gmail.com
 *************************************************************************/
abstract class FunctorSuper  implements IFunctor
{
	protected $EventAction;
	protected $LevelAction;
	protected $Args;
	protected $MergedEventAction;
	protected $MergedLevelAction;
	protected $MergedArgs;
	
	public function __construct()
	{
		$this->LevelAction = array();
		$this->EventAction = array();
		$this->Args = array();
		$this->MergedEventAction = array();
		$this->MergedLevelAction = array();
		$this->MergedArgs = array();
	}
	
	public function mergeEventAction($index, $function)
	{
		$this->MergedEventAction[$index] = $function;
	}
	
	private function resolveMergeEventAction()
	{
		if(count($this->MergedEventAction) > 0)
		{
			$this->EventAction = array_merge($this->EventAction, $this->MergedEventAction);
			unset($this->MergedEventAction);
		}
	}
	
	public function mergeLevelAction($index, $function)
	{
		$this->MergedLevelAction[$index] = $function;
	}
	
	private function resolveMergeLevelAction()
	{
		if(count($this->MergedLevelAction) > 0)
		{
			$this->LevelAction = array_merge($this->LevelAction, $this->MergedLevelAction);
			unset($this->MergedLevelAction);
		}
	}
	
	public function mergeArgs($index, $data)
	{
		$this->MergedArgs[$index] = $data;
	}
	
	private function resolveMergArgs()
	{
		if(count($this->MergedArgs) > 0)
		{
			$this->Args = array_merge($this->Args, $this->MergedArgs);
			unset($this->MergedArgs);
		}
	}
	
	public function __call($name, $arguments = null)
    {
		switch($name)
		{
			case 'getEventAction':
				$this->setLevelEventAction();
				$this->resolveMergeEventAction();
				return $this->EventAction;
			break;
			
			case 'getLevelAction':
				$this->setLevelAction();
				$this->resolveMergeLevelAction();
				return $this->LevelAction;
			break;
			
			case 'getArgs':
				$this->setargs();
				$this->resolveMergArgs($this->Args);
				return $this->Args;
			break;
		}
	}
}
