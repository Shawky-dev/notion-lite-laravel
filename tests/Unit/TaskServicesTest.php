<?php

namespace Tests\Unit;

use App\Models\Board;
use App\Models\Section;
use App\Models\Task;
use App\Models\User;
use App\Services\TaskServices;
use Error;
use ErrorException;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskServicesTest extends TestCase
{
    use RefreshDatabase;

    protected TaskServices $taskServices;

    protected function setUp(): void
    {
        parent::setUp();
        $this->taskServices = new TaskServices();
    }
    //__STORE__
    public function test_store_creates_task_successfully()
    {
        $user = User::factory()->create();
        $board = Board::factory()->create();
        $board->addUser($user);
        $section = Section::factory()->create(['board_id' => $board->id]);

        $data = [
            'title' => 'Test Task',
            'description' => 'This is a test desc.'
        ];
        $task = $this->taskServices->store($data, $section, $user);
        $this->assertDatabaseHas(
            'tasks',
            [
                'id' => $task->id,
                'title' => 'Test Task',
                'description' => 'This is a test desc.',
                'section_id' => $section->id,
                'user_id' => $user->id,
            ]
        );
    }

    public function test_store_unauthorized_user_throws_exception()
    {

        $this->expectException(AuthorizationException::class);

        $auth_user = User::factory()->create();
        $board = Board::factory()->create();
        $board->addUser($auth_user);
        $non_auth_user = User::factory()->create();
        $section = Section::factory()->create(['board_id' => $board->id]);

        $data = [
            'title' => 'Test Task',
            'description' => 'This is a test desc.'
        ];
        $task = $this->taskServices->store($data, $section, $non_auth_user);
    }
    public function test_store_missing_attribute_throws_err()
    {
        $this->expectException(Exception::class);

        $auth_user = User::factory()->create();
        $board = Board::factory()->create();
        $board->addUser($auth_user);
        $non_auth_user = User::factory()->create();
        $section = Section::factory()->create(['board_id' => $board->id]);

        $data = [
            'description' => 'This is a test desc.'
        ];
        $task = $this->taskServices->store($data, $section, $non_auth_user);
    }
    public function test_store_Section_wit_no_Board_throws_exception()
    {
        $this->expectException(Error::class);

        $user = User::factory()->create();
        $board = Board::factory()->create();
        $board->addUser($user);
        $section = Section::factory()->create();
        $section->setRelation('board', null);

        $data = [
            'title' => 'Test Task',
            'description' => 'This is a test desc.'
        ];
        $task = $this->taskServices->store($data, $section, $user);
    }
    //__UPDATE__
    public function test_update_task_successfully()
    {
        $user = User::factory()->create();
        $board = Board::factory()->create();
        $board->users()->attach($user);
        $section = Section::factory()->create(['board_id' => $board->id]);
        $task = Task::factory()->create([
            'section_id' => $section->id,
            'user_id' => $user->id,
            'title' => 'Old Title',
        ]);

        $updateData = ['title' => 'Updated Title'];

        $updatedTask = $this->taskServices->update($updateData, $task, $user);

        $this->assertEquals('Updated Title', $updatedTask->title);
        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
            'title' => 'Updated Title'
        ]);
    }
    public function test_update_unauthorized_user_throws_exception()
    {
        $this->expectException(AuthorizationException::class);

        $auth_user = User::factory()->create();
        $non_auth_user = User::factory()->create();

        $board = Board::factory()->create();
        $board->users()->attach($auth_user);
        $section = Section::factory()->create(['board_id' => $board->id]);

        $task = Task::factory()->create([
            'section_id' => $section->id,
            'user_id' => $auth_user->id,
            'title' => 'Old Title',
        ]);

        $updateData = ['title' => 'Updated Title'];

        $updatedTask = $this->taskServices->update($updateData, $task, $non_auth_user);
    }
    public function test_update_invalid_data_throws_exception()
    {
        $this->expectException(Exception::class);

        $auth_user = User::factory()->create();
        $non_auth_user = User::factory()->create();

        $board = Board::factory()->create();
        $board->users()->attach($auth_user);
        $section = Section::factory()->create(['board_id' => $board->id]);

        $task = Task::factory()->create([
            'section_id' => $section->id,
            'user_id' => $auth_user->id,
            'title' => 'Old Title',
        ]);

        $updateData = ['tit2le' => 'Updated Title'];

        $updatedTask = $this->taskServices->update($updateData, $task, $non_auth_user);
    }
    //__DESTROY__
    public function test_destroy_task_successfully()
    {
        $user = User::factory()->create();
        $board = Board::factory()->create();
        $board->users()->attach($user);
        $section = Section::factory()->create(['board_id' => $board->id]);

        $task = Task::factory()->create([
            'section_id' => $section->id,
            'user_id' => $user->id,
        ]);

        $this->taskServices->destroy($task, $user);

        $this->assertDatabaseMissing('tasks', [
            'id' => $task->id
        ]);
    }
    public function test_destroy_unauthorized_user_throws_exception()
    {
        $this->expectException(AuthorizationException::class);

        $authorizedUser = User::factory()->create();
        $unauthorizedUser = User::factory()->create();

        $board = Board::factory()->create();
        $board->users()->attach($authorizedUser);
        $section = Section::factory()->create(['board_id' => $board->id]);

        $task = Task::factory()->create([
            'section_id' => $section->id,
            'user_id' => $authorizedUser->id,
        ]);

        $this->taskServices->destroy($task, $unauthorizedUser);
    }
    //__SHOW__
    public function test_show_returns_task_successfully()
    {
        $user = User::factory()->create();
        $board = Board::factory()->create();
        $board->users()->attach($user);

        $section = Section::factory()->create(['board_id' => $board->id]);
        $task = Task::factory()->create([
            'section_id' => $section->id,
            'user_id' => $user->id,
            'title' => 'Visible Task',
        ]);

        $fetchedTask = $this->taskServices->show($task, $user);

        $this->assertEquals($task->id, $fetchedTask->id);
        $this->assertEquals('Visible Task', $fetchedTask->title);
    }
    public function test_show_unauthorized_user_throws_exception()
    {
        $this->expectException(AuthorizationException::class);

        $authorizedUser = User::factory()->create();
        $unauthorizedUser = User::factory()->create();

        $board = Board::factory()->create();
        $board->users()->attach($authorizedUser);

        $section = Section::factory()->create(['board_id' => $board->id]);

        $task = Task::factory()->create([
            'section_id' => $section->id,
            'user_id' => $authorizedUser->id,
        ]);

        $this->taskServices->show($task, $unauthorizedUser);
    }
}
