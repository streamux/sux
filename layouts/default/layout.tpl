{include file="$htmlHeader"}

<div class="sx-wrapper">
  
  <!-- Skip -->
  <p class="sx-skip-menu">
    <a href="#sxGnb">Skip to menu</a>  
    <a href="#sxContents">Skip to content</a>  
  </p>

  <!-- Header --> 
  <header id="sxHeader" class="header">
    {include file="./header.tpl"}
  </header>

  <!-- Nav -->
  <div id="nav" class="sx-gnb">
    {include file="./nav.tpl"}
  </div>

  <!-- Container -->
  <div id="sxContents" class="sx-container">
    {include file="$contentPath"}
  </div>
  
  <!--  Footer  -->
  <footer id="sxfooter" class="footer">
    {include file="$copyrightPath"}
  </footer>  
</div>

{include file="$htmlFooter"}