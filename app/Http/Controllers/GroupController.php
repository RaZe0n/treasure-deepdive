<?php

namespace App\Http\Controllers;

use App\Events\GroupAssigned;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    public function generateGroups(Request $request)
    {
        $request->validate([
            'groupsAmount' => 'required|integer|min:1',
            'groupSize' => 'required|integer|min:2|max:6'
        ]);

        // Get all waiting students
        $students = \App\Models\User::where('status', 'waiting')->get();
        
        // Shuffle students
        $students = $students->shuffle();
        
        // Generate groups
        $groups = [];
        $colors = ['red', 'blue', 'green', 'yellow', 'purple', 'orange', 'pink', 'teal'];
        
        for ($i = 0; $i < $request->groupsAmount; $i++) {
            $groupStudents = $students->splice(0, $request->groupSize);
            $color = $colors[$i % count($colors)];
            $groupName = 'Groep ' . ($i + 1);
            
            foreach ($groupStudents as $student) {
                // Update student status
                $student->update(['status' => 'assigned']);
                
                // Broadcast event to student
                event(new GroupAssigned(
                    $student->id,
                    $color,
                    $groupName
                ));
            }
            
            $groups[] = [
                'name' => $groupName,
                'color' => $color,
                'students' => $groupStudents->pluck('name')
            ];
        }
        
        return response()->json([
            'message' => 'Groups generated successfully',
            'groups' => $groups
        ]);
    }
}
