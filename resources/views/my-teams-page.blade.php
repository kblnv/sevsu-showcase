<div>
  @if (count($this->flows) == 0 || !$this->hasTeams())
    <x-shared.page-heading>
      Вы не состоите ни в одной команде
    </x-shared.page-heading>
  @else
    <x-shared.page-heading>
      Все команды, в которых Вы состоите:
    </x-shared.page-heading>

    <div class="mt-4 space-y-8">
      @foreach ($this->flows as $flow => $params)
        @if (! empty($params))
          <x-entities.team-card
            :title="$params['team']['title']"
            :task="$params['team']['task']"
            :flow="$flow"
            :description="$params['team']['description']"
            :maxTeamMembers="$params['maxTeamMembers']"
            :tags="$params['team']['tags']"
            :members="$params['team']['members']"
          />
        @endif
      @endforeach
    </div>
  @endif
</div>
