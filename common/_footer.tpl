<img src="{$rootPath}analytics/counter" class="sx-hide">

<!-- template start -->
<script type="text/x-jquery-templete" id="gnbMenuItem">
  <li class="sx-menu" data-id="-1" data-depth="0">
    <a href="" target=""></a>
    <div class="sub_mask">
        <ul></ul>
      </div>
  </li>
</script>
<!-- template end -->

<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script>window.jQuery || document.write('<script src="{$rootPath}common/js/api/jquery.min.js"><\/script>')</script>
<script src="http://ajax.microsoft.com/ajax/jquery.templates/beta1/jquery.tmpl.min.js"></script>
<script>window.jQuery.tmpl || document.write('<script src="{$rootPath}common/js/api/jquery.tmpl.min.js"><\/script>')</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.19.0/TweenMax.min.js"></script>
<script>window.TweenMax || document.write('<script src="{$rootPath}common/js/api/TweenMax.min.js"><\/script>')</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.3.1/js/swiper.min.js"></script>
<script>window.Swiper || document.write('<script src="{$rootPath}common/js/api/idangerous.swiper.min.js"><\/script>')</script>
<script src="{$rootPath}common/plugins/ckeditor/ckeditor.js"></script>

{if $documentData.module_type === 'document' || $documentData.module_type === 'board'}
<script src="{$rootPath}common/plugins/syntaxhighlighter/scripts/shCore.js"></script>
<script src="{$rootPath}common/plugins/syntaxhighlighter/scripts/shAutoloader.js"></script>

<script type="text/javascript">

  function getSyntaxhighlightPath() {
  
    var args = arguments, result = [];

    for (var i=0; i<args.length; i++) {
      result.push(args[i].replace("@", "{$rootPath}common/plugins/syntaxhighlighter/scripts/"));
    }

    return result
  }

  SyntaxHighlighter.autoloader.apply(null, getSyntaxhighlightPath(
    "applescript            @shBrushAppleScript.js",
    "actionscript3 as3          @shBrushAS3.js",
    "sh bash shell            @shBrushBash.js",
    "coldfusion cf            @shBrushColdFusion.js",
    "coffee               @shBrushCoffeeScript.js",
    "cpp c c_cpp            @shBrushCpp.js",
    "c-sharp csharp           @shBrushCSharp.js",
    "css                @shBrushCss.js",
    "delphi pascal            @shBrushDelphi.js",
    "diff patch pas           @shBrushDiff.js",
    "erl erlang             @shBrushErlang.js",
    "groovy               @shBrushGroovy.js",
    "java               @shBrushJava.js",
    "jfx javafx             @shBrushJavaFX.js",
    "js jscript javascript        @shBrushJScript.js",
    "perl pl              @shBrushPerl.js",
    "php                @shBrushPhp.js",
    "text plain             @shBrushPlain.js",
    "py python              @shBrushPython.js",
    "ruby rails ror rb          @shBrushRuby.js",
    "sass scss              @shBrushSass.js",
    "scala                @shBrushScala.js",
    "ps powershell powershel1 shell   @shBrushPowerShell.js",
    "sql                @shBrushSql.js",
    "vb vbnet             @shBrushVb.js",
    "xml xhtml xslt html        @shBrushXml.js",

    "markdown mkdn mdown        @shBrushMarkdown.js"
  ));
  SyntaxHighlighter.config.space = ' ';
  //SyntaxHighlighter.defaults['gutter'] = false; 
  SyntaxHighlighter.all();
</script>
{/if}

<script src="{$rootPath}common/js/jsux.min.js?20180202"></script>
<script>jsux.rootPath = "{$rootPath}";</script>
<script>jsux.cookieVersion = "{$cookieVersion}";</script>
<script src="{$rootPath}common/js/jsux_common.min.js?20180202"></script>
<script src="{$rootPath}common/js/jsux_app.min.js?20180202"></script>
<script src="{$rootPath}common/js/jsux_app_stage.min.js?20180202"></script>
<script src="{$rootPath}common/js/jsux_search_form.min.js?20180202"></script>

{if $documentData.module_code && $documentData.jscode}
<script src="{$skinPath}{$documentData.module_code}.js?{$cookieVersion}"></script>
<script type="text/javascript">jsux.fn['{$documentData.jscode}'].init();</script>
{/if}
</body>
</html>