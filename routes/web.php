<?php
namespace App\Providers;

use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Shenime te ligjerates
//Detyra eshte me poshte
//
//Route::get('/', function () {
//    return view('welcome');
//});
//
//Route::get('/jobs', function(){
//    return "<h1>Available jobs</h1>";
//});
//
//Route::get('/jobs', function(){
//    return "<h1>Available jobs</h1>";
//})->name(name:"jobs"); //Me kete e vendojme nje emer qe pastaj ta perdorim me variabel
//
//Route::get('/testjobs', function(){
//    $url=route(name: "jobs");
//
//    return "<a href='$url'>Click here</a>";
//});
//
//Route::get('/api/users', function () {
//    return [
//        'name' => 'John Doe',
//        'email' => 'john@gmail.com',
//    ];
//});
//
//Route::redirect('/first', '/second');
//
//Route::get('/students/{id}', function($id){
//  return "This is the student with id {$id}";
//});
//
//Route::get('/students/{StudentId}/courses/{courseId}', function(string $StudentId,string $courseId){
//    return "This is the student with the id: $StudentId and course id: $courseId";
//});
//
//Route::get("/teachers/{teacherId?}", function ($teacherId = null) {
//    return $teacherId ? "The teacher id is: $teacherId" : "No teacher Specified!";
//});
//
//Route::get("/classes/{classId}", function ($classId) {
//    return "The class id is: {$classId}";
//})->where(name:"classId", expression:'[0-9]+');
//
////Route::get("/classes/{classId}", function ($classId) {
////    return "The class id is: {$classId}";
////})->whereAlpha(id);
//
////App service provider
//
//Route::get("/building/{buildingId}", function($buildingId) {
//   return "This is the building with the id: {$buildingId}";
//});


    //? me kete bejme orientim ne root structure per fajll dinamik dhe pastaj me naj veti = e dhene per filtrim




// Detyra e klases
//
//# Assignment: Routing, Requests & Responses
//
//Continue working on the project from this section. All routes go in `routes/web.php`.
//
//Add the following comment above your new routes:
//
//```php
//// Assignment: Routing, Requests & Responses
//```
//
//## Task 1: Basic & Named Routes
//
//- `GET /courses` returns `<h1>Available Courses</h1>`. Name it `courses`.
//- `GET /home` returns a link to the `courses` route. Generate the URL with `route()`.
//

    Route::get('/courses', function(){
       return "<h1>Available Courses</h1>";
    })->name(name: 'courses');

    Route::get('/home', function(){
        $url = route("courses");
        return "<a href='$url'>Courses</a>";
    });

//## Task 2: Route Parameters & Constraints
//
//- `GET /courses/{id}` returns `Course {id}`. `id` accepts numbers only.
//- `GET /courses/{id}/{title}` returns `Course {id}: {title}`. `id` accepts numbers only, `title` accepts letters only.
//- `GET /courses/category/{category?}` returns `Category: {category}`, or `All categories` if none is given.
//
    Route::get('/courses/{courseId}', function($courseId){
     return "Course id: $courseId";
    })->whereNumber('courseId');

    Route::get('/courses/{courseId}/{title}', function($courseId, $title){
        return "Course id: $courseId && title: $title";
    })->whereNumber('courseId')->whereAlpha('title');

    Route::get('/courses/category/{category?}', function($category = null){
        return $category ? "Category: $category" : "All Categories";
    });


//`http://localhost:8000/courses/abc` must return a 404.
//
//## Task 3: Request Object & Query Params
//
//`GET /courses/search` returns JSON with:
//
//- `keyword` using `$request->query()`
//- `level` using `$request->input()`, default `Beginner`
//- `hasKeyword` using `$request->has('keyword')`
//
//Expected result for `http://localhost:8000/courses/search?keyword=laravel`:
//
//    ```json
//{"keyword":"laravel","level":"Beginner","hasKeyword":true}
//```
//

Route::get('/courses/search', function (Request $request) {
    return [
        'keyword' => $request->query(),
        'level' => $request->input('Beginner'),
        'hasKeyword' => $request->has('keyword'),
    ];
});


//## Task 4: Response Helper
//
//`GET /courses/featured` returns, using `response()`:
//
//- JSON body: `{"message":"Featured courses"}`
//- Status code: `200`
//- Header: `X-Course-Source: Laravel`
//- Cookie: `last_visited` with the value `featured`
//
//Test with:
//
//```bash
//curl -i http://localhost:8000/courses/featured
//```
//

    Route::get('/courses/featured',function(){
        return response()->json(['message'=>'Featured courses'],200)
            ->header('X-Course-Source','Laravel')
            ->cookie('last_visited', 'featured');
    });

//## Task 5: Redirect & Route List
//
//- Redirect `/catalog` to `/courses`.
//- Run `php artisan route:list` and confirm all your routes are listed.
//



//## Submission
//
//1. Commit and push your project to a public GitHub repository.
//2. Submit the repository link in Google Classroom.
