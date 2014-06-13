<?php $baseDir = Zend_Controller_Front::getInstance()->getBaseUrl(); ?>
<link href="//maxcdn.bootstrapcdn.com/bootswatch/3.1.1/flatly/bootstrap.min.css" rel="stylesheet">
<link href="//netdna.bootstrapcdn.com/font-awesome/3.0.2/css/font-awesome.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="<?php echo $baseDir; ?>/css/jquery-ui-theme/css/cupertino/jquery-ui-1.10.3.custom.min.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $baseDir; ?>/css/admin.css" /><script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js" type="text/javascript"></script>
<script src="<?php echo $baseDir; ?>/js/nestedSortable/nestedSortable.js" type="text/javascript"></script>
<script src="<?php echo $baseDir; ?>/js/jquery.history.html4html5/jquery.history.js" type="text/javascript"></script>
<script type="text/javascript">
  WebFontConfig = {
    google: { families: [ 'Tangerine', 'Cantarell' ] }
  };
  (function() {
    var wf = document.createElement('script');
    wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
        '://ajax.googleapis.com/ajax/libs/webfont/1.1.2/webfont.js';
    wf.type = 'text/javascript';
    wf.async = 'true';
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(wf, s);
  })();
</script>
<script src="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.1/js/bootstrap.min.js"></script>
