<?php header("Content-Type: text/html; charset=utf-8"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <title>MarkdownLetter</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link type="text/css" rel="stylesheet" href="../site/css/site.css" media="all" />
    <link type="text/css" rel="stylesheet" href="./css/style.css" media="all" />
    <script type="text/javascript" src="/site/js/jquery-1.5.2.min.js"></script>

  <script type="text/javascript">
  //<![CDATA[

  // Static Methods
  function Page(){};
    Page.submitForm = function(formAction) {
      var markdownForm = document.getElementById("markdownForm");
      markdownForm.action = formAction+".php";
      markdownForm.submit();
    };
    Page.showDiv = function(divId) {
      var div = document.getElementById(divId);
      div.style.display = (div.style.display=="block") ? "none" : "block";
    };
    Page.getRequestParameter = function(paramName) {
      var querystring = location.search.replace( '?', '' ).split( '&' );
      for ( var i=0; i<querystring.length; i++ ) {
        var name = querystring[i].split('=')[0];
        var value = querystring[i].split('=')[1];
        if (name == paramName){
          return value;
        }
      }
      return false;
    };

  function MDL(){};
    MDL.setMarkdown = function(escapedText) {
      document.getElementById('markdownText').value = unescape(escapedText);
    };
    MDL.saveBookmarklet = function() {
      var mdText = escape(document.getElementById('markdownText').value);
      var bookmarkletText = "javascript:void(MDL.setMarkdown('"+escape(mdText)+"'))";
      document.getElementById("bookmarklink").innerHTML = "<a href=\""+bookmarkletText+"\">Bookmark this link</a>";
    };

    MDL.callBookmarkUrl = function() {
      var mdText = escape(document.getElementById('markdownText').value);
      location.href = "index.php?letter="+mdText;
    };
    MDL.share = function() {
      window.my_callback = function(response) {
        if(response.error_message) {
          alert("An error occured: " + response.error_message);
        } else {
          //alert(response.short_url);
          document.getElementById("sharelink").innerHTML = "<input type='text' value='"+response.short_url+"' />";
        }
      };
      var mdText = escape(document.getElementById('markdownText').value);
      var aUrl = "www.unicate.ch/markdownletter/index.php?letter="+mdText;
      var s = document.createElement("script");
      s.src = "http://ggl-shortener.appspot.com/?url=" + encodeURIComponent(aUrl) + "&jsonp=my_callback";
      document.body.appendChild(s);
    };

    //]]>
    </script>
  </head>


  <body>
    <?php require_once('../site/inc/header.php'); ?>
    <form id="markdownForm" action="" method="post" accept-charset="utf-8">

    <div id="letter">
      <textarea name="markdownText" id="markdownText" rows="" cols="">
<?php include('default_letter.md') ?>
      </textarea>
    </div>


    <div id="about">
      <h1 class="title">MarkdownLetter</h1>

        <p>
          <input type="button" class="button_large" value="PDF Letter" id="mpdf" onclick="Page.submitForm(this.id)"/>
        </p>

        <p>
          <a href="javascript:void(0)" onclick="Page.showDiv('more');" >Options</a>
        </p>

        <div id="more" style="display:none;">
        <p>
          <select name="letterTemplate" class="button">
            <option value="A4_address_right">A4 - Address right</option>
            <option value="A4_address_left">A4 - Address left</option>
            <option value="A4_address_right_grey">A4 - Address right - Grey</option>
            <option value="A4_address_right_serif">A4 - Address right - Serif</option>
          </select>
          <br/>
              <br/>
          <input class="button" type="button" value="Preview" id="preview" onclick="Page.submitForm(this.id)"/>
          <br/>
          <br/>
          <input class="button" type="button" value="Save to URL" id="bookmark" onclick="MDL.callBookmarkUrl()"/>
          &nbsp;
          <br/>
          <br/>
          <input class="button" type="button" value="Share" id="bookmark" onclick="MDL.share()"/>
          <span id="sharelink"></span>
        </p>
      </div>
    </div>

  </form>

  <div id="footer">
    &copy; 2011 - 0.5 BETA - <a href="mailto:info@unicate.ch">Contact</a>
    - <a href="http://wiki.unicate.ch/Disclaimer">Disclaimer</a>
    - MarkdownLetter is powered by <a href="http://michelf.com/projects/php-markdown/">PHP Markdown</a>
    and <a href="http://mpdf.bpm1.com/">mPDF</a>.
  </div>


  <script type="text/javascript">
  //<![CDATA[
    if (Page.getRequestParameter("letter")) {
      MDL.setMarkdown(Page.getRequestParameter("letter"));
    }
  //]]>
  </script>

  </body>
</html>

