<?php /* Template Name: Triage page */ 

get_header();?>

<div class="grid-row">
  <div id="primary" class="content-area column-two-thirds">
      <?php
      // Start the loop.
      while ( have_posts() ) : the_post();
      
      // Include the page content template.
      if ('' === get_post_meta(get_the_ID(), 'next', true)) {
        the_content();
        edit_post_link();
      } else {
        echo '<header class="entry-header"><h1 class="heading-xlarge entry-title">Get help with your business dispute</h1></header>';

        $nextUri = get_post_meta(get_the_ID(), 'next', true);

        echo "<form method=\"GET\" action=\"/business-disputes/$nextUri\">";
        sbctheme_queryashiddeninputs(); 
        the_content( );
        echo '<input type="submit" class="button" value="Continue"></form>';
        edit_post_link();
        
      }

      // End of the loop.
      endwhile;
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

    if (!empty($_GET)){
      echo '<h3 class="heading-medium">Your answers so far</h3>';
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