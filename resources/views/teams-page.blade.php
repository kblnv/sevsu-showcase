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
    >
      <option value="" disabled>Дисциплина</option>
      @foreach ($flowsNames as $flowName)
        @if ($flowName == $selectedFlow)
          <option value="{{ $flowName }}" selected>{{ $flowName }}</option>
        @else
          <option value="{{ $flowName }}">{{ $flowName }}</option>
        @endif
      @endforeach
    </x-shared.select>

    @if (count($this->flows[$selectedFlow]["teams"]) == 0)
      <x-shared.page-heading class="mt-8">
        Нет команд по выбранной дисциплине
      </x-shared.page-heading>
    @else
      <x-shared.page-heading class="mt-8">
        Все команды по выбранной дисциплине:
      </x-shared.page-heading>

      <div class="mt-4 space-y-8">
        @foreach ($this->flows[$selectedFlow]["teams"] as $team)
          <x-entities.team-card
            :title="$team['title']"
            :task="$team['task']"
            :description="$team['description']"
            :maxTeamMembers="$this->flows[$selectedFlow]['maxTeamMembers']"
            :tags="$team['tags']"
            :members="$team['members']"
          />
        @endforeach
      </div>
    @endif
  @endif
</div>
