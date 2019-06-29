<?php
namespace App\Http\Controllers;
use App\Post; // Model: Post (Replace with your model)

class PostController extends Controller {
    public function searchPost($item) {
          $posts = Post::where('name','LIKE',"%{$item}%")->get();
          if(!$posts) {
              // If no data found 
              // Returning 400 status to mui-autocomplete to handle error but for xhr it returns 200 (status ok).
              $response = [
               'message' => 'No data found',
               'status' => 400
             ];
             return response()->json($response, 200);
          }
          $response = [
            'posts' => $posts,
            'status' => 200
          ];
          return response()->json($response, 200);
        }
  }
