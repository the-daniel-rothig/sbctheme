<?php /* Template Name: Triage results page */ 

get_header();?>

<div class="grid-row">
  <div id="primary" class="content-area column-two-thirds">
      <?php

      while(have_posts()) {
        the_post();
        the_content();
      }

      $resultsquery = new WP_Query(array(
        'post_parent' => get_page_by_title('results')->ID,
        'post_status' => 'publish',
        'post_type' => 'page',
        'order' => 'ASC'
        ));

      while ($resultsquery->have_posts()) {
        $resultsquery->the_post();

        foreach (get_post_meta(get_the_ID()) as $key => $value) {
          if (substr($key, 0,7) !== 'filter_' || $value[0] == '') {
            continue 1;
          }
          if(isset($_GET[substr($key, 7)]) && !in_array($_GET[substr($key, 7)], explode(",",$value[0]))) {
            continue 2; //skip this advice; it doesn't apply
          }
        }

        $escalationlevel = get_post_meta(get_the_ID(), 'escalation_level', true);
        if ('' === $escalationlevel) {
          $escalationlevel = "Low";
        }

        echo "<div class='resolution'><span class='escalationlevel'>Escalation level: $escalationlevel</span><h3 class='heading-medium'>"; 
        the_title();
        echo '</h3><div style="clear:both"></div>';
        the_content();
        edit_post_link();
        echo '</div>';
      }
      ?>
  </div><!-- .content-area -->

  <div class="column-one-third">
  <?php 
    $query = new WP_Query(array(
      'post_parent' => get_page_by_title('business disputes')->ID,
      'post_status' => 'publish',
      'post_type' => 'page',
      'order' => 'ASC'
      ));

    if ($query->have_posts()){
      echo '<h3 class="heading-medium">Advice based on these answers</h3>';
    }

    while($query->have_posts()) {
      $query->the_post();


      $dom = new DOMDocument();
      $dom->loadHtml(get_the_content());
      $xpath = new DOMXpath($dom);

      $id = get_the_title();
      if (isset($_GET[$id])) {
        $val=$_GET[$id];
        $elements = $xpath->query("//*/label/input[@name='$id'][@value='$val']");
        if(!is_null($elements)) {
          $question = $xpath->query("//*[@id='question']")->item(0)->textContent;
          $answer = $elements->item(0)->parentNode->textContent;
          $changelink = get_permalink() . '?' . $_SERVER['QUERY_STRING'];
          echo "<dl class='summary'><dt>$question</dt><dd>$answer <a href='$changelink'>Change</a></dd></dl>";
        }        
      }
    }
  ?>
  </div>
</div>
<?php get_footer(); ?>