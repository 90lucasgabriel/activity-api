<?php

namespace CodeProject\Transformers;

use CodeProject\Entities\Client;
use CodeProject\Entities\Project;
use League\Fractal\TransformerAbstract;

class ClientTransformer extends TransformerAbstract{
	protected $defaultIncludes = ['projects'];

	public function transform(Client $client){
		return [
			'id'          => $client->id,
			'name'        => $client->name,
			'responsible' => $client->responsible,
			'email'       => $client->email,
			'phone'       => $client->phone,
			'address'     => $client->address,
			'obs'         => $client->obs,
			'created_at'  => $client->created_at,
			'updated_at'  => $client->updated_at
		];
	}
	
	public function includeProjects(Client $client)
	{
		$transformer = new ProjectTransformer();
		$transformer->setDefaultIncludes([]);
		return $this->collection($client->projects, $transformer);
	}
}
