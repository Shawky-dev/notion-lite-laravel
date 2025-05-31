<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Board extends Model
{
    //temp value

    protected $fillable = [
        'title',
        'description'
    ];

    // In Board model
    public static function createWithCreator(array $data, User $creatorUser): Board
    {
        // Create board
        $board = new self($data);
        $board->save();

        // Attach creator as member
        $board->addUser($creatorUser);

        // Create default sections and tasks
        $defaultSections = [
            'todo' => ['Task 1', 'Task 2', 'Task 3'],
            'pending' => ['Task 4', 'Task 5'],
            'completed' => ['Task 6', 'Task 7'],
        ];

        foreach ($defaultSections as $sectionTitle => $tasks) {
            $section = $board->sections()->create(['title' => $sectionTitle]);
            foreach ($tasks as $index => $taskTitle) {
                $section->tasks()->create([
                    'title' => $taskTitle,
                    'user_id' => $creatorUser->id,
                    'description' => 'desc' . $index,
                ]);
            }
        }

        return $board;
    }



    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class)
            ->withPivot('joined_at')
            ->withTimestamps();
    }
    public function sections(): HasMany
    {
        return $this->hasMany(Section::class);
    }
    public function addUser(User $user)
    {
        if (!$this->users()->where('user_id', $user->id)->exists()) {
            $this->users()->attach($user->id, [
                'joined_at' => now(),
            ]);
        }
    }
}
