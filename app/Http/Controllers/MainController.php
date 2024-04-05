<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

// class MainController extends Controller
// {
//     public function index()
//     {
//         $user = auth()->user();

//         $tasks = Task::select(
//                 'flows.flow_name',
//                 'flows.start_team',
//                 'flows.end_team',
//                 'flows.team_size',
//                 'tasks.task_name',
//                 'tasks.description',
//                 'tasks.customer',
//                 'tasks.max_project'
//             )
//             ->join('flows', 'tasks.flow_id', '=', 'flows.id')
//             ->join('groups_flows', 'flows.id', '=', 'groups_flows.flow_id')
//             ->where('groups_flows.group_id', $user->group_id)
//             ->join('groups', 'groups_flows.group_id', '=', 'groups.id')
//             ->join('users', 'groups.id', '=', 'users.group_id')
//             ->where('users.id', $user->id)
//             ->get();

//         $data = [];

//         foreach ($tasks as $task) {
//             $data[$task->flow_name][] = [
//                 'take_before' => $task->start_team,
//                 'finish_before' => $task->end_team,
//                 'max_projects' => $task->max_project,
//                 'max_team_size' => $task->team_size,
//                 'title' => $task->task_name,
//                 'description' => $task->description,
//                 'customer' => $task->customer,
//             ];
//         }

//         return view('tasks', ['data'=> $data]);
//     }
// }
