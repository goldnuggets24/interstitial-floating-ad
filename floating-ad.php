<!---CUSTOM FLOATING AD CODE START -->
<?php if (get_option("activate_ad") == "1") { ?>
<?php 
    $startdate=strtotime(get_option('startdate-interstitial'));
    $enddate=strtotime(get_option('enddate-interstitial'));
    if($startdate <= time() && $enddate >= time())
        { ?>

<?php if (!isset($_COOKIE["floating"]) || !$_COOKIE["floating"]) { ?>
    <?php if (function_exists('floating_ad_views')) { ?>
             <!-- frame position -->
             <div class="floatingAdContainer">
                 <!-- change height and width unique and default values to change the size of the frame  -->
                 <div id="floatingad"
                      style="background: url(https://sonicscoop.com/wp-content/uploads/2017/08/HelixNative_900x500_Animated_SonicScoop_August15_v1a.gif);background-size: 900px;width:<?php echo get_option('interstitial-width'); ?>px;border: 10px ghostwhite solid !important; height:<?php echo get_option('interstitial-height'); ?>px;position:fixed;left:10%;top: 85px;">
                     <img alt="x" id="x" class="floating-ad-x" onClick="this.parentNode.style.display = 'none';jQuery('.floatBack').hide(); jQuery('.floatingAdContainer').remove(); jQuery('.floatBack').remove();" src="https://sonicscoop.com/images/x.png" width="48px;" height="55px;">
                     <span>
             <!-- floating ad link -->
             <a target="_Blank" href="http://line6.com/helix/helixnative.html?utm_source=SonicScoop&utm_medium=banner&utm_campaign=Helix-Native&utm_content=hf">
                <!-- floating ad image -->
                <!-- /3464054/Interstitial900x500 -->
<div id='div-gpt-ad-<?php echo get_option('interstitial-dfp-code'); ?>-0' style='height:500px; width:900px;'>
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
             <?php setcookie("floating", "floating-ad", (time() + get_option('daily') == 1 ? 86400 : 172800));

             $_COOKIE["floating"] = "floating-ad";
     }
} else { ?>
 <style>.floatBack {display: none !important;}</style> 
 <?php }}} ?>

<!---CUSTOM FLOATING AD CODE END -->