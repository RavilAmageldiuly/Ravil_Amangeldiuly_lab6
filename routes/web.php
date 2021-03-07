<?php

use Illuminate\Support\Facades\Route;
use App\Models\Student;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/insert', function() {
	DB::insert('insert into students(id, name, date_of_birth, GPA, advisor) values(?,?,?,?,?)', [1, 'Ravil', '2001-12-20', 2.7, 'Kurmangazy Kongratbayev']);
});

Route::get('/select', function() {
	$result = DB::select('select * from students where id = ?',[1]);
	foreach($result as $student) {
		echo 'ID: '.$student->id;
		echo "<br>";
		echo 'Name: '.$student->name;
		echo "<br>";
		echo 'Birthday: '.$student->date_of_birth;
		echo "<br>";
		echo 'GPA: '.$student->GPA;
		echo "<br>";
		echo 'Advisor: '.$student->advisor;
		echo "<br>";
		echo '===========================';
		echo "<br>";
	}
});

Route::get('/update', function() {
	$update = DB::update('update students set advisor = "Ualikhan Sadyk" where id = ?', [1]);
	return $update;
});

Route::get('/delete', function() {
	$delete = DB::delete('delete from students where id = ?', [1]);
	return $delete;
});

Route::get('/read', function() {
	$students=Student::all();
	foreach($students as $student) {
		echo $student->id;
		echo "<br>";
		echo $student->name;
		echo "<br>";
		echo $student->date_of_birth;
		echo "<br>";
		echo $student->GPA;
		echo "<br>";
		echo $student->advisor;
		echo "<br>";
	}
});

Route::get('/find', function() {
	$students = Student::find(2);
	return $students->name;
});

Route::get('/find_row', function() {
	$students = Student::where('id', 1)->first();
	return $students;
});

Route::get('/find_value', function() {
	$students = Student::where('id', 1)->value('name');
	return $students;
});

Route::get('/insert_by_model', function() {
	$student = new Student;
	$student->id = 2;
	$student->name = 'Arsen';
	$student->date_of_birth = '2002-04-01';
	$student->GPA = 3.0;
	$student->advisor = 'Zhangir Rayev';
	$student->save();
});

Route::get('/update_by_model', function() {
	$student=Student::find(2);
	$student->advisor='Ualikhan Sadyk';
	$student->save();
});

Route::get('/delete_by_model', function() {
	Student::where('id', 2)->delete();
});