<?php use_helper("Javascript") ?>
 <?php use_javascript('jqModal.js') ?>
<?php use_stylesheet('jqModal.css') ?>

 <link type="text/css" href="http://jqueryui.com/latest/themes/base/ui.all.css" rel="stylesheet" />
  <script type="text/javascript" src="http://jqueryui.com/latest/jquery-1.3.2.js"></script>
  <script type="text/javascript" src="http://jqueryui.com/latest/ui/ui.core.js"></script>
  <script type="text/javascript" src="http://jqueryui.com/latest/ui/ui.draggable.js"></script>
  <script type="text/javascript" src="http://jqueryui.com/latest/ui/ui.resizable.js"></script>
  <script type="text/javascript" src="http://jqueryui.com/latest/ui/ui.dialog.js"></script>
  <script type="text/javascript">
  $(document).ready(function(){
    $("#dialog").dialog({ modal: true });
  });
  </script>
</head>

<div id="dialog" title="Dialog Title">I'm in a dialog</div>





