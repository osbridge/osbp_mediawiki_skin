<?php
/**
 * OSBrdige
 *
 * Translated from gwicke's previous TAL template version to remove
 * dependency on PHPTAL.
 *
 * @todo document
 * @file
 * @ingroup Skins
 */
global $admin_sidebar_actions;
$admin_sidebar_actions = array('delete', 'move', 'protect');

if( !defined( 'MEDIAWIKI' ) )
   die( -1 );

/**
 * Inherit main code from SkinTemplate, set the CSS and template filter.
 * @todo document
 * @ingroup Skins
 */
class SkinOSBridge extends SkinTemplate {
   /** Using osbridge. */
   function initPage( OutputPage $out ) {
      parent::initPage( $out );
      $this->skinname  = 'osbridge';
      $this->stylename = 'osbridge';
      $this->template  = 'OSBridgeTemplate';

   }

   function setupSkinUserCss( OutputPage $out ) {
      global $wgHandheldStyle;

      parent::setupSkinUserCss( $out );

      $out->addStyle( 'http://opensourcebridge.org/common/osbp_common_v3.css', 'screen', '', '');

      // Append to the default screen common & print styles...
      $out->addStyle( 'osbridge/main.css', 'screen' );
      if( $wgHandheldStyle ) {
         // Currently in testing... try 'chick/main.css'
         $out->addStyle( $wgHandheldStyle, 'handheld' );
      }

      // $out->addStyle( 'osbridge/IE50Fixes.css', 'screen', 'lt IE 5.5000' );
      //     $out->addStyle( 'osbridge/IE55Fixes.css', 'screen', 'IE 5.5000' );
      //     $out->addStyle( 'osbridge/IE60Fixes.css', 'screen', 'IE 6' );
      //     $out->addStyle( 'osbridge/IE70Fixes.css', 'screen', 'IE 7' );
      //
      //     $out->addStyle( 'osbridge/rtl.css', 'screen', '', 'rtl' );
   }
}

/**
 * @todo document
 * @ingroup Skins
 */
class OSBridgeTemplate extends QuickTemplate {
   var $skin;
   /**
    * Template filter callback for OSBridge skin.
    * Takes an associative array of data set from a SkinTemplate-based
    * class, and a wrapper for MediaWiki's localization database, and
    * outputs a formatted page.
    *
    * @access private
    */
   function execute() {
      global $wgRequest;
      $this->skin = $skin = $this->data['skin'];
      $action = $wgRequest->getText( 'action' );

      // Suppress warnings to prevent notices about missing indexes in $this->data
      wfSuppressWarnings();

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="<?php $this->text('xhtmldefaultnamespace') ?>" <?php
   foreach($this->data['xhtmlnamespaces'] as $tag => $ns) {
      ?>xmlns:<?php echo "{$tag}=\"{$ns}\" ";
   } ?>xml:lang="<?php $this->text('lang') ?>" lang="<?php $this->text('lang') ?>" dir="<?php $this->text('dir') ?>">
   <head>
      <meta http-equiv="Content-Type" content="<?php $this->text('mimetype') ?>; charset=<?php $this->text('charset') ?>" />
      <?php $this->html('headlinks') ?>
      <title><?php $this->text('pagetitle') ?></title>
      <?php $this->html('csslinks') ?>

      <!--[if lt IE 7]><script type="<?php $this->text('jsmimetype') ?>" src="<?php $this->text('stylepath') ?>/common/IEFixes.js?<?php echo $GLOBALS['wgStyleVersion'] ?>"></script>
      <meta http-equiv="imagetoolbar" content="no" /><![endif]-->

      <?php print Skin::makeGlobalVariablesScript( $this->data ); ?>

      <script type="<?php $this->text('jsmimetype') ?>" src="<?php $this->text('stylepath' ) ?>/common/wikibits.js?<?php echo $GLOBALS['wgStyleVersion'] ?>"><!-- wikibits js --></script>
      <!-- Head Scripts -->
<?php $this->html('headscripts') ?>
<?php if($this->data['jsvarurl']) { ?>
      <script type="<?php $this->text('jsmimetype') ?>" src="<?php $this->text('jsvarurl') ?>"><!-- site js --></script>
<?php } ?>
<?php if($this->data['pagecss']) { ?>
      <style type="text/css"><?php $this->html('pagecss') ?></style>
<?php }
      if($this->data['usercss']) { ?>
      <style type="text/css"><?php $this->html('usercss') ?></style>
<?php }
      if($this->data['userjs']) { ?>
      <script type="<?php $this->text('jsmimetype') ?>" src="<?php $this->text('userjs' ) ?>"></script>
<?php }
      if($this->data['userjsprev']) { ?>
      <script type="<?php $this->text('jsmimetype') ?>"><?php $this->html('userjsprev') ?></script>
<?php }
      if($this->data['trackbackhtml']) print $this->data['trackbackhtml']; ?>
   </head>
<body<?php if($this->data['body_ondblclick']) { ?> ondblclick="<?php $this->text('body_ondblclick') ?>"<?php } ?>
<?php if($this->data['body_onload']) { ?> onload="<?php $this->text('body_onload') ?>"<?php } ?>
 class="mediawiki <?php $this->text('dir') ?> <?php $this->text('pageclass') ?> <?php $this->text('skinnameclass') ?>">
   <div id="wrapper">
      <div id="header">
         <div class='inner_container'>
            <h1 id="site-title"><span><a href='/'>Open Source Bridge</a></span></h1>
            <div id="site-description">
               <h2>The conference for open source citizens</h2>
               <p id='conference-date-location'>June 1&ndash;4, 2010 <span class='separator'>|</span> Portland, Oregon</p>
            </div>
         </div>
       </div>

       <div id="access">
        <div class="skip-link">
          <a href="#content" title="Skip to content">Skip to content</a>
        </div>

        <div id="menu">
             <ul>
                <li id="menu_first_item"><a href='/about/' title='About' class=''>About</a></li>
                <li><a href='/attend/' title='Attend' class=''>Attend</a></li>
                <li><a href='/sessions/' title='Sessions' class=''>Sessions</a></li>
                <li><a href="/volunteer/" title="Volunteer">Get Involved</a></li>
                <li><a href="/sponsors/" title="Sponsors">Sponsors</a></li>
                <li><a href="/blog/">Blog</a></li>
                <li class="current_page_item"><a href="/wiki/">Wiki</a></li>
             </ul>
          </div>

          <div id="subnav" class='navbar'>
             <div class='inner_container'>
                <h2>Attendee Wiki</h2>
                <?php global $admin_sidebar_actions; ?>
                <ul>
                   <?php      
                   foreach(array_diff_key($this->data['content_actions'], array_flip( $admin_sidebar_actions )) as $key => $tab) {
                      echo '
                      <li id="' . Sanitizer::escapeId( "ca-$key" ) . '"';
                   if( $tab['class'] ) {
                      echo ' class="'.htmlspecialchars($tab['class']).'"';
                   }
                   echo'><a href="'.htmlspecialchars($tab['href']).'"';
                   # We don't want to give the watch tab an accesskey if the
                   # page is being edited, because that conflicts with the
                   # accesskey on the watch checkbox.  We also don't want to
                   # give the edit tab an accesskey, because that's fairly su-
                   # perfluous and conflicts with an accesskey (Ctrl-E) often
                   # used for editing in Safari.
                   if( in_array( $action, array( 'edit', 'submit' ) )
                   && in_array( $key, array( 'edit', 'watch', 'unwatch' ))) {
                      echo $skin->tooltip( "ca-$key" );
                   } else {
                      echo $skin->tooltipAndAccesskey( "ca-$key" );
                   }
                   echo '>'.htmlspecialchars($tab['text']).'</a></li>';
                   } ?>
                </ul>
             </div>
          </div>
       </div>
      <div id="container">
         <div id="content">
            <a name="top" id="top"></a>
            <?php if($this->data['sitenotice']) { ?><div id="siteNotice"><?php $this->html('sitenotice') ?></div><?php } ?>
            <h1 id="firstHeading" class="firstHeading"><?php $this->data['displaytitle']!=""?$this->html('title'):$this->text('title') ?></h1>
            <div id="bodyContent">
               <h3 id="siteSub"><?php $this->msg('tagline') ?></h3>
               <div id="contentSub"><?php $this->html('subtitle') ?></div>
               <?php if($this->data['undelete']) { ?><div id="contentSub2"><?php     $this->html('undelete') ?></div><?php } ?>
               <?php if($this->data['newtalk'] ) { ?><div class="usermessage"><?php $this->html('newtalk')  ?></div><?php } ?>
               <?php if($this->data['showjumplinks']) { ?><div id="jump-to-nav"><?php $this->msg('jumpto') ?> <a href="#column-one"><?php $this->msg('jumptonavigation') ?></a>, <a href="#searchInput"><?php $this->msg('jumptosearch') ?></a></div><?php } ?>
               <!-- start content -->
               <?php $this->html('bodytext') ?>
               <?php if($this->data['catlinks']) { $this->html('catlinks'); } ?>
               <!-- end content -->
               <?php if($this->data['dataAfterContent']) { $this->html ('dataAfterContent'); } ?>
               <div class="visualClear"></div>
            </div>
         </div>
         <div class='sidebar'>
            <ul class="xoxo">
               <li class="portlet" id="p-personal">
                  <h3><?php $this->msg('personaltools') ?></h3>
                  <ul>
<?php             foreach($this->data['personal_urls'] as $key => $item) { ?>
                     <li id="<?php echo Sanitizer::escapeId( "pt-$key" ) ?>"<?php
                     if ($item['active']) { ?> class="active"<?php } ?>><a href="<?php
                     echo htmlspecialchars($item['href']) ?>"<?php echo $skin->tooltipAndAccesskey('pt-'.$key) ?><?php
                     if(!empty($item['class'])) { ?> class="<?php
                     echo htmlspecialchars($item['class']) ?>"<?php } ?>><?php
                     echo htmlspecialchars($item['text']) ?></a></li>
<?php             } ?>
                  </ul>
               </li>
               <?php
               $admin_sidebar_menu = array_intersect_key($this->data['content_actions'], array_flip( $admin_sidebar_actions ));

               if(count($admin_sidebar_menu) > 0) {
               ?>
               <li class='portlet'>
                 <h3>Management</h3>
                 <ul>
                    <?php
                    foreach($admin_sidebar_menu as $key => $tab) {
                       echo '
                       <li id="' . Sanitizer::escapeId( "ca-$key" ) . '"';
                    if( $tab['class'] ) {
                       echo ' class="'.htmlspecialchars($tab['class']).'"';
                    }
                    echo'><a href="'.htmlspecialchars($tab['href']).'"';
                    # We don't want to give the watch tab an accesskey if the
                    # page is being edited, because that conflicts with the
                    # accesskey on the watch checkbox.  We also don't want to
                    # give the edit tab an accesskey, because that's fairly su-
                    # perfluous and conflicts with an accesskey (Ctrl-E) often
                    # used for editing in Safari.
                    if( in_array( $action, array( 'edit', 'submit' ) )
                    && in_array( $key, array( 'edit', 'watch', 'unwatch' ))) {
                       echo $skin->tooltip( "ca-$key" );
                    } else {
                       echo $skin->tooltipAndAccesskey( "ca-$key" );
                    }
                    echo '>'.htmlspecialchars($tab['text']).'</a></li>';
                    } ?>
                 </ul>
               </li>
               <?php } ?>

<?php
               $sidebar = $this->data['sidebar'];
               if ( !isset( $sidebar['SEARCH'] ) ) $sidebar['SEARCH'] = true;
               if ( !isset( $sidebar['TOOLBOX'] ) ) $sidebar['TOOLBOX'] = true;
               if ( !isset( $sidebar['LANGUAGES'] ) ) $sidebar['LANGUAGES'] = true;
               foreach ($sidebar as $boxName => $cont) {
                  if ( $boxName == 'SEARCH' ) {
                     $this->searchBox();
                  } elseif ( $boxName == 'TOOLBOX' ) {
                     $this->toolbox();
                  } elseif ( $boxName == 'LANGUAGES' ) {
                     $this->languageBox();
                  } else {
                     $this->customBox( $boxName, $cont );
                  }
               }
?>
               <li>
                  <ul>
                     <?php if($this->data['copyrightico']) { ?>
                     <li><div id="f-copyrightico"><?php $this->html('copyrightico') ?></div></li>
                     <?php } ?>

                     <?php
                     // Generate additional footer links
                     $footerlinks = array(
                        'lastmod', 'viewcount', 'numberofwatchingusers', 'credits', 'copyright',
                        'privacy', 'about', 'disclaimer', 'tagline',
                        );
                     $validFooterLinks = array();
                     foreach( $footerlinks as $aLink ) {
                        if( isset( $this->data[$aLink] ) && $this->data[$aLink] ) {
                           $validFooterLinks[] = $aLink;
                        }
                     }
                     if ( count( $validFooterLinks ) > 0 ) {
                        foreach( $validFooterLinks as $aLink ) {
                           if( isset( $this->data[$aLink] ) && $this->data[$aLink] ) { ?>
                     <li id="<?php echo$aLink?>"><?php $this->html($aLink) ?></li>
                           <?php }
                        }
                     }
                     ?>
                  </ul>
               </li>
            </ul>
         </div>
      </div>

      <div id="footer"></div>
</div>
<?php $this->html('bottomscripts'); /* JS call to runBodyOnloadHook */ ?>
<script type="<?php $this->text('jsmimetype') ?>"> if (window.isMSIE55) fixalpha(); </script>
<?php $this->html('reporttime') ?>
<?php if ( $this->data['debug'] ): ?>
<!-- Debug output:
<?php $this->text( 'debug' ); ?>
-->
<?php endif; ?>

<script type="text/javascript">
  var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
  document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
  var pageTracker = _gat._getTracker("UA-168427-8");
  pageTracker._initData();
  pageTracker._trackPageview();
</script>

<script src="http://static.getclicky.com/79611.js" type="text/javascript"></script>
<noscript><p><img alt="Clicky" width="1" height="1" src="http://static.getclicky.com/79611-db10.gif" /></p></noscript>

</body></html>
<?php
   wfRestoreWarnings();
   } // end of execute() method

   /*************************************************************************************************/
   function searchBox() {
?>
   <li id="p-search" class="portlet">
      <h3><label for="searchInput"><?php $this->msg('search') ?></label></h3>
      <div id="searchBody" class="pBody">
         <form action="<?php $this->text('searchaction') ?>" id="searchform"><div>
            <input id="searchInput" name="search" type="text"<?php echo $this->skin->tooltipAndAccesskey('search');
               if( isset( $this->data['search'] ) ) {
                  ?> value="<?php $this->text('search') ?>"<?php } ?> />
            <input type='submit' name="go" class="searchButton" id="searchGoButton" value="<?php $this->msg('searcharticle') ?>"<?php echo $this->skin->tooltipAndAccesskey( 'search-go' ); ?> />&nbsp;
            <input type='submit' name="fulltext" class="searchButton" id="mw-searchButton" value="<?php $this->msg('searchbutton') ?>"<?php echo $this->skin->tooltipAndAccesskey( 'search-fulltext' ); ?> />
         </div></form>
      </div>
   </li>
<?php
   }

   /*************************************************************************************************/
   function toolbox() {
?>
   <li class="portlet" id="p-tb">
      <h3><?php $this->msg('toolbox') ?></h3>
      <div class="pBody">
         <ul>
<?php
      if($this->data['notspecialpage']) { ?>
            <li id="t-whatlinkshere"><a href="<?php
            echo htmlspecialchars($this->data['nav_urls']['whatlinkshere']['href'])
            ?>"<?php echo $this->skin->tooltipAndAccesskey('t-whatlinkshere') ?>><?php $this->msg('whatlinkshere') ?></a></li>
<?php
         if( $this->data['nav_urls']['recentchangeslinked'] ) { ?>
            <li id="t-recentchangeslinked"><a href="<?php
            echo htmlspecialchars($this->data['nav_urls']['recentchangeslinked']['href'])
            ?>"<?php echo $this->skin->tooltipAndAccesskey('t-recentchangeslinked') ?>><?php $this->msg('recentchangeslinked') ?></a></li>
<?php       }
      }
      if(isset($this->data['nav_urls']['trackbacklink'])) { ?>
         <li id="t-trackbacklink"><a href="<?php
            echo htmlspecialchars($this->data['nav_urls']['trackbacklink']['href'])
            ?>"<?php echo $this->skin->tooltipAndAccesskey('t-trackbacklink') ?>><?php $this->msg('trackbacklink') ?></a></li>
<?php    }
      if($this->data['feeds']) { ?>
         <li id="feedlinks"><?php foreach($this->data['feeds'] as $key => $feed) {
               ?><span id="<?php echo Sanitizer::escapeId( "feed-$key" ) ?>"><a href="<?php
               echo htmlspecialchars($feed['href']) ?>"<?php echo $this->skin->tooltipAndAccesskey('feed-'.$key) ?>><?php echo htmlspecialchars($feed['text'])?></a>&nbsp;</span>
               <?php } ?></li><?php
      }

      foreach( array('contributions', 'log', 'blockip', 'emailuser', 'upload', 'specialpages') as $special ) {

         if($this->data['nav_urls'][$special]) {
            ?><li id="t-<?php echo $special ?>"><a href="<?php echo htmlspecialchars($this->data['nav_urls'][$special]['href'])
            ?>"<?php echo $this->skin->tooltipAndAccesskey('t-'.$special) ?>><?php $this->msg($special) ?></a></li>
<?php    }
      }

      if(!empty($this->data['nav_urls']['print']['href'])) { ?>
            <li id="t-print"><a href="<?php echo htmlspecialchars($this->data['nav_urls']['print']['href'])
            ?>"<?php echo $this->skin->tooltipAndAccesskey('t-print') ?>><?php $this->msg('printableversion') ?></a></li><?php
      }

      if(!empty($this->data['nav_urls']['permalink']['href'])) { ?>
            <li id="t-permalink"><a href="<?php echo htmlspecialchars($this->data['nav_urls']['permalink']['href'])
            ?>"<?php echo $this->skin->tooltipAndAccesskey('t-permalink') ?>><?php $this->msg('permalink') ?></a></li><?php
      } elseif ($this->data['nav_urls']['permalink']['href'] === '') { ?>
            <li id="t-ispermalink"<?php echo $this->skin->tooltip('t-ispermalink') ?>><?php $this->msg('permalink') ?></li><?php
      }

      wfRunHooks( 'MonoBookTemplateToolboxEnd', array( &$this ) );
      wfRunHooks( 'SkinTemplateToolboxEnd', array( &$this ) );
?>
         </ul>
      </div>
   </li>
<?php
   }

   /*************************************************************************************************/
   function languageBox() {
      if( $this->data['language_urls'] ) {
?>
   <li id="p-lang" class="portlet">
      <h3><?php $this->msg('otherlanguages') ?></h3>
      <div class="pBody">
         <ul>
<?php    foreach($this->data['language_urls'] as $langlink) { ?>
            <li class="<?php echo htmlspecialchars($langlink['class'])?>"><?php
            ?><a href="<?php echo htmlspecialchars($langlink['href']) ?>"><?php echo $langlink['text'] ?></a></li>
<?php    } ?>
         </ul>
      </div>
   </li>
<?php
      }
   }

   /*************************************************************************************************/
   function customBox( $bar, $cont ) {
?>
   <li class='generated-sidebar portlet' id='<?php echo Sanitizer::escapeId( "p-$bar" ) ?>'<?php echo $this->skin->tooltip('p-'.$bar) ?>>
      <h3><?php $out = wfMsg( $bar ); if (wfEmptyMsg($bar, $out)) echo $bar; else echo $out; ?></h3>
      <div class='pBody'>
<?php   if ( is_array( $cont ) ) { ?>
         <ul>
<?php          foreach($cont as $key => $val) { ?>
            <li id="<?php echo Sanitizer::escapeId($val['id']) ?>"<?php
               if ( $val['active'] ) { ?> class="active" <?php }
            ?>><a href="<?php echo htmlspecialchars($val['href']) ?>"<?php echo $this->skin->tooltipAndAccesskey($val['id']) ?>><?php echo htmlspecialchars($val['text']) ?></a></li>
<?php       } ?>
         </ul>
<?php   } else {
         # allow raw HTML block to be defined by extensions
         print $cont;
      }
?>
      </div>
   </li>
<?php
   }

} // end of class


