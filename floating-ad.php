<!---CUSTOM FLOATING AD CODE START -->
<script async='async' src='https://www.googletagservices.com/tag/js/gpt.js'></script>
<script>
  var googletag = googletag || {};
  googletag.cmd = googletag.cmd || [];
</script>

<script>
  googletag.cmd.push(function() {
    googletag.defineSlot('/3464054/Interstitial<?php echo get_option('interstitial-width'); ?>x<?php echo get_option('interstitial-height'); ?>', [<?php echo get_option('interstitial-width'); ?>, <?php echo get_option('interstitial-height'); ?>], 'div-gpt-ad-<?php echo get_option('interstitial-dfp-code'); ?>-0').addService(googletag.pubads());
    googletag.pubads().enableSingleRequest();
    googletag.enableServices();
  });
</script>

<?php if (get_option("activate_ad") == "1" && !wp_is_mobile()) { ?>

<?php
	$currenttime = time()-18000; // switches to EST
    $startdate=strtotime(get_option('startdate-interstitial'));
    $enddate=strtotime(get_option('enddate-interstitial'));
    if($startdate <= $currenttime && $enddate >= $currenttime)
        { ?>

<?php if (!isset($_COOKIE["interstitial"]) || !$_COOKIE["interstitial"]) { ?>
    <?php if (function_exists('floating_ad_views')) { ?>
             <!-- frame position -->
             <style>.floatBack {display: block !important;}#floatingad {width:920px;height:520px;}</style> 
             <div class="floatingAdContainer">
                 <!-- change height and width unique and default values to change the size of the frame  -->
                 <div id="floatingad"
                      style="background: url(<?php echo wp_get_attachment_url( get_option( 'media_selector_attachment_id' ) ); ?>);background-size: 900px;border: 10px ghostwhite solid !important; position:fixed;left:10%;top: 85px;">
                     <img alt="x" id="x" class="floating-ad-x" onClick="this.parentNode.style.display = 'none';jQuery('.floatBack').hide(); jQuery('.floatingAdContainer').remove(); jQuery('.floatBack').remove();" src="https://sonicscoop.com/images/x.png" width="48px;" height="55px;">
                     <span>
             <!-- floating ad link -->
             <a target="_Blank" href="#">
                <!-- floating ad image -->
                <!-- /3464054/Interstitial900x500 -->
<div id='div-gpt-ad-<?php echo get_option('interstitial-dfp-code'); ?>-0' style='height:520px; width:920px;'>
<script>
googletag.cmd.push(function() { googletag.display('div-gpt-ad-<?php echo get_option('interstitial-dfp-code'); ?>-0'); });
</script>
</div>
             </a>
          </span>
                 </div>
             </div>
             <script>
                 $('body, #sumome-smartbar-popup').on('click', function () {
                     jQuery('#floatingad, .floatBack').hide();
                     jQuery('.floatingAdContainer').remove();
                     jQuery('.floatBack').remove();
                 });
             </script>
             <!-- set cookie -->

<?php
$time = 172800;
$time = round(86400 / get_option('daily'));
 setcookie("interstitial", "interstitial",time()+$time);
     }
} else { ?>
 <style>.floatBack {display: none !important;}</style> 
 <?php }}} ?>

<!---CUSTOM FLOATING AD CODE END -->