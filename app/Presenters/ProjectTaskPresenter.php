<?php

namespace CodeProject\Presenters;

use CodeProject\Entities\ProjectTask;
use Prettus\Repository\Presenter\FractalPresenter;
use CodeProject\Transformers\ProjectTaskTransformer;

class ProjectTaskPresenter extends FractalPresenter{
	public function getTransformer(){
		return new ProjectTaskTransformer();
	}
}
