@extends('layouts.index.default')
@include('scoreboard.score_get')
@include('scoreboard.score_parse')


@section('title', '球場一覧')

@section('content')

<div class="cp_tab">
	<input type="radio" name="cp_tab" id="tab1_1" aria-controls="first_tab01" checked>
	<label for="tab1_1">プロ野球</label>
	<input type="radio" name="cp_tab" id="tab1_2" aria-controls="second_tab01">
	<label for="tab1_2">Jリーグ</label>
	<input type="radio" name="cp_tab" id="tab1_3" aria-controls="third_tab01">
	<label for="tab1_3">バスケ</label>
	<div class="cp_tabpanels">
		<div id="first_tab01" class="cp_tabpanel">
      <h2>野球場一覧</h2>
      <table class="table table-bordered">
        <tbody>
          <?php 
          $line_count = 0;
          $stadium_count = 0;
          ?>
          <!-- 試合が開催されている -->
          @forelse ($stadium_posts[0] as $stadium_post)
            @if ($line_count == 0)
              <tr>
            @endif
            <?php 
                $score_parse = new Score_Parse($stadium_posts[1], $stadium_post->stadium, true);
                $stadium = $score_parse->stadium_game();
            ?>
            @if (strcmp($stadium_post->league, "プロ野球") === 0 && $line_count != 2)
              <?php
              if(strpos($stadium_post->stadium, $stadium) !== false){
              ?>
              <td>
                <a href="{{ action('StadiumPostsController@show', $stadium_post->id) }}">{{ $stadium_post->stadium }}</a>
                <?php       
                  index_scoreboard($stadium_posts[1], $stadium_post->stadium); 
                  $start_game_stadium[$stadium_count] = $stadium;
                  $stadium_count++;
                  $line_count++;
                ?>
              </td>
              <?php
              }
              ?>
            @endif
            @if ($line_count >= 2)
              </tr>
              <?php $line_count = 0; ?>
            @endif
          @empty
            スタジアムが登録されていません
          @endforelse

          <!-- 試合が開催されていない -->
          @forelse ($stadium_posts[0] as $stadium_post)
            @if ($line_count == 0)
              <tr>
            @endif
            @if (strcmp($stadium_post->league, "プロ野球") === 0 && $line_count != 2)
              <?php 
                $no_stadium = false;
                for($i = 0; $i < $stadium_count; $i++){
                  if(strpos($stadium_post->stadium, $start_game_stadium[$i]) !== false){
                    $no_stadium = true;
                    break;
                  }
                }
                if($no_stadium == false){
                  echo "<td>";
              ?>
              <a href="{{ action('StadiumPostsController@show', $stadium_post->id) }}">{{ $stadium_post->stadium }}</a>
              <?php
                  // echo "<a href='{{ action('StadiumPostsController@show'," . $stadium_post->id . ") }}'>{{" . $stadium_post->stadium . "}}</a>";
                  echo "</td>";
                  $line_count++;
                }
              ?>
              
            @endif
            @if ($line_count >= 2)
              </tr>
              <?php $line_count = 0; ?>
            @endif
          @empty
            スタジアムが登録されていません
          @endforelse
         </tbody>
       </table>
		</div>
		<div id="second_tab01" class="cp_tabpanel">
     <h2>Jリーグ球場一覧</h2> 
     <table class="table table-bordered">
        <tbody>
          <?php $line_count = 0; ?>
          @forelse ($stadium_posts[0] as $stadium_post)
            @if ($line_count == 0)
              <tr>
            @endif
            @if (strcmp($stadium_post->league, "Jリーグ") === 0 && $line_count != 2)
              <td>
                <a href="{{ action('StadiumPostsController@show', $stadium_post->id) }}">{{ $stadium_post->stadium }}</a>
              </td>
              <?php $line_count++; ?>
            @endif
            @if ($line_count >= 2)
              </tr>
              <?php $line_count = 0; ?>
            @endif
          @empty
            スタジアムが登録されていません
          @endforelse
        </tbody>
      </table>
		</div>
		<div id="third_tab01" class="cp_tabpanel">
		<h2>工事中...</h2>
		</div>
	</div>
</div>
<script src="/js/delete.js"></script>
@endsection