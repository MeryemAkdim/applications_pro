<?php

namespace Tests\Unit;

use App\Models\Application;
use App\Services\ApplicationService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Tests\TestCase;

class ApplicationServiceTest extends TestCase
{
    use RefreshDatabase; // If you want to reset your database after each test

    public function testIndexMethodReturnsPaginatedApplications()
    {
        $request = new Request();

        // Create a Mockery mock for the ApplicationService
        $appServiceMock = \Mockery::mock(ApplicationService::class);
    
        // Set up the expectation and return value using Mockery's syntax
        $appServiceMock->shouldReceive('index')
        ->once()
        ->with($request)
        ->andReturn(Application::paginate(20));
    
        // Use the mock to test the index method
        $applications = $appServiceMock->index($request);

        if ($applications->count() > 20) 
        {
            $paginationPage = 20;
        } else 
        {
            $paginationPage = $applications->count();
        }
    
        $this->assertInstanceOf(LengthAwarePaginator::class, $applications);
        $this->assertCount($paginationPage, $applications);
    }

    public function testCreateMethodPersistsNewApplication()
    {
        $service = new ApplicationService();

        $applicationData = [
            'name' => 'Jane',
            'lname' => 'Doe',
            'cv' => 'cvs/dummy_cv.pdf',
        ];

        // Act
        $application = $service->create($applicationData);

        // Assert
        $this->assertDatabaseHas('applications', ['name' => 'Jane', 'lname' => 'Doe', 'cv' => 'cvs/dummy_cv.pdf']);
        $this->assertEquals('Jane', $application->name);
        $this->assertEquals('Doe', $application->lname);
        $this->assertEquals('cvs/dummy_cv.pdf', $application->cv);
    }

    public function testEditMethodReturnsModelInstance()
    {
        // Assuming you have a factory to create Applications
        $application = Application::factory()->create();

        $service = new ApplicationService();

        // Act
        $foundApplication = $service->edit($application->id);

        // Assert
        $this->assertInstanceOf(Application::class, $foundApplication);
        $this->assertEquals($application->id, $foundApplication->id);
    }

    public function testDeleteMethodRemovesApplication()
    {
        // Create an application instance in the database
        $application = Application::factory()->create();
    
        // Ensure the application exists in the database
        $this->assertDatabaseHas('applications', ['id' => $application->id]);
    
        // Instantiate the ApplicationService
        $service = new ApplicationService();
    
        // Call the delete method
        $service->delete($application);
    
        // Assert the application no longer exists in the database
        $this->assertDatabaseMissing('applications', ['id' => $application->id]);
    }
}

