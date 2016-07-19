<?php

namespace CodeProject\Transformers;

use CodeProject\Entities\Project;
use CodeProject\Entities\Client;
use League\Fractal\TransformerAbstract;

class ProjectTransformer extends TransformerAbstract{
	protected $defaultIncludes = ['members', 'notes', 'tasks', 'files', 'client'];

	public function transform(Project $project){
   	 return [
   		 'id' => $project->id,
   		 'project_id' => $project->id,
   		 'client_id' => $project->client_id,   		 
   		 'owner_id' => $project->owner_id,
   		 'owner' => $project->owner,
   		 'name' => $project->name,
   		 'description' => $project->description,
   		 'progress' => $project->progress,
   		 'status' => $project->status,
   		 'due_date' => $project->due_date,
   		 'is_member' => $project->owner_id != \Authorizer::getResourceOwnerId(),
   		 'tasks_count' => $project->tasks->count(),
   		 'tasks_opened' => $this->countTasksOpened($project)
   	 ];
    }

	public function includeClient(Project $project){
		return $this->item($project->client, new ClientTransformer());
	}

    public function includeMembers(Project $project){
   	 return $this->collection($project->members, new MemberTransformer());
   	 //return $this->collection($project->members, new MemberTransformer());
    }

    public function includeNotes(Project $project){
   	 return $this->collection($project->notes, new ProjectNoteTransformer());
    }

    public function includeFiles(Project $project){
   	 return $this->collection($project->files, new ProjectFileTransformer());
    }

    public function includeTasks(Project $project){
   	 return $this->collection($project->tasks, new ProjectTaskTransformer());
    }

    public function countTasksOpened(Project $project){
   	 $count = 0;
   	 foreach($project->tasks as $o){
   		 if($o->status == 1){
   			 $count++;
   		 }
   	 }
    	return $count;
    }

}
