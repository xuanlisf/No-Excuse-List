<?php
// Show discussions the user has started
  // get total count
    $query = mysql_query("SELECT id FROM forum WHERE user_id='$user_id'");
    $count = mysql_num_rows($query);
  // display 10 at a time
    if(empty($_REQUEST['start'])){
      $start = 0;
    } else {
      $start = mysql_real_escape_string($_REQUEST['start']);
    }
    $query = mysql_query("SELECT * FROM forum WHERE user_id='$user_id' ORDER BY date DESC LIMIT $start,10");
    if($count > 10){
      $end = $start+10;
      if($end > $count){
        $end = $count;
      }
      $start++;
      $subTitle = "Showing $start-$end of $count Discussions";
    } else {
      $end = 10;
      $subTitle = "Showing All Discussions";
    }
    while($r = mysql_fetch_array($query)){
      $id = $r['id'];
      $threadTitle = $r['title'];
      $username = username($r['user_id']);
      $date = cuteTime($r['date']);
      $list .= "<li class='result'><h2><a href='discuss?i=$id&t=1'>$threadTitle</a></h2>
                    <p class='small'>$username started this thread $date</p>
                    <div id='small'><a href='discuss?i=$id&t=1' class='small faded'>".comments($id,1)."</a></div></li>";
    }
?>