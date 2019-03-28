<!DOCTYPE HTML>
<html lang="en">
  <head>
    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<script>
  (adsbygoogle = window.adsbygoogle || []).push({
    google_ad_client: "ca-pub-6257632362265433",
    enable_page_level_ads: true
  });
</script>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Gleamlist</title>
    <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-122315868-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-122315868-1');
</script>

    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="og:description" content="Gleamlist is the largest collection of running gleam.io giveaways. Most giveaways can be entered in less than 30 seconds.">


    <meta name="description" content="Gleamlist is the largest collection of running gleam.io giveaways. Most can be entered in less than 30 seconds.">


  </head>
  <body>
    <div class="topnav" id="myTopnav">
      <a href="/index.php" class="active">Home</a>
      <a href="/ended.php">Ended giveaways(Beta)</a>
      <a href="/tips.html">Tips for entering gleam giveaways</a>
      <a href="/upcoming.html">Upcoming features!</a>
      <a href="/contact.html">Contact</a>
      <a href="javascript:void(0);" class="icon" onclick="myFunction()">
    <i class="fa fa-bars"></i>
    </a>
    </div>
    <script>
    function myFunction() {
      var x = document.getElementById("myTopnav");
      if (x.className === "topnav") {
        x.className += " responsive";
      } else {
        x.className = "topnav";
      }
    }
    </script>
</div>
<div class="tablem">

  <p>This is currently a beta feature and will only include the top 1000 results due to mobile performance issues.</p>



      <form action="/ended.php" method="get">
        <input type='submit' name ='ending' value='Order by time ending'>
        <input type='submit' name ='added' value='Order by time added'>


    <table border="1">
        <thead>

                <td> <b>Prize </b></td>
                <td><b>time giveaway ended</b></td>
            </tr>
        </thead>
        <tbody>
    <?php

    function makeTable($qry){
      try
  {
    $db = new PDO('sqlite:/home/py_server/gleam2.db');
  }
  catch (PDOException $e)
  {
    echo 'Connection failed: ' . $e->getMessage();
  }
      $result = $db->query($qry);

      //print($result);
      $num=0;
      while($data =$result->fetchObject())
      {
        $d1 = new DateTime();
        $d1->SetTimeStamp($data->time_end);

        //$diff = $datetime->diff(date('m/d/Y h:i:s', time()))
        ?>
        <tr>
          <td>
            <a href="<?php echo $data->url;?>" target="_blank"><?php echo $data->title;?> </a>
          </td>
        <td>
          <p> <?php echo $d1->format('l jS \of F Y h:i:s A') ;?></p>
        </td>

      </tr>
        <?php
      }
      $db = null;
    }



$orderBy = array('added', 'ending');    //$db = new SQLite3('gleam2.db');

$order ='added';
$qry3= "Select * from tmp2 where time_end < strftime('%s', 'now') ORDER By time_added asc LIMIT 1000";
$qry4= "Select * from tmp2 where time_end < strftime('%s', 'now') ORDER By time_end desc LIMIT 1000";
$qry = $qry4;

if (isset($_GET['added'])) {
  $qry = $qry3;
makeTable($qry);
}
makeTable($qry);

    ?>
  </tbody>
  </table>
</form>
<p>
  Notice: I am in no way associated with gleam.io, nor any of the sponsors who provide the prizes.</p>
</div>
  </body>
</html>
