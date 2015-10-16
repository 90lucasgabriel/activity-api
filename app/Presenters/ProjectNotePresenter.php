<?php

namespace CodeProject\Presenters;

use CodeProject\Entities\ProjectNote;
use Prettus\Repository\Presenter\FractalPresenter;
use CodeProject\Transformers\ProjectNoteTransformer;

class ProjectNotePresenter extends FractalPresenter{
	public function getTransformer(){
		return new ProjectNoteTransformer();
	}
}
