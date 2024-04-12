<div>
  @if ($selectedFlow == "")
    <x-shared.page-heading>
      Вы не прикреплены ни к одной дисциплине
    </x-shared.page-heading>
  @else
    <x-shared.select
      id="flow"
      label="Выберите дисциплину для отображения:"
      wire:model.live="selectedFlow"
      wire:change="setPage(1)"
    >
      <option value="" disabled>Дисциплина</option>
      @foreach ($this->flows as $flow)
        @if ($flow->flow_name == $selectedFlow)
          <option value="{{ $flow->flow_name }}" selected>{{ $flow->flow_name }}</option>
        @else
          <option value="{{ $flow->flow_name }}">{{ $flow->flow_name }}</option>
        @endif
      @endforeach
    </x-shared.select>

    @if ($this->tasks()->count() == 0)
      <x-shared.page-heading class="mt-8">
        Нет задач по выбранной дисциплине
      </x-shared.page-heading>
    @else
      <x-shared.page-heading class="mt-8">
        Банк задач по выбранной дисциплине:
      </x-shared.page-heading>

      <div class="mt-4 space-y-8">
        @foreach ($this->tasks()->items() as $task)
          <x-entities.task-card
            :title="$task['task_name']"
            :customer="$task['customer']"
            :description="$task['task_description']"
            :takeBefore="$this->flows->firstWhere('flow_name', $selectedFlow)->take_before"
            :finishBefore="$this->flows->firstWhere('flow_name', $selectedFlow)->finish_before"
            :maxTeamMembers="$this->flows->firstWhere('flow_name', $selectedFlow)->max_team_size"
            :maxTeams="$task['max_projects']"
            :tags="$this->tags($task['id'])"
          />
        @endforeach
      </div>
    @endif

    {{ $this->tasks()->links() }}
  @endif
</div>
