<?php

namespace App\Livewire;

use App\Models\Flow;
use App\Models\TagTask;
use App\Models\Team;
use App\Models\UserTeam;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Команды')]
class TeamsPage extends Component
{
    use WithPagination;

    #[Url]
    public $selectedFlow = "";

    #[Computed(persist: true, seconds: 300)]
    public function flows()
    {
        $user = auth()->user();

        $flows = Flow::select(
                'flows.id',
                'flows.flow_name',
                'flows.max_team_size',
            )
            ->join('groups_flows', 'flows.id', '=', 'groups_flows.flow_id')
            ->where('groups_flows.group_id', $user->group_id)
            ->get();

        return $flows;
    }

    public function teams()
    {
        $user = auth()->user();

        $teams = Team::select(
                'teams.id',
                'teams.team_name',
                'teams.team_description',
                'tasks.id',
                'tasks.task_name',
                'tasks.task_description',
            )
            ->join('tasks', 'teams.task_id', '=', 'tasks.id')
            ->join('flows', 'tasks.flow_id', '=', 'flows.id')
            ->where('flows.flow_name', '=', $this->selectedFlow)
            ->paginate(10);

        return $teams;
    }

    public function members($teamId)
    {
        $members = UserTeam::select(
            'users.first_name',
            'users.second_name',
            'users.last_name',
            'users_teams.is_moderator',
        )
        ->join('users', 'users_teams.user_id', '=', 'users.id')
        ->join('teams', 'teams.id', '=', 'users_teams.team_id')
        ->where('teams.id', '=', $teamId)
        ->join('vacancies', 'users.id', '=', 'vacancies.user_id')
        ->where('vacancies.team_id', '=', $teamId)
        ->get();

        return $members;
    }

    public function tags($taskId)
    {
        $tags = TagTask::select('tags.tag_name')
            ->join('tags', 'tags_tasks.tag_id', '=', 'tags.id')
            ->where('tags_tasks.task_id', '=', $taskId)
            ->pluck('tag_name')
            ->toArray();

        return $tags;
    }

    public function mount()
    {
        if ($this->selectedFlow == "" || !$this->flows()->firstWhere('flow_name', $this->selectedFlow)) {
            $this->selectedFlow = $this->flows()->first()->flow_name ?? '';
        }
    }

    public function render()
    {
        return view('teams-page');
    }
}
