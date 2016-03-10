<?php

namespace CodeProject\Presenters;

use CodeProject\Entities\ProjectMember;
use Prettus\Repository\Presenter\FractalPresenter;
use CodeProject\Transformers\ProjectMemberTransformer;

class ProjectMemberPresenter extends FractalPresenter{
	public function getTransformer(){
		return new ProjectMemberTransformer();
	}
}
