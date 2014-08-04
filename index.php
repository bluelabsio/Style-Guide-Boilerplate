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
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/style.css">
</head>
<body style="max-width: 1400px; margin: 0 auto;">

<div id="top" class="sg-header sg-container">
  <h1 class="sg-logo">BlueLabs <span>StyleGuide</span></h1>
  <form id="js-sg-nav" action=""  method="post" class="sg-nav">
    <select id="js-sg-section-switcher" class="sg-section-switcher" name="sg_section_switcher">
        <option value="">Jump To Section:</option>
        <optgroup label="Intro">
          <option value="#sg-about">About</option>
          <option value="#sg-colors">Colors</option>
          <option value="#sg-fontStacks">Typography</option>
          <option value="#sg-logos">Logo Usage</option>
          <option value="#sg-dos-donts">BlueLabs Style Don'ts</option>
<!--           <option value="#sg-email">Email Signature</option>
 -->          <option value="#sg-templates">Templates</option>
        </optgroup>
    </select>
    <input type="hidden" name="sg_uri" value="<?php echo $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"]; ?>">
    <button type="submit" class="sg-submit-btn">Go</button>
  </form><!--/.sg-nav-->
</div><!--/.sg-header-->

<div class="sg-body sg-container" style="width: 90%; margin-left: auto; margin-right: auto;">
  <div class="sg-info">
    <div class="sg-about sg-section">
      <h2 class="sg-h2"><a id="sg-about" class="sg-anchor">Why is a style guide important?</a></h2>
      <br>
      <p>In a nutshell, a style guide helps to ensure a continuous brand experience. It means that no matter how, when or where a customer experiences a brand, they are experiencing the same underlying traits. It’s this consistency across every touch-point that helps build a brand and brand loyalty. And with 2.4 billion Internet users around the world (and growing), it’s really more critical than ever for businesses to establish a comprehensive style guide.</p>
    </div><!--/.sg-about-->

    <div class="sg-colors sg-section">
      <h2 class="sg-h2"><a id="sg-colors" class="sg-anchor">Colors</a></h2>
        <div class="sg-color sg-color--a"><span class="sg-color-swatch"><span class="sg-animated">#236995 (35,105,149)</span></span></div>
        <div class="sg-color sg-color--b"><span class="sg-color-swatch"><span class="sg-animated">#2875A1 (40,117,161)</span></span></div>
        <div class="sg-color sg-color--c"><span class="sg-color-swatch"><span class="sg-animated">#2E82AE (46,130,174)</span></span></div>
        <div class="sg-color sg-color--d"><span class="sg-color-swatch"><span class="sg-animated">#3DA6D2 (61,166,210)</span></span></div>
        <div class="sg-color sg-color--e"><span class="sg-color-swatch"><span class="sg-animated">#42b3df (66,179,223)</span></span></div>
        <div class="sg-color sg-color--f"><span class="sg-color-swatch"><span class="sg-animated">#48bfeb (72,191,235)</span></span></div>
        <div class="sg-color sg-color--h"><span class="sg-color-swatch"><span class="sg-animated">#b2b2b2 (178,178,178)</span></span></div>
        <div class="sg-color sg-color--g"><span class="sg-color-swatch"><span class="sg-animated">#feffff (254,255,255)</span></span></div>
        <div class="sg-markup-controls"><a class="sg-btn--top" href="#top">Back to Top</a></div>
    </div><!--/.sg-colors-->

    <div class="sg-font-stacks sg-section">
      <h2 class="sg-h2"><a id="sg-fontStacks" class="sg-anchor">Typography</a></h2>
      <table class="table table-bordered">
      <tr>
        <th>Font Family</th>
        <th>Example Text</th>
        <th>Use Case</th>
      </tr>
      <tr>
        <td style="min-width:125px;"><a target="_blank" href="http://www.typography.com/fonts/knockout/webfonts/knockout-28/">Knockout 28 A</a></td>
        <td>
          <img src="images/text/knockout.png" style="max-width:800px;">
        </td>
        <td>Website Headers</td>
      </tr>
      <td><a target="_blank" href="http://www.typography.com/fonts/whitney/webfonts/whitneyssm-book/">Whitney SSm A</a></td>
        <td>
          <img src="images/text/whitney.png" style="max-width:800px;">
        </td>
        <td>Website Body Copy</td>
      </tr>
      </table>
      <div class="sg-markup-controls"><a class="sg-btn--top" href="#top">Back to Top</a></div>
    </div><!--/.sg-font-stacks-->
  </div><!--/.sg-info-->

  <div class="sg-logos sg-section">
    <h2 class="sg-h2"><a id="sg-logos" class="sg-anchor">Logos</a></h2>
    <br>
    <p>Our logo is the touchstone of our brand and one of our most valualble assets. We must ensure proper use. The following logos are the only BlueLabs Logos that have been approved for use. <strong>Before using any of these logos please get in touch with Kat to make sure that you are using the proper logo.</strong></p>
    <br>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Logo</th>
          <th>Download Link</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><img src="images/logos/bluelabs-logo-large-blue.png" alt="Image Alt Text" style="max-width:350px;"></td>
          <td><a download href="images/logos/bluelabs-logo-large-blue.png">Download</a></td>
        </tr>
        <tr>
          <td><img src="images/logos/bluelabs-logo-large-white.png" alt="Image Alt Text" style="max-width:350px; background:#236995;"></td>
          <td><a download href="images/logos/bluelabs-logo-large-white.png">Download</a></td>
        </tr>
        <tr>
          <td><img src="images/logos/bluelabs-text-only-large-blue.png" alt="Image Alt Text" style="max-width:350px;"></td>
          <td><a download href="images/logos/bluelabs-text-only-large-blue.png">Download</a></td>
        </tr>
        <tr>
          <td><img src="images/logos/bluelabs-text-only-large-white.png" alt="Image Alt Text" style="max-width:350px; background:#236995;"></td>
          <td><a download href="images/logos/bluelabs-text-only-large-white.png">Download</a></td>
        </tr>
        <tr>
          <td><img src="images/logos/starburst-blue.png" alt="Image Alt Text" style="max-width:350px;"></td>
          <td><a download href="images/logos/starburst-blue.png">Download</a></td>
        </tr>
        <tr>
          <td><img src="images/logos/starburst-white.png" alt="Image Alt Text" style="max-width:350px; background:#236995;"></td>
          <td><a download href="images/logos/starburst-white.png">Download</a></td>
        </tr>
      </tbody>
    </table>
    <div class="sg-markup-controls clear"><a class="sg-btn--top" href="#top">Back to Top</a></div>
  </div><!--/.sg-font-stacks-->

  <div class="sg-dos-donts sg-section">
    <h2 class="sg-h2"><a id="sg-dos-donts" class="sg-anchor">Style Guide Don'ts</a></h2>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Case</th>
          <th>Why its wrong</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><h4>Blue Labs</h4></td>
          <td>The company name "BlueLabs", when typed out, is always one word.</td>
        </tr>
        <tr>
          <td><h4>blue.labs</h4></td>
          <td>When typing the company name in print, BlueLabs, the "B" and "L" in BlueLabs should always be capitalized. Also, there should never be any punctuation in the middle of the word as it is one word and not two.</td>
        </tr>
        <tr>
          <td><h4>Blue.Labs</h4></td>
          <td>There should never be any punctuation in the middle of the word as it is one word and not two.</td>
        </tr>
        <tr>
          <td><img src="images/dont/bluelabs-no-under-text.png" style="width: 200px;" alt="Image Alt Text"></td>
          <td>The logo above that has not text under it should never be used outside of the website.</td>
        </tr>
        <tr>
          <td><img src="images/dont/bluelabs-logomarque-black_1200.png" style="width: 200px;" alt="Image Alt Text"></td>
          <td>No BlueLabs logo should ever have periods separating the logo. Also periods should never be used. The only spacer that should be used in the logo is a bullet.</td>
        </tr>
      </tbody>
    </table>
    <div class="sg-markup-controls"><a class="sg-btn--top" href="#top">Back to Top</a></div>
  </div><!--/.sg-info-->

  <!-- <div class="sg-pictures sg-section">
    <h2 class="sg-h2"><a id="sg-email" class="sg-anchor">Email Signature</a></h2>
    <br>
    <p>The email signature below should be used on all staff person's emails sent from a bluelabs.com email address.</p>
    <br>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Structure</th>
          <th>Example</th>
          <th>Instructions</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>
            <p>
              <span style="font-size: 1.2em;"><strong style="color: #2E82AE;">[FULL NAME],</strong> [JOB TITLE]</span> </br>
              T: [PHONE NUMBER]  |  bluelabs.com  |  twitter.com/blue_labs
            </p>
          </td>
          <td>
            <p>
              <span style="font-size: 1.2em;"><strong style="color: #2E82AE;">Courtney Eimerman-Wallace,</strong> Software Engineer</span> </br>
              T: 312 505 1093  |  bluelabs.com  |  twitter.com/blue_labs
            </p>
          </td>
          <td style="width: 250px;"><p>You can find instructions for creating your signature <a download href="docs/signature_instructions.pdf">HERE</a>.</p></td>
        </tr>
      </tbody>
    </table>
    <br>
    <div class="sg-markup-controls"><a class="sg-btn--top" href="#top">Back to Top</a></div>
  </div> --><!--/.sg-info-->

   <div class="sg-pictures sg-section">
    <h2 class="sg-h2"><a id="sg-templates" class="sg-anchor">Templates</a></h2>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Template</th>
          <th>Use Case</th>
          <th>Download Link</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><img src="images/templates/presentation.png" style="width: 200px;" alt="Image Alt Text"></td>
          <td>
            <p>This template should be used for:</p>
            <ul>
              <li>More formal speaking events</li>
              <li>Presentations that have a lot of information.</li>
            </ul>
            <p><em>Example: Sales pitch meeting.</em></p>
          </td>
          <td><p>Presentation Template (<a download href="docs/bl_at_a_glance.key">Keynote</a> | <a href="docs/bl_at_a_glance.pptx" download>Powerpoint</a>)</p></td>
        </tr>
        <tr>
          <td><img src="images/templates/alternate_pres.png" style="width: 200px;" alt="Image Alt Text"></td>
          <td>
            <p>This template should be used for:</p>
            <ul>
              <li>Casual speaking events</li>
              <li>Presentations that have 20 slide or fewer.</li>
            </ul>
            <p><em>Example: Predictive Analytics webinar.</em></p>
          </td>
          <td><p>Alternate Presentation Template (<a download href="docs/bluelabs_basic_sample.key">Keynote</a> | <a href="docs/bluelabs_basic_sample.pptx" download>Powerpoint</a>)</p></td>
        </tr>
        <tr>
          <td><img src="images/templates/proposal.png" style="width: 200px;" alt="Image Alt Text"></td>
          <td>
            <p>This template should be used for:</p>
            <ul>
              <li>Proposals only</li>
            </ul>
          </td>
          <td><p>Proposal Template (<a href="docs/sample_proposal.key" download>Keynote</a> | <a href="docs/sample_proposal.pptx" download>Powerpoint</a>)</p></td>
        </tr>
      </tbody>
    </table>
    <div class="sg-markup-controls"><a class="sg-btn--top" href="#top">Back to Top</a></div>
   </div><!--/.sg-info

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
