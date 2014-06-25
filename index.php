<?php
  // Build out URI to reload from form dropdown
  // Need full url for this to work in Opera Mini
  $pageURL = (@$_SERVER["HTTPS"] == "on") ? "https://" : "http://";

  if (isset($_POST['sg_uri']) && isset($_POST['sg_section_switcher'])) {
     $pageURL .= $_POST[sg_uri].$_POST[sg_section_switcher];
     $pageURL = htmlspecialchars( filter_var( $pageURL, FILTER_SANITIZE_URL ) );
     header("Location: $pageURL");
  }

  // Display title of each markup samples as a select option
  function listMarkupAsOptions ($type) {
    $files = array();
    $handle=opendir('markup/'.$type);
    while (false !== ($file = readdir($handle))):
        if(stristr($file,'.html')):
            $files[] = $file;
        endif;
    endwhile;

    sort($files);
    foreach ($files as $file):
        $filename = preg_replace("/\.html$/i", "", $file);
        $title = preg_replace("/\-/i", " ", $filename);
        $title = ucwords($title);
        echo '<option value="#sg-'.$filename.'">'.$title.'</option>';
    endforeach;
  }

  // Display markup view & source
  function showMarkup($type) {
    $files = array();
    $handle=opendir('markup/'.$type);
    while (false !== ($file = readdir($handle))):
        if(stristr($file,'.html')):
            $files[] = $file;
        endif;
    endwhile;

    sort($files);
    foreach ($files as $file):
        $filename = preg_replace("/\.html$/i", "", $file);
        $title = preg_replace("/\-/i", " ", $filename);
        $documentation = 'doc/'.$type.'/'.$file;
        echo '<div class="sg-markup sg-section">';
        echo '<div class="sg-display">';
        echo '<h2 class="sg-h2"><a id="sg-'.$filename.'" class="sg-anchor">'.$title.'</a></h2>';
        if (file_exists($documentation)) {
          echo '<div class="sg-doc">';
          echo '<h3 class="sg-h3">Usage</h3>';
          include($documentation);
          echo '</div>';
        }
        echo '<h3 class="sg-h3">Example</h3>';
        include('markup/'.$type.'/'.$file);
        echo '</div>';
        echo '<div class="sg-markup-controls"><a class="sg-btn sg-btn--source" href="#">View Source</a> <a class="sg-btn--top" href="#top">Back to Top</a> </div>';
        echo '<div class="sg-source sg-animated">';
        echo '<a class="sg-btn sg-btn--select" href="#">Copy Source</a>';
        echo '<pre class="prettyprint linenums"><code>';
        echo htmlspecialchars(file_get_contents('markup/'.$type.'/'.$file));
        echo '</code></pre>';
        echo '</div>';
        echo '</div>';
    endforeach;
  }
?>
<!DOCTYPE html>
<head>
<meta charset="utf-8">
  <title>BlueLabs Style Guide</title>
  <meta name="viewport" content="width=device-width">
  <!-- Style Guide Boilerplate Styles -->
  <link rel="stylesheet" href="css/sg-style.css">

  <!-- Replace below stylesheet with your own stylesheet -->
  <link rel="stylesheet" href="css/style.css">
</head>
<body style="max-width: 1200px; margin: 0 auto;">

<div id="top" class="sg-header sg-container">
  <h1 class="sg-logo">BlueLabs <span>StyleGuide</span></h1>
  <form id="js-sg-nav" action=""  method="post" class="sg-nav">
    <select id="js-sg-section-switcher" class="sg-section-switcher" name="sg_section_switcher">
        <option value="">Jump To Section:</option>
        <optgroup label="Intro">
          <option value="#sg-about">About</option>
          <option value="#sg-colors">Colors</option>
          <option value="#sg-fontStacks">Font-Stacks</option>
          <option value="#sg-logos">Logo Usage</option>
        </optgroup>
        <optgroup label="Base Styles">
          <?php listMarkupAsOptions('base'); ?>
        </optgroup>
        <optgroup label="Pattern Styles">
          <?php listMarkupAsOptions('patterns'); ?>
        </optgroup>
    </select>
    <input type="hidden" name="sg_uri" value="<?php echo $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"]; ?>">
    <button type="submit" class="sg-submit-btn">Go</button>
  </form><!--/.sg-nav-->
</div><!--/.sg-header-->

<div class="sg-body sg-container" style="width: 90%; margin-left: auto; margin-right: auto;">
  <div class="sg-info">
    <div class="sg-about sg-section">
      <h2 class="sg-h2"><a id="sg-about" class="sg-anchor">About</a></h2>
      <p>Comments and documentation about your style guide. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus nobis enim labore facilis consequuntur! Veritatis neque est suscipit tenetur temporibus enim consequatur deserunt perferendis. Neque nemo iusto minima deserunt amet.</p>
    </div><!--/.sg-about-->

    <div class="sg-colors sg-section">
      <h2 class="sg-h2"><a id="sg-colors" class="sg-anchor">Colors</a></h2>
        <div class="sg-color sg-color--a"><span class="sg-color-swatch"><span class="sg-animated">#236995 (35,105,149)</span></span></div>
        <div class="sg-color sg-color--b"><span class="sg-color-swatch"><span class="sg-animated">#2875A1 (40,117,161)</span></span></div>
        <div class="sg-color sg-color--c"><span class="sg-color-swatch"><span class="sg-animated">#2E82AE (46,130,174)</span></span></div>
        <div class="sg-color sg-color--d"><span class="sg-color-swatch"><span class="sg-animated">#3DA6D2 (61,166,210)</span></span></div>
        <div class="sg-color sg-color--e"><span class="sg-color-swatch"><span class="sg-animated">#42b3df (66,179,223)</span></span></div>
        <div class="sg-color sg-color--f"><span class="sg-color-swatch"><span class="sg-animated">#48bfeb (72,191,235)</span></span></div>
        <div class="sg-color sg-color--g"><span class="sg-color-swatch"><span class="sg-animated">#feffff (254,255,255)</span></span></div>
        <div class="sg-markup-controls"><a class="sg-btn--top" href="#top">Back to Top</a></div>
    </div><!--/.sg-colors-->

    <div class="sg-font-stacks sg-section">
      <h2 class="sg-h2"><a id="sg-fontStacks" class="sg-anchor">Font Stacks</a></h2>
      <p class="sg-font sg-font-primary"><a target="_blank" href="http://www.typography.com/fonts/knockout/webfonts/knockout-28/">"Knockout 28 A", "Knockout 28 B", "Arial", sans-serif;</a></p>
      <p class="sg-font sg-font-secondary"><a target="_blank" href="https://stripe.com/">"Whitney SSm A", "Whitney SSm B", "Arial", sans-serif;</a></p>
      <div class="sg-markup-controls"><a class="sg-btn--top" href="#top">Back to Top</a></div>
    </div><!--/.sg-font-stacks-->
  </div><!--/.sg-info-->

  <div class="sg-logos sg-section">
    <h2 class="sg-h2"><a id="sg-logos" class="sg-anchor">Logos</a></h2>
    <p>Add your personalized documentation here.</p>
    <figure class="flt-left">
      <img src="images/logos/bluelabs-logo-large-blue.png" alt="Image Alt Text">
      <figcaption>bluelabs-logo-large-blue.png</figcaption>
    </figure>
    <figure>
      <img class="sg-logo-bg-dark" src="images/logos/bluelabs-logo-large-white.png" alt="Image Alt Text">
      <figcaption>bluelabs-logo-large-white.png</figcaption>
    </figure>
<!--       <figure class="clear">
      <img src="images/logos/bluelabs-logo-small-blue.png" alt="Image Alt Text">
      <figcaption>bluelabs-logo-small-blue.png</figcaption>
    </figure> -->
<!--       <figure class="clear">
      <img class="sg-logo-bg-dark" src="images/logos/bluelabs-logo-starburst-white-1500px.png" alt="Image Alt Text">
      <figcaption>bluelabs-logo-starburst-white-1500px.png</figcaption>
    </figure> -->
    <figure class="clear flt-left">
      <img src="images/logos/bluelabs-text-only-large-blue.png" alt="Image Alt Text">
      <figcaption>bluelabs-text-only-large-blue.png</figcaption>
    </figure>
    <figure class="flt-left">
      <img class="sg-logo-bg-dark" src="images/logos/bluelabs-text-only-large-white.png" alt="Image Alt Text">
      <figcaption>bluelabs-text-only-large-white.png</figcaption>
    </figure>
    <figure class="flt-left clear">
      <img src="images/logos/starburst-blue.png" alt="Image Alt Text" style="height:194px;">
      <figcaption>starburst-blue.png</figcaption>
    </figure>
    <figure class="flt-left">
      <img class="sg-logo-bg-dark" src="images/logos/starburst-white.png" alt="Image Alt Text">
      <figcaption>starburst-white.png</figcaption>
    </figure>
    <div class="sg-markup-controls clear"><a class="sg-btn--top" href="#top">Back to Top</a></div>
  </div><!--/.sg-font-stacks-->

  <div class="sg-dos-donts sg-section">
    <h2 class="sg-h2"><a id="sg-fontStacks" class="sg-anchor">Style Guide Don'ts</a></h2>
    <figure>
      <h4>BlueLabs</h4>
      <h4>blue.labs</h4>
      <h4>Blue.Labs</h4>
    </figure>
    <figure>
      <img src="images/dont/bluelabs-no-under-text.png" style="width: 200px;" alt="Image Alt Text">
      <figcaption>The logo above that has not text under it should never be used outside of the website.</figcaption>
    </figure>
    <figure>
      <img src="images/dont/bluelabs-logomarque-black_1200.png" style="width: 200px;" alt="Image Alt Text">
      <figcaption>No BlueLabs logo should ever have periods separating the logo. Also periods should never be used. The only spacer that should be used in the logo is a bullet.</figcaption>
    </figure>
    <div class="sg-markup-controls"><a class="sg-btn--top" href="#top">Back to Top</a></div>
  </div><!--/.sg-info-->

  <div class="sg-pictures sg-section">
    <h2 class="sg-h2"><a id="sg-pictures" class="sg-anchor">Email Signature</a></h2>
    <p>The email signature below should be used on all staff person's emails sent from a bluelabs.com email address.</p>
    <div class="sg-markup-controls"><a class="sg-btn--top" href="#top">Back to Top</a></div>
  </div><!--/.sg-info-->

  <div class="sg-pictures sg-section">
    <h2 class="sg-h2"><a id="sg-pictures" class="sg-anchor">Pictures</a></h2>
    <p>The pictures we use are expressive, show real emotions and are cropped for maximum effect.</p>
    <div class="sg-markup-controls"><a class="sg-btn--top" href="#top">Back to Top</a></div>
  </div><!--/.sg-info-->

  <div class="sg-pictures sg-section">
    <h2 class="sg-h2"><a id="sg-pictures" class="sg-anchor">Tone</a></h2>
    <p>The pictures we use are expressive, show real emotions and are cropped for maximum effect.</p>
    <div class="sg-markup-controls"><a class="sg-btn--top" href="#top">Back to Top</a></div>
  </div><!--/.sg-info-->

  <!-- <div class="sg-base-styles">
    <h1 class="sg-h1">Base Styles</h1>
    <?php //showMarkup('base'); ?>
  </div> --><!--/.sg-base-styles-->

  <!-- <div class="sg-pattern-styles">
    <h1 class="sg-h1">Pattern Styles<small> - Design and mark-up patterns unique to your site.</small></h1>
    <?php //showMarkup('patterns'); ?>
    </div> --><!--/.sg-pattern-styles-->
  </div><!--/.sg-body-->

  <script src="js/sg-plugins.js"></script>
  <script src="js/sg-scripts.js"></script>
</body>
</html>
