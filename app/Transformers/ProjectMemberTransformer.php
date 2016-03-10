<?php

namespace CodeProject\Transformers;

use CodeProject\Entities\User;
use League\Fractal\TransformerAbstract;

class ProjectMemberTransformer extends TransformerAbstract{
	protected $default = [
		'user'
	];

	public function transform(ProjectMember $member){
		return [
			'project_id' => $member->project_id
		];
	}

	public function includeUser(ProjectMember $member){
		return $this->item($member->member, new MemberTransformer);
	}
}