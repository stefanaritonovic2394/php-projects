<?php

use App\Libraries\QueryBuilder;

/* Select all users */
//$users = QueryBuilder::from('users')->selectAll();
$users = QueryBuilder::table('users')->selectAll()->get();
//echo '<pre>';
//die(var_dump($users));
//echo '</pre>';
$posts = QueryBuilder::table('posts')->selectAll()->get();

/* Select user by id */
//$post = QueryBuilder::get()->from('posts')->selectById(2);
//$user = QueryBuilder::table('users')->selectById(11);

/* Insert user */
//$insert = QueryBuilder::table('users')->insertUser('Bojan', 'bojan@gmail.com', 'bojan22');
//$insertPost = QueryBuilder::insertPost('Treci Post', 'Ovo je treci post', now());
//$insert = QueryBuilder::table('posts')->insertPost('Treci post', 'Ovo je treci post', date('Y-m-d H:i:s'));
//$insert = QueryBuilder::table('users')->insert([
//    'name' => 'Miljana',
//    'email' => 'miljana@gmail.com',
//    'password' => password_hash('miljana', PASSWORD_BCRYPT)
//]);

/* Update user */
//$update = QueryBuilder::updateUser('Test2', 'test2@gmail.com', 'test2', 9);
//$update = QueryBuilder::table('users')->updateUser('Test2', 'test2@gmail.com', 'test2', 9);
//$update = QueryBuilder::table('users')->where(['id' => 10])->update([
//    'name' => 'Test3',
//    'email' => 'test3@gmail.com',
//    'password' => password_hash('testtri', PASSWORD_BCRYPT)
//]);

/* Delete user */
//$delete = QueryBuilder::deleteUser(7);
//$delete = QueryBuilder::table('users')->deleteUser(12);
//$delete = QueryBuilder::table('users')->where(['id' => 9])->delete();
