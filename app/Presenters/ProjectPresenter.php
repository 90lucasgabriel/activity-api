<?php

namespace CodeProject\Presenters;

use CodeProject\Entities\Project;
use Prettus\Repository\Presenter\FractalPresenter;
use CodeProject\Transformers\ProjectTransformer;

class ProjectPresenter extends FractalPresenter{
	public function getTransformer(){
		return new ProjectTransformer();
	}
}
