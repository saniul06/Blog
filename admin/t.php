<?php
$filePath = realpath(dirname(__FILE__));
include_once $filePath . '/../lib/session.php';
include_once $filePath . '/../config/config.php';
include_once $filePath . '/../lib/Database.php';
include_once $filePath . '/../helpers/format.php';
Session::start();
Session::checkSession();
$db = new Database;
$fm = new Format;
$a = false;
$b = true;
$c = "";
$d;
if($a == "")
    echo "a is not set<br/>";
    else echo "a is  set<br/>";
if($b == "")
    echo "b is set not <br/>";
    else echo "b is set<br/>";
if(isset($c))
echo "c is not set";
else
echo "c is set";
// if($d != null)
// echo $d;
echo "<br/><br/><br/>";
?>
<?php
if(isset($_POST['submit'])){
    $image = $_POST['vehicle'];
    foreach($image as $value){
    $query = "insert into tbl_slider(image) values('$value')";
    $result = $db->insert($query);
    }
    if($result){
        echo "INSERTED SUCCESSFULLY";
    }
        else {
            echo "INSERTION FAILED";
        }
      
foreach($image as $value){
    echo $value . " ,";
}
    
}
?>
<form action="" method ="post">
  <input type="checkbox" id="vehicle" name="vehicle[]" value="Bike">
  <label for="vehicle"> I have a bike</label><br>
  <input type="checkbox" id="vehicle2" name="vehicle[]" value="Car">
  <label for="vehicle2"> I have a car</label><br>
  <input type="checkbox" id="vehicle3" name="vehicle[]" value="Boat">
  <label for="vehicle3"> I have a boat</label><br><br>
  <input type="submit" value="Submit" name="submit">
</form>
