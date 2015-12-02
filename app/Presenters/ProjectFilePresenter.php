<?php

namespace CodeProject\Presenters;

use CodeProject\Entities\ProjectFile;
use Prettus\Repository\Presenter\FractalPresenter;
use CodeProject\Transformers\ProjectFileTransformer;

class ProjectFilePresenter extends FractalPresenter{
	public function getTransformer(){
		return new ProjectFileTransformer();
	}
}