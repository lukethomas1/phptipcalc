<html>
<head>
  <title>Tip Calculator</title>
  <link rel="stylesheet" type="text/css" href="index.css">
</head>
<body>
<div id="box">
<h1>Tip Calc</h1>
<form id="form" action="index.php" method="post">
<?php

$GLOBALS["input"] = checkInput();
$GLOBALS["percent"] = checkRadio();

makeInput();
makeRadios();
makeSubmit();

showResult();

function checkInput() {
  if(!empty($_POST['subtotal'])) {
    return $_POST['subtotal'];
  }
  return 0;
}

function checkRadio() {
  if(!empty($_POST['tipval'])) {
    return $_POST['tipval'];
  }
  return 0;
}

function makeInput() {
  echo 'Subtotal:';
  if(isset($_POST['subtotal'])) {
    echo '<input type="text" name="subtotal" value="' . $_POST['subtotal'] . '">';
  }
  else {
    echo '<input type="text" name="subtotal">';
  }
  echo '<br>';
}

function makeRadios() {
  for($i = 0; $i < 3; $i++) {
    if($GLOBALS["percent"] == ($i + 2) * 5) {
      echo '<input type="radio" checked="checked" name="tipval" value=' . ($i + 2) * 5 . ' id="radio' . $i . '">'."\n";
    }
    else {
      echo '<input type="radio" name="tipval" value=' . ($i + 2) * 5 . ' id="radio' . $i . '">'."\n";
    }
      echo ($i + 2) * 5 . "%";
  }
  echo '<br>';
}

function makeSubmit() {
  echo '<input type="submit" name="submit" value="Submit" method="post">';
	echo '</form>';
}

function showResult() {
  if($GLOBALS["input"] > 0 && $GLOBALS["percent"] > 0) {
    echo '<div id="result">';
    echo 'Tip: ' . money_format('$%i', $GLOBALS["input"] * $GLOBALS["percent"] / 100);
    echo '<br>';
    $total = $GLOBALS["input"] + $GLOBALS["input"] * $GLOBALS["percent"] / 100;
    echo 'Total: ' . money_format('$%i', $total);
    echo '</div>';
  }
  else if(isset($_POST["submit"])) {
    if($GLOBALS["input"] <= 0) {
      echo '<span class="error">* Invalid Subtotal</span>';
    }
    if($GLOBALS["percent"] <= 0) {
      echo '<span class="error">* Invalid Percentage</span>';
    }
  }
}
    ?>
</div>
</body>
</html>
