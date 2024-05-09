<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Flow;
use App\Models\Group;
use App\Models\GroupFlow;
use App\Models\Tag;
use App\Models\TagTask;
use App\Models\Task;
use App\Models\Team;
use App\Models\User;
use App\Models\UserTeam;
use App\Models\Vacancy;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $groups = [
            ['group_name' => 'ИС/б-21-3-о'],
            ['group_name' => 'ИС/б-21-2-о'],
            ['group_name' => 'ИС/б-21-1-о'],
        ];

        $flows = [
            [
                'flow_name' => 'Веб-дизайн',
                'take_before' => Carbon::now(),
                'finish_before' => Carbon::now()->addWeek(),
                'max_team_size' => 10,
                'can_create_task' => 0,
            ],
            [
                'flow_name' => 'Проектирование',
                'take_before' => Carbon::now()->addDay(),
                'finish_before' => Carbon::now()->addDay()->addWeek(),
                'max_team_size' => 15,
                'can_create_task' => 0,
            ],
            [
                'flow_name' => 'Компьютерная схемотехника',
                'take_before' => Carbon::now()->addDays(2),
                'finish_before' => Carbon::now()->addDays(2)->addWeek(),
                'max_team_size' => 10,
                'can_create_task' => 1,
            ],
        ];

        foreach ($groups as $group) {
            Group::updateOrCreate($group);
        }

        foreach ($flows as $flow) {
            Flow::firstOrCreate(
                ['flow_name' => $flow['flow_name']],
                [
                    'take_before' => $flow['take_before'],
                    'finish_before' => $flow['finish_before'],
                    'max_team_size' => $flow['max_team_size'],
                    'can_create_task' => $flow['can_create_task'],
                ]
            );
        }

        $flowsId = Flow::all('id')->pluck('id')->toArray();

        for ($i = 1; $i < 4; $i++) {
            switch ($i) {
                case 1:
                    GroupFlow::firstOrCreate(['flow_id' => $flowsId[0], 'group_id' => $i]);
                    GroupFlow::firstOrCreate(['flow_id' => $flowsId[1], 'group_id' => $i]);
                    GroupFlow::firstOrCreate(['flow_id' => $flowsId[2], 'group_id' => $i]);
                    break;
                case 2:
                    GroupFlow::firstOrCreate(['flow_id' => $flowsId[1], 'group_id' => $i]);
                    GroupFlow::firstOrCreate(['flow_id' => $flowsId[2], 'group_id' => $i]);
                    break;
                case 3:
                    GroupFlow::firstOrCreate(['flow_id' => $flowsId[2], 'group_id' => $i]);
                    break;
            }
        }

        $flows = Flow::all(['id', 'flow_name']);
        foreach ($flows as $flow) {
            for ($i = 1; $i <= 30; $i++) {
                Task::firstOrCreate(
                    [
                        'flow_id' => $flow->id,
                        'task_name' => 'Задача '.$i.' дисциплины '.$flow->flow_name,
                    ],
                    [
                        'task_description' => 'Описание задачи '.$i,
                        'customer' => 'Заказчик '.$i,
                        'max_projects' => rand(1, 15),
                    ]
                );
            }
        }

        for ($i = 1; $i <= 3; $i++) {
            Tag::firstOrCreate([
                'tag_name' => 'Тэг '.$i,
            ]);
        }

        $tasks = Task::all();
        foreach ($tasks as $task) {
            for ($i = 1; $i < rand(2, 3); $i++) {
                $tagId = Tag::pluck('id')->random();

                $existingTagTask = TagTask::where('task_id', $task->id)
                    ->where('tag_id', $tagId)
                    ->exists();

                if (! $existingTagTask) {
                    TagTask::create([
                        'task_id' => $task->id,
                        'tag_id' => $tagId,
                    ]);
                }
            }
        }

        User::factory(60)->create();

        for ($i = 1; $i <= 30; $i++) {
            do {
                $task = Task::query()->inRandomOrder()->first();
                $teams = Team::where('task_id', $task->id)->get();
                $remainingTasks = $task->max_projects - $teams->count();
            } while ($remainingTasks <= 0);

            Team::firstOrCreate(
                [
                    'team_name' => 'Команда '.$i,
                    'task_id' => $task->id,
                ],
                [
                    'team_description' => 'Описание команды '.$i,
                    'password' => random_int(0, 1) ? Hash::make(random_int(1, 10)) : null,
                ]
            );
        }

        $teams = Team::all();
        foreach ($teams as $team) {
            $users = User::select('users.id')
                ->join('groups_flows', 'users.group_id', '=', 'groups_flows.group_id')
                ->join('tasks', 'groups_flows.flow_id', '=', 'tasks.flow_id')
                ->where('tasks.id', '=', $team->task_id)
                ->get();

            $maxTeamSize = Task::select('flows.max_team_size')
                ->where('tasks.id', '=', $team->task_id)
                ->join('flows', 'flows.id', '=', 'tasks.flow_id')
                ->value('flows.max_team_size');

            $usersCount = $users->count();
            $remainingUsers = $maxTeamSize - $usersCount;

            if ($remainingUsers > 0) {
                foreach ($users as $user) {
                    UserTeam::firstOrCreate([
                        'user_id' => $user->id,
                        'team_id' => $team->id,
                    ], [
                        'is_moderator' => rand(0, 1),
                    ]);
                }
            } else {
                $teamSize = $maxTeamSize - rand(0, $maxTeamSize - 5);
                for ($i = 0; $teamSize != 0; $teamSize--, $i++) {
                    UserTeam::firstOrCreate([
                        'user_id' => $users[$i]->id,
                        'team_id' => $team->id,
                    ], [
                        'is_moderator' => rand(0, 1),
                    ]);
                }
            }
        }

        foreach ($teams as $team) {
            for ($i = 1; $i < rand(3, 8); $i++) {
                $users = UserTeam::select('user_id')
                    ->where('team_id', '=', $team->id)
                    ->get();

                Vacancy::firstOrCreate([
                    'team_id' => $team->id,
                    'vacancy_name' => 'Вакансия '.$i,
                ], [
                    'user_id' => rand(0, 1) ? $users->pluck('user_id')->random() : null,
                ]);
            }
        }
    }
}
