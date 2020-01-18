<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Call JS Function</title>
<script type="text/javascript">
function jsFunction(){
alert('Execute Javascript Function Through PHP');
}
</script>
</head>
<body>
<?php
echo '<script type="text/javascript">jsFunction();</script>';
?>
</body>
</html>